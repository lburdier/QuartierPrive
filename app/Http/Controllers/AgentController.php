<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agent;

class AgentController extends Controller
{
    /**
     * Affiche une liste des agents.
     */
    public function index()
    {
        $agents = Agent::all();
        return view('agents.index', compact('agents'));
    }

    /**
     * Affiche le formulaire de création d'un agent.
     */
    public function create()
    {
        return view('agents.create');
    }

    /**
     * Enregistre un nouvel agent.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            // Ajoutez d'autres champs de validation si nécessaire
        ]);

        Agent::create($request->all());

        return redirect()->route('agents.index')->with('success', 'Agent créé avec succès.');
    }

    /**
     * Affiche un agent spécifique.
     */
    public function show($id)
    {
        $agent = Agent::findOrFail($id);
        return view('agents.show', compact('agent'));
    }

    /**
     * Affiche le formulaire de modification d'un agent.
     */
    public function edit($id)
    {
        $agent = Agent::findOrFail($id);
        return view('agents.edit', compact('agent'));
    }

    /**
     * Met à jour un agent.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            // Ajoutez d'autres champs de validation si nécessaire
        ]);

        $agent = Agent::findOrFail($id);
        $agent->update($request->all());

        return redirect()->route('agents.index')->with('success', 'Agent mis à jour avec succès.');
    }

    /**
     * Supprime un agent.
     */
    public function destroy($id)
    {
        $agent = Agent::findOrFail($id);
        $agent->delete();

        return redirect()->route('agents.index')->with('success', 'Agent supprimé avec succès.');
    }
}
