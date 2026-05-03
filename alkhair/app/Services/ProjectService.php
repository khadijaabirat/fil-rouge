<?php

namespace App\Services;

use App\Models\Project;

/**
 * Service pour gérer les projets
 * Respecte le principe SRP (Single Responsibility Principle)
 */
class ProjectService
{
    /**
     * Suspendre un projet
     */
    public function suspend(Project $project): bool
    {
        $project->update(['status' => 'SUSPENDED']);
        return true;
    }

    /**
     * Restaurer un projet
     */
    public function restore(Project $project): bool
    {
        $project->update(['status' => 'OPEN']);
        $project->calculateProgress();
        $project->checkDeadline();

        return true;
    }

    /**
     * Approuver le retrait de fonds
     */
    public function approveWithdrawal(Project $project): bool
    {
        $project->donations()
            ->where('status', 'PROCESSING')
            ->update(['status' => 'RECEIVED']);

        return true;
    }

    /**
     * Récupérer les demandes de retrait en attente
     */
    public function getWithdrawalRequests()
    {
        return Project::with(['association', 'donations' => function($q) {
                $q->where('status', 'PROCESSING');
            }])
            ->whereHas('donations', function($q) {
                $q->where('status', 'PROCESSING');
            })
            ->latest()
            ->get();
    }

    /**
     * Récupérer les projets gérés
     */
    public function getManagedProjects()
    {
        return Project::whereIn('status', ['OPEN', 'COMPLETED', 'SUSPENDED'])
            ->with('association')
            ->get();
    }
}
