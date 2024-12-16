<?php

namespace App\Http\Controllers;

use App\Models\Bien;
use App\Models\Agence;
use App\Models\Agent;
use App\Models\Client;
use Illuminate\Http\Request;

class AgenceController extends Controller
{
    public function index()
    {
        \$agences = Agence::all();
        return view('agences.index', compact('agences'));
    }

    public function show(\$id)
    {
        \$agence = Agence::with(['agents', 'clients', 'biens'])->findOrFail(\$id);
        return view('agences.show', compact('agence'));
    }

    public function create()
    {
        return view('agences.create');
    }

    public function store(Request \$request)
    {
        \$validatedData = \$request->validate([
        'nom_agence' => 'required|string|max:255',
        'adresse' => 'required|string|max:255',
        'cp' => 'required|numeric',
        'ville' => 'required|string|max:255',
        'region' => 'required|string|max:255',
        'pays' => 'required|string|max:255',
        'telephone' => 'required|string|max:20',
        'email' => 'required|email|unique:agence,email',
        'statut' => 'required|string|max:50',
    ]);

        Agence::create(\$validatedData);

        return redirect()->route('agences.index')->with('success', 'Agence créée avec succès.');
    }

    public function edit(\$id)
    {
        \$agence = Agence::findOrFail(\$id);
        return view('agences.edit', compact('agence'));
    }

    public function update(Request \$request, \$id)
    {
        \$validatedData = \$request->validate([
        'nom_agence' => 'required|string|max:255',
        'adresse' => 'required|string|max:255',
        'cp' => 'required|numeric',
        'ville' => 'required|string|max:255',
        'region' => 'required|string|max:255',
        'pays' => 'required|string|max:255',
        'telephone' => 'required|string|max:20',
        'email' => 'required|email|unique:agence,email,' . \$id,
            'statut' => 'required|string|max:50',
        ]);

        \$agence = Agence::findOrFail(\$id);
        \$agence->update(\$validatedData);

        return redirect()->route('agences.index')->with('success', 'Agence mise à jour avec succès.');
    }

    public function destroy(\$id)
    {
        \$agence = Agence::findOrFail(\$id);
        \$agence->delete();

        return redirect()->route('agences.index')->with('success', 'Agence supprimée avec succès.');
    }
}
