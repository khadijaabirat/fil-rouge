<?php

namespace App\Services;

use App\Models\Project;
use Illuminate\Database\Eloquent\Builder;

class ProjectSearchService
{
    public static function search(array $filters): Builder
    {
        $query = Project::with(['association', 'category'])
            ->where('status', 'OPEN')
            ->whereColumn('currentAmount', '<', 'goalAmount');

        // Search by title or description
        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('title', 'like', '%' . $filters['search'] . '%')
                  ->orWhere('description', 'like', '%' . $filters['search'] . '%');
            });
        }

        // Filter by category
        if (!empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        // Filter by ville
        if (!empty($filters['ville'])) {
            $query->whereHas('association', function ($q) use ($filters) {
                $q->where('ville', $filters['ville']);
            });
        }

        // Filter by date range (created_at)
        if (!empty($filters['date_from'])) {
            $query->whereDate('created_at', '>=', $filters['date_from']);
        }

        if (!empty($filters['date_to'])) {
            $query->whereDate('created_at', '<=', $filters['date_to']);
        }

        // Filter by deadline
        if (!empty($filters['deadline_before'])) {
            $query->whereDate('endDate', '<=', $filters['deadline_before']);
        }

        // Sorting
        if (!empty($filters['sort'])) {
            switch ($filters['sort']) {
                case 'oldest':
                    $query->orderBy('created_at', 'asc');
                    break;
                case 'deadline_soon':
                    $query->orderBy('endDate', 'asc');
                    break;
                case 'deadline_far':
                    $query->orderBy('endDate', 'desc');
                    break;
                case 'progress_high':
                    // Projects closest to goal (highest percentage)
                    $query->orderByRaw('(currentAmount / NULLIF(goalAmount, 0)) DESC');
                    break;
                case 'progress_low':
                    // Projects furthest from goal (lowest percentage)
                    $query->orderByRaw('(currentAmount / NULLIF(goalAmount, 0)) ASC');
                    break;
                case 'urgent':
                    $query->orderBy('endDate', 'asc');
                    break;
                case 'recent':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'progress':
                    $query->orderByRaw('(currentAmount / NULLIF(goalAmount, 0)) DESC');
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
