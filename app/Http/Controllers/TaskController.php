<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Campaign;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
{
    $campaigns = Campaign::all();
    $selectedCampaignId = $request->query('campaign_id');

    $tasks = collect();
    if ($selectedCampaignId) {
        $tasks = Task::with(['campaign', 'user'])
            ->where('campaign_id', $selectedCampaignId)
            ->get();
    }

    return view('tasks.index', compact('tasks', 'campaigns', 'selectedCampaignId'));
}
    public function create()
    {
        $campaigns = Campaign::all();
        $users = User::all();
        return view('tasks.create', compact('campaigns', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'campaign_id' => 'required|exists:campaigns,id',
            'user_id' => 'required|exists:users,id',
            'priorite' => 'required|in:haute,moyenne,basse',
            'statut' => 'required|in:a_faire,en_cours,en_revision,termine',
            'deadline' => 'nullable|date',
            'description' => 'nullable|string',
        ]);

        Task::create($request->all());

        return redirect()->route('tasks.index')->with('success', 'Tâche créée avec succès !');
    }

    public function show(string $id)
    {
        $task = Task::with(['campaign', 'user', 'comments'])->findOrFail($id);
        return view('tasks.show', compact('task'));
    }

    public function edit(string $id)
    {
        $task = Task::findOrFail($id);
        $campaigns = Campaign::all();
        $users = User::all();
        return view('tasks.edit', compact('task', 'campaigns', 'users'));
    }

    public function update(Request $request, string $id)
    {
        $task = Task::findOrFail($id);

        $request->validate([
            'titre' => 'required|string|max:255',
            'campaign_id' => 'required|exists:campaigns,id',
            'user_id' => 'required|exists:users,id',
            'priorite' => 'required|in:haute,moyenne,basse',
            'statut' => 'required|in:a_faire,en_cours,en_revision,termine',
            'deadline' => 'nullable|date',
            'description' => 'nullable|string',
        ]);

        $task->update($request->all());

        return redirect()->route('tasks.index')->with('success', 'Tâche mise à jour !');
    }

    public function destroy(string $id)
    {
        Task::findOrFail($id)->delete();
        return redirect()->route('tasks.index')->with('success', 'Tâche supprimée !');
    }
    public function updateStatus(Request $request, Task $task)
    {
        $request->validate([
            'statut' => 'required|in:a_faire,en_cours,en_revision,termine',
        ]);

        $task->update(['statut' => $request->statut]);

        return response()->json(['success' => true]);
    }
}