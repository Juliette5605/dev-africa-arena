<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\OrientationController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminManagementController;
use App\Http\Controllers\Admin\PasswordResetController;
use App\Http\Controllers\Admin\TalentSyncController;

// ══ PAGES PUBLIQUES (avec mode maintenance) ═══════════════════════
Route::middleware('maintenance')->group(function () {
    Route::get('/',            [PageController::class, 'home'])->name('home');
    Route::get('/a-propos',    [PageController::class, 'aPropos'])->name('a-propos');
    Route::get('/valeurs',     [PageController::class, 'valeurs'])->name('valeurs');
    Route::get('/argument',    [PageController::class, 'argument'])->name('argument');
   Route::get('/orientation', [OrientationController::class, 'index'])
    ->name('orientation');
    Route::get('/contact',     [PageController::class, 'contact'])->name('contact');
    Route::get('/criteres',    [PageController::class, 'criteres'])->name('criteres');
    Route::get('/editions',    [PageController::class, 'editions'])->name('editions.public');

    Route::prefix('partenaires')->name('partenaires.')->group(function () {
        Route::get('/',           [PageController::class, 'partenaires'])->name('index');
        Route::get('/financier',  [PageController::class, 'partenairesFinancier'])->name('financier');
        Route::get('/techniques', [PageController::class, 'partenairesTechniques'])->name('techniques');
        Route::get('/sponsors',   [PageController::class, 'partenairesSponsors'])->name('sponsors');
    });

    // Formulaires — anti-spam
    Route::middleware('throttle:5,1')->group(function () {
        Route::post('/criteres',                [FormController::class, 'storeCandidature'])->name('criteres.store');
        Route::post('/contact',                 [FormController::class, 'storeContact'])->name('contact.store');
        Route::post('/partenaires/financier',   [FormController::class, 'storeFinancier'])->name('partenaires.financier.store');
        Route::post('/partenaires/techniques',  [FormController::class, 'storeTechnique'])->name('partenaires.techniques.store');
        Route::post('/partenaires/sponsors',    [FormController::class, 'storeSponsor'])->name('partenaires.sponsors.store');
        Route::post('/newsletter',              [NewsletterController::class, 'store'])->name('newsletter.store');
    });
});

// ══ AUTHENTIFICATION ADMIN ════════════════════════════════════════
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login',   [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',  [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/password/request',  [PasswordResetController::class, 'showRequest'])->name('password.request');
    Route::post('/password/request', [PasswordResetController::class, 'sendReset'])->name('password.request.send');
    Route::get('/password/reset',    [PasswordResetController::class, 'showResetForm'])->name('password.reset.form');
    Route::post('/password/reset',   [PasswordResetController::class, 'resetPassword'])->name('password.reset.update');
});

