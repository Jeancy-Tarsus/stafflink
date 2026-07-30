<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMetierRequest extends FormRequest
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
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
     public function rules(): array
    {
        return [

            'nom' => [
                'required',
                'string',
                'max:255',
                Rule::unique('metiers', 'nom')
                    ->ignore($this->metier)
            ],

            'description' => [
                'nullable',
                'string'
            ],

            'actif' => [
                'required',
                'boolean'
            ],

        ];
    }


    public function messages(): array
    {
        return [

            'nom.required' => 'Le nom du métier est obligatoire.',

            'nom.unique' => 'Ce métier existe déjà.',

            'actif.required' => 'Veuillez sélectionner un statut.',

        ];
    }
}
