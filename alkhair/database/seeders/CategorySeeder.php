<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $categories = [
    ['name' => 'Développement Rural & Accès à l\'Eau'],
    ['name' => 'Éducation & Soutien Scolaire'],
    ['name' => 'Santé & Caravanes Médicales'],
    ['name' => 'Aide Sociale & Lutte contre la Précarité'],
    ['name' => 'Secours & Urgences'],
    ['name' => 'Inclusion des Personnes Handicapées']
];
        foreach ($categories as $cat) {
            Category::create($cat);
        }
    }
}
