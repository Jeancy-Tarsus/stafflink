<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFactureRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'contrat_id' => 'required|exists:contrats,id',

            'date_facture' => 'required|date',

            'date_echeance' => 'nullable|date|after_or_equal:date_facture',

            'montant' => 'required|numeric|min:1',

            'objet' => 'required|string|max:255',

            'conditions_paiement' => 'nullable|string',

            'observation' => 'nullable|string',

        ];
    }

    public function messages(): array
    {
        return [

            'contrat_id.required' => 'Veuillez sélectionner un contrat.',

            'montant.required' => 'Le montant est obligatoire.',

            'montant.min' => 'Le montant doit être supérieur à 0.',

            'objet.required' => "Veuillez saisir l'objet de la facture.",

        ];
    }
}
