<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AssignRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::find(1)->assignRole('admin');
        User::find(2)->assignRole('employe');
        User::find(3)->assignRole('employe');
        User::find(4)->assignRole('employe');
        
    }
        
}
