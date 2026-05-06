<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class OpportunityController extends Controller
{
    public function index()
    {
        $response = Http::get(
            'https://www.themuse.com/api/public/jobs?page=1'
        );

        if ($response->successful()) {

            $opportunities =
                $response->json()['results'] ?? [];

        } else {

            $opportunities = [];
        }

        return view(
            'pages.home',
            compact('opportunities')
        );
    }
}