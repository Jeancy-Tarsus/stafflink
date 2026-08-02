<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    protected $fillable = [

        'reference',

        'affectation_id',

        'date_signature',

        'date_debut',

        'date_fin',

        'salaire',

        'statut',

        'observation'

    ];

    protected $casts = [

        'date_signature' => 'date',

        'date_debut' => 'date',

        'date_fin' => 'date',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */

    public function affectation()
    {
        return $this->belongsTo(Affectation::class);
    }
}
