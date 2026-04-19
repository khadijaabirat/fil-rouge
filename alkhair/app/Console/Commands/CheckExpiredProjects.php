<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Project;

class CheckExpiredProjects extends Command
{
    protected $signature = 'projects:check-expired';
    protected $description = 'Check and close expired projects automatically';

    public function handle()
    {
        $expiredProjects = Project::where('status', 'OPEN')
            ->where('endDate', '<', now())
            ->get();

        $count = 0;
        foreach ($expiredProjects as $project) {
            $project->checkDeadline();
            $this->info("Project #{$project->id} - {$project->title} has been closed.");
            $count++;
        }

        $this->info("Total expired projects processed: {$count}");
        return Command::SUCCESS;
    }
}
