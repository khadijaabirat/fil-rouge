<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ImpactReport;

class ImpactReportSeeder extends Seeder
{
    public function run(): void
    {
        // Rapports d'impact pour les projets COMPLETED: 2, 7, 8, 10, 13, 16, 20, 22, 25, 27
        $reports = [
            [
                'description' => 'Les bourses ont été distribuées avec succès à 50 étudiants. Ils ont bénéficié d\'une couverture complète des frais d\'inscription, de logement et d\'alimentation. Le taux de réussite aux examens a atteint 92%. 12 étudiants ont obtenu des mentions très bien.',
                'completionDate' => '2026-06-15',
                'videoLink' => 'https://youtube.com/watch?v=bourses2026',
                'project_id' => 2,
            ],
            [
                'description' => 'Les 20 opérations cardiaques ont été réalisées avec un succès total. Tous les enfants sont en bonne santé et mènent une vie normale. La collaboration avec des chirurgiens spécialisés du Maroc et de France a été déterminante. Suivi post-opératoire assuré pendant 6 mois.',
                'completionDate' => '2026-03-20',
                'videoLink' => 'https://youtube.com/watch?v=chirurgie2026',
                'project_id' => 7,
            ],
            [
                'description' => 'La campagne de dépistage du diabète a permis d\'examiner 3500 personnes dans 20 communes. 280 cas de diabète ont été détectés et pris en charge. Un suivi médical régulier a été mis en place avec les centres de santé locaux.',
                'completionDate' => '2026-02-25',
                'videoLink' => 'https://youtube.com/watch?v=diabete2026',
                'project_id' => 8,
            ],
            [
                'description' => 'L\'orphelinat a été entièrement rénové : réfection du toit et des murs, équipement de la cuisine avec du matériel moderne, ameublement des dortoirs avec de nouveaux lits, et réparation des sanitaires. Les 60 enfants vivent désormais dans des conditions dignes.',
                'completionDate' => '2026-02-20',
                'videoLink' => null,
                'project_id' => 10,
            ],
            [
                'description' => 'La plage d\'Essaouira a été nettoyée sur 5 kilomètres. Plus de 300 bénévoles ont participé à la campagne. 50 poubelles ont été installées et 10 ateliers de sensibilisation ont été organisés dans les écoles de la région.',
                'completionDate' => '2026-04-10',
                'videoLink' => 'https://youtube.com/watch?v=plage2026',
                'project_id' => 13,
            ],
            [
                'description' => '3000 paniers alimentaires ont été distribués aux familles démunies dans 15 villes de la région Tanger-Tétouan-Al Hoceïma. Chaque panier contenait : farine, sucre, huile, dattes, lait, thé et autres produits de base pour le Ramadan.',
                'completionDate' => '2026-03-28',
                'videoLink' => 'https://youtube.com/watch?v=ramadan2026',
                'project_id' => 16,
            ],
            [
                'description' => 'La route rurale de 8 km a été achevée et relie désormais 3 douars à la route principale. Plus de 1500 habitants bénéficient d\'un accès facile aux services de santé, aux écoles et aux marchés. Le temps de trajet a été réduit de 2h à 15 minutes.',
                'completionDate' => '2026-04-25',
                'videoLink' => 'https://youtube.com/watch?v=route2026',
                'project_id' => 20,
            ],
            [
                'description' => 'La coopérative d\'huile d\'argan est opérationnelle avec 30 femmes formées. La production mensuelle atteint 200 litres d\'huile d\'argan cosmétique et alimentaire. Les revenus des femmes ont augmenté de 300% en moyenne. Des partenariats ont été signés avec 5 boutiques.',
                'completionDate' => '2026-01-25',
                'videoLink' => 'https://youtube.com/watch?v=argan2026',
                'project_id' => 22,
            ],
            [
                'description' => 'Le festival culturel a accueilli plus de 2000 jeunes sur 3 jours. 15 ateliers d\'art, 8 concerts, 5 pièces de théâtre et 3 expositions ont été organisés. Le festival a révélé 10 jeunes talents qui continuent leur parcours artistique.',
                'completionDate' => '2026-03-15',
                'videoLink' => 'https://youtube.com/watch?v=festival2026',
                'project_id' => 25,
            ],
            [
                'description' => '500 élèves ont bénéficié de cours de soutien gratuits tout au long de l\'année. Le taux de réussite au brevet a atteint 85% contre 60% l\'année précédente. 20 professeurs bénévoles ont participé au programme dans 8 matières.',
                'completionDate' => '2026-06-20',
                'videoLink' => 'https://youtube.com/watch?v=soutien2026',
                'project_id' => 27,
            ],
        ];

        foreach ($reports as $report) {
            ImpactReport::create($report);
        }
    }
}
