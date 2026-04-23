<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use App\Models\Category;
use App\Models\ImpactReport;
use App\Services\ProjectSearchService;
use App\Services\CacheService;

class HomeController extends Controller
{
    protected $cacheService;

    public function __construct(CacheService $cacheService)
    {
        $this->cacheService = $cacheService;
    }

    public function index(Request $request)
    {
        $statistics = $this->cacheService->getStatistics();
        $categories = $this->cacheService->getCategories();

        $filters = $request->only(['search', 'category', 'ville', 'sort']);
        
        if (empty($filters['search']) && empty($filters['category']) && empty($filters['ville'])) {
            $projects = $this->cacheService->getOpenProjects();
        } else {
            $query = Project::with(['association', 'category'])
                ->where('status', 'OPEN')
                ->whereColumn('currentAmount', '<', 'goalAmount');
            
            if (!empty($filters['search'])) {
                $query->where(function($q) use ($filters) {
                    $q->where('title', 'like', '%' . $filters['search'] . '%')
                      ->orWhere('description', 'like', '%' . $filters['search'] . '%');
                });
            }
            
            if (!empty($filters['category'])) {
                $query->where('category_id', $filters['category']);
            }

            if (!empty($filters['ville'])) {
                $query->whereHas('association', function($q) use ($filters) {
                    $q->where('ville', $filters['ville']);
                });
            }
            
            $projects = $query->latest()->limit(12)->get();
        }
        
        $total = $statistics['totalCollected'];
        $impactReports = ImpactReport::with(['project', 'project.category'])->latest()->take(13)->get();
        
        return view('welcome', array_merge(
            compact('projects', 'categories', 'impactReports'),
            [
                'totalCollected' => $total,  
                'totalInMillions' => $total / 1000000,
                'verifiedAssociations' => $statistics['activeAssociations'],
                'completedProjects' => $statistics['completedProjects']
            ]
        ));
    }
}