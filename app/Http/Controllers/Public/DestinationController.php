<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Tour;
use App\Models\VisaCountry;
use Illuminate\View\View;

class DestinationController extends Controller
{
    public function index(): View
    {
        $destinations = Destination::active()
            ->withCount(['tours' => function ($q) {
                $q->published();
            }])
            ->orderBy('sort_order', 'asc')
            ->paginate(12);

        return view('public.destinations.index', compact('destinations'));
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

        return view('public.destinations.show', compact('destination', 'tours', 'visaCountry'));
    }
}
