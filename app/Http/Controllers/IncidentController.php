<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incident;

class IncidentController extends Controller
{
    /**
     * Affiche une liste des incidents.
     */
    public function index()
    {
        $incidents = Incident::all();
        return view('incidents.index', compact('incidents'));
    }

    /**
     * Affiche le formulaire de création d'un incident.
     */
    public function create()
    {
        return view('incidents.create');
    }

    /**
     * Enregistre un nouvel incident.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            // Ajoutez d'autres champs de validation si nécessaire
        ]);

        Incident::create($request->all());

        return redirect()->route('incidents.index')->with('success', 'Incident créé avec succès.');
    }

    /**
     * Affiche un incident spécifique.
     */
    public function show($id)
    {
        $incident = Incident::findOrFail($id);
        return view('incidents.show', compact('incident'));
    }

    /**
     * Affiche le formulaire de modification d'un incident.
     */
    public function edit($id)
    {
        $incident = Incident::findOrFail($id);
        return view('incidents.edit', compact('incident'));
    }

    /**
     * Met à jour un incident.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            // Ajoutez d'autres champs de validation si nécessaire
        ]);

        $incident = Incident::findOrFail($id);
        $incident->update($request->all());

        return redirect()->route('incidents.index')->with('success', 'Incident mis à jour avec succès.');
    }

    /**
     * Supprime un incident.
     */
    public function destroy($id)
    {
        $incident = Incident::findOrFail($id);
        $incident->delete();

        return redirect()->route('incidents.index')->with('success', 'Incident supprimé avec succès.');
    }
}
