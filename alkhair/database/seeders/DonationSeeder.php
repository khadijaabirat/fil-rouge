<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Donation;

class DonationSeeder extends Seeder
{
    public function run(): void
    {
         
        $donations = [
            // === Project 1: Construction école (320000) ===
            ['amount' => 50000, 'message' => 'Bonne chance pour la construction', 'donationDate' => '2026-01-20', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 14, 'project_id' => 1],
            ['amount' => 100000, 'message' => 'Aumône continue', 'donationDate' => '2026-02-05', 'isAnonymous' => true, 'status' => 'VALIDATED', 'donator_id' => 15, 'project_id' => 1],
            ['amount' => 70000, 'message' => null, 'donationDate' => '2026-02-15', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 16, 'project_id' => 1],
            ['amount' => 100000, 'message' => 'Que Dieu vous récompense', 'donationDate' => '2026-03-01', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 17, 'project_id' => 1],

            // === Project 2: Bourses (COMPLETED 250000) ===
            ['amount' => 80000, 'message' => 'Pour soutenir les étudiants', 'donationDate' => '2025-09-15', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 18, 'project_id' => 2],
            ['amount' => 120000, 'message' => 'Pour l\'amour de Dieu', 'donationDate' => '2025-10-10', 'isAnonymous' => true, 'status' => 'VALIDATED', 'donator_id' => 19, 'project_id' => 2],
            ['amount' => 50000, 'message' => null, 'donationDate' => '2025-11-20', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 20, 'project_id' => 2],

            // === Project 3: Cartables (85000) ===
            ['amount' => 35000, 'message' => 'Pour la rentrée scolaire', 'donationDate' => '2026-07-10', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 21, 'project_id' => 3],
            ['amount' => 50000, 'message' => 'Bon courage', 'donationDate' => '2026-07-20', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 14, 'project_id' => 3],

            // === Project 4: Bibliothèque (60000) ===
            ['amount' => 30000, 'message' => 'Le savoir est une lumière', 'donationDate' => '2026-03-15', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 22, 'project_id' => 4],
            ['amount' => 30000, 'message' => null, 'donationDate' => '2026-04-01', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 23, 'project_id' => 4],

            // === Project 5: Caravane médicale (145000) ===
            ['amount' => 45000, 'message' => 'Que Dieu guérisse les malades', 'donationDate' => '2026-03-10', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 15, 'project_id' => 5],
            ['amount' => 50000, 'message' => null, 'donationDate' => '2026-03-25', 'isAnonymous' => true, 'status' => 'VALIDATED', 'donator_id' => 16, 'project_id' => 5],
            ['amount' => 50000, 'message' => 'Contribution modeste', 'donationDate' => '2026-04-05', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 24, 'project_id' => 5],

            // === Project 6: Hémodialyse (350000) ===
            ['amount' => 200000, 'message' => 'Projet très important', 'donationDate' => '2026-02-15', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 17, 'project_id' => 6],
            ['amount' => 150000, 'message' => 'Que Dieu l\'accepte', 'donationDate' => '2026-03-20', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 18, 'project_id' => 6],

            // === Project 7: Chirurgies cardiaques (COMPLETED 600000) ===
            ['amount' => 200000, 'message' => 'Pour la santé des enfants', 'donationDate' => '2025-07-01', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 19, 'project_id' => 7],
            ['amount' => 250000, 'message' => null, 'donationDate' => '2025-09-15', 'isAnonymous' => true, 'status' => 'VALIDATED', 'donator_id' => 20, 'project_id' => 7],
            ['amount' => 150000, 'message' => 'Que Dieu protège nos enfants', 'donationDate' => '2025-12-01', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 21, 'project_id' => 7],

            // === Project 8: Dépistage diabète (COMPLETED 95000) ===
            ['amount' => 45000, 'message' => 'Pour la prévention', 'donationDate' => '2025-11-15', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 25, 'project_id' => 8],
            ['amount' => 50000, 'message' => 'Santé pour tous', 'donationDate' => '2025-12-10', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 26, 'project_id' => 8],

            // === Project 9: Parrainage orphelins (210000) ===
            ['amount' => 36000, 'message' => 'Parrainage d\'un orphelin', 'donationDate' => '2026-01-10', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 14, 'project_id' => 9],
            ['amount' => 72000, 'message' => 'Pour l\'amour de Dieu', 'donationDate' => '2026-02-20', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 15, 'project_id' => 9],
            ['amount' => 102000, 'message' => null, 'donationDate' => '2026-03-15', 'isAnonymous' => true, 'status' => 'VALIDATED', 'donator_id' => 16, 'project_id' => 9],

            // === Project 10: Rénovation orphelinat (COMPLETED 280000) ===
            ['amount' => 130000, 'message' => 'Pour les orphelins', 'donationDate' => '2025-10-15', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 17, 'project_id' => 10],
            ['amount' => 150000, 'message' => 'Que Dieu vous bénisse', 'donationDate' => '2025-12-10', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 18, 'project_id' => 10],

            // === Project 11: Colonie vacances (45000) ===
            ['amount' => 25000, 'message' => 'Pour le sourire des enfants', 'donationDate' => '2026-05-10', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 27, 'project_id' => 11],
            ['amount' => 20000, 'message' => null, 'donationDate' => '2026-05-20', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 28, 'project_id' => 11],

            // === Project 12: Arganiers (130000) ===
            ['amount' => 80000, 'message' => 'Pour l\'environnement', 'donationDate' => '2026-03-01', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 19, 'project_id' => 12],
            ['amount' => 50000, 'message' => null, 'donationDate' => '2026-03-20', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 20, 'project_id' => 12],

            // === Project 13: Nettoyage plage (COMPLETED 50000) ===
            ['amount' => 30000, 'message' => 'Pour des plages propres', 'donationDate' => '2026-01-15', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 21, 'project_id' => 13],
            ['amount' => 20000, 'message' => null, 'donationDate' => '2026-02-01', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 14, 'project_id' => 13],

            // === Project 14: Recyclage (70000) ===
            ['amount' => 40000, 'message' => 'Protégeons notre planète', 'donationDate' => '2026-04-10', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 22, 'project_id' => 14],
            ['amount' => 30000, 'message' => null, 'donationDate' => '2026-04-15', 'isAnonymous' => true, 'status' => 'VALIDATED', 'donator_id' => 23, 'project_id' => 14],

            // === Project 15: Inondations (280000) ===
            ['amount' => 100000, 'message' => 'Que Dieu aide les sinistrés', 'donationDate' => '2026-03-12', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 15, 'project_id' => 15],
            ['amount' => 80000, 'message' => null, 'donationDate' => '2026-03-18', 'isAnonymous' => true, 'status' => 'VALIDATED', 'donator_id' => 16, 'project_id' => 15],
            ['amount' => 100000, 'message' => 'Aide urgente', 'donationDate' => '2026-03-25', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 17, 'project_id' => 15],

            // === Project 16: Paniers Ramadan (COMPLETED 300000) ===
            ['amount' => 150000, 'message' => 'Pour le mois du Ramadan', 'donationDate' => '2026-02-05', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 18, 'project_id' => 16],
            ['amount' => 150000, 'message' => 'Pour la récompense divine', 'donationDate' => '2026-02-20', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 19, 'project_id' => 16],

            // === Project 17: Couvertures hiver (110000) ===
            ['amount' => 60000, 'message' => 'Pour les familles du froid', 'donationDate' => '2026-09-15', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 24, 'project_id' => 17],
            ['amount' => 50000, 'message' => null, 'donationDate' => '2026-10-01', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 25, 'project_id' => 17],

            // === Project 18: Puits (175000) ===
            ['amount' => 100000, 'message' => 'Aumône continue', 'donationDate' => '2026-04-10', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 20, 'project_id' => 18],
            ['amount' => 75000, 'message' => null, 'donationDate' => '2026-04-18', 'isAnonymous' => true, 'status' => 'VALIDATED', 'donator_id' => 21, 'project_id' => 18],

            // === Project 19: Mosquée (290000) ===
            ['amount' => 150000, 'message' => 'Construire une maison de Dieu', 'donationDate' => '2026-02-01', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 14, 'project_id' => 19],
            ['amount' => 140000, 'message' => 'Aumône continue pour mon père', 'donationDate' => '2026-03-10', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 15, 'project_id' => 19],

            // === Project 20: Route rurale (COMPLETED 600000) ===
            ['amount' => 200000, 'message' => 'Pour le désenclavement', 'donationDate' => '2025-09-01', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 22, 'project_id' => 20],
            ['amount' => 250000, 'message' => null, 'donationDate' => '2025-11-15', 'isAnonymous' => true, 'status' => 'VALIDATED', 'donator_id' => 23, 'project_id' => 20],
            ['amount' => 150000, 'message' => 'Pour connecter les douars', 'donationDate' => '2026-01-10', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 24, 'project_id' => 20],

            // === Project 21: Formation couture (120000) ===
            ['amount' => 60000, 'message' => 'Pour l\'autonomisation des femmes', 'donationDate' => '2026-02-15', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 26, 'project_id' => 21],
            ['amount' => 60000, 'message' => 'Soutien aux femmes', 'donationDate' => '2026-03-10', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 27, 'project_id' => 21],

            // === Project 22: Coopérative argan (COMPLETED 250000) ===
            ['amount' => 100000, 'message' => 'Pour les femmes de l\'argan', 'donationDate' => '2025-07-15', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 28, 'project_id' => 22],
            ['amount' => 100000, 'message' => null, 'donationDate' => '2025-09-20', 'isAnonymous' => true, 'status' => 'VALIDATED', 'donator_id' => 14, 'project_id' => 22],
            ['amount' => 50000, 'message' => 'Bravo les femmes !', 'donationDate' => '2025-11-01', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 15, 'project_id' => 22],

            // === Project 23: Alphabétisation (35000) ===
            ['amount' => 20000, 'message' => 'L\'éducation change la vie', 'donationDate' => '2026-05-01', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 16, 'project_id' => 23],
            ['amount' => 15000, 'message' => null, 'donationDate' => '2026-05-15', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 17, 'project_id' => 23],

            // === Project 24: Terrain football (180000) ===
            ['amount' => 80000, 'message' => 'Vive le sport !', 'donationDate' => '2026-03-15', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 18, 'project_id' => 24],
            ['amount' => 50000, 'message' => null, 'donationDate' => '2026-04-01', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 19, 'project_id' => 24],
            ['amount' => 50000, 'message' => 'Pour les jeunes', 'donationDate' => '2026-04-20', 'isAnonymous' => true, 'status' => 'VALIDATED', 'donator_id' => 25, 'project_id' => 24],

            // === Project 25: Festival culturel (COMPLETED 100000) ===
            ['amount' => 60000, 'message' => 'Vive la culture !', 'donationDate' => '2025-10-15', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 20, 'project_id' => 25],
            ['amount' => 40000, 'message' => null, 'donationDate' => '2025-12-01', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 21, 'project_id' => 25],

            // === Project 26: Centre artistique (90000) ===
            ['amount' => 50000, 'message' => 'L\'art est essentiel', 'donationDate' => '2026-05-10', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 22, 'project_id' => 26],
            ['amount' => 40000, 'message' => null, 'donationDate' => '2026-06-01', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 23, 'project_id' => 26],

            // === Project 27: Soutien scolaire (COMPLETED 90000) ===
            ['amount' => 40000, 'message' => 'Pour la réussite des élèves', 'donationDate' => '2025-09-20', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 24, 'project_id' => 27],
            ['amount' => 50000, 'message' => null, 'donationDate' => '2025-10-15', 'isAnonymous' => true, 'status' => 'VALIDATED', 'donator_id' => 26, 'project_id' => 27],

            // === Project 28: Équipement informatique (150000) ===
            ['amount' => 80000, 'message' => 'Le numérique pour tous', 'donationDate' => '2026-02-01', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 27, 'project_id' => 28],
            ['amount' => 70000, 'message' => null, 'donationDate' => '2026-03-15', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 28, 'project_id' => 28],

            // === Project 29: Lunettes (85000) ===
            ['amount' => 50000, 'message' => 'Pour la vue de nos enfants', 'donationDate' => '2026-02-20', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 14, 'project_id' => 29],
            ['amount' => 35000, 'message' => null, 'donationDate' => '2026-03-10', 'isAnonymous' => true, 'status' => 'VALIDATED', 'donator_id' => 15, 'project_id' => 29],

            // === Project 30: Ambulance (220000) ===
            ['amount' => 120000, 'message' => 'Une ambulance sauve des vies', 'donationDate' => '2026-03-15', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 16, 'project_id' => 30],
            ['amount' => 100000, 'message' => 'Pour les urgences médicales', 'donationDate' => '2026-04-05', 'isAnonymous' => false, 'status' => 'VALIDATED', 'donator_id' => 17, 'project_id' => 30],

            // === Donations PENDING ===
            ['amount' => 25000, 'message' => 'Nouveau don', 'donationDate' => '2026-04-20', 'isAnonymous' => false, 'status' => 'PENDING', 'donator_id' => 18, 'project_id' => 1],
            ['amount' => 15000, 'message' => null, 'donationDate' => '2026-04-21', 'isAnonymous' => false, 'status' => 'PENDING', 'donator_id' => 19, 'project_id' => 5],
            ['amount' => 30000, 'message' => 'En attente de validation', 'donationDate' => '2026-04-21', 'isAnonymous' => false, 'status' => 'PENDING', 'donator_id' => 20, 'project_id' => 9],
            ['amount' => 50000, 'message' => null, 'donationDate' => '2026-04-20', 'isAnonymous' => true, 'status' => 'PENDING', 'donator_id' => 21, 'project_id' => 18],
            ['amount' => 20000, 'message' => 'Don en cours', 'donationDate' => '2026-04-21', 'isAnonymous' => false, 'status' => 'PENDING', 'donator_id' => 22, 'project_id' => 24],
        ];

        foreach ($donations as $donation) {
            Donation::create($donation);
        }
    }
}
