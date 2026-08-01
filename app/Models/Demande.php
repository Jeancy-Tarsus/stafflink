<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;

    protected $fillable = [

        'reference',
        'client_id',
        'metier_id',
        'nombre',
        'nombre_affectes',
        'date_debut',
        'date_fin',
        'urgence',
        'statut',
        'observation',

    ];

    protected $casts = [

        'date_debut' => 'date',
        'date_fin' => 'date',

    ];

    /**
     * Client concerné
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Métier demandé
     */
    public function metier()
    {
        return $this->belongsTo(Metier::class);
    }

    /**
     * Nombre restant à affecter
     */
    public function getNombreRestantAttribute()
    {
        return $this->nombre - $this->nombre_affectes;
    }
}
