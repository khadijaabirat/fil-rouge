<?php

namespace App\Services;

use App\Models\User;
use App\Models\Project;
use App\Models\ImpactReport;
use App\Notifications\ImpactReportPublished;

/**
 * Service pour gérer les rapports d'impact
 * Respecte le principe SRP
 */
class ImpactReportService
{
    /**
     * Récupérer les projets nécessitant un rapport d'impact
     */
    public function getProjectsNeedingReport(User $association)
    {
        return Project::where('association_id', $association->id)
            ->where(function($query) {
                $query->where('status', 'COMPLETED')
                      ->whereDoesntHave('impactReport');
            })
            ->orWhere(function($query) use ($association) {
                $query->where('association_id', $association->id)
                      ->whereHas('donations', function($q) {
                          $q->where('status', 'RECEIVED');
                      });
            })
            ->with(['category', 'donations'])
            ->get();
    }

    /**
     * Créer un rapport d'impact
     */
    public function createReport(Project $project, array $data, $imageFile = null): ImpactReport
    {
        // Vérifier qu'il n'existe pas déjà un rapport
        if ($project->impactReport()->exists()) {
            throw new \Exception('Un rapport d\'impact a déjà été publié pour ce projet.');
        }

        // Upload de l'image si présente
        if ($imageFile) {
            $data['image'] = $imageFile->store('reports', 'public');
        }

        // Créer le rapport
        $report = ImpactReport::create([
            'description' => $data['description'],
            'completionDate' => $data['completionDate'],
            'videoLink' => $data['videoLink'] ?? null,
            'image' => $data['image'] ?? null,
            'project_id' => $project->id,
        ]);

        // Mettre à jour le statut des donations
        $project->donations()
            ->where('status', 'RECEIVED')
            ->update(['status' => 'IMPACT']);

        // Notifier les donateurs
        $this->notifyDonators($project);

        return $report;
    }

    /**
     * Notifier les donateurs de la publication du rapport
     */
    public function notifyDonators(Project $project): void
    {
        $project->donations()
            ->where('status', 'IMPACT')
            ->whereNotNull('donator_id')
            ->with('donator')
            ->get()
            ->each(function ($donation) use ($project) {
                if ($donation->donator) {
                    $donation->donator->notify(new ImpactReportPublished($project));
                }
            });
    }

    /**
     * Rechercher des rapports d'impact
     */
    public function searchReports($searchTerm = null)
    {
        $query = ImpactReport::with(['project.association', 'project.category'])
            ->whereHas('project')
            ->latest('completionDate');

        if ($searchTerm) {
            $query->where(function($q) use ($searchTerm) {
                $q->whereHas('project', function($projectQuery) use ($searchTerm) {
                    $projectQuery->where('title', 'like', "%{$searchTerm}%")
                        ->orWhere('ville', 'like', "%{$searchTerm}%")
                        ->orWhereHas('association', function($assocQuery) use ($searchTerm) {
                            $assocQuery->where('name', 'like', "%{$searchTerm}%");
                        });
                })
                ->orWhere('description', 'like', "%{$searchTerm}%");
            });
        }

        return $query;
    }
}
