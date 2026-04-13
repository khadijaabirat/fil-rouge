<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ImpactReport;
use Illuminate\Support\Facades\Auth;

class ImpactReportController extends Controller
{
    public function create($id)
    {
        $project = Project::findOrFail($id);

        if ($project->association_id !== Auth::id()) {
            abort(403, 'Accès non autorisé.');
        }

        return view('association.impact_create', compact('project'));
    }



    public function store(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        if ($project->association_id !== Auth::id()) {
            abort(403, 'Accès non autorisé.');
        }

        $request->validate([
            'description' => 'required|string|min:50',
            'completionDate' => 'required|date',
            'videoLink' => 'nullable|url',
        ]);

        ImpactReport::create([
            'description' => $request->description,
            'completionDate' => $request->completionDate,
            'videoLink' => $request->videoLink,
            'project_id' => $project->id,
        ]);

        $project->donations()->where('status', 'RECEIVED')->update(['status' => 'IMPACT']);

        return redirect()->route('association.dashboard')->with('success', 'Félicitations ! Le rapport d\'impact a été publié avec succès.');
    }
}
