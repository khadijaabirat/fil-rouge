<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use App\Services\AssociationManagementService;
 
class AssociationController extends Controller
{
    protected $associationManagementService;

    public function __construct(AssociationManagementService $associationManagementService)
    {
        $this->associationManagementService = $associationManagementService;
    }
 
    public function pending()
    {
        return view('association.pending');
    }
 
    public function dashboard()
    {
        $association = Auth::user();
        $data = $this->associationManagementService->getDashboardData($association);

        return view('association.dashboard', array_merge(
            ['association' => $association],
            $data
        ));
    }

 
    public function expiredProjects()
    {
        $association = Auth::user();
        $expiredProjects = $this->associationManagementService->getExpiredProjects($association);
        
        return view('association.expired', compact('association', 'expiredProjects'));
    }

 
    public function withdrawFunds(Request $request, $id)
    {
        try {
            $project = Project::findOrFail($id);
            $association = Auth::user();
            
            if ($project->association_id !== $association->id) {
                abort(403, 'Accès non autorisé.');
            }
            
            $this->associationManagementService->withdrawFunds($project, $association);
            
            return back()->with('success', 'Votre demande de retrait des fonds pour le projet "' . $project->title . '" a été envoyée à l\'administration avec succès. Vous serez contacté prochainement. N\'oubliez pas de publier un rapport d\'impact.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
 
    public function editProfile()
    {
        $association = Auth::user();
        return view('association.profile', compact('association'));
    }
 
    public function updateProfile(Request $request)
    {
        try {
            $association = Auth::user();

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'nullable|string|max:20',
                'ville' => 'nullable|string|max:100',
                'address' => 'nullable|string|max:255',
                'rib' => 'nullable|string|size:24',
                'description' => 'nullable|string',
                'profilePhoto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $this->associationManagementService->updateProfile(
                $association,
                $validated,
                $request->file('profilePhoto')
            );

            return back()->with('success', 'Votre profil a été mis à jour avec succès.');
        } catch (\Exception $e) {
            return back()->with('error', 'Une erreur est survenue lors de la mise à jour du profil.');
        }
    }
}
