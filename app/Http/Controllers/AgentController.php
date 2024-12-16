<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function index()
    {
        \$agents = Agent::all();
        return view('agents.index', compact('agents'));
    }

    public function show(\$id)
    {
        \$agent = Agent::findOrFail(\$id);
        return view('agents.show', compact('agent'));
    }

    public function create()
    {
        return view('agents.create');
    }

    public function store(Request \$request)
    {
        \$validatedData = \$request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:agents',
        'phone' => 'required|string|max:15',
    ]);

        Agent::create(\$validatedData);

        return redirect()->route('agents.index')->with('success', 'Agent créé avec succès.');
    }

    public function edit(\$id)
    {
        \$agent = Agent::findOrFail(\$id);
        return view('agents.edit', compact('agent'));
    }

    public function update(Request \$request, \$id)
    {
        \$validatedData = \$request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:agents,email,' . \$id,
            'phone' => 'required|string|max:15',
        ]);

        \$agent = Agent::findOrFail(\$id);
        \$agent->update(\$validatedData);

        return redirect()->route('agents.index')->with('success', 'Agent mis à jour avec succès.');
    }

    public function destroy(\$id)
    {
        \$agent = Agent::findOrFail(\$id);
        \$agent->delete();

        return redirect()->route('agents.index')->with('success', 'Agent supprimé avec succès.');
    }
}
