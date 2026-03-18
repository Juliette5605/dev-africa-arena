<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return view('index'); // page d'accueil
    }

    public function criteres()
    {
        return view('criteres'); // page d'accueil
    }

    public function about()
    {
        return view('a-propos'); // page "À propos"
    }

    public function valeurs()
    {
        return view('valeurs'); // page "Valeurs"
    }

    public function argument()
    {
        return view('argument'); // page "Argument"
    }

    public function partenaires()
    {
        return view('partenaires'); // page "partenaires"
    }

    public function contact()
    {
        return view('contact'); // page "contact"
    }

    public function financier()
    {
        return view('financier'); // page "financier"
    }

    public function techniques()
    {
        return view('techniques'); // page "techniques"
    }

    public function sponsors()
    {
        return view('sponsors'); // page "sponsors"
    }
}
