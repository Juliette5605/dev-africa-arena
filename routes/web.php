<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminManagementController;
use App\Http\Controllers\Admin\PasswordResetController;
use App\Http\Controllers\Admin\CandidatureAdvancedController;
use App\Http\Controllers\Admin\SearchController;
use App\Http\Controllers\Admin\QrCodeController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\SmtpController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\NewsletterBroadcastController;

/*
|--------------------------------------------------------------------------
| ══ PAGES PUBLIQUES (avec mode maintenance) ══════════════════════════════
|--------------------------------------------------------------------------
*/
Route::middleware('maintenance')->group(function () {
    Route::get('/',            [PageController::class, 'home'])->name('home');
    Route::get('/a-propos',    [PageController::class, 'aPropos'])->name('a-propos');
    Route::get('/valeurs',     [PageController::class, 'valeurs'])->name('valeurs');
    Route::get('/argument',    [PageController::class, 'argument'])->name('argument');
    Route::get('/contact',     [PageController::class, 'contact'])->name('contact');
    Route::get('/criteres',    [PageController::class, 'criteres'])->name('criteres');
    Route::get('/editions',    [PageController::class, 'editions'])->name('editions.public');

    Route::prefix('partenaires')->name('partenaires.')->group(function () {
        Route::get('/',           [PageController::class, 'partenaires'])->name('index');
        Route::get('/financier',  [PageController::class, 'partenairesFinancier'])->name('financier');
        Route::get('/techniques', [PageController::class, 'partenairesTechniques'])->name('techniques');
        Route::get('/sponsors',   [PageController::class, 'partenairesSponsors'])->name('sponsors');
    });

    // Formulaires — Protection anti-spam (Limité à 5 tentatives par minute)
    Route::middleware('throttle:5,1')->group(function () {
        // C'est cette route qui reçoit ton formulaire de candidature
        Route::post('/criteres',               [FormController::class, 'storeCandidature'])->name('criteres.store');
        Route::post('/contact',                [FormController::class, 'storeContact'])->name('contact.store');
        Route::post('/partenaires/financier',  [FormController::class, 'storeFinancier'])->name('partenaires.financier.store');
        Route::post('/partenaires/techniques', [FormController::class, 'storeTechnique'])->name('partenaires.techniques.store');
        Route::post('/partenaires/sponsors',   [FormController::class, 'storeSponsor'])->name('partenaires.sponsors.store');
        Route::post('/newsletter',             [NewsletterController::class, 'store'])->name('newsletter.store');
    });
});

