<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Services\TourService;
use App\Services\InquiryService;
use App\Services\SeoService;
use App\Http\Requests\StoreTourInquiryRequest;
use App\Models\Destination;
use App\Models\TourCategory;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TourController extends Controller
{
    public function __construct(
        protected TourService $tourService,
        protected InquiryService $inquiryService,
        protected SeoService $seoService
    ) {}

    public function index(Request $request): View
    {
        $filters = $request->only(['search', 'destination', 'category', 'duration', 'min_price', 'max_price', 'sort']);
        $tours = $this->tourService->getFilteredTours($filters, 9);
        $destinations = Destination::active()->orderBy('name', 'asc')->get();
        $categories = TourCategory::active()->orderBy('sort_order', 'asc')->get();

        return view('public.tours.index', compact('tours', 'destinations', 'categories', 'filters'));
    }

    public function show(string $slug): View
    {
        $tour = $this->tourService->getTourBySlug($slug);
        $relatedTours = $this->tourService->getRelatedTours($tour, 3);
        $schema = $this->seoService->generateTourSchema($tour);

        return view('public.tours.show', compact('tour', 'relatedTours', 'schema'));
    }

    public function inquire(StoreTourInquiryRequest $request, string $slug): RedirectResponse
    {
        $tour = $this->tourService->getTourBySlug($slug);
        $data = $request->validated();
        $data['tour_id'] = $tour->id;
        $data['tour_title'] = $tour->title;

        $inquiry = $this->inquiryService->createTourInquiry($data);

        return redirect()
            ->back()
            ->with('success', "Thank you, {$inquiry->full_name}! Your inquiry for '{$tour->title}' has been submitted. Reference: {$inquiry->reference_number}. Our travel consultant will contact you shortly.");
    }
}
