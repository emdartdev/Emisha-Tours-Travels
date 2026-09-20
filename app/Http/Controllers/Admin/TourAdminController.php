<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\Destination;
use App\Models\TourCategory;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class TourAdminController extends Controller
{
    public function index(Request $request): View
    {
        $query = Tour::with(['destination', 'category']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('destination_id')) {
            $query->where('destination_id', $request->destination_id);
        }

        if ($request->filled('search')) {
            $term = $request->search;
            $query->where('title', 'like', "%{$term}%");
        }

        $tours = $query->orderBy('sort_order', 'asc')->latest()->paginate(15)->withQueryString();
        $destinations = Destination::active()->orderBy('name')->get();
        $categories = TourCategory::where('status', 'active')->orderBy('name')->get();

        return view('admin.tours.index', compact('tours', 'destinations', 'categories'));
    }

    public function create(): View
    {
        $destinations = Destination::active()->orderBy('name')->get();
        $categories = TourCategory::where('status', 'active')->orderBy('name')->get();

        return view('admin.tours.form', [
            'tour' => new Tour(),
            'destinations' => $destinations,
            'categories' => $categories,
            'isEdit' => false
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'destination_id' => ['required', 'exists:destinations,id'],
            'tour_category_id' => ['required', 'exists:tour_categories,id'],
            'regular_price' => ['required', 'numeric', 'min:0'],
            'discount_price' => ['nullable', 'numeric', 'min:0'],
            'duration_days' => ['required', 'integer', 'min:1'],
            'duration_nights' => ['required', 'integer', 'min:0'],
            'featured_image' => ['nullable', 'string', 'max:500'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'description' => ['required', 'string'],
            'status' => ['required', 'in:published,draft,archived'],
            'featured' => ['boolean'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $data['slug'] = Str::slug($data['title']) . '-' . rand(100, 999);
        $data['featured'] = $request->boolean('featured');
        $data['price'] = $data['regular_price'];
        $data['cover_image'] = $data['featured_image'] ?? null;

        $tour = Tour::create($data);

        return redirect()->route('admin.tours.index')
            ->with('success', "Tour package '{$tour->title}' created successfully.");
    }

    public function edit(int $id): View
    {
        $tour = Tour::with(['destination', 'category', 'itineraries', 'inclusions', 'exclusions'])->findOrFail($id);
        $destinations = Destination::active()->orderBy('name')->get();
        $categories = TourCategory::where('status', 'active')->orderBy('name')->get();

        return view('admin.tours.form', [
            'tour' => $tour,
            'destinations' => $destinations,
            'categories' => $categories,
            'isEdit' => true
        ]);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $tour = Tour::findOrFail($id);

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'destination_id' => ['required', 'exists:destinations,id'],
            'tour_category_id' => ['required', 'exists:tour_categories,id'],
            'regular_price' => ['required', 'numeric', 'min:0'],
            'discount_price' => ['nullable', 'numeric', 'min:0'],
            'duration_days' => ['required', 'integer', 'min:1'],
            'duration_nights' => ['required', 'integer', 'min:0'],
            'featured_image' => ['nullable', 'string', 'max:500'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'description' => ['required', 'string'],
            'status' => ['required', 'in:published,draft,archived'],
            'featured' => ['boolean'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $data['featured'] = $request->boolean('featured');
        $data['price'] = $data['regular_price'];
        if (isset($data['featured_image'])) {
            $data['cover_image'] = $data['featured_image'];
        }
        $tour->update($data);

        return redirect()->route('admin.tours.index')
            ->with('success', "Tour package '{$tour->title}' updated successfully.");
    }

    public function toggleFeatured(int $id): RedirectResponse
    {
        $tour = Tour::findOrFail($id);
        $tour->update(['featured' => !$tour->featured]);

        $state = $tour->featured ? 'marked as Featured' : 'removed from Featured';
        return redirect()->back()->with('success', "Tour '{$tour->title}' {$state}.");
    }

    public function destroy(int $id): RedirectResponse
    {
        $tour = Tour::findOrFail($id);
        $tour->delete();

        return redirect()->route('admin.tours.index')
            ->with('success', "Tour '{$tour->title}' deleted successfully.");
    }
}
