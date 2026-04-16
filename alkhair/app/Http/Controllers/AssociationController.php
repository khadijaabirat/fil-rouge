<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
 class AssociationController extends Controller
{
    public function dashboard()
    {
        $association = Auth::user();
        Project::where('association_id', $association->id)
               ->where('status', 'OPEN')
               ->where('endDate', '<', now())
               ->update(['status' => 'CLOSED']);

        Project::where('association_id', $association->id)
               ->where('status', 'OPEN')
               ->whereColumn('currentAmount', '>=', 'goalAmount')
               ->update(['status' => 'COMPLETED']);

       $projects = Project::where('association_id', $association->id)
                           ->with('category')
                           ->latest()
                           ->paginate(6);

        $pendingProject = Project::where('association_id', $association->id)
            ->whereHas('donations', function ($query) {
                $query->where('status', 'RECEIVED');
            })->first();

$hasPendingReports = $pendingProject ? true : false;

return view('association.dashboard', compact('association', 'projects', 'hasPendingReports', 'pendingProject'));
    }



    public function withdrawFunds(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $association = Auth::user();
if ($project->association_id !== $association->id) {
                abort(403, 'Accès non autorisé.');
        }
        if (empty($association->rib)) {
            return back()->with('error', 'Vous devez d\'abord ajouter votre RIB bancaire dans "Mon Profil" avant de demander un retrait.');
        }
        if (!in_array($project->status, ['COMPLETED', 'CLOSED'])) {
            return back()->with('error', 'Vous ne pouvez retirer les fonds que si le projet est COMPLETED ou CLOSED.');
        }

         $hasProcessing = $project->donations()->where('status', 'PROCESSING')->exists();
        if ($hasProcessing) {
            return back()->with('error', 'Une demande de retrait est déjà en cours de traitement pour ce projet.');
        }

        $validatedDonationsCount = $project->donations()->where('status', 'VALIDATED')->count();
        if ($validatedDonationsCount === 0) {
            return back()->with('error', 'Aucun fonds validé n\'est disponible pour le retrait actuel. Attendez que l\'administration valide les dons récents.');
        }

        $project->donations()->where('status', 'VALIDATED')->update(['status' => 'PROCESSING']);

         return back()->with('success', 'Votre demande de retrait des fonds pour le projet "' . $project->title . '" a été envoyée à l\'administration avec succès. Vous serez contacté prochainement.');
    }


     public function editProfile()
    {
        $association =  Auth::user();
        return view('association.profile', compact('association'));
    }




    public function updateProfile(Request $request)
    {
        $association = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'ville' => 'nullable|string|max:100',
            'address' => 'nullable|string|max:255',
            'rib' => 'nullable|string|size:24',
            'description' => 'nullable|string',
            'profilePhoto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
if ($request->hasFile('profilePhoto')) {
             if ($association->profilePhoto) {
                Storage::disk('public')->delete($association->profilePhoto);
            }

             $path = $request->file('profilePhoto')->store('profiles', 'public');
            $association->profilePhoto = $path;
        }
         $association->name = $request->name;
        $association->phone = $request->phone;
        $association->ville = $request->ville;
        $association->address = $request->address;
        $association->rib = $request->rib;
        $association->description = $request->description;

        $association->save();

        return back()->with('success', 'Votre profil a été mis à jour avec succès.');
    }


}
