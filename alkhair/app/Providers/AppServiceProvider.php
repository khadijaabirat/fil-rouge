<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Repositories\Interfaces\ProjectRepositoryInterface;
use App\Repositories\ProjectRepository;
use App\Repositories\Interfaces\DonationRepositoryInterface;
use App\Repositories\DonationRepository;
use App\Models\Project;
use App\Observers\ProjectObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProjectRepositoryInterface::class, ProjectRepository::class);
        $this->app->bind(DonationRepositoryInterface::class, DonationRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useTailwind();
        Project::observe(ProjectObserver::class);
        
        // Prévenir le lazy loading en développement
        Model::preventLazyLoading(!app()->isProduction());
        
        
        
        // Partager les statistiques globales avec toutes les vues
        view()->composer('*', function ($view) {
            if (!request()->is('admin/*') && !request()->is('association/*') && !request()->is('donator/*')) {
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
