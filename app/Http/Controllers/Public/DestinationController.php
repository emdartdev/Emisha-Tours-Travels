<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Tour;
use App\Models\VisaCountry;
use App\Services\SeoService;
use Illuminate\View\View;

class DestinationController extends Controller
{
    public function __construct(
        protected SeoService $seoService
    ) {}

    public function index(): View
    {
        $destinations = Destination::active()
            ->withCount(['tours' => function ($q) {
                $q->published();
            }])
            ->orderBy('sort_order', 'asc')
            ->paginate(12);

        $breadcrumbs = [
            'Home' => route('home'),
            'Destinations & Travel Guides' => route('destinations.index'),
        ];
        $breadcrumbSchema = $this->seoService->generateBreadcrumbSchema($breadcrumbs);
        $itemListSchema = $this->seoService->generateItemListSchema('World Travel Destinations & Guides', $destinations->getCollection(), 'TouristDestination');
        $schema = $breadcrumbSchema . "\n" . $itemListSchema;

        return view('public.destinations.index', compact('destinations', 'schema'));
    }

    public function show(string $slug): View
    {
        $destination = Destination::active()
            ->where('slug', $slug)
            ->firstOrFail();

        $tours = Tour::published()
            ->byDestination($destination->id)
            ->latest('published_at')
            ->get();

        $visaCountry = VisaCountry::active()
            ->where('country_name', 'like', "%{$destination->country}%")
            ->orWhere('slug', $destination->slug)
            ->first();

        $breadcrumbs = [
            'Home' => route('home'),
            'Destinations' => route('destinations.index'),
            $destination->name => route('destinations.show', $destination->slug),
        ];
        $breadcrumbSchema = $this->seoService->generateBreadcrumbSchema($breadcrumbs);
        $destinationSchema = $this->seoService->generateDestinationSchema($destination);
        $schema = $destinationSchema . "\n" . $breadcrumbSchema;

        return view('public.destinations.show', compact('destination', 'tours', 'visaCountry', 'schema'));
    }
}
