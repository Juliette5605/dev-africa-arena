<?php

namespace App\Http\Controllers;

use App\Models\Edition;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /** Page d'accueil — Quiz ADN, Offres emploi, Newsletter, Countdown */
    public function home()
    {
        $edition = Edition::active();
        return view('pages.home', compact('edition'));
    }

    /** À Propos — Le cycle bimestriel */
    public function aPropos()
    {
        return view('pages.a-propos');
    }

    /** Valeurs — Tableau comparatif vs hackathon classique */
    public function valeurs()
    {
        return view('pages.valeurs');
    }

    /** Argument stratégique — Code = actif IP */
    public function argument()
    {
        return view('pages.argument');
    }

    /** Hub Partenaires */
    public function partenaires()
    {
        return view('pages.partenaires');
    }

    /** Partenariat Financier — Packs Silver/Gold/Diamond */
    public function partenairesFinancier()
    {
        return view('pages.partenaires-financier');
    }

    /** Partenariat Technique */
    public function partenairesTechniques()
    {
        return view('pages.partenaires-techniques');
    }

    /** Sponsors Bronze/Argent/Or */
    public function partenairesSponsors()
    {
        return view('pages.partenaires-sponsors');
    }

    /** Critères de sélection + formulaire candidature */
    public function criteres()
    {
        return view('pages.criteres');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function editions()
    {
        $editions = \App\Models\Edition::latest()->get();
        return view('pages.editions', compact('editions'));
    }
}
