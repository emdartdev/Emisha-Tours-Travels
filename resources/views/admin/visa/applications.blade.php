@extends('layouts.admin')

@section('title', 'Visa Applications Queue')
@section('page_title', 'Visa Applications & Consular Queue')

@section('content')
<div class="space-y-6">
    <!-- Filter & Search Bar -->
    <div class="admin-card rounded-3xl p-6 border shadow-xl">
        <form action="{{ route('admin.visa.applications') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div>
                <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Search Dossiers</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-[var(--admin-text-muted)]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}" 
                        placeholder="Ref #, Name, Passport, Phone..."
                        class="admin-input w-full pl-10 pr-4 py-2.5 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-xs transition"
                    >
                </div>
            </div>

            <div>
                <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Destination Country</label>
                <select name="country_id" class="admin-input w-full px-3.5 py-2.5 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-xs transition">
                    <option value="">All Destinations</option>
                    @foreach($countries as $c)
                        <option value="{{ $c->id }}" {{ request('country_id') == $c->id ? 'selected' : '' }}>
                            {{ $c->flag }} {{ $c->country_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Consular Status</label>
                <select name="status" class="admin-input w-full px-3.5 py-2.5 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-xs transition">
                    <option value="">All Workflow Statuses</option>
                    <option value="received" {{ request('status') == 'received' ? 'selected' : '' }}>Received (New)</option>
                    <option value="under_review" {{ request('status') == 'under_review' ? 'selected' : '' }}>Under Review</option>
                    <option value="embassy_submitted" {{ request('status') == 'embassy_submitted' ? 'selected' : '' }}>Embassy / VFS Submitted</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Visa Approved</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected / Denied</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <div class="flex items-end gap-2">
                <button type="submit" class="flex-1 py-2.5 bg-gradient-to-r from-[#D4AF37] to-[#B38F26] text-[#050D1A] font-extrabold rounded-xl text-xs uppercase tracking-wider hover:brightness-110 shadow-lg shadow-[#D4AF37]/20 transition flex items-center justify-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                    <span>Filter</span>
                </button>
                <a href="{{ route('admin.visa.applications') }}" class="px-4 py-2.5 admin-subtle text-[var(--admin-text-muted)] hover:text-[var(--admin-text-main)] font-bold rounded-xl text-xs uppercase tracking-wider transition border">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Applications Table -->
    <div class="admin-card rounded-3xl border shadow-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="admin-table-head border-b text-[var(--admin-text-muted)] uppercase font-bold text-[10px]">
                    <tr>
                        <th class="py-4 px-6">Reference ID</th>
                        <th class="py-4 px-6">Applicant Name</th>
                        <th class="py-4 px-6">Destination & Type</th>
                        <th class="py-4 px-6">Profession</th>
                        <th class="py-4 px-6">Encrypted Docs</th>
                        <th class="py-4 px-6">Submitted Date</th>
                        <th class="py-4 px-6">Status</th>
                        <th class="py-4 px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y admin-table-divider">
                    @forelse($applications as $app)
                        <tr class="admin-table-row transition">
                            <td class="py-4 px-6">
                                <a href="{{ route('admin.visa.applications.show', $app->id) }}" class="font-extrabold text-[#D4AF37] hover:underline font-mono text-sm block">
                                    {{ $app->reference_number }}
                                </a>
                                <span class="text-[10px] text-[var(--admin-text-muted)] block mt-0.5">Ref ID</span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-bold text-[var(--admin-text-main)] block text-sm">{{ $app->full_name }}</span>
                                <span class="text-[var(--admin-text-muted)] block text-[11px] font-mono">{{ $app->phone }}</span>
                                @if($app->passport_number)
                                    <span class="text-[10px] text-[var(--admin-text-muted)] font-mono">Passport: {{ $app->passport_number }}</span>
                                @endif
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-1.5">
                                    @if(!empty($app->country->flag))
                                        <span class="text-base">{{ $app->country->flag }}</span>
                                    @else
                                        <svg class="w-4 h-4 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    @endif
                                    <span class="font-semibold text-[var(--admin-text-main)]">{{ $app->country->country_name ?? 'N/A' }}</span>
                                </div>
                                <span class="text-[var(--admin-text-muted)] text-[11px] block mt-0.5">{{ $app->visaType->name ?? 'Standard Tourist' }}</span>
                            </td>
                            <td class="py-4 px-6 text-[var(--admin-text-main)]">
                                <span class="px-2 py-0.5 rounded-md admin-subtle border text-[11px]">
                                    {{ $app->profession->name ?? 'Not Specified' }}
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-2.5 py-1 rounded-lg bg-emerald-500/10 border border-emerald-500/30 text-emerald-600 dark:text-emerald-400 font-bold inline-flex items-center gap-1.5 text-[11px]">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                    <span>{{ $app->documents->count() }} Files</span>
                                </span>
                            </td>
                            <td class="py-4 px-6 text-[var(--admin-text-muted)] text-[11px]">
                                <span class="block text-[var(--admin-text-main)] font-semibold">{{ $app->submitted_at ? $app->submitted_at->format('M d, Y') : $app->created_at->format('M d, Y') }}</span>
                                <span class="text-[10px] text-[var(--admin-text-muted)]">{{ $app->submitted_at ? $app->submitted_at->format('h:i A') : '' }}</span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider
                                    @if($app->status === 'received') bg-blue-500/10 text-blue-600 dark:text-blue-400 border border-blue-500/30
                                    @elseif($app->status === 'under_review') bg-amber-500/10 text-amber-600 dark:text-amber-400 border border-amber-500/30
                                    @elseif($app->status === 'embassy_submitted') bg-purple-500/10 text-purple-600 dark:text-purple-400 border border-purple-500/30
                                    @elseif($app->status === 'approved') bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/30
                                    @elseif($app->status === 'rejected') bg-rose-500/10 text-rose-600 dark:text-rose-400 border border-rose-500/30
                                    @else admin-subtle text-[var(--admin-text-muted)] border @endif">
                                    {{ str_replace('_', ' ', $app->status) }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.visa.applications.show', $app->id) }}" class="px-3.5 py-1.5 bg-[#D4AF37] hover:bg-[#c49f2e] text-[#050D1A] font-extrabold rounded-xl text-xs transition shadow-md flex items-center gap-1">
                                        <span>Dossier</span>
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-16 text-center text-[var(--admin-text-muted)]">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <svg class="w-10 h-10 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    <span class="text-sm font-semibold text-[var(--admin-text-muted)]">No visa applications match your filter criteria.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($applications->hasPages())
            <div class="p-4 border-t admin-table-divider admin-table-head">
                {{ $applications->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
