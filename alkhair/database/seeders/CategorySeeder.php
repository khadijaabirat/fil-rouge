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
            ['name' => 'Santé'],
            ['name' => 'Éducation'],
            ['name' => 'Solidarité & Secours'],
            ['name' => 'Développement Durable'],
        ];
        foreach ($categories as $cat) {
            Category::create($cat);
        }
    }
}
