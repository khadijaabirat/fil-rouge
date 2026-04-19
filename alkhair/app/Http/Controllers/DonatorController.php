<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use App\Models\Donation;
use App\Models\Category;
use App\Services\ProjectSearchService;

class DonatorController extends Controller
{
    public function dashboard(Request $request)
    {    
        $filters = $request->only(['search', 'category_id', 'ville', 'sort']);
        $projects = ProjectSearchService::search($filters)->paginate(9)->withQueryString();
        $categories = Category::all();
        $donator = Auth::user();

        $myDonations = Donation::where('donator_id', $donator->id)
            ->with(['project', 'payment'])
            ->latest()
            ->get();

        return view('donator.dashboard', compact('donator', 'projects', 'myDonations', 'categories'));
    }
}
