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

        'montant_client',

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

    public function facture()
    {
        return $this->hasOne(Facture::class);
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }

    public function getMontantPayeAttribute()
    {
        return $this->paiements()->sum('montant');
    }

    public function getResteAPayerAttribute()
    {
        return $this->salaire - $this->montant_paye;
    }

}
