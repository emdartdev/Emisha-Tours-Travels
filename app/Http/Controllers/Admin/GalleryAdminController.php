<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use App\Models\GalleryCategory;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class GalleryAdminController extends Controller
{
    public function index(): View
    {
        $images = GalleryImage::with('category')
            ->orderBy('sort_order', 'asc')
            ->latest()
            ->paginate(24);

        $categories = GalleryCategory::where('status', 'active')->get();

        return view('admin.gallery.index', compact('images', 'categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'gallery_category_id' => ['required', 'exists:gallery_categories,id'],
            'image_url' => ['required', 'string', 'max:500'],
            'title' => ['nullable', 'string', 'max:255'],
            'caption' => ['nullable', 'string', 'max:500'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $data['image_path'] = $data['image_url'] ?? $data['image_path'] ?? '';
        unset($data['image_url']);
        $data['status'] = 'active';

        GalleryImage::create($data);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Photo added to tour gallery successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $img = GalleryImage::findOrFail($id);
        $img->delete();

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Photo deleted successfully.');
    }
}
