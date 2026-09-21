<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class DestinationAdminController extends Controller
{
    public function index(): View
    {
        $destinations = Destination::withCount('tours')
            ->orderBy('sort_order', 'asc')
            ->paginate(15);

        return view('admin.destinations.index', compact('destinations'));
    }

    public function create(): View
    {
        return view('admin.destinations.form', [
            'destination' => new Destination(),
            'isEdit' => false
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'name_bn' => ['nullable', 'string', 'max:150'],
            'country' => ['required', 'string', 'max:100'],
            'region' => ['nullable', 'string', 'max:100'],
            'hero_image' => ['nullable', 'string', 'max:500'],
            'thumbnail' => ['nullable', 'string', 'max:500'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'short_description_bn' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'description_bn' => ['nullable', 'string'],
            'status' => ['required', 'in:active,inactive'],
            'featured' => ['boolean'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $data['slug'] = Str::slug($data['name']);
        $data['featured'] = $request->boolean('featured');

        $destination = Destination::create($data);

        return redirect()->route('admin.destinations.index')
            ->with('success', "Destination '{$destination->name}' added successfully.");
    }

    public function edit(int $id): View
    {
        $destination = Destination::findOrFail($id);

        return view('admin.destinations.form', [
            'destination' => $destination,
            'isEdit' => true
        ]);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $destination = Destination::findOrFail($id);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'name_bn' => ['nullable', 'string', 'max:150'],
            'country' => ['required', 'string', 'max:100'],
            'region' => ['nullable', 'string', 'max:100'],
            'hero_image' => ['nullable', 'string', 'max:500'],
            'thumbnail' => ['nullable', 'string', 'max:500'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'short_description_bn' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'description_bn' => ['nullable', 'string'],
            'status' => ['required', 'in:active,inactive'],
            'featured' => ['boolean'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $data['featured'] = $request->boolean('featured');
        $destination->update($data);

        return redirect()->route('admin.destinations.index')
            ->with('success', "Destination '{$destination->name}' updated successfully.");
    }

    public function destroy(int $id): RedirectResponse
    {
        $destination = Destination::findOrFail($id);
        $destination->delete();

        return redirect()->route('admin.destinations.index')
            ->with('success', "Destination '{$destination->name}' removed successfully.");
    }
}
