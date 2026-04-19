<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreImpactReportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'description' => 'required|string|min:100',
            'completionDate' => 'required|date|before_or_equal:today',
            'videoLink' => 'nullable|url',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ];
    }

    public function messages(): array
    {
        return [
            'description.required' => 'La description du rapport est obligatoire.',
            'description.min' => 'La description doit contenir au moins 100 caractères.',
            'completionDate.before_or_equal' => 'La date d\'achèvement ne peut pas être dans le futur.',
            'images.*.max' => 'Chaque image ne doit pas dépasser 5 Mo.',
        ];
    }
}
