<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ImpactReport;
use App\Models\Project;
 
class ImpactReportSeeder extends Seeder
{
    public function run(): void
    {
        $completedProjects = Project::where('status', 'COMPLETED')->get();
     foreach ($completedProjects as $project) {
             if (!$project->impactReport()->exists()) {
                ImpactReport::create([
                    'project_id' => $project->id,
                    'description' => 'Le projet "' . $project->title . '" a été réalisé avec grand succès. Nous remercions tous les donateurs pour leur générosité qui a rendu cela possible.',
                    'completionDate' => $project->endDate ?? now()->subDays(rand(1, 60)),
                    'videoLink' => null,
                ]);
            }
        }
    }
}
