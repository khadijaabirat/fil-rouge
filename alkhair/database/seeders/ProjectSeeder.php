<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            // === Association Al Nour (ID=2, cat=1 Éducation) ===
            ['title' => 'Construction d\'une école à Ait Hamou', 'description' => 'Construction d\'une école primaire de 6 classes et sanitaires dans le douar Ait Hamou, province d\'Azilal, pour permettre à plus de 200 enfants d\'accéder à l\'éducation.', 'goalAmount' => 500000, 'currentAmount' => 320000, 'startDate' => '2026-01-15', 'endDate' => '2026-07-30', 'status' => 'OPEN', 'association_id' => 2, 'category_id' => 1],
            ['title' => 'Bourses universitaires 2026', 'description' => 'Programme de bourses pour 50 étudiants issus de familles défavorisées couvrant inscription, logement et alimentation.', 'goalAmount' => 250000, 'currentAmount' => 250000, 'startDate' => '2025-09-01', 'endDate' => '2026-06-30', 'status' => 'COMPLETED', 'association_id' => 2, 'category_id' => 1],
            ['title' => 'Distribution de cartables scolaires', 'description' => 'Distribution de 2000 cartables équipés aux élèves du primaire dans les zones rurales de Béni Mellal-Khénifra.', 'goalAmount' => 120000, 'currentAmount' => 85000, 'startDate' => '2026-07-01', 'endDate' => '2026-09-15', 'status' => 'OPEN', 'association_id' => 2, 'category_id' => 1],
            ['title' => 'Bibliothèque communautaire à Ouarzazate', 'description' => 'Création d\'une bibliothèque communautaire équipée de livres, ordinateurs et accès internet pour les jeunes de Ouarzazate.', 'goalAmount' => 150000, 'currentAmount' => 60000, 'startDate' => '2026-03-01', 'endDate' => '2026-11-30', 'status' => 'OPEN', 'association_id' => 2, 'category_id' => 1],

            // === Fondation Achifaa (ID=3, cat=2 Santé) ===
            ['title' => 'Caravane médicale dans l\'Atlas', 'description' => 'Organisation d\'une caravane médicale multidisciplinaire pour les habitants des douars isolés du Haut Atlas avec distribution gratuite de médicaments.', 'goalAmount' => 180000, 'currentAmount' => 145000, 'startDate' => '2026-03-01', 'endDate' => '2026-05-31', 'status' => 'OPEN', 'association_id' => 3, 'category_id' => 2],
            ['title' => 'Équipement centre d\'hémodialyse', 'description' => 'Achat et installation de 10 appareils d\'hémodialyse au centre de santé de Khouribga pour les patients démunis.', 'goalAmount' => 800000, 'currentAmount' => 350000, 'startDate' => '2026-02-01', 'endDate' => '2026-12-31', 'status' => 'OPEN', 'association_id' => 3, 'category_id' => 2],
            ['title' => 'Chirurgies cardiaques pour enfants', 'description' => 'Financement de 20 opérations cardiaques pour enfants atteints de malformations congénitales issus de familles démunies.', 'goalAmount' => 600000, 'currentAmount' => 600000, 'startDate' => '2025-06-01', 'endDate' => '2026-03-31', 'status' => 'COMPLETED', 'association_id' => 3, 'category_id' => 2],
            ['title' => 'Campagne de dépistage du diabète', 'description' => 'Campagne de dépistage gratuit du diabète dans 20 communes rurales de la région Rabat-Salé-Kénitra avec suivi médical.', 'goalAmount' => 95000, 'currentAmount' => 95000, 'startDate' => '2025-11-01', 'endDate' => '2026-02-28', 'status' => 'COMPLETED', 'association_id' => 3, 'category_id' => 2],

            // === Kafil Al Yatim (ID=4, cat=3 Orphelins) ===
            ['title' => 'Parrainage de 100 orphelins pour un an', 'description' => 'Programme complet de parrainage de 100 orphelins incluant éducation, alimentation, vêtements et soins de santé.', 'goalAmount' => 360000, 'currentAmount' => 210000, 'startDate' => '2026-01-01', 'endDate' => '2026-12-31', 'status' => 'OPEN', 'association_id' => 4, 'category_id' => 3],
            ['title' => 'Rénovation de l\'orphelinat de Fès', 'description' => 'Rénovation et équipement de l\'orphelinat de Fès accueillant 60 orphelins : toiture, cuisine, dortoirs et sanitaires.', 'goalAmount' => 280000, 'currentAmount' => 280000, 'startDate' => '2025-10-01', 'endDate' => '2026-02-28', 'status' => 'COMPLETED', 'association_id' => 4, 'category_id' => 3],
            ['title' => 'Colonie de vacances pour orphelins', 'description' => 'Organisation d\'une colonie de vacances d\'été de 15 jours à Ifrane pour 80 orphelins avec activités éducatives et sportives.', 'goalAmount' => 120000, 'currentAmount' => 45000, 'startDate' => '2026-05-01', 'endDate' => '2026-08-31', 'status' => 'OPEN', 'association_id' => 4, 'category_id' => 3],

            // === Akhdar Environnement (ID=5, cat=4 Environnement) ===
            ['title' => 'Plantation de 10 000 arganiers', 'description' => 'Plantation de 10 000 arganiers dans la région de Souss-Massa pour lutter contre la désertification et préserver ce patrimoine UNESCO.', 'goalAmount' => 200000, 'currentAmount' => 130000, 'startDate' => '2026-02-15', 'endDate' => '2026-08-30', 'status' => 'OPEN', 'association_id' => 5, 'category_id' => 4],
            ['title' => 'Nettoyage de la plage d\'Essaouira', 'description' => 'Campagne de nettoyage et sensibilisation à la propreté des plages avec installation de poubelles intelligentes.', 'goalAmount' => 50000, 'currentAmount' => 50000, 'startDate' => '2026-01-01', 'endDate' => '2026-04-15', 'status' => 'COMPLETED', 'association_id' => 5, 'category_id' => 4],
            ['title' => 'Programme de recyclage à Marrakech', 'description' => 'Mise en place d\'un programme de tri sélectif et recyclage dans 10 quartiers de Marrakech avec formation des habitants.', 'goalAmount' => 180000, 'currentAmount' => 70000, 'startDate' => '2026-04-01', 'endDate' => '2026-12-31', 'status' => 'OPEN', 'association_id' => 5, 'category_id' => 4],

            // === Comité de Secours (ID=6, cat=5 Aide d'urgence) ===
            ['title' => 'Aide aux victimes des inondations', 'description' => 'Fourniture d\'aide d\'urgence à 500 familles touchées par les inondations à Tétouan : tentes, couvertures, nourriture et eau.', 'goalAmount' => 400000, 'currentAmount' => 280000, 'startDate' => '2026-03-10', 'endDate' => '2026-06-10', 'status' => 'OPEN', 'association_id' => 6, 'category_id' => 5],
            ['title' => 'Paniers alimentaires du Ramadan', 'description' => 'Distribution de 3000 paniers alimentaires aux familles démunies pendant le Ramadan dans les villes du Nord.', 'goalAmount' => 300000, 'currentAmount' => 300000, 'startDate' => '2026-02-01', 'endDate' => '2026-03-30', 'status' => 'COMPLETED', 'association_id' => 6, 'category_id' => 5],
            ['title' => 'Couvertures et vêtements d\'hiver', 'description' => 'Distribution de 2000 couvertures et lots de vêtements chauds aux familles des zones montagneuses avant l\'hiver.', 'goalAmount' => 160000, 'currentAmount' => 110000, 'startDate' => '2026-09-01', 'endDate' => '2026-12-15', 'status' => 'OPEN', 'association_id' => 6, 'category_id' => 5],

            // === Al Bounyan (ID=7, cat=6 Infrastructure) ===
            ['title' => 'Forage de 5 puits à Souss', 'description' => 'Forage de 5 puits équipés de pompes solaires dans la province de Taroudant pour fournir de l\'eau potable à 2000 habitants.', 'goalAmount' => 350000, 'currentAmount' => 175000, 'startDate' => '2026-04-01', 'endDate' => '2026-10-31', 'status' => 'OPEN', 'association_id' => 7, 'category_id' => 6],
            ['title' => 'Construction d\'une mosquée à Tizi', 'description' => 'Construction d\'une mosquée de 300 places au douar Tizi N\'Tichka avec salle de Coran et logement de l\'imam.', 'goalAmount' => 450000, 'currentAmount' => 290000, 'startDate' => '2026-01-20', 'endDate' => '2026-09-30', 'status' => 'OPEN', 'association_id' => 7, 'category_id' => 6],
            ['title' => 'Route rurale à Tafraout', 'description' => 'Aménagement d\'une route rurale de 8 km reliant 3 douars isolés à la route principale de Tafraout.', 'goalAmount' => 600000, 'currentAmount' => 600000, 'startDate' => '2025-08-01', 'endDate' => '2026-04-30', 'status' => 'COMPLETED', 'association_id' => 7, 'category_id' => 6],

            // === Nissa Al Khair (ID=8, cat=7 Femmes et Famille) ===
            ['title' => 'Formation couture pour 50 femmes', 'description' => 'Programme de formation en couture et stylisme pour 50 femmes au chômage à Meknès avec fourniture de machines à coudre.', 'goalAmount' => 200000, 'currentAmount' => 120000, 'startDate' => '2026-02-01', 'endDate' => '2026-08-31', 'status' => 'OPEN', 'association_id' => 8, 'category_id' => 7],
            ['title' => 'Coopérative d\'huile d\'argan', 'description' => 'Création d\'une coopérative féminine d\'huile d\'argan à Essaouira pour 30 femmes avec formation et équipement.', 'goalAmount' => 250000, 'currentAmount' => 250000, 'startDate' => '2025-07-01', 'endDate' => '2026-01-31', 'status' => 'COMPLETED', 'association_id' => 8, 'category_id' => 7],
            ['title' => 'Alphabétisation des femmes rurales', 'description' => 'Programme d\'alphabétisation pour 200 femmes dans 10 douars de la région de Meknès-Fès.', 'goalAmount' => 80000, 'currentAmount' => 35000, 'startDate' => '2026-04-15', 'endDate' => '2026-12-31', 'status' => 'OPEN', 'association_id' => 8, 'category_id' => 7],

            // === Chabab Al Moustaqbal (ID=9, cat=8 Culture et Sport) ===
            ['title' => 'Terrain de football à Kénitra', 'description' => 'Aménagement d\'un terrain de football synthétique dans le quartier Bir Rami pour les jeunes de Kénitra.', 'goalAmount' => 350000, 'currentAmount' => 180000, 'startDate' => '2026-03-01', 'endDate' => '2026-10-31', 'status' => 'OPEN', 'association_id' => 9, 'category_id' => 8],
            ['title' => 'Festival culturel de la jeunesse', 'description' => 'Organisation d\'un festival culturel de 3 jours avec ateliers d\'art, musique, théâtre et expositions pour les jeunes.', 'goalAmount' => 100000, 'currentAmount' => 100000, 'startDate' => '2025-10-01', 'endDate' => '2026-03-31', 'status' => 'COMPLETED', 'association_id' => 9, 'category_id' => 8],
            ['title' => 'Centre de formation artistique', 'description' => 'Création d\'un centre de formation en arts plastiques, musique et théâtre pour 100 jeunes de Kénitra.', 'goalAmount' => 280000, 'currentAmount' => 90000, 'startDate' => '2026-05-01', 'endDate' => '2026-12-31', 'status' => 'OPEN', 'association_id' => 9, 'category_id' => 8],

            // === Fondation Atlas (ID=10, cat=1 Éducation) ===
            ['title' => 'Cours de soutien scolaire gratuits', 'description' => 'Programme de cours de soutien scolaire gratuits pour 500 élèves du collège et lycée à Béni Mellal.', 'goalAmount' => 90000, 'currentAmount' => 90000, 'startDate' => '2025-09-01', 'endDate' => '2026-06-30', 'status' => 'COMPLETED', 'association_id' => 10, 'category_id' => 1],
            ['title' => 'Équipement informatique pour 5 écoles', 'description' => 'Fourniture de 100 ordinateurs et connexion internet pour 5 écoles rurales dans la province de Khénifra.', 'goalAmount' => 300000, 'currentAmount' => 150000, 'startDate' => '2026-01-15', 'endDate' => '2026-09-30', 'status' => 'OPEN', 'association_id' => 10, 'category_id' => 1],

            // === Association Hayat (ID=11, cat=2 Santé) ===
            ['title' => 'Lunettes gratuites pour 500 élèves', 'description' => 'Campagne de dépistage visuel et distribution de lunettes correctives gratuites à 500 élèves de l\'Oriental.', 'goalAmount' => 150000, 'currentAmount' => 85000, 'startDate' => '2026-02-01', 'endDate' => '2026-07-31', 'status' => 'OPEN', 'association_id' => 11, 'category_id' => 2],
            ['title' => 'Ambulance pour la commune d\'Ain Beni Mathar', 'description' => 'Acquisition d\'une ambulance équipée pour la commune d\'Ain Beni Mathar qui ne dispose d\'aucun moyen de transport médical.', 'goalAmount' => 400000, 'currentAmount' => 220000, 'startDate' => '2026-03-01', 'endDate' => '2026-11-30', 'status' => 'OPEN', 'association_id' => 11, 'category_id' => 2],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }
    }
}
