<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PasswordResetController;
use App\Http\Controllers\OrientationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewsletterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - DevAfrica Arena
|--------------------------------------------------------------------------
*/

// 1. Pages Publiques Front-end
Route::get('/', function () {
    return view('pages.home'); 
})->name('home');

Route::get('/a-propos', [PageController::class, 'aPropos'])->name('a-propos');
Route::get('/criteres', [PageController::class, 'criteres'])->name('criteres');
Route::get('/valeurs', [PageController::class, 'valeurs'])->name('valeurs');
Route::get('/argument', [PageController::class, 'argument'])->name('argument');
Route::get('/orientation', [OrientationController::class, 'index'])->name('orientation');
Route::get('/editions', [PageController::class, 'editions'])->name('editions');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

// --- Newsletter & Chatbot ---
Route::post('/newsletter-store', [NewsletterController::class, 'store'])->name('newsletter.store'); 

Route::post('/chat/public', function (Request $request) {
    $message = $request->input('message');
    return response()->json([
        'reply' => "Merci pour votre message : '$message'. L'assistant IA est en cours de configuration."
    ]);
})->name('chat.public');

// --- Routes Partenaires (Public) ---
Route::prefix('partenaires')->name('partenaires.')->group(function () {
    Route::get('/', [PageController::class, 'partenaires'])->name('index');
    Route::get('/financier', [PageController::class, 'partenairesFinancier'])->name('financier');
    Route::get('/techniques', [PageController::class, 'partenairesTechniques'])->name('techniques');
    Route::get('/sponsors', [PageController::class, 'partenairesSponsors'])->name('sponsors');

    Route::post('/financier', function (Request $request) {
        return back()->with('success', 'Merci, votre demande de partenariat financier a bien été envoyée.');
    })->name('financier.store');

    Route::post('/techniques', function (Request $request) {
        return back()->with('success', 'Merci, votre demande de partenariat technique a bien été envoyée.');
    })->name('techniques.store');

    Route::post('/sponsors', function (Request $request) {
        return back()->with('success', 'Merci, votre demande de sponsoring a bien été envoyée.');
    })->name('sponsors.store');
});

// --- Authentification Standard ---
Route::get('/login', function () { return view('auth.login'); })->name('login');
Route::get('/register', function () { return view('auth.register'); })->name('register');

/*
|--------------------------------------------------------------------------
| 2. ADMINISTRATION (Prefix: admin | Name: admin.)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    
    // Auth Admin
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // Password Reset (Admin)
    Route::get('forgot-password', [PasswordResetController::class, 'showRequest'])->name('password.request');
    Route::post('forgot-password', [PasswordResetController::class, 'sendReset'])->name('password.request.send');
    Route::get('reset-password', [PasswordResetController::class, 'showResetForm'])->name('password.reset.form');
    Route::post('reset-password', [PasswordResetController::class, 'resetPassword'])->name('password.reset.update');

    // Routes protégées pour l'administration
    Route::middleware(['auth:admin'])->group(function () {
        
        // Dashboard & Recherche
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('search', [DashboardController::class, 'index'])->name('search');

        // Gestion des flux (Candidatures, Messages, Newsletters)
        Route::get('candidatures', [DashboardController::class, 'candidatures'])->name('candidatures');
        Route::get('messages', [DashboardController::class, 'messages'])->name('messages');
        Route::get('messages/{message}', [DashboardController::class, 'messageShow'])->name('messages.show');
        Route::delete('messages/{message}', [DashboardController::class, 'messageDestroy'])->name('messages.destroy');
        Route::get('newsletters', [DashboardController::class, 'index'])->name('newsletters');
        Route::get('newsletter/broadcast', [DashboardController::class, 'index'])->name('newsletter.broadcast');

        // Sections spécifiques demandées par le layout
        Route::get('finalistes', [DashboardController::class, 'index'])->name('finalistes');
        Route::get('partenaires', [DashboardController::class, 'index'])->name('partenaires');
        Route::get('editions', [DashboardController::class, 'index'])->name('editions');
        
        // Outils & IA (TalentSync, QR, Media, Logs)
        Route::get('talentsync', [DashboardController::class, 'index'])->name('talentsync');
        Route::get('qrcode', [DashboardController::class, 'index'])->name('qrcode');
        Route::get('media', [DashboardController::class, 'index'])->name('media.index');
        Route::get('logs', [DashboardController::class, 'index'])->name('logs');
        Route::get('export/candidatures', [DashboardController::class, 'index'])->name('export.candidatures');
        Route::get('backup/database', [DashboardController::class, 'index'])->name('backup.database');

        // Configuration & Profil
        Route::get('admins', [DashboardController::class, 'index'])->name('admins.index');
        Route::get('smtp', [DashboardController::class, 'index'])->name('smtp');
        Route::get('settings', [DashboardController::class, 'index'])->name('settings');
        Route::get('profile', [DashboardController::class, 'index'])->name('profile');
    });
});

/*
|--------------------------------------------------------------------------
| 3. ZONE UTILISATEUR CONNECTÉ (Breeze/Standard)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';