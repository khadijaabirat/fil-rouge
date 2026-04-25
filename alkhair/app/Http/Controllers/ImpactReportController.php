<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ImpactReport;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ImpactReportPublished;

class ImpactReportController extends Controller
{
    public function index(Request $request)
    {
        $query = ImpactReport::with(['project.association', 'project.category'])
            ->whereHas('project')
            ->latest('completionDate');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('project', function($projectQuery) use ($search) {
                    $projectQuery->where('title', 'like', "%{$search}%")
                        ->orWhere('ville', 'like', "%{$search}%")
                        ->orWhereHas('association', function($assocQuery) use ($search) {
                            $assocQuery->where('name', 'like', "%{$search}%");
                        });
                })
                ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $impactReports = $query->paginate(12);

        return view('impact.indeximpact', compact('impactReports'));
    }

    public function show($id)
    {
        $impactReport = ImpactReport::with(['project.association', 'project.category', 'project.donations.donator'])
            ->findOrFail($id);
        
        $project = $impactReport->project;

        return view('impact.showimpact', compact('impactReport', 'project'));
    }

    public function create($id)
    {
        $project = Project::findOrFail($id);

        if ($project->association_id !== Auth::id()) {
            abort(403, 'Accès non autorisé.');
        }
    if ($project->impactReport()->exists()) {
            return redirect()->route('association.dashboard')
                ->with('error', 'Ce projet possède déjà un rapport d\'impact.');
        }
        return view('association.impact_create', compact('project'));
    }



    public function store(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        if ($project->association_id !== Auth::id()) {
            abort(403, 'Accès non autorisé.');
        }
if ($project->impactReport()->exists()) {
            return redirect()->route('association.dashboard')
                ->with('error', 'Un rapport d\'impact a déjà été publié pour ce projet.');
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
        
        $project->donations()->where('status', 'IMPACT')
            ->whereNotNull('donator_id')
            ->with('donator')
            ->get()
            ->each(function ($donation) use ($project) {
                if ($donation->donator) {
                    $donation->donator->notify(new ImpactReportPublished($project));
                }
            });

        return redirect()->route('association.dashboard')->with('success', 'Félicitations ! Le rapport d\'impact a été publié avec succès.');
    }
}
