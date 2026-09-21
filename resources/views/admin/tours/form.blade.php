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

    <div class="admin-card rounded-3xl border shadow-xl p-6 sm:p-8 max-w-4xl" x-data="{ langTab: 'en' }">
        <div class="flex items-center justify-between pb-6 border-b border-[var(--admin-card-border)] mb-6">
            <div>
                <h3 class="text-sm font-bold text-[var(--admin-text-main)]">Language & Content Localization</h3>
                <p class="text-xs text-[var(--admin-text-muted)]">Switch between English and Bengali content to manage dual-language information.</p>
            </div>
            <div class="flex items-center gap-1.5 p-1 bg-slate-100 dark:bg-slate-800/80 rounded-xl border border-[var(--admin-card-border)]">
                <button type="button" @click="langTab = 'en'" :class="langTab === 'en' ? 'bg-[#D4AF37] text-slate-950 font-bold shadow-xs' : 'text-[var(--admin-text-muted)] hover:text-[var(--admin-text-main)]'" class="px-3.5 py-1.5 rounded-lg text-xs font-semibold flex items-center gap-1.5 transition">
                    <span>🇬🇧</span>
                    <span>English</span>
                </button>
                <button type="button" @click="langTab = 'bn'" :class="langTab === 'bn' ? 'bg-[#D4AF37] text-slate-950 font-bold shadow-xs' : 'text-[var(--admin-text-muted)] hover:text-[var(--admin-text-main)]'" class="px-3.5 py-1.5 rounded-lg text-xs font-semibold flex items-center gap-1.5 transition">
                    <span>🇧🇩</span>
                    <span>বাংলা</span>
                    @if(!empty($tour->title_bn))
                        <span class="inline-block w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    @endif
                </button>
            </div>
        </div>

        <form action="{{ $isEdit ? route('admin.tours.update', $tour->id) : route('admin.tours.store') }}" method="POST" class="space-y-6">
            @csrf
            @if($isEdit)
                @method('PUT')
            @endif

            <!-- ENGLISH TRANSLATABLE FIELDS -->
            <div x-show="langTab === 'en'" class="space-y-6">
                <div class="bg-blue-50/50 dark:bg-blue-950/20 border border-blue-200/50 dark:border-blue-800/30 rounded-2xl p-4 text-xs text-blue-700 dark:text-blue-300 flex items-center gap-2">
                    <span class="text-base">🇬🇧</span>
                    <span>Editing <strong>English</strong> package information. This serves as the primary and fallback language.</span>
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Package Title (EN) *</label>
                    <input type="text" name="title" value="{{ old('title', $tour->title) }}" required placeholder="e.g. 5 Days Thailand Highlights: Bangkok & Pattaya"
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition">
                    @error('title') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Short Overview / Tagline (EN)</label>
                    <input type="text" name="short_description" value="{{ old('short_description', $tour->short_description) }}" placeholder="A wonderful 5-day getaway exploring Thailand's premier cultural highlights."
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition">
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Full Description & Highlights (EN) *</label>
                    <textarea name="description" rows="6" required placeholder="Detailed package information, sightseeing spots, and special experiences..."
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition">{{ old('description', $tour->description) }}</textarea>
                    @error('description') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- BANGLA TRANSLATABLE FIELDS -->
            <div x-show="langTab === 'bn'" class="space-y-6" style="display: none;">
                <div class="bg-emerald-50/50 dark:bg-emerald-950/20 border border-emerald-200/50 dark:border-emerald-800/30 rounded-2xl p-4 text-xs text-emerald-700 dark:text-emerald-300 flex items-center gap-2">
                    <span class="text-base">🇧🇩</span>
                    <span>Editing <strong>বাংলা (Bengali)</strong> localized content. If left empty, the site will automatically fallback to English.</span>
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">ট্যুর প্যাকেজ শিরোনাম (বাংলা)</label>
                    <input type="text" name="title_bn" value="{{ old('title_bn', $tour->title_bn) }}" placeholder="যেমন: ৫ দিন থাইল্যান্ড সেরা ভ্রমণ: ব্যাংকক ও পাতায়া"
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition font-['Hind_Siliguri',sans-serif]">
                    @error('title_bn') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">সংক্ষিপ্ত বিবরণ (বাংলা)</label>
                    <input type="text" name="short_description_bn" value="{{ old('short_description_bn', $tour->short_description_bn) }}" placeholder="থাইল্যান্ডের মনোমুগ্ধকর সংস্কৃতি ও সমুদ্রসৈকত পরিদর্শনের ৫ দিনের প্রিমিয়াম প্যাকেজ।"
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition font-['Hind_Siliguri',sans-serif]">
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">সম্পূর্ণ প্যাকেজ বিবরণ ও আকর্ষণসমূহ (বাংলা)</label>
                    <textarea name="description_bn" rows="6" placeholder="প্যাকেজের বিস্তারিত ভ্রমণসূচি, হোটেলের মান ও সুযোগ-সুবিধা সংক্রান্ত তথ্য..."
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition font-['Hind_Siliguri',sans-serif]">{{ old('description_bn', $tour->description_bn) }}</textarea>
                    @error('description_bn') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="pt-6 border-t border-[var(--admin-card-border)]">
                <h4 class="text-xs font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-4">Package Specifications & Logistics</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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
