<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Project;

class CheckExpiredProjects extends Command
{
protected $signature = 'projects:close-expired';
protected $description = 'Ferme automatiquement les projets dont la date limite est dépassée';
    public function handle()
    {
        $expiredProjects = Project::where('status', 'OPEN')
            ->where('endDate', '<', now())
            ->get();

        $count = 0;
        foreach ($expiredProjects as $project) {
           $isCompleted = $project->checkDeadline();
            
            if ($isCompleted) {
            $this->info("Project #{$project->id} - {$project->title} has been closed.");
            $count++;
            }
        }

$this->info("{$count} projets ont été fermés automatiquement.");
        return Command::SUCCESS; 
    }
}
