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

         $directCount = Project::count();
       
        $filters = $request->only(['search', 'category', 'ville', 'sort']);
        
       if (empty(array_filter($filters))) {
             $projects = $this->cacheService->getOpenProjects();
        } else {
            $projects = ProjectSearchService::search($filters)->limit(12)->get();
        }
        
        $total = $statistics['totalCollected'];
        $impactReports = ImpactReport::with(['project', 'project.category'])->latest()->take(13)->get();
        
        return view('welcome', array_merge(
            compact('projects', 'categories', 'impactReports'),
            [
                'totalCollected' => $total,  
                'totalInMillions' => $total / 1000000,
                'verifiedAssociations' => $statistics['activeAssociations'],
                'completedProjects' => $directCount   
            ]
        ));
    }
}