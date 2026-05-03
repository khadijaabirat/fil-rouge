<?php

namespace App\Services;

use App\Models\Project;
use Illuminate\Support\Facades\Storage;

/**
 * Service pour gérer les projets (CRUD + logique métier)
 * Respecte le principe SRP
 */
class ProjectManagementService
{
    /**
     * Vérifier les limites de l'association avant création
     */
    public function checkAssociationLimits(int $associationId): void
    {
        // Vérifier si l'association a des fonds reçus sans rapport d'impact
        if (Project::where('association_id', $associationId)
            ->whereHas('donations', fn($q) => $q->where('status', 'RECEIVED'))
            ->exists()) {
            throw new \Exception('Vous devez d\'abord publier les rapports d\'impact des projets précédents.');
        }
        
        // Vérifier si l'association a des projets complétés sans rapport
        if (Project::where('association_id', $associationId)
            ->where('status', 'COMPLETED')
            ->whereDoesntHave('impactReport')
            ->exists()) {
            throw new \Exception('Veuillez publier le rapport d\'impact de votre projet complété.');
        }
        
        // Vérifier si l'association a déjà un projet actif
        if (Project::where('association_id', $associationId)
            ->where('status', 'OPEN')
            ->exists()) {
            throw new \Exception('Vous avez déjà un projet actif en cours.');
        }
    }

    /**
     * Créer un nouveau projet
     */
    public function createProject(array $data, $imageFile, int $associationId): Project
    {
        // Upload de l'image si présente
        if ($imageFile) {
            $data['image'] = $imageFile->store('projects', 'public');
        }

        $data['association_id'] = $associationId;

        return Project::create($data);
    }

    /**
     * Mettre à jour un projet
     */
    public function updateProject(Project $project, array $data, $imageFile = null): bool
    {
        // Gérer l'upload de la nouvelle image
        if ($imageFile) {
            // Supprimer l'ancienne image
            if ($project->image && Storage::disk('public')->exists($project->image)) {
                Storage::disk('public')->delete($project->image);
            }
            
            $data['image'] = $imageFile->store('projects', 'public');
        }

        return $project->update($data);
    }

    /**
     * Supprimer un projet
     */
    public function deleteProject(Project $project): bool
    {
        if ($project->currentAmount > 0) {
            throw new \Exception('Impossible de supprimer ce projet car il a déjà reçu des dons. Demandez à l\'administration de le suspendre.');
        }

        // Supprimer l'image si elle existe
        if ($project->image && Storage::disk('public')->exists($project->image)) {
            Storage::disk('public')->delete($project->image);
        }

        return $project->delete();
    }

    /**
     * Prolonger la date limite d'un projet
     */
    public function extendDeadline(Project $project, string $newEndDate): bool
    {
        // Vérifier si le projet a atteint son objectif
        if ($project->currentAmount >= $project->goalAmount) {
            throw new \Exception('Vous ne pouvez pas prolonger un projet qui a déjà atteint son objectif financier.');
        }
        
        // Vérifier le statut du projet
        if (!in_array($project->status, ['OPEN', 'CLOSED'])) {
            throw new \Exception('Ce projet ne peut pas être prolongé dans son état actuel.');
        }

        return $project->update([
            'endDate' => $newEndDate,
            'status' => 'OPEN',
        ]);
    }
}
