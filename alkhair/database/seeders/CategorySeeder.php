<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Éducation', 'description' => 'Soutien à l\'éducation, bourses scolaires, construction d\'écoles, bibliothèques et fournitures scolaires pour les élèves défavorisés.'],
            ['name' => 'Santé', 'description' => 'Financement d\'opérations chirurgicales, caravanes médicales, soins médicaux, médicaments et équipements pour les hôpitaux.'],
            ['name' => 'Orphelins', 'description' => 'Parrainage d\'orphelins, hébergement, soins de santé, éducation et activités récréatives.'],
            ['name' => 'Environnement', 'description' => 'Protection de l\'environnement, reboisement, nettoyage des plages, recyclage et préservation des ressources naturelles.'],
            ['name' => 'Aide d\'urgence', 'description' => 'Aide aux victimes de catastrophes naturelles, crises humanitaires, distribution alimentaire et fourniture d\'aide d\'urgence.'],
            ['name' => 'Infrastructure', 'description' => 'Construction et rénovation de mosquées, puits, routes, centres communautaires et équipements publics dans les zones défavorisées.'],
            ['name' => 'Femmes et Famille', 'description' => 'Autonomisation des femmes, formation professionnelle, coopératives féminines et soutien aux familles en difficulté.'],
            ['name' => 'Culture et Sport', 'description' => 'Promotion de la culture, activités sportives pour les jeunes, centres culturels et événements communautaires.'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
