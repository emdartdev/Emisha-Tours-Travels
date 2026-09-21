<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisaCountry;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class VisaCountryAdminController extends Controller
{
    public function index(): View
    {
        $countries = VisaCountry::withCount('visaTypes')
            ->orderBy('sort_order', 'asc')
            ->paginate(15);

        return view('admin.visa.countries', compact('countries'));
    }

    public function create(): View
    {
        return view('admin.visa.country_form', [
            'country' => new VisaCountry(),
            'isEdit' => false
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'country_name' => ['required', 'string', 'max:100'],
            'country_name_bn' => ['nullable', 'string', 'max:100'],
            'flag' => ['nullable', 'string', 'max:50'],
            'hero_image' => ['nullable', 'string', 'max:500'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'short_description_bn' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'description_bn' => ['nullable', 'string'],
            'status' => ['required', 'in:active,inactive'],
            'featured' => ['boolean'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $data['slug'] = Str::slug($data['country_name']);
        $data['featured'] = $request->boolean('featured');
        $data['information_updated_at'] = now();

        $country = VisaCountry::create($data);

        return redirect()->route('admin.visa.countries')
            ->with('success', "Visa Country '{$country->country_name}' added successfully.");
    }

    public function edit(int $id): View
    {
        $country = VisaCountry::with('visaTypes')->findOrFail($id);

        return view('admin.visa.country_form', [
            'country' => $country,
            'isEdit' => true
        ]);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $country = VisaCountry::findOrFail($id);

        $data = $request->validate([
            'country_name' => ['required', 'string', 'max:100'],
            'country_name_bn' => ['nullable', 'string', 'max:100'],
            'flag' => ['nullable', 'string', 'max:50'],
            'hero_image' => ['nullable', 'string', 'max:500'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'short_description_bn' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'description_bn' => ['nullable', 'string'],
            'status' => ['required', 'in:active,inactive'],
            'featured' => ['boolean'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $data['featured'] = $request->boolean('featured');
        $data['information_updated_at'] = now();

        $country->update($data);

        return redirect()->route('admin.visa.countries')
            ->with('success', "Visa Country '{$country->country_name}' updated successfully.");
    }

    public function destroy(int $id): RedirectResponse
    {
        $country = VisaCountry::findOrFail($id);
        $country->delete();

        return redirect()->route('admin.visa.countries')
            ->with('success', "Visa Country '{$country->country_name}' removed successfully.");
    }
}
