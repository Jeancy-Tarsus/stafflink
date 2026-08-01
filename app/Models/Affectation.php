<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Affectation extends Model
{
    use HasFactory;

    protected $fillable = [

        'reference',

        'demande_id',

        'travailleur_id',

        'date_affectation',

        'date_fin',

        'date_retour',

        'statut',

        'observation',

    ];

    protected $casts = [

        'date_affectation' => 'date',

        'date_fin' => 'date',

        'date_retour' => 'date',

    ];

    /**
     * Demande concernée
     */
    public function demande()
    {
        return $this->belongsTo(Demande::class);
    }

    /**
     * Travailleur concerné
     */
    public function travailleur()
    {
        return $this->belongsTo(Travailleur::class);
    }
}
