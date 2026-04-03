<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
class AssociationController extends Controller
{
    public function dashboard()
    {
        $association = Auth::user();

        $projects = Project::where('association_id', $association->id)->get();

        return view('association.dashboard', compact('association', 'projects'));
    }
}
