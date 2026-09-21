@extends('layouts.admin')

@section('title', 'Destinations CMS')
@section('page_title', 'Destinations Management')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 admin-card rounded-3xl p-6 border shadow-xl">
        <div>
            <h3 class="text-base font-extrabold text-[var(--admin-text-main)] tracking-tight">Worldwide Tourist Destinations</h3>
            <p class="text-xs text-[var(--admin-text-muted)] mt-0.5">Manage cities, countries, and holiday hotspots with associated tour packages.</p>
        </div>

        <a href="{{ route('admin.destinations.create') }}" class="px-5 py-2.5 bg-gradient-to-r from-[#D4AF37] to-[#B38F26] text-[#050D1A] font-extrabold rounded-xl text-xs uppercase tracking-wider hover:brightness-110 shadow-lg shadow-[#D4AF37]/20 transition flex items-center gap-2 self-start sm:self-auto">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
            <span>Add Destination</span>
        </a>
    </div>

    <div class="admin-card rounded-3xl border shadow-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="admin-table-head border-b text-[var(--admin-text-muted)] uppercase font-bold text-[10px]">
                    <tr>
                        <th class="py-4 px-6">Destination</th>
                        <th class="py-4 px-6">Country / Region</th>
                        <th class="py-4 px-6">Associated Tours</th>
                        <th class="py-4 px-6">Featured</th>
                        <th class="py-4 px-6">Status</th>
                        <th class="py-4 px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y admin-table-divider">
                    @forelse($destinations as $dest)
                        <tr class="admin-table-row transition">
                            <td class="py-4 px-6">
                                <div class="flex items-center space-x-3.5">
                                    <img src="{{ $dest->thumbnail ?: 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=120' }}" 
                                         alt="{{ $dest->name }}" class="w-12 h-12 rounded-xl object-cover bg-slate-900 border border-[var(--admin-card-border)] flex-shrink-0 shadow-sm">
                                    <div>
                                        <span class="font-extrabold text-[var(--admin-text-main)] block text-sm">{{ $dest->name }}</span>
                                        <div class="flex items-center gap-2 mt-0.5">
                                            <span class="text-[var(--admin-text-muted)] text-[11px] font-mono">{{ $dest->slug }}</span>
                                            <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[10px] font-semibold {{ $dest->name_bn ? 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20' : 'bg-amber-500/10 text-amber-600 dark:text-amber-400 border border-amber-500/20' }}">
                                                <span>EN ✓</span>
                                                <span>|</span>
                                                <span>{{ $dest->name_bn ? 'BN ✓' : 'BN ⚠' }}</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-[var(--admin-text-main)] font-medium">
                                {{ $dest->country }} {{ $dest->region ? "({$dest->region})" : '' }}
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-2.5 py-1 admin-subtle border text-[var(--admin-text-main)] rounded-lg font-bold text-[11px]">
                                    {{ $dest->tours_count }} Packages
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $dest->featured ? 'bg-amber-500/10 text-[#D4AF37] border border-[#D4AF37]/30' : 'admin-subtle text-[var(--admin-text-muted)] border' }}">
                                    {{ $dest->featured ? '★ Top Spot' : 'Standard' }}
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $dest->status === 'active' ? 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/30' : 'admin-subtle text-[var(--admin-text-muted)] border' }}">
                                    {{ $dest->status }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right space-x-2 whitespace-nowrap">
                                <a href="{{ route('admin.destinations.edit', $dest->id) }}" class="px-3 py-1.5 rounded-lg admin-subtle hover:brightness-110 text-[var(--admin-text-main)] font-bold text-xs border transition inline-block">
                                    Edit
                                </a>
                                <form action="{{ route('admin.destinations.destroy', $dest->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this destination?')">
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
                            <td colspan="6" class="py-12 text-center text-[var(--admin-text-muted)] text-xs">No destinations found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($destinations->hasPages())
            <div class="p-4 border-t admin-table-divider admin-table-head">
                {{ $destinations->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
