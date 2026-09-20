@extends('layouts.admin')

@section('title', "Dossier {$application->reference_number}")
@section('page_title', "Consular Dossier: {$application->reference_number}")

@section('content')
<div class="space-y-6">
    <!-- Top Action Bar & Navigation -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <a href="{{ route('admin.visa.applications') }}" class="text-xs font-bold text-[var(--admin-text-muted)] hover:text-[#D4AF37] flex items-center gap-1.5 transition">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Back to Applications Queue</span>
        </a>

        <div class="flex items-center gap-3">
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $application->phone) }}?text=Hello%20{{ urlencode($application->full_name) }},%20this%20is%20Emisha%20Tours%20&%20Travels%20regarding%20your%20visa%20dossier%20{{ urlencode($application->reference_number) }}." 
               target="_blank" 
               class="px-4 py-2 bg-emerald-600 hover:bg-emerald-500 text-white font-bold rounded-xl text-xs transition flex items-center gap-2 shadow-lg shadow-emerald-600/20">
                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                </svg>
                <span>WhatsApp Applicant</span>
            </a>
        </div>
    </div>

    <!-- Main Dossier Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Left 8-Cols: Dossier Intelligence & Encrypted Documents -->
        <div class="lg:col-span-8 space-y-6">

            <!-- Destination & Route Header Banner -->
            <div class="admin-card rounded-3xl p-6 border shadow-xl flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <span class="text-4xl drop-shadow">{{ $application->country->flag ?? '🌐' }}</span>
                    <div>
                        <span class="text-[10px] font-extrabold uppercase tracking-widest text-[#D4AF37] block">Selected Destination & Route</span>
                        <h3 class="text-xl font-extrabold text-[var(--admin-text-main)] tracking-tight">{{ $application->country->country_name ?? 'N/A' }} — Tourist Visa</h3>
                        <span class="text-xs text-[var(--admin-text-muted)]">Processing Mode: <strong class="text-[var(--admin-text-main)]">{{ strtoupper(str_replace('_', ' ', $application->workflow_type ?? 'evisa')) }}</strong></span>
                    </div>
                </div>
                <div class="sm:text-right border-t sm:border-t-0 pt-3 sm:pt-0 border-[var(--admin-card-border)]">
                    <span class="text-[10px] uppercase font-bold text-[var(--admin-text-muted)] block">Service Fee</span>
                    <span class="text-xl font-extrabold text-emerald-600 dark:text-emerald-400">৳ {{ number_format($application->total_service_fee ?: ($application->visaType->starting_fee ?? 0), 0) }} BDT</span>
                    <span class="text-[10px] block text-[var(--admin-text-muted)] uppercase font-semibold">Payment: {{ strtoupper($application->payment_status ?? 'pending') }}</span>
                </div>
            </div>

            <!-- 1. Applicant Personal Profile -->
            <div class="admin-card rounded-3xl p-6 border shadow-xl space-y-4">
                <h3 class="text-sm font-extrabold text-[var(--admin-text-main)] pb-3 border-b border-[var(--admin-card-border)] flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-[#D4AF37]"></span>
                        <span>1. Applicant Personal Profile</span>
                    </div>
                    <span class="text-xs text-[var(--admin-text-muted)] font-normal">Submitted {{ $application->submitted_at ? $application->submitted_at->diffForHumans() : '' }}</span>
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 text-xs">
                    <div class="p-3 admin-subtle rounded-2xl border">
                        <span class="text-[var(--admin-text-muted)] uppercase font-bold text-[10px] block mb-1">Full Legal Name</span>
                        <span class="text-sm font-extrabold text-[var(--admin-text-main)]">{{ $application->full_name }}</span>
                    </div>
                    <div class="p-3 admin-subtle rounded-2xl border">
                        <span class="text-[var(--admin-text-muted)] uppercase font-bold text-[10px] block mb-1">Email Address</span>
                        <a href="mailto:{{ $application->email }}" class="text-[#D4AF37] hover:underline font-semibold">{{ $application->email }}</a>
                    </div>
                    <div class="p-3 admin-subtle rounded-2xl border">
                        <span class="text-[var(--admin-text-muted)] uppercase font-bold text-[10px] block mb-1">Phone / WhatsApp</span>
                        <a href="tel:{{ $application->phone }}" class="text-[var(--admin-text-main)] hover:text-[#D4AF37] font-semibold font-mono">{{ $application->phone }}</a>
                    </div>
                    <div class="p-3 admin-subtle rounded-2xl border">
                        <span class="text-[var(--admin-text-muted)] uppercase font-bold text-[10px] block mb-1">Nationality & DOB</span>
                        <span class="text-[var(--admin-text-main)] font-medium">{{ $application->nationality }} • {{ $application->date_of_birth ? $application->date_of_birth->format('M d, Y') : 'N/A' }}</span>
                    </div>
                    <div class="p-3 admin-subtle rounded-2xl border">
                        <span class="text-[var(--admin-text-muted)] uppercase font-bold text-[10px] block mb-1">Gender & Status</span>
                        <span class="text-[var(--admin-text-main)] font-medium">{{ $application->applicant_profile['gender'] ?? 'N/A' }} • {{ $application->applicant_profile['marital_status'] ?? 'Single' }}</span>
                    </div>
                    <div class="p-3 admin-subtle rounded-2xl border">
                        <span class="text-[var(--admin-text-muted)] uppercase font-bold text-[10px] block mb-1">Current City / Residence</span>
                        <span class="text-[var(--admin-text-main)] font-medium">{{ $application->applicant_profile['current_city'] ?? 'Dhaka' }} ({{ $application->applicant_profile['residence_country'] ?? 'Bangladesh' }})</span>
                    </div>
                </div>
            </div>

            <!-- 2. Passport Identification -->
            <div class="admin-card rounded-3xl p-6 border shadow-xl space-y-4">
                <h3 class="text-sm font-extrabold text-[var(--admin-text-main)] pb-3 border-b border-[var(--admin-card-border)] flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-blue-400"></span>
                    <span>2. Passport Identification & Validity</span>
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 text-xs">
                    <div class="p-3 admin-subtle rounded-2xl border">
                        <span class="text-[var(--admin-text-muted)] uppercase font-bold text-[10px] block mb-1">Passport Number</span>
                        <span class="text-sm font-mono font-extrabold text-[#D4AF37]">{{ $application->passport_number ?: 'Not provided' }}</span>
                    </div>
                    <div class="p-3 admin-subtle rounded-2xl border">
                        <span class="text-[var(--admin-text-muted)] uppercase font-bold text-[10px] block mb-1">Passport Type</span>
                        <span class="text-[var(--admin-text-main)] font-medium">{{ $application->passport_details['passport_type'] ?? 'Ordinary' }}</span>
                    </div>
                    <div class="p-3 admin-subtle rounded-2xl border">
                        <span class="text-[var(--admin-text-muted)] uppercase font-bold text-[10px] block mb-1">Expiry Date</span>
                        <span class="font-bold {{ (!empty($application->passport_details['expiry_date']) && strtotime($application->passport_details['expiry_date']) < time()) ? 'text-rose-500' : 'text-[var(--admin-text-main)]' }}">
                            {{ $application->passport_details['expiry_date'] ?? 'N/A' }}
                        </span>
                    </div>
                    <div class="p-3 admin-subtle rounded-2xl border">
                        <span class="text-[var(--admin-text-muted)] uppercase font-bold text-[10px] block mb-1">Issuing Country & Place</span>
                        <span class="text-[var(--admin-text-main)] font-medium">{{ $application->passport_details['issuing_country'] ?? 'Bangladesh' }} ({{ $application->passport_details['place_of_birth'] ?? 'N/A' }})</span>
                    </div>
                </div>
            </div>

            <!-- 3. Travel Details & Itinerary -->
            <div class="admin-card rounded-3xl p-6 border shadow-xl space-y-4">
                <h3 class="text-sm font-extrabold text-[var(--admin-text-main)] pb-3 border-b border-[var(--admin-card-border)] flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    <span>3. Travel Purpose & Stay Duration</span>
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 text-xs">
                    <div class="p-3 admin-subtle rounded-2xl border">
                        <span class="text-[var(--admin-text-muted)] uppercase font-bold text-[10px] block mb-1">Travel Purpose</span>
                        <span class="text-[var(--admin-text-main)] font-semibold">{{ $application->travel_purpose }}</span>
                    </div>
                    <div class="p-3 admin-subtle rounded-2xl border">
                        <span class="text-[var(--admin-text-muted)] uppercase font-bold text-[10px] block mb-1">Departure Date</span>
                        <span class="text-[var(--admin-text-main)] font-semibold">{{ $application->travel_date ? $application->travel_date->format('M d, Y') : 'Flexible' }}</span>
                    </div>
                    <div class="p-3 admin-subtle rounded-2xl border">
                        <span class="text-[var(--admin-text-muted)] uppercase font-bold text-[10px] block mb-1">Expected Stay</span>
                        <span class="text-[var(--admin-text-main)] font-medium">{{ $application->stay_duration ?: 'N/A' }}</span>
                    </div>
                    <div class="p-3 admin-subtle rounded-2xl border">
                        <span class="text-[var(--admin-text-muted)] uppercase font-bold text-[10px] block mb-1">Cities / Route</span>
                        <span class="text-[var(--admin-text-main)] font-medium">{{ $application->travel_details['cities_to_visit'] ?? 'Standard Route' }}</span>
                    </div>
                </div>

                <!-- Schengen Specific Multi-Country Stay Breakdown -->
                @if(!empty($application->travel_details['schengen_countries']))
                    <div class="mt-3 p-4 bg-blue-500/10 border border-blue-500/30 rounded-2xl text-xs space-y-2">
                        <span class="font-bold text-blue-600 dark:text-blue-300 block">Schengen Member States Planned:</span>
                        <div class="flex flex-wrap gap-2">
                            @foreach($application->travel_details['schengen_countries'] as $sc)
                                <span class="px-3 py-1 admin-subtle border border-blue-500/30 rounded-xl text-[var(--admin-text-main)] font-medium">
                                    {{ $sc }} @if(!empty($application->travel_details['schengen_nights'][$sc])) ({{ $application->travel_details['schengen_nights'][$sc] }} nights) @endif
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- 4. Employment & Financial Profile -->
            <div class="admin-card rounded-3xl p-6 border shadow-xl space-y-4">
                <h3 class="text-sm font-extrabold text-[var(--admin-text-main)] pb-3 border-b border-[var(--admin-card-border)] flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-purple-400"></span>
                    <span>4. Employment & Financial Profile</span>
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 text-xs">
                    <div class="p-3 admin-subtle rounded-2xl border">
                        <span class="text-[var(--admin-text-muted)] uppercase font-bold text-[10px] block mb-1">Occupation</span>
                        <span class="text-[var(--admin-text-main)] font-bold">{{ ucwords(str_replace('_', ' ', $application->employment_details['employment_status'] ?? $application->profession->name ?? 'General')) }}</span>
                    </div>
                    <div class="p-3 admin-subtle rounded-2xl border">
                        <span class="text-[var(--admin-text-muted)] uppercase font-bold text-[10px] block mb-1">Employer / Business</span>
                        <span class="text-[var(--admin-text-main)] font-medium">{{ $application->employment_details['employer_name'] ?? $application->employment_details['business_name'] ?? $application->employment_details['institution_name'] ?? 'N/A' }}</span>
                    </div>
                    <div class="p-3 admin-subtle rounded-2xl border">
                        <span class="text-[var(--admin-text-muted)] uppercase font-bold text-[10px] block mb-1">Funding Source</span>
                        <span class="text-[var(--admin-text-main)] font-semibold">{{ $application->financial_details['funding_source'] ?? 'Self-funded' }}</span>
                    </div>
                    <div class="p-3 admin-subtle rounded-2xl border">
                        <span class="text-[var(--admin-text-muted)] uppercase font-bold text-[10px] block mb-1">Monthly Income</span>
                        <span class="text-[var(--admin-text-main)] font-medium">{{ $application->employment_details['monthly_income_bdt'] ?? $application->financial_details['monthly_income'] ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>

            <!-- 5. Confidential Supporting Documents & Cloud Dossier -->
            @php
                $gdriveLink = $application->applicant_profile['documents_drive_link'] ?? ($application->documents->where('document_type', 'gdrive_link')->first()->storage_path ?? null);
                $fileDocs = $application->documents->where('document_type', '!=', 'gdrive_link');
            @endphp
            <div class="admin-card rounded-3xl p-6 border shadow-xl space-y-4">
                <h3 class="text-sm font-extrabold text-[var(--admin-text-main)] pb-3 border-b border-[var(--admin-card-border)] flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-cyan-400"></span>
                        <span>Applicant Supporting Documents & Cloud Dossier</span>
                    </div>
                    <span class="text-[11px] text-emerald-600 dark:text-emerald-400 bg-emerald-500/10 border border-emerald-500/30 px-3 py-0.5 rounded-full font-bold inline-flex items-center gap-1.5">
                        <svg class="w-3 h-3 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        <span>Verified Dossier Storage</span>
                    </span>
                </h3>

                <!-- Google Drive Folder Link Banner if submitted -->
                @if($gdriveLink)
                    <div class="p-5 rounded-2xl bg-gradient-to-r from-amber-500/15 via-[#D4AF37]/10 to-transparent border-2 border-[#D4AF37]/60 space-y-3">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-[#0B1F3A] text-[#D4AF37] flex items-center justify-center flex-shrink-0 shadow-md">
                                    <svg class="w-5 h-5 text-[#D4AF37]" fill="currentColor" viewBox="0 0 24 24"><path d="M12.01 1.996L4.015 15.98h15.99L12.01 1.996zM4.015 15.98l4 6.994h15.99l-4-6.994H4.015zM12.01 1.996l4 6.994H.015l4-6.994h7.995z"/></svg>
                                </div>
                                <div>
                                    <span class="text-[10px] uppercase font-extrabold tracking-widest text-[#D4AF37] block">Google Drive Dossier Attached</span>
                                    <h4 class="text-sm font-extrabold text-[var(--admin-text-main)]">Applicant Cloud Folder Link</h4>
                                </div>
                            </div>

                            <div class="flex items-center gap-2">
                                <a 
                                    href="{{ $gdriveLink }}" 
                                    target="_blank" 
                                    rel="noopener noreferrer" 
                                    class="px-4 py-2 bg-gradient-to-r from-[#D4AF37] to-[#B38F26] text-[#050D1A] font-extrabold rounded-xl text-xs uppercase tracking-wider hover:brightness-110 shadow-md transition inline-flex items-center gap-1.5"
                                >
                                    <span>Open in Google Drive</span>
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                </a>
                            </div>
                        </div>

                        <div class="p-3 admin-subtle rounded-xl border border-[var(--admin-card-border)] text-xs flex items-center justify-between gap-2 overflow-hidden">
                            <span class="font-mono text-[var(--admin-text-main)] truncate select-all">{{ $gdriveLink }}</span>
                        </div>
                    </div>
                @endif

                <!-- Direct Uploaded Files List -->
                @if($fileDocs->count() > 0)
                    <div class="space-y-3">
                        <span class="text-xs font-bold text-[var(--admin-text-muted)] block uppercase tracking-wider">Direct File Uploads ({{ $fileDocs->count() }})</span>
                        @foreach($fileDocs as $doc)
                            <div class="p-4 rounded-2xl border admin-subtle flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                <div class="min-w-0 flex-grow">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="text-[11px] uppercase font-bold text-[#D4AF37]">
                                            {{ ucwords(str_replace('_', ' ', $doc->document_code ?: $doc->document_type)) }}
                                        </span>
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold border {{ $doc->review_badge_class }}">
                                            {{ strtoupper(str_replace('_', ' ', $doc->review_status)) }}
                                        </span>
                                    </div>
                                    <h4 class="font-bold text-xs text-[var(--admin-text-main)] truncate" title="{{ $doc->original_filename }}">
                                        {{ $doc->original_filename }}
                                    </h4>
                                    <span class="text-[11px] text-[var(--admin-text-muted)]">
                                        {{ round($doc->file_size / 1024) }} KB • {{ $doc->mime_type }}
                                    </span>
                                </div>

                                <div class="flex items-center gap-2 flex-shrink-0">
                                    <a 
                                        href="{{ route('admin.visa.applications.download', ['id' => $application->id, 'docId' => $doc->id]) }}" 
                                        class="px-3.5 py-1.5 bg-[#D4AF37] hover:bg-[#c49f2e] text-[#050D1A] font-extrabold rounded-xl text-xs transition inline-flex items-center gap-1.5 shadow-md"
                                    >
                                        <span>Download</span>
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                    </a>

                                    <!-- Document Review Action Form -->
                                    <form action="{{ route('admin.visa.applications.document.status', ['id' => $application->id, 'docId' => $doc->id]) }}" method="POST" class="flex items-center gap-1">
                                        @csrf
                                        @method('PATCH')
                                        <select name="review_status" onchange="this.form.submit()" class="px-2.5 py-1.5 admin-input border text-xs rounded-xl font-bold cursor-pointer focus:border-[#D4AF37]">
                                            <option value="uploaded" {{ $doc->review_status === 'uploaded' ? 'selected' : '' }}>Uploaded</option>
                                            <option value="approved" {{ $doc->review_status === 'approved' ? 'selected' : '' }}>Approve</option>
                                            <option value="needs_replacement" {{ $doc->review_status === 'needs_replacement' ? 'selected' : '' }}>Replace Req</option>
                                            <option value="rejected" {{ $doc->review_status === 'rejected' ? 'selected' : '' }}>Reject</option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @elseif(!$gdriveLink)
                    <div class="py-10 text-center text-[var(--admin-text-muted)] text-xs space-y-2">
                        <p>No files uploaded online or Google Drive link provided.</p>
                        <p class="text-slate-500">Applicant will provide physical copies or send via WhatsApp / Email.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Right 4-Cols: Status Workflow & Staff Operational Controls -->
        <div class="lg:col-span-4 space-y-6">
            <div class="admin-card rounded-3xl p-6 border shadow-xl space-y-4">
                <h3 class="text-base font-extrabold text-[var(--admin-text-main)] pb-3 border-b border-[var(--admin-card-border)]">
                    Workflow & Consular Status
                </h3>

                <form action="{{ route('admin.visa.applications.status', $application->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Current Status</label>
                        <select name="status" class="admin-input w-full px-3.5 py-2.5 rounded-xl border font-bold text-xs focus:outline-none focus:border-[#D4AF37]">
                            <option value="received" {{ $application->status === 'received' ? 'selected' : '' }}>Received (New)</option>
                            <option value="under_review" {{ $application->status === 'under_review' ? 'selected' : '' }}>Under Verification / Review</option>
                            <option value="documents_required" {{ $application->status === 'documents_required' ? 'selected' : '' }}>Additional Documents Required</option>
                            <option value="embassy_submitted" {{ $application->status === 'embassy_submitted' ? 'selected' : '' }}>Submitted to Embassy / VFS</option>
                            <option value="processing" {{ $application->status === 'processing' ? 'selected' : '' }}>Under Consular Processing</option>
                            <option value="approved" {{ $application->status === 'approved' ? 'selected' : '' }}>Visa Approved / Ready</option>
                            <option value="completed" {{ $application->status === 'completed' ? 'selected' : '' }}>Delivered / Completed</option>
                            <option value="rejected" {{ $application->status === 'rejected' ? 'selected' : '' }}>Visa Rejected / Denied</option>
                            <option value="cancelled" {{ $application->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Public Note for Customer (Shown on Live Tracker)</label>
                        <textarea name="applicant_notes" rows="3" placeholder="e.g. VFS appointment booked for 12 Nov. Please bring original passport to our office."
                            class="admin-input w-full px-3.5 py-2.5 rounded-xl border text-xs focus:outline-none focus:border-[#D4AF37]">{{ old('applicant_notes', $application->applicant_notes) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--admin-text-muted)] mb-1.5">Internal Operations Notes (Staff Only)</label>
                        <textarea name="admin_notes" rows="3" placeholder="e.g. Bank statement verified. File checked by Senior Consultant."
                            class="admin-input w-full px-3.5 py-2.5 rounded-xl border text-xs focus:outline-none focus:border-[#D4AF37]">{{ old('admin_notes', $application->admin_notes) }}</textarea>
                    </div>

                    <button type="submit" class="w-full py-3 bg-gradient-to-r from-[#D4AF37] to-[#B38F26] text-[#050D1A] font-extrabold rounded-xl text-xs uppercase tracking-wider hover:brightness-110 shadow-lg shadow-[#D4AF37]/20 transition">
                        Update Application Dossier
                    </button>
                </form>
            </div>

            <!-- Audit Trail & Meta Card -->
            <div class="admin-card rounded-3xl p-6 border shadow-xl space-y-3 text-xs">
                <h4 class="font-bold text-[#D4AF37] uppercase text-[10px] tracking-wider">Audit Metadata</h4>
                <div class="flex justify-between text-[var(--admin-text-muted)]">
                    <span>Reference ID:</span>
                    <span class="font-mono font-bold text-[var(--admin-text-main)]">{{ $application->reference_number }}</span>
                </div>
                <div class="flex justify-between text-[var(--admin-text-muted)]">
                    <span>Submission Date:</span>
                    <span class="font-semibold text-[var(--admin-text-main)]">{{ $application->submitted_at ? $application->submitted_at->format('M d, Y h:i A') : 'N/A' }}</span>
                </div>
                <div class="flex justify-between text-[var(--admin-text-muted)]">
                    <span>Last Updated:</span>
                    <span class="font-semibold text-[var(--admin-text-main)]">{{ $application->updated_at->format('M d, Y h:i A') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
