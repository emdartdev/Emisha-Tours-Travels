<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Testimonial;
use App\Services\SeoService;
use Illuminate\View\View;

class PageController extends Controller
{
    public function __construct(
        protected SeoService $seoService
    ) {}

    public function about(): View
    {
        $page = Page::published()->where('slug', 'about')->first();
        $testimonials = Testimonial::published()->featured()->orderBy('sort_order')->limit(6)->get();
        if ($testimonials->isEmpty()) {
            $testimonials = Testimonial::published()->orderBy('sort_order')->limit(6)->get();
        }

        $breadcrumbs = [
            'Home' => route('home'),
            'About Us — Emisha Tours & Travels' => route('about'),
        ];
        $breadcrumbSchema = $this->seoService->generateBreadcrumbSchema($breadcrumbs);
        $agencySchema = $this->seoService->generateTravelAgencySchema();
        $schema = $agencySchema . "\n" . $breadcrumbSchema;

        return view('public.about', compact('page', 'testimonials', 'schema'));
    }

    public function show(string $slug): View
    {
        $page = Page::published()->where('slug', $slug)->firstOrFail();

        $breadcrumbs = [
            'Home' => route('home'),
            $page->title => route('pages.show', $page->slug),
        ];
        $schema = $this->seoService->generateBreadcrumbSchema($breadcrumbs);

        return view('public.pages.show', compact('page', 'schema'));
    }
}
