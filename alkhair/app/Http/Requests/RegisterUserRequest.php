<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use Illuminate\Validation\Rules\Password;
class RegisterUserRequest extends FormRequest
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
       $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed',  Password::defaults()],
            'role'=>['required','string','in:donator,association'],
            ];

            if ($this->role === 'association') {
            $rules['ville'] = ['required', 'string', 'max:255'];
            $rules['licenseNumber'] = ['required', 'string', 'max:255'];
            $rules['description'] = ['required', 'string', 'min:50'];
           $rules['category_id'] = ['required', 'integer', 'exists:categories,id'];
        $rules['documentKYC'] = ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'];
            $rules['profilePhoto'] = ['required', 'image', 'max:5120'];
        }
       return $rules;
    }

    public function messages(): array
    {
        return [
            'description.min' => 'La description de l\'association doit contenir au moins 50 caractères pour être validée.',
            'amount.min' => 'Le montant minimum du don est de 100 DH.',
            'documentKYC.max' => 'Le document KYC ne peut pas dépasser 5 Mo.',
            'profilePhoto.max' => 'La photo de profil ne peut pas dépasser 5 Mo.',
            'paymentReceipt.max' => 'Le reçu de paiement ne peut pas dépasser 5 Mo.',
            'message.max' => 'Votre message ne peut pas dépasser 500 caractères.',
        ];
    }
}
