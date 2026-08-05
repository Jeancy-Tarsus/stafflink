<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Facture;

class Encaissement extends Model
{
    protected $fillable = [

        'reference',

        'facture_id',

        'date_encaissement',

        'montant',

        'mode_paiement',

        'reference_paiement',

        'observation',

    ];

    protected $casts = [

        'date_encaissement' => 'date',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */

    public function facture()
    {
        return $this->belongsTo(Facture::class);
    }
}
