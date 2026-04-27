<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = [
            [
                'category' => 'Général',
                'questions' => [
                    [
                        'question' => 'Qu\'est-ce que AL-KHAIR ?',
                        'answer' => 'AL-KHAIR est une plateforme solidaire qui connecte les donateurs avec des associations marocaines locales, garantissant une transparence totale sur l\'utilisation des dons.'
                    ],
                    [
                        'question' => 'Comment fonctionne la plateforme ?',
                        'answer' => 'Les associations créent des projets, les donateurs effectuent des dons en ligne ou manuels, et les associations publient des rapports d\'impact pour montrer l\'utilisation des fonds.'
                    ],
                ]
            ],
            [
                'category' => 'Pour les Donateurs',
                'questions' => [
                    [
                        'question' => 'Quel est le montant minimum pour faire un don ?',
                        'answer' => 'Le montant minimum pour effectuer un don est de 100 DH.'
                    ],
                    [
                        'question' => 'Puis-je faire un don anonyme ?',
                        'answer' => 'Oui, vous pouvez choisir de rester anonyme lors de votre don. Votre nom ne sera pas affiché publiquement.'
                    ],
                    [
                        'question' => 'Comment puis-je obtenir un reçu de don ?',
                        'answer' => 'Après validation de votre don, vous pouvez télécharger un reçu PDF depuis votre tableau de bord.'
                    ],
                    [
                        'question' => 'Quels sont les moyens de paiement acceptés ?',
                        'answer' => 'Nous acceptons les paiements en ligne par carte bancaire (via Stripe) et les dons manuels avec justificatif.'
                    ],
                ]
            ],
            [
                'category' => 'Pour les Associations',
                'questions' => [
                    [
                        'question' => 'Comment puis-je inscrire mon association ?',
                        'answer' => 'Créez un compte association et soumettez vos documents KYC (récépissé, statuts, etc.). Un administrateur validera votre compte sous 48-72h.'
                    ],
                    [
                        'question' => 'Combien de projets puis-je créer ?',
                        'answer' => 'Vous pouvez créer autant de projets que vous le souhaitez, mais vous devez publier un rapport d\'impact avant de créer un nouveau projet après avoir reçu des fonds.'
                    ],
                    [
                        'question' => 'Comment retirer les fonds collectés ?',
                        'answer' => 'Une fois l\'objectif atteint, vous pouvez demander le retrait des fonds. Assurez-vous d\'avoir ajouté votre RIB bancaire dans votre profil.'
                    ],
                    [
                        'question' => 'Qu\'est-ce qu\'un rapport d\'impact ?',
                        'answer' => 'C\'est un document obligatoire qui explique comment les fonds ont été utilisés et l\'impact réalisé sur le terrain.'
                    ],
                ]
            ],
            [
                'category' => 'Sécurité & Transparence',
                'questions' => [
                    [
                        'question' => 'Comment garantissez-vous la sécurité des paiements ?',
                        'answer' => 'Nous utilisons Stripe, une plateforme de paiement sécurisée et certifiée PCI-DSS. Vos données bancaires ne sont jamais stockées sur nos serveurs.'
                    ],
                    [
                        'question' => 'Comment puis-je vérifier qu\'une association est légitime ?',
                        'answer' => 'Toutes les associations sont vérifiées par notre équipe administrative avant d\'être activées. Vous pouvez consulter leurs documents KYC et leurs rapports d\'impact.'
                    ],
                    [
                        'question' => 'Que se passe-t-il si un projet n\'atteint pas son objectif ?',
                        'answer' => 'Si le projet expire sans atteindre son objectif, il est automatiquement fermé. L\'association peut choisir de prolonger la date limite ou de retirer les fonds collectés.'
                    ],
                ]
            ],
        ];

        return view('faq', compact('faqs'));
    }
}
