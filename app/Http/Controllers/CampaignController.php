<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Client;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index()
    {

        $campaigns = Campaign::with('client')->get();
        return view('campaigns.index', compact('campaigns'));

    }

    public function create()
    {
        $clients = Client::all();
        return view('campaigns.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'client_id' => 'required|exists:clients,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
            'objectifs' => 'nullable|string',
            'statut' => 'required|in:en_cours,termine,pause',
        ]);

        Campaign::create($request->all());

        return redirect()->route('campaigns.index')->with('success', 'Campagne créée avec succès !');
    }

    public function show(string $id)
    {
        $campaign = Campaign::with(['client', 'tasks'])->findOrFail($id);
        return view('campaigns.show', compact('campaign'));
    }

    public function edit(string $id)
    {
        $campaign = Campaign::findOrFail($id);
        $clients = Client::all();
        return view('campaigns.edit', compact('campaign', 'clients'));
    }

    public function update(Request $request, string $id)
{
    $campaign = Campaign::with('tasks')->findOrFail($id);

    $request->validate([
        'nom' => 'required|string|max:255',
        'client_id' => 'required|exists:clients,id',
        'date_debut' => 'required|date',
        'date_fin' => 'required|date|after:date_debut',
        'objectifs' => 'nullable|string',
        'statut' => 'required|in:en_cours,termine,pause',
    ]);

    // Empêche de marquer "terminé" si des tâches ne sont pas terminées
    if ($request->statut === 'termine') {
        $tachesNonTerminees = $campaign->tasks->where('statut', '!=', 'termine')->count();

        if ($tachesNonTerminees > 0) {
            return back()
                ->withInput()
                ->withErrors(['statut' => "Impossible de terminer cette campagne : {$tachesNonTerminees} tâche(s) ne sont pas encore terminée(s)."]);
        }
    }

    $campaign->update($request->all());

    return redirect()->route('campaigns.index')->with('success', 'Campagne mise à jour !');
}
    public function destroy(string $id)
    {
        Campaign::findOrFail($id)->delete();
        return redirect()->route('campaigns.index')->with('success', 'Campagne supprimée !');
    }
}