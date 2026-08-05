<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFactureRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'date_facture' => 'required|date',

            'date_echeance' => 'nullable|date|after_or_equal:date_facture',

            'montant' => 'required|numeric|min:1',

            'objet' => 'required|string|max:255',

            'conditions_paiement' => 'nullable|string',

            'observation' => 'nullable|string',

        ];
    }
}
