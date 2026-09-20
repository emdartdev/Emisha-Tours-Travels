<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Testimonial;
use Illuminate\View\View;

class PageController extends Controller
{
    public function about(): View
    {
        $page = Page::published()->where('slug', 'about')->first();
        $testimonials = Testimonial::published()->featured()->orderBy('sort_order')->limit(6)->get();
        if ($testimonials->isEmpty()) {
            $testimonials = Testimonial::published()->orderBy('sort_order')->limit(6)->get();
        }

        return view('public.about', compact('page', 'testimonials'));
    }

    public function show(string $slug): View
    {
        $page = Page::published()->where('slug', $slug)->firstOrFail();

        return view('public.pages.show', compact('page'));
    }
}
