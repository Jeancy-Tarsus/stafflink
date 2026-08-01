<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAffectationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'demande_id' => 'required|exists:demandes,id',

            'travailleur_id' => 'required|exists:travailleurs,id',

            'date_affectation' => 'required|date',

            'date_fin' => 'nullable|date|after_or_equal:date_affectation',

            'observation' => 'nullable|string|max:1000',

        ];
    }

    public function messages(): array
    {
        return [

            'demande_id.required' => 'Veuillez sélectionner une demande.',

            'travailleur_id.required' => 'Veuillez sélectionner un travailleur.',

            'date_affectation.required' => "La date d'affectation est obligatoire.",

            'date_fin.after_or_equal' => "La date de fin doit être supérieure ou égale à la date d'affectation.",

        ];
    }
}
