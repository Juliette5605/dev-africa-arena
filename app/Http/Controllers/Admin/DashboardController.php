<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Candidature;
use App\Models\ContactMessage;
use App\Models\Edition;
use App\Models\Newsletter;
use App\Models\Partenaire;
use App\Models\Setting;
use App\Services\IAService; // On importe ton nouveau service
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    protected $iaService;

    // On injecte le service IA ici
    public function __construct(IAService $iaService)
    {
        $this->iaService = $iaService;
    }

    // ── DASHBOARD GÉNÉRAL ───────────────────────────────────────────
    public function index()
    {
        $stats = [
            'candidatures'        => Candidature::count(),
            'candidatures_unread' => Candidature::unread()->count(),
            'partenaires'         => Partenaire::count(),
            'messages'            => ContactMessage::count(),
            'messages_unread'     => ContactMessage::unread()->count(),
            'newsletters'         => Newsletter::count(),
            'juniors'             => Candidature::where('niveau', 'Junior')->count(),
            'intermediaires'      => Candidature::where('niveau', 'Intermédiaire')->count(),
            'seniors'             => Candidature::where('niveau', 'Senior')->count(),
            'financiers'          => Partenaire::where('type', 'financier')->count(),
            'techniques'          => Partenaire::where('type', 'technique')->count(),
            'sponsors'            => Partenaire::where('type', 'sponsor')->count(),
            'recent_candidatures' => Candidature::latest()->take(6)->get(),
            'recent_messages'     => ContactMessage::latest()->take(5)->get(),
            'weekly_candidatures' => DB::select('SELECT WEEK(created_at,1) as week, COUNT(*) as total FROM candidatures WHERE created_at >= DATE_SUB(NOW(), INTERVAL 8 WEEK) GROUP BY WEEK(created_at,1) ORDER BY week'),
        ];
        $edition      = Edition::where('active', true)->first();
        $recent_logs  = ActivityLog::with('admin')->latest()->take(10)->get();
        return view('admin.dashboard', compact('stats', 'edition', 'recent_logs'));
    }

    // ── CANDIDATURES (LISTE & ACTIONS) ───────────────────────────────
    public function candidatures(Request $request)
    {
        $query = Candidature::latest();
        if ($request->filled('niveau'))  $query->where('niveau', $request->niveau);
        if ($request->filled('pays'))    $query->where('pays', $request->pays);
        if ($request->filled('lu')) {
            $request->lu === 'non' ? $query->unread() : $query->whereNotNull('read_at');
        }
        if ($request->filled('q')) {
            $s = $request->q;
            $query->where(fn($q) =>
                $q->where('nom', 'like', "%$s%")->orWhere('prenom', 'like', "%$s%")
                  ->orWhere('expertise', 'like', "%$s%")->orWhere('email', 'like', "%$s%")
            );
        }
        $candidatures = $query->paginate(15)->withQueryString();
        $pays_list    = Candidature::select('pays')->distinct()->orderBy('pays')->pluck('pays');
        
        return view('admin.candidatures', compact('candidatures', 'pays_list'));
    }

    public function messages(Request $request)
    {
        $query = ContactMessage::latest();
        if ($request->filled('lu')) {
            $request->lu === 'non' ? $query->unread() : $query->whereNotNull('read_at');
        }
        if ($request->filled('q')) {
            $s = $request->q;
            $query->where(fn($q) =>
                $q->where('nom', 'like', "%$s%")->orWhere('email', 'like', "%$s%")
                  ->orWhere('sujet', 'like', "%$s%")->orWhere('message', 'like', "%$s%")
            );
        }
        $messages = $query->paginate(15)->withQueryString();
        return view('admin.messages', compact('messages'));
    }

    public function finalistes()
    {
        $max = (int) Setting::get('nb_finalistes', 6);
        $finalistes = Candidature::where('finaliste', true)
            ->orderByDesc('note')
            ->latest()
            ->get();

        return view('admin.finalistes', compact('finalistes', 'max'));
    }

    public function partenaires(Request $request)
    {
        $query = Partenaire::latest();

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($subQuery) use ($search) {
                $subQuery->where('responsable', 'like', "%{$search}%")
                    ->orWhere('entreprise', 'like', "%{$search}%")
                    ->orWhere('telephone', 'like', "%{$search}%")
                    ->orWhere('message', 'like', "%{$search}%");
            });
        }

        $partenaires = $query->paginate(15)->withQueryString();

        return view('admin.partenaires', compact('partenaires'));
    }

    public function partenaireDestroy(Partenaire $partenaire)
    {
        $label = $partenaire->entreprise ?: $partenaire->responsable;
        $partenaire->delete();

        ActivityLog::log('supprimé', 'Partenaire', $label);

        return back()->with('success', 'Partenaire supprimé.');
    }

    public function newsletters()
    {
        $newsletters = Newsletter::latest()->paginate(20);

        return view('admin.newsletters', compact('newsletters'));
    }

    public function editions()
    {
        $editions = Edition::latest('date_selection')->get();

        return view('admin.editions', compact('editions'));
    }

    public function editionStore(Request $request)
    {
        $validated = $request->validate([
            'nom'            => 'required|string|max:150',
            'date_selection' => 'required|date',
            'date_finale'    => 'required|date|after_or_equal:date_selection',
            'lieu'           => 'nullable|string|max:150',
            'active'         => 'nullable|boolean',
        ]);

        if ($request->boolean('active')) {
            Edition::query()->update(['active' => false]);
        }

        $edition = Edition::create([
            'nom'            => $validated['nom'],
            'date_selection' => $validated['date_selection'],
            'date_finale'    => $validated['date_finale'],
            'lieu'           => $validated['lieu'] ?? 'Lome, Togo',
            'active'         => $request->boolean('active'),
        ]);

        ActivityLog::log('créé', 'Édition', $edition->nom);

        return back()->with('success', 'Édition créée avec succès.');
    }

    public function editionActivate(Edition $edition)
    {
        Edition::query()->update(['active' => false]);
        $edition->update(['active' => true]);

        ActivityLog::log('activé', 'Édition', $edition->nom);

        return back()->with('success', 'Édition activée.');
    }

    public function editionDestroy(Edition $edition)
    {
        $nom = $edition->nom;
        $edition->delete();

        ActivityLog::log('supprimé', 'Édition', $nom);

        return back()->with('success', 'Édition supprimée.');
    }

    public function messageShow(ContactMessage $message)
    {
        $message->markAsRead();
        return view('admin.message-show', compact('message'));
    }

    public function messageDestroy(ContactMessage $message)
    {
        $nom = $message->nom . ' <' . $message->email . '>';
        $message->delete();
        ActivityLog::log('supprimé', 'Message', $nom);
        return back()->with('success', 'Message supprimé.');
    }

    /**
     * Dashboard individuel utilisant le IAService
     */
    public function candidatureDashboard(Candidature $candidature)
    {
        // On utilise ton service pour analyser si le score est absent
        if (!$candidature->score_ia || $candidature->score_ia == 0) {
            
            $resultat = $this->iaService->analyserCandidat(
                $candidature->motivation, 
                $candidature->expertise
            );

            $candidature->update([
                'score_ia'   => $resultat['score'],
                'analyse_ia' => $resultat['analyse']
            ]);
        }

        ActivityLog::log('consulte dashboard', 'Candidature', $candidature->prenom.' '.$candidature->nom);
        return view('admin.candidature-dashboard', compact('candidature'));
    }

    public function candidatureShow(Candidature $candidature)
    {
        $candidature->markAsRead();
        return view('admin.candidature-show', compact('candidature'));
    }

    public function candidatureDestroy(Candidature $candidature)
    {
        $nom = $candidature->prenom . ' ' . $candidature->nom;
        $candidature->delete();
        ActivityLog::log('supprimé', 'Candidature', $nom);
        return back()->with('success', "Candidature de {$nom} supprimée.");
    }

    public function candidaturePdf(Candidature $candidature)
    {
        // Placeholder pour l'export PDF - retourne un message d'attente
        return response()->json(['message' => 'Export PDF en attente de configuration'], 501);
    }

    public function candidatureToggleFinaliste(Candidature $candidature)
    {
        $candidature->finaliste = !$candidature->finaliste;
        $candidature->save();
        
        $action = $candidature->finaliste ? 'ajouté aux finalistes' : 'retiré des finalistes';
        $nom = $candidature->prenom . ' ' . $candidature->nom;
        ActivityLog::log($action, 'Candidature', $nom);
        
        return back()->with('success', "Candidat {$action}.");
    }

    public function candidatureNoter(Request $request, Candidature $candidature)
    {
        $request->validate([
            'note' => 'required|integer|min:1|max:5',
        ]);

        $candidature->update(['note' => $request->note]);
        
        $nom = $candidature->prenom . ' ' . $candidature->nom;
        ActivityLog::log('noté', 'Candidature', $nom . ' - ' . $request->note . '/5');
        
        return back()->with('success', "Note enregistrée pour {$nom}.");
    }

    public function exportCandidatures()
    {
        $candidatures = Candidature::orderBy('created_at', 'desc')->get();
        ActivityLog::log('exporté', 'Candidatures CSV', count($candidatures) . ' lignes');
        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="candidatures-' . date('Y-m-d') . '.csv"',
            'Pragma'              => 'no-cache',
        ];
        $callback = function () use ($candidatures) {
            $h = fopen('php://output', 'w');
            fputs($h, "\xEF\xBB\xBF");
            fputcsv($h, ['ID', 'Nom', 'Prénom', 'Email', 'Âge', 'Niveau', 'Pays', 'Expertise', 'Diplôme', 'Motivation', 'Vision', 'Date'], ';');
            foreach ($candidatures as $c) {
                fputcsv($h, [$c->id, $c->nom, $c->prenom, $c->email, $c->age, $c->niveau, $c->pays, $c->expertise, $c->diplome, $c->motivation, $c->vision, $c->created_at->format('d/m/Y H:i')], ';');
            }
            fclose($h);
        };
        return Response::stream($callback, 200, $headers);
    }

    public function backupDatabase()
    {
        $stats = [
            'candidatures' => Candidature::count(),
            'messages'     => ContactMessage::count(),
            'partenaires'  => Partenaire::count(),
            'newsletters'  => Newsletter::count(),
        ];

        return view('admin.backup-database', compact('stats'));
    }

    // ... (Reste des méthodes : partenaires, messages, newsletters, etc. restent identiques)

    // ── LOGS D'ACTIVITÉ ────────────────────────────────────────────
    public function logs(Request $request)
    {
        $query = ActivityLog::with('admin')->latest();
        if ($request->filled('action'))  $query->where('action', $request->action);
        if ($request->filled('subject')) $query->where('subject', $request->subject);
        $logs  = $query->paginate(30)->withQueryString();
        $total = ActivityLog::count();
        return view('admin.logs', compact('logs', 'total'));
    }

    public function logDestroy(ActivityLog $log)
    {
        $log->delete();
        return back()->with('success', 'Entrée supprimée.');
    }

    public function logsClear(Request $request)
    {
        $request->validate([
            'periode' => 'required|in:7,30,90,all',
        ]);

        if ($request->periode === 'all') {
            $count = ActivityLog::count();
            ActivityLog::truncate();
        } else {
            $count = ActivityLog::where('created_at', '<', now()->subDays($request->periode))->count();
            ActivityLog::where('created_at', '<', now()->subDays($request->periode))->delete();
        }

        return back()->with('success', $count . ' entrée(s) supprimée(s).');
    }
}
