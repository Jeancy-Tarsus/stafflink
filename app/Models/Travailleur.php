<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Travailleur extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'sexe',
        'date_naissance',
        'telephone',
        'email',
        'adresse',
        'metier_id',
        'experience',
        'salaire_souhaite',
        'disponible',
        'actif',
        'photo',
        'observation',
    ];

    protected $casts = [
        'date_naissance' => 'date',
        'disponible' => 'boolean',
        'actif' => 'boolean',
    ];

    public function metier()
    {
        return $this->belongsTo(Metier::class);
    }

    public function affectations()
    {
        return $this->hasMany(Affectation::class);
    }
}
