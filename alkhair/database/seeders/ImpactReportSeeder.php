<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ImpactReport;
use App\Models\Project;
use Carbon\Carbon;
class ImpactReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $finishedProjects = Project::whereIn('status', ['COMPLETED', 'CLOSED'])->get();

        foreach ($finishedProjects as $project) {
            ImpactReport::create([
                'description' => "Grâce à vos généreux dons, nous avons pu finaliser ce projet avec succès. L'impact sur la communauté locale est immense et immédiat. Les fonds ont été utilisés intégralement pour la réalisation des travaux conformément au plan initial. Merci du fond du cœur à tous nos bienfaiteurs !",
                'completionDate' => Carbon::parse($project->endDate)->subDays(rand(1, 5)), // داروه قبل ما يسالي الوقت بشوية
                'videoLink' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', // فيديو افتراضي
                'project_id' => $project->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
