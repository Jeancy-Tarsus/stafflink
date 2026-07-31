<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateClientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $client = $this->route('client');

        return [

            'nom' => 'required|string|max:255',

            'type' => 'required|in:Entreprise,Particulier',

            'responsable' => 'required|string|max:255',

            'fonction' => 'nullable|string|max:255',

            'telephone' => [
                'required',
                'string',
                'max:20',
                Rule::unique('clients', 'telephone')->ignore($client),
            ],

            'telephone_secondaire' => 'nullable|string|max:20',

            'email' => [
                'nullable',
                'email',
                'max:255',
                Rule::unique('clients', 'email')->ignore($client),
            ],

            'adresse' => 'required|string|max:255',

            'ville' => 'required|string|max:255',

            'secteur_activite' => 'required|string|max:255',

            'rccm' => 'nullable|string|max:255',

            'niu' => 'nullable|string|max:255',

            'actif' => 'required|boolean',

            'observation' => 'nullable|string',

        ];
    }

    public function messages(): array
    {
        return [

            'telephone.unique' => 'Ce numéro existe déjà.',

            'email.unique' => 'Cette adresse email existe déjà.',

        ];
    }
}
