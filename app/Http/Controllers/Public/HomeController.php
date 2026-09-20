<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Services\TourService;
use App\Services\VisaService;
use App\Services\SeoService;
use App\Models\Destination;
use App\Models\Testimonial;
use App\Models\BlogPost;
use App\Models\Faq;
use App\Models\Offer;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct(
        protected TourService $tourService,
        protected VisaService $visaService,
        protected SeoService $seoService
    ) {}

    public function index(): View
    {
        $featuredTours = $this->tourService->getFeaturedTours(6);
        $popularDestinations = Destination::active()->featured()->orderBy('sort_order', 'asc')->limit(6)->get();
        $featuredVisaCountries = $this->visaService->getFeaturedCountries(10);
        $offers = Offer::active()->featured()->with(['destination', 'tour'])->limit(1)->get();
        $testimonials = Testimonial::published()->featured()->orderBy('sort_order', 'asc')->limit(3)->get();
        $recentBlogs = BlogPost::published()->with(['category', 'author'])->latest('published_at')->limit(3)->get();
        $faqs = Faq::active()->orderBy('sort_order', 'asc')->limit(5)->get();
        $schema = $this->seoService->generateTravelAgencySchema();

        return view('public.home', compact(
            'featuredTours',
            'popularDestinations',
            'featuredVisaCountries',
            'offers',
            'testimonials',
            'recentBlogs',
            'faqs',
            'schema'
        ));
    }
}
