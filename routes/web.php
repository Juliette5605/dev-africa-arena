<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminManagementController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\NewsletterBroadcastController;
use App\Http\Controllers\Admin\PasswordResetController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\QrCodeController;
use App\Http\Controllers\Admin\SearchController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SmtpController;
use App\Http\Controllers\Admin\DevAfricaArenaController;
use App\Http\Controllers\Admin\VoteAdminController;
use App\Http\Controllers\OrientationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ParticipantDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ArenaController;
use App\Http\Controllers\VoteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - DevAfricaArena
|--------------------------------------------------------------------------
*/

// ── VOTE PUBLIC (accessible SANS connexion) ───────────────────────────────
Route::get('/vote', [VoteController::class, 'leaderboard'])->name('vote.leaderboard');
Route::get('/vote/{slug}', [VoteController::class, 'profil'])->name('vote.profil');
Route::post('/vote/{slug}', [VoteController::class, 'store'])
    ->middleware('throttle:10,1')
    ->name('vote.store');

// Webhook paiement Flooz/T-Money (pas de CSRF)
Route::post('/webhook/vote-confirm', [VoteController::class, 'confirmWebhook'])
    ->withoutMiddleware(['web'])
    ->name('vote.webhook');

// ── PAGE D'ACCUEIL (publique) ─────────────────────────────────────────────
Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/csrf-token', function (Request $request) {
    $request->session()->regenerateToken();
    return response()->json(['token' => csrf_token()]);
})->name('csrf.refresh');

// ── PAGES PUBLIQUES (sans connexion) ─────────────────────────────────────
Route::get('/a-propos', [PageController::class, 'aPropos'])->name('a-propos');
Route::get('/valeurs', [PageController::class, 'valeurs'])->name('valeurs');
Route::get('/argument', [PageController::class, 'argument'])->name('argument');
Route::get('/editions', [PageController::class, 'editions'])->name('editions');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [FormController::class, 'storeContact'])->name('contact.store');

Route::get('/criteres', [PageController::class, 'criteres'])->name('criteres');
Route::post('/criteres', [FormController::class, 'storeCandidature'])->name('criteres.store');

Route::post('/newsletter-store', [NewsletterController::class, 'store'])->name('newsletter.store');

Route::post('/chat/public', function (Request $request) {
    $message = $request->input('message');
    return response()->json([
        'reply' => "Merci pour votre message : '$message'. L'assistant IA est en cours de configuration."
    ]);
})->name('chat.public');

// Partenaires (publiques)
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

// ── PAGES PROTÉGÉES (candidats connectés uniquement) ─────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/orientation', [OrientationController::class, 'index'])->name('orientation');
    Route::post('/orientation', [OrientationController::class, 'interrogerIA'])->name('orientation.ask');

    // Quiz & Forum
    Route::get('/quiz-arena', [ArenaController::class, 'startQuiz'])->name('quiz.play');
    Route::post('/quiz-arena/check', [ArenaController::class, 'checkAnswer'])->name('quiz.check');
    Route::get('/forum-arena', [ArenaController::class, 'forumIndex'])->name('forum.index');
    Route::post('/forum-arena/store', [ArenaController::class, 'forumStore'])->name('forum.store');
    Route::post('/forum-arena/{thread}/reply', [ArenaController::class, 'forumReply'])->name('forum.reply');
    Route::get('/forum-arena/{thread}', [ArenaController::class, 'forumShow'])->name('forum.show');
});

