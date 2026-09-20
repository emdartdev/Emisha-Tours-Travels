@extends('layouts.admin')

@section('title', $isEdit ? "Edit Destination: {$destination->name}" : 'Add Destination')
@section('page_title', $isEdit ? "Edit Destination: {$destination->name}" : 'Add New Tourist Destination')

@section('content')
<div class="space-y-6">
    <div>
        <a href="{{ route('admin.destinations.index') }}" class="text-xs font-bold text-[var(--admin-text-muted)] hover:text-[#D4AF37] inline-flex items-center gap-1.5 transition">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Back to Destinations</span>
        </a>
    </div>

    <div class="admin-card rounded-3xl border shadow-xl p-6 sm:p-8 max-w-4xl">
        <form action="{{ $isEdit ? route('admin.destinations.update', $destination->id) : route('admin.destinations.store') }}" method="POST" class="space-y-6">
            @csrf
            @if($isEdit)
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Destination Name *</label>
                    <input type="text" name="name" value="{{ old('name', $destination->name) }}" required placeholder="e.g. Bangkok"
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition">
                    @error('name') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Country *</label>
                    <input type="text" name="country" value="{{ old('country', $destination->country) }}" required placeholder="e.g. Thailand"
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition">
                    @error('country') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Region</label>
                    <input type="text" name="region" value="{{ old('region', $destination->region) }}" placeholder="e.g. Southeast Asia"
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition">
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Status</label>
                    <select name="status" class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition">
                        <option value="active" {{ old('status', $destination->status) === 'active' ? 'selected' : '' }}>Active (Public)</option>
                        <option value="inactive" {{ old('status', $destination->status) === 'inactive' ? 'selected' : '' }}>Inactive (Draft)</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Hero / Cover Image URL</label>
                    <input type="url" name="hero_image" value="{{ old('hero_image', $destination->hero_image) }}" placeholder="https://images.unsplash.com/..."
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Short Description</label>
                    <input type="text" name="short_description" value="{{ old('short_description', $destination->short_description) }}" placeholder="City of temples, bustling night markets, and vibrant street life."
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Detailed Guide / Overview</label>
                    <textarea name="description" rows="5" placeholder="Full destination background, best time to visit, and local cultural tips..."
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition">{{ old('description', $destination->description) }}</textarea>
                </div>

                <div class="flex items-center space-x-3 pt-4">
                    <input type="checkbox" name="featured" id="featured" value="1" {{ old('featured', $destination->featured) ? 'checked' : '' }}
                        class="w-5 h-5 rounded border text-[#D4AF37] focus:ring-[#D4AF37]">
                    <label for="featured" class="text-xs font-bold uppercase tracking-wider text-[var(--admin-text-main)] cursor-pointer">
                        Display in Popular Destinations on Home
                    </label>
                </div>
            </div>

            <div class="pt-6 border-t border-[var(--admin-card-border)] flex items-center justify-end space-x-3">
                <a href="{{ route('admin.destinations.index') }}" class="px-6 py-3 border border-[var(--admin-card-border)] text-[var(--admin-text-muted)] hover:text-[var(--admin-text-main)] font-bold rounded-xl text-xs uppercase tracking-wider admin-subtle transition">
                    Cancel
                </a>
                <button type="submit" class="px-8 py-3 bg-gradient-to-r from-[#D4AF37] to-[#B38F26] text-[#050D1A] font-extrabold rounded-xl text-xs uppercase tracking-wider hover:brightness-110 shadow-lg shadow-[#D4AF37]/20 transition">
                    {{ $isEdit ? 'Update Destination' : 'Save Destination' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
