<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use App\Models\GalleryCategory;
use App\Services\SeoService;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function __construct(
        protected SeoService $seoService
    ) {}

    public function index(): View
    {
        $categories = GalleryCategory::where('status', 'active')
            ->orderBy('sort_order', 'asc')
            ->get();

        $images = GalleryImage::where('status', 'active')
            ->with('category')
            ->orderBy('sort_order', 'asc')
            ->paginate(24);

        $breadcrumbs = [
            'Home' => route('home'),
            'Travel Photo & Tour Moments Gallery' => route('gallery.index'),
        ];
        $schema = $this->seoService->generateBreadcrumbSchema($breadcrumbs);

        return view('public.gallery.index', compact('categories', 'images', 'schema'));
    }
}
