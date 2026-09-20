@extends('layouts.admin')

@section('title', 'Tour Inquiries & Leads')
@section('page_title', 'Tour Inquiries Management Desk')

@section('content')
<div class="space-y-6">
    <!-- Filter & Search Bar -->
    <div class="admin-card rounded-3xl p-6 border shadow-xl">
        <form action="{{ route('admin.inquiries') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div>
                <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Search Inquiries</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-[var(--admin-text-muted)]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}" 
                        placeholder="Ref #, Name, Email, Phone..."
                        class="admin-input w-full pl-10 pr-4 py-2.5 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-xs transition"
                    >
                </div>
            </div>

            <div>
                <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Lead Status</label>
                <select name="status" class="admin-input w-full px-3.5 py-2.5 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-xs transition">
                    <option value="">All Statuses</option>
                    <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>New Leads</option>
                    <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="quoted" {{ request('status') == 'quoted' ? 'selected' : '' }}>Quote Sent</option>
                    <option value="booked" {{ request('status') == 'booked' ? 'selected' : '' }}>Booked / Closed</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <div class="flex items-end gap-2">
                <button type="submit" class="flex-1 py-2.5 bg-gradient-to-r from-[#D4AF37] to-[#B38F26] text-[#050D1A] font-extrabold rounded-xl text-xs uppercase tracking-wider hover:brightness-110 shadow-lg shadow-[#D4AF37]/20 transition flex items-center justify-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                    <span>Filter Leads</span>
                </button>
                <a href="{{ route('admin.inquiries') }}" class="px-4 py-2.5 admin-subtle text-[var(--admin-text-muted)] hover:text-[var(--admin-text-main)] font-bold rounded-xl text-xs uppercase tracking-wider transition border">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Inquiries Table -->
    <div class="admin-card rounded-3xl border shadow-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="admin-table-head border-b text-[var(--admin-text-muted)] uppercase font-bold text-[10px]">
                    <tr>
                        <th class="py-4 px-6">Ref ID</th>
                        <th class="py-4 px-6">Customer Details</th>
                        <th class="py-4 px-6">Package / Destination</th>
                        <th class="py-4 px-6">Pax & Travel Date</th>
                        <th class="py-4 px-6">Message & Customer Notes</th>
                        <th class="py-4 px-6">Status</th>
                        <th class="py-4 px-6 text-right">Update Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y admin-table-divider">
                    @forelse($inquiries as $inq)
                        <tr class="admin-table-row transition">
                            <td class="py-4 px-6 font-mono font-extrabold text-[#D4AF37] text-sm">
                                {{ $inq->reference_number }}
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-bold text-[var(--admin-text-main)] block text-sm">{{ $inq->full_name }}</span>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="text-[var(--admin-text-muted)] font-mono text-[11px]">{{ $inq->phone }}</span>
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $inq->phone) }}?text=Hello%20{{ urlencode($inq->full_name) }},%20this%20is%20Emisha%20Tours%20regarding%20your%20inquiry%20{{ urlencode($inq->reference_number) }}." 
                                       target="_blank" 
                                       class="p-1 rounded bg-emerald-500/20 text-emerald-600 dark:text-emerald-400 hover:bg-emerald-500 hover:text-white transition" 
                                       title="WhatsApp Chat">
                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.664-.699c.971.53 1.771.78 2.796.78 3.182 0 5.768-2.587 5.768-5.766.001-3.187-2.575-5.766-5.768-5.766zm-1.077 7.748l-.348-.175c-.538-.27-1.127-.86-1.397-1.399l-.176-.348c-.08-.158-.029-.314.07-.413l.422-.423c.094-.094.094-.247 0-.341l-.846-.846c-.094-.094-.247-.094-.341 0l-.361.361c-.347.348-.445.856-.251 1.309.431 1.009 1.258 1.836 2.267 2.268.453.193.962.096 1.309-.251l.361-.361c.094-.094.094-.247 0-.341l-.846-.846c-.094-.094-.247-.094-.341 0l-.422.423c-.099.099-.255.15-.413.07z"/></svg>
                                    </a>
                                </div>
                                <span class="text-[var(--admin-text-muted)] text-[10px] block">{{ $inq->email }}</span>
                            </td>
                            <td class="py-4 px-6">
                                @if($inq->tour)
                                    <span class="font-bold text-[var(--admin-text-main)] block">{{ $inq->tour->title }}</span>
                                @else
                                    <span class="font-bold text-[var(--admin-text-main)] block">{{ $inq->tour_title ?? 'Custom Trip Inquiry' }}</span>
                                @endif
                                <span class="text-[var(--admin-text-muted)] text-[11px]">{{ $inq->tour?->destination->name ?? 'General Inquiry' }}</span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-semibold text-[var(--admin-text-main)] flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-[var(--admin-text-muted)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    <span>{{ $inq->adults }} Adults, {{ $inq->children }} Kids</span>
                                </span>
                                <span class="text-[var(--admin-text-muted)] flex items-center gap-1.5 mt-1 text-[11px]">
                                    <svg class="w-3.5 h-3.5 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>{{ $inq->travel_date ? $inq->travel_date->format('M d, Y') : 'Flexible' }}</span>
                                </span>
                            </td>
                            <td class="py-4 px-6 max-w-xs">
                                <p class="text-[var(--admin-text-main)] line-clamp-2 italic text-[11px]">{{ $inq->message ?: 'No additional message provided.' }}</p>
                                @if($inq->admin_notes)
                                    <p class="text-[#D4AF37] text-[10px] mt-1 font-semibold">Note: {{ $inq->admin_notes }}</p>
                                @endif
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider
                                    @if($inq->status === 'new') bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/30
                                    @elseif($inq->status === 'in_progress') bg-amber-500/10 text-amber-600 dark:text-amber-400 border border-amber-500/30
                                    @elseif($inq->status === 'quoted') bg-blue-500/10 text-blue-600 dark:text-blue-400 border border-blue-500/30
                                    @elseif($inq->status === 'booked') bg-purple-500/10 text-purple-600 dark:text-purple-400 border border-purple-500/30
                                    @else admin-subtle text-[var(--admin-text-muted)] border @endif">
                                    {{ str_replace('_', ' ', $inq->status) }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <form action="{{ route('admin.inquiries.status', $inq->id) }}" method="POST" class="inline-flex items-center gap-1">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()" class="admin-input px-2.5 py-1.5 rounded-xl border text-xs font-bold focus:border-[#D4AF37] cursor-pointer">
                                        <option value="new" {{ $inq->status === 'new' ? 'selected' : '' }}>New</option>
                                        <option value="in_progress" {{ $inq->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="quoted" {{ $inq->status === 'quoted' ? 'selected' : '' }}>Quoted</option>
                                        <option value="booked" {{ $inq->status === 'booked' ? 'selected' : '' }}>Booked</option>
                                        <option value="cancelled" {{ $inq->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-[var(--admin-text-muted)] text-xs">No tour inquiries match your search.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($inquiries->hasPages())
            <div class="p-4 border-t admin-table-divider admin-table-head">
                {{ $inquiries->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
