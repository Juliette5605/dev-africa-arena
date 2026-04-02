<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidature;
use App\Models\ContactMessage;
use App\Models\Newsletter;
use App\Models\Partenaire;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $q = trim($request->get('q', ''));

        if (strlen($q) < 2) {
            return view('admin.search', ['q' => $q, 'results' => [], 'total' => 0]);
        }

        $like = "%{$q}%";

        $candidatures = Candidature::where('nom','like',$like)
            ->orWhere('prenom','like',$like)
            ->orWhere('email','like',$like)
            ->orWhere('expertise','like',$like)
            ->orWhere('pays','like',$like)
            ->latest()->take(10)->get()
            ->map(fn($c) => [
                'type'  => 'Candidature',
                'icon'  => '🧑‍💻',
                'color' => '#f39c12',
                'title' => $c->prenom.' '.$c->nom,
                'sub'   => $c->expertise.' · '.$c->pays,
                'url'   => route('admin.candidatures.show', $c),
                'date'  => $c->created_at->format('d/m/Y'),
            ]);

        $messages = ContactMessage::where('nom','like',$like)
            ->orWhere('email','like',$like)
            ->orWhere('sujet','like',$like)
            ->latest()->take(8)->get()
            ->map(fn($m) => [
                'type'  => 'Message',
                'icon'  => '💬',
                'color' => '#16a34a',
                'title' => $m->nom,
                'sub'   => $m->sujet,
                'url'   => route('admin.messages.show', $m),
                'date'  => $m->created_at->format('d/m/Y'),
            ]);

        $partenaires = Partenaire::where('responsable','like',$like)
            ->orWhere('entreprise','like',$like)
            ->orWhere('email','like',$like)
            ->latest()->take(8)->get()
            ->map(fn($p) => [
                'type'  => 'Partenaire',
                'icon'  => '🤝',
                'color' => '#0284c7',
                'title' => $p->entreprise ?? $p->responsable,
                'sub'   => ucfirst($p->type),
                'url'   => route('admin.partenaires'),
                'date'  => $p->created_at->format('d/m/Y'),
            ]);

        $newsletters = Newsletter::where('email','like',$like)
            ->latest()->take(5)->get()
            ->map(fn($n) => [
                'type'  => 'Newsletter',
                'icon'  => '📧',
                'color' => '#9333ea',
                'title' => $n->email,
                'sub'   => 'Abonné',
                'url'   => route('admin.newsletters'),
                'date'  => $n->created_at->format('d/m/Y'),
            ]);

        $results = $candidatures->merge($messages)->merge($partenaires)->merge($newsletters)
                                ->sortByDesc('date')->values();

        return view('admin.search', ['q' => $q, 'results' => $results, 'total' => $results->count()]);
    }
}
