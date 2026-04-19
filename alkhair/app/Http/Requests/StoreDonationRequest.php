<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDonationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'amount' => 'required|numeric|min:100',
            'message' => 'nullable|string|max:500',
            'isAnonymous' => 'nullable|boolean',
            'paymentMethod' => 'required|in:ONLINE,MANUAL',
            'paymentReceipt' => 'required_if:paymentMethod,MANUAL|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ];
    }

    public function messages(): array
    {
        return [
            'amount.required' => 'Le montant du don est obligatoire.',
            'amount.min' => 'Le montant minimum du don est de 100 DH.',
            'message.max' => 'Le message ne peut pas dépasser 500 caractères.',
            'paymentReceipt.required_if' => 'Le reçu de paiement est obligatoire pour les paiements manuels.',
            'paymentReceipt.max' => 'La taille du fichier ne doit pas dépasser 5 Mo.',
        ];
    }
}
