@extends('layouts.admin')

@section('title', 'Visa Countries & Guidelines CMS')
@section('page_title', 'Visa Countries & Requirements')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 admin-card rounded-3xl p-6 border shadow-xl">
        <div>
            <h3 class="text-base font-extrabold text-[var(--admin-text-main)] tracking-tight">International Visa Catalog</h3>
            <p class="text-xs text-[var(--admin-text-muted)] mt-0.5">Manage embassy rules, document checklists, and service fee slabs across 50+ destinations.</p>
        </div>

        <a href="{{ route('admin.visa.countries.create') }}" class="px-5 py-2.5 bg-gradient-to-r from-[#D4AF37] to-[#B38F26] text-[#050D1A] font-extrabold rounded-xl text-xs uppercase tracking-wider hover:brightness-110 shadow-lg shadow-[#D4AF37]/20 transition flex items-center gap-2 self-start sm:self-auto">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
            <span>Add Visa Country</span>
        </a>
    </div>

    <div class="admin-card rounded-3xl border shadow-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="admin-table-head border-b text-[var(--admin-text-muted)] uppercase font-bold text-[10px]">
                    <tr>
                        <th class="py-4 px-6">Destination</th>
                        <th class="py-4 px-6">Flag</th>
                        <th class="py-4 px-6">Active Visa Types</th>
                        <th class="py-4 px-6">Promotion Tier</th>
                        <th class="py-4 px-6">Last Verified</th>
                        <th class="py-4 px-6">Status</th>
                        <th class="py-4 px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y admin-table-divider">
                    @forelse($countries as $c)
                        <tr class="admin-table-row transition">
                            <td class="py-4 px-6">
                                <span class="font-extrabold text-[var(--admin-text-main)] text-sm block">{{ $c->country_name }}</span>
                                <span class="text-[10px] text-[var(--admin-text-muted)] font-mono">{{ $c->slug }}</span>
                            </td>
                            <td class="py-4 px-6 text-2xl">
                                {{ $c->flag ?: '🌐' }}
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-2.5 py-1 admin-subtle border text-[var(--admin-text-main)] rounded-lg font-bold text-[11px]">
                                    {{ $c->visa_types_count }} Visa Types
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $c->featured ? 'bg-amber-500/10 text-[#D4AF37] border border-[#D4AF37]/30' : 'admin-subtle text-[var(--admin-text-muted)] border' }}">
                                    {{ $c->featured ? '★ Top Hub' : 'Standard' }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-[var(--admin-text-muted)]">
                                {{ $c->information_updated_at ? $c->information_updated_at->format('M d, Y') : 'N/A' }}
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $c->status === 'active' ? 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/30' : 'admin-subtle text-[var(--admin-text-muted)] border' }}">
                                    {{ $c->status }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right space-x-2">
                                <a href="{{ route('admin.visa.countries.edit', $c->id) }}" class="px-3 py-1.5 rounded-lg admin-subtle hover:brightness-110 text-[var(--admin-text-main)] font-bold text-xs border transition inline-block">
                                    Edit Rules
                                </a>
                                <form action="{{ route('admin.visa.countries.destroy', $c->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this visa country and all its rules?')">
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
                            <td colspan="7" class="py-12 text-center text-[var(--admin-text-muted)] text-xs">No visa countries listed.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($countries->hasPages())
            <div class="p-4 border-t admin-table-divider admin-table-head">
                {{ $countries->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
