<?php

namespace App\Services;

use App\Models\User;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;

 
class AssociationManagementService
{
     
    public function getDashboardData(User $association): array
    {
        $projects = Project::where('association_id', $association->id)
            ->with(['category', 'donations', 'impactReport'])
            ->latest()
            ->paginate(6);

        $pendingProject = Project::where('association_id', $association->id)
            ->whereHas('donations', function ($query) {
                $query->where('status', 'RECEIVED');
            })->first();

        $hasPendingReports = $pendingProject ? true : false;
        
        $hasCompletedWithoutReport = Project::where('association_id', $association->id)
            ->where('status', 'COMPLETED')
            ->whereDoesntHave('impactReport')
            ->exists();
        
        $hasActiveProject = Project::where('association_id', $association->id)
            ->where('status', 'OPEN')
            ->exists();

        return [
            'projects' => $projects,
            'hasPendingReports' => $hasPendingReports,
            'pendingProject' => $pendingProject,
            'hasActiveProject' => $hasActiveProject,
            'hasCompletedWithoutReport' => $hasCompletedWithoutReport,
        ];
    }
 
    public function getExpiredProjects(User $association)
    {
        Project::where('association_id', $association->id)
            ->where('status', 'OPEN')
            ->where('endDate', '<', now())
            ->whereColumn('currentAmount', '<', 'goalAmount')
            ->each(function ($project) {
                $project->update(['status' => 'CLOSED']);
            });
        
        return Project::where('association_id', $association->id)
            ->where('status', 'CLOSED')
            ->whereColumn('currentAmount', '<', 'goalAmount')
            ->with(['donations', 'category'])
            ->latest()
            ->get();
    }
 
    public function withdrawFunds(Project $project, User $association): bool
    {
         if ($project->association_id !== $association->id) {
            throw new \Exception('Accès non autorisé.');
        }
        
         if (empty($association->rib)) {
            throw new \Exception('Vous devez d\'abord ajouter votre RIB bancaire dans "Mon Profil" avant de demander un retrait.');
        }
        
         if ($project->status === 'CLOSED') {
            $project->update(['status' => 'COMPLETED']);
        }
        
         if (!in_array($project->status, ['COMPLETED'])) {
            throw new \Exception('Vous ne pouvez retirer les fonds que si le projet est clôturé.');
        }

         $hasProcessing = $project->donations()->where('status', 'PROCESSING')->exists();
        if ($hasProcessing) {
            throw new \Exception('Une demande de retrait est déjà en cours de traitement pour ce projet.');
        }

         $validatedDonationsCount = $project->donations()->where('status', 'VALIDATED')->count();
        if ($validatedDonationsCount === 0) {
            throw new \Exception('Aucun fonds validé n\'est disponible pour le retrait actuel. Attendez que l\'administration valide les dons récents.');
        }

       
        $project->donations()->where('status', 'VALIDATED')->update(['status' => 'PROCESSING']);

        return true;
    }
 
    public function updateProfile(User $association, array $data, $photoFile = null): bool
    {
         if ($photoFile) {
             if ($association->profilePhoto) {
                Storage::disk('public')->delete($association->profilePhoto);
            }

             $data['profilePhoto'] = $photoFile->store('profiles', 'public');
        }

         return $association->update($data);
    }
}
