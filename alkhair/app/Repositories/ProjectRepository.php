<?php

namespace App\Repositories;

use App\Models\Project;
use App\Repositories\Interfaces\ProjectRepositoryInterface;

class ProjectRepository implements ProjectRepositoryInterface
{
    protected $model;

    public function __construct(Project $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->with(['association', 'category'])->get();
    }

    public function find($id)
    {
        return $this->model->with(['association', 'category', 'donations'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $project = $this->find($id);
        $project->update($data);
        return $project;
    }

    public function delete($id)
    {
        $project = $this->find($id);
        return $project->delete();
    }

    public function getOpenProjects()
    {
        return $this->model->where('status', 'OPEN')
            ->with(['association', 'category'])
            ->get();
    }

    public function getProjectsByAssociation($associationId)
    {
        return $this->model->where('association_id', $associationId)
            ->with('category')
            ->latest()
            ->get();
    }

    public function incrementAmount($id, $amount)
    {
        $project = $this->find($id);
        $project->increment('currentAmount', $amount);
        return $project;
    }
}
