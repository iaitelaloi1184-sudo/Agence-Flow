<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
          UserSeeder::class,  // doit être en premier (référencé par Task, Comment)
          ClientSeeder::class, // doit être avant Campaign (référencé par Campaign)
          CampaignSeeder::class, // doit être avant Task (référencé par Task)
          TaskSeeder::class, // doit être avant Comment (référencé par Comment)
          CommentSeeder::class, 
          RoleSeeder::class,
          AssignRoleSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
