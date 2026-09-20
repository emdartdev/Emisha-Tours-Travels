<?php

namespace App\Services;

use App\Models\Tour;
use App\Models\Destination;
use App\Models\TourCategory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class TourService
{
    /**
     * Get paginated tours with interactive filter parameters.
     */
    public function getFilteredTours(array $filters = [], int $perPage = 12): LengthAwarePaginator
    {
        $query = Tour::published()
            ->with(['destination', 'category'])
            ->latest('published_at');

        // Search query filter
        if (!empty($filters['search'])) {
            $search = '%' . $filters['search'] . '%';
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', $search)
                  ->orWhere('short_description', 'like', $search)
                  ->orWhereHas('destination', function ($dq) use ($search) {
                      $dq->where('name', 'like', $search)
                        ->orWhere('country', 'like', $search);
                  });
            });
        }

        // Destination filter
        if (!empty($filters['destination'])) {
            $query->whereHas('destination', function ($q) use ($filters) {
                $q->where('slug', $filters['destination'])
                  ->orWhere('id', $filters['destination']);
            });
        }

        // Category filter
        if (!empty($filters['category'])) {
            $query->whereHas('category', function ($q) use ($filters) {
                $q->where('slug', $filters['category'])
                  ->orWhere('id', $filters['category']);
            });
        }

        // Duration filter (e.g. 1-3, 4-6, 7+)
        if (!empty($filters['duration'])) {
            if ($filters['duration'] === '1-3') {
                $query->whereBetween('duration_days', [1, 3]);
            } elseif ($filters['duration'] === '4-6') {
                $query->whereBetween('duration_days', [4, 6]);
            } elseif ($filters['duration'] === '7+') {
                $query->where('duration_days', '>=', 7);
            }
        }

        // Price range filter
        if (!empty($filters['min_price'])) {
            $query->where('price', '>=', (float) $filters['min_price']);
        }
        if (!empty($filters['max_price'])) {
            $query->where('price', '<=', (float) $filters['max_price']);
        }

        // Sorting
        $sort = $filters['sort'] ?? 'latest';
        if ($sort === 'price_low') {
            $query->orderBy('price', 'asc');
        } elseif ($sort === 'price_high') {
            $query->orderBy('price', 'desc');
        } elseif ($sort === 'duration') {
            $query->orderBy('duration_days', 'asc');
        }

        return $query->paginate($perPage)->withQueryString();
    }

    /**
     * Get featured tour packages for homepage and highlights.
     */
    public function getFeaturedTours(int $limit = 6): Collection
    {
        return Tour::published()
            ->featured()
            ->with(['destination', 'category'])
            ->orderBy('id', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get popular tour packages.
     */
    public function getPopularTours(int $limit = 6): Collection
    {
        return Tour::published()
            ->popular()
            ->with(['destination', 'category'])
            ->limit($limit)
            ->get();
    }

    /**
     * Find single tour by slug with complete details.
     */
    public function getTourBySlug(string $slug): ?Tour
    {
        return Tour::published()
            ->where('slug', $slug)
            ->with([
                'destination',
                'category',
                'itineraries',
                'inclusions',
                'exclusions',
                'seo',
            ])
            ->firstOrFail();
    }

    /**
     * Get related tours by destination or category.
     */
    public function getRelatedTours(Tour $tour, int $limit = 3): Collection
    {
        return Tour::published()
            ->where('id', '!=', $tour->id)
            ->where(function ($q) use ($tour) {
                $q->where('destination_id', $tour->destination_id)
                  ->orWhere('tour_category_id', $tour->tour_category_id);
            })
            ->with(['destination', 'category'])
            ->limit($limit)
            ->get();
    }
}
