@extends('layouts.admin')

@section('title', $isEdit ? "Edit Visa Rules: {$country->country_name}" : 'Add Visa Country')
@section('page_title', $isEdit ? "Edit Visa Rules: {$country->country_name}" : 'Add New Visa Country')

@section('content')
<div class="space-y-6">
    <div>
        <a href="{{ route('admin.visa.countries') }}" class="text-xs font-bold text-[var(--admin-text-muted)] hover:text-[#D4AF37] inline-flex items-center gap-1.5 transition">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Back to Visa Countries Catalog</span>
        </a>
    </div>

    <div class="admin-card rounded-3xl border shadow-xl p-6 sm:p-8 max-w-4xl">
        <form action="{{ $isEdit ? route('admin.visa.countries.update', $country->id) : route('admin.visa.countries.store') }}" method="POST" class="space-y-6">
            @csrf
            @if($isEdit)
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Country Name *</label>
                    <input type="text" name="country_name" value="{{ old('country_name', $country->country_name) }}" required placeholder="e.g. Thailand"
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition">
                    @error('country_name') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Flag Emoji / Icon</label>
                    <input type="text" name="flag" value="{{ old('flag', $country->flag) }}" placeholder="e.g. 🇹🇭"
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Hero Image URL</label>
                    <input type="url" name="hero_image" value="{{ old('hero_image', $country->hero_image) }}" placeholder="https://images.unsplash.com/..."
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Short Description *</label>
                    <input type="text" name="short_description" value="{{ old('short_description', $country->short_description) }}" placeholder="Tourist and business sticker/e-visa processing for Bangladeshi passport holders."
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">General Embassy Guidelines & Terms</label>
                    <textarea name="description" rows="5" placeholder="Detailed embassy submission guidelines, biometrics instructions, and processing times..."
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition">{{ old('description', $country->description) }}</textarea>
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Publishing Status</label>
                    <select name="status" class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition">
                        <option value="active" {{ old('status', $country->status) === 'active' ? 'selected' : '' }}>Active (Public)</option>
                        <option value="inactive" {{ old('status', $country->status) === 'inactive' ? 'selected' : '' }}>Inactive (Draft)</option>
                    </select>
                </div>

                <div class="flex items-center space-x-3 pt-6">
                    <input type="checkbox" name="featured" id="featured" value="1" {{ old('featured', $country->featured) ? 'checked' : '' }}
                        class="w-5 h-5 rounded border text-[#D4AF37] focus:ring-[#D4AF37]">
                    <label for="featured" class="text-xs font-bold uppercase tracking-wider text-[var(--admin-text-main)] cursor-pointer">
                        Feature in Top Visa Destinations
                    </label>
                </div>
            </div>

            <div class="pt-6 border-t border-[var(--admin-card-border)] flex items-center justify-end space-x-3">
                <a href="{{ route('admin.visa.countries') }}" class="px-6 py-3 border border-[var(--admin-card-border)] text-[var(--admin-text-muted)] hover:text-[var(--admin-text-main)] font-bold rounded-xl text-xs uppercase tracking-wider admin-subtle transition">
                    Cancel
                </a>
                <button type="submit" class="px-8 py-3 bg-gradient-to-r from-[#D4AF37] to-[#B38F26] text-[#050D1A] font-extrabold rounded-xl text-xs uppercase tracking-wider hover:brightness-110 shadow-lg shadow-[#D4AF37]/20 transition">
                    {{ $isEdit ? 'Update Visa Country' : 'Save Country' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
