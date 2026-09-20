<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use App\Models\GalleryCategory;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        $categories = GalleryCategory::where('status', 'active')
            ->orderBy('sort_order', 'asc')
            ->get();

        $images = GalleryImage::where('status', 'active')
            ->with('category')
            ->orderBy('sort_order', 'asc')
            ->paginate(24);

        return view('public.gallery.index', compact('categories', 'images'));
    }
}
