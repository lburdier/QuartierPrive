<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BienController;
use App\Http\Controllers\AgenceController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AgentBienController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

// Welcome Page Route
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Routes pour les biens (public)
Route::prefix('biens')->group(function () {
    Route::get('/', [BienController::class, 'index'])->name('biens.index'); // Liste paginée des biens
    Route::get('/search', [BienController::class, 'search'])->name('biens.search'); // Recherche avancée des biens
    Route::get('/{id}', [BienController::class, 'show'])->name('biens.show'); // Détails d'un bien
});

// Route pour la liste complète des biens (sans pagination, protégée par authentification client)
Route::middleware('auth:client')->get('/client/voir-les-biens', [BienController::class, 'voirLesBiens'])->name('client.voir_les_biens');

// Routes pour les agences (public)
Route::prefix('agences')->group(function () {
    Route::get('/', [AgenceController::class, 'index'])->name('agences.index'); // Liste des agences
    Route::get('/{id}', [AgenceController::class, 'show'])->name('agences.show'); // Détails d'une agence
});

// Routes pour l'authentification
Route::prefix('auth')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login'); // Formulaire de connexion
    Route::post('/login', [AuthController::class, 'login'])->name('login.post'); // Traitement de la connexion
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); // Déconnexion
});

// Routes protégées pour les clients
Route::middleware(['auth:client'])->prefix('client')->group(function () {
    Route::get('/dashboard', [ClientController::class, 'dashboard'])->name('client.dashboard'); // Tableau de bord du client
    Route::put('/profile', [ClientController::class, 'updateProfile'])->name('client.update'); // Mise à jour du profil
    Route::get('/biens', [BienController::class, 'index'])->name('client.biens.index'); // Liste des biens pour les clients
});

// Routes protégées pour les agents
Route::middleware(['auth:agent'])->prefix('agent')->group(function () {
    Route::get('/dashboard', [AgentBienController::class, 'dashboard'])->name('agent.dashboard'); // Tableau de bord de l'agent
    Route::resource('/biens', AgentBienController::class); // Gestion des biens par les agents
});

// Routes pour la réinitialisation de mot de passe
Route::prefix('password')->group(function () {
    Route::get('/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request'); // Formulaire pour demander un lien de réinitialisation
    Route::post('/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email'); // Envoi du lien de réinitialisation
    Route::get('/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset'); // Formulaire pour réinitialiser le mot de passe
    Route::post('/reset', [ResetPasswordController::class, 'reset'])->name('password.update'); // Traitement de la réinitialisation
});
