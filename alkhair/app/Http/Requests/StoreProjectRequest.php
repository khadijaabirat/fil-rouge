<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
 
    public function authorize(): bool
    {
        return auth()->check() 
        && auth()->user()->isAssociation() 
        && auth()->user()->status === 'ACTIVE';    }

    /**
     * 
     *
     * @return array<string,  
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:250|min:10',
            'description' => 'required|string|min:100',
            'goalAmount' => 'required|numeric|min:500|max:10000000',
            'startDate' => 'required|date|after_or_equal:today',
            'endDate' => [
                'required',
                'date',
                'after:startDate',
                function ($attribute, $value, $fail) {
                    $startDate = $this->input('startDate');
                    if ($startDate) {
                        $diff = \Carbon\Carbon::parse($startDate)->diffInDays(\Carbon\Carbon::parse($value));
                        if ($diff < 7) {
                            $fail('La durée du projet doit être d\'au moins 7 jours.');
                        }
                        if ($diff > 365) {
                            $fail('La durée du projet ne peut pas dépasser 1 an.');
                        }
                    }
                },
            ],
            'category_id' => 'required|exists:categories,id',
            'videoUrl' => 'nullable|url|max:500',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:5120|dimensions:min_width=800,min_height=600',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ];
    }

    /**
     *  
     *
     * @return array<string,  
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Le titre du projet est obligatoire.',
            'title.min' => 'Le titre doit contenir au moins 10 caractères.',
            'title.max' => 'Le titre ne peut pas dépasser 250 caractères.',
            'description.required' => 'La description du projet est obligatoire.',
            'description.min' => 'La description doit contenir au moins 100 caractères pour être claire et détaillée.',
            'goalAmount.required' => 'L\'objectif financier est obligatoire.',
            'goalAmount.min' => 'L\'objectif financier doit être d\'au moins 500 DH.',
            'goalAmount.max' => 'L\'objectif financier ne peut pas dépasser 10 000 000 DH.',
            'startDate.required' => 'La date de début est obligatoire.',
            'startDate.after_or_equal' => 'La date de début ne peut pas être dans le passé.',
            'endDate.required' => 'La date de fin est obligatoire.',
            'endDate.after' => 'La date de fin doit être après la date de début.',
            'category_id.required' => 'Veuillez sélectionner une catégorie.',
            'category_id.exists' => 'La catégorie sélectionnée n\'existe pas.',
            'videoUrl.url' => 'Le lien vidéo doit être une URL valide.',
            'videoUrl.max' => 'Le lien vidéo ne peut pas dépasser 500 caractères.',
            'image.image' => 'Le fichier doit être une image.',
            'image.mimes' => 'L\'image doit être au format JPEG, JPG, PNG ou WEBP.',
            'image.max' => 'L\'image ne peut pas dépasser 5 Mo.',
            'image.dimensions' => 'L\'image doit avoir une résolution minimale de 800x600 pixels.',
            'latitude.between' => 'La latitude doit être entre -90 et 90.',
            'longitude.between' => 'La longitude doit être entre -180 et 180.',
        ];
    }
}
