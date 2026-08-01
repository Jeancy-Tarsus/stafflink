<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Metier extends Model
{
    //
    protected $fillable = [
        'nom',
        'description',
        'actif',
    ];

    public function travailleurs()
    {
        return $this->hasMany(Travailleur::class);
    }

    public function demandes()
    {
        return $this->hasMany(Demande::class);
    }
}
