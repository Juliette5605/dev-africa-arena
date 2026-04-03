<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrientationController extends Controller
{
    /**
     * Affiche la page d'orientation intelligente.
     */
    public function index()
    {
        // On retourne la vue qui se trouve dans resources/views/orientation/index.blade.php
        return view('orientation.index');
    }
}