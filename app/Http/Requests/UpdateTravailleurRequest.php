<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTravailleurRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $travailleur = $this->route('travailleur');

        return [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'sexe' => 'required|in:Masculin,Féminin',
            'date_naissance' => 'required|date',

            'telephone' => [
                'required',
                'string',
                'max:20',
                Rule::unique('travailleurs', 'telephone')->ignore($travailleur),
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
                Rule::unique('travailleurs', 'email')->ignore($travailleur),
            ],

            'adresse' => 'required|string',

            'metier_id' => 'required|exists:metiers,id',

            'experience' => 'nullable|string|max:255',

            'salaire_souhaite' => 'nullable|numeric|min:0',

            'disponible' => 'required|boolean',

            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',

            'observation' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'telephone.unique' => 'Ce numéro existe déjà.',
            'email.unique' => 'Cet email existe déjà.',
        ];
    }
}
