<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Candidature;
use App\Models\ContactMessage;
use App\Models\Edition;
use App\Models\Newsletter;
use App\Models\Partenaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // ── DASHBOARD ─────────────────────────────────────────────────
    public function index()
    {
        $stats = [
            'candidatures'        => Candidature::count(),
            'candidatures_unread' => Candidature::unread()->count(),
            'partenaires'         => Partenaire::count(),
            'messages'            => ContactMessage::count(),
            'messages_unread'     => ContactMessage::unread()->count(),
            'newsletters'         => Newsletter::count(),
            'juniors'             => Candidature::where('niveau','Junior')->count(),
            'intermediaires'      => Candidature::where('niveau','Intermédiaire')->count(),
            'seniors'             => Candidature::where('niveau','Senior')->count(),
            'financiers'          => Partenaire::where('type','financier')->count(),
            'techniques'          => Partenaire::where('type','technique')->count(),
            'sponsors'            => Partenaire::where('type','sponsor')->count(),
            'recent_candidatures' => Candidature::latest()->take(6)->get(),
            'recent_messages'     => ContactMessage::latest()->take(5)->get(),
            'weekly_candidatures' => \DB::select('SELECT WEEK(created_at,1) as week, COUNT(*) as total FROM candidatures WHERE created_at >= DATE_SUB(NOW(), INTERVAL 8 WEEK) GROUP BY WEEK(created_at,1) ORDER BY week'),
        ];
        $edition      = Edition::where('active',true)->first();
        $recent_logs  = ActivityLog::with('admin')->latest()->take(10)->get();
        return view('admin.dashboard', compact('stats','edition','recent_logs'));
    }

    // ── CANDIDATURES ───────────────────────────────────────────────
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
                $q->where('nom','like',"%$s%")->orWhere('prenom','like',"%$s%")
                  ->orWhere('expertise','like',"%$s%")->orWhere('email','like',"%$s%")
            );
        }
        $candidatures = $query->paginate(15)->withQueryString();
        $pays_list    = Candidature::select('pays')->distinct()->orderBy('pays')->pluck('pays');
        return view('admin.candidatures', compact('candidatures','pays_list'));
    }

    public function candidatureShow(Candidature $candidature)
    {
        $candidature->markAsRead();
        return view('admin.candidature-show', compact('candidature'));
    }

    public function candidatureDestroy(Candidature $candidature)
    {
        $nom = $candidature->prenom.' '.$candidature->nom;
        $candidature->delete();
        ActivityLog::log('supprimé', 'Candidature', $nom);
        return back()->with('success', "Candidature de {$nom} supprimée.");
    }

    public function exportCandidatures()
    {
        $candidatures = Candidature::orderBy('created_at','desc')->get();
        ActivityLog::log('exporté', 'Candidatures CSV', count($candidatures).' lignes');
        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="candidatures-'.date('Y-m-d').'.csv"',
            'Pragma'              => 'no-cache',
        ];
        $callback = function() use ($candidatures) {
            $h = fopen('php://output','w');
            fputs($h,"\xEF\xBB\xBF");
            fputcsv($h,['ID','Nom','Prénom','Email','Âge','Niveau','Pays','Expertise','Diplôme','Motivation','Vision','Date'],';');
            foreach ($candidatures as $c) {
                fputcsv($h,[$c->id,$c->nom,$c->prenom,$c->email,$c->age,$c->niveau,$c->pays,$c->expertise,$c->diplome,$c->motivation,$c->vision,$c->created_at->format('d/m/Y H:i')],';');
            }
            fclose($h);
        };
        return Response::stream($callback, 200, $headers);
    }

    // ── PARTENAIRES ────────────────────────────────────────────────
    public function partenaires(Request $request)
    {
        $query = Partenaire::latest();
        if ($request->filled('type')) $query->where('type', $request->type);
        $partenaires = $query->paginate(15)->withQueryString();
        return view('admin.partenaires', compact('partenaires'));
    }

    public function partenaireDestroy(Partenaire $partenaire)
    {
        $nom = $partenaire->entreprise ?? $partenaire->responsable;
        $partenaire->delete();
        ActivityLog::log('supprimé', 'Partenaire', $nom);
        return back()->with('success', 'Partenaire supprimé.');
    }

    // ── MESSAGES ───────────────────────────────────────────────────
    public function messages(Request $request)
    {
        $query = ContactMessage::latest();
        if ($request->filled('lu')) {
            $request->lu === 'non' ? $query->unread() : $query->whereNotNull('read_at');
        }
        $messages = $query->paginate(15)->withQueryString();
        return view('admin.messages', compact('messages'));
    }

    public function messageShow(ContactMessage $message)
    {
        $message->markAsRead();
        ActivityLog::log('lu', 'Message', $message->nom.' — '.$message->sujet);
        return view('admin.message-show', compact('message'));
    }

    public function messageDestroy(ContactMessage $message)
    {
        $detail = $message->nom;
        $message->delete();
        ActivityLog::log('supprimé', 'Message', $detail);
        return back()->with('success', 'Message supprimé.');
    }

    // ── NEWSLETTER ─────────────────────────────────────────────────
    public function newsletters()
    {
        $newsletters = Newsletter::latest()->paginate(20);
        return view('admin.newsletters', compact('newsletters'));
    }

    // ── ÉDITIONS ───────────────────────────────────────────────────
    public function editions()
    {
        $editions = Edition::latest()->paginate(10);
        return view('admin.editions', compact('editions'));
    }

    public function editionStore(Request $request)
    {
        $v = $request->validate([
            'nom'            => 'required|string|max:200',
            'date_selection' => 'required|date',
            'date_finale'    => 'required|date|after:date_selection',
            'lieu'           => 'nullable|string|max:200',
            'active'         => 'sometimes|boolean',
        ]);
        if (!empty($v['active'])) Edition::query()->update(['active'=>false]);
        $v['active'] = $v['active'] ?? false;
        $v['lieu']   = $v['lieu'] ?? 'Lomé, Togo';
        $edition = Edition::create($v);
        ActivityLog::log('créé', 'Édition', $edition->nom);
        return back()->with('success', 'Nouvelle édition créée.');
    }

    public function editionActivate(Edition $edition)
    {
        Edition::query()->update(['active'=>false]);
        $edition->update(['active'=>true]);
        ActivityLog::log('activé', 'Édition', $edition->nom);
        return back()->with('success', "Édition «{$edition->nom}» activée.");
    }

    public function editionDestroy(Edition $edition)
    {
        $nom = $edition->nom;
        $edition->delete();
        ActivityLog::log('supprimé', 'Édition', $nom);
        return back()->with('success', 'Édition supprimée.');
    }

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

        return back()->with('success', $count.' entrée(s) supprimée(s).');
    }
}
