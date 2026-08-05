<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Contrat;
use App\Models\Encaissement;

class Facture extends Model
{
    protected $fillable = [

        'reference',
        'contrat_id',
        'date_facture',
        'date_echeance',
        'montant',
        'objet',
        'conditions_paiement',
        'statut',
        'observation',

    ];

    protected $casts = [

        'date_facture' => 'date',
        'date_echeance' => 'date',

    ];

    public function contrat()
    {
        return $this->belongsTo(Contrat::class);
    }

    public function encaissements()
    {
        return $this->hasMany(Encaissement::class);
    }

    public function getMontantEncaisseAttribute()
    {
        return $this->encaissements()->sum('montant');
    }

    public function getResteAttribute()
    {
        return $this->montant - $this->montant_encaisse;
    }

    public function mettreAJourStatut()
    {
        $encaisse = $this->montant_encaisse;

        if ($encaisse <= 0) {

            $this->statut = 'Non payée';
        } elseif ($encaisse < $this->montant) {

            $this->statut = 'Partiellement payée';
        } else {

            $this->statut = 'Payée';
        }

        $this->save();
    }

    public function getEstSoldeeAttribute()
    {
        return $this->reste <= 0;
    }

    public function getPourcentagePayeAttribute()
    {
        if ($this->montant == 0) {

            return 0;
        }

        return round(($this->montant_encaisse / $this->montant) * 100, 2);
    }
}
