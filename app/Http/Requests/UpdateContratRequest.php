<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContratRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'date_signature' => 'required|date',

            'date_debut' => 'required|date',

            'date_fin' => 'nullable|date|after_or_equal:date_debut',

            'salaire' => 'required|numeric|min:0',

            'statut' => 'required|in:Actif,Terminé,Résilié',

            'observation' => 'nullable|string',

        ];
    }
}
