@extends('layouts.admin')

@section('title', 'Executive Operations Command')
@section('page_title', 'Operations Command Dashboard')

@section('content')
<div class="space-y-8" x-data="{ leadTab: 'tours' }">
    
    <!-- Hero Operational Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- Card 1: Visa Applications -->
        <div class="relative overflow-hidden admin-card rounded-3xl p-6 border shadow-sm hover:shadow-md transition duration-300 group">
            <div class="flex items-center justify-between mb-4">
                <span class="text-[11px] font-extrabold uppercase tracking-wider text-[#D4AF37]">Visa Applications</span>
                <div class="w-11 h-11 rounded-2xl bg-amber-500/10 border border-amber-500/20 text-[#D4AF37] flex items-center justify-center group-hover:scale-110 transition duration-300">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                </div>
            </div>
            <div class="space-y-1">
                <div class="text-3xl font-extrabold tracking-tight flex items-baseline gap-2" style="color: var(--admin-text-heading);">
                    <span>{{ $stats['pending_visa_applications'] }}</span>
                    <span class="text-xs font-semibold text-amber-500">Action Required</span>
                </div>
                <div class="text-xs text-[var(--admin-text-muted)] flex items-center justify-between pt-2 border-t admin-table-divider">
                    <span>Total Submitted</span>
                    <span class="font-bold text-[var(--admin-text-main)]">{{ $stats['total_visa_applications'] }} Dossiers</span>
                </div>
            </div>
        </div>

        <!-- Card 2: Tour Inquiries -->
        <div class="relative overflow-hidden admin-card rounded-3xl p-6 border shadow-sm hover:shadow-md transition duration-300 group">
            <div class="flex items-center justify-between mb-4">
                <span class="text-[11px] font-extrabold uppercase tracking-wider text-emerald-600 dark:text-emerald-400">Tour Inquiries</span>
                <div class="w-11 h-11 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 flex items-center justify-center group-hover:scale-110 transition duration-300">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
            </div>
            <div class="space-y-1">
                <div class="text-3xl font-extrabold tracking-tight flex items-baseline gap-2" style="color: var(--admin-text-heading);">
                    <span>{{ $stats['pending_inquiries'] }}</span>
                    <span class="text-xs font-semibold text-emerald-600 dark:text-emerald-400">New Leads</span>
                </div>
                <div class="text-xs text-[var(--admin-text-muted)] flex items-center justify-between pt-2 border-t admin-table-divider">
                    <span>Total Inquiries</span>
                    <span class="font-bold text-[var(--admin-text-main)]">{{ $stats['total_inquiries'] }} Leads</span>
                </div>
            </div>
        </div>

        <!-- Card 3: Flight Requests -->
        <div class="relative overflow-hidden admin-card rounded-3xl p-6 border shadow-sm hover:shadow-md transition duration-300 group">
            <div class="flex items-center justify-between mb-4">
                <span class="text-[11px] font-extrabold uppercase tracking-wider text-cyan-600 dark:text-cyan-400">Aviation Desk</span>
                <div class="w-11 h-11 rounded-2xl bg-cyan-500/10 border border-cyan-500/20 text-cyan-600 dark:text-cyan-400 flex items-center justify-center group-hover:scale-110 transition duration-300">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" /></svg>
                </div>
            </div>
            <div class="space-y-1">
                <div class="text-3xl font-extrabold tracking-tight flex items-baseline gap-2" style="color: var(--admin-text-heading);">
                    <span>{{ $stats['pending_ticket_requests'] }}</span>
                    <span class="text-xs font-semibold text-cyan-600 dark:text-cyan-400">Quotes Pending</span>
                </div>
                <div class="text-xs text-[var(--admin-text-muted)] flex items-center justify-between pt-2 border-t admin-table-divider">
                    <span>Total Quoted</span>
                    <span class="font-bold text-[var(--admin-text-main)]">{{ $stats['total_ticket_requests'] }} Requests</span>
                </div>
            </div>
        </div>

        <!-- Card 4: Catalog & Destinations -->
        <div class="relative overflow-hidden admin-card rounded-3xl p-6 border shadow-sm hover:shadow-md transition duration-300 group">
            <div class="flex items-center justify-between mb-4">
                <span class="text-[11px] font-extrabold uppercase tracking-wider text-purple-600 dark:text-purple-400">Catalog Inventory</span>
                <div class="w-11 h-11 rounded-2xl bg-purple-500/10 border border-purple-500/20 text-purple-600 dark:text-purple-400 flex items-center justify-center group-hover:scale-110 transition duration-300">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                </div>
            </div>
            <div class="space-y-1">
                <div class="text-3xl font-extrabold tracking-tight flex items-baseline gap-2" style="color: var(--admin-text-heading);">
                    <span>{{ $stats['active_tours'] }}</span>
                    <span class="text-xs font-semibold text-purple-600 dark:text-purple-400">Active Packages</span>
                </div>
                <div class="text-xs text-[var(--admin-text-muted)] flex items-center justify-between pt-2 border-t admin-table-divider">
                    <span>Destinations</span>
                    <span class="font-bold text-[var(--admin-text-main)]">{{ $stats['total_destinations'] }} Worldwide</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Operational Launch Bar -->
    <div class="admin-card rounded-2xl p-4 border flex flex-wrap items-center justify-between gap-4 shadow-sm">
        <div class="flex items-center gap-2">
            <span class="text-xs font-bold text-[#D4AF37] uppercase tracking-wider">Fast Actions:</span>
            <span class="text-xs text-[var(--admin-text-muted)]">Jump directly into high-frequency management workflows</span>
        </div>
        <div class="flex flex-wrap items-center gap-2">
            <a href="{{ route('admin.visa.applications') }}" class="px-3.5 py-1.5 rounded-xl admin-subtle text-[var(--admin-text-main)] hover:border-[#D4AF37] text-xs font-semibold border transition flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <span>Visa Queue</span>
            </a>
            <a href="{{ route('admin.tours.create') }}" class="px-3.5 py-1.5 rounded-xl admin-subtle text-[var(--admin-text-main)] hover:border-emerald-500 text-xs font-semibold border transition flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>New Tour</span>
            </a>
            <a href="{{ route('admin.destinations.create') }}" class="px-3.5 py-1.5 rounded-xl admin-subtle text-[var(--admin-text-main)] hover:border-blue-500 text-xs font-semibold border transition flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                <span>Add Destination</span>
            </a>
            <a href="{{ route('admin.settings') }}" class="px-3.5 py-1.5 rounded-xl admin-subtle text-[var(--admin-text-main)] hover:border-purple-500 text-xs font-semibold border transition flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <span>Company Settings</span>
            </a>
        </div>
    </div>

    <!-- Operations Dual Panel -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Left Column: Recent Visa Dossiers (7 cols) -->
        <div class="lg:col-span-7 admin-card rounded-3xl border shadow-sm p-6 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between pb-4 mb-4 border-b admin-table-divider">
                    <div class="flex items-center gap-3">
                        <div class="p-2 rounded-xl bg-amber-500/10 text-[#D4AF37]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-base tracking-tight" style="color: var(--admin-text-heading);">Recent Visa Applications</h3>
                            <p class="text-xs text-[var(--admin-text-muted)]">Latest online applicant document submissions</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.visa.applications') }}" class="text-xs font-bold text-[#D4AF37] hover:underline flex items-center gap-1 group">
                        <span>View All Queue</span>
                        <svg class="w-3.5 h-3.5 group-hover:translate-x-0.5 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead>
                            <tr class="border-b admin-table-divider text-[var(--admin-text-muted)] uppercase font-bold text-[10px]">
                                <th class="py-3 px-2">Dossier Ref</th>
                                <th class="py-3 px-2">Applicant</th>
                                <th class="py-3 px-2">Destination</th>
                                <th class="py-3 px-2">Status</th>
                                <th class="py-3 px-2 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y admin-table-divider">
                            @forelse($recentVisaApplications as $app)
                                <tr class="admin-table-row transition">
                                    <td class="py-3.5 px-2">
                                        <a href="{{ route('admin.visa.applications.show', $app->id) }}" class="font-bold text-[#D4AF37] hover:underline font-mono text-xs">
                                            {{ $app->reference_number }}
                                        </a>
                                        <span class="text-[10px] text-[var(--admin-text-muted)] block">{{ $app->created_at ? $app->created_at->diffForHumans() : '' }}</span>
                                    </td>
                                    <td class="py-3.5 px-2">
                                        <span class="font-bold block text-[var(--admin-text-main)]">{{ $app->full_name }}</span>
                                        <span class="text-[11px] text-[var(--admin-text-muted)] font-mono">{{ $app->phone }}</span>
                                    </td>
                                    <td class="py-3.5 px-2">
                                        <div class="flex items-center gap-1.5">
                                            @if(!empty($app->country->flag))
                                                <span class="text-base">{{ $app->country->flag }}</span>
                                            @else
                                                <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            @endif
                                            <span class="font-medium text-[var(--admin-text-main)]">{{ $app->country->country_name ?? 'N/A' }}</span>
                                        </div>
                                        <span class="text-[10px] text-[var(--admin-text-muted)]">{{ $app->visaType->name ?? 'Standard' }}</span>
                                    </td>
                                    <td class="py-3.5 px-2">
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider
                                            @if($app->status === 'received') bg-blue-500/10 text-blue-600 dark:text-blue-400 border border-blue-500/30
                                            @elseif($app->status === 'under_review') bg-amber-500/10 text-amber-600 dark:text-amber-400 border border-amber-500/30
                                            @elseif($app->status === 'embassy_submitted') bg-purple-500/10 text-purple-600 dark:text-purple-400 border border-purple-500/30
                                            @elseif($app->status === 'approved') bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/30
                                            @elseif($app->status === 'rejected') bg-rose-500/10 text-rose-600 dark:text-rose-400 border border-rose-500/30
                                            @else bg-slate-500/10 text-slate-600 dark:text-slate-400 border border-slate-500/20 @endif">
                                            {{ str_replace('_', ' ', $app->status) }}
                                        </span>
                                    </td>
                                    <td class="py-3.5 px-2 text-right">
                                        <a href="{{ route('admin.visa.applications.show', $app->id) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-[#D4AF37]/10 hover:bg-[#D4AF37] text-[#D4AF37] hover:text-[#050D1A] font-bold text-xs transition duration-200">
                                            <span>Inspect</span>
                                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-12 text-center text-[var(--admin-text-muted)]">
                                        <div class="flex flex-col items-center justify-center gap-2">
                                            <svg class="w-8 h-8 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                            <span>No visa applications in queue yet.</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Right Column: Leads Stream & Inquiries (5 cols) -->
        <div class="lg:col-span-5 admin-card rounded-3xl border shadow-sm p-6 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between pb-4 mb-4 border-b admin-table-divider">
                    <div class="flex items-center gap-3">
                        <div class="p-2 rounded-xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-base tracking-tight" style="color: var(--admin-text-heading);">Tour Inquiries</h3>
                            <p class="text-xs text-[var(--admin-text-muted)]">Direct booking requests from travellers</p>
                        </div>
                    </div>
                </div>

                <!-- Tab switcher -->
                <div class="flex items-center p-1 admin-subtle rounded-xl border mb-4">
                    <button @click="leadTab = 'tours'" 
                            :class="leadTab === 'tours' ? 'bg-[#D4AF37] text-[#050D1A] font-bold shadow' : 'text-[var(--admin-text-muted)] hover:text-[var(--admin-text-main)]'"
                            class="flex-1 py-1.5 text-xs rounded-lg transition duration-200">
                        Tour Leads ({{ count($recentInquiries) }})
                    </button>
                    <button @click="leadTab = 'flights'" 
                            :class="leadTab === 'flights' ? 'bg-[#D4AF37] text-[#050D1A] font-bold shadow' : 'text-[var(--admin-text-muted)] hover:text-[var(--admin-text-main)]'"
                            class="flex-1 py-1.5 text-xs rounded-lg transition duration-200">
                        Flight Requests ({{ count($recentTicketRequests) }})
                    </button>
                </div>

                <!-- Tours Inquiries Tab Content -->
                <div x-show="leadTab === 'tours'" class="space-y-3">
                    @forelse($recentInquiries as $inq)
                        <div class="p-3.5 rounded-2xl border admin-subtle hover:border-[#D4AF37]/50 transition">
                            <div class="flex items-start justify-between gap-2">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <span class="font-bold text-xs text-[var(--admin-text-main)]">{{ $inq->full_name }}</span>
                                        <span class="text-[10px] text-[var(--admin-text-muted)] font-mono">{{ $inq->reference_number }}</span>
                                    </div>
                                    <p class="text-xs text-[#D4AF37] font-medium mt-0.5">
                                        {{ $inq->tour->title ?? 'Custom Holiday Request' }}
                                    </p>
                                    <div class="flex items-center gap-3 text-[11px] text-[var(--admin-text-muted)] mt-1.5">
                                        <span class="flex items-center gap-1 font-mono text-[var(--admin-text-main)]">
                                            <svg class="w-3 h-3 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                            {{ $inq->phone }}
                                        </span>
                                        <span>•</span>
                                        <span>{{ $inq->adults }} Adults</span>
                                    </div>
                                </div>
                                <div class="flex flex-col items-end gap-1.5">
                                    <span class="px-2 py-0.5 rounded-full text-[9px] font-bold uppercase
                                        @if($inq->status === 'new') bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/30
                                        @elseif($inq->status === 'in_progress') bg-amber-500/10 text-amber-600 dark:text-amber-400 border border-amber-500/30
                                        @else bg-slate-500/10 text-slate-600 dark:text-slate-400 @endif">
                                        {{ $inq->status }}
                                    </span>
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $inq->phone) }}?text=Hello%20{{ urlencode($inq->full_name) }},%20thank%20you%20for%20contacting%20Emisha%20Tours%20regarding%20{{ urlencode($inq->reference_number) }}." 
                                       target="_blank" 
                                       class="p-1 rounded-lg bg-emerald-600/10 hover:bg-emerald-600 text-emerald-600 dark:text-emerald-400 hover:text-white transition" 
                                       title="Chat on WhatsApp">
                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.664-.699c.971.53 1.771.78 2.796.78 3.182 0 5.768-2.587 5.768-5.766.001-3.187-2.575-5.766-5.768-5.766zm-1.077 7.748l-.348-.175c-.538-.27-1.127-.86-1.397-1.399l-.176-.348c-.08-.158-.029-.314.07-.413l.422-.423c.094-.094.094-.247 0-.341l-.846-.846c-.094-.094-.247-.094-.341 0l-.361.361c-.347.348-.445.856-.251 1.309.431 1.009 1.258 1.836 2.267 2.268.453.193.962.096 1.309-.251l.361-.361c.094-.094.094-.247 0-.341l-.846-.846c-.094-.094-.247-.094-.341 0l-.422.423c-.099.099-.255.15-.413.07z"/></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="py-8 text-center text-[var(--admin-text-muted)] text-xs">No tour inquiries recorded.</div>
                    @endforelse
                </div>

                <!-- Flight Requests Tab Content -->
                <div x-show="leadTab === 'flights'" class="space-y-3" x-cloak>
                    @forelse($recentTicketRequests as $tkt)
                        <div class="p-3.5 rounded-2xl border admin-subtle hover:border-[#D4AF37]/50 transition">
                            <div class="flex items-start justify-between gap-2">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <span class="font-bold text-xs text-[var(--admin-text-main)]">{{ $tkt->full_name }}</span>
                                        <span class="text-[10px] text-[var(--admin-text-muted)] font-mono">{{ $tkt->reference_number }}</span>
                                    </div>
                                    <div class="flex items-center gap-1.5 text-xs font-semibold text-cyan-600 dark:text-cyan-400 mt-0.5">
                                        <span>{{ $tkt->origin }}</span>
                                        <svg class="w-3 h-3 text-[#D4AF37]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                        <span>{{ $tkt->destination }}</span>
                                    </div>
                                    <div class="flex items-center gap-3 text-[11px] text-[var(--admin-text-muted)] mt-1.5">
                                        <span class="font-mono text-[var(--admin-text-main)]">{{ $tkt->phone }}</span>
                                        <span>•</span>
                                        <span class="uppercase font-semibold text-[10px]">{{ $tkt->cabin_class }}</span>
                                    </div>
                                </div>
                                <div class="flex flex-col items-end gap-1.5">
                                    <span class="px-2 py-0.5 rounded-full text-[9px] font-bold uppercase
                                        @if($tkt->status === 'pending') bg-amber-500/10 text-amber-600 dark:text-amber-400 border border-amber-500/30
                                        @elseif($tkt->status === 'quoted') bg-blue-500/10 text-blue-600 dark:text-blue-400 border border-blue-500/30
                                        @else bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/30 @endif">
                                        {{ $tkt->status }}
                                    </span>
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $tkt->phone) }}?text=Hello%20{{ urlencode($tkt->full_name) }},%20this%20is%20Emisha%20Aviation%20Desk%20regarding%20your%20flight%20request%20{{ urlencode($tkt->reference_number) }}." 
                                       target="_blank" 
                                       class="p-1 rounded-lg bg-emerald-600/10 hover:bg-emerald-600 text-emerald-600 dark:text-emerald-400 hover:text-white transition" 
                                       title="Chat on WhatsApp">
                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.664-.699c.971.53 1.771.78 2.796.78 3.182 0 5.768-2.587 5.768-5.766.001-3.187-2.575-5.766-5.768-5.766zm-1.077 7.748l-.348-.175c-.538-.27-1.127-.86-1.397-1.399l-.176-.348c-.08-.158-.029-.314.07-.413l.422-.423c.094-.094.094-.247 0-.341l-.846-.846c-.094-.094-.247-.094-.341 0l-.361.361c-.347.348-.445.856-.251 1.309.431 1.009 1.258 1.836 2.267 2.268.453.193.962.096 1.309-.251l.361-.361c.094-.094.094-.247 0-.341l-.846-.846c-.094-.094-.247-.094-.341 0l-.422.423c-.099.099-.255.15-.413.07z"/></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="py-8 text-center text-[var(--admin-text-muted)] text-xs">No air ticket requests recorded.</div>
                    @endforelse
                </div>
            </div>
            
            <div class="pt-4 mt-4 border-t admin-table-divider flex items-center justify-between">
                <a href="{{ route('admin.inquiries') }}" class="text-xs font-bold text-[var(--admin-text-muted)] hover:text-[#D4AF37] transition">
                    View All Inquiries Desk ➔
                </a>
                <a href="{{ route('admin.ticket-requests') }}" class="text-xs font-bold text-[var(--admin-text-muted)] hover:text-cyan-500 transition">
                    Air Ticket Queue ➔
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
