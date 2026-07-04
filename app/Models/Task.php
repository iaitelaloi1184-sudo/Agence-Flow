<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'titre',
        'campaign_id',
        'user_id',
        'statut',
        'priorite',
        'deadline',
        'description',
    ];

    protected $casts = [
        'deadline' => 'date',
    ];

    // Une tâche appartient à une campagne
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    // Une tâche appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Une tâche a plusieurs commentaires
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}