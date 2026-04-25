<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Project;

class StoreDonationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isDonator();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $project = Project::findOrFail($this->route('id'));
        $remainingAmount = $project->goalAmount - $project->currentAmount;

        return [
            'amount' => [
                'required',
                'numeric',
                'min:100',
                function ($attribute, $value, $fail) use ($remainingAmount) {
                    if ($value > $remainingAmount) {
                        $fail("Le montant ne peut pas dépasser l'objectif restant (" . number_format($remainingAmount, 0, ',', ' ') . " DH).");
                    }
                },
            ],
            'message' => 'nullable|string|max:500',
            'isAnonymous' => 'nullable|boolean',
            'paymentMethod' => 'required|in:ONLINE,MANUAL',
            'paymentReceipt' => 'required_if:paymentMethod,MANUAL|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'amount.min' => 'Le montant minimum du don est de 100 DH.',
            'amount.required' => 'Le montant du don est obligatoire.',
            'amount.numeric' => 'Le montant doit être un nombre valide.',
            'message.max' => 'Votre message ne peut pas dépasser 500 caractères.',
            'paymentMethod.required' => 'Veuillez sélectionner un mode de paiement.',
            'paymentMethod.in' => 'Le mode de paiement sélectionné est invalide.',
            'paymentReceipt.required_if' => 'Le reçu de paiement est obligatoire pour un don manuel.',
            'paymentReceipt.file' => 'Le reçu doit être un fichier valide.',
            'paymentReceipt.max' => 'Le reçu de paiement ne peut pas dépasser 5 Mo.',
            'paymentReceipt.mimes' => 'Le reçu doit être au format PDF, JPG ou PNG.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'amount' => 'montant',
            'message' => 'message',
            'paymentMethod' => 'mode de paiement',
            'paymentReceipt' => 'reçu de paiement',
        ];
    }
}
