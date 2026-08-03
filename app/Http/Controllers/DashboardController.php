<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Campaign;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_clients' => Client::count(),
            'projets_en_cours' => Campaign::where('statut', 'en_cours')->count(),
            'taches_terminees' => Task::where('statut', 'termine')->count(),
            'taches_retard' => Task::where('statut', '!=', 'termine')
                ->where('deadline', '<', now())
                ->count(),
        ];

        $taches_urgentes = Task::with(['campaign', 'user'])
            ->where('statut', '!=', 'termine')
            ->where('priorite', '=', 'haute')
            ->orderBy('deadline')
            ->take(5)
            ->get();

        return view('dashboard', compact('stats', 'taches_urgentes'));
    }
}