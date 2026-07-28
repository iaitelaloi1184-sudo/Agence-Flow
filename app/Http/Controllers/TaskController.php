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
            $query = Task::with(['campaign', 'user'])
                ->where('campaign_id', $selectedCampaignId);

            // Un employé ne voit que ses propres tâches
            if (auth()->user()->role !== 'admin') {
                $query->where('user_id', auth()->id());
            }

            $tasks = $query->get();
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

        $task = Task::create($request->all());
        $task->user->notify(new \App\Notifications\TaskAssigned($task));

        return redirect()->route('tasks.index')->with('success', 'Tâche créée avec succès !');
    }

    public function show(string $id)
    {
        $task = Task::with(['campaign', 'user', 'comments'])->findOrFail($id);

        if (auth()->user()->role !== 'admin' && $task->user_id !== auth()->id()) {
            abort(403, 'Vous ne pouvez consulter que vos propres tâches.');
        }

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
        // Un employé ne peut modifier que ses propres tâches
        if (auth()->user()->role !== 'admin' && $task->user_id !== auth()->id()) {
            abort(403, 'Vous ne pouvez modifier que vos propres tâches.');
        }

        $request->validate([
            'statut' => 'required|in:a_faire,en_cours,en_revision,termine',
        ]);

        $task->update(['statut' => $request->statut]);

        return response()->json(['success' => true]);
    }
    public function addComment(Request $request, Task $task)
    {
        if (auth()->user()->role !== 'admin' && $task->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'contenu' => 'required|string|max:1000',
        ]);

        $task->comments()->create([
            'user_id' => auth()->id(),
            'contenu' => $request->contenu,
        ]);

        return back()->with('success', 'Commentaire ajouté !');
    }
}