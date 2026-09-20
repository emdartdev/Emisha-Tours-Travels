@extends('layouts.admin')

@section('title', 'Photo Gallery CMS')
@section('page_title', 'Travel Memory & Visual Gallery Management')

@section('content')
<div class="space-y-6">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Add Photo Form (4 cols) -->
        <div class="lg:col-span-4">
            <div class="admin-card rounded-3xl p-6 border shadow-xl space-y-4 sticky top-24">
                <div class="flex items-center gap-2 pb-3 border-b border-[var(--admin-card-border)]">
                    <span class="w-2 h-2 rounded-full bg-[#D4AF37]"></span>
                    <h3 class="font-extrabold text-[var(--admin-text-main)] text-sm tracking-tight">
                        Upload to Visual Gallery
                    </h3>
                </div>

                <form action="{{ route('admin.gallery.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Direct Image URL *</label>
                        <input type="url" name="image_url" required placeholder="https://images.unsplash.com/..."
                            class="admin-input w-full px-3.5 py-2.5 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-xs transition">
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Gallery Category *</label>
                        <select name="gallery_category_id" required class="admin-input w-full px-3.5 py-2.5 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-xs transition">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Photo Title / Landmark</label>
                        <input type="text" name="title" placeholder="e.g. Maldives Sunset Water Villa"
                            class="admin-input w-full px-3.5 py-2.5 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-xs transition">
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Caption / Subtitle</label>
                        <input type="text" name="caption" placeholder="e.g. Luxury group tour moment 2026"
                            class="admin-input w-full px-3.5 py-2.5 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-xs transition">
                    </div>

                    <button type="submit" class="w-full py-3 bg-gradient-to-r from-[#D4AF37] to-[#B38F26] text-[#050D1A] font-extrabold rounded-xl text-xs uppercase tracking-wider hover:brightness-110 shadow-lg shadow-[#D4AF37]/20 transition">
                        Publish to Public Gallery
                    </button>
                </form>
            </div>
        </div>

        <!-- Photo Grid Display (8 cols) -->
        <div class="lg:col-span-8">
            <div class="admin-card rounded-3xl p-6 border shadow-xl space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-[var(--admin-card-border)]">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-cyan-400"></span>
                        <h3 class="font-extrabold text-[var(--admin-text-main)] text-sm tracking-tight">Active Gallery Photos</h3>
                    </div>
                    <span class="text-xs text-[var(--admin-text-muted)] font-mono">{{ $images->total() }} Images Listed</span>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                    @forelse($images as $img)
                        <div class="relative group rounded-2xl overflow-hidden bg-slate-900 border border-[var(--admin-card-border)] h-44 shadow-md">
                            <img src="{{ $img->image_url }}" alt="{{ $img->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/95 via-slate-950/40 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 p-3.5 flex flex-col justify-end">
                                <span class="text-[9px] text-[#D4AF37] font-extrabold uppercase tracking-wider">{{ $img->category->name ?? 'Photo' }}</span>
                                <h4 class="text-xs text-white font-bold truncate">{{ $img->title ?: 'Gallery Photo' }}</h4>
                                <form action="{{ route('admin.gallery.destroy', $img->id) }}" method="POST" class="mt-2 text-right" onsubmit="return confirm('Delete this gallery photo?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-[10px] text-rose-400 hover:text-white font-bold uppercase inline-flex items-center gap-1 bg-rose-500/20 px-2 py-1 rounded-lg border border-rose-500/30">
                                        <svg class="w-3 h-3 text-rose-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        <span>Delete</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 py-16 text-center text-[var(--admin-text-muted)] text-xs">
                            No photos added to gallery yet.
                        </div>
                    @endforelse
                </div>

                @if($images->hasPages())
                    <div class="mt-6 pt-4 border-t border-[var(--admin-card-border)]">
                        {{ $images->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
