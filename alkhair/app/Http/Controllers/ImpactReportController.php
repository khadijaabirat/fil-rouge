<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ImpactReport;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreImpactReportRequest;
use App\Services\ImpactReportService;

 
class ImpactReportController extends Controller
{
    protected $impactReportService;

    public function __construct(ImpactReportService $impactReportService)
    {
        $this->impactReportService = $impactReportService;
    }

  
    public function index(Request $request)
    {
        $searchTerm = $request->filled('search') ? $request->search : null;
        $impactReports = $this->impactReportService->searchReports($searchTerm)->paginate(12);

        return view('impact.indeximpact', compact('impactReports'));
    }
 
    public function show($id)
    {
        $impactReport = ImpactReport::with([
            'project.association',
            'project.category',
            'project.donations.donator'
        ])->findOrFail($id);
        
        $project = $impactReport->project;

        return view('impact.showimpact', compact('impactReport', 'project'));
    }
 
    public function create($id = null)
    {
        $association = Auth::user();

         if ($id === null || $id == 0) {
            $projectsNeedingReport = $this->impactReportService->getProjectsNeedingReport($association);
            return view('impact.select_project', compact('projectsNeedingReport'));
        }
        
         $project = Project::findOrFail($id);

        if ($project->association_id !== Auth::id()) {
            return redirect()->route('impact-reports.create')
                ->with('error', 'Accès non autorisé.');
        }
        
        if ($project->impactReport()->exists()) {
            return redirect()->route('impact-reports.create')
                ->with('error', 'Ce projet possède déjà un rapport d\'impact.');
        }
        
        return view('association.impact_create', compact('project'));
    }
 
    public function store(StoreImpactReportRequest $request, $id = null)
    {
        try {
             $projectId = $id ?? $request->input('project_id');
            
            if (!$projectId) {
                return back()->with('error', 'Projet non spécifié.')->withInput();
            }
            
            $project = Project::findOrFail($projectId);

            if ($project->association_id !== Auth::id()) {
                abort(403, 'Accès non autorisé.');
            }
            
            if ($project->impactReport()->exists()) {
                return back()->with('error', 'Ce projet possède déjà un rapport d\'impact.');
            }

            $this->impactReportService->createReport(
                $project,
                $request->validated(),
                $request->file('image')
            );

            return redirect()->route('association.dashboard')
                ->with('success', 'Félicitations ! Le rapport d\'impact a été publié avec succès.');
                
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }
}
