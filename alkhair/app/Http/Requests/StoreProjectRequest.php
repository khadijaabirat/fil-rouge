<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:250',
            'description' => 'required|string|min:100',
            'goalAmount' => 'required|numeric|min:1000',
            'startDate' => 'required|date|after_or_equal:today',
            'endDate' => 'required|date|after:startDate',
            'category_id' => 'required|exists:categories,id',
            'videoUrl' => 'nullable|url',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Le titre du projet est obligatoire.',
            'description.min' => 'La description doit contenir au moins 100 caractères.',
            'goalAmount.min' => 'L\'objectif financier doit être au moins 1000 DH.',
            'endDate.after' => 'La date de fin doit être après la date de début.',
        ];
    }
}
