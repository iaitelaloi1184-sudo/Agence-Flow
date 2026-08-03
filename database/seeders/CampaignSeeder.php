<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Campaign;
use App\Models\Client;
class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    $nike = Client::where('nom', 'Nike Maroc')->first();

        Campaign::create([
            'nom' => 'Lancement collection été',
            'client_id' => $nike->id,
            'date_debut' => now(),
            'date_fin' => now()->addMonth(),
            'objectifs' => 'Augmenter la visibilité sur Instagram',
            'statut' => 'en_cours',
        ]);
    }
}
