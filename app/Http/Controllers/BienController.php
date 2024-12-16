<?php

namespace App\Http\Controllers;

use App\Models\Bien;
use Illuminate\Http\Request;

class BienController extends Controller
{
    /**
     * Affiche la liste paginée des biens disponibles.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Récupère les biens disponibles et paginés
        $biens = Bien::where('disponibilite', 'Disponible')
            ->latest('created_at') // Tri par date de création (du plus récent au plus ancien)
            ->paginate(10);

        return view('biens.index', compact('biens'));
    }

    /**
     * Affiche tous les biens disponibles sans pagination.
     *
     * @return \Illuminate\View\View
     */
    public function voirLesBiens()
    {
        // Chargement des biens avec leurs relations nécessaires (agent, agence)
        $biens = Bien::with(['agent', 'agence'])
            ->where('disponibilite', 'Disponible') // Filtre uniquement les biens disponibles
            ->get();

        return view('biens.voir_les_biens', compact('biens'));
    }
}
