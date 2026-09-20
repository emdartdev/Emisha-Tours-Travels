<?php

namespace App\Services;

use App\Models\VisaCountry;
use App\Models\VisaType;
use App\Models\ProfessionType;
use Illuminate\Database\Eloquent\Collection;

class VisaService
{
    /**
     * Get all active visa countries with their types.
     */
    public function getActiveCountries(): Collection
    {
        return VisaCountry::active()
            ->with(['visaTypes' => function ($q) {
                $q->active()->orderBy('sort_order', 'asc');
            }])
            ->orderBy('sort_order', 'asc')
            ->get();
    }

    /**
     * Get featured visa countries for homepage.
     */
    public function getFeaturedCountries(int $limit = 6): Collection
    {
        return VisaCountry::active()
            ->featured()
            ->with(['visaTypes' => function ($q) {
                $q->active()->orderBy('sort_order', 'asc');
            }])
            ->orderBy('sort_order', 'asc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get visa country by slug with full requirements and profession data.
     */
    public function getCountryBySlug(string $slug): ?VisaCountry
    {
        return VisaCountry::active()
            ->where('slug', $slug)
            ->with([
                'visaTypes' => function ($q) {
                    $q->active()->with(['requirements', 'professionRequirements.professionType']);
                },
                'seo',
            ])
            ->firstOrFail();
    }

    /**
     * Get all available profession types.
     */
    public function getProfessions(): Collection
    {
        return ProfessionType::where('status', 'active')
            ->orderBy('sort_order', 'asc')
            ->get();
    }
}
