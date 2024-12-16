<?php

namespace App\Http\Controllers;

use App\Models\Bien;
use Illuminate\Http\Request;

class AgentBienController extends Controller
{
    public function index()
    {
        $biens = Bien::all();
        return view('agent.biens.index', compact('biens'));
    }

    public function show($id)
    {
        $bien = Bien::findOrFail($id);
        return view('agent.biens.show', compact('bien'));
    }

    public function create()
    {
        return view('agent.biens.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'location' => 'required|string|max:255',
        ]);

        Bien::create($validatedData);

        return redirect()->route('agent.biens.index')->with('success', 'Bien créé avec succès.');
    }

    public function edit($id)
    {
        $bien = Bien::findOrFail($id);
        return view('agent.biens.edit', compact('bien'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'location' => 'required|string|max:255',
        ]);

        $bien = Bien::findOrFail($id);
        $bien->update($validatedData);

        return redirect()->route('agent.biens.index')->with('success', 'Bien mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $bien = Bien::findOrFail($id);
        $bien->delete();

        return redirect()->route('agent.biens.index')->with('success', 'Bien supprimé avec succès.');
    }
}
