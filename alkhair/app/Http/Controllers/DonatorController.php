<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use  App\Models\Donation;
use App\Models\Category;
use App\Models\User;

class DonatorController extends Controller
{
public function dashboard(Request $request)
{    Project::where('status', 'OPEN')
                           ->where('endDate', '<', now())
                           ->update(['status' => 'CLOSED']);

    Project::where('status', 'OPEN')
                           ->whereColumn('currentAmount', '>=', 'goalAmount')
                           ->update(['status' => 'COMPLETED']);

$query = Project::where('status', 'OPEN')
->with(['association', 'category']);

if ($request->has('search') && $request->search != '') {
    $searchTerm = '%' . $request->search . '%';
       $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', $searchTerm)
                  ->orWhereHas('association', function ($assocQuery) use ($searchTerm) {
                      $assocQuery->where('ville', 'like', $searchTerm);
                  });
            });
    }

  if ($request->has('category') && $request->category != '') {
        $query->where('category_id', $request->category);
    }

    $projects = $query->paginate(9)->withQueryString();
    $categories = Category::all();

    $donator=Auth::user();

    $myDonations = Donation::where('donator_id', $donator->id)
                                           ->with(['project', 'payment'])
                                           ->latest()
                                           ->get();
return view('donator.dashboard', compact('donator', 'projects', 'myDonations', 'categories'));

}



}
