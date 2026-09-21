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

    <div class="admin-card rounded-3xl border shadow-xl p-6 sm:p-8 max-w-4xl" x-data="{ langTab: 'en' }">
        <div class="flex items-center justify-between pb-6 border-b border-[var(--admin-card-border)] mb-6">
            <div>
                <h3 class="text-sm font-bold text-[var(--admin-text-main)]">Language & Content Localization</h3>
                <p class="text-xs text-[var(--admin-text-muted)]">Switch between English and Bengali content to manage dual-language visa rules and information.</p>
            </div>
            <div class="flex items-center gap-1.5 p-1 bg-slate-100 dark:bg-slate-800/80 rounded-xl border border-[var(--admin-card-border)]">
                <button type="button" @click="langTab = 'en'" :class="langTab === 'en' ? 'bg-[#D4AF37] text-slate-950 font-bold shadow-xs' : 'text-[var(--admin-text-muted)] hover:text-[var(--admin-text-main)]'" class="px-3.5 py-1.5 rounded-lg text-xs font-semibold flex items-center gap-1.5 transition">
                    <span>🇬🇧</span>
                    <span>English</span>
                </button>
                <button type="button" @click="langTab = 'bn'" :class="langTab === 'bn' ? 'bg-[#D4AF37] text-slate-950 font-bold shadow-xs' : 'text-[var(--admin-text-muted)] hover:text-[var(--admin-text-main)]'" class="px-3.5 py-1.5 rounded-lg text-xs font-semibold flex items-center gap-1.5 transition">
                    <span>🇧🇩</span>
                    <span>বাংলা</span>
                    @if(!empty($country->country_name_bn))
                        <span class="inline-block w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    @endif
                </button>
            </div>
        </div>

        <form action="{{ $isEdit ? route('admin.visa.countries.update', $country->id) : route('admin.visa.countries.store') }}" method="POST" class="space-y-6">
            @csrf
            @if($isEdit)
                @method('PUT')
            @endif

            <!-- ENGLISH TRANSLATABLE FIELDS -->
            <div x-show="langTab === 'en'" class="space-y-6">
                <div class="bg-blue-50/50 dark:bg-blue-950/20 border border-blue-200/50 dark:border-blue-800/30 rounded-2xl p-4 text-xs text-blue-700 dark:text-blue-300 flex items-center gap-2">
                    <span class="text-base">🇬🇧</span>
                    <span>Editing <strong>English</strong> visa country information.</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Country Name (EN) *</label>
                        <input type="text" name="country_name" value="{{ old('country_name', $country->country_name) }}" required placeholder="e.g. Thailand"
                            class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition">
                        @error('country_name') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Flag Emoji / Icon</label>
                        <input type="text" name="flag" value="{{ old('flag', $country->flag) }}" placeholder="e.g. 🇹🇭"
                            class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition">
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Short Description (EN) *</label>
                    <input type="text" name="short_description" value="{{ old('short_description', $country->short_description) }}" placeholder="Tourist and business sticker/e-visa processing for Bangladeshi passport holders."
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition">
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">General Embassy Guidelines & Terms (EN)</label>
                    <textarea name="description" rows="5" placeholder="Detailed embassy submission guidelines, biometrics instructions, and processing times..."
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition">{{ old('description', $country->description) }}</textarea>
                </div>
            </div>

            <!-- BANGLA TRANSLATABLE FIELDS -->
            <div x-show="langTab === 'bn'" class="space-y-6" style="display: none;">
                <div class="bg-emerald-50/50 dark:bg-emerald-950/20 border border-emerald-200/50 dark:border-emerald-800/30 rounded-2xl p-4 text-xs text-emerald-700 dark:text-emerald-300 flex items-center gap-2">
                    <span class="text-base">🇧🇩</span>
                    <span>Editing <strong>বাংলা (Bengali)</strong> localized visa country content.</span>
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">দেশের নাম (বাংলা)</label>
                    <input type="text" name="country_name_bn" value="{{ old('country_name_bn', $country->country_name_bn) }}" placeholder="যেমন: থাইল্যান্ড"
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition font-['Hind_Siliguri',sans-serif]">
                    @error('country_name_bn') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">সংক্ষিপ্ত বিবরণ (বাংলা)</label>
                    <input type="text" name="short_description_bn" value="{{ old('short_description_bn', $country->short_description_bn) }}" placeholder="বাংলাদেশী পাসপোর্টধারীদের জন্য স্টিকার ও ই-ভিসা প্রসেসিং সেবা।"
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition font-['Hind_Siliguri',sans-serif]">
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">দূতাবাস নির্দেশনা ও সার্বিক নিয়মাবলী (বাংলা)</label>
                    <textarea name="description_bn" rows="5" placeholder="দূতাবাসে আবেদন জমা, বায়োমেট্রিক ও প্রসেসিং সময় সম্পর্কিত তথ্য..."
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition font-['Hind_Siliguri',sans-serif]">{{ old('description_bn', $country->description_bn) }}</textarea>
                </div>
            </div>

            <div class="pt-6 border-t border-[var(--admin-card-border)]">
                <h4 class="text-xs font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-4">Visa Settings</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Hero Image URL</label>
                        <input type="url" name="hero_image" value="{{ old('hero_image', $country->hero_image) }}" placeholder="https://images.unsplash.com/..."
                            class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition">
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
