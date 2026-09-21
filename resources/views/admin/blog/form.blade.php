@extends('layouts.admin')

@section('title', $isEdit ? "Edit Article: {$post->title}" : 'Write New Article')
@section('page_title', $isEdit ? "Edit Article: {$post->title}" : 'Write New Travel Guide')

@section('content')
<div class="space-y-6">
    <div>
        <a href="{{ route('admin.blog.index') }}" class="text-xs font-bold text-[var(--admin-text-muted)] hover:text-[#D4AF37] inline-flex items-center gap-1.5 transition">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Back to Articles</span>
        </a>
    </div>

    <div class="admin-card rounded-3xl border shadow-xl p-6 sm:p-8 max-w-4xl" x-data="{ langTab: 'en' }">
        <div class="flex items-center justify-between pb-6 border-b border-[var(--admin-card-border)] mb-6">
            <div>
                <h3 class="text-sm font-bold text-[var(--admin-text-main)]">Language & Content Localization</h3>
                <p class="text-xs text-[var(--admin-text-muted)]">Switch between English and Bengali content to publish localized travel guides.</p>
            </div>
            <div class="flex items-center gap-1.5 p-1 bg-slate-100 dark:bg-slate-800/80 rounded-xl border border-[var(--admin-card-border)]">
                <button type="button" @click="langTab = 'en'" :class="langTab === 'en' ? 'bg-[#D4AF37] text-slate-950 font-bold shadow-xs' : 'text-[var(--admin-text-muted)] hover:text-[var(--admin-text-main)]'" class="px-3.5 py-1.5 rounded-lg text-xs font-semibold flex items-center gap-1.5 transition">
                    <span>🇬🇧</span>
                    <span>English</span>
                </button>
                <button type="button" @click="langTab = 'bn'" :class="langTab === 'bn' ? 'bg-[#D4AF37] text-slate-950 font-bold shadow-xs' : 'text-[var(--admin-text-muted)] hover:text-[var(--admin-text-main)]'" class="px-3.5 py-1.5 rounded-lg text-xs font-semibold flex items-center gap-1.5 transition">
                    <span>🇧🇩</span>
                    <span>বাংলা</span>
                    @if(!empty($post->title_bn))
                        <span class="inline-block w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    @endif
                </button>
            </div>
        </div>

        <form action="{{ $isEdit ? route('admin.blog.update', $post->id) : route('admin.blog.store') }}" method="POST" class="space-y-6">
            @csrf
            @if($isEdit)
                @method('PUT')
            @endif

            <!-- ENGLISH TRANSLATABLE FIELDS -->
            <div x-show="langTab === 'en'" class="space-y-6">
                <div class="bg-blue-50/50 dark:bg-blue-950/20 border border-blue-200/50 dark:border-blue-800/30 rounded-2xl p-4 text-xs text-blue-700 dark:text-blue-300 flex items-center gap-2">
                    <span class="text-base">🇬🇧</span>
                    <span>Editing <strong>English</strong> article guide.</span>
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Article Title (EN) *</label>
                    <input type="text" name="title" value="{{ old('title', $post->title) }}" required placeholder="e.g. Complete Thailand Tourist Visa Checklist for Bangladeshi Travelers (2026)"
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition">
                    @error('title') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Excerpt / Meta Summary (EN)</label>
                    <textarea name="excerpt" rows="2" placeholder="Short preview summary displayed on blog catalog cards and social shares..."
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition">{{ old('excerpt', $post->excerpt) }}</textarea>
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Article Body Content (EN) *</label>
                    <textarea name="content" rows="12" required placeholder="Write the complete article guide here..."
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm leading-relaxed transition">{{ old('content', $post->content) }}</textarea>
                    @error('content') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- BANGLA TRANSLATABLE FIELDS -->
            <div x-show="langTab === 'bn'" class="space-y-6" style="display: none;">
                <div class="bg-emerald-50/50 dark:bg-emerald-950/20 border border-emerald-200/50 dark:border-emerald-800/30 rounded-2xl p-4 text-xs text-emerald-700 dark:text-emerald-300 flex items-center gap-2">
                    <span class="text-base">🇧🇩</span>
                    <span>Editing <strong>বাংলা (Bengali)</strong> localized article content.</span>
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">নিবন্ধের শিরোনাম (বাংলা)</label>
                    <input type="text" name="title_bn" value="{{ old('title_bn', $post->title_bn) }}" placeholder="যেমন: বাংলাদেশী পর্যটকদের জন্য সম্পূর্ণ থাইল্যান্ড ট্যুরিস্ট ভিসা গাইড (২০২৬)"
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition font-['Hind_Siliguri',sans-serif]">
                    @error('title_bn') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">সংক্ষিপ্ত সারসংক্ষেপ (বাংলা)</label>
                    <textarea name="excerpt_bn" rows="2" placeholder="ব্লগ কার্ড ও সোশ্যাল মিডিয়ার জন্য সংক্ষিপ্ত প্রিভিউ..."
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition font-['Hind_Siliguri',sans-serif]">{{ old('excerpt_bn', $post->excerpt_bn) }}</textarea>
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">নিবন্ধের মূল বিষয়বস্তু (বাংলা)</label>
                    <textarea name="content_bn" rows="12" placeholder="বাংলায় সম্পূর্ণ ট্রাভেল গাইড ও ভ্রমণ নির্দেশিকা লিখুন..."
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm leading-relaxed transition font-['Hind_Siliguri',sans-serif]">{{ old('content_bn', $post->content_bn) }}</textarea>
                    @error('content_bn') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="pt-6 border-t border-[var(--admin-card-border)] space-y-6">
                <h4 class="text-xs font-bold uppercase tracking-wider text-[var(--admin-text-muted)]">Article Configuration</h4>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Category *</label>
                        <select name="blog_category_id" required class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition">
                            <option value="">Select Category</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('blog_category_id', $post->blog_category_id) == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Estimated Read Time (Mins)</label>
                        <input type="number" name="reading_time" value="{{ old('reading_time', $post->reading_time ?? 5) }}" min="1" max="60"
                            class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition">
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Publication Status</label>
                        <select name="status" class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition">
                            <option value="published" {{ old('status', $post->status) === 'published' ? 'selected' : '' }}>Published (Live)</option>
                            <option value="draft" {{ old('status', $post->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="archived" {{ old('status', $post->status) === 'archived' ? 'selected' : '' }}>Archived</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Featured Cover Image URL</label>
                    <input type="url" name="featured_image" value="{{ old('featured_image', $post->featured_image) }}" placeholder="https://images.unsplash.com/..."
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition">
                </div>
            </div>

            <div class="pt-6 border-t border-[var(--admin-card-border)] flex items-center justify-end space-x-3">
                <a href="{{ route('admin.blog.index') }}" class="px-6 py-3 border border-[var(--admin-card-border)] text-[var(--admin-text-muted)] hover:text-[var(--admin-text-main)] font-bold rounded-xl text-xs uppercase tracking-wider admin-subtle transition">
                    Cancel
                </a>
                <button type="submit" class="px-8 py-3 bg-gradient-to-r from-[#D4AF37] to-[#B38F26] text-[#050D1A] font-extrabold rounded-xl text-xs uppercase tracking-wider hover:brightness-110 shadow-lg shadow-[#D4AF37]/20 transition">
                    {{ $isEdit ? 'Update Article' : 'Publish Article' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
