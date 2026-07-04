<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use app\Models\Comment;
use app\Models\Task;
use app\Models\user;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    $task = Task::first();
        $employe = User::where('role', 'employe')->first();

        Comment::create([
            'task_id' => $task->id,
            'user_id' => $employe->id,
            'contenu' => 'Premier brouillon envoyé, en attente de validation.',
        ]);

        Comment::create([
            'task_id' => $task->id,
            'user_id' => $employe->id,
            'contenu' => 'Modification faite selon les retours du client.',
        ]);
    }
}
