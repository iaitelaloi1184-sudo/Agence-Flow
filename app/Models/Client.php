<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    // Colonnes que Laravel peut remplir
    protected $fillable = [
        'nom',
        'logo',
        'secteur',
        'reseaux_sociaux',
        'ton_communication',
        'email',
        'telephone',
    ];

    // Cast automatique du JSON en tableau PHP
    protected $casts = [
        'reseaux_sociaux' => 'array',
    ];

    // Relation : un client a plusieurs campagnes
    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }
}