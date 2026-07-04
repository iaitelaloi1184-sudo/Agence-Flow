<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;
use app\Models\Campaign;
use app\Models\User;
class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    $campaign = Campaign::first();
        $employe = User::where('role', 'employe')->first();

        Task::create([
            'titre' => 'Créer visuel Instagram',
            'campaign_id' => $campaign->id,
            'user_id' => $employe->id,
            'statut' => 'a_faire',
            'priorite' => 'haute',
            'deadline' => now()->addDays(3),
            'description' => 'Visuel pour le post de lancement',
        ]);
    }
}
