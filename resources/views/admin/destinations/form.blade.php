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

    <div class="admin-card rounded-3xl border shadow-xl p-6 sm:p-8 max-w-4xl" x-data="{ langTab: 'en' }">
        <div class="flex items-center justify-between pb-6 border-b border-[var(--admin-card-border)] mb-6">
            <div>
                <h3 class="text-sm font-bold text-[var(--admin-text-main)]">Language & Content Localization</h3>
                <p class="text-xs text-[var(--admin-text-muted)]">Switch between English and Bengali content to manage dual-language destination information.</p>
            </div>
            <div class="flex items-center gap-1.5 p-1 bg-slate-100 dark:bg-slate-800/80 rounded-xl border border-[var(--admin-card-border)]">
                <button type="button" @click="langTab = 'en'" :class="langTab === 'en' ? 'bg-[#D4AF37] text-slate-950 font-bold shadow-xs' : 'text-[var(--admin-text-muted)] hover:text-[var(--admin-text-main)]'" class="px-3.5 py-1.5 rounded-lg text-xs font-semibold flex items-center gap-1.5 transition">
                    <span>🇬🇧</span>
                    <span>English</span>
                </button>
                <button type="button" @click="langTab = 'bn'" :class="langTab === 'bn' ? 'bg-[#D4AF37] text-slate-950 font-bold shadow-xs' : 'text-[var(--admin-text-muted)] hover:text-[var(--admin-text-main)]'" class="px-3.5 py-1.5 rounded-lg text-xs font-semibold flex items-center gap-1.5 transition">
                    <span>🇧🇩</span>
                    <span>বাংলা</span>
                    @if(!empty($destination->name_bn))
                        <span class="inline-block w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    @endif
                </button>
            </div>
        </div>

        <form action="{{ $isEdit ? route('admin.destinations.update', $destination->id) : route('admin.destinations.store') }}" method="POST" class="space-y-6">
            @csrf
            @if($isEdit)
                @method('PUT')
            @endif

            <!-- ENGLISH TRANSLATABLE FIELDS -->
            <div x-show="langTab === 'en'" class="space-y-6">
                <div class="bg-blue-50/50 dark:bg-blue-950/20 border border-blue-200/50 dark:border-blue-800/30 rounded-2xl p-4 text-xs text-blue-700 dark:text-blue-300 flex items-center gap-2">
                    <span class="text-base">🇬🇧</span>
                    <span>Editing <strong>English</strong> destination information. This serves as primary content.</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Destination Name (EN) *</label>
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
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Short Description (EN)</label>
                    <input type="text" name="short_description" value="{{ old('short_description', $destination->short_description) }}" placeholder="City of temples, bustling night markets, and vibrant street life."
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition">
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Detailed Guide / Overview (EN)</label>
                    <textarea name="description" rows="5" placeholder="Full destination background, best time to visit, and local cultural tips..."
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition">{{ old('description', $destination->description) }}</textarea>
                </div>
            </div>

            <!-- BANGLA TRANSLATABLE FIELDS -->
            <div x-show="langTab === 'bn'" class="space-y-6" style="display: none;">
                <div class="bg-emerald-50/50 dark:bg-emerald-950/20 border border-emerald-200/50 dark:border-emerald-800/30 rounded-2xl p-4 text-xs text-emerald-700 dark:text-emerald-300 flex items-center gap-2">
                    <span class="text-base">🇧🇩</span>
                    <span>Editing <strong>বাংলা (Bengali)</strong> localized destination content.</span>
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">গন্তব্যের নাম (বাংলা)</label>
                    <input type="text" name="name_bn" value="{{ old('name_bn', $destination->name_bn) }}" placeholder="যেমন: ব্যাংকক"
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition font-['Hind_Siliguri',sans-serif]">
                    @error('name_bn') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">সংক্ষিপ্ত বিবরণ (বাংলা)</label>
                    <input type="text" name="short_description_bn" value="{{ old('short_description_bn', $destination->short_description_bn) }}" placeholder="ঐতিহাসিক মন্দির, প্রাণবন্ত নাইট মার্কেট এবং আধুনিক সংস্কৃতির মেলবন্ধন।"
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition font-['Hind_Siliguri',sans-serif]">
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">সম্পূর্ণ ভ্রমণ নির্দেশিকা ও বিবরণ (বাংলা)</label>
                    <textarea name="description_bn" rows="5" placeholder="গন্তব্যের আকর্ষণসমূহ, ভ্রমণের সেরা সময় এবং সার্বিক তথ্য..."
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition font-['Hind_Siliguri',sans-serif]">{{ old('description_bn', $destination->description_bn) }}</textarea>
                </div>
            </div>

            <div class="pt-6 border-t border-[var(--admin-card-border)]">
                <h4 class="text-xs font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-4">Destination Settings</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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

                    <div class="flex items-center space-x-3 pt-4">
                        <input type="checkbox" name="featured" id="featured" value="1" {{ old('featured', $destination->featured) ? 'checked' : '' }}
                            class="w-5 h-5 rounded border text-[#D4AF37] focus:ring-[#D4AF37]">
                        <label for="featured" class="text-xs font-bold uppercase tracking-wider text-[var(--admin-text-main)] cursor-pointer">
                            Display in Popular Destinations on Home
                        </label>
                    </div>
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
