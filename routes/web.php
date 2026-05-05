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
use App\Http\Controllers\FeedController; // <--- Importation ajoutée ici
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

Route::post('/webhook/vote-confirm', [VoteController::class, 'confirmWebhook'])
    ->withoutMiddleware(['web'])
    ->name('vote.webhook');

// ── PAGE D'ACCUEIL & CSRF ─────────────────────────────────────────────────
Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/csrf-token', function (Request $request) {
    $request->session()->regenerateToken();
    return response()->json(['token' => csrf_token()]);
})->name('csrf.refresh');

// ── PAGES PUBLIQUES ───────────────────────────────────────────────────────
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

// Partenaires
Route::prefix('partenaires')->name('partenaires.')->group(function () {
    Route::get('/', [PageController::class, 'partenaires'])->name('index');
    Route::get('/financier', [PageController::class, 'partenairesFinancier'])->name('financier');
    Route::get('/techniques', [PageController::class, 'partenairesTechniques'])->name('techniques');
    Route::get('/sponsors', [PageController::class, 'partenairesSponsors'])->name('sponsors');

    Route::post('/financier', fn() => back()->with('success', 'Envoyé.'))->name('financier.store');
    Route::post('/techniques', fn() => back()->with('success', 'Envoyé.'))->name('techniques.store');
    Route::post('/sponsors', fn() => back()->with('success', 'Envoyé.'))->name('sponsors.store');
});

/*
|--------------------------------------------------------------------------
| PAGES PROTÉGÉES (Utilisateurs connectés)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    
    // --- NOUVELLES ROUTES DU FEED COMMUNAUTAIRE ---
    Route::get('/feed', [FeedController::class, 'index'])->name('feed.index');
    Route::post('/feed', [FeedController::class, 'store'])->name('feed.store');
    Route::delete('/feed/{post}', [FeedController::class, 'destroy'])->name('feed.destroy');
    Route::post('/feed/{post}/like', [FeedController::class, 'like'])->name('feed.like');
    Route::post('/feed/{post}/comment', [FeedController::class, 'comment'])->name('feed.comment');
    Route::post('/feed/follow/{user}', [FeedController::class, 'follow'])->name('feed.follow');
    Route::get('/feed/u/{user}', [FeedController::class, 'profile'])->name('feed.profile');
    // ----------------------------------------------

    Route::get('/orientation', [OrientationController::class, 'index'])->name('orientation');
    Route::post('/orientation', [OrientationController::class, 'interrogerIA'])->name('orientation.ask');

    Route::get('/quiz-arena', [ArenaController::class, 'startQuiz'])->name('quiz.play');
    Route::post('/quiz-arena/check', [ArenaController::class, 'checkAnswer'])->name('quiz.check');
    Route::get('/forum-arena', [ArenaController::class, 'forumIndex'])->name('forum.index');
    Route::post('/forum-arena/store', [ArenaController::class, 'forumStore'])->name('forum.store');
    Route::post('/forum-arena/{thread}/reply', [ArenaController::class, 'forumReply'])->name('forum.reply');
    Route::get('/forum-arena/{thread}', [ArenaController::class, 'forumShow'])->name('forum.show');
});

/*
|--------------------------------------------------------------------------
| ADMINISTRATION (Prefix: admin)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware(['auth:admin'])->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('search', [SearchController::class, 'search'])->name('search');

        // Candidatures
        Route::get('candidatures', [DashboardController::class, 'candidatures'])->name('candidatures');
        Route::get('candidatures/{candidature}', [DashboardController::class, 'candidatureShow'])->name('candidatures.show');
        Route::delete('candidatures/{candidature}', [DashboardController::class, 'candidatureDestroy'])->name('candidatures.destroy');

        // Votes
        Route::get('votes', [VoteAdminController::class, 'index'])->name('votes.index');
        Route::post('votes/generate/{candidatureId}', [VoteAdminController::class, 'generateLink'])->name('votes.generate');

        // ... Autres routes admin (Settings, SMTP, Media, etc.) ...
        Route::get('settings', [SettingsController::class, 'show'])->name('settings');
        Route::post('settings', [SettingsController::class, 'update'])->name('settings.update');
    });
});

/*
|--------------------------------------------------------------------------
| DASHBOARD PARTICIPANT (Breeze)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', ParticipantDashboardController::class)->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php'; 