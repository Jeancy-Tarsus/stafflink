<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreMetierRequest extends FormRequest
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
                'unique:metiers,nom'
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

            'nom.max' => 'Le nom du métier ne doit pas dépasser 255 caractères.',

            'actif.required' => 'Veuillez choisir un statut.',

        ];
    }
}
