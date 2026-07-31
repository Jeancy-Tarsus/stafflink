<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [

        'nom',
        'type',
        'responsable',
        'fonction',

        'telephone',
        'telephone_secondaire',
        'email',
        'adresse',
        'ville',

        'secteur_activite',
        'rccm',
        'niu',

        'actif',

        'observation',

    ];
}
