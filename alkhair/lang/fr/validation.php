<?php

return [
    'min' => [
        'numeric' => 'Le champ :attribute doit être au moins :min.',
        'string' => 'Le champ :attribute doit contenir au moins :min caractères.',
    ],
    'max' => [
        'string' => 'Le champ :attribute ne peut pas dépasser :max caractères.',
        'file' => 'Le fichier :attribute ne peut pas dépasser :max kilo-octets.',
    ],
    'required' => 'Le champ :attribute est obligatoire.',
    'required_if' => 'Le champ :attribute est obligatoire quand :other est :value.',
    'mimes' => 'Le fichier :attribute doit être de type: :values.',
    'numeric' => 'Le champ :attribute doit être un nombre.',
    'unique' => 'Ce :attribute est déjà utilisé.',
    'email' => 'Le champ :attribute doit être une adresse email valide.',
    'confirmed' => 'La confirmation du :attribute ne correspond pas.',
    'exists' => 'Le :attribute sélectionné est invalide.',
    'in' => 'Le :attribute sélectionné est invalide.',
    'url' => 'Le format de :attribute est invalide.',
    'date' => 'Le :attribute n\'est pas une date valide.',
    'after' => 'Le :attribute doit être une date après :date.',
    
    'attributes' => [
        'amount' => 'montant',
        'message' => 'message',
        'paymentReceipt' => 'reçu de paiement',
        'description' => 'description',
        'documentKYC' => 'document KYC',
        'profilePhoto' => 'photo de profil',
        'ville' => 'ville',
        'licenseNumber' => 'numéro de licence',
        'category_id' => 'catégorie',
        'title' => 'titre',
        'goalAmount' => 'objectif financier',
        'startDate' => 'date de début',
        'endDate' => 'date de fin',
        'videoUrl' => 'lien vidéo',
        'name' => 'nom',
        'email' => 'email',
        'password' => 'mot de passe',
    ],
];
