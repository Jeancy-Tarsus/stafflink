<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDemandeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'client_id' => 'required|exists:clients,id',

            'metier_id' => 'required|exists:metiers,id',

            'nombre' => 'required|integer|min:1',

            'date_debut' => 'required|date',

            'date_fin' => 'nullable|date|after_or_equal:date_debut',

            'urgence' => 'required|in:Normale,Urgente,Très urgente',

            'observation' => 'nullable|string',

        ];
    }

    public function messages(): array
    {
        return [

            'client_id.required' => 'Veuillez sélectionner un client.',

            'metier_id.required' => 'Veuillez sélectionner un métier.',

            'nombre.required' => 'Le nombre demandé est obligatoire.',

            'nombre.min' => 'Le nombre doit être supérieur à 0.',

            'date_debut.required' => 'La date de début est obligatoire.',

            'urgence.required' => "Veuillez choisir le niveau d'urgence.",

        ];
    }
}
