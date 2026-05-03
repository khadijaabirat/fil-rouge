<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\Project;
use App\Models\Donation;
use App\Models\User;
use App\Observers\ProjectObserver;
use Illuminate\Database\Eloquent\Model;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useTailwind();
        Project::observe(ProjectObserver::class);
        Model::preventLazyLoading(!app()->isProduction());
        
        view()->composer('*', function ($view) {
            if (!request()->is('admin/*') && !request()->is('association/*') && !request()->is('donator/*') && !request()->is('/')) {
                $view->with([
                    'totalCollected' => \Cache::remember('stats_total_collected', 3600, function() {
                        return \App\Models\Donation::whereIn('status', ['VALIDATED', 'PROCESSING', 'RECEIVED', 'IMPACT'])->sum('amount') ?? 0;
                    }),
                    'verifiedAssociations' => \Cache::remember('stats_verified_associations', 3600, function() {
                        return \App\Models\User::where('role', 'association')->where('status', 'ACTIVE')->count() ?? 0;
                    }),
                    'completedProjects' => \Cache::remember('stats_completed_projects', 3600, function() {
                        return \App\Models\Project::where('status', 'COMPLETED')->count() ?? 0;
                    }),
                ]);
            }
        });
    }
}