/*
|--------------------------------------------------------------------------
| ADMINISTRATION (Prefix: admin | Name: admin.)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {

    // Auth Admin
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post'); // Corrigé ici
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // Reset mot de passe admin
    Route::get('forgot-password', [PasswordResetController::class, 'showRequest'])->name('password.request');
    Route::post('forgot-password', [PasswordResetController::class, 'sendReset'])->name('password.request.send');
    Route::get('reset-password', [PasswordResetController::class, 'showResetForm'])->name('password.reset.form');
    Route::post('reset-password', [PasswordResetController::class, 'resetPassword'])->name('password.reset.update');

    // Zone protégée admin
    Route::middleware(['auth:admin'])->group(function () {

        // Dashboard & Recherche
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        // Route search à corriger si besoin
        Route::get('search', [SearchController::class, 'search'])->name('search');

        // Candidatures
        Route::get('candidatures', [DashboardController::class, 'candidatures'])->name('candidatures');
        Route::get('candidatures/{candidature}/dashboard', [DashboardController::class, 'candidatureDashboard'])->name('candidatures.dashboard');
        Route::get('candidatures/{candidature}', [DashboardController::class, 'candidatureShow'])->name('candidatures.show');
        Route::get('candidatures/{candidature}/pdf', [DashboardController::class, 'candidaturePdf'])->name('candidatures.pdf');
        Route::patch('candidatures/{candidature}/finaliste', [DashboardController::class, 'candidatureToggleFinaliste'])->name('candidatures.finaliste');
        Route::patch('candidatures/{candidature}/noter', [DashboardController::class, 'candidatureNoter'])->name('candidatures.noter');
        Route::delete('candidatures/{candidature}', [DashboardController::class, 'candidatureDestroy'])->name('candidatures.destroy');

        // Messages
        Route::get('messages', [DashboardController::class, 'messages'])->name('messages');
        Route::get('messages/{message}', [DashboardController::class, 'messageShow'])->name('messages.show');
        Route::delete('messages/{message}', [DashboardController::class, 'messageDestroy'])->name('messages.destroy'); // Corrigé ici

        // Newsletter
        Route::get('newsletters', [DashboardController::class, 'newsletters'])->name('newsletters');
        Route::get('newsletter/broadcast', [NewsletterBroadcastController::class, 'show'])->name('newsletter.broadcast');
        Route::post('newsletter/broadcast', [NewsletterBroadcastController::class, 'send'])->name('newsletter.broadcast.send');

        // Finalistes & Partenaires
        Route::get('finalistes', [DashboardController::class, 'finalistes'])->name('finalistes');
        Route::get('partenaires', [DashboardController::class, 'partenaires'])->name('partenaires');
        Route::delete('partenaires/{partenaire}', [DashboardController::class, 'partenaireDestroy'])->name('partenaires.destroy');

        // Éditions
        Route::get('editions', [DashboardController::class, 'editions'])->name('editions');
        Route::post('editions', [DashboardController::class, 'editionStore'])->name('editions.store');
        Route::post('editions/{edition}/activate', [DashboardController::class, 'editionActivate'])->name('editions.activate');
        Route::delete('editions/{edition}', [DashboardController::class, 'editionDestroy'])->name('editions.destroy');

        // ── SYSTÈME DE VOTE ──────────────────────────────────────────────
        Route::get('votes', [VoteAdminController::class, 'index'])->name('votes.index');
        Route::post('votes/generate/{candidatureId}', [VoteAdminController::class, 'generateLink'])->name('votes.generate');
        Route::post('votes/toggle/{candidatureId}', [VoteAdminController::class, 'toggleLink'])->name('votes.toggle');
        Route::get('votes/export', [VoteAdminController::class, 'exportCsv'])->name('votes.export');

        // Outils IA / DevAfrica
        Route::get('devafricaarena', [DevAfricaArenaController::class, 'index'])->name('devafricaarena');
        Route::post('devafricaarena/cv', [DevAfricaArenaController::class, 'generateCV'])->name('devafricaarena.cv');
        Route::post('devafricaarena/letter', [DevAfricaArenaController::class, 'generateCoverLetter'])->name('devafricaarena.letter');
        Route::post('devafricaarena/match', [DevAfricaArenaController::class, 'matchOpportunities'])->name('devafricaarena.match');
        Route::post('devafricaarena/apply', [DevAfricaArenaController::class, 'autoApply'])->name('devafricaarena.apply');
        Route::get('devafricaarena/status', [DevAfricaArenaController::class, 'applicationStatus'])->name('devafricaarena.status');

        // QR Code, Médias, Logs
        Route::get('qrcode', [QrCodeController::class, 'show'])->name('qrcode');
        Route::get('media', [MediaController::class, 'index'])->name('media.index');
        Route::post('media', [MediaController::class, 'store'])->name('media.store');
        Route::delete('media/{media}', [MediaController::class, 'destroy'])->name('media.destroy');

        Route::get('logs', [DashboardController::class, 'logs'])->name('logs');
        Route::post('logs/clear', [DashboardController::class, 'logsClear'])->name('logs.clear');
        Route::delete('logs/{log}', [DashboardController::class, 'logDestroy'])->name('logs.destroy');

        // Export & Backup
        Route::get('export/candidatures', [DashboardController::class, 'exportCandidatures'])->name('export.candidatures');
        Route::get('backup/database', [DashboardController::class, 'backupDatabase'])->name('backup.database');

        // Gestion admins
        Route::get('admins', [AdminManagementController::class, 'index'])->name('admins.index');
        Route::post('admins', [AdminManagementController::class, 'store'])->name('admins.store');
        Route::post('admins/{admin}/delegate', [AdminManagementController::class, 'toggleDelegation'])->name('admins.delegate');
        Route::delete('admins/{admin}', [AdminManagementController::class, 'destroy'])->name('admins.destroy');

        // Config
        Route::get('smtp', [SmtpController::class, 'show'])->name('smtp');
        Route::post('smtp', [SmtpController::class, 'update'])->name('smtp.update');
        Route::post('smtp/test', [SmtpController::class, 'test'])->name('smtp.test');
        Route::get('settings', [SettingsController::class, 'show'])->name('settings');
        Route::post('settings', [SettingsController::class, 'update'])->name('settings.update');

        // Profil admin
        Route::get('profile', [AdminProfileController::class, 'show'])->name('profile');
        Route::post('profile/info', [AdminProfileController::class, 'updateInfo'])->name('profile.update.info');
        Route::post('profile/password', [AdminProfileController::class, 'updatePassword'])->name('profile.update.password');
    });
});

/*
|--------------------------------------------------------------------------
| ZONE UTILISATEUR CONNECTÉ (Breeze/Standard)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', ParticipantDashboardController::class)->name('dashboard');
    Route::post('/dashboard/ai/cv', [ParticipantDashboardController::class, 'generateCv'])->name('dashboard.ai.cv');
    Route::post('/dashboard/ai/letter', [ParticipantDashboardController::class, 'generateCoverLetter'])->name('dashboard.ai.letter');
    Route::post('/dashboard/ai/match', [ParticipantDashboardController::class, 'matchOpportunities'])->name('dashboard.ai.match');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';