<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTravailleurRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'sexe' => 'required|in:Masculin,Féminin',
            'date_naissance' => 'required|date',
            'telephone' => 'required|string|max:20|unique:travailleurs,telephone',
            'email' => 'nullable|email|max:255|unique:travailleurs,email',
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
            'nom.required' => 'Le nom est obligatoire.',
            'prenom.required' => 'Le prénom est obligatoire.',
            'telephone.unique' => 'Ce numéro de téléphone existe déjà.',
            'email.unique' => 'Cette adresse email existe déjà.',
            'metier_id.required' => 'Veuillez sélectionner un métier.',
            'metier_id.exists' => 'Le métier sélectionné est invalide.',
            'photo.max' => 'La photo ne doit pas dépasser 10 Mo.',
            'photo.image' => 'Le fichier sélectionné doit être une image.',
            'photo.mimes' => 'La photo doit être au format JPG, JPEG ou PNG.',

        ];
    }
}
