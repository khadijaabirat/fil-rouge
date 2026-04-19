<?php

namespace App\Services;

use App\Models\Project;
use Illuminate\Database\Eloquent\Builder;

class ProjectSearchService
{
    public static function search(array $filters): Builder
    {
        $query = Project::with(['association', 'category'])
            ->where('status', 'OPEN');

        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('title', 'like', '%' . $filters['search'] . '%')
                  ->orWhere('description', 'like', '%' . $filters['search'] . '%');
            });
        }

        if (!empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        if (!empty($filters['ville'])) {
            $query->whereHas('association', function ($q) use ($filters) {
                $q->where('ville', $filters['ville']);
            });
        }

        if (!empty($filters['sort'])) {
            switch ($filters['sort']) {
                case 'urgent':
                    $query->orderBy('endDate', 'asc');
                    break;
                case 'recent':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'progress':
                    $query->orderByRaw('(currentAmount / goalAmount) DESC');
                    break;
                default:
                    $query->latest();
            }
        } else {
            $query->latest();
        }

        return $query;
    }
}
