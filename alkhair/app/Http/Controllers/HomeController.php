<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use App\Models\Category;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $totalCollected = Project::sum('currentAmount');
         $formattedTotal = number_format($totalCollected, 2, ',', ' '); 

        $verifiedAssociations = User::where('role', 'association')->count();
        $completedProjects = Project::count();
        $categories = Category::all();

        $projects = Project::where('status', 'OPEN')
            ->when($request->search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                    ->orWhereHas('association', function ($assocQuery) use ($search) {
                        $assocQuery->where('ville', 'like', "%{$search}%");
                    });
            })
            ->when($request->category, function ($query, $category) {
                return $query->where('category_id', $category);
            })
            ->with('association')
            ->get();

        return view('welcome', compact('projects', 'categories', 'formattedTotal', 'verifiedAssociations', 'completedProjects'));
    }
}