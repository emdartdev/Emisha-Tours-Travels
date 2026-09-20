@extends('layouts.admin')

@section('title', 'Tour Packages CMS')
@section('page_title', 'Tour Packages & Holiday Catalog')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 admin-card rounded-3xl p-6 border shadow-xl">
        <form action="{{ route('admin.tours.index') }}" method="GET" class="flex-1 flex gap-3 max-w-md">
            <div class="relative flex-1">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-[var(--admin-text-muted)]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Search package title..."
                    class="admin-input w-full pl-10 pr-4 py-2.5 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-xs transition"
                >
            </div>
            <button type="submit" class="px-5 py-2.5 admin-subtle hover:brightness-110 text-[var(--admin-text-main)] font-bold rounded-xl text-xs uppercase tracking-wider transition border">
                Search
            </button>
        </form>

        <a href="{{ route('admin.tours.create') }}" class="px-5 py-2.5 bg-gradient-to-r from-[#D4AF37] to-[#B38F26] text-[#050D1A] font-extrabold rounded-xl text-xs uppercase tracking-wider hover:brightness-110 shadow-lg shadow-[#D4AF37]/20 transition flex items-center gap-2 self-start sm:self-auto">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
            <span>Add New Package</span>
        </a>
    </div>

    <div class="admin-card rounded-3xl border shadow-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="admin-table-head border-b text-[var(--admin-text-muted)] uppercase font-bold text-[10px]">
                    <tr>
                        <th class="py-4 px-6">Tour Package</th>
                        <th class="py-4 px-6">Destination & Category</th>
                        <th class="py-4 px-6">Duration</th>
                        <th class="py-4 px-6">Price (BDT)</th>
                        <th class="py-4 px-6">Featured</th>
                        <th class="py-4 px-6">Status</th>
                        <th class="py-4 px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y admin-table-divider">
                    @forelse($tours as $tour)
                        <tr class="admin-table-row transition">
                            <td class="py-4 px-6">
                                <div class="flex items-center space-x-3.5">
                                    <img src="{{ $tour->featured_image ?: 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=120' }}" 
                                         alt="{{ $tour->title }}" class="w-12 h-12 rounded-xl object-cover bg-slate-900 border border-[var(--admin-card-border)] flex-shrink-0 shadow-sm">
                                    <div>
                                        <span class="font-extrabold text-[var(--admin-text-main)] block text-sm">{{ $tour->title }}</span>
                                        <span class="text-[var(--admin-text-muted)] text-[11px] font-mono">{{ $tour->slug }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-semibold text-[var(--admin-text-main)] block">{{ $tour->destination->name ?? 'N/A' }}</span>
                                <span class="text-[var(--admin-text-muted)] text-[11px]">{{ $tour->category->name ?? 'General' }}</span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-2.5 py-1 admin-subtle border text-[var(--admin-text-main)] rounded-lg font-bold text-[11px]">
                                    {{ $tour->duration_days }}D / {{ $tour->duration_nights }}N
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-extrabold text-[#D4AF37] block text-sm">৳ {{ number_format($tour->discount_price ?? $tour->regular_price) }}</span>
                                @if($tour->discount_price)
                                    <span class="text-[10px] text-[var(--admin-text-muted)] line-through">৳ {{ number_format($tour->regular_price) }}</span>
                                @endif
                            </td>
                            <td class="py-4 px-6">
                                <form action="{{ route('admin.tours.toggle-featured', $tour->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase transition {{ $tour->featured ? 'bg-amber-500/10 text-[#D4AF37] border border-[#D4AF37]/30' : 'admin-subtle text-[var(--admin-text-muted)] border hover:brightness-110' }}">
                                        {{ $tour->featured ? '★ Featured' : 'Standard' }}
                                    </button>
                                </form>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider
                                    @if($tour->status === 'published') bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/30
                                    @elseif($tour->status === 'draft') bg-amber-500/10 text-amber-600 dark:text-amber-400 border border-amber-500/30
                                    @else admin-subtle text-[var(--admin-text-muted)] border @endif">
                                    {{ $tour->status }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right space-x-2 whitespace-nowrap">
                                <a href="{{ route('admin.tours.edit', $tour->id) }}" class="px-3 py-1.5 rounded-lg admin-subtle hover:brightness-110 text-[var(--admin-text-main)] font-bold text-xs border transition inline-block">
                                    Edit
                                </a>
                                <form action="{{ route('admin.tours.destroy', $tour->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this tour package?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 text-[var(--admin-text-muted)] hover:text-rose-500 rounded-lg transition" title="Delete">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-[var(--admin-text-muted)] text-xs">No tour packages found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($tours->hasPages())
            <div class="p-4 border-t admin-table-divider admin-table-head">
                {{ $tours->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