// ══ DASHBOARD & GESTION ADMIN ═════════════════════════════════════
Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    
    // ── Lecture & Dashboard ──
    Route::get('/',                               [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/candidatures',                   [DashboardController::class, 'candidatures'])->name('candidatures');
    Route::get('/candidatures/{candidature}',    [DashboardController::class, 'candidatureShow'])->name('candidatures.show');
    Route::get('/partenaires',                    [DashboardController::class, 'partenaires'])->name('partenaires');
    Route::get('/messages',                       [DashboardController::class, 'messages'])->name('messages');
    Route::get('/messages/{message}',            [DashboardController::class, 'messageShow'])->name('messages.show');
    Route::get('/newsletters',                    [DashboardController::class, 'newsletters'])->name('newsletters');
    Route::get('/editions',                       [DashboardController::class, 'editions'])->name('editions');
    Route::get('/logs',                           [DashboardController::class, 'logs'])->name('logs');
    Route::delete('/logs/{log}',                  [DashboardController::class, 'logDestroy'])->name('logs.destroy');
    Route::post('/logs/clear',                    [DashboardController::class, 'logsClear'])->name('logs.clear');
    Route::get('/finalistes',                     [\App\Http\Controllers\Admin\CandidatureAdvancedController::class, 'finalistes'])->name('finalistes');
    Route::get('/search',                         [\App\Http\Controllers\Admin\SearchController::class, 'search'])->name('search');
    Route::get('/qrcode',                         [\App\Http\Controllers\Admin\QrCodeController::class, 'show'])->name('qrcode');
    Route::get('/profile',                        [\App\Http\Controllers\Admin\ProfileController::class, 'show'])->name('profile');
    Route::patch('/profile/info',                 [\App\Http\Controllers\Admin\ProfileController::class, 'updateInfo'])->name('profile.update.info');
    Route::patch('/profile/password',             [\App\Http\Controllers\Admin\ProfileController::class, 'updatePassword'])->name('profile.update.password');
    Route::get('/candidatures/{candidature}/pdf', [\App\Http\Controllers\Admin\CandidatureAdvancedController::class, 'exportPdf'])->name('candidatures.pdf');

    // ── Orientation & TalentSync IA ──
    Route::get('/orientation',        [OrientationController::class, 'index'])->name('orientation');
    Route::get('/talentsync',         [TalentSyncController::class, 'index'])->name('talentsync');
    Route::post('/talentsync/cv',     [TalentSyncController::class, 'generateCV'])->name('talentsync.cv');
    Route::post('/talentsync/letter', [TalentSyncController::class, 'generateCoverLetter'])->name('talentsync.letter');
    Route::post('/talentsync/match',  [TalentSyncController::class, 'matchOpportunities'])->name('talentsync.match');
    Route::post('/talentsync/apply',  [TalentSyncController::class, 'autoApply'])->name('talentsync.apply');
    Route::get('/talentsync/status',  [TalentSyncController::class, 'applicationStatus'])->name('talentsync.status');

    // ── Écriture (Gestionnaires) ──
    Route::middleware('can_manage')->group(function () {
        Route::delete('/candidatures/{candidature}',          [DashboardController::class, 'candidatureDestroy'])->name('candidatures.destroy');
        Route::get('/export/candidatures',                    [DashboardController::class, 'exportCandidatures'])->name('export.candidatures');
        Route::patch('/candidatures/{candidature}/noter',     [\App\Http\Controllers\Admin\CandidatureAdvancedController::class, 'noter'])->name('candidatures.noter');
        Route::patch('/candidatures/{candidature}/finaliste', [\App\Http\Controllers\Admin\CandidatureAdvancedController::class, 'toggleFinaliste'])->name('candidatures.finaliste');
        Route::delete('/partenaires/{partenaire}',            [DashboardController::class, 'partenaireDestroy'])->name('partenaires.destroy');
        Route::delete('/messages/{message}',                  [DashboardController::class, 'messageDestroy'])->name('messages.destroy');
        Route::post('/editions',                              [DashboardController::class, 'editionStore'])->name('editions.store');
        Route::post('/editions/{edition}/activate',           [DashboardController::class, 'editionActivate'])->name('editions.activate');
        Route::delete('/editions/{edition}',                  [DashboardController::class, 'editionDestroy'])->name('editions.destroy');
        Route::get('/media',                                  [\App\Http\Controllers\Admin\MediaController::class, 'index'])->name('media.index');
        Route::post('/media',                                 [\App\Http\Controllers\Admin\MediaController::class, 'store'])->name('media.store');
        Route::delete('/media/{media}',                       [\App\Http\Controllers\Admin\MediaController::class, 'destroy'])->name('media.destroy');
        Route::get('/backup/database',                        [\App\Http\Controllers\Admin\CandidatureAdvancedController::class, 'backupDatabase'])->name('backup.database');
    });

    // ── Super-admin ──
    Route::middleware('super_admin')->group(function () {
        Route::get('/admins',                    [AdminManagementController::class, 'index'])->name('admins.index');
        Route::post('/admins',                   [AdminManagementController::class, 'store'])->name('admins.store');
        Route::patch('/admins/{admin}/delegate', [AdminManagementController::class, 'toggleDelegation'])->name('admins.delegate');
        Route::delete('/admins/{admin}',         [AdminManagementController::class, 'destroy'])->name('admins.destroy');
        Route::get('/smtp',                      [\App\Http\Controllers\Admin\SmtpController::class, 'show'])->name('smtp');
        Route::patch('/smtp',                    [\App\Http\Controllers\Admin\SmtpController::class, 'update'])->name('smtp.update');
        Route::post('/smtp/test',                [\App\Http\Controllers\Admin\SmtpController::class, 'test'])->name('smtp.test');
        Route::get('/settings',                  [\App\Http\Controllers\Admin\SettingsController::class, 'show'])->name('settings');
        Route::patch('/settings',                [\App\Http\Controllers\Admin\SettingsController::class, 'update'])->name('settings.update');
        Route::get('/newsletter/broadcast',      [\App\Http\Controllers\Admin\NewsletterBroadcastController::class, 'show'])->name('newsletter.broadcast');
        Route::post('/newsletter/broadcast',     [\App\Http\Controllers\Admin\NewsletterBroadcastController::class, 'send'])->name('newsletter.broadcast.send');
    });
});

// ══ CHATBOT PUBLIC ════════════════════════════════════════════════
Route::post('/chat', [TalentSyncController::class, 'chat'])
     ->middleware('throttle:20,1')
     ->name('chat.public');