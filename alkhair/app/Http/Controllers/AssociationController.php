<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
class AssociationController extends Controller
{
    public function dashboard()
    {
        Project::where('status', 'OPEN')
                           ->where('endDate', '<', now())
                           ->update(['status' => 'CLOSED']);

        Project::where('status', 'OPEN')
                           ->whereColumn('currentAmount', '>=', 'goalAmount')
                           ->update(['status' => 'COMPLETED']);

        $association = Auth::user();

        $projects = Project::where('association_id', $association->id)->get();

        return view('association.dashboard', compact('association', 'projects'));
    }



    public function withdrawFunds(Request $request, $id)
    {
        $project = Project::findOrFail($id);

         if ($project->association_id !==  Auth::id()) {
            abort(403, 'Accès non autorisé.');
        }
         if ($project->status !== 'COMPLETED') {
            return back()->with('error', 'Vous ne pouvez retirer les fonds que si le projet est COMPLETED.');
        }
         $hasProcessing = $project->donations()->where('status', 'PROCESSING')->exists();
        if ($hasProcessing) {
            return back()->with('error', 'Une demande de retrait est déjà en cours de traitement pour ce projet.');
        }
$project->donations()->where('status', 'VALIDATED')->update(['status' => 'PROCESSING']);

         return back()->with('success', 'Votre demande de retrait des fonds pour le projet "' . $project->title . '" a été envoyée à l\'administration avec succès. Vous serez contacté prochainement.');
    }
}
