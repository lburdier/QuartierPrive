<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BienController;
use App\Http\Controllers\AgenceController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AgentBienController;
use App\Http\Controllers\PatientController; // Ajouter cette ligne

// Page d'accueil
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Authentification
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes protégées par l'authentification
Route::middleware('auth')->group(function () {
    // Biens
    Route::prefix('biens')->group(function () {
        Route::get('/', [BienController::class, 'index'])->name('biens.index');
        Route::get('/{id}', [BienController::class, 'show'])->name('biens.show');
    });

    // Clients
    Route::resource('clients', ClientController::class)->except(['show']);
    Route::get('/clients/voir_biens', [ClientController::class, 'voirBiens'])->name('client.voir_biens');

    // Patients
    Route::resource('patients', PatientController::class); // Ajouter cette ligne
});
