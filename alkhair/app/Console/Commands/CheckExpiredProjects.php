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

        $closedCount = 0;
        $completedCount = 0;
        
        foreach ($expiredProjects as $project) {
            $oldStatus = $project->status;
            $isExpired = $project->checkDeadline();
            
            if ($isExpired) {
                $newStatus = $project->fresh()->status;
                
                if ($newStatus === 'CLOSED') {
                    $this->warn("Project #{$project->id} - {$project->title} -> CLOSED (objectif non atteint)");
                    $closedCount++;
                } elseif ($newStatus === 'COMPLETED') {
                    $this->info("Project #{$project->id} - {$project->title} -> COMPLETED (objectif atteint)");
                    $completedCount++;
                }
            }
        }

        $this->info("\nResume:");
        $this->info("{$completedCount} projet(s) complete(s)");
        $this->warn("{$closedCount} projet(s) ferme(s)");
        $this->info("Total: " . ($closedCount + $completedCount) . " projet(s) traite(s)");
        
        return Command::SUCCESS; 
    }
}
