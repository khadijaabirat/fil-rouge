<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $moroccanCities = [
            ['name' => 'Casablanca', 'lat' => 33.5731, 'lng' => -7.5898],
            ['name' => 'Rabat', 'lat' => 34.0209, 'lng' => -6.8416],
            ['name' => 'Marrakech', 'lat' => 31.6295, 'lng' => -7.9811],
            ['name' => 'Fès', 'lat' => 34.0181, 'lng' => -5.0078],
            ['name' => 'Tanger', 'lat' => 35.7595, 'lng' => -5.8340],
            ['name' => 'Agadir', 'lat' => 30.4278, 'lng' => -9.5981],
            ['name' => 'Meknès', 'lat' => 33.8935, 'lng' => -5.5473],
            ['name' => 'Oujda', 'lat' => 34.6814, 'lng' => -1.9086],
            ['name' => 'Kénitra', 'lat' => 34.2610, 'lng' => -6.5802],
            ['name' => 'Tétouan', 'lat' => 35.5889, 'lng' => -5.3626],
        ];

        $projects = [
            ['title' => 'Construction école Ait Hamou', 'description' => 'Construction école primaire 6 classes dans le douar Ait Hamou, province Azilal, pour 200 enfants.', 'goalAmount' => 500000, 'currentAmount' => 320000, 'startDate' => '2026-01-15', 'endDate' => '2026-07-30', 'status' => 'OPEN', 'association_id' => 2, 'category_id' => 1],
            ['title' => 'Bourses universitaires 2026', 'description' => 'Programme de bourses pour 50 étudiants issus de familles défavorisées.', 'goalAmount' => 250000, 'currentAmount' => 250000, 'startDate' => '2025-09-01', 'endDate' => '2026-06-30', 'status' => 'COMPLETED', 'association_id' => 2, 'category_id' => 1],
            ['title' => 'Distribution cartables scolaires', 'description' => 'Distribution de 2000 cartables équipés aux élèves du primaire zones rurales.', 'goalAmount' => 120000, 'currentAmount' => 85000, 'startDate' => '2026-07-01', 'endDate' => '2026-09-15', 'status' => 'OPEN', 'association_id' => 2, 'category_id' => 1],
            ['title' => 'Bibliothèque Ouarzazate', 'description' => 'Création bibliothèque communautaire équipée de livres, ordinateurs et internet.', 'goalAmount' => 150000, 'currentAmount' => 60000, 'startDate' => '2026-03-01', 'endDate' => '2026-11-30', 'status' => 'OPEN', 'association_id' => 2, 'category_id' => 1],
            ['title' => 'Caravane médicale Atlas', 'description' => 'Caravane médicale multidisciplinaire pour habitants douars isolés Haut Atlas.', 'goalAmount' => 180000, 'currentAmount' => 145000, 'startDate' => '2026-03-01', 'endDate' => '2026-05-31', 'status' => 'OPEN', 'association_id' => 3, 'category_id' => 2],
            ['title' => 'Équipement hémodialyse', 'description' => 'Achat 10 appareils hémodialyse au centre de santé de Khouribga.', 'goalAmount' => 800000, 'currentAmount' => 350000, 'startDate' => '2026-02-01', 'endDate' => '2026-12-31', 'status' => 'OPEN', 'association_id' => 3, 'category_id' => 2],
            ['title' => 'Chirurgies cardiaques enfants', 'description' => 'Financement de 20 opérations cardiaques pour enfants malformations congénitales.', 'goalAmount' => 600000, 'currentAmount' => 600000, 'startDate' => '2025-06-01', 'endDate' => '2026-03-31', 'status' => 'COMPLETED', 'association_id' => 3, 'category_id' => 2],
            ['title' => 'Dépistage diabète', 'description' => 'Campagne dépistage gratuit diabète dans 20 communes rurales Rabat-Salé-Kénitra.', 'goalAmount' => 95000, 'currentAmount' => 95000, 'startDate' => '2025-11-01', 'endDate' => '2026-02-28', 'status' => 'COMPLETED', 'association_id' => 3, 'category_id' => 2],
            ['title' => 'Parrainage 100 orphelins', 'description' => 'Programme complet parrainage 100 orphelins incluant éducation, alimentation, vêtements.', 'goalAmount' => 360000, 'currentAmount' => 210000, 'startDate' => '2026-01-01', 'endDate' => '2026-12-31', 'status' => 'OPEN', 'association_id' => 4, 'category_id' => 3],
            ['title' => 'Rénovation orphelinat Fès', 'description' => 'Rénovation et équipement orphelinat Fès accueillant 60 orphelins.', 'goalAmount' => 280000, 'currentAmount' => 280000, 'startDate' => '2025-10-01', 'endDate' => '2026-02-28', 'status' => 'COMPLETED', 'association_id' => 4, 'category_id' => 3],
            ['title' => 'Colonie vacances orphelins', 'description' => 'Organisation colonie vacances été 15 jours à Ifrane pour 80 orphelins.', 'goalAmount' => 120000, 'currentAmount' => 45000, 'startDate' => '2026-05-01', 'endDate' => '2026-08-31', 'status' => 'OPEN', 'association_id' => 4, 'category_id' => 3],
            ['title' => 'Plantation 10000 arganiers', 'description' => 'Plantation 10000 arganiers région Souss-Massa contre désertification.', 'goalAmount' => 200000, 'currentAmount' => 130000, 'startDate' => '2026-02-15', 'endDate' => '2026-08-30', 'status' => 'OPEN', 'association_id' => 5, 'category_id' => 4],
            ['title' => 'Nettoyage plage Essaouira', 'description' => 'Campagne nettoyage et sensibilisation propreté plages avec poubelles intelligentes.', 'goalAmount' => 50000, 'currentAmount' => 50000, 'startDate' => '2026-01-01', 'endDate' => '2026-04-15', 'status' => 'COMPLETED', 'association_id' => 5, 'category_id' => 4],
            ['title' => 'Recyclage Marrakech', 'description' => 'Programme tri sélectif et recyclage dans 10 quartiers Marrakech.', 'goalAmount' => 180000, 'currentAmount' => 70000, 'startDate' => '2026-04-01', 'endDate' => '2026-12-31', 'status' => 'OPEN', 'association_id' => 5, 'category_id' => 4],
            ['title' => 'Aide victimes inondations', 'description' => 'Aide urgence 500 familles touchées inondations Tétouan: tentes, couvertures, nourriture.', 'goalAmount' => 400000, 'currentAmount' => 280000, 'startDate' => '2026-03-10', 'endDate' => '2026-06-10', 'status' => 'OPEN', 'association_id' => 6, 'category_id' => 5],
            ['title' => 'Paniers Ramadan', 'description' => 'Distribution 3000 paniers alimentaires familles démunies pendant Ramadan.', 'goalAmount' => 300000, 'currentAmount' => 300000, 'startDate' => '2026-02-01', 'endDate' => '2026-03-30', 'status' => 'COMPLETED', 'association_id' => 6, 'category_id' => 5],
            ['title' => 'Couvertures hiver', 'description' => 'Distribution 2000 couvertures et vêtements chauds familles zones montagneuses.', 'goalAmount' => 160000, 'currentAmount' => 110000, 'startDate' => '2026-09-01', 'endDate' => '2026-12-15', 'status' => 'OPEN', 'association_id' => 6, 'category_id' => 5],
            ['title' => 'Forage 5 puits Souss', 'description' => 'Forage 5 puits équipés pompes solaires province Taroudant pour 2000 habitants.', 'goalAmount' => 350000, 'currentAmount' => 175000, 'startDate' => '2026-04-01', 'endDate' => '2026-10-31', 'status' => 'OPEN', 'association_id' => 7, 'category_id' => 6],
            ['title' => 'Construction mosquée Tizi', 'description' => 'Construction mosquée 300 places au douar Tizi N\'Tichka avec salle Coran.', 'goalAmount' => 450000, 'currentAmount' => 290000, 'startDate' => '2026-01-20', 'endDate' => '2026-09-30', 'status' => 'OPEN', 'association_id' => 7, 'category_id' => 6],
            ['title' => 'Route rurale Tafraout', 'description' => 'Aménagement route rurale 8 km reliant 3 douars isolés route principale.', 'goalAmount' => 600000, 'currentAmount' => 600000, 'startDate' => '2025-08-01', 'endDate' => '2026-04-30', 'status' => 'COMPLETED', 'association_id' => 7, 'category_id' => 6],
            ['title' => 'Formation couture 50 femmes', 'description' => 'Programme formation couture et stylisme pour 50 femmes au chômage Meknès.', 'goalAmount' => 200000, 'currentAmount' => 120000, 'startDate' => '2026-02-01', 'endDate' => '2026-08-31', 'status' => 'OPEN', 'association_id' => 8, 'category_id' => 7],
            ['title' => 'Coopérative huile argan', 'description' => 'Création coopérative féminine huile argan Essaouira pour 30 femmes.', 'goalAmount' => 250000, 'currentAmount' => 250000, 'startDate' => '2025-07-01', 'endDate' => '2026-01-31', 'status' => 'COMPLETED', 'association_id' => 8, 'category_id' => 7],
            ['title' => 'Alphabétisation femmes rurales', 'description' => 'Programme alphabétisation pour 200 femmes dans 10 douars région Meknès-Fès.', 'goalAmount' => 80000, 'currentAmount' => 35000, 'startDate' => '2026-04-15', 'endDate' => '2026-12-31', 'status' => 'OPEN', 'association_id' => 8, 'category_id' => 7],
            ['title' => 'Terrain football Kénitra', 'description' => 'Aménagement terrain football synthétique quartier Bir Rami pour jeunes.', 'goalAmount' => 350000, 'currentAmount' => 180000, 'startDate' => '2026-03-01', 'endDate' => '2026-10-31', 'status' => 'OPEN', 'association_id' => 9, 'category_id' => 8],
            ['title' => 'Festival culturel jeunesse', 'description' => 'Organisation festival culturel 3 jours avec ateliers art, musique, théâtre.', 'goalAmount' => 100000, 'currentAmount' => 100000, 'startDate' => '2025-10-01', 'endDate' => '2026-03-31', 'status' => 'COMPLETED', 'association_id' => 9, 'category_id' => 8],
            ['title' => 'Centre formation artistique', 'description' => 'Création centre formation arts plastiques, musique et théâtre pour 100 jeunes.', 'goalAmount' => 280000, 'currentAmount' => 90000, 'startDate' => '2026-05-01', 'endDate' => '2026-12-31', 'status' => 'OPEN', 'association_id' => 9, 'category_id' => 8],
            ['title' => 'Soutien scolaire gratuit', 'description' => 'Programme cours soutien scolaire gratuits pour 500 élèves collège et lycée.', 'goalAmount' => 90000, 'currentAmount' => 90000, 'startDate' => '2025-09-01', 'endDate' => '2026-06-30', 'status' => 'COMPLETED', 'association_id' => 10, 'category_id' => 1],
            ['title' => 'Équipement informatique écoles', 'description' => 'Fourniture 100 ordinateurs et internet pour 5 écoles rurales Khénifra.', 'goalAmount' => 300000, 'currentAmount' => 150000, 'startDate' => '2026-01-15', 'endDate' => '2026-09-30', 'status' => 'OPEN', 'association_id' => 10, 'category_id' => 1],
            ['title' => 'Lunettes gratuites élèves', 'description' => 'Campagne dépistage visuel et distribution lunettes correctives 500 élèves.', 'goalAmount' => 150000, 'currentAmount' => 85000, 'startDate' => '2026-02-01', 'endDate' => '2026-07-31', 'status' => 'OPEN', 'association_id' => 11, 'category_id' => 2],
            ['title' => 'Ambulance Ain Beni Mathar', 'description' => 'Acquisition ambulance équipée pour commune Ain Beni Mathar.', 'goalAmount' => 400000, 'currentAmount' => 220000, 'startDate' => '2026-03-01', 'endDate' => '2026-11-30', 'status' => 'OPEN', 'association_id' => 11, 'category_id' => 2],
        ];

        foreach ($projects as $index => $project) {
            $city = $moroccanCities[$index % count($moroccanCities)];
            $project['latitude'] = $city['lat'] + (rand(-100, 100) / 1000);
            $project['longitude'] = $city['lng'] + (rand(-100, 100) / 1000);
            Project::create($project);
        }
    }
}
