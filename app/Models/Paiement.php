<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Contrat;

class Paiement extends Model
{
    protected $fillable = [

        'reference',

        'contrat_id',

        'date_paiement',

        'montant',

        'mode_paiement',

        'reference_paiement',

        'observation'

    ];

    protected $casts = [

        'date_paiement' => 'date'

    ];

    public function contrat()
    {
        return $this->belongsTo(Contrat::class);
    }
}
