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

    <div class="admin-card rounded-3xl border shadow-xl p-6 sm:p-8 max-w-4xl">
        <form action="{{ $isEdit ? route('admin.blog.update', $post->id) : route('admin.blog.store') }}" method="POST" class="space-y-6">
            @csrf
            @if($isEdit)
                @method('PUT')
            @endif

            <div class="space-y-6">
                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Article Title *</label>
                    <input type="text" name="title" value="{{ old('title', $post->title) }}" required placeholder="e.g. Complete Thailand Tourist Visa Checklist for Bangladeshi Travelers (2026)"
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition">
                    @error('title') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

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

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Excerpt / Meta Summary</label>
                    <textarea name="excerpt" rows="2" placeholder="Short preview summary displayed on blog catalog cards and social shares..."
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm transition">{{ old('excerpt', $post->excerpt) }}</textarea>
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Article Body Content *</label>
                    <textarea name="content" rows="12" required placeholder="Write the complete article guide here..."
                        class="admin-input w-full px-4 py-3 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-sm leading-relaxed transition">{{ old('content', $post->content) }}</textarea>
                    @error('content') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
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
