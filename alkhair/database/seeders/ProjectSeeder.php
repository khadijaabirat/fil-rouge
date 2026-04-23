<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Category;
use App\Models\User;
class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();
        $associations = User::where('role', 'association')->get();

        if ($categories->isEmpty() || $associations->isEmpty()) {
            $this->command->error('Veuillez lancer CategorySeeder et UserSeeder en premier !');
            return;
        }
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
            ['title' => 'Bourses universitaires 2026', 'description' => 'Programme de bourses pour 50 étudiants issus de familles défavorisées.', 'goalAmount' => 250000, 'currentAmount' => 250000, 'startDate' => '2025-09-01', 'endDate' => '2026-06-30', 'status' => 'OPEN', 'association_id' => 2, 'category_id' => 1],
            ['title' => 'Distribution cartables scolaires', 'description' => 'Distribution de 2000 cartables équipés aux élèves du primaire zones rurales.', 'goalAmount' => 120000, 'currentAmount' => 85000, 'startDate' => '2026-07-01', 'endDate' => '2026-09-15', 'status' => 'OPEN', 'association_id' => 2, 'category_id' => 1],
            ['title' => 'Bibliothèque Ouarzazate', 'description' => 'Création bibliothèque communautaire équipée de livres, ordinateurs et internet.', 'goalAmount' => 150000, 'currentAmount' => 60000, 'startDate' => '2026-03-01', 'endDate' => '2026-11-30', 'status' => 'OPEN', 'association_id' => 2, 'category_id' => 1],
            ['title' => 'Caravane médicale Atlas', 'description' => 'Caravane médicale multidisciplinaire pour habitants douars isolés Haut Atlas.', 'goalAmount' => 180000, 'currentAmount' => 145000, 'startDate' => '2026-03-01', 'endDate' => '2026-05-31', 'status' => 'OPEN', 'association_id' => 3, 'category_id' => 2],
            ['title' => 'Équipement hémodialyse', 'description' => 'Achat 10 appareils hémodialyse au centre de santé de Khouribga.', 'goalAmount' => 800000, 'currentAmount' => 350000, 'startDate' => '2026-02-01', 'endDate' => '2026-12-31', 'status' => 'OPEN', 'association_id' => 3, 'category_id' => 2],
            ['title' => 'Chirurgies cardiaques enfants', 'description' => 'Financement de 20 opérations cardiaques pour enfants malformations congénitales.', 'goalAmount' => 600000, 'currentAmount' => 600000, 'startDate' => '2025-06-01', 'endDate' => '2026-03-31', 'status' => 'OPEN', 'association_id' => 3, 'category_id' => 2],
            ['title' => 'Dépistage diabète', 'description' => 'Campagne dépistage gratuit diabète dans 20 communes rurales Rabat-Salé-Kénitra.', 'goalAmount' => 95000, 'currentAmount' => 95000, 'startDate' => '2025-11-01', 'endDate' => '2026-02-28', 'status' => 'OPEN', 'association_id' => 3, 'category_id' => 2],
            ['title' => 'Parrainage 100 orphelins', 'description' => 'Programme complet parrainage 100 orphelins incluant éducation, alimentation, vêtements.', 'goalAmount' => 360000, 'currentAmount' => 210000, 'startDate' => '2026-01-01', 'endDate' => '2026-12-31', 'status' => 'OPEN', 'association_id' => 4, 'category_id' => 3],
            ['title' => 'Rénovation orphelinat Fès', 'description' => 'Rénovation et équipement orphelinat Fès accueillant 60 orphelins.', 'goalAmount' => 280000, 'currentAmount' => 280000, 'startDate' => '2025-10-01', 'endDate' => '2026-02-28', 'status' => 'OPEN', 'association_id' => 4, 'category_id' => 3],
            ['title' => 'Colonie vacances orphelins', 'description' => 'Organisation colonie vacances été 15 jours à Ifrane pour 80 orphelins.', 'goalAmount' => 120000, 'currentAmount' => 45000, 'startDate' => '2026-05-01', 'endDate' => '2026-08-31', 'status' => 'OPEN', 'association_id' => 4, 'category_id' => 3],
            ['title' => 'Plantation 10000 arganiers', 'description' => 'Plantation 10000 arganiers région Souss-Massa contre désertification.', 'goalAmount' => 200000, 'currentAmount' => 130000, 'startDate' => '2026-02-15', 'endDate' => '2026-08-30', 'status' => 'OPEN', 'association_id' => 5, 'category_id' => 4],
            ['title' => 'Nettoyage plage Essaouira', 'description' => 'Campagne nettoyage et sensibilisation propreté plages avec poubelles intelligentes.', 'goalAmount' => 50000, 'currentAmount' => 50000, 'startDate' => '2026-01-01', 'endDate' => '2026-04-15', 'status' => 'OPEN', 'association_id' => 5, 'category_id' => 4],
            ['title' => 'Recyclage Marrakech', 'description' => 'Programme tri sélectif et recyclage dans 10 quartiers Marrakech.', 'goalAmount' => 180000, 'currentAmount' => 70000, 'startDate' => '2026-04-01', 'endDate' => '2026-12-31', 'status' => 'OPEN', 'association_id' => 5, 'category_id' => 4],
            ['title' => 'Aide victimes inondations', 'description' => 'Aide urgence 500 familles touchées inondations Tétouan: tentes, couvertures, nourriture.', 'goalAmount' => 400000, 'currentAmount' => 280000, 'startDate' => '2026-03-10', 'endDate' => '2026-06-10', 'status' => 'OPEN', 'association_id' => 6, 'category_id' => 5],
            ['title' => 'Paniers Ramadan', 'description' => 'Distribution 3000 paniers alimentaires familles démunies pendant Ramadan.', 'goalAmount' => 300000, 'currentAmount' => 300000, 'startDate' => '2026-02-01', 'endDate' => '2026-03-30', 'status' => 'OPEN', 'association_id' => 6, 'category_id' => 5],
            ['title' => 'Couvertures hiver', 'description' => 'Distribution 2000 couvertures et vêtements chauds familles zones montagneuses.', 'goalAmount' => 160000, 'currentAmount' => 110000, 'startDate' => '2026-09-01', 'endDate' => '2026-12-15', 'status' => 'OPEN', 'association_id' => 6, 'category_id' => 5],
            ['title' => 'Forage 5 puits Souss', 'description' => 'Forage 5 puits équipés pompes solaires province Taroudant pour 2000 habitants.', 'goalAmount' => 350000, 'currentAmount' => 175000, 'startDate' => '2026-04-01', 'endDate' => '2026-10-31', 'status' => 'OPEN', 'association_id' => 7, 'category_id' => 6],
            ['title' => 'Construction mosquée Tizi', 'description' => 'Construction mosquée 300 places au douar Tizi N\'Tichka avec salle Coran.', 'goalAmount' => 450000, 'currentAmount' => 290000, 'startDate' => '2026-01-20', 'endDate' => '2026-09-30', 'status' => 'OPEN', 'association_id' => 7, 'category_id' => 6],
            ['title' => 'Route rurale Tafraout', 'description' => 'Aménagement route rurale 8 km reliant 3 douars isolés route principale.', 'goalAmount' => 600000, 'currentAmount' => 600000, 'startDate' => '2025-08-01', 'endDate' => '2026-04-30', 'status' => 'OPEN', 'association_id' => 7, 'category_id' => 6],
            ['title' => 'Formation couture 50 femmes', 'description' => 'Programme formation couture et stylisme pour 50 femmes au chômage Meknès.', 'goalAmount' => 200000, 'currentAmount' => 120000, 'startDate' => '2026-02-01', 'endDate' => '2026-08-31', 'status' => 'OPEN', 'association_id' => 8, 'category_id' => 7],
            ['title' => 'Coopérative huile argan', 'description' => 'Création coopérative féminine huile argan Essaouira pour 30 femmes.', 'goalAmount' => 250000, 'currentAmount' => 250000, 'startDate' => '2025-07-01', 'endDate' => '2026-01-31', 'status' => 'OPEN', 'association_id' => 8, 'category_id' => 7],
            ['title' => 'Alphabétisation femmes rurales', 'description' => 'Programme alphabétisation pour 200 femmes dans 10 douars région Meknès-Fès.', 'goalAmount' => 80000, 'currentAmount' => 35000, 'startDate' => '2026-04-15', 'endDate' => '2026-12-31', 'status' => 'OPEN', 'association_id' => 8, 'category_id' => 7],
            ['title' => 'Terrain football Kénitra', 'description' => 'Aménagement terrain football synthétique quartier Bir Rami pour jeunes.', 'goalAmount' => 350000, 'currentAmount' => 180000, 'startDate' => '2026-03-01', 'endDate' => '2026-10-31', 'status' => 'OPEN', 'association_id' => 9, 'category_id' => 8],
            ['title' => 'Festival culturel jeunesse', 'description' => 'Organisation festival culturel 3 jours avec ateliers art, musique, théâtre.', 'goalAmount' => 100000, 'currentAmount' => 100000, 'startDate' => '2025-10-01', 'endDate' => '2026-03-31', 'status' => 'OPEN', 'association_id' => 9, 'category_id' => 8],
            ['title' => 'Centre formation artistique', 'description' => 'Création centre formation arts plastiques, musique et théâtre pour 100 jeunes.', 'goalAmount' => 280000, 'currentAmount' => 90000, 'startDate' => '2026-05-01', 'endDate' => '2026-12-31', 'status' => 'OPEN', 'association_id' => 9, 'category_id' => 8],
            ['title' => 'Soutien scolaire gratuit', 'description' => 'Programme cours soutien scolaire gratuits pour 500 élèves collège et lycée.', 'goalAmount' => 90000, 'currentAmount' => 90000, 'startDate' => '2025-09-01', 'endDate' => '2026-06-30', 'status' => 'OPEN', 'association_id' => 10, 'category_id' => 1],
            ['title' => 'Équipement informatique écoles', 'description' => 'Fourniture 100 ordinateurs et internet pour 5 écoles rurales Khénifra.', 'goalAmount' => 300000, 'currentAmount' => 150000, 'startDate' => '2026-01-15', 'endDate' => '2026-09-30', 'status' => 'OPEN', 'association_id' => 10, 'category_id' => 1],
            ['title' => 'Lunettes gratuites élèves', 'description' => 'Campagne dépistage visuel et distribution lunettes correctives 500 élèves.', 'goalAmount' => 150000, 'currentAmount' => 85000, 'startDate' => '2026-02-01', 'endDate' => '2026-07-31', 'status' => 'OPEN', 'association_id' => 11, 'category_id' => 2],
            ['title' => 'Ambulance Ain Beni Mathar', 'description' => 'Acquisition ambulance équipée pour commune Ain Beni Mathar.', 'goalAmount' => 400000, 'currentAmount' => 220000, 'startDate' => '2026-03-01', 'endDate' => '2026-11-30', 'status' => 'OPEN', 'association_id' => 11, 'category_id' => 2],
        ];
            
       $imageMapping = [
            1 => 'projects/ecole-azilal.jpg',
            2 => 'projects/bourses-scolaires.jpg',
            3 => 'projects/تلميذات-القرية-البادية-التعليم.jpg',
            4 => 'projects/Berber-Children-in-High-Atlas-Mountain-Village.jpg',
            5 => 'projects/caravane-medicale.jpg',
            6 => 'projects/equipement-medical.jpg',
            7 => 'projects/chirurgie-cardiaque-enfants.jpg',
            8 => 'projects/caravane-medical-azilal-1.webp',
            9 => 'projects/kids.jpg',
            10 => 'projects/orphelinat-renovation.jpg',
            11 => 'projects/gamins-web-min-1024x527.jpg',
            12 => 'projects/AP21343295096208.webp',
            13 => 'projects/AP21343295706990.webp',
            14 => 'projects/AP21343297259037.webp',
            15 => 'projects/urgence-inondations.jpg',
            16 => 'projects/ramadan-2026.jpg',
            17 => 'projects/kit.jpg',
            18 => 'projects/AP21343297643406.webp',
            19 => 'projects/27972940_2126986834252067_4949258701297817566_n.jpg',
            20 => 'projects/27731582_1518707043.2439_funddescription.jpg',
            21 => 'projects/formation-professionnelle.jpg',
            22 => 'projects/مؤسسة-محمد-السادس-للتصامن.webp',
            23 => 'projects/مغربية-من-تنغير.jpg',
            24 => 'projects/DJH6Od3W4AAERzQ.jpg',
            25 => 'projects/9e.jpg',
            26 => 'projects/sm_1689264556.346682.jpg',
            27 => 'projects/les-ecoliers-et-la-maitresse-de-l-ecole-du-village-d-imzour-dans-le-haut-atlas-marocain-remercient-les-associations-qui-se-sont-mobilisees-pour-eux-photos-dna-martine-klein-1509218193.jpg',
            28 => 'projects/childrenmorocco_222582630.webp',
            29 => 'projects/files-23674.jpg',
            30 => 'projects/lead.jpg',
        ];

