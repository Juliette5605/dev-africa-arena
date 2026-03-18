<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/criteres', [PageController::class, 'criteres'])->name('criteres');
Route::get('/a-propos', [PageController::class, 'about'])->name('about');
Route::get('/valeurs', [PageController::class, 'valeurs'])->name('valeurs');
Route::get('/argument', [PageController::class, 'argument'])->name('argument');
Route::get('/partenaires', [PageController::class, 'partenaires'])->name('partenaires');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/financier', [PageController::class, 'financier'])->name('financier');
Route::get('/techniques', [PageController::class, 'techniques'])->name('techniques');
Route::get('/sponsors', [PageController::class, 'sponsors'])->name('sponsors');