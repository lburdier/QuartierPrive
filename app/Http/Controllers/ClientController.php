<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Affiche le tableau de bord du client.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function dashboard()
    {
        // Vérifie si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['error' => 'Veuillez vous connecter pour accéder au tableau de bord.']);
        }

        $client = Auth::user();

        // Récupère les biens favoris liés au client (relation définie dans le modèle)
        $favoriteProperties = $client->favoriteBiens ?? collect();

        return view('clients.dashboard', compact('favoriteProperties'));
    }

    /**
     * Met à jour le profil du client.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(Request $request)
    {
        // Vérifie si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['error' => 'Veuillez vous connecter pour mettre à jour votre profil.']);
        }

        $client = Auth::user();

        // Validation des données d'entrée
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email,' . $client->id,
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
        ]);

        // Met à jour les informations du client
        $client->update($validatedData);

        return redirect()->back()->with('success', 'Profil mis à jour avec succès.');
    }
}
