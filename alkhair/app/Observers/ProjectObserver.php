<?php

namespace App\Observers;

use App\Models\Project;
use App\Services\CacheService;

class ProjectObserver
{
    protected $cacheService;

    public function __construct(CacheService $cacheService)
    {
        $this->cacheService = $cacheService;
    }

    public function created(Project $project): void
    {
        $this->cacheService->clearProjectCache();
    }

    public function updated(Project $project): void
    {
        $this->cacheService->clearProjectCache();
        
        if ($project->isDirty('currentAmount') || $project->isDirty('status')) {
            $this->cacheService->clearStatisticsCache();
        }
    }

    public function deleted(Project $project): void
    {
        $this->cacheService->clearProjectCache();
        $this->cacheService->clearStatisticsCache();
    }
}
