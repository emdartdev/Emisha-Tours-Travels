@extends('layouts.app')

@section('title', $application ? "Tracking {$application->reference_number} — Visa Flight Radar Status" : "Live Visa Status Radar & Tracking — Emisha Tours & Travels")
@section('meta_description', 'Track your visa application with real-time flight radar tracking, embassy milestone timeline, consular processing updates, and instant WhatsApp support.')
@section('robots', 'noindex, nofollow')

@section('content')
<style>
    /* Aviation Radar & Flight Track Animations */
    @keyframes radarSweep {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    @keyframes radarPulse {
        0% { transform: scale(0.8); opacity: 0.9; }
        50% { transform: scale(1.6); opacity: 0.3; }
        100% { transform: scale(2.2); opacity: 0; }
    }
    @keyframes airplaneFloat {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-5px) rotate(1deg); }
    }
    @keyframes flightDash {
        to { stroke-dashoffset: -40; }
    }
    @keyframes beaconGlow {
        0%, 100% { box-shadow: 0 0 10px rgba(212, 175, 55, 0.4), inset 0 0 5px rgba(212, 175, 55, 0.4); }
        50% { box-shadow: 0 0 25px rgba(212, 175, 55, 0.85), inset 0 0 10px rgba(212, 175, 55, 0.8); }
    }
    .animate-radar-sweep {
        animation: radarSweep 4s linear infinite;
    }
    .animate-radar-pulse {
        animation: radarPulse 2s cubic-bezier(0, 0.2, 0.8, 1) infinite;
    }
    .animate-airplane-float {
        animation: airplaneFloat 3.5s ease-in-out infinite;
    }
    .flight-path-line {
        stroke-dasharray: 6, 6;
        animation: flightDash 1.8s linear infinite;
    }
    .radar-beacon {
        animation: beaconGlow 2s ease-in-out infinite;
    }
    
    /* Perforated Boarding Pass Styling */
    .boarding-pass-cutout-left, .boarding-pass-cutout-right {
        position: absolute;
        top: 50%;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background-color: #F8FAFC;
        transform: translateY(-50%);
        z-index: 10;
    }
    .boarding-pass-cutout-left { left: -12px; }
    .boarding-pass-cutout-right { right: -12px; }
    
    @media print {
        header, footer, .no-print, .btn, form { display: none !important; }
        .boarding-pass-container { box-shadow: none !important; border: 1px solid #ccc !important; }
    }
</style>

<!-- Hero Flight Control Center Header -->
<div class="bg-[#071527] text-white pt-10 pb-16 lg:pt-14 lg:pb-20 relative overflow-hidden">
    <!-- Ambient Radar Grid Overlay -->
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#D4AF37_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none"></div>
    <div class="absolute top-0 right-0 -mr-24 -mt-24 w-96 h-96 rounded-full bg-blue-500/10 blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 -ml-24 -mb-24 w-96 h-96 rounded-full bg-[#D4AF37]/10 blur-3xl pointer-events-none"></div>

    <div class="container-custom relative z-10">
        <!-- Breadcrumb / Control Badge -->
        <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
            <div class="text-xs font-bold text-[#D4AF37] uppercase tracking-wider flex items-center gap-2">
                <a href="{{ route('home') }}" class="hover:underline text-white/70">Home</a>
                <span class="text-white/40">/</span>
                <a href="{{ route('visa.index') }}" class="hover:underline text-white/70">Visa Services</a>
                <span class="text-white/40">/</span>
                <span class="text-[#D4AF37]">Flight Radar Tracker</span>
            </div>

            <!-- Live Telemetry Status Pill -->
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-800/80 border border-slate-700/80 text-[11px] font-mono text-slate-300 backdrop-blur-md">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                </span>
                <span>EMISHA RADAR // LIVE TELEMETRY</span>
            </div>
        </div>

        <div class="max-w-3xl">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-[#D4AF37] to-amber-200 flex items-center justify-center text-[#071527] shadow-lg shadow-[#D4AF37]/20">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                </div>
                <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-white tracking-tight">
                    Visa Flight Radar & Status Deck
                </h1>
            </div>
            <p class="text-xs sm:text-sm text-slate-300 leading-relaxed max-w-2xl mt-2">
                Track your visa dossier along the flight corridor from Dhaka origin through document audit, consular submission, and official visa issuance.
            </p>
        </div>

        <!-- Search Bar Container -->
        <div class="mt-8 max-w-3xl bg-slate-900/90 backdrop-blur-xl p-3 sm:p-4 rounded-2xl sm:rounded-3xl border border-slate-700/70 shadow-2xl shadow-black/50">
            <form action="{{ route('visa.track') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                <div class="relative flex-grow">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-5 h-5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input 
                        type="text" 
                        name="reference" 
                        value="{{ $refNumber ?? old('reference', '') }}" 
                        placeholder="ENTER REFERENCE ID (e.g. VISA-2026-104928)" 
                        required
                        class="w-full pl-12 pr-4 py-3.5 rounded-xl bg-slate-800/90 border border-slate-600 focus:border-[#D4AF37] focus:ring-2 focus:ring-[#D4AF37]/20 text-white placeholder-slate-400 text-xs sm:text-sm uppercase font-mono tracking-wider transition-all outline-none"
                    >
                </div>
                <button type="submit" class="px-7 py-3.5 rounded-xl bg-gradient-to-r from-[#D4AF37] to-amber-500 hover:from-amber-400 hover:to-amber-600 text-[#071527] font-bold text-xs sm:text-sm flex items-center justify-center gap-2 shadow-lg shadow-[#D4AF37]/20 transition-all transform active:scale-95 flex-shrink-0 cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    <span>Radar Scan</span>
                </button>
            </form>

            @if(isset($errorMessage))
                <div class="mt-3 p-3.5 rounded-xl bg-rose-500/10 border border-rose-500/30 text-xs text-rose-300 flex items-center gap-2.5">
                    <svg class="w-4 h-4 text-rose-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>{{ $errorMessage }}</span>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Main Tracking Dashboard -->
<section class="section-padding bg-[#F8FAFC] min-h-[60vh]">
    <div class="container-custom max-w-5xl">

        @if($application)
            @php
                $workflow = $application->workflow_type ?? 'evisa';
                $status = $application->status;
                $destCountry = $application->country->country_name ?? 'Destination';
                $destFlag = $application->country->flag ?? '🌐';
                $countryCode = strtoupper(substr(preg_replace('/[^A-Za-z]/', '', $destCountry), 0, 3)) ?: 'DST';

                // Map Milestones based on workflow
                if ($workflow === 'evisa') {
                    $milestones = [
                        [
                            'id' => 'received',
                            'stage' => 'STAGE 01 // ORIGIN',
                            'title' => 'Application Received',
                            'desc' => 'Dossier initialized at Dhaka Visa Operations Desk.',
                            'eta' => 'Day 1',
                            'airport' => 'DAC (Dhaka)',
                        ],
                        [
                            'id' => 'under_review',
                            'stage' => 'STAGE 02 // AUDIT',
                            'title' => 'Documents Verified',
                            'desc' => 'Specialist verified passport, photographs & financial proofs.',
                            'eta' => 'Day 1-2',
                            'airport' => 'VERIFIED',
                        ],
                        [
                            'id' => 'submitted',
                            'stage' => 'STAGE 03 // AIRWAY',
                            'title' => 'Immigration Submission',
                            'desc' => 'Official electronic application transmitted to Immigration portal.',
                            'eta' => 'Day 2-3',
                            'airport' => 'GATEWAY',
                        ],
                        [
                            'id' => 'processing',
                            'stage' => 'STAGE 04 // RADAR',
                            'title' => 'Security & Border Clearance',
                            'desc' => 'Immigration authority reviewing security clearance & eligibility.',
                            'eta' => 'Day 3-5',
                            'airport' => 'CLEARING',
                        ],
                        [
                            'id' => 'approved',
                            'stage' => 'STAGE 05 // ARRIVAL',
                            'title' => 'E-Visa Approved & Ready',
                            'desc' => 'Electronic visa grant issued and ready for passenger travel.',
                            'eta' => 'Complete',
                            'airport' => "{$countryCode} ({$destCountry})",
                        ],
                    ];
                } else {
                    $milestones = [
                        [
                            'id' => 'received',
                            'stage' => 'STAGE 01 // ORIGIN',
                            'title' => 'Application Received',
                            'desc' => 'Dossier created and initial profile audit started.',
                            'eta' => 'Day 1',
                            'airport' => 'DAC (Dhaka)',
                        ],
                        [
                            'id' => 'under_review',
                            'stage' => 'STAGE 02 // AUDIT',
                            'title' => 'File Prepared & Audited',
                            'desc' => 'Official consular forms generated & financial proofs structured.',
                            'eta' => 'Day 2-3',
                            'airport' => 'AUDITED',
                        ],
                        [
                            'id' => 'embassy_submitted',
                            'stage' => 'STAGE 03 // EMBASSY',
                            'title' => 'Embassy / VFS Slot Booked',
                            'desc' => 'Biometric appointment and consular submission schedule confirmed.',
                            'eta' => 'Day 3-7',
                            'airport' => 'VFS / EMBASSY',
                        ],
                        [
                            'id' => 'processing',
                            'stage' => 'STAGE 04 // CONSULAR',
                            'title' => 'Consular Visa Processing',
                            'desc' => 'Passport and original dossier under review at consular office.',
                            'eta' => 'Day 7-15',
                            'airport' => 'IN-REVIEW',
                        ],
                        [
                            'id' => 'approved',
                            'stage' => 'STAGE 05 // ARRIVAL',
                            'title' => 'Decision Received / Passport Ready',
                            'desc' => 'Visa endorsed and passport ready for handover / collection.',
                            'eta' => 'Complete',
                            'airport' => "{$countryCode} ({$destCountry})",
                        ],
                    ];
                }

                $statusMap = [
                    'draft' => 0,
                    'received' => 0,
                    'under_review' => 1,
                    'documents_required' => 1,
                    'embassy_submitted' => 2,
                    'submitted' => 2,
                    'processing' => 3,
                    'approved' => 4,
                    'completed' => 4,
                    'rejected' => 3,
                    'cancelled' => 0,
                ];
                $currentIndex = $statusMap[$status] ?? 0;
                
                // Flight Progress Percentages: 10%, 30%, 55%, 80%, 100%
                $progressPercents = [15, 38, 62, 85, 100];
                $flightProgress = $progressPercents[$currentIndex] ?? 15;
            @endphp

            <!-- 1. LIVE FLIGHT RADAR ROUTE VISUALIZATION CARD -->
            <div class="bg-gradient-to-b from-[#0B1F3A] to-[#071527] text-white rounded-[28px] sm:rounded-[36px] p-5 sm:p-8 md:p-10 border border-slate-700/60 shadow-2xl shadow-blue-950/30 mb-8 relative overflow-hidden">
                <!-- Background Radar Compass / Sweep Effect -->
                <div class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-1/3 w-80 sm:w-96 h-80 sm:h-96 rounded-full border border-blue-500/10 pointer-events-none flex items-center justify-center">
                    <div class="w-60 h-60 rounded-full border border-blue-500/15 flex items-center justify-center">
                        <div class="w-36 h-36 rounded-full border border-[#D4AF37]/20"></div>
                    </div>
                    <div class="absolute inset-0 rounded-full border-t border-[#D4AF37]/40 animate-radar-sweep pointer-events-none"></div>
                </div>

                <!-- Card Top Info Header -->
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-6 border-b border-slate-700/80 relative z-10">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-2xl bg-white/10 backdrop-blur-md border border-white/15 flex items-center justify-center text-2xl shadow-inner">
                            {{ $destFlag }}
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="text-[10px] sm:text-xs font-mono font-bold uppercase tracking-wider text-[#D4AF37]">
                                    FLIGHT CORRIDOR // {{ $workflow === 'evisa' ? 'ELECTRONIC VISA' : 'CONSULAR VISA' }}
                                </span>
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-ping"></span>
                            </div>
                            <h2 class="text-xl sm:text-2xl md:text-3xl font-extrabold text-white font-heading flex items-center gap-2">
                                <span>DAC</span>
                                <svg class="w-5 h-5 text-[#D4AF37] inline-block" fill="currentColor" viewBox="0 0 24 24"><path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"/></svg>
                                <span>{{ $destCountry }} ({{ $countryCode }})</span>
                            </h2>
                        </div>
                    </div>

                    <div class="flex flex-wrap items-center gap-2">
                        <div class="px-3.5 py-1.5 rounded-full text-xs font-bold font-mono border backdrop-blur-md {{ $application->status_badge_class }}">
                            ● {{ $application->formatted_status }}
                        </div>
                        <button 
                            type="button" 
                            onclick="navigator.clipboard.writeText('{{ $application->reference_number }}').then(() => alert('Reference ID Copied: {{ $application->reference_number }}'))"
                            class="px-3 py-1.5 rounded-full bg-slate-800 hover:bg-slate-700 border border-slate-600 text-xs font-mono text-slate-300 flex items-center gap-1.5 transition-all cursor-pointer"
                            title="Click to copy Reference Number"
                        >
                            <span>{{ $application->reference_number }}</span>
                            <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/></svg>
                        </button>
                    </div>
                </div>

                <!-- Animated Flight Radar Route Graphic -->
                <div class="py-8 sm:py-12 relative z-10">
                    <!-- Origin and Destination Badges on Track -->
                    <div class="flex items-center justify-between text-xs sm:text-sm font-mono mb-4 text-slate-300">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-emerald-500 shadow-lg shadow-emerald-500/50"></span>
                            <div>
                                <strong class="text-white block font-sans text-sm sm:text-base">Dhaka, Bangladesh 🇧🇩</strong>
                                <span class="text-[11px] text-slate-400">Origin Hub (DAC)</span>
                            </div>
                        </div>
                        <div class="text-right flex items-center gap-2 flex-row-reverse">
                            <span class="w-3 h-3 rounded-full {{ $currentIndex === 4 ? 'bg-emerald-500 shadow-emerald-500/50' : 'bg-amber-400 shadow-amber-400/50' }} shadow-lg"></span>
                            <div>
                                <strong class="text-white block font-sans text-sm sm:text-base">{{ $destCountry }} {{ $destFlag }}</strong>
                                <span class="text-[11px] text-slate-400">Destination Hub ({{ $countryCode }})</span>
                            </div>
                        </div>
                    </div>

                    <!-- Radar Flight Track Bar with Animated Airplane -->
                    <div class="relative py-6">
                        <!-- Background Line -->
                        <div class="w-full h-2 rounded-full bg-slate-800 border border-slate-700 relative overflow-hidden">
                            <!-- Progress Fill -->
                            <div 
                                class="h-full bg-gradient-to-r from-emerald-500 via-[#D4AF37] to-amber-400 rounded-full transition-all duration-1000 ease-out"
                                style="width: {{ $flightProgress }}%;"
                            ></div>
                        </div>

                        <!-- Animated Flight Path SVG Dashes -->
                        <svg class="absolute top-1/2 -translate-y-1/2 left-0 w-full h-10 pointer-events-none overflow-visible">
                            <line 
                                x1="0" y1="20" x2="100%" y2="20" 
                                stroke="rgba(212, 175, 55, 0.4)" 
                                stroke-width="2" 
                                class="flight-path-line"
                            />
                        </svg>

                        <!-- Moving Airplane Indicator -->
                        <div 
                            class="absolute top-1/2 -translate-y-1/2 transition-all duration-1000 ease-out -ml-4 sm:-ml-5"
                            style="left: {{ $flightProgress }}%;"
                        >
                            <div class="relative animate-airplane-float">
                                <!-- Glowing Radar Ring -->
                                <div class="absolute -inset-3 bg-[#D4AF37] rounded-full animate-radar-pulse opacity-75"></div>
                                <div class="absolute -inset-1 bg-amber-400 rounded-full blur-sm opacity-60"></div>
                                
                                <!-- Airplane Jet Badge -->
                                <div class="relative w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-gradient-to-br from-[#D4AF37] to-amber-500 text-[#071527] flex items-center justify-center shadow-2xl border-2 border-white ring-4 ring-[#D4AF37]/30">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 transform rotate-45 fill-current" viewBox="0 0 24 24">
                                        <path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"/>
                                    </svg>
                                </div>

                                <!-- Current Radar Position Tooltip -->
                                <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 whitespace-nowrap bg-slate-900/95 border border-[#D4AF37]/60 px-2.5 py-1 rounded-lg text-[10px] font-mono text-[#D4AF37] shadow-xl pointer-events-none">
                                    <span>FLIGHT POS: {{ $flightProgress }}%</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 5-Waypoints Quick Grid -->
                    <div class="grid grid-cols-5 gap-1 sm:gap-2 pt-2 text-center">
                        @foreach($milestones as $idx => $m)
                            @php
                                $isCompleted = $idx < $currentIndex || ($idx === $currentIndex && $status === 'approved');
                                $isCurrent = $idx === $currentIndex && $status !== 'approved';
                            @endphp
                            <div class="flex flex-col items-center">
                                <div class="w-6 h-6 sm:w-8 sm:h-8 rounded-full flex items-center justify-center text-[10px] sm:text-xs font-bold mb-1.5 transition-all {{ $isCompleted ? 'bg-emerald-500 text-white shadow-md shadow-emerald-500/30' : ($isCurrent ? 'bg-[#D4AF37] text-[#071527] ring-4 ring-[#D4AF37]/30 radar-beacon' : 'bg-slate-800 text-slate-500 border border-slate-700') }}">
                                    @if($isCompleted)
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                    @else
                                        <span>{{ $idx + 1 }}</span>
                                    @endif
                                </div>
                                <span class="text-[9px] sm:text-[11px] font-mono {{ $isCurrent ? 'text-[#D4AF37] font-bold' : ($isCompleted ? 'text-slate-300' : 'text-slate-500') }} hidden sm:block">
                                    {{ $m['airport'] }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Live Telemetry Data Ribbon -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 pt-6 border-t border-slate-700/80 text-xs font-mono relative z-10">
                    <div class="p-3 rounded-xl bg-slate-800/60 border border-slate-700/60">
                        <span class="text-slate-400 block text-[10px] uppercase">Telemetry Speed</span>
                        <strong class="text-white text-xs sm:text-sm font-sans">Active Live Sync</strong>
                    </div>
                    <div class="p-3 rounded-xl bg-slate-800/60 border border-slate-700/60">
                        <span class="text-slate-400 block text-[10px] uppercase">Current Waypoint</span>
                        <strong class="text-[#D4AF37] text-xs sm:text-sm font-sans truncate block">{{ $milestones[$currentIndex]['title'] ?? 'Processing' }}</strong>
                    </div>
                    <div class="p-3 rounded-xl bg-slate-800/60 border border-slate-700/60">
                        <span class="text-slate-400 block text-[10px] uppercase">Estimated Horizon</span>
                        <strong class="text-white text-xs sm:text-sm font-sans">{{ $milestones[$currentIndex]['eta'] ?? 'In Progress' }}</strong>
                    </div>
                    <div class="p-3 rounded-xl bg-slate-800/60 border border-slate-700/60">
                        <span class="text-slate-400 block text-[10px] uppercase">Dossier Altitude</span>
                        <strong class="text-emerald-400 text-xs sm:text-sm font-sans">Verified Level 4</strong>
                    </div>
                </div>
            </div>

            <!-- 2. LUXURY FIRST-CLASS BOARDING PASS / VISA DOSSIER PASS -->
            <div class="boarding-pass-container bg-white rounded-[28px] sm:rounded-[36px] border border-slate-200 shadow-xl mb-8 relative overflow-hidden">
                <!-- Boarding Pass Decorative Notches -->
                <div class="boarding-pass-cutout-left hidden md:block"></div>
                <div class="boarding-pass-cutout-right hidden md:block"></div>

                <!-- Pass Golden Header Strip -->
                <div class="bg-gradient-to-r from-[#0B1F3A] via-[#102D52] to-[#0B1F3A] text-white p-4 sm:p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-slate-100">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-[#D4AF37] text-[#0B1F3A] flex items-center justify-center shadow">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"/></svg>
                        </div>
                        <div>
                            <span class="text-[10px] text-[#D4AF37] uppercase font-mono font-bold tracking-widest block">EMISHA AIRWAYS & VISA DESK</span>
                            <h3 class="text-base sm:text-lg font-bold font-heading text-white">OFFICIAL VISA DOSSIER BOARDING PASS</h3>
                        </div>
                    </div>
                    <div class="text-left sm:text-right font-mono">
                        <span class="text-[10px] text-slate-300 block uppercase">PASSENGER REFERENCE</span>
                        <strong class="text-sm sm:text-base text-[#D4AF37] tracking-wider">{{ $application->reference_number }}</strong>
                    </div>
                </div>

                <!-- Pass Content Grid (Passenger Ticket Columns) -->
                <div class="p-6 sm:p-8 md:p-10 grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
                    <!-- Column 1: Passenger Particulars -->
                    <div class="space-y-4 md:border-r md:border-dashed md:border-slate-200 md:pr-6">
                        <span class="text-[10px] font-bold font-mono uppercase tracking-wider text-slate-400 block">PASSENGER DETAILS</span>
                        <div>
                            <span class="text-[11px] text-slate-500 block">Full Legal Name</span>
                            <strong class="text-sm sm:text-base font-bold text-[#0B1F3A] block truncate">{{ $application->full_name }}</strong>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <span class="text-[11px] text-slate-500 block">Passport Number</span>
                                <strong class="text-xs sm:text-sm font-mono text-slate-800">{{ $application->passport_number ?: 'ON FILE' }}</strong>
                            </div>
                            <div>
                                <span class="text-[11px] text-slate-500 block">Nationality</span>
                                <strong class="text-xs sm:text-sm text-slate-800">{{ $application->nationality ?: 'Bangladeshi' }}</strong>
                            </div>
                        </div>
                        <div>
                            <span class="text-[11px] text-slate-500 block">Contact Telephone</span>
                            <strong class="text-xs font-mono text-slate-800">{{ $application->phone ?: 'N/A' }}</strong>
                        </div>
                    </div>

                    <!-- Column 2: Flight & Visa Particulars -->
                    <div class="space-y-4 md:border-r md:border-dashed md:border-slate-200 md:pr-6">
                        <span class="text-[10px] font-bold font-mono uppercase tracking-wider text-slate-400 block">ROUTE & VISA CLASS</span>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-[10px] text-slate-400 uppercase font-mono">FROM</span>
                                <strong class="text-lg font-extrabold text-[#0B1F3A] block">DAC</strong>
                                <span class="text-[11px] text-slate-500">Dhaka</span>
                            </div>
                            <div class="flex flex-col items-center px-3">
                                <span class="text-[10px] text-[#D4AF37] font-mono font-bold">{{ $workflow === 'evisa' ? 'E-VISA' : 'CONSULAR' }}</span>
                                <div class="w-16 h-0.5 bg-slate-200 relative my-1">
                                    <svg class="w-3.5 h-3.5 text-[#0B1F3A] absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2" fill="currentColor" viewBox="0 0 24 24"><path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"/></svg>
                                </div>
                                <span class="text-[9px] text-slate-400">NON-STOP</span>
                            </div>
                            <div class="text-right">
                                <span class="text-[10px] text-slate-400 uppercase font-mono">TO</span>
                                <strong class="text-lg font-extrabold text-[#0B1F3A] block">{{ $countryCode }}</strong>
                                <span class="text-[11px] text-slate-500">{{ $destCountry }}</span>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3 pt-1">
                            <div>
                                <span class="text-[11px] text-slate-500 block">Travel Date</span>
                                <strong class="text-xs font-semibold text-slate-800">{{ $application->travel_date ? $application->travel_date->format('d M Y') : 'Tentative' }}</strong>
                            </div>
                            <div>
                                <span class="text-[11px] text-slate-500 block">Visa Type</span>
                                <strong class="text-xs font-semibold text-slate-800">{{ $application->visaType->name ?? 'Tourist Visa' }}</strong>
                            </div>
                        </div>

                        <div>
                            <span class="text-[11px] text-slate-500 block">Total Service Fee</span>
                            <strong class="text-sm font-extrabold text-emerald-700">৳ {{ number_format($application->total_service_fee, 0) }} BDT</strong>
                        </div>
                    </div>

                    <!-- Column 3: Stub & Fast Actions -->
                    <div class="flex flex-col justify-between space-y-4">
                        <div>
                            <span class="text-[10px] font-bold font-mono uppercase tracking-wider text-slate-400 block mb-2">SECURITY BARCODE</span>
                            <!-- Decorative Barcode Mockup -->
                            <div class="bg-slate-50 p-3 rounded-xl border border-slate-200 flex flex-col items-center">
                                <div class="w-full flex justify-center gap-[2px] h-10 items-stretch opacity-80 mb-1">
                                    <div class="w-[2px] bg-slate-900"></div>
                                    <div class="w-[4px] bg-slate-900"></div>
                                    <div class="w-[1px] bg-slate-900"></div>
                                    <div class="w-[3px] bg-slate-900"></div>
                                    <div class="w-[5px] bg-slate-900"></div>
                                    <div class="w-[2px] bg-slate-900"></div>
                                    <div class="w-[1px] bg-slate-900"></div>
                                    <div class="w-[4px] bg-slate-900"></div>
                                    <div class="w-[2px] bg-slate-900"></div>
                                    <div class="w-[3px] bg-slate-900"></div>
                                    <div class="w-[6px] bg-slate-900"></div>
                                    <div class="w-[1px] bg-slate-900"></div>
                                    <div class="w-[2px] bg-slate-900"></div>
                                    <div class="w-[4px] bg-slate-900"></div>
                                    <div class="w-[3px] bg-slate-900"></div>
                                    <div class="w-[1px] bg-slate-900"></div>
                                    <div class="w-[5px] bg-slate-900"></div>
                                    <div class="w-[2px] bg-slate-900"></div>
                                    <div class="w-[4px] bg-slate-900"></div>
                                </div>
                                <span class="text-[10px] font-mono text-slate-500 tracking-widest">{{ $application->reference_number }}</span>
                            </div>
                        </div>

                        <!-- Print and Share Actions -->
                        <div class="space-y-2 pt-2">
                            <button 
                                type="button" 
                                onclick="window.print()" 
                                class="w-full py-2.5 px-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs flex items-center justify-center gap-2 transition cursor-pointer"
                            >
                                <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                                <span>Print Boarding Pass</span>
                            </button>

                            <button 
                                type="button" 
                                onclick="navigator.clipboard.writeText(window.location.href).then(() => alert('Direct tracking link copied to clipboard!'))"
                                class="w-full py-2.5 px-3 rounded-xl border border-slate-200 hover:border-slate-300 text-slate-600 font-bold text-xs flex items-center justify-center gap-2 transition cursor-pointer"
                            >
                                <svg class="w-4 h-4 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>
                                <span>Share Tracking Link</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3. DETAILED RADAR MILESTONE JOURNEY & CONSULTANT DISPATCH -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Milestone Detailed Timeline (2 Cols) -->
                <div class="lg:col-span-2 p-6 sm:p-8 bg-white rounded-[28px] sm:rounded-[36px] border border-slate-200 shadow-md">
                    <div class="flex items-center justify-between pb-6 mb-6 border-b border-slate-100">
                        <div>
                            <span class="text-[10px] font-bold uppercase font-mono tracking-wider text-[#D4AF37] block">RADAR AUDIT LOG</span>
                            <h3 class="text-lg sm:text-xl font-bold font-heading text-[#0B1F3A]">Live Workflow Milestone Timeline</h3>
                        </div>
                        <span class="text-xs font-mono text-slate-400">
                            {{ count($milestones) }} Stages Total
                        </span>
                    </div>

                    <div class="relative pl-6 sm:pl-8 space-y-8 before:absolute before:left-3 sm:before:left-4 before:top-3 before:bottom-3 before:w-0.5 before:bg-slate-200">
                        @foreach($milestones as $idx => $m)
                            @php
                                $isCompleted = $idx < $currentIndex || ($idx === $currentIndex && $status === 'approved');
                                $isCurrent = $idx === $currentIndex && $status !== 'approved';
                            @endphp
                            <div class="relative flex items-start gap-4 group">
                                <!-- Marker Icon -->
                                <div class="absolute -left-6 sm:-left-8 top-0.5 w-6 sm:w-8 h-6 sm:h-8 rounded-full flex items-center justify-center font-bold text-xs border-2 transition-all {{ $isCompleted ? 'bg-emerald-600 border-emerald-600 text-white shadow-md shadow-emerald-600/30' : ($isCurrent ? 'bg-[#0B1F3A] border-[#D4AF37] text-[#D4AF37] shadow-lg ring-4 ring-[#D4AF37]/20 scale-110' : 'bg-white border-slate-300 text-slate-400') }}">
                                    @if($isCompleted)
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                    @elseif($isCurrent)
                                        <svg class="w-3.5 h-3.5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                                    @else
                                        <span>{{ $idx + 1 }}</span>
                                    @endif
                                </div>

                                <div class="p-4 rounded-2xl w-full transition-all {{ $isCurrent ? 'bg-amber-50/70 border border-amber-200/80 shadow-xs' : ($isCompleted ? 'bg-slate-50/70 border border-slate-100' : 'opacity-70') }}">
                                    <div class="flex flex-wrap items-center justify-between gap-2 mb-1">
                                        <span class="text-[10px] font-mono font-bold uppercase tracking-wider {{ $isCurrent ? 'text-amber-700' : ($isCompleted ? 'text-emerald-700' : 'text-slate-400') }}">
                                            {{ $m['stage'] }}
                                        </span>
                                        <span class="text-[10px] font-mono px-2 py-0.5 rounded-full {{ $isCompleted ? 'bg-emerald-100 text-emerald-800' : ($isCurrent ? 'bg-amber-200/60 text-amber-900 font-bold' : 'bg-slate-100 text-slate-500') }}">
                                            {{ $isCompleted ? 'Cleared' : ($isCurrent ? 'Active Now' : 'Pending') }}
                                        </span>
                                    </div>

                                    <h4 class="text-sm font-bold {{ $isCurrent ? 'text-[#0B1F3A]' : ($isCompleted ? 'text-slate-800' : 'text-slate-500') }}">
                                        {{ $m['title'] }}
                                    </h4>
                                    <p class="text-xs text-slate-600 mt-1 leading-relaxed">
                                        {{ $m['desc'] }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Officer Remarks Note (If present) -->
                    @if($application->applicant_notes)
                        <div class="mt-8 p-5 rounded-2xl bg-blue-50 border border-blue-200 text-xs text-blue-950 space-y-2">
                            <div class="flex items-center gap-2 text-blue-900 font-bold">
                                <svg class="w-4 h-4 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>Official Note from Your Assigned Visa Specialist:</span>
                            </div>
                            <p class="text-slate-700 pl-6 leading-relaxed">{{ $application->applicant_notes }}</p>
                        </div>
                    @endif
                </div>

                <!-- 24/7 Dedicated Support & Fast-Forward Card (1 Col) -->
                <div class="space-y-6">
                    <!-- WhatsApp Duty Desk Card -->
                    <div class="p-6 sm:p-7 bg-gradient-to-br from-[#0B1F3A] to-[#071527] text-white rounded-[28px] sm:rounded-[36px] shadow-xl border border-slate-700/80 space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-[10px] font-mono uppercase font-bold text-[#D4AF37] tracking-wider">LIVE SUPPORT DESK</span>
                            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full bg-emerald-500/20 text-emerald-300 text-[10px] font-mono">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                <span>ONLINE</span>
                            </span>
                        </div>

                        <div>
                            <h3 class="text-lg font-bold text-white font-heading">Need Fast Forward or Have Questions?</h3>
                            <p class="text-xs text-slate-300 mt-1.5 leading-relaxed">
                                Connect directly with our Senior Visa Consultant to expedite document clearance or ask about appointment slots.
                            </p>
                        </div>

                        <div class="p-3.5 rounded-2xl bg-slate-800/80 border border-slate-700 text-xs font-mono space-y-1.5">
                            <div class="text-slate-400 text-[10px] uppercase">HELPLINE / WHATSAPP</div>
                            <div class="text-[#D4AF37] font-bold text-sm">+880 1805-464294</div>
                            <div class="text-[10px] text-slate-400">Available: Sat–Thu (09:00 AM – 09:00 PM)</div>
                        </div>

                        <a 
                            href="https://wa.me/8801805464294?text={{ urlencode('Hello Emisha Visa Desk, I am inquiring about my Application Reference ID: ' . $application->reference_number . ' for ' . $destCountry . '.') }}" 
                            target="_blank"
                            class="w-full py-3.5 px-4 rounded-xl bg-gradient-to-r from-[#D4AF37] to-amber-500 hover:from-amber-400 hover:to-amber-600 text-[#071527] font-bold text-xs flex items-center justify-center gap-2 shadow-lg shadow-[#D4AF37]/20 transition-all transform active:scale-95 cursor-pointer block text-center"
                        >
                            <svg class="w-4 h-4 fill-current inline-block" viewBox="0 0 24 24">
                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                            </svg>
                            <span>WhatsApp Consultation</span>
                        </a>
                    </div>

                    <!-- Safe & Encrypted Assurance Card -->
                    <div class="p-6 bg-white rounded-[28px] sm:rounded-[36px] border border-slate-200 shadow-sm text-xs space-y-3">
                        <div class="flex items-center gap-2.5 text-[#0B1F3A] font-bold">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            <span>Guaranteed Dossier Security</span>
                        </div>
                        <p class="text-slate-600 leading-relaxed">
                            All applicant personal documents, bank statements, and biometric appointments are guarded under bank-grade 256-bit SSL encryption.
                        </p>
                    </div>
                </div>
            </div>

            <!-- 4. POPUP CONFIRMATION MODAL (If redirected after submission) -->
            <div 
                x-data="{ showModal: {{ session('show_status_modal') ? 'true' : 'false' }}, copiedRef: false }"
                x-show="showModal" 
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="fixed inset-0 z-50 overflow-y-auto bg-black/80 backdrop-blur-md flex items-center justify-center p-3 sm:p-4 md:p-6"
                style="display: none;"
            >
                <div 
                    @click.away="showModal = false"
                    class="bg-white rounded-3xl sm:rounded-[36px] w-full max-w-lg md:max-w-xl p-6 sm:p-8 shadow-2xl border border-slate-100 relative overflow-hidden my-auto text-center"
                >
                    <!-- Close Button -->
                    <button 
                        type="button" 
                        @click="showModal = false" 
                        class="absolute top-4 right-4 w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-800 flex items-center justify-center transition-colors z-20 cursor-pointer"
                        aria-label="Close"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>

                    <!-- Airplane Launch Animation -->
                    <div class="relative w-20 h-20 mx-auto mb-4 flex items-center justify-center">
                        <div class="absolute inset-0 bg-[#D4AF37]/20 rounded-full animate-ping"></div>
                        <div class="relative w-20 h-20 bg-gradient-to-tr from-[#0B1F3A] to-[#102D52] text-[#D4AF37] rounded-full flex items-center justify-center shadow-xl ring-8 ring-amber-50">
                            <svg class="w-10 h-10 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                            </svg>
                        </div>
                    </div>

                    <span class="px-3 py-1 bg-emerald-50 border border-emerald-300 text-emerald-800 font-bold text-xs uppercase tracking-wider rounded-full inline-block mb-2">
                        Dossier Registered on Radar
                    </span>
                    <h3 class="text-xl sm:text-2xl font-extrabold text-[#0B1F3A] font-heading">
                        Visa Application Received!
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-500 mt-1 max-w-sm mx-auto leading-relaxed">
                        Your application for <strong class="text-slate-800">{{ $destCountry }}</strong> is officially on the Emisha Visa Flight Radar.
                    </p>

                    <!-- Ref Box -->
                    <div class="my-5 p-4 rounded-2xl bg-[#0B1F3A] text-white flex items-center justify-between gap-3 shadow-md">
                        <div class="text-left">
                            <span class="text-[10px] text-[#D4AF37] uppercase font-bold tracking-wider block">Official Tracking ID</span>
                            <strong class="text-base sm:text-lg font-mono tracking-wider text-white">{{ $application->reference_number }}</strong>
                        </div>
                        <button 
                            type="button" 
                            @click="navigator.clipboard.writeText('{{ $application->reference_number }}').then(() => { copiedRef = true; setTimeout(() => copiedRef = false, 2500); })"
                            class="px-3 py-1.5 bg-white/10 hover:bg-white/20 border border-white/20 rounded-xl text-xs font-bold text-white transition flex items-center gap-1.5 cursor-pointer"
                        >
                            <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/></svg>
                            <span x-text="copiedRef ? 'Copied!' : 'Copy'"></span>
                        </button>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3 pt-2">
                        <button 
                            type="button" 
                            @click="showModal = false"
                            class="btn btn-primary flex-1 py-3 px-4 text-xs font-bold shadow-md w-full cursor-pointer"
                        >
                            <span>Explore Radar Track</span>
                        </button>
                        <a 
                            href="https://wa.me/8801805464294?text={{ urlencode('Hello Emisha Visa Desk, I have just registered my Visa Application Ref: ' . $application->reference_number) }}" 
                            target="_blank"
                            class="btn btn-gold flex-1 py-3 px-4 text-xs font-bold shadow-md flex items-center justify-center gap-2 w-full cursor-pointer"
                        >
                            <span>WhatsApp Support</span>
                        </a>
                    </div>
                </div>
            </div>

        @else
            <!-- 5. EMPTY SEARCH STATE / LANDING EXPLORER -->
            <div class="py-8 sm:py-12">
                <!-- Flight Radar Terminal Hero Card -->
                <div class="bg-white rounded-[32px] sm:rounded-[40px] border border-slate-200/80 shadow-xl p-6 sm:p-10 md:p-14 text-center max-w-3xl mx-auto relative overflow-hidden">
                    <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 rounded-full bg-amber-500/5 blur-2xl pointer-events-none"></div>
                    <div class="absolute bottom-0 left-0 -ml-16 -mb-16 w-64 h-64 rounded-full bg-blue-500/5 blur-2xl pointer-events-none"></div>

                    <!-- Aviation Illustration Graphic -->
                    <div class="relative w-24 h-24 sm:w-28 sm:h-28 mx-auto mb-6 flex items-center justify-center">
                        <div class="absolute inset-0 bg-[#D4AF37]/10 rounded-full animate-radar-pulse"></div>
                        <div class="relative w-20 h-20 sm:w-24 sm:h-24 bg-gradient-to-tr from-[#0B1F3A] to-[#102D52] text-[#D4AF37] rounded-full flex items-center justify-center shadow-xl ring-8 ring-slate-50">
                            <svg class="w-10 h-10 sm:w-12 sm:h-12 animate-airplane-float" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                            </svg>
                        </div>
                    </div>

                    <span class="px-3.5 py-1 rounded-full bg-amber-50 border border-amber-200 text-amber-800 text-xs font-bold uppercase tracking-wider inline-block mb-3">
                        Flight Radar Status Center
                    </span>

                    <h2 class="text-2xl sm:text-3xl font-extrabold text-[#0B1F3A] font-heading mb-3">
                        Enter Your Dossier Reference ID
                    </h2>

                    <p class="text-xs sm:text-sm text-slate-500 max-w-lg mx-auto leading-relaxed mb-8">
                        Enter the Reference Number provided upon visa registration (e.g. <strong class="font-mono text-slate-700">VISA-2026-XXXXXX</strong>) to initiate the live radar scan and view your flight corridor status.
                    </p>

                    <!-- Quick 3-Step Guide -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-left pt-6 border-t border-slate-100">
                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/60 space-y-1">
                            <div class="w-7 h-7 rounded-lg bg-[#0B1F3A] text-[#D4AF37] font-mono font-bold text-xs flex items-center justify-center">
                                01
                            </div>
                            <h4 class="text-xs font-bold text-[#0B1F3A]">Input Reference ID</h4>
                            <p class="text-[11px] text-slate-500">Provide the official tracking code sent to your email/SMS.</p>
                        </div>

                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/60 space-y-1">
                            <div class="w-7 h-7 rounded-lg bg-[#0B1F3A] text-[#D4AF37] font-mono font-bold text-xs flex items-center justify-center">
                                02
                            </div>
                            <h4 class="text-xs font-bold text-[#0B1F3A]">Flight Radar Sync</h4>
                            <p class="text-[11px] text-slate-500">Inspect live embassy audit stages, document logs, and ETA.</p>
                        </div>

                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/60 space-y-1">
                            <div class="w-7 h-7 rounded-lg bg-[#0B1F3A] text-[#D4AF37] font-mono font-bold text-xs flex items-center justify-center">
                                03
                            </div>
                            <h4 class="text-xs font-bold text-[#0B1F3A]">Receive Visa</h4>
                            <p class="text-[11px] text-slate-500">Collect your approved eVisa or passport ready for departure.</p>
                        </div>
                    </div>

                    <!-- Direct Help Button -->
                    <div class="mt-8 pt-6 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-center gap-3">
                        <a 
                            href="{{ route('visa.index') }}" 
                            class="btn btn-primary py-3 px-6 text-xs font-bold shadow-md w-full sm:w-auto"
                        >
                            <span>Apply for New Visa</span>
                        </a>

                        <a 
                            href="https://wa.me/8801805464294?text={{ urlencode('Hello Emisha Visa Desk, I need help tracking my visa application.') }}" 
                            target="_blank"
                            class="btn btn-gold py-3 px-6 text-xs font-bold shadow-md flex items-center justify-center gap-2 w-full sm:w-auto"
                        >
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                            </svg>
                            <span>WhatsApp Helpline</span>
                        </a>
                    </div>
                </div>
            </div>
        @endif

    </div>
</section>
@endsection
