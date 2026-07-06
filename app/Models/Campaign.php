<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = [
        'nom',
        'client_id',
        'date_debut',
        'date_fin',
        'objectifs',
        'statut',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
    ];

    // Une campagne appartient à un client
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // Une campagne a plusieurs tâches
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}