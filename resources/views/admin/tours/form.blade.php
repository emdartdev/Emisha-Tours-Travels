@extends('layouts.admin')

@section('title', $isEdit ? "Edit Tour: {$tour->title}" : 'Create Tour Package')
@section('page_title', $isEdit ? "Edit Package: {$tour->title}" : 'Create New Holiday Package')

@section('content')
<div class="space-y-6">
    <div>
        <a href="{{ route('admin.tours.index') }}" class="text-xs font-bold text-[var(--admin-text-muted)] hover:text-[#D4AF37] inline-flex items-center gap-1.5 transition">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Back to Tour Packages</span>
        </a>
    </div>

    <div class="admin-card rounded-3xl border shadow-xl p-6 sm:p-8 max-w-4xl">
        <form action="{{ $isEdit ? route('admin.tours.update', $tour->id) : route('admin.tours.store') }}" method="POST" class="space-y-6">
            @csrf
            @if($isEdit)
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Package Title *</label>
                    <input type="text" name="title" value="{{ old('title', $tour->title) }}" required placeholder="e.g. 5 Days Thailand Highlights: Bangkok & Pattaya"
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition">
                    @error('title') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Destination *</label>
                    <select name="destination_id" required class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition">
                        <option value="">Select Destination</option>
                        @foreach($destinations as $d)
                            <option value="{{ $d->id }}" {{ old('destination_id', $tour->destination_id) == $d->id ? 'selected' : '' }}>
                                {{ $d->name }} ({{ $d->country }})
                            </option>
                        @endforeach
                    </select>
                    @error('destination_id') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Tour Category *</label>
                    <select name="tour_category_id" required class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition">
                        <option value="">Select Category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('tour_category_id', $tour->tour_category_id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('tour_category_id') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Regular Price (BDT) *</label>
                    <input type="number" name="regular_price" value="{{ old('regular_price', $tour->regular_price) }}" required min="0" step="100" placeholder="e.g. 65000"
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition">
                    @error('regular_price') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Discounted / Offer Price (BDT)</label>
                    <input type="number" name="discount_price" value="{{ old('discount_price', $tour->discount_price) }}" min="0" step="100" placeholder="e.g. 58000"
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition">
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Duration Days *</label>
                    <input type="number" name="duration_days" value="{{ old('duration_days', $tour->duration_days ?? 5) }}" required min="1" max="60"
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition">
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Duration Nights *</label>
                    <input type="number" name="duration_nights" value="{{ old('duration_nights', $tour->duration_nights ?? 4) }}" required min="0" max="60"
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Featured Image URL</label>
                    <input type="url" name="featured_image" value="{{ old('featured_image', $tour->featured_image) }}" placeholder="https://images.unsplash.com/photo-..."
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Short Overview / Tagline</label>
                    <input type="text" name="short_description" value="{{ old('short_description', $tour->short_description) }}" placeholder="A wonderful 5-day getaway exploring Thailand's premier cultural highlights."
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Full Description & Highlights *</label>
                    <textarea name="description" rows="6" required placeholder="Detailed package information, sightseeing spots, and special experiences..."
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition">{{ old('description', $tour->description) }}</textarea>
                    @error('description') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Publication Status</label>
                    <select name="status" class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition">
                        <option value="published" {{ old('status', $tour->status) === 'published' ? 'selected' : '' }}>Published (Live)</option>
                        <option value="draft" {{ old('status', $tour->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="archived" {{ old('status', $tour->status) === 'archived' ? 'selected' : '' }}>Archived</option>
                    </select>
                </div>

                <div class="flex items-center space-x-3 pt-6">
                    <input type="checkbox" name="featured" id="featured" value="1" {{ old('featured', $tour->featured) ? 'checked' : '' }}
                        class="w-5 h-5 rounded border text-[#D4AF37] focus:ring-[#D4AF37]">
                    <label for="featured" class="text-xs font-bold uppercase tracking-wider text-[var(--admin-text-main)] cursor-pointer">
                        Display as Featured Package
                    </label>
                </div>
            </div>

            <div class="pt-6 border-t border-[var(--admin-card-border)] flex items-center justify-end space-x-3">
                <a href="{{ route('admin.tours.index') }}" class="px-6 py-3 border border-[var(--admin-card-border)] text-[var(--admin-text-muted)] hover:text-[var(--admin-text-main)] font-bold rounded-xl text-xs uppercase tracking-wider admin-subtle transition">
                    Cancel
                </a>
                <button type="submit" class="px-8 py-3 bg-gradient-to-r from-[#D4AF37] to-[#B38F26] text-[#050D1A] font-extrabold rounded-xl text-xs uppercase tracking-wider hover:brightness-110 shadow-lg shadow-[#D4AF37]/20 transition">
                    {{ $isEdit ? 'Update Package' : 'Save Package' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
