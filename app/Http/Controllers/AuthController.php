<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Affiche le formulaire de connexion.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Gère la connexion de l'utilisateur.
     */
    public function login(Request $request)
    {
        // Validation des données d'entrée
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // Recherche de l'utilisateur dans la base de données
        $user = \App\Models\User::where('email', $validatedData['email'])->first();

        if ($user && Hash::check($validatedData['password'], $user->mot_de_passe)) {
            // Générer un jeton unique pour la session
            $sessionToken = Str::random(60);
            session(['user_token' => $sessionToken]);

            // Authentification réussie
            Auth::login($user);

            // Redirection vers la page "voir les biens"
            return redirect()->route('client.voir_biens')->with('success', 'Connexion réussie');
        }

        // Gestion des erreurs
        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'Aucun utilisateur trouvé avec cet email.']);
        }

        return redirect()->back()->withErrors(['password' => 'Mot de passe incorrect.']);
    }

    /**
     * Gère la déconnexion de l'utilisateur.
     */
    public function logout()
    {
        // Supprimer le jeton de session
        session()->forget('user_token');

        // Déconnexion de l'utilisateur
        Auth::logout();

        return redirect()->route('home')->with('success', 'Déconnexion réussie');
    }
}
