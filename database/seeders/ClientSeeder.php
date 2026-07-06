<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Client;

class clientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Client::create([
            'nom' => 'Nike Maroc',
            'secteur' => 'Sport',
            'email' => 'contact@nike.ma',
            'telephone' => '0522000000',
            'ton_communication' => 'Dynamique',
            'reseaux_sociaux' => ['instagram', 'facebook'],
        ]);

        Client::create([
            'nom' => 'Café Central',
            'secteur' => 'Restauration',
            'email' => 'contact@cafecentral.ma',
            'telephone' => '0522111111',
            'ton_communication' => 'Chaleureux',
            'reseaux_sociaux' => ['instagram'],
        ]);
    }
}
