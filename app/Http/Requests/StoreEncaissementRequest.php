<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEncaissementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'facture_id' => 'required|exists:factures,id',

            'date_encaissement' => 'required|date',

            'montant' => 'required|numeric|min:1',

            'mode_paiement' => 'required',

            'reference_paiement' => 'nullable|max:255',

            'observation' => 'nullable|string',

        ];
    }
}
