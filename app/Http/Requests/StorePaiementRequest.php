<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaiementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [

            'contrat_id' => 'required|exists:contrats,id',

            'date_paiement' => 'required|date',

            'montant' => 'required|numeric|min:1',

            'mode_paiement' => 'required|in:Espèces,Virement bancaire,Chèque,Mobile Money',

            'reference_paiement' => 'nullable|string|max:255',

            'observation' => 'nullable|string',

        ];
    }

    /**
     * Messages personnalisés.
     */
    public function messages(): array
    {
        return [

            'contrat_id.required' => 'Veuillez sélectionner un contrat.',

            'contrat_id.exists' => 'Le contrat sélectionné est invalide.',

            'date_paiement.required' => 'La date de paiement est obligatoire.',

            'montant.required' => 'Le montant est obligatoire.',

            'montant.numeric' => 'Le montant doit être numérique.',

            'montant.min' => 'Le montant doit être supérieur à zéro.',

            'mode_paiement.required' => 'Veuillez choisir un mode de paiement.',

        ];
    }
}
