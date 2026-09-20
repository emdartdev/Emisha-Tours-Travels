@extends('layouts.admin')

@section('title', 'Air Ticketing Requests Desk')
@section('page_title', 'Air Ticketing Requests & Quotes Desk')

@section('content')
<div class="space-y-6">
    <!-- Filter & Search Bar -->
    <div class="admin-card rounded-3xl p-6 border shadow-xl">
        <form action="{{ route('admin.ticket-requests') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div>
                <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Search Requests</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-[var(--admin-text-muted)]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}" 
                        placeholder="Ref #, Name, Origin, Destination, Phone..."
                        class="admin-input w-full pl-10 pr-4 py-2.5 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-xs transition"
                    >
                </div>
            </div>

            <div>
                <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Trip Type</label>
                <select name="trip_type" class="admin-input w-full px-3.5 py-2.5 rounded-xl border focus:outline-none focus:border-[#D4AF37] text-xs transition">
                    <option value="">All Trip Types</option>
                    <option value="round_trip" {{ request('trip_type') == 'round_trip' ? 'selected' : '' }}>Round Trip</option>
                    <option value="one_way" {{ request('trip_type') == 'one_way' ? 'selected' : '' }}>One Way</option>
                    <option value="multi_city" {{ request('trip_type') == 'multi_city' ? 'selected' : '' }}>Multi City</option>
                </select>
            </div>

            <div class="flex items-end gap-2">
                <button type="submit" class="flex-1 py-2.5 bg-gradient-to-r from-[#D4AF37] to-[#B38F26] text-[#050D1A] font-extrabold rounded-xl text-xs uppercase tracking-wider hover:brightness-110 shadow-lg shadow-[#D4AF37]/20 transition flex items-center justify-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                    <span>Filter</span>
                </button>
                <a href="{{ route('admin.ticket-requests') }}" class="px-4 py-2.5 admin-subtle text-[var(--admin-text-muted)] hover:text-[var(--admin-text-main)] font-bold rounded-xl text-xs uppercase tracking-wider transition border">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Requests Table -->
    <div class="admin-card rounded-3xl border shadow-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="admin-table-head border-b text-[var(--admin-text-muted)] uppercase font-bold text-[10px]">
                    <tr>
                        <th class="py-4 px-6">Ref ID</th>
                        <th class="py-4 px-6">Passenger Details</th>
                        <th class="py-4 px-6">Flight Route</th>
                        <th class="py-4 px-6">Dates & Cabin</th>
                        <th class="py-4 px-6">Pax Count</th>
                        <th class="py-4 px-6">Quote Status</th>
                        <th class="py-4 px-6 text-right">Update Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y admin-table-divider">
                    @forelse($tickets as $tkt)
                        <tr class="admin-table-row transition">
                            <td class="py-4 px-6 font-mono font-extrabold text-[#D4AF37] text-sm">
                                {{ $tkt->reference_number }}
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-bold text-[var(--admin-text-main)] block text-sm">{{ $tkt->full_name }}</span>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="text-[var(--admin-text-muted)] font-mono text-[11px]">{{ $tkt->phone }}</span>
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $tkt->phone) }}?text=Hello%20{{ urlencode($tkt->full_name) }},%20this%20is%20Emisha%20Aviation%20Desk%20regarding%20your%20ticket%20request%20{{ urlencode($tkt->reference_number) }}." 
                                       target="_blank" 
                                       class="p-1 rounded bg-emerald-500/20 text-emerald-600 dark:text-emerald-400 hover:bg-emerald-500 hover:text-white transition" 
                                       title="WhatsApp Chat">
                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.664-.699c.971.53 1.771.78 2.796.78 3.182 0 5.768-2.587 5.768-5.766.001-3.187-2.575-5.766-5.768-5.766zm-1.077 7.748l-.348-.175c-.538-.27-1.127-.86-1.397-1.399l-.176-.348c-.08-.158-.029-.314.07-.413l.422-.423c.094-.094.094-.247 0-.341l-.846-.846c-.094-.094-.247-.094-.341 0l-.361.361c-.347.348-.445.856-.251 1.309.431 1.009 1.258 1.836 2.267 2.268.453.193.962.096 1.309-.251l.361-.361c.094-.094.094-.247 0-.341l-.846-.846c-.094-.094-.247-.094-.341 0l-.422.423c-.099.099-.255.15-.413.07z"/></svg>
                                    </a>
                                </div>
                                <span class="text-[var(--admin-text-muted)] text-[10px] block">{{ $tkt->email }}</span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="font-bold text-[var(--admin-text-main)] flex items-center gap-1.5 text-sm">
                                    <span>{{ $tkt->origin }}</span>
                                    <svg class="w-4 h-4 text-[#D4AF37]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                    <span>{{ $tkt->destination }}</span>
                                </div>
                                <span class="text-[var(--admin-text-muted)] uppercase text-[10px] tracking-wider">{{ str_replace('_', ' ', $tkt->trip_type) }}</span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-semibold text-[var(--admin-text-main)] block">Depart: {{ $tkt->departure_date ? date('M d, Y', strtotime($tkt->departure_date)) : 'N/A' }}</span>
                                @if($tkt->return_date)
                                    <span class="text-[var(--admin-text-muted)] block text-[11px]">Return: {{ date('M d, Y', strtotime($tkt->return_date)) }}</span>
                                @endif
                                <span class="text-[10px] text-[#D4AF37] uppercase font-bold">{{ $tkt->cabin_class }}</span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-semibold text-[var(--admin-text-main)] flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 text-[var(--admin-text-muted)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <span>{{ $tkt->adults }} Adults</span>
                                </span>
                                @if($tkt->children > 0 || $tkt->infants > 0)
                                    <span class="text-[var(--admin-text-muted)] text-[10px] block">{{ $tkt->children }} Child, {{ $tkt->infants }} Infant</span>
                                @endif
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider
                                    @if($tkt->status === 'pending') bg-amber-500/10 text-amber-600 dark:text-amber-400 border border-amber-500/30
                                    @elseif($tkt->status === 'quoted') bg-blue-500/10 text-blue-600 dark:text-blue-400 border border-blue-500/30
                                    @elseif($tkt->status === 'issued') bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/30
                                    @else admin-subtle text-[var(--admin-text-muted)] border @endif">
                                    {{ $tkt->status }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <form action="{{ route('admin.ticket-requests.status', $tkt->id) }}" method="POST" class="inline-flex items-center gap-1">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()" class="admin-input px-2.5 py-1.5 rounded-xl border text-xs font-bold focus:border-[#D4AF37] cursor-pointer">
                                        <option value="pending" {{ $tkt->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="quoted" {{ $tkt->status === 'quoted' ? 'selected' : '' }}>Quoted</option>
                                        <option value="issued" {{ $tkt->status === 'issued' ? 'selected' : '' }}>Ticket Issued</option>
                                        <option value="cancelled" {{ $tkt->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-[var(--admin-text-muted)] text-xs">No flight ticket requests found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($tickets->hasPages())
            <div class="p-4 border-t admin-table-divider admin-table-head">
                {{ $tickets->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