/*
|--------------------------------------------------------------------------
| ══ ADMINISTRATION ═══════════════════════════════════════════════════════
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {

    // Authentification Admin
    Route::get('/login',   [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',  [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Mot de passe oublié
    Route::get('/password/request',  [PasswordResetController::class, 'showRequest'])->name('password.request');
    Route::post('/password/request', [PasswordResetController::class, 'sendReset'])->name('password.request.send');
    Route::get('/password/reset',    [PasswordResetController::class, 'showResetForm'])->name('password.reset.form');
    Route::post('/password/reset',   [PasswordResetController::class, 'resetPassword'])->name('password.reset.update');

    // ── Accès Lecture (Middleware Admin simple) ──
    Route::middleware('admin')->group(function () {
        Route::get('/',                           [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/candidatures',               [DashboardController::class, 'candidatures'])->name('candidatures');
        Route::get('/candidatures/{candidature}', [DashboardController::class, 'candidatureShow'])->name('candidatures.show');
        Route::get('/partenaires',                [DashboardController::class, 'partenaires'])->name('partenaires');
        Route::get('/messages',                   [DashboardController::class, 'messages'])->name('messages');
        Route::get('/messages/{message}',         [DashboardController::class, 'messageShow'])->name('messages.show');
        Route::get('/newsletters',                [DashboardController::class, 'newsletters'])->name('newsletters');
        Route::get('/editions',                   [DashboardController::class, 'editions'])->name('editions');
        Route::get('/logs',                       [DashboardController::class, 'logs'])->name('logs');
        Route::delete('/logs/{log}',              [DashboardController::class, 'logDestroy'])->name('logs.destroy');
        Route::post('/logs/clear',                [DashboardController::class, 'logsClear'])->name('logs.clear');
        
        Route::get('/finalistes',                 [CandidatureAdvancedController::class, 'finalistes'])->name('finalistes');
        Route::get('/search',                     [SearchController::class, 'search'])->name('search');
        Route::get('/qrcode',                     [QrCodeController::class, 'show'])->name('qrcode');
        Route::get('/profile',                    [ProfileController::class, 'show'])->name('profile');
        Route::patch('/profile/info',             [ProfileController::class, 'updateInfo'])->name('profile.update.info');
        Route::patch('/profile/password',         [ProfileController::class, 'updatePassword'])->name('profile.update.password');
        Route::get('/candidatures/{candidature}/pdf', [CandidatureAdvancedController::class, 'exportPdf'])->name('candidatures.pdf');
    });

    // ── Accès Écriture (Middleware Gestionnaire) ──
    Route::middleware(['admin','can_manage'])->group(function () {
        Route::delete('/candidatures/{candidature}',      [DashboardController::class, 'candidatureDestroy'])->name('candidatures.destroy');
        Route::get('/export/candidatures',                [DashboardController::class, 'exportCandidatures'])->name('export.candidatures');
        Route::patch('/candidatures/{candidature}/noter', [CandidatureAdvancedController::class, 'noter'])->name('candidatures.noter');
        Route::patch('/candidatures/{candidature}/finaliste', [CandidatureAdvancedController::class, 'toggleFinaliste'])->name('candidatures.finaliste');
        Route::delete('/partenaires/{partenaire}',        [DashboardController::class, 'partenaireDestroy'])->name('partenaires.destroy');
        Route::delete('/messages/{message}',              [DashboardController::class, 'messageDestroy'])->name('messages.destroy');
        Route::post('/editions',                          [DashboardController::class, 'editionStore'])->name('editions.store');
        Route::post('/editions/{edition}/activate',       [DashboardController::class, 'editionActivate'])->name('editions.activate');
        Route::delete('/editions/{edition}',              [DashboardController::class, 'editionDestroy'])->name('editions.destroy');
        
        Route::get('/media',    [MediaController::class, 'index'])->name('media.index');
        Route::post('/media',   [MediaController::class, 'store'])->name('media.store');
        Route::delete('/media/{media}', [MediaController::class, 'destroy'])->name('media.destroy');
        Route::get('/backup/database',  [CandidatureAdvancedController::class, 'backupDatabase'])->name('backup.database');
    });

    // ── Accès Super-Admin (Configuration Système) ──
    Route::middleware(['admin','super_admin'])->group(function () {
        Route::get('/admins',                    [AdminManagementController::class, 'index'])->name('admins.index');
        Route::post('/admins',                   [AdminManagementController::class, 'store'])->name('admins.store');
        Route::patch('/admins/{admin}/delegate', [AdminManagementController::class, 'toggleDelegation'])->name('admins.delegate');
        Route::delete('/admins/{admin}',         [AdminManagementController::class, 'destroy'])->name('admins.destroy');
        
        Route::get('/smtp',        [SmtpController::class, 'show'])->name('smtp');
        Route::patch('/smtp',      [SmtpController::class, 'update'])->name('smtp.update');
        Route::post('/smtp/test',  [SmtpController::class, 'test'])->name('smtp.test');
        
        Route::get('/settings',    [SettingsController::class, 'show'])->name('settings');
        Route::patch('/settings',  [SettingsController::class, 'update'])->name('settings.update');
        
        Route::get('/newsletter/broadcast',  [NewsletterBroadcastController::class, 'show'])->name('newsletter.broadcast');
        Route::post('/newsletter/broadcast', [NewsletterBroadcastController::class, 'send'])->name('newsletter.broadcast.send');
    });
});