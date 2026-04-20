<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;
use App\Services\ProjectSearchService;
class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only(['search', 'category_id', 'ville', 'sort']);
        $projects = ProjectSearchService::search($filters)->paginate(12);
        $categories = Category::all();
        
        return view('projects.index', compact('projects', 'categories', 'filters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hasPendingReports =  Project::where('association_id', Auth::id())
            ->whereHas('donations', function ($query) {
                 $query->where('status', 'RECEIVED');
            })->exists();
            if ($hasPendingReports) {
            return redirect()->route('association.dashboard')
            ->with('error', 'Action bloquée : Vous devez d\'abord publier les rapports d\'impact de vos projets précédents (fonds reçus) avant de créer un nouveau projet.');
        }
        $categories=Category::all();
return view('projects.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $hasPendingReports =  Project::where('association_id', Auth::id())
            ->whereHas('donations', function ($query) {
                $query->where('status', 'RECEIVED');
            })->exists();

        if ($hasPendingReports) {
            abort(403, 'Vous devez publier vos rapports d\'impact en attente.');
        }
       $validate= $request->validate([
            'title'=>'required|string|max:250',
            'description'=>'required|string',
            'goalAmount'=>'required|numeric|min:1',
            'startDate'=>'required|date',
            'endDate'=>'required|date|after:startDate',
            'category_id' => 'required|exists:categories,id',
            'videoUrl' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:5120',
        ], [
            'title.required' => 'Le titre du projet est obligatoire.',
            'description.required' => 'La description du projet est obligatoire.',
            'goalAmount.min' => 'L\'objectif financier doit être supérieur à 0.',
            'endDate.after' => 'La date de fin doit être après la date de début.',
            'category_id.required' => 'Veuillez sélectionner une catégorie.',
            'videoUrl.url' => 'Le lien vidéo doit être une URL valide.',
            'image.image' => 'Le fichier doit être une image.',
            'image.max' => 'L\'image ne peut pas dépasser 5 Mo.',
        ]);
        
        if ($request->hasFile('image')) {
            $validate['image'] = $request->file('image')->store('projects', 'public');
        }
        
        $user=Auth::user();
        $validate['association_id']=$user->id;
         Project::create($validate);
        return redirect()->route('association.dashboard')->with('success', 'Projet ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
      $project = Project::with(['association','impactReport', 'donations' => function($query) {
            $query->whereIn('status', ['VALIDATED', 'PROCESSING', 'RECEIVED', 'IMPACT'])
                  ->latest()
                  ->take(5);
        }, 'donations.donator'])->findOrFail($id);
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project=Project::findOrFail($id);
        Gate::authorize('update', $project);
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $project = Project::findOrFail($id);

       Gate::authorize('update', $project);
       
         $validate = $request->validate([
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

        if ($request->hasFile('image')) {
            if ($project->image && \Storage::disk('public')->exists($project->image)) {
                \Storage::disk('public')->delete($project->image);
            }
            $validate['image'] = $request->file('image')->store('projects', 'public');
        }

        $project->update($validate);

        return redirect()->route('association.dashboard')->with('success', 'Les détails du projet ont été mis à jour.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $project = Project::findOrFail($id);

         if ($project->association_id !== Auth::id()) {
            abort(403, 'Accès non autorisé.');
        }

         if ($project->currentAmount > 0) {
            return back()->with('error', 'Impossible de supprimer ce projet car il a déjà reçu des dons. Demandez à l\'administration de le suspendre.');
        }

        $project->delete();
        return back()->with('success', 'Le projet a été supprimé avec succès.');
    }

     public function extendDeadline(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        if ($project->association_id !== Auth::id()) {
            abort(403, 'Accès non autorisé.');
        }
         if ($project->currentAmount >= $project->goalAmount) {
            return back()->with('error', 'Vous ne pouvez pas prolonger un projet qui a déjà atteint son objectif financier.');
        }
        $request->validate([
            'newEndDate' => 'required|date|after:' . $project->endDate,
        ], [
            'newEndDate.required' => 'La nouvelle date de fin est obligatoire.',
            'newEndDate.after' => 'La nouvelle date doit être après la date de fin actuelle (' . $project->endDate->format('d/m/Y') . ').',
        ]);

         $project->update([
            'endDate' => $request->newEndDate,
            'status' => 'OPEN',
        ]);

        return back()->with('success', 'La date limite du projet a été prolongée avec succès !');
    }
}
