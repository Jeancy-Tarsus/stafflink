<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAffectationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'date_fin' => 'nullable|date',

            'statut' => 'required|in:En mission,Terminée,Suspendue',

            'observation' => 'nullable|string|max:1000',

        ];
    }
}
