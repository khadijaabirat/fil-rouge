<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use App\Models\Project;
use App\Models\User;

class CacheService
{
    const CACHE_TTL = 3600; // 1 hour

    public function getStatistics()
    {
        return Cache::remember('statistics', self::CACHE_TTL, function () {
            return [
                'totalCollected' => Project::sum('currentAmount'),
                'activeAssociations' => User::where('role', 'association')
                    ->whereNotNull('kyc_verified_at')
                    ->count(),
                'completedProjects' => Project::where('status', 'COMPLETED')->count(),
                'openProjects' => Project::where('status', 'OPEN')->count(),
            ];
        });
    }

    public function getOpenProjects()
    {
        return Cache::remember('open_projects', self::CACHE_TTL, function () {
            return Project::where('status', 'OPEN')
                ->whereColumn('currentAmount', '<', 'goalAmount')
                ->with(['association', 'category'])
                ->latest()
                ->get();
        });
    }

    public function getCategories()
    {
        return Cache::remember('categories', 86400, function () {
            return \App\Models\Category::all();
        });
    }

    public function clearProjectCache()
    {
        Cache::forget('open_projects');
        Cache::forget('statistics');
    }

    public function clearStatisticsCache()
    {
        Cache::forget('statistics');
    }

    public function clearAllCache()
    {
        Cache::flush();
    }
}
