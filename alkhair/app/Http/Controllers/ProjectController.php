<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;
use App\Services\ProjectSearchService;
use App\Http\Requests\StoreProjectRequest;
use App\Services\ProjectManagementService;
 
class ProjectController extends Controller
{
    protected $projectManagementService;

    public function __construct(ProjectManagementService $projectManagementService)
    {
        $this->projectManagementService = $projectManagementService;
    }
 
    public function index(Request $request)
    {
        $filters = $request->only(['search', 'category_id', 'ville', 'sort', 'date_from', 'date_to', 'deadline_before']);
        $projects = ProjectSearchService::search($filters)->paginate(12);
        $categories = Category::all();
        
        return view('projects.index', compact('projects', 'categories', 'filters'));
    }
 
    public function create()
    {
        try {
            $this->projectManagementService->checkAssociationLimits(Auth::id());
            $categories = Category::all();
            return view('projects.create', compact('categories'));
        } catch (\Exception $e) {
            return redirect()->route('association.dashboard')->with('error', $e->getMessage());
        }
    }
 
    public function store(StoreProjectRequest $request)
    {
        try {
            $this->projectManagementService->checkAssociationLimits(Auth::id());
            $project = $this->projectManagementService->createProject($request->validated(), $request->file('image'), Auth::id());
            
            return redirect()->route('association.dashboard')->with('success', 'Projet ajouté avec succès');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }
 
    public function show(string $id)
    {
        $project = Project::with(['association','impactReport', 'donations' => function($query) {
            $query->whereIn('status', ['VALIDATED', 'PROCESSING', 'RECEIVED', 'IMPACT'])
                  ->latest()
                  ->take(5);
        }, 'donations.donator'])->findOrFail($id);
        
        $canDonate = $project->status === 'OPEN';
        
        return view('projects.show', compact('project', 'canDonate'));
    }
 
    public function edit(string $id)
    {
        $project = Project::findOrFail($id);
        Gate::authorize('update', $project);
        return view('projects.edit', compact('project'));
    }
 
    public function update(Request $request, string $id)
    {
        try {
            $project = Project::findOrFail($id);
            Gate::authorize('update', $project);
            
            $validated = $request->validate([
                'title' => 'required|string|max:250',
                'description' => 'required|string',
                'videoUrl' => 'nullable|url',
                'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:5120',
            ], [
                'title.required' => 'Le titre du projet est obligatoire.',
                'description.required' => 'La description du projet est obligatoire.',
                'videoUrl.url' => 'Le lien vidéo doit être une URL valide.',
                'image.image' => 'Le fichier doit être une image.',
                'image.max' => 'L\'image ne peut pas dépasser 5 Mo.',
            ]);

            $this->projectManagementService->updateProject($project, $validated, $request->file('image'));

            return redirect()->route('association.dashboard')->with('success', 'Les détails du projet ont été mis à jour.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }
 
    public function destroy(string $id)
    {
        try {
            $project = Project::findOrFail($id);
            Gate::authorize('delete', $project);

            $this->projectManagementService->deleteProject($project);
            
            return back()->with('success', 'Le projet a été supprimé avec succès.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
 
    public function extendDeadline(Request $request, $id)
    {
        try {
            $project = Project::findOrFail($id);
            Gate::authorize('update', $project);
            
            $validated = $request->validate([
                'newEndDate' => [
                    'required',
                    'date',
                    'after:' . $project->endDate,
                    'before:' . now()->addMonths(6)->format('Y-m-d'),
                ],
            ], [
                'newEndDate.required' => 'La nouvelle date de fin est obligatoire.',
                'newEndDate.after' => 'La nouvelle date doit être après la date de fin actuelle (' . $project->endDate->format('d/m/Y') . ').',
                'newEndDate.before' => 'La prolongation ne peut pas dépasser 6 mois à partir d\'aujourd\'hui.',
            ]);

            $this->projectManagementService->extendDeadline($project, $validated['newEndDate']);

            return back()->with('success', 'La date limite du projet a été prolongée avec succès !');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
