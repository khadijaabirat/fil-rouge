<?php

namespace App\Services;

use App\Models\User;
use App\Notifications\AssociationStatusChanged;
 
class AssociationService
{
 
    public function validate(User $association): bool
    {
        if ($association->role !== 'association') {
            throw new \Exception('Cet utilisateur n\'est pas une association.');
        }

        $association->update(['status' => 'ACTIVE']);
        $association->notify(new AssociationStatusChanged('ACTIVE'));

        return true;
    }
 
    public function verifyKyc(User $association): bool
    {
        if ($association->role !== 'association') {
            throw new \Exception('Cet utilisateur n\'est pas une association.');
        }

        $association->update(['kyc_verified_at' => now()]);

        return true;
    }
 
    public function ban(User $association): bool
    {
        if ($association->role !== 'association') {
            throw new \Exception('Cet utilisateur n\'est pas une association.');
        }

        $association->update(['status' => 'BANNED']);
        $association->projects()->update(['status' => 'SUSPENDED']);
        $association->notify(new AssociationStatusChanged('BANNED'));

        return true;
    }
 
    public function unban(User $association): bool
    {
        if ($association->role !== 'association') {
            throw new \Exception('Cet utilisateur n\'est pas une association.');
        }

        $association->update(['status' => 'ACTIVE']);
        $association->notify(new AssociationStatusChanged('ACTIVE'));

  
        $suspendedProjects = $association->projects()->where('status', 'SUSPENDED')->get();

        foreach ($suspendedProjects as $project) {
            $project->update(['status' => 'OPEN']);
            $project->calculateProgress();
            
            if (method_exists($project, 'checkDeadline')) {
                $project->checkDeadline();
            }
        }

        return true;
    }
 
    public function getPendingAssociations(int $limit = null)
    {
        $query = User::where('role', 'association')
            ->where('status', 'PENDING')
            ->latest();

        return $limit ? $query->take($limit)->get() : $query->get();
    }
}
