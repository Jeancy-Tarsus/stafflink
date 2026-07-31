<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation
     */
    public function rules(): array
    {
        return [

            // Informations générales
            'nom' => 'required|string|max:255',
            'type' => 'required|in:Entreprise,Particulier',
            'responsable' => 'required|string|max:255',
            'fonction' => 'nullable|string|max:255',

            // Coordonnées
            'telephone' => 'required|string|max:20|unique:clients,telephone',
            'telephone_secondaire' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255|unique:clients,email',
            'adresse' => 'required|string|max:255',
            'ville' => 'required|string|max:255',

            // Informations professionnelles
            'secteur_activite' => 'required|string|max:255',
            'rccm' => 'nullable|string|max:255',
            'niu' => 'nullable|string|max:255',

            // Statut
            'actif' => 'required|boolean',

            // Observation
            'observation' => 'nullable|string',

        ];
    }

    /**
     * Messages
     */
    public function messages(): array
    {
        return [

            'nom.required' => 'Le nom du client est obligatoire.',

            'type.required' => 'Veuillez choisir le type de client.',

            'responsable.required' => 'Le responsable est obligatoire.',

            'telephone.required' => 'Le téléphone est obligatoire.',

            'telephone.unique' => 'Ce numéro existe déjà.',

            'email.unique' => 'Cette adresse email existe déjà.',

            'secteur_activite.required' => 'Le secteur d’activité est obligatoire.',

            'ville.required' => 'La ville est obligatoire.',

        ];
    }
}
