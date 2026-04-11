<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use Carbon\Carbon;
class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::create([
            'title' => 'Campagne Médicale Rurale',
            'description' => 'Fournir des soins médicaux gratuits aux habitants des villages éloignés. Vos dons permettront d\'acheter des médicaments et du matériel médical.',
            'goalAmount' => 50000,
            'currentAmount' => 0,
            'startDate' => Carbon::now(),
            'endDate' => Carbon::now()->addMonths(2),
            'status' => 'OPEN',
            'association_id' => 2,
            'category_id' => 1, 
        ]);
    }
}