foreach ($projects as $index => $projectData) {
            $city = $moroccanCities[$index % count($moroccanCities)];
            
            $projectData['latitude'] = $city['lat'] + (rand(-100, 100) / 1000);
            $projectData['longitude'] = $city['lng'] + (rand(-100, 100) / 1000);
            $projectData['image'] = $imageMapping[$index] ?? null;  
            Project::create($projectData);
        }

$projectsData = [
            [
                'title' => 'Parrainage 100 orphelins',
                'description' => 'Programme complet de parrainage pour 100 orphelins incluant éducation, santé, alimentation et vêtements. Les orphelins parrainés ont pu participer à des activités éducatives et sportives.',
                'category' => 'Orphelins',
                'image' => 'impacts/036097d4-b29d-4dce-b22b-7fc3d52fa040.webp',
                'impact_desc' => 'Les 100 orphelins parrainés ont bénéficié d\'un suivi complet. Ils ont tous été scolarisés et suivent des activités parascolaires. L\'impact est visible sur leur épanouissement.'
            ],
            [
                'title' => 'Construction mosquée Tizi N\'Tichka',
                'description' => 'Construction d\'une mosquée de 300 places au douar Tizi N\'Tichka avec salle d\'enseignement coranique. L\'architecture traditionnelle marocaine a été respectée.',
                'category' => 'Infrastructure',
                'image' => 'impacts/0406df8c-c171-4bbe-a39c-f1381b9437b7.jpeg',
                'impact_desc' => 'La mosquée a été inaugurée avec succès. Plus de 300 fidèles peuvent désormais prier dans des conditions dignes. Une salle coranique accueille 50 enfants.'
            ],
            [
                'title' => 'Plantation 10000 arganiers Souss-Massa',
                'description' => 'Projet de reboisement avec plantation de 10000 arganiers dans la région de Souss-Massa pour lutter contre la désertification et préserver l\'écosystème.',
                'category' => 'Environnement',
                'image' => 'impacts/503266.webp',
                'impact_desc' => 'Les 10000 arganiers ont été plantés avec un taux de survie de 85%. Le projet contribue à la lutte contre la désertification et génère des revenus pour les coopératives locales.'
            ],
            [
                'title' => 'Aide d\'urgence familles démunies',
                'description' => 'Distribution de paniers alimentaires et aide d\'urgence pour 500 familles en situation de précarité extrême dans plusieurs régions du Maroc.',
                'category' => 'Urgence',
                'image' => 'impacts/5RC5XIJ4QJGGFFFNBYNTEIF4Z4.jpg',
                'impact_desc' => 'Une vaste opération de distribution a permis d\'aider 500 familles. Chaque panier contenait des denrées de base pour un mois. Les bénéficiaires expriment leur gratitude.'
            ],
            [
                'title' => 'Préservation forêt d\'arganiers',
                'description' => 'Programme de protection et préservation de la forêt d\'arganiers menacée par la sécheresse et l\'exploitation excessive. Sensibilisation des populations locales.',
                'category' => 'Environnement',
                'image' => 'impacts/673497a2a42c9.png',
                'impact_desc' => 'Ce projet a permis de protéger 50 hectares de forêt d\'arganiers. Des sessions de sensibilisation ont touché 200 familles qui vivent de cette ressource.'
            ],
            [
                'title' => 'Rénovation centre social personnes âgées',
                'description' => 'Rénovation complète d\'un centre social accueillant 150 personnes âgées avec équipements modernes, fauteuils roulants et matériel médical.',
                'category' => 'Infrastructure',
                'image' => 'impacts/920231720640234364622.webp',
                'impact_desc' => 'Le centre a été entièrement rénové. 150 personnes âgées bénéficient désormais d\'un cadre de vie digne avec équipements adaptés et personnel qualifié.'
            ],
            [
                'title' => 'Construction école primaire rurale',
                'description' => 'Construction d\'une école primaire de 6 classes dans une zone rurale isolée pour accueillir 200 élèves des douars environnants.',
                'category' => 'Éducation',
                'image' => 'impacts/AKFGRZLUTZHTVKGQAH2NPXI45U.jpg',
                'impact_desc' => 'L\'école a ouvert ses portes avec 6 classes modulaires équipées. 200 enfants sont scolarisés et n\'ont plus à parcourir 10 km à pied pour étudier.'
            ],
            [
                'title' => 'Colonie de vacances pour orphelins',
                'description' => 'Organisation d\'une colonie de vacances de 15 jours à Ifrane pour 80 orphelins avec activités éducatives, sportives et culturelles.',
                'category' => 'Orphelins',
                'image' => 'impacts/DSC0436-scaled.jpg',
                'impact_desc' => 'La colonie a été un immense succès. 80 orphelins ont découvert la montagne, pratiqué des sports et participé à des ateliers créatifs. Des souvenirs inoubliables!'
            ],
            [
                'title' => 'Équipement hémodialyse dispensaire',
                'description' => 'Achat et installation de 10 appareils d\'hémodialyse modernes au centre de santé pour améliorer la prise en charge des patients insuffisants rénaux.',
                'category' => 'Santé',
                'image' => 'impacts/Dialyse-maroc-2012-07-16.jpg',
                'impact_desc' => 'Les 10 nouveaux appareils de dialyse sont opérationnels. 60 patients bénéficient de séances régulières dans des conditions optimales, évitant les déplacements lointains.'
            ],
            [
                'title' => 'Lunettes gratuites 500 élèves',
                'description' => 'Campagne de dépistage visuel et distribution de lunettes correctives gratuites pour 500 élèves nécessiteux des zones rurales.',
                'category' => 'Santé',
                'image' => 'impacts/GJSon-4XsAAyZsX-780x470.jpeg',
                'impact_desc' => 'Des centaines d\'élèves ont reçu des examens ophtalmologiques complets. 500 paires de lunettes ont été distribuées, améliorant significativement leur scolarité.'
            ],
            [
                'title' => 'Assistance médicale d\'urgence',
                'description' => 'Programme d\'assistance médicale d\'urgence pour les populations isolées avec distribution de médicaments et consultations gratuites.',
                'category' => 'Santé',
                'image' => 'impacts/M25MFSYMXBHFRP24ICLIHHT7IM.avif',
                'impact_desc' => 'Une aide médicale précieuse a été fournie à plus de 300 personnes. Les médicaments essentiels ont été distribués et des consultations spécialisées organisées.'
            ],
            [
                'title' => 'Distribution 2000 cartables scolaires',
                'description' => 'Distribution massive de 2000 cartables équipés de fournitures scolaires complètes aux élèves défavorisés pour la rentrée scolaire.',
                'category' => 'Éducation',
                'image' => 'impacts/Sans-titre-1-01-1-1024x1024.webp',
                'impact_desc' => 'Distribution réussie de 2000 cartables complets. Les élèves ont démarré l\'année scolaire avec tout le matériel nécessaire. Les parents sont soulagés financièrement.'
            ],
            [
                'title' => 'Forage 5 puits Taroudant',
                'description' => 'Forage de 5 puits équipés de pompes solaires dans la province de Taroudant pour fournir l\'eau potable à 2000 habitants.',
                'category' => 'Infrastructure',
                'image' => 'impacts/abar-1.jpeg',
                'impact_desc' => 'Les 5 puits ont été forés avec succès et atteignent l\'eau à 40m de profondeur. Les pompes solaires fonctionnent parfaitement. 2000 personnes ont accès à l\'eau potable.'
            ],
            [
                'title' => 'Bibliothèque communautaire équipée',
                'description' => 'Création d\'une bibliothèque communautaire moderne équipée de 5000 livres, ordinateurs et connexion internet pour les jeunes.',
                'category' => 'Éducation',
                'image' => 'impacts/cahier-scolaires.jpg',
                'impact_desc' => 'La bibliothèque est ouverte et accueille quotidiennement 50 à 80 jeunes. Les 5000 livres et 10 ordinateurs sont très sollicités. Un espace d\'apprentissage précieux.'
            ],
            [
                'title' => 'Caravane médicale Haut Atlas',
                'description' => 'Organisation de caravanes médicales multidisciplinaires dans 15 douars isolés du Haut Atlas avec médecins spécialistes.',
                'category' => 'Santé',
                'image' => 'impacts/caravane-medical-azilal-1.webp',
                'impact_desc' => 'La caravane a parcouru 15 douars isolés. Plus de 800 consultations gratuites ont été réalisées par des médecins spécialistes. Médicaments distribués sur place.'
            ],
            [
                'title' => 'Ambulance médicalisée Ouarzazate',
                'description' => 'Acquisition d\'une ambulance médicalisée équipée pour la commune rurale d\'Ouarzazate afin d\'assurer les évacuations d\'urgence.',
                'category' => 'Santé',
                'image' => 'impacts/caravane-medical-fm6-education-region-rabat6.webp',
                'impact_desc' => 'L\'ambulance médicalisée est opérationnelle 24h/24. Elle a déjà effectué 50 évacuations d\'urgence, sauvant plusieurs vies dans cette région isolée.'
            ],
            [
                'title' => 'Soutien scolaire gratuit 500 élèves',
                'description' => 'Programme de cours de soutien scolaire gratuits pour 500 élèves en difficulté du primaire et collège avec enseignants qualifiés.',
                'category' => 'Éducation',
                'image' => 'impacts/images (7).jpg',
                'impact_desc' => 'Les enfants en difficulté bénéficient de 3 séances hebdomadaires. Les résultats scolaires se sont nettement améliorés. Les parents constatent les progrès.'
            ],
            [
                'title' => 'Forage puits solaire village isolé',
                'description' => 'Forage d\'un puits profond équipé d\'une pompe solaire pour alimenter en eau potable un village isolé de 300 habitants.',
                'category' => 'Infrastructure',
                'image' => 'impacts/jub-750x430-1.jpg',
                'impact_desc' => 'Le nouveau puits apporte l\'eau potable à 300 habitants. Les femmes n\'ont plus à parcourir 5 km quotidiennement. La pompe solaire fonctionne sans frais d\'électricité.'
            ],
            [
                'title' => 'Réhabilitation école ancienne',
                'description' => 'Réhabilitation complète d\'une école ancienne de 8 classes avec rénovation des sanitaires, installation de l\'électricité et création d\'une cantine.',
                'category' => 'Éducation',
                'image' => 'impacts/kit.jpg',
                'impact_desc' => 'L\'école a été entièrement réhabilitée. Les 8 classes sont rénovées, les sanitaires modernes installés et une cantine scolaire créée. 300 élèves en bénéficient.'
            ],
            [
                'title' => 'Soutien scolaire villages Atlas',
                'description' => 'Programme de soutien scolaire dans 10 villages de l\'Atlas avec distribution de fournitures et cours de rattrapage pour 200 élèves.',
                'category' => 'Éducation',
                'image' => 'impacts/les-ecoliers-et-la-maitresse-de-l-ecole-du-village-d-imzour-dans-le-haut-atlas-marocain-remercient-les-associations-qui-se-sont-mobilisees-pour-eux-photos-dna-martine-klein-1509218193.jpg',
                'impact_desc' => 'Les élèves de 10 villages ont bénéficié de cours de soutien et d\'activités éducatives. Les enseignants et les familles remercient chaleureusement les donateurs.'
            ],
            [
                'title' => 'Paniers Ramadan 3000 familles',
                'description' => 'Distribution de 3000 paniers alimentaires complets aux familles démunies pendant le mois sacré de Ramadan.',
                'category' => 'Urgence',
                'image' => 'impacts/ramadan-corona.png',
                'impact_desc' => 'Distribution réussie de 3000 paniers de Ramadan. Chaque panier contenait des denrées essentielles pour tout le mois. Les familles ont pu célébrer dignement.'
            ],
            [
                'title' => 'Aide urgence familles sinistrées séisme',
                'description' => 'Aide d\'urgence pour 200 familles touchées par le séisme: tentes, couvertures, nourriture, eau et médicaments.',
                'category' => 'Urgence',
                'image' => 'impacts/seisme-maroc-aide-associations.webp',
                'impact_desc' => 'Les convois d\'aide sont arrivés rapidement dans les zones sinistrées. 200 familles ont reçu tentes, couvertures et vivres. Un soutien psychologique a été apporté.'
            ],
            [
                'title' => 'Clinique mobile zones rurales',
                'description' => 'Mise en place d\'une clinique mobile équipée pour assurer des consultations médicales gratuites dans les villages isolés.',
                'category' => 'Santé',
                'image' => 'impacts/unnamed (1).jpg',
                'impact_desc' => 'La clinique mobile parcourt 20 villages mensuellement. Les soins sont prodigués directement sur place. Plus de 500 consultations gratuites par mois.'
            ],
            [
                'title' => 'Aménagement route rurale 8km',
                'description' => 'Aménagement d\'une route rurale de 8 km reliant 3 douars isolés à la route principale pour faciliter l\'accès aux services.',
                'category' => 'Infrastructure',
                'image' => 'impacts/whatsapp 07-382384432eb940c8bd90067052c8cede.jpg',
                'impact_desc' => 'La route de 8 km a été aménagée avec succès. Les 3 douars sont désormais accessibles en toute saison. Les habitants se sont mobilisés pour l\'entretien.'
            ],
            [
                'title' => 'Programme nutrition enfants malnutris',
                'description' => 'Programme de nutrition et suivi médical pour 300 enfants souffrant de malnutrition avec distribution de compléments alimentaires.',
                'category' => 'Santé',
                'image' => 'impacts/مؤسسة-محمد-السادس-للتصامن.webp',
                'impact_desc' => 'Le programme a permis de suivre 300 enfants malnutris. Les compléments alimentaires et médicaments ont été distribués. L\'état de santé s\'améliore progressivement.'
            ],
        ];
        $association = $associations->first();

        foreach ($projectsData as $data) {
            $category = $categories->firstWhere('name', $data['category']) ?? $categories->random();
            $goal = rand(50000, 500000);
          Project::create([
                'title' => $data['title'],
                'description' => $data['description'],
                'goalAmount' => $goal,
                'currentAmount' => $goal,  
                'startDate' => now()->subMonths(rand(6, 12)),
                'endDate' => now()->subMonths(rand(1, 3)),
                'status' => 'COMPLETED',
                'association_id' => $association->id,
                'category_id' => $category->id,
                'image' => $data['image'],
                'latitude' => 31.7917 + (rand(-100, 100) / 1000),  
                'longitude' => -7.0926 + (rand(-100, 100) / 1000),
            ]);
        
    }
    }
}