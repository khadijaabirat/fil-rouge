<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use App\Models\Category;
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

        $filters = $request->only(['search', 'category_id', 'ville', 'sort']);
        
        if (empty($filters['search']) && empty($filters['category_id']) && empty($filters['ville'])) {
            $projects = $this->cacheService->getOpenProjects();
        } else {
            $projects = ProjectSearchService::search($filters)->limit(6)->get();
        }
        $total = $statistics['totalCollected'];
return view('welcome', array_merge(
    compact('projects', 'categories'),
    [
         'totalCollected' => $total,  
        'totalInMillions' => $total / 1000000,
        'verifiedAssociations' => $statistics['activeAssociations'],
        'completedProjects' => $statistics['completedProjects']
    ]
));
    }
}