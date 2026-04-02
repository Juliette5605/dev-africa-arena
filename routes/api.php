<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;

/*
|--------------------------------------------------------------------------
| DevAfrica Arena — API publique (lecture seule, sans auth)
|--------------------------------------------------------------------------
| Base URL : /api/v1/
| Format   : JSON
*/

Route::prefix('v1')->name('api.')->group(function () {

    // Infos générales
    Route::get('/info',      [ApiController::class, 'info']);

    // Édition active (pour app mobile / site externe)
    Route::get('/edition',   [ApiController::class, 'edition']);

    // Stats publiques
    Route::get('/stats',     [ApiController::class, 'stats']);

    // Partenaires (liste publique)
    Route::get('/partenaires',          [ApiController::class, 'partenaires']);
    Route::get('/partenaires/{type}',   [ApiController::class, 'partenairesParType']);
});
