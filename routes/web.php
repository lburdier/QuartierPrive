<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BienController;
use App\Http\Controllers\AgenceController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AgentBienController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PropertyController;

// Page d'accueil
Route::get('/', function () {
    return view('welcome');
})->name('home');

Auth::routes(); // Utiliser les routes d'authentification générées par laravel/ui

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
    Route::resource('patients', PatientController::class);

    // Incidents
    Route::resource('incidents', IncidentController::class);

    // Agents
    Route::resource('agents', AgentController::class);

    // Contact
    Route::get('/contact', [ContactController::class, 'showContactForm'])->name('contact');
    Route::post('/contact', [ContactController::class, 'sendContact'])->name('contact.send');

    // Properties
    Route::resource('properties', PropertyController::class);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
