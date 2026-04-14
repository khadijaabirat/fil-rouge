<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects=Project::all();
        return view('projects.index',compact('projects'));

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
        ]);
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
      $project = Project::with(['association', 'donations' => function($query) {
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

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $project = Project::findOrFail($id);

        if ($project->association_id !== Auth::id()) {
            abort(403, 'Accès non autorisé.');
        }

         $validate = $request->validate([
            'title' => 'required|string|max:250',
            'description' => 'required|string',
            'videoUrl' => 'nullable|url',
        ]);

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
        ]);

         $project->update([
            'endDate' => $request->newEndDate,
            'status' => 'OPEN',
        ]);

        return back()->with('success', 'La date limite du projet a été prolongée avec succès !');
    }
}
