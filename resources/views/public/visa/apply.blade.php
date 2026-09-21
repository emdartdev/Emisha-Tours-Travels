@extends('layouts.app')

@section('title', 'Online Tourist Visa Application Onboarding — Emisha Tours & Travels')
@section('meta_description', 'Apply for your tourist visa online with expert document checking, transparent service pricing, and private secure document handling.')
@section('canonical_url', route('visa.apply', $selectedSlug ?? null))

@section('schema')
    {!! $schema ?? '' !!}
@endsection

@section('content')
<!-- Hero Header -->
<div class="bg-[#0B1F3A] text-white py-10 lg:py-14 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-r from-[#071527] to-[#0B1F3A] opacity-90"></div>
    <div class="container-custom relative z-10">
        <div class="text-xs md:text-sm font-bold text-[#D4AF37] uppercase tracking-wider mb-2 flex items-center gap-2">
            <a href="{{ route('home') }}" class="hover:underline">Home</a>
            <span>/</span>
            <a href="{{ route('visa.index') }}" class="hover:underline">Visa Services</a>
            <span>/</span>
            <span>Tourist Visa Onboarding</span>
        </div>
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-white mb-2 font-heading">Tourist Visa Application Portal</h1>
                <p class="text-sm md:text-base text-white/80 max-w-2xl leading-relaxed">
                    Guided onboarding for Bangladeshi passport holders. Expert document verification, official guideline compliance, and encrypted private file storage.
                </p>
            </div>
            <div class="flex items-center gap-2 flex-shrink-0">
                <a href="{{ route('visa.track') }}" class="px-5 py-3 bg-white/10 hover:bg-white/20 border border-white/20 text-white rounded-xl text-xs md:text-sm font-bold transition flex items-center gap-2 backdrop-blur-sm shadow-sm">
                    <svg class="w-4 h-4 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <span>Track Existing Application</span>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Main Onboarding Wizard Section -->
<section class="section-padding bg-[#F8FAFC]" x-data="visaOnboardingWizard(@js($destinations), @js($schengenCountries), '{{ $selectedSlug }}', @js($draftData), @js($uploadQuota ?? []), '{{ $submissionToken ?? '' }}', @js($isAlreadySubmitted ?? false), @js($submittedApplicationData ?? null))">
    <div class="container-custom max-w-5xl">
        
        <!-- Top Step Tracker (10 Steps with Clear Typography & Responsive UX) -->
        <div class="mb-6 sm:mb-8 bg-white p-3.5 sm:p-4 md:p-6 rounded-2xl sm:rounded-[24px] border border-slate-200/90 shadow-sm">
            <div class="flex items-center gap-2 overflow-x-auto pb-2 scrollbar-none">
                <template x-for="(s, index) in steps" :key="s.id">
                    <button 
                        type="button" 
                        @click="goToStep(index + 1)" 
                        :disabled="currentStep < index + 1 && !isStepCompleted(index + 1)" 
                        class="flex items-center gap-2.5 text-left flex-shrink-0 px-3.5 py-2.5 rounded-xl transition-all font-medium text-xs md:text-sm" 
                        :class="currentStep === (index + 1) ? 'bg-[#0B1F3A] text-white shadow-md ring-2 ring-[#D4AF37]/40' : (currentStep > (index + 1) ? 'text-emerald-800 bg-emerald-50 hover:bg-emerald-100 cursor-pointer' : 'text-slate-400 opacity-75 hover:opacity-100')"
                    >
                        <div class="w-7 h-7 md:w-8 md:h-8 rounded-full flex items-center justify-center font-bold text-xs md:text-sm flex-shrink-0" :class="currentStep === (index + 1) ? 'bg-[#D4AF37] text-[#0B1F3A]' : (currentStep > (index + 1) ? 'bg-emerald-600 text-white' : 'bg-slate-200 text-slate-600')">
                            <template x-if="currentStep > (index + 1)">
                                <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            </template>
                            <template x-if="currentStep <= (index + 1)">
                                <span x-text="index + 1"></span>
                            </template>
                        </div>
                        <div class="hidden sm:block">
                            <span class="font-semibold block whitespace-nowrap" x-text="s.shortTitle"></span>
                        </div>
                    </button>
                </template>
            </div>

            <!-- Active Step Progress Bar -->
            <div class="mt-4 pt-3 border-t border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-2 text-xs md:text-sm text-slate-600">
                <div class="flex items-center gap-2">
                    <span class="font-semibold text-slate-500">Step <span class="text-[#0B1F3A] font-bold" x-text="currentStep"></span> of <span x-text="steps.length"></span>:</span>
                    <strong class="text-[#0B1F3A] font-bold text-sm md:text-base" x-text="steps[currentStep - 1]?.title"></strong>
                </div>
                <div class="flex items-center gap-3">
                    <span x-show="autoSaved" x-transition.opacity class="text-emerald-700 font-bold text-xs flex items-center gap-1.5 bg-emerald-50 px-2.5 py-1 rounded-lg border border-emerald-200">
                        <svg class="w-3.5 h-3.5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>Draft Auto-Saved</span>
                    </span>
                    <span class="text-xs md:text-sm font-semibold text-slate-500 font-mono bg-slate-100 px-2.5 py-1 rounded-lg" x-text="Math.round(((currentStep - 1) / (steps.length - 1)) * 100) + '% completed'"></span>
                </div>
            </div>
            <div class="w-full bg-slate-100 h-2 rounded-full mt-2.5 overflow-hidden">
                <div class="bg-gradient-to-r from-[#D4AF37] to-amber-500 h-full transition-all duration-300 rounded-full" :style="'width: ' + (((currentStep - 1) / (steps.length - 1)) * 100) + '%'"></div>
            </div>
        </div>

        <!-- Onboarding Wizard Card Container -->
        <div class="card-base p-4 sm:p-8 md:p-12 shadow-xl bg-white border border-slate-200/90 rounded-2xl sm:rounded-[28px] relative">
            
            <!-- SUBMITTED APPLICATION LOCKED STATE OVERVIEW CARD -->
            <div x-show="applicationStatus === 'SUBMITTED' || isSubmittedSuccessfully" x-cloak class="space-y-6 py-2 sm:py-4">
                <div class="text-center pb-6 border-b border-slate-100">
                    <div class="relative w-16 h-16 sm:w-20 sm:h-20 mx-auto mb-4 flex items-center justify-center">
                        <div class="absolute inset-0 bg-emerald-400 rounded-full animate-ping opacity-25"></div>
                        <div class="relative w-16 h-16 sm:w-20 sm:h-20 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center shadow-inner ring-8 ring-emerald-50">
                            <svg class="w-8 h-8 sm:w-10 sm:h-10 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                    </div>
                    <span class="px-3.5 py-1 bg-emerald-50 border border-emerald-300 text-emerald-800 font-bold text-xs uppercase tracking-wider rounded-full inline-block mb-2">
                        Application Registered & Locked
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-[#0B1F3A] font-heading">
                        Visa Application Dossier Created
                    </h2>
                    <p class="text-sm text-slate-500 mt-1 max-w-lg mx-auto leading-relaxed">
                        Your application is securely registered and locked for document review by our visa team. Submitting again is disabled for this record.
                    </p>
                </div>

                <!-- Official Reference ID Box -->
                <div class="p-5 sm:p-6 rounded-2xl bg-[#0B1F3A] text-white flex flex-col sm:flex-row sm:items-center justify-between gap-4 shadow-lg">
                    <div>
                        <span class="text-xs text-[#D4AF37] uppercase font-bold tracking-wider block">Official Tracking Code</span>
                        <strong class="text-xl sm:text-3xl font-extrabold font-mono tracking-wide text-white truncate block mt-0.5" x-text="submittedApp.reference_number"></strong>
                    </div>
                    <div class="flex items-center gap-2">
                        <button 
                            type="button" 
                            @click="copyReference(submittedApp.reference_number)"
                            class="px-4 py-2.5 bg-white/10 hover:bg-white/20 border border-white/20 rounded-xl text-xs font-bold text-white transition flex items-center gap-2 flex-shrink-0"
                        >
                            <svg class="w-4 h-4 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/></svg>
                            <span x-text="copiedRef ? 'Copied!' : 'Copy Tracking Code'"></span>
                        </button>
                    </div>
                </div>

                <!-- Summary Details Grid -->
                <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 text-xs sm:text-sm">
                    <div>
                        <span class="text-slate-500 font-medium block">Destination:</span>
                        <strong class="text-[#0B1F3A] font-bold block mt-0.5">
                            <span x-text="submittedApp.flag"></span>
                            <span x-text="submittedApp.country_name"></span>
                        </strong>
                    </div>
                    <div>
                        <span class="text-slate-500 font-medium block">Applicant Name:</span>
                        <strong class="text-[#0B1F3A] font-bold block mt-0.5" x-text="submittedApp.applicant_name"></strong>
                    </div>
                    <div>
                        <span class="text-slate-500 font-medium block">Current Status:</span>
                        <span class="inline-block mt-0.5 px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-100 text-amber-800 border border-amber-300">
                            Under Specialist Review
                        </span>
                    </div>
                    <div>
                        <span class="text-slate-500 font-medium block">Service Fee:</span>
                        <strong class="text-emerald-700 font-extrabold text-base block mt-0.5">৳ <span x-text="submittedApp.total_service_fee"></span> BDT</strong>
                    </div>
                </div>

                <!-- Next Steps Milestone -->
                <div class="p-4 rounded-xl bg-blue-50 border border-blue-200 text-xs text-blue-950 space-y-1">
                    <strong class="font-bold flex items-center gap-1.5 text-[#0B1F3A]">
                        <svg class="w-4 h-4 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>What to do next?</span>
                    </strong>
                    <p class="text-slate-700">1. Track live consular submission progress on our tracker dashboard anytime using your Reference ID.</p>
                    <p class="text-slate-700">2. Our visa processing specialist will contact you on WhatsApp / Phone within 30-60 minutes.</p>
                </div>

                <!-- Actions CTA -->
                <div class="pt-4 flex flex-col sm:flex-row items-center justify-between gap-3 border-t border-slate-100">
                    <a 
                        :href="submittedApp.tracking_url" 
                        class="btn btn-primary py-3.5 px-6 text-sm font-bold shadow-md flex items-center justify-center gap-2 w-full sm:w-auto flex-1"
                    >
                        <svg class="w-4 h-4 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        <span>Track Application Live</span>
                    </a>

                    <a 
                        :href="submittedApp.whatsapp_url" 
                        target="_blank"
                        class="btn btn-gold py-3.5 px-6 text-sm font-bold shadow-md flex items-center justify-center gap-2 w-full sm:w-auto flex-1"
                    >
                        <svg class="w-4 h-4 fill-current flex-shrink-0" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                        </svg>
                        <span>WhatsApp Specialist</span>
                    </a>

                    <button 
                        type="button" 
                        @click="startNewApplication()"
                        class="btn btn-outline py-3.5 px-6 text-sm font-bold shadow-xs flex items-center justify-center gap-2 w-full sm:w-auto border-slate-300 hover:bg-slate-50 text-slate-700"
                    >
                        <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        <span>Apply For Another Visa</span>
                    </button>
                </div>
            </div>

            <!-- Active Form Wizard (visible only when NOT submitted/locked) -->
            <form x-show="applicationStatus !== 'SUBMITTED' && !isSubmittedSuccessfully" action="{{ route('visa.apply.store') }}" method="POST" enctype="multipart/form-data" id="visaOnboardingForm" @submit.prevent="submitVisaForm">
                @csrf

                <!-- Hidden Selected Destination & Dynamic Fields -->
                <input type="hidden" name="submission_token" :value="submissionToken">
                <input type="hidden" name="destination_slug" :value="form.destination_slug">
                <input type="hidden" name="visa_country_id" :value="selectedCountryId">
                <input type="hidden" name="visa_type_id" :value="selectedTypeId">

                <!-- STEP 1: Destination Selection -->
                <div x-show="currentStep === 1" class="space-y-6">
                    <div>
                        <span class="text-xs font-bold text-[#D4AF37] uppercase tracking-wider block mb-1">Step 1 — Destination Selection</span>
                        <h2 class="text-2xl md:text-3xl font-bold font-heading text-[#0B1F3A]">Where are you traveling?</h2>
                        <p class="text-sm md:text-base text-slate-600 mt-1 leading-relaxed">
                            Select your destination country to load verified document requirements, consular guidelines, and transparent service fees.
                        </p>
                    </div>

                    <!-- Destination Cards Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-5">
                        <template x-for="(dest, key) in destinations" :key="key">
                            <div 
                                @click="selectDestination(key)"
                                class="p-5 md:p-6 rounded-[22px] border-2 cursor-pointer transition-all duration-200 relative group flex flex-col justify-between"
                                :class="form.destination_slug === key ? 'border-[#D4AF37] bg-amber-50/30 shadow-md ring-2 ring-[#D4AF37]/30' : 'border-slate-200 bg-white hover:border-[#0B1F3A]/40 hover:shadow-sm'"
                            >
                                <div>
                                    <div class="flex items-start justify-between gap-3 mb-3">
                                        <div class="flex items-center gap-3">
                                            <span class="text-3xl sm:text-4xl" x-text="dest.flag"></span>
                                            <div>
                                                <h3 class="font-bold text-base md:text-lg text-[#0B1F3A]" x-text="dest.name"></h3>
                                                <span class="text-xs font-semibold px-2.5 py-0.5 rounded-full inline-block mt-0.5" :class="dest.workflow_type === 'evisa' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800'" x-text="dest.visa_category"></span>
                                            </div>
                                        </div>
                                        <div class="w-6 h-6 rounded-full border-2 flex items-center justify-center flex-shrink-0 mt-1" :class="form.destination_slug === key ? 'border-[#D4AF37] bg-[#D4AF37]' : 'border-slate-300'">
                                            <svg x-show="form.destination_slug === key" class="w-3.5 h-3.5 text-[#0B1F3A]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                        </div>
                                    </div>
                                    <p class="text-xs md:text-sm text-slate-600 line-clamp-2 mb-4 leading-relaxed" x-text="dest.summary"></p>
                                </div>

                                <div class="pt-3.5 border-t border-slate-100 flex items-center justify-between text-sm">
                                    <span class="text-slate-500 font-medium">Service Fee:</span>
                                    <span class="font-extrabold text-[#0B1F3A] text-base md:text-lg">৳ <span x-text="Number(dest.service_fee).toLocaleString('en-US')"></span></span>
                                </div>
                            </div>
                        </template>
                    </div>

                    <!-- Selected Country Summary Box -->
                    <div x-show="currentDestination" class="p-6 rounded-[22px] bg-slate-50 border border-slate-200 text-sm text-slate-700 space-y-3">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                            <span class="font-bold text-base text-[#0B1F3A] flex items-center gap-2">
                                <span class="text-2xl" x-text="currentDestination?.flag"></span>
                                <span x-text="currentDestination?.visa_route_name"></span>
                            </span>
                            <span class="font-bold text-emerald-800 bg-emerald-100 px-3 py-1 rounded-full text-xs self-start sm:self-auto" x-text="'Processing Time: ' + currentDestination?.processing_time"></span>
                        </div>
                        <p class="text-slate-600 text-xs md:text-sm leading-relaxed" x-text="currentDestination?.disclaimer"></p>
                        <div class="pt-3 text-xs md:text-sm text-slate-600 border-t border-slate-200/80 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                            <span>Validity: <strong class="text-slate-900" x-text="currentDestination?.validity"></strong> • Stay: <strong class="text-slate-900" x-text="currentDestination?.stay_period"></strong></span>
                            <span class="text-amber-800 font-semibold" x-text="currentDestination?.govt_fee_note"></span>
                        </div>
                    </div>

                    <div class="pt-6 flex justify-end">
                        <button type="button" @click="nextStep()" class="btn btn-primary px-8 py-3.5 text-sm md:text-base font-bold shadow-md flex items-center gap-2">
                            <span>Continue: Applicant Profile</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </button>
                    </div>
                </div>

                <!-- STEP 2: Basic Applicant Profile -->
                <div x-show="currentStep === 2" class="space-y-6">
                    <div>
                        <span class="text-xs font-bold text-[#D4AF37] uppercase tracking-wider block mb-1">Step 2 — Applicant Profile</span>
                        <h2 class="text-2xl md:text-3xl font-bold font-heading text-[#0B1F3A]">Primary Applicant Personal Details</h2>
                        <p class="text-sm text-slate-600 mt-1">Please provide applicant information exactly as stated in your official government passport.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-800 mb-2">Full Legal Name (as on Passport) *</label>
                            <input type="text" name="full_name" x-model="form.full_name" required placeholder="e.g. MOHAMMED EMADUL HAQUE" class="w-full px-4 py-3.5 rounded-xl border border-slate-300 text-sm md:text-base text-slate-900 uppercase font-medium focus:outline-none focus:ring-2 focus:ring-[#D4AF37] focus:border-[#0B1F3A] bg-white transition shadow-xs">
                            <span x-show="errors.full_name" class="text-xs text-rose-600 font-semibold block mt-1" x-text="errors.full_name"></span>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-800 mb-2">Email Address *</label>
                            <input type="email" name="email" x-model="form.email" required placeholder="your.name@example.com" class="w-full px-4 py-3.5 rounded-xl border border-slate-300 text-sm md:text-base text-slate-900 font-medium focus:outline-none focus:ring-2 focus:ring-[#D4AF37] focus:border-[#0B1F3A] bg-white transition shadow-xs">
                            <span x-show="errors.email" class="text-xs text-rose-600 font-semibold block mt-1" x-text="errors.email"></span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 md:gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-800 mb-2">Date of Birth *</label>
                            <input type="date" name="date_of_birth" x-model="form.date_of_birth" required class="w-full px-4 py-3.5 rounded-xl border border-slate-300 text-sm md:text-base text-slate-900 font-medium focus:outline-none focus:ring-2 focus:ring-[#D4AF37] focus:border-[#0B1F3A] bg-white transition shadow-xs">
                            <span x-show="errors.date_of_birth" class="text-xs text-rose-600 font-semibold block mt-1" x-text="errors.date_of_birth"></span>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-800 mb-2">Gender</label>
                            <select name="gender" x-model="form.gender" class="w-full px-4 py-3.5 rounded-xl border border-slate-300 text-sm md:text-base text-slate-900 font-medium focus:outline-none focus:ring-2 focus:ring-[#D4AF37] focus:border-[#0B1F3A] bg-white transition shadow-xs">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-800 mb-2">Marital Status</label>
                            <select name="marital_status" x-model="form.marital_status" class="w-full px-4 py-3.5 rounded-xl border border-slate-300 text-sm md:text-base text-slate-900 font-medium focus:outline-none focus:ring-2 focus:ring-[#D4AF37] focus:border-[#0B1F3A] bg-white transition shadow-xs">
                                <option value="Married">Married</option>
                                <option value="Single">Single</option>
                                <option value="Divorced">Divorced</option>
                                <option value="Widowed">Widowed</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 md:gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-800 mb-2">Phone Number *</label>
                            <input type="text" name="phone" x-model="form.phone" required placeholder="+880 1711 000000" class="w-full px-4 py-3.5 rounded-xl border border-slate-300 text-sm md:text-base text-slate-900 font-medium focus:outline-none focus:ring-2 focus:ring-[#D4AF37] focus:border-[#0B1F3A] bg-white transition shadow-xs">
                            <span x-show="errors.phone" class="text-xs text-rose-600 font-semibold block mt-1" x-text="errors.phone"></span>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-800 mb-2">WhatsApp Number</label>
                            <input type="text" name="whatsapp" x-model="form.whatsapp" placeholder="+880 1711 000000" class="w-full px-4 py-3.5 rounded-xl border border-slate-300 text-sm md:text-base text-slate-900 font-medium focus:outline-none focus:ring-2 focus:ring-[#D4AF37] focus:border-[#0B1F3A] bg-white transition shadow-xs">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-800 mb-2">Current City of Living</label>
                            <input type="text" name="current_city" x-model="form.current_city" placeholder="e.g. Dhaka, Chattogram, Sylhet" class="w-full px-4 py-3.5 rounded-xl border border-slate-300 text-sm md:text-base text-slate-900 font-medium focus:outline-none focus:ring-2 focus:ring-[#D4AF37] focus:border-[#0B1F3A] bg-white transition shadow-xs">
                        </div>
                    </div>

                    <!-- Residence Status Conditional Question -->
                    <div class="p-6 rounded-[22px] bg-slate-50 border border-slate-200 space-y-4">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                            <div>
                                <label class="text-sm font-bold text-[#0B1F3A] block">Are you currently living in Bangladesh? *</label>
                                <p class="text-xs text-slate-500 mt-0.5">Default primary application center is Dhaka, Bangladesh.</p>
                            </div>
                            <div class="flex items-center gap-3">
                                <label class="px-4 py-2 rounded-xl border cursor-pointer transition flex items-center gap-2" :class="form.living_in_bangladesh === 'yes' ? 'bg-[#0B1F3A] text-white border-[#0B1F3A]' : 'bg-white text-slate-700 border-slate-300 hover:border-slate-400'">
                                    <input type="radio" name="living_in_bangladesh" value="yes" x-model="form.living_in_bangladesh" class="sr-only">
                                    <span class="text-xs font-bold">Yes, in Bangladesh</span>
                                </label>
                                <label class="px-4 py-2 rounded-xl border cursor-pointer transition flex items-center gap-2" :class="form.living_in_bangladesh === 'no' ? 'bg-[#0B1F3A] text-white border-[#0B1F3A]' : 'bg-white text-slate-700 border-slate-300 hover:border-slate-400'">
                                    <input type="radio" name="living_in_bangladesh" value="no" x-model="form.living_in_bangladesh" class="sr-only">
                                    <span class="text-xs font-bold">No (Living Abroad)</span>
                                </label>
                            </div>
                        </div>

                        <!-- If NOT living in Bangladesh -->
                        <div x-show="form.living_in_bangladesh === 'no'" class="pt-4 border-t border-slate-200 grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-semibold text-slate-800 mb-2">Current Country of Residence *</label>
                                <input type="text" name="residence_country" x-model="form.residence_country" placeholder="e.g. UAE, Saudi Arabia, UK" class="w-full px-4 py-3 rounded-xl border border-slate-300 text-sm text-[#0B1F3A] bg-white">
                                <span x-show="errors.residence_country" class="text-xs text-rose-600 font-semibold block mt-1" x-text="errors.residence_country"></span>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-800 mb-2">Residence Permit / Legal Visa Status *</label>
                                <input type="text" name="residence_status" x-model="form.residence_status" placeholder="e.g. Work Permit, Resident Visa, Permanent Resident" class="w-full px-4 py-3 rounded-xl border border-slate-300 text-sm text-[#0B1F3A] bg-white">
                                <span x-show="errors.residence_status" class="text-xs text-rose-600 font-semibold block mt-1" x-text="errors.residence_status"></span>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 flex justify-between items-center">
                        <button type="button" @click="prevStep()" class="btn btn-outline px-6 py-3 text-sm font-semibold">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                            <span>Back</span>
                        </button>
                        <button type="button" @click="nextStep()" class="btn btn-primary px-8 py-3.5 text-sm md:text-base font-bold shadow-md flex items-center gap-2">
                            <span>Next: Passport Details</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </button>
                    </div>
                </div>

                <!-- STEP 3: Passport Information -->
                <div x-show="currentStep === 3" class="space-y-6">
                    <div>
                        <span class="text-xs font-bold text-[#D4AF37] uppercase tracking-wider block mb-1">Step 3 — Passport Details</span>
                        <h2 class="text-2xl md:text-3xl font-bold font-heading text-[#0B1F3A]">Passport Identification & Validity</h2>
                        <p class="text-sm text-slate-600 mt-1">Embassy regulations require consistent passport data and sufficient validity periods.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 md:gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-800 mb-2">Passport Number *</label>
                            <input type="text" name="passport_number" x-model="form.passport_number" required placeholder="e.g. A01234567" class="w-full px-4 py-3.5 rounded-xl border border-slate-300 text-sm md:text-base font-mono uppercase text-[#0B1F3A] font-bold focus:outline-none focus:ring-2 focus:ring-[#D4AF37] focus:border-[#0B1F3A] bg-white transition shadow-xs">
                            <span x-show="errors.passport_number" class="text-xs text-rose-600 font-semibold block mt-1" x-text="errors.passport_number"></span>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-800 mb-2">Passport Type</label>
                            <select name="passport_type" x-model="form.passport_type" class="w-full px-4 py-3.5 rounded-xl border border-slate-300 text-sm md:text-base text-slate-900 font-medium focus:outline-none focus:ring-2 focus:ring-[#D4AF37] focus:border-[#0B1F3A] bg-white transition shadow-xs">
                                <option value="Ordinary / Regular">Ordinary / Regular</option>
                                <option value="Official">Official</option>
                                <option value="Diplomatic">Diplomatic</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-800 mb-2">Issuing Country</label>
                            <input type="text" name="passport_issuing_country" x-model="form.passport_issuing_country" class="w-full px-4 py-3.5 rounded-xl border border-slate-300 text-sm md:text-base text-slate-900 font-medium focus:outline-none focus:ring-2 focus:ring-[#D4AF37] focus:border-[#0B1F3A] bg-white transition shadow-xs">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 md:gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-800 mb-2">Passport Issue Date</label>
                            <input type="date" name="passport_issue_date" x-model="form.passport_issue_date" class="w-full px-4 py-3.5 rounded-xl border border-slate-300 text-sm md:text-base text-slate-900 font-medium focus:outline-none focus:ring-2 focus:ring-[#D4AF37] focus:border-[#0B1F3A] bg-white transition shadow-xs">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-800 mb-2">Passport Expiry Date *</label>
                            <input type="date" name="passport_expiry_date" x-model="form.passport_expiry_date" @change="checkPassportValidity()" required class="w-full px-4 py-3.5 rounded-xl border border-slate-300 text-sm md:text-base text-slate-900 font-medium focus:outline-none focus:ring-2 focus:ring-[#D4AF37] focus:border-[#0B1F3A] bg-white transition shadow-xs">
                            <span x-show="errors.passport_expiry_date" class="text-xs text-rose-600 font-semibold block mt-1" x-text="errors.passport_expiry_date"></span>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-800 mb-2">Place of Birth (District/City)</label>
                            <input type="text" name="place_of_birth" x-model="form.place_of_birth" placeholder="e.g. Dhaka" class="w-full px-4 py-3.5 rounded-xl border border-slate-300 text-sm md:text-base text-slate-900 font-medium focus:outline-none focus:ring-2 focus:ring-[#D4AF37] focus:border-[#0B1F3A] bg-white transition shadow-xs">
                        </div>
                    </div>

                    <!-- Passport Validity Smart Warning -->
                    <div x-show="passportWarning" class="p-4 rounded-xl border text-sm flex items-start gap-3" :class="passportWarningValid ? 'bg-emerald-50 border-emerald-200 text-emerald-800' : 'bg-rose-50 border-rose-200 text-rose-800'">
                        <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        <span class="font-medium" x-text="passportWarning"></span>
                    </div>

                    <div class="pt-6 flex justify-between items-center">
                        <button type="button" @click="prevStep()" class="btn btn-outline px-6 py-3 text-sm font-semibold">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                            <span>Back</span>
                        </button>
                        <button type="button" @click="nextStep()" class="btn btn-primary px-8 py-3.5 text-sm md:text-base font-bold shadow-md flex items-center gap-2">
                            <span>Next: Travel Purpose & Dates</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </button>
                    </div>
                </div>

                <!-- STEP 4: Travel Purpose & Details -->
                <div x-show="currentStep === 4" class="space-y-6">
                    <div>
                        <span class="text-xs font-bold text-[#D4AF37] uppercase tracking-wider block mb-1">Step 4 — Travel Purpose & Dates</span>
                        <h2 class="text-2xl md:text-3xl font-bold font-heading text-[#0B1F3A]">Trip Details & Schengen Routing</h2>
                        <p class="text-sm text-slate-600 mt-1">Provide your tentative travel dates and purpose of visit.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-800 mb-2">Purpose of Visit *</label>
                            <select name="travel_purpose" x-model="form.travel_purpose" @change="refreshChecklist()" class="w-full px-4 py-3.5 rounded-xl border border-slate-300 text-sm md:text-base text-slate-900 font-medium focus:outline-none focus:ring-2 focus:ring-[#D4AF37] focus:border-[#0B1F3A] bg-white transition shadow-xs">
                                <option value="Tourism">Tourism & Holiday (Default Consumer Route)</option>
                                <option value="visiting_family_friends">Visiting Family or Friends</option>
                                <option value="Business & Meetings">Business Meetings / Conferences</option>
                                <option value="Other">Other Tourist / Sightseeing</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-800 mb-2">Intended Departure Date *</label>
                            <input type="date" name="travel_date" x-model="form.travel_date" required class="w-full px-4 py-3.5 rounded-xl border border-slate-300 text-sm md:text-base text-slate-900 font-medium focus:outline-none focus:ring-2 focus:ring-[#D4AF37] focus:border-[#0B1F3A] bg-white transition shadow-xs">
                            <span x-show="errors.travel_date" class="text-xs text-rose-600 font-semibold block mt-1" x-text="errors.travel_date"></span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-800 mb-2">Intended Return Date</label>
                            <input type="date" name="return_date" x-model="form.return_date" class="w-full px-4 py-3.5 rounded-xl border border-slate-300 text-sm md:text-base text-slate-900 font-medium focus:outline-none focus:ring-2 focus:ring-[#D4AF37] focus:border-[#0B1F3A] bg-white transition shadow-xs">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-800 mb-2">Planned Cities to Visit</label>
                            <input type="text" name="cities_to_visit" x-model="form.cities_to_visit" placeholder="e.g. Bangkok, Pattaya / Tokyo, Kyoto" class="w-full px-4 py-3.5 rounded-xl border border-slate-300 text-sm md:text-base text-slate-900 font-medium focus:outline-none focus:ring-2 focus:ring-[#D4AF37] focus:border-[#0B1F3A] bg-white transition shadow-xs">
                        </div>
                    </div>

                    <!-- Conditional Host Details (If Visiting Family/Friends) -->
                    <div x-show="form.travel_purpose === 'visiting_family_friends'" class="p-6 rounded-[22px] bg-amber-50/50 border border-amber-200 space-y-4">
                        <h4 class="font-bold text-sm text-[#0B1F3A] uppercase tracking-wider">Host & Reference Information</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs md:text-sm font-semibold text-slate-700 mb-1.5">Host Full Name *</label>
                                <input type="text" name="host_name" x-model="form.host_name" placeholder="Host's legal name" class="w-full px-4 py-3 rounded-xl border border-slate-300 text-sm text-[#0B1F3A] bg-white">
                            </div>
                            <div>
                                <label class="block text-xs md:text-sm font-semibold text-slate-700 mb-1.5">Relationship to Applicant</label>
                                <input type="text" name="host_relationship" x-model="form.host_relationship" placeholder="e.g. Brother, Cousin, Colleague, Friend" class="w-full px-4 py-3 rounded-xl border border-slate-300 text-sm text-[#0B1F3A] bg-white">
                            </div>
                            <div>
                                <label class="block text-xs md:text-sm font-semibold text-slate-700 mb-1.5">Host Contact Phone *</label>
                                <input type="text" name="host_phone" x-model="form.host_phone" placeholder="+1 / +44 / Host local number" class="w-full px-4 py-3 rounded-xl border border-slate-300 text-sm text-[#0B1F3A] bg-white">
                            </div>
                            <div>
                                <label class="block text-xs md:text-sm font-semibold text-slate-700 mb-1.5">Host Residential Address</label>
                                <input type="text" name="host_address" x-model="form.host_address" placeholder="Full address in destination country" class="w-full px-4 py-3 rounded-xl border border-slate-300 text-sm text-[#0B1F3A] bg-white">
                            </div>
                        </div>
                    </div>

                    <!-- Schengen 29 Member States Multi-Country Longest Stay Matrix -->
                    <div x-show="form.destination_slug === 'europe-schengen'" class="p-6 rounded-[22px] bg-blue-50/50 border border-blue-200 space-y-4">
                        <div>
                            <h4 class="font-bold text-sm text-[#0B1F3A] uppercase tracking-wider mb-1">Schengen Member States & Longest-Stay Routing</h4>
                            <p class="text-xs md:text-sm text-slate-600">
                                Select all Schengen member states you plan to visit and assign nights. Embassy rules mandate applying to the country of <strong>longest stay</strong> (or first entry in case of equal stay).
                            </p>
                        </div>

                        <!-- Schengen Countries Multi-Selector -->
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-2.5 max-h-60 overflow-y-auto p-4 bg-white rounded-xl border border-slate-200 text-xs md:text-sm">
                            <template x-for="c in schengenCountriesList" :key="c">
                                <label class="flex items-center gap-2 p-2 hover:bg-slate-50 rounded-lg cursor-pointer">
                                    <input type="checkbox" :value="c" x-model="form.schengen_countries" @change="calculateSchengenRouting()" class="rounded text-[#0B1F3A] focus:ring-[#D4AF37] w-4 h-4">
                                    <span class="truncate font-medium text-slate-800" x-text="c"></span>
                                </label>
                            </template>
                        </div>

                        <!-- Nights per selected country -->
                        <div x-show="form.schengen_countries.length > 0" class="space-y-3 pt-2">
                            <label class="text-xs md:text-sm font-bold text-[#0B1F3A] uppercase tracking-wider block">Nights planned per country:</label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                                <template x-for="c in form.schengen_countries" :key="c">
                                    <div class="p-3.5 bg-white rounded-xl border border-slate-200 flex items-center justify-between gap-3">
                                        <span class="text-sm font-bold text-[#0B1F3A] truncate" x-text="c"></span>
                                        <div class="flex items-center gap-1.5">
                                            <input type="number" min="1" max="90" x-model.number="form.schengen_nights[c]" @input="calculateSchengenRouting()" class="w-16 px-2.5 py-1.5 rounded-lg border border-slate-300 text-sm font-bold text-center">
                                            <span class="text-xs text-slate-500 font-medium">nights</span>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <!-- Main Destination Result Box -->
                        <div x-show="schengenMainCountry" class="p-4 rounded-xl bg-white border border-blue-300 flex items-center justify-between text-sm">
                            <div>
                                <span class="text-slate-500 block text-xs">Primary Embassy for Application Filing:</span>
                                <strong class="text-base font-extrabold text-[#0B1F3A]" x-text="schengenMainCountry"></strong>
                            </div>
                            <span class="text-emerald-800 bg-emerald-100 px-3 py-1.5 rounded-full font-bold text-xs">Longest Stay Routed</span>
                        </div>
                    </div>

                    <div class="pt-6 flex justify-between items-center">
                        <button type="button" @click="prevStep()" class="btn btn-outline px-6 py-3 text-sm font-semibold">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                            <span>Back</span>
                        </button>
                        <button type="button" @click="nextStep()" class="btn btn-primary px-8 py-3.5 text-sm md:text-base font-bold shadow-md flex items-center gap-2">
                            <span>Next: Employment & Financial</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </button>
                    </div>
                </div>

                <!-- STEP 5: Employment & Financial Profile -->
                <div x-show="currentStep === 5" class="space-y-6">
                    <div>
                        <span class="text-xs font-bold text-[#D4AF37] uppercase tracking-wider block mb-1">Step 5 — Employment & Financials</span>
                        <h2 class="text-2xl md:text-3xl font-bold font-heading text-[#0B1F3A]">Occupation & Trip Funding</h2>
                        <p class="text-sm text-slate-600 mt-1">Document checklists adapt dynamically based on your employment and funding profile.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-800 mb-2">Current Occupation / Employment Status *</label>
                            <select name="employment_status" x-model="form.employment_status" @change="refreshChecklist()" class="w-full px-4 py-3.5 rounded-xl border border-slate-300 text-sm md:text-base text-slate-900 font-medium focus:outline-none focus:ring-2 focus:ring-[#D4AF37] focus:border-[#0B1F3A] bg-white transition shadow-xs">
                                <option value="employed">Employed (Salaried / Corporate)</option>
                                <option value="business_owner">Business Owner / Managing Director</option>
                                <option value="self_employed">Self-Employed / Professional</option>
                                <option value="student">Student (School / College / University)</option>
                                <option value="retired">Retired</option>
                                <option value="unemployed">Unemployed / Homemaker</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-800 mb-2">Who is paying for your trip? *</label>
                            <select name="funding_source" x-model="form.funding_source" @change="refreshChecklist()" class="w-full px-4 py-3.5 rounded-xl border border-slate-300 text-sm md:text-base text-slate-900 font-medium focus:outline-none focus:ring-2 focus:ring-[#D4AF37] focus:border-[#0B1F3A] bg-white transition shadow-xs">
                                <option value="self">Self-funded (My own bank account)</option>
                                <option value="employer_funded">Company / Employer Sponsored</option>
                                <option value="family_funded">Family Member (Parents, Spouse, Children)</option>
                                <option value="sponsored">Third-Party Host / Sponsor</option>
                            </select>
                        </div>
                    </div>

                    <!-- IF Employed -->
                    <div x-show="form.employment_status === 'employed'" class="p-6 rounded-[22px] bg-slate-50 border border-slate-200 space-y-4">
                        <h4 class="font-bold text-sm text-[#0B1F3A] uppercase tracking-wider">Employer Details</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs md:text-sm font-semibold text-slate-700 mb-1.5">Company / Organization Name *</label>
                                <input type="text" name="employer_name" x-model="form.employer_name" placeholder="e.g. Grameenphone, Beximco, Standard Chartered" class="w-full px-4 py-3 rounded-xl border border-slate-300 text-sm text-[#0B1F3A] bg-white">
                            </div>
                            <div>
                                <label class="block text-xs md:text-sm font-semibold text-slate-700 mb-1.5">Designation / Job Title</label>
                                <input type="text" name="job_title" x-model="form.job_title" placeholder="e.g. Senior Software Engineer, Marketing Lead" class="w-full px-4 py-3 rounded-xl border border-slate-300 text-sm text-[#0B1F3A] bg-white">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-xs md:text-sm font-semibold text-slate-700 mb-1.5">Company Office Address</label>
                                <input type="text" name="company_address" x-model="form.company_address" placeholder="e.g. Gulshan-2, Dhaka" class="w-full px-4 py-3 rounded-xl border border-slate-300 text-sm text-[#0B1F3A] bg-white">
                            </div>
                        </div>
                    </div>

                    <!-- IF Business Owner / Self-Employed -->
                    <div x-show="form.employment_status === 'business_owner' || form.employment_status === 'self_employed'" class="p-6 rounded-[22px] bg-slate-50 border border-slate-200 space-y-4">
                        <h4 class="font-bold text-sm text-[#0B1F3A] uppercase tracking-wider">Business / Enterprise Details</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs md:text-sm font-semibold text-slate-700 mb-1.5">Business / Company Name *</label>
                                <input type="text" name="business_name" x-model="form.business_name" placeholder="e.g. Emisha Trading International" class="w-full px-4 py-3 rounded-xl border border-slate-300 text-sm text-[#0B1F3A] bg-white">
                            </div>
                            <div>
                                <label class="block text-xs md:text-sm font-semibold text-slate-700 mb-1.5">Type of Business</label>
                                <input type="text" name="business_type" x-model="form.business_type" placeholder="e.g. Proprietorship, Limited Company, Partnership" class="w-full px-4 py-3 rounded-xl border border-slate-300 text-sm text-[#0B1F3A] bg-white">
                            </div>
                        </div>
                    </div>

                    <!-- IF Student -->
                    <div x-show="form.employment_status === 'student'" class="p-6 rounded-[22px] bg-slate-50 border border-slate-200 space-y-4">
                        <h4 class="font-bold text-sm text-[#0B1F3A] uppercase tracking-wider">Educational Institution Details</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs md:text-sm font-semibold text-slate-700 mb-1.5">Institution Name *</label>
                                <input type="text" name="institution_name" x-model="form.institution_name" placeholder="e.g. Dhaka University, North South University" class="w-full px-4 py-3 rounded-xl border border-slate-300 text-sm text-[#0B1F3A] bg-white">
                            </div>
                            <div>
                                <label class="block text-xs md:text-sm font-semibold text-slate-700 mb-1.5">Student ID / Program</label>
                                <input type="text" name="student_id" x-model="form.student_id" placeholder="e.g. BBA / ID: 2021004" class="w-full px-4 py-3 rounded-xl border border-slate-300 text-sm text-[#0B1F3A] bg-white">
                            </div>
                        </div>
                    </div>

                    <!-- IF Sponsored / Family Funded -->
                    <div x-show="form.funding_source === 'sponsored' || form.funding_source === 'family_funded' || form.funding_source === 'employer_funded'" class="p-6 rounded-[22px] bg-amber-50/50 border border-amber-200 space-y-4">
                        <h4 class="font-bold text-sm text-[#0B1F3A] uppercase tracking-wider">Sponsor / Funding Entity Information</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs md:text-sm font-semibold text-slate-700 mb-1.5">Sponsor Full Name / Organization *</label>
                                <input type="text" name="sponsor_name" x-model="form.sponsor_name" placeholder="Sponsor's full legal name" class="w-full px-4 py-3 rounded-xl border border-slate-300 text-sm text-[#0B1F3A] bg-white">
                            </div>
                            <div>
                                <label class="block text-xs md:text-sm font-semibold text-slate-700 mb-1.5">Relationship to Applicant</label>
                                <input type="text" name="sponsor_relationship" x-model="form.sponsor_relationship" placeholder="e.g. Father, Mother, Spouse, Employer" class="w-full px-4 py-3 rounded-xl border border-slate-300 text-sm text-[#0B1F3A] bg-white">
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-800 mb-2">Approximate Monthly Income (BDT)</label>
                            <input type="text" name="monthly_income" x-model="form.monthly_income" placeholder="e.g. ৳ 80,000" class="w-full px-4 py-3.5 rounded-xl border border-slate-300 text-sm md:text-base text-slate-900 font-medium focus:outline-none focus:ring-2 focus:ring-[#D4AF37] focus:border-[#0B1F3A] bg-white transition shadow-xs">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-800 mb-2">Bank Statement Availability</label>
                            <select name="has_bank_statement" x-model="form.has_bank_statement" class="w-full px-4 py-3.5 rounded-xl border border-slate-300 text-sm md:text-base text-slate-900 font-medium focus:outline-none focus:ring-2 focus:ring-[#D4AF37] focus:border-[#0B1F3A] bg-white transition shadow-xs">
                                <option value="yes">Yes, active 6-month statement with bank solvency available</option>
                                <option value="in_progress">Currently collecting statement from bank branch</option>
                                <option value="sponsored">Will use sponsor / company bank statement</option>
                            </select>
                        </div>
                    </div>

                    <div class="pt-6 flex justify-between items-center">
                        <button type="button" @click="prevStep()" class="btn btn-outline px-6 py-3 text-sm font-semibold">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                            <span>Back</span>
                        </button>
                        <button type="button" @click="nextStep()" class="btn btn-primary px-8 py-3.5 text-sm md:text-base font-bold shadow-md flex items-center gap-2">
                            <span>Next: Travel History</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </button>
                    </div>
                </div>

                <!-- STEP 6: Travel History & Refusals -->
                <div x-show="currentStep === 6" class="space-y-6">
                    <div>
                        <span class="text-xs font-bold text-[#D4AF37] uppercase tracking-wider block mb-1">Step 6 — Travel History</span>
                        <h2 class="text-2xl md:text-3xl font-bold font-heading text-[#0B1F3A]">Previous International Travel & Visa History</h2>
                        <p class="text-sm text-slate-600 mt-1">Accurate travel disclosure strengthens your dossier credibility before consular officers.</p>
                    </div>

                    <div class="p-6 rounded-[22px] bg-slate-50 border border-slate-200 space-y-4">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                            <div>
                                <label class="text-sm font-bold text-[#0B1F3A] block">Have you travelled internationally before? *</label>
                                <p class="text-xs text-slate-500 mt-0.5">Includes India, Nepal, Thailand, Malaysia, Middle East, etc.</p>
                            </div>
                            <div class="flex items-center gap-3">
                                <label class="px-4 py-2 rounded-xl border cursor-pointer transition flex items-center gap-2" :class="form.has_travelled === 'yes' ? 'bg-[#0B1F3A] text-white border-[#0B1F3A]' : 'bg-white text-slate-700 border-slate-300 hover:border-slate-400'">
                                    <input type="radio" name="has_travelled" value="yes" x-model="form.has_travelled" class="sr-only">
                                    <span class="text-xs font-bold">Yes, Travelled</span>
                                </label>
                                <label class="px-4 py-2 rounded-xl border cursor-pointer transition flex items-center gap-2" :class="form.has_travelled === 'no' ? 'bg-[#0B1F3A] text-white border-[#0B1F3A]' : 'bg-white text-slate-700 border-slate-300 hover:border-slate-400'">
                                    <input type="radio" name="has_travelled" value="no" x-model="form.has_travelled" class="sr-only">
                                    <span class="text-xs font-bold">No (1st Trip)</span>
                                </label>
                            </div>
                        </div>

                        <div x-show="form.has_travelled === 'yes'" class="pt-4 border-t border-slate-200">
                            <label class="block text-sm font-semibold text-slate-800 mb-2">Previous Countries Visited</label>
                            <input type="text" name="countries_visited" x-model="form.countries_visited" placeholder="e.g. India, Thailand, UAE, Malaysia, Singapore" class="w-full px-4 py-3 rounded-xl border border-slate-300 text-sm text-[#0B1F3A] bg-white">
                        </div>
                    </div>

                    <!-- Previous Visa Refusal Question (Transparent & Non-Disqualifying) -->
                    <div class="p-6 rounded-[22px] bg-slate-50 border border-slate-200 space-y-4">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                            <div>
                                <label class="text-sm font-bold text-[#0B1F3A] block">Have you ever had a visa refused or cancelled by any country? *</label>
                                <p class="text-xs text-slate-500 mt-0.5">Refusals are not automatic disqualifications. Disclosing allows our visa desk to prepare clarifying cover letters.</p>
                            </div>
                            <div class="flex items-center gap-3">
                                <label class="px-4 py-2 rounded-xl border cursor-pointer transition flex items-center gap-2" :class="form.has_visa_refusal === 'yes' ? 'bg-[#0B1F3A] text-white border-[#0B1F3A]' : 'bg-white text-slate-700 border-slate-300 hover:border-slate-400'">
                                    <input type="radio" name="has_visa_refusal" value="yes" x-model="form.has_visa_refusal" @change="refreshChecklist()" class="sr-only">
                                    <span class="text-xs font-bold">Yes</span>
                                </label>
                                <label class="px-4 py-2 rounded-xl border cursor-pointer transition flex items-center gap-2" :class="form.has_visa_refusal === 'no' ? 'bg-[#0B1F3A] text-white border-[#0B1F3A]' : 'bg-white text-slate-700 border-slate-300 hover:border-slate-400'">
                                    <input type="radio" name="has_visa_refusal" value="no" x-model="form.has_visa_refusal" @change="refreshChecklist()" class="sr-only">
                                    <span class="text-xs font-bold">No</span>
                                </label>
                            </div>
                        </div>

                        <div x-show="form.has_visa_refusal === 'yes'" class="pt-4 border-t border-slate-200 grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-xs md:text-sm font-semibold text-slate-700 mb-1.5">Country That Refused</label>
                                <input type="text" name="refusal_country" x-model="form.refusal_country" placeholder="e.g. UK, Canada, USA, Schengen" class="w-full px-4 py-3 rounded-xl border border-slate-300 text-sm text-[#0B1F3A] bg-white">
                            </div>
                            <div>
                                <label class="block text-xs md:text-sm font-semibold text-slate-700 mb-1.5">Approximate Year</label>
                                <input type="text" name="refusal_year" x-model="form.refusal_year" placeholder="e.g. 2023" class="w-full px-4 py-3 rounded-xl border border-slate-300 text-sm text-[#0B1F3A] bg-white">
                            </div>
                            <div>
                                <label class="block text-xs md:text-sm font-semibold text-slate-700 mb-1.5">Reason (if known)</label>
                                <input type="text" name="refusal_reason" x-model="form.refusal_reason" placeholder="e.g. Financial ties, missing document" class="w-full px-4 py-3 rounded-xl border border-slate-300 text-sm text-[#0B1F3A] bg-white">
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 flex justify-between items-center">
                        <button type="button" @click="prevStep()" class="btn btn-outline px-6 py-3 text-sm font-semibold">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                            <span>Back</span>
                        </button>
                        <button type="button" @click="nextStep()" class="btn btn-primary px-8 py-3.5 text-sm md:text-base font-bold shadow-md flex items-center gap-2">
                            <span>Next: Co-Travelers & Stay</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </button>
                    </div>
                </div>

                <!-- STEP 7: Co-Travelers & Accommodation -->
                <div x-show="currentStep === 7" class="space-y-6">
                    <div>
                        <span class="text-xs font-bold text-[#D4AF37] uppercase tracking-wider block mb-1">Step 7 — Co-Travelers & Stay</span>
                        <h2 class="text-2xl md:text-3xl font-bold font-heading text-[#0B1F3A]">Family / Co-Travelers & Accommodation</h2>
                        <p class="text-sm text-slate-600 mt-1">Add any family members or group members travelling together on the same itinerary.</p>
                    </div>

                    <!-- Co-Travelers Repeater -->
                    <div class="p-6 rounded-[22px] bg-slate-50 border border-slate-200 space-y-4">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                            <div>
                                <h4 class="font-bold text-sm text-[#0B1F3A]">Are you travelling with family or group?</h4>
                                <p class="text-xs text-slate-500 mt-0.5">Co-travelers share the same flight and hotel itinerary without redundant paperwork.</p>
                            </div>
                            <button type="button" @click="addCoTraveler()" class="px-4 py-2.5 bg-[#0B1F3A] text-[#D4AF37] font-bold rounded-xl text-xs md:text-sm hover:bg-[#071527] transition flex items-center gap-2 shadow-sm self-start sm:self-auto">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                <span>Add Co-Traveler</span>
                            </button>
                        </div>

                        <template x-for="(trav, idx) in form.co_travelers" :key="idx">
                            <div class="p-5 bg-white rounded-2xl border border-slate-200 space-y-3 relative shadow-xs">
                                <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                                    <span class="text-sm font-bold text-[#0B1F3A]" x-text="'Co-Traveler #' + (idx + 1)"></span>
                                    <button type="button" @click="removeCoTraveler(idx)" class="text-rose-600 hover:text-rose-800 text-xs font-bold flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        <span>Remove</span>
                                    </button>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-700 mb-1">Full Name</label>
                                        <input type="text" :name="'co_travelers['+idx+'][name]'" x-model="trav.name" placeholder="Full legal name" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm uppercase bg-white">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-700 mb-1">Relationship</label>
                                        <input type="text" :name="'co_travelers['+idx+'][relationship]'" x-model="trav.relationship" placeholder="Spouse, Child, Parent, Friend" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm bg-white">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-700 mb-1">Passport Number</label>
                                        <input type="text" :name="'co_travelers['+idx+'][passport]'" x-model="trav.passport" placeholder="Passport No." class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm font-mono uppercase bg-white">
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>

                    <!-- Accommodation Details -->
                    <div class="p-6 rounded-[22px] bg-slate-50 border border-slate-200 space-y-4">
                        <h4 class="font-bold text-sm text-[#0B1F3A] uppercase tracking-wider">Where will you stay?</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-xs md:text-sm font-semibold text-slate-700 mb-1.5">Accommodation Type</label>
                                <select name="accommodation_type" x-model="form.accommodation_type" class="w-full px-4 py-3 rounded-xl border border-slate-300 text-sm text-[#0B1F3A] bg-white">
                                    <option value="Hotel">Hotel / Resort Booking</option>
                                    <option value="Host">Family / Friend Host Residence</option>
                                    <option value="Provided by Emisha">Assisted by Emisha Tours (Voucher)</option>
                                    <option value="Other">Other Apartment / Airbnb</option>
                                </select>
                            </div>
                            <div class="md:col-span-2" x-show="form.accommodation_type === 'Hotel' || form.accommodation_type === 'Other'">
                                <label class="block text-xs md:text-sm font-semibold text-slate-700 mb-1.5">Hotel / Property Name & Address</label>
                                <input type="text" name="hotel_name" x-model="form.hotel_name" placeholder="e.g. Amari Watergate Hotel, Petchburi Rd, Bangkok" class="w-full px-4 py-3 rounded-xl border border-slate-300 text-sm text-[#0B1F3A] bg-white">
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 flex justify-between items-center">
                        <button type="button" @click="prevStep()" class="btn btn-outline px-6 py-3 text-sm font-semibold">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                            <span>Back</span>
                        </button>
                        <button type="button" @click="nextStep()" class="btn btn-primary px-8 py-3.5 text-sm md:text-base font-bold shadow-md flex items-center gap-2">
                            <span>Next: Document Checklist & Uploads</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </button>
                    </div>
                </div>

                <!-- STEP 8: Dynamic Document Engine (GDrive Link Primary, Direct Uploads Fallback & WhatsApp Helpline) -->
                <div x-show="currentStep === 8" class="space-y-6">
                    <div>
                        <span class="text-xs font-bold text-[#D4AF37] uppercase tracking-wider block mb-1">Step 8 — Document Submission Desk</span>
                        <h2 class="text-2xl md:text-3xl font-bold font-heading text-[#0B1F3A]">Submit Supporting Documents</h2>
                        <p class="text-sm text-slate-600 mt-1">
                            Upload your documents to Google Drive and paste the folder link below, or upload files directly.
                        </p>
                    </div>

                    <!-- Dedicated Visa WhatsApp & Direct Helpline Call Card -->
                    <div class="p-4 sm:p-5 rounded-2xl bg-gradient-to-r from-emerald-950 via-[#0B1F3A] to-[#040E1B] text-white border border-emerald-500/40 flex flex-col sm:flex-row sm:items-center justify-between gap-4 shadow-xl">
                        <div class="flex items-center gap-3.5">
                            <div class="w-11 h-11 rounded-2xl bg-emerald-500/20 text-emerald-400 border border-emerald-500/40 flex items-center justify-center flex-shrink-0 shadow-inner">
                                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                                </svg>
                            </div>
                            <div>
                                <span class="text-[10px] uppercase font-bold tracking-widest text-[#D4AF37] block">Dedicated Visa Helpline & Document Desk</span>
                                <h4 class="text-sm md:text-base font-bold text-white">Need Live Consultation or Prefer Sending Documents on WhatsApp?</h4>
                                <p class="text-xs text-slate-300 mt-0.5">
                                    Chat with or call our certified visa consultant: <strong class="text-emerald-400 font-mono font-bold tracking-wide">+880 1805-464294</strong>
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 flex-shrink-0">
                            <a :href="'https://wa.me/8801805464294?text=' + encodeURIComponent('Hello Emisha Visa Desk, I am applying for ' + (currentDestination?.name || 'Visa') + ' and would like assistance / want to send my documents directly on WhatsApp. Name: ' + (form.full_name || 'Applicant') + ', Phone: ' + (form.phone || ''))" 
                               target="_blank" 
                               class="px-3.5 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white font-bold rounded-xl text-xs transition flex items-center gap-1.5 shadow-md shadow-emerald-900/30">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                                <span>Send on WhatsApp</span>
                            </a>
                            <a href="tel:+8801805464294" class="px-3.5 py-2.5 bg-white/10 hover:bg-white/20 text-white font-bold rounded-xl text-xs transition flex items-center gap-1.5 border border-white/20">
                                <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                <span>Direct Call</span>
                            </a>
                        </div>
                    </div>

                    <!-- Submission Mode Switcher -->
                    <div class="flex flex-col sm:flex-row items-center gap-2 p-1.5 bg-slate-100 rounded-2xl border border-slate-200">
                        <button type="button" 
                                @click="docSubmissionMode = 'gdrive'" 
                                class="w-full sm:w-1/2 py-3 px-4 rounded-xl text-xs md:text-sm font-bold transition duration-200 flex items-center justify-center gap-2"
                                :class="docSubmissionMode === 'gdrive' ? 'bg-[#0B1F3A] text-white shadow-md' : 'text-slate-600 hover:text-slate-900'">
                            <svg class="w-4 h-4 text-[#D4AF37]" fill="currentColor" viewBox="0 0 24 24"><path d="M12.01 1.996L4.015 15.98h15.99L12.01 1.996zM4.015 15.98l4 6.994h15.99l-4-6.994H4.015zM12.01 1.996l4 6.994H.015l4-6.994h7.995z"/></svg>
                            <span>1. Google Drive Folder Link</span>
                            <span class="px-2 py-0.5 text-[9px] font-extrabold bg-[#D4AF37] text-[#0B1F3A] rounded shadow-xs">RECOMMENDED</span>
                        </button>
                        <button type="button" 
                                @click="docSubmissionMode = 'files'" 
                                class="w-full sm:w-1/2 py-3 px-4 rounded-xl text-xs md:text-sm font-bold transition duration-200 flex items-center justify-center gap-2"
                                :class="docSubmissionMode === 'files' ? 'bg-[#0B1F3A] text-white shadow-md' : 'text-slate-600 hover:text-slate-900'">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                            <span>2. Upload Individual Files Directly</span>
                        </button>
                    </div>

                    <!-- MODE 1: Google Drive Link (Primary & Recommended) -->
                    <div x-show="docSubmissionMode === 'gdrive'" class="space-y-4">
                        <div class="p-6 md:p-8 rounded-[24px] bg-gradient-to-br from-amber-50/40 via-white to-slate-50 border-2 border-[#D4AF37]/60 shadow-sm space-y-4">
                            <div class="flex items-start gap-3.5">
                                <div class="w-12 h-12 rounded-2xl bg-[#D4AF37]/20 text-[#0B1F3A] flex items-center justify-center flex-shrink-0 font-extrabold shadow-sm border border-[#D4AF37]/40">
                                    <svg class="w-6 h-6 text-[#0B1F3A]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                                </div>
                                <div class="flex-1">
                                    <label for="documents_drive_link_input" class="block text-base font-extrabold text-[#0B1F3A] mb-1">
                                        Paste Your Google Drive / OneDrive Folder Link
                                    </label>
                                    <p class="text-xs md:text-sm text-slate-600 leading-relaxed">
                                        Upload your required documents (Passport, Photo, Bank Statement, NOC, etc.) to a Google Drive folder and paste the sharing URL here.
                                    </p>
                                </div>
                            </div>

                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                    <svg class="w-5 h-5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                </div>
                                <input 
                                    type="url" 
                                    id="documents_drive_link_input"
                                    name="documents_drive_link" 
                                    x-model="form.documents_drive_link" 
                                    @input="triggerAutoSave()"
                                    placeholder="https://drive.google.com/drive/folders/your-folder-link?usp=sharing" 
                                    class="w-full pl-12 pr-4 py-3.5 md:py-4 rounded-2xl border-2 border-slate-300 focus:border-[#D4AF37] focus:ring-2 focus:ring-[#D4AF37]/30 text-sm md:text-base text-[#0B1F3A] font-medium bg-white transition shadow-inner"
                                >
                            </div>

                            <!-- Live Link Confirmation Banner -->
                            <template x-if="form.documents_drive_link && form.documents_drive_link.includes('http')">
                                <div class="p-3.5 bg-emerald-50 border border-emerald-300 rounded-xl text-xs md:text-sm text-emerald-800 font-bold flex items-center gap-2">
                                    <svg class="w-4 h-4 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                    <span>Google Drive Dossier URL attached! Our visa specialists will audit the contents upon submission.</span>
                                </div>
                            </template>

                            <!-- 4-Step Google Drive Sharing Guide -->
                            <div class="p-4 sm:p-5 bg-slate-100/90 rounded-2xl border border-slate-200 text-xs text-slate-700 space-y-2.5">
                                <strong class="font-bold text-[#0B1F3A] block uppercase tracking-wider text-[11px] flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <span>Quick 4-step guide to share your Google Drive link:</span>
                                </strong>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 text-slate-600">
                                    <div class="flex items-start gap-2 bg-white p-2.5 rounded-xl border border-slate-200">
                                        <span class="w-5 h-5 rounded-full bg-[#0B1F3A] text-white flex items-center justify-center font-bold text-[10px] flex-shrink-0 mt-0.5">1</span>
                                        <span>Create a folder in Google Drive (e.g. <em>Visa Docs - [Your Name]</em>).</span>
                                    </div>
                                    <div class="flex items-start gap-2 bg-white p-2.5 rounded-xl border border-slate-200">
                                        <span class="w-5 h-5 rounded-full bg-[#0B1F3A] text-white flex items-center justify-center font-bold text-[10px] flex-shrink-0 mt-0.5">2</span>
                                        <span>Upload your Passport, Photo, Solvency & required checklist files.</span>
                                    </div>
                                    <div class="flex items-start gap-2 bg-white p-2.5 rounded-xl border border-slate-200">
                                        <span class="w-5 h-5 rounded-full bg-[#0B1F3A] text-white flex items-center justify-center font-bold text-[10px] flex-shrink-0 mt-0.5">3</span>
                                        <span>Click <strong>Share</strong> & change General Access to <strong>"Anyone with the link (Viewer)"</strong>.</span>
                                    </div>
                                    <div class="flex items-start gap-2 bg-white p-2.5 rounded-xl border border-slate-200">
                                        <span class="w-5 h-5 rounded-full bg-[#0B1F3A] text-white flex items-center justify-center font-bold text-[10px] flex-shrink-0 mt-0.5">4</span>
                                        <span>Click <strong>Copy Link</strong> and paste it into the box above.</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Required Checklist Overview -->
                        <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200 space-y-3">
                            <h4 class="font-bold text-xs uppercase tracking-wider text-[#0B1F3A] flex items-center gap-2">
                                <svg class="w-4 h-4 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                <span>Checklist to include in your Google Drive folder:</span>
                            </h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs">
                                <template x-for="(doc, code) in activeChecklist" :key="code">
                                    <div class="flex items-center gap-2 p-2.5 bg-white rounded-xl border border-slate-200">
                                        <span class="w-2 h-2 rounded-full" :class="doc.required ? 'bg-rose-500' : 'bg-slate-400'"></span>
                                        <span class="font-bold text-slate-800 truncate" x-text="doc.name"></span>
                                        <span class="text-[10px] font-bold text-slate-400 ml-auto" x-text="doc.required ? 'Mandatory' : 'Optional'"></span>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>

                    <!-- MODE 2: Individual File Uploads (Strict Rate-Limiting, Cooldown Timer & Anti-Junk Protection) -->
                    <div x-show="docSubmissionMode === 'files'" class="space-y-5">
                        
                        <!-- Upload Security & 3-Attempt Rate Limit Quota Header -->
                        <div class="p-5 md:p-6 rounded-[24px] bg-gradient-to-br from-[#0B1F3A] via-[#0E2646] to-[#071527] text-white border border-[#D4AF37]/30 shadow-xl space-y-4">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-3 border-b border-white/10">
                                <div>
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="w-2.5 h-2.5 rounded-full" :class="uploadQuota.max_reached ? 'bg-rose-500' : (uploadQuota.is_cooldown ? 'bg-amber-400 animate-ping' : 'bg-emerald-400')"></span>
                                        <span class="text-[10.5px] uppercase font-extrabold tracking-widest text-[#D4AF37]">Secure Cloud Storage & Anti-Spam Quota</span>
                                    </div>
                                    <h4 class="text-base md:text-lg font-bold text-white">Custom File Upload Quota: <span class="text-[#D4AF37]" x-text="uploadQuota.attempts"></span> of 3 Attempts Used</h4>
                                </div>
                                <div class="flex items-center gap-1.5 self-start sm:self-auto">
                                    <template x-for="i in 3" :key="i">
                                        <div class="w-7 h-7 rounded-lg flex items-center justify-center font-extrabold text-xs border"
                                             :class="i <= uploadQuota.attempts ? 'bg-[#D4AF37] text-[#0B1F3A] border-[#D4AF37]' : 'bg-white/10 text-white/60 border-white/20'"
                                             x-text="i">
                                        </div>
                                    </template>
                                </div>
                            </div>

                            <!-- ACTIVE COOLDOWN COUNTDOWN BANNER (1st Upload -> 5 min, 2nd Upload -> 1 hr) -->
                            <template x-if="uploadQuota.is_cooldown && uploadQuota.remaining_seconds > 0">
                                <div class="p-4 rounded-2xl bg-amber-500/15 border-2 border-amber-400/70 text-amber-200 space-y-3 shadow-inner">
                                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                        <div class="flex items-center gap-3">
                                            <div class="w-12 h-12 rounded-xl bg-amber-400 text-[#0B1F3A] flex items-center justify-center font-black flex-shrink-0 shadow-md">
                                                <svg class="w-6 h-6 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            </div>
                                            <div>
                                                <span class="text-[10px] uppercase font-extrabold tracking-wider text-amber-300 block">Security Cooldown Active</span>
                                                <h5 class="text-sm font-bold text-white">পরবর্তী ফাইল আপলোড করতে অপেক্ষা করুন</h5>
                                            </div>
                                        </div>
                                        <div class="text-center sm:text-right bg-[#0B1F3A]/80 px-4 py-2 rounded-xl border border-amber-400/40">
                                            <span class="text-[10px] uppercase font-bold text-amber-300 block">Time Remaining</span>
                                            <span class="text-xl md:text-2xl font-black font-mono tracking-widest text-[#D4AF37]" x-text="formattedCooldownTimer || '05:00'"></span>
                                        </div>
                                    </div>

                                    <!-- FAST FORWARD NOTICE WITH DIRECT WHATSAPP ACTION -->
                                    <div class="pt-3 border-t border-amber-400/30 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs">
                                        <div class="flex items-start gap-2 text-amber-100">
                                            <svg class="w-4 h-4 text-[#D4AF37] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                            <span>যদি ফাস্ট ফরোয়ার্ড করতে চান অথবা কোনো অপেক্ষা ছাড়াই ফাইল জমা দিতে চান, তবে আমাদের অফিসিয়াল হোয়াটসঅ্যাপে যোগাযোগ করুন:</span>
                                        </div>
                                        <div class="flex items-center gap-2 flex-shrink-0">
                                            <a :href="'https://wa.me/8801805464294?text=' + encodeURIComponent('Hello Emisha Visa Desk, I want to fast-forward my visa document upload. Name: ' + (form.full_name || 'Applicant') + ', Phone: ' + (form.phone || ''))" 
                                               target="_blank" 
                                               class="px-3.5 py-2 bg-emerald-600 hover:bg-emerald-500 text-white font-bold rounded-xl text-xs transition flex items-center gap-1.5 shadow-md">
                                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                                                <span>Fast-Forward on WhatsApp (+8801805464294)</span>
                                            </a>
                                            <a href="tel:+8801805464294" class="px-3 py-2 bg-white/10 hover:bg-white/20 text-white font-bold rounded-xl text-xs transition border border-white/20 flex items-center gap-1.5">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                                <span>Call Desk</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </template>

                            <!-- MAXIMUM ATTEMPTS REACHED (3 of 3) BANNER -->
                            <template x-if="uploadQuota.max_reached">
                                <div class="p-4 rounded-2xl bg-rose-500/20 border-2 border-rose-500/60 text-rose-200 space-y-3">
                                    <div class="flex items-start gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-rose-500 text-white flex items-center justify-center font-bold flex-shrink-0">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                        </div>
                                        <div>
                                            <h5 class="text-sm font-bold text-white">সর্বোচ্চ আপলোড সীমা (৩ বার) পূর্ণ হয়েছে</h5>
                                            <p class="text-xs text-rose-200 leading-relaxed mt-0.5">
                                                কাস্টম ফাইল আপলোডের সর্বোচ্চ ৩টি সুযোগ শেষ হয়েছে। অতিরিক্ত ফাইল পাঠাতে Google Drive ফোল্ডার লিংক ব্যবহার করুন অথবা সরাসরি আমাদের অফিসিয়াল হোয়াটসঅ্যাপে ফাইল সেন্ড করুন।
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap gap-2 pt-2 border-t border-rose-400/30">
                                        <button type="button" @click="docSubmissionMode = 'gdrive'" class="px-3.5 py-2 bg-[#D4AF37] text-[#0B1F3A] font-bold rounded-xl text-xs hover:brightness-110 transition shadow-sm flex items-center gap-1.5">
                                            <svg class="w-4 h-4 text-[#0B1F3A]" fill="currentColor" viewBox="0 0 24 24"><path d="M12.01 1.996L4.015 15.98h15.99L12.01 1.996zM4.015 15.98l4 6.994h15.99l-4-6.994H4.015zM12.01 1.996l4 6.994H.015l4-6.994h7.995z"/></svg>
                                            <span>Switch to Google Drive Link</span>
                                        </button>
                                        <a :href="'https://wa.me/8801805464294?text=' + encodeURIComponent('Hello Emisha Visa Desk, I have used my 3 file uploads and wish to send additional files directly on WhatsApp. Name: ' + (form.full_name || 'Applicant'))" 
                                           target="_blank" 
                                           class="px-3.5 py-2 bg-emerald-600 hover:bg-emerald-500 text-white font-bold rounded-xl text-xs transition flex items-center gap-1.5">
                                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                                            <span>Send via WhatsApp (+8801805464294)</span>
                                        </a>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <!-- Upload Progress Counter Banner -->
                        <div class="p-5 md:p-6 rounded-[22px] bg-slate-900 text-white flex flex-col sm:flex-row sm:items-center justify-between gap-4 shadow-lg">
                            <div class="flex items-center gap-3.5">
                                <div class="w-12 h-12 rounded-2xl bg-[#D4AF37] text-[#0B1F3A] flex items-center justify-center font-extrabold text-base flex-shrink-0 shadow-sm">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-base md:text-lg text-white">
                                        <span x-text="uploadedCount"></span> of <span x-text="requiredDocsCount"></span> Required Documents Attached
                                    </h4>
                                    <p class="text-xs md:text-sm text-white/75 mt-0.5">
                                        <span x-text="remainingCount > 0 ? remainingCount + ' mandatory documents remaining for review' : 'All mandatory documents attached!'"></span>
                                    </p>
                                </div>
                            </div>
                            <div class="text-xs md:text-sm text-emerald-300 font-semibold flex items-center gap-2 self-start sm:self-auto bg-white/10 px-4 py-2 rounded-xl backdrop-blur-sm">
                                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                <span>Private Encrypted Storage</span>
                            </div>
                        </div>

                        <!-- Dynamic Checklist Cards with Strict File Size Validation -->
                        <div class="space-y-4">
                            <template x-for="(doc, code) in activeChecklist" :key="code">
                                <div class="p-5 md:p-6 rounded-[22px] border transition-all" :class="uploadedFiles[code] ? 'bg-emerald-50/50 border-emerald-300 ring-1 ring-emerald-200' : 'bg-slate-50/60 border-slate-200 hover:border-[#D4AF37]/60'">
                                    <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-3 mb-3">
                                        <div>
                                            <div class="flex flex-wrap items-center gap-2 mb-1.5">
                                                <span class="font-bold text-base text-[#0B1F3A]" x-text="doc.name"></span>
                                                <template x-if="doc.required">
                                                    <span class="text-xs font-bold bg-rose-100 text-rose-800 px-2.5 py-0.5 rounded-full">Required</span>
                                                </template>
                                                <template x-if="!doc.required">
                                                    <span class="text-xs font-semibold bg-slate-200 text-slate-700 px-2.5 py-0.5 rounded-full">Optional</span>
                                                </template>
                                                <template x-if="doc.is_conditional">
                                                    <span class="text-xs font-semibold bg-amber-100 text-amber-800 px-2.5 py-0.5 rounded-full" x-text="doc.condition_reason"></span>
                                                </template>
                                            </div>
                                            <p class="text-xs md:text-sm text-slate-600 max-w-2xl leading-relaxed" x-text="doc.description"></p>
                                        </div>
                                        <div class="flex items-center gap-2 flex-shrink-0">
                                            <span class="text-xs font-bold px-3 py-1 rounded-lg border shadow-xs"
                                                  :class="doc.max_size_mb <= 5 ? 'bg-amber-50 text-amber-900 border-amber-200' : 'bg-white text-slate-700 border-slate-200'"
                                                  x-text="doc.accepted_types + ' • Max ' + doc.max_size_mb + 'MB'">
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Upload Input / Uploaded State with Cooldown Blocking Check -->
                                    <div class="pt-3.5 border-t border-slate-200/80 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                        <div class="flex-grow">
                                            <input 
                                                type="file" 
                                                :name="code" 
                                                :id="'file_' + code" 
                                                :disabled="uploadQuota.is_blocked"
                                                @change="handleFileUpload($event, code)" 
                                                :accept="doc.accepted_types ? doc.accepted_types.split(', ').map(t => '.' + t.toLowerCase()).join(',') : '*'"
                                                class="block w-full text-xs md:text-sm text-slate-600 file:mr-4 file:py-2.5 file:px-5 file:rounded-xl file:border-0 file:text-xs md:file:text-sm file:font-bold file:bg-[#0B1F3A] file:text-[#D4AF37] hover:file:bg-[#071527] cursor-pointer transition disabled:opacity-50 disabled:cursor-not-allowed"
                                            >
                                        </div>

                                        <template x-if="uploadedFiles[code]">
                                            <div class="flex items-center gap-2 text-xs md:text-sm text-emerald-800 font-bold bg-emerald-100/90 px-3.5 py-2 rounded-xl flex-shrink-0">
                                                <svg class="w-4 h-4 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                                <span class="truncate max-w-[180px]" x-text="uploadedFiles[code]"></span>
                                                <span class="text-[10.5px] text-emerald-700 bg-white/70 px-1.5 py-0.5 rounded font-mono" x-text="uploadedFileSizes[code] || ''"></span>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    <div class="pt-6 flex justify-between items-center">
                        <button type="button" @click="prevStep()" class="btn btn-outline px-6 py-3 text-sm font-semibold">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                            <span>Back</span>
                        </button>
                        <button type="button" @click="nextStep()" class="btn btn-primary px-8 py-3.5 text-sm md:text-base font-bold shadow-md flex items-center gap-2">
                            <span>Next: Application Review</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </button>
                    </div>
                </div>

                <!-- STEP 9: Application Review (Section-by-Section with Edit Actions) -->
                <div x-show="currentStep === 9" class="space-y-6">
                    <div>
                        <span class="text-xs font-bold text-[#D4AF37] uppercase tracking-wider block mb-1">Step 9 — Application Review</span>
                        <h2 class="text-2xl md:text-3xl font-bold font-heading text-[#0B1F3A]">Review Your Dossier Before Submission</h2>
                        <p class="text-sm text-slate-600 mt-1">Please verify all entered details. You can click "Edit" on any section without restarting.</p>
                    </div>

                    <div class="space-y-4">
                        <!-- 1. Destination & Service Route -->
                        <div class="p-6 rounded-[22px] bg-slate-50 border border-slate-200">
                            <div class="flex items-center justify-between pb-3 mb-3 border-b border-slate-200/80">
                                <h4 class="font-bold text-sm text-[#0B1F3A] uppercase tracking-wider flex items-center gap-2">
                                    <span class="text-xl" x-text="currentDestination?.flag"></span>
                                    <span>Destination & Route</span>
                                </h4>
                                <button type="button" @click="goToStep(1)" class="text-xs font-bold text-[#D4AF37] hover:underline px-3 py-1 bg-white rounded-lg border border-slate-200 shadow-xs">Edit Section</button>
                            </div>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-xs md:text-sm">
                                <div><span class="text-slate-500 block text-xs">Country</span><strong class="text-slate-900 font-bold" x-text="currentDestination?.name"></strong></div>
                                <div><span class="text-slate-500 block text-xs">Category</span><strong class="text-slate-900 font-bold" x-text="currentDestination?.visa_category"></strong></div>
                                <div><span class="text-slate-500 block text-xs">Processing</span><strong class="text-slate-900 font-bold" x-text="currentDestination?.processing_time"></strong></div>
                                <div><span class="text-slate-500 block text-xs">Service Fee</span><strong class="text-emerald-700 font-extrabold text-sm md:text-base" x-text="'৳ ' + Number(currentDestination?.service_fee).toLocaleString('en-US')"></strong></div>
                            </div>
                        </div>

                        <!-- 2. Applicant Profile -->
                        <div class="p-6 rounded-[22px] bg-slate-50 border border-slate-200">
                            <div class="flex items-center justify-between pb-3 mb-3 border-b border-slate-200/80">
                                <h4 class="font-bold text-sm text-[#0B1F3A] uppercase tracking-wider">Applicant Personal Details</h4>
                                <button type="button" @click="goToStep(2)" class="text-xs font-bold text-[#D4AF37] hover:underline px-3 py-1 bg-white rounded-lg border border-slate-200 shadow-xs">Edit Section</button>
                            </div>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-xs md:text-sm">
                                <div><span class="text-slate-500 block text-xs">Full Name</span><strong class="text-slate-900 font-bold" x-text="form.full_name || 'N/A'"></strong></div>
                                <div><span class="text-slate-500 block text-xs">Email</span><span class="text-slate-800 font-medium" x-text="form.email || 'N/A'"></span></div>
                                <div><span class="text-slate-500 block text-xs">Phone</span><span class="text-slate-800 font-medium" x-text="form.phone || 'N/A'"></span></div>
                                <div><span class="text-slate-500 block text-xs">Date of Birth</span><span class="text-slate-800 font-medium" x-text="form.date_of_birth || 'N/A'"></span></div>
                            </div>
                        </div>

                        <!-- 3. Passport Details -->
                        <div class="p-6 rounded-[22px] bg-slate-50 border border-slate-200">
                            <div class="flex items-center justify-between pb-3 mb-3 border-b border-slate-200/80">
                                <h4 class="font-bold text-sm text-[#0B1F3A] uppercase tracking-wider">Passport Identification</h4>
                                <button type="button" @click="goToStep(3)" class="text-xs font-bold text-[#D4AF37] hover:underline px-3 py-1 bg-white rounded-lg border border-slate-200 shadow-xs">Edit Section</button>
                            </div>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-xs md:text-sm">
                                <div><span class="text-slate-500 block text-xs">Passport No.</span><strong class="font-mono text-slate-900 font-bold" x-text="form.passport_number || 'N/A'"></strong></div>
                                <div><span class="text-slate-500 block text-xs">Type</span><span class="text-slate-800 font-medium" x-text="form.passport_type"></span></div>
                                <div><span class="text-slate-500 block text-xs">Expiry Date</span><span class="text-slate-800 font-medium" x-text="form.passport_expiry_date || 'N/A'"></span></div>
                                <div><span class="text-slate-500 block text-xs">Issuing Country</span><span class="text-slate-800 font-medium" x-text="form.passport_issuing_country"></span></div>
                            </div>
                        </div>

                        <!-- 4. Travel & Schengen -->
                        <div class="p-6 rounded-[22px] bg-slate-50 border border-slate-200">
                            <div class="flex items-center justify-between pb-3 mb-3 border-b border-slate-200/80">
                                <h4 class="font-bold text-sm text-[#0B1F3A] uppercase tracking-wider">Travel Itinerary & Purpose</h4>
                                <button type="button" @click="goToStep(4)" class="text-xs font-bold text-[#D4AF37] hover:underline px-3 py-1 bg-white rounded-lg border border-slate-200 shadow-xs">Edit Section</button>
                            </div>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-xs md:text-sm">
                                <div><span class="text-slate-500 block text-xs">Purpose</span><strong class="text-slate-900 font-bold" x-text="form.travel_purpose"></strong></div>
                                <div><span class="text-slate-500 block text-xs">Departure Date</span><span class="text-slate-800 font-medium" x-text="form.travel_date || 'N/A'"></span></div>
                                <div><span class="text-slate-500 block text-xs">Return Date</span><span class="text-slate-800 font-medium" x-text="form.return_date || 'N/A'"></span></div>
                                <div><span class="text-slate-500 block text-xs">Cities</span><span class="text-slate-800 font-medium" x-text="form.cities_to_visit || 'Standard Tourist Route'"></span></div>
                            </div>
                        </div>

                        <!-- 5. Employment & Funding -->
                        <div class="p-6 rounded-[22px] bg-slate-50 border border-slate-200">
                            <div class="flex items-center justify-between pb-3 mb-3 border-b border-slate-200/80">
                                <h4 class="font-bold text-sm text-[#0B1F3A] uppercase tracking-wider">Employment & Financial Profile</h4>
                                <button type="button" @click="goToStep(5)" class="text-xs font-bold text-[#D4AF37] hover:underline px-3 py-1 bg-white rounded-lg border border-slate-200 shadow-xs">Edit Section</button>
                            </div>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-xs md:text-sm">
                                <div><span class="text-slate-500 block text-xs">Occupation</span><strong class="text-slate-900 font-bold" x-text="form.employment_status"></strong></div>
                                <div><span class="text-slate-500 block text-xs">Employer / Organization</span><span class="text-slate-800 font-medium" x-text="form.employer_name || form.business_name || form.institution_name || 'N/A'"></span></div>
                                <div><span class="text-slate-500 block text-xs">Trip Funding</span><span class="text-slate-800 font-medium" x-text="form.funding_source"></span></div>
                                <div><span class="text-slate-500 block text-xs">Monthly Income</span><span class="text-slate-800 font-medium" x-text="form.monthly_income || 'N/A'"></span></div>
                            </div>
                        </div>

                        <!-- 6. Uploaded Documents Summary / Google Drive / WhatsApp Alternative -->
                        <div class="p-6 rounded-[22px] bg-slate-50 border border-slate-200 space-y-3">
                            <div class="flex items-center justify-between pb-3 border-b border-slate-200/80">
                                <h4 class="font-bold text-sm text-[#0B1F3A] uppercase tracking-wider flex items-center gap-2">
                                    <svg class="w-4 h-4 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    <span>Supporting Documents Dossier</span>
                                </h4>
                                <button type="button" @click="goToStep(8)" class="text-xs font-bold text-[#D4AF37] hover:underline px-3 py-1 bg-white rounded-lg border border-slate-200 shadow-xs">Manage Documents</button>
                            </div>

                            <!-- Case 1: Google Drive Link Provided -->
                            <template x-if="form.documents_drive_link && form.documents_drive_link.trim() !== ''">
                                <div class="p-4 rounded-xl bg-gradient-to-r from-emerald-50 via-amber-50/40 to-white border border-emerald-300 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                    <div class="flex items-center gap-3 min-w-0">
                                        <div class="w-10 h-10 rounded-xl bg-[#0B1F3A] text-[#D4AF37] flex items-center justify-center flex-shrink-0 shadow-xs">
                                            <svg class="w-5 h-5 text-[#D4AF37]" fill="currentColor" viewBox="0 0 24 24"><path d="M12.01 1.996L4.015 15.98h15.99L12.01 1.996zM4.015 15.98l4 6.994h15.99l-4-6.994H4.015zM12.01 1.996l4 6.994H.015l4-6.994h7.995z"/></svg>
                                        </div>
                                        <div class="min-w-0">
                                            <span class="text-[10px] uppercase font-bold text-emerald-800 tracking-wider block">Google Drive Dossier Attached</span>
                                            <a :href="form.documents_drive_link" target="_blank" class="text-xs md:text-sm font-bold text-[#0B1F3A] hover:text-blue-700 hover:underline truncate block" x-text="form.documents_drive_link"></a>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2 flex-shrink-0">
                                        <a :href="form.documents_drive_link" target="_blank" class="px-3 py-1.5 bg-[#0B1F3A] text-[#D4AF37] hover:bg-[#071527] font-bold rounded-lg text-xs transition flex items-center gap-1 shadow-xs">
                                            <span>Open Folder</span>
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                        </a>
                                        <button type="button" @click="goToStep(8)" class="px-2.5 py-1.5 bg-white border border-slate-300 text-slate-700 font-bold rounded-lg text-xs hover:bg-slate-50">
                                            Edit Link
                                        </button>
                                    </div>
                                </div>
                            </template>

                            <!-- Case 2: Individual Files Uploaded -->
                            <template x-if="Object.keys(uploadedFiles).length > 0">
                                <div class="space-y-2">
                                    <span class="text-xs font-bold text-slate-600 block">Uploaded Files (<span x-text="Object.keys(uploadedFiles).length"></span>):</span>
                                    <div class="flex flex-wrap gap-2 text-xs">
                                        <template x-for="(fName, code) in uploadedFiles" :key="code">
                                            <span class="px-3 py-1.5 bg-white border border-slate-200 rounded-xl font-medium text-slate-700 flex items-center gap-2 shadow-xs">
                                                <svg class="w-3.5 h-3.5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                <span class="font-bold text-slate-800" x-text="activeChecklist[code]?.name || code"></span>
                                                <span class="text-slate-400 font-normal truncate max-w-[140px]" x-text="'(' + fName + ')'"></span>
                                            </span>
                                        </template>
                                    </div>
                                </div>
                            </template>

                            <!-- Case 3: Neither GDrive Link nor Direct Files Attached (Fallback Options & WhatsApp Support) -->
                            <template x-if="(!form.documents_drive_link || form.documents_drive_link.trim() === '') && Object.keys(uploadedFiles).length === 0">
                                <div class="p-4 rounded-xl bg-amber-50/90 border border-amber-200/90 text-amber-950 space-y-3">
                                    <div class="flex items-start gap-2.5">
                                        <div class="w-8 h-8 rounded-lg bg-amber-200 text-amber-900 flex items-center justify-center font-bold flex-shrink-0 mt-0.5">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                        </div>
                                        <div>
                                            <strong class="text-xs md:text-sm font-bold block text-amber-950">No documents attached yet</strong>
                                            <p class="text-xs text-amber-900/90 leading-relaxed mt-0.5">
                                                You can still submit now! Provide your Google Drive folder link, upload files directly, or send them over WhatsApp / hand them over to our Mirpur office during consultation.
                                            </p>
                                        </div>
                                    </div>

                                    <div class="flex flex-wrap items-center gap-2 pt-2 border-t border-amber-200">
                                        <button type="button" @click="goToStep(8); docSubmissionMode = 'gdrive'" class="px-3 py-1.5 bg-[#0B1F3A] text-[#D4AF37] font-bold rounded-lg text-xs hover:bg-[#071527] transition flex items-center gap-1.5 shadow-xs">
                                            <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="currentColor" viewBox="0 0 24 24"><path d="M12.01 1.996L4.015 15.98h15.99L12.01 1.996zM4.015 15.98l4 6.994h15.99l-4-6.994H4.015zM12.01 1.996l4 6.994H.015l4-6.994h7.995z"/></svg>
                                            <span>Add Google Drive Link</span>
                                        </button>
                                        <button type="button" @click="goToStep(8); docSubmissionMode = 'files'" class="px-3 py-1.5 bg-white border border-slate-300 text-slate-800 font-bold rounded-lg text-xs hover:bg-slate-50 transition flex items-center gap-1.5">
                                            <svg class="w-3.5 h-3.5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                                            <span>Upload Files Directly</span>
                                        </button>
                                        <a :href="'https://wa.me/8801805464294?text=' + encodeURIComponent('Hello Emisha Visa Desk, I am completing my visa application and wish to send my documents on WhatsApp. Name: ' + (form.full_name || 'Applicant'))" 
                                           target="_blank" 
                                           class="px-3 py-1.5 bg-emerald-600 hover:bg-emerald-500 text-white font-bold rounded-lg text-xs transition flex items-center gap-1.5 shadow-xs">
                                            <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                                            <span>Send via WhatsApp (+8801805464294)</span>
                                        </a>
                                        <a href="tel:+8801805464294" class="px-3 py-1.5 bg-white border border-amber-300 text-amber-950 font-bold rounded-lg text-xs hover:bg-amber-100 transition flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                            <span>Direct Call</span>
                                        </a>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- Additional Applicant Notes -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-800 mb-2">Additional Notes / Instructions for Visa Specialist (Optional)</label>
                        <textarea name="applicant_notes" x-model="form.applicant_notes" rows="3" placeholder="Mention any specific appointment preference, urgent travel schedule, or previous visa particulars..." class="w-full px-4 py-3.5 rounded-xl border border-slate-300 text-sm md:text-base text-[#0B1F3A] bg-white"></textarea>
                    </div>

                    <div class="pt-6 flex justify-between items-center">
                        <button type="button" @click="prevStep()" class="btn btn-outline px-6 py-3 text-sm font-semibold">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                            <span>Back</span>
                        </button>
                        <button type="button" @click="nextStep()" class="btn btn-primary px-8 py-3.5 text-sm md:text-base font-bold shadow-md flex items-center gap-2">
                            <span>Next: Pricing & Payment Method</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </button>
                    </div>
                </div>

                <!-- STEP 10: Pricing, Payment Simulation & Final Submission -->
                <div x-show="currentStep === 10" class="space-y-6">
                    <div>
                        <span class="text-xs font-bold text-[#D4AF37] uppercase tracking-wider block mb-1">Step 10 — Transparent Pricing & Payment</span>
                        <h2 class="text-2xl md:text-3xl font-bold font-heading text-[#0B1F3A]">Fee Breakdown & Final Confirmation</h2>
                        <p class="text-sm text-slate-600 mt-1">100% transparent pricing with certified visa audit and file management.</p>
                    </div>

                    <!-- Pricing Breakdown Card -->
                    <div class="p-6 md:p-8 rounded-[24px] bg-[#0B1F3A] text-white space-y-4 shadow-xl">
                        <h3 class="font-bold text-base text-[#D4AF37] uppercase tracking-wider pb-3 border-b border-white/10 flex items-center justify-between">
                            <span>Service Pricing Summary</span>
                            <span class="text-xs md:text-sm text-white/80" x-text="currentDestination?.name + ' Tourist Visa'"></span>
                        </h3>

                        <div class="space-y-3.5 text-sm">
                            <div class="flex justify-between items-center text-white/90">
                                <span class="text-sm md:text-base font-medium">Our Professional Service Fee:</span>
                                <span class="font-bold text-lg md:text-xl text-white">৳ <span x-text="Number(currentDestination?.service_fee).toLocaleString('en-US')"></span></span>
                            </div>

                            <div class="flex flex-col sm:flex-row sm:items-center justify-between text-white/70 pt-3 border-t border-white/10 gap-2">
                                <div>
                                    <span class="block text-white/90 font-medium text-xs md:text-sm">Government / Embassy Visa Fee:</span>
                                    <span class="text-xs text-amber-300 italic" x-text="currentDestination?.govt_fee_note"></span>
                                </div>
                                <span class="font-bold text-xs text-white/80 bg-white/10 px-3 py-1.5 rounded-lg self-start sm:self-auto">Payable at Embassy / Official Center</span>
                            </div>

                            <div class="pt-4 border-t border-white/20 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                <div>
                                    <span class="text-xs md:text-sm uppercase font-extrabold text-[#D4AF37] tracking-wider block">Total Service Fee Payable:</span>
                                    <span class="text-xs text-white/60">Includes full file scrutiny, form filing & appointment support</span>
                                </div>
                                <div class="sm:text-right">
                                    <span class="text-2xl md:text-3xl font-extrabold text-[#D4AF37]">
                                        ৳ <span x-text="Number(currentDestination?.service_fee).toLocaleString('en-US')"></span>
                                    </span>
                                    <span class="text-xs text-white/60 block">BDT (Taka)</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method Simulation Options -->
                    <div class="p-6 rounded-[22px] bg-slate-50 border border-slate-200 space-y-4">
                        <h4 class="font-bold text-sm text-[#0B1F3A] uppercase tracking-wider">Select Preferred Payment Option</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <label class="p-5 rounded-2xl border-2 cursor-pointer transition flex items-start gap-3.5" :class="form.payment_method === 'bkash_online' ? 'border-[#D4AF37] bg-white ring-2 ring-[#D4AF37]/30 shadow-sm' : 'border-slate-200 bg-white hover:border-slate-300'">
                                <input type="radio" name="payment_method" value="bkash_online" x-model="form.payment_method" class="mt-1 text-[#0B1F3A] focus:ring-[#D4AF37] w-4 h-4">
                                <div>
                                    <strong class="text-sm md:text-base font-bold text-[#0B1F3A] block">bKash / Nagad / Visa / Mastercard</strong>
                                    <p class="text-xs text-slate-500 mt-0.5">Instant digital checkout & immediate dossier creation.</p>
                                </div>
                            </label>

                            <label class="p-5 rounded-2xl border-2 cursor-pointer transition flex items-start gap-3.5" :class="form.payment_method === 'pay_at_desk' ? 'border-[#D4AF37] bg-white ring-2 ring-[#D4AF37]/30 shadow-sm' : 'border-slate-200 bg-white hover:border-slate-300'">
                                <input type="radio" name="payment_method" value="pay_at_desk" x-model="form.payment_method" class="mt-1 text-[#0B1F3A] focus:ring-[#D4AF37] w-4 h-4">
                                <div>
                                    <strong class="text-sm md:text-base font-bold text-[#0B1F3A] block">Pay at Desk / Office Consultation</strong>
                                    <p class="text-xs text-slate-500 mt-0.5">Pay cash/card at our Mirpur visa desk during document handover.</p>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Declaration & Disclaimer -->
                    <div class="p-5 rounded-2xl bg-amber-50/80 border border-amber-200 text-xs md:text-sm text-amber-950 space-y-2">
                        <div class="flex items-center gap-2 font-bold text-sm text-amber-950">
                            <svg class="w-5 h-5 text-amber-700 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>Applicant Declaration & Legal Notice</span>
                        </div>
                        <p class="leading-relaxed">1. I confirm that all information provided is accurate and authentic as per official government records.</p>
                        <p class="leading-relaxed">2. I acknowledge that our service fee covers application consultation, verification, and file management. Official visa grant decisions remain under the absolute jurisdiction of the respective Embassy / Immigration Authority.</p>
                    </div>

                    <div class="pt-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <button type="button" @click="prevStep()" class="btn btn-outline px-6 py-3 text-sm font-semibold">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                            <span>Back</span>
                        </button>
                        <button 
                            type="submit" 
                            :disabled="isSubmitting"
                            class="btn btn-gold btn-lg font-extrabold shadow-2xl px-10 py-4 text-sm md:text-base uppercase tracking-wider flex items-center justify-center gap-2 transition"
                        >
                            <template x-if="!isSubmitting">
                                <span class="flex items-center gap-2">
                                    <span>Submit Application & Generate Dossier</span>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                </span>
                            </template>
                            <template x-if="isSubmitting">
                                <span class="flex items-center gap-2">
                                    <svg class="w-5 h-5 animate-spin text-[#0B1F3A]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path></svg>
                                    <span>Processing Submission...</span>
                                </span>
                            </template>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- POPUP DIALOG: VISA Apply Status Modal (Fully Device-Responsive Animated Success & Failed/Error) -->
        <div 
            x-show="showStatusModal" 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 overflow-y-auto bg-black/75 backdrop-blur-md flex items-center justify-center p-3 sm:p-4 md:p-6"
            style="display: none;"
        >
            <div 
                @click.away="closeStatusModal()"
                class="bg-white rounded-2xl sm:rounded-[28px] md:rounded-[32px] w-full max-w-lg md:max-w-2xl max-h-[92vh] sm:max-h-[88vh] flex flex-col p-4 sm:p-6 md:p-8 shadow-2xl border border-slate-100 relative overflow-hidden transform transition-all my-auto"
            >
                <!-- Close Button -->
                <button 
                    type="button" 
                    @click="closeStatusModal()" 
                    class="absolute top-3 right-3 sm:top-4 sm:right-4 w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-800 flex items-center justify-center transition-colors z-20 shadow-2xs"
                    aria-label="Close"
                >
                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>

                <!-- Scrollable Inner Content Area -->
                <div class="overflow-y-auto pr-1 sm:pr-2 overscroll-contain flex-grow">
                    
                    <!-- ================= SUCCESS STATE ================= -->
                    <template x-if="modalState === 'success'">
                        <div>
                            <!-- Top Decorative Animated Badge -->
                            <div class="text-center pb-4 sm:pb-5 border-b border-slate-100">
                                <div class="relative w-14 h-14 sm:w-16 sm:h-16 md:w-20 md:h-20 mx-auto mb-3 flex items-center justify-center">
                                    <div class="absolute inset-0 bg-emerald-400 rounded-full animate-ping opacity-25"></div>
                                    <div class="relative w-14 h-14 sm:w-16 sm:h-16 md:w-20 md:h-20 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center shadow-inner ring-4 sm:ring-8 ring-emerald-50">
                                        <svg class="w-7 h-7 sm:w-8 sm:h-8 md:w-10 md:h-10 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                </div>
                                <span class="px-3 py-0.5 sm:py-1 bg-emerald-50 border border-emerald-300 text-emerald-800 font-bold text-[10px] sm:text-xs uppercase tracking-wider rounded-full inline-block mb-1.5">
                                    Application Dossier Created
                                </span>
                                <h3 class="text-lg sm:text-2xl md:text-3xl font-extrabold text-[#0B1F3A] font-heading leading-snug">
                                    Visa Application Submitted Successfully!
                                </h3>
                                <p class="text-xs sm:text-sm text-slate-500 mt-1 max-w-md mx-auto leading-relaxed">
                                    Your application has been registered on our official visa desk. A specialist is assigned for document review.
                                </p>
                            </div>

                            <!-- Reference Number Box -->
                            <div class="my-3.5 sm:my-5 p-3.5 sm:p-4 md:p-5 rounded-xl sm:rounded-2xl bg-[#0B1F3A] text-white flex flex-col sm:flex-row sm:items-center justify-between gap-2.5 sm:gap-3 shadow-md">
                                <div class="min-w-0">
                                    <span class="text-[10.5px] sm:text-xs text-[#D4AF37] uppercase font-bold tracking-wider block">Official Reference ID</span>
                                    <strong class="text-base sm:text-xl md:text-2xl font-extrabold font-mono tracking-wide text-white truncate block" x-text="submittedApp.reference_number"></strong>
                                </div>
                                <button 
                                    type="button" 
                                    @click="copyReference(submittedApp.reference_number)"
                                    class="px-3.5 py-2 bg-white/10 hover:bg-white/20 border border-white/20 rounded-xl text-xs font-bold text-white transition flex items-center justify-center gap-1.5 flex-shrink-0"
                                >
                                    <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/></svg>
                                    <span x-text="copiedRef ? 'Copied!' : 'Copy Reference'"></span>
                                </button>
                            </div>

                            <!-- Application Status Summary Table -->
                            <div class="p-3.5 sm:p-5 rounded-xl sm:rounded-2xl bg-slate-50 border border-slate-200/80 space-y-2 sm:space-y-2.5 text-xs sm:text-sm">
                                <div class="flex items-center justify-between py-1 border-b border-slate-200/60 gap-2">
                                    <span class="text-slate-500 font-medium">Destination:</span>
                                    <strong class="text-[#0B1F3A] font-bold flex items-center gap-1.5 text-right">
                                        <span x-text="submittedApp.flag"></span>
                                        <span x-text="submittedApp.country_name"></span>
                                    </strong>
                                </div>

                                <div class="flex items-center justify-between py-1 border-b border-slate-200/60 gap-2">
                                    <span class="text-slate-500 font-medium">Applicant Name:</span>
                                    <strong class="text-[#0B1F3A] font-bold truncate text-right" x-text="submittedApp.applicant_name"></strong>
                                </div>

                                <div class="flex flex-col sm:flex-row sm:items-center justify-between py-1 border-b border-slate-200/60 gap-1 sm:gap-2">
                                    <span class="text-slate-500 font-medium">Current Status:</span>
                                    <span class="px-2.5 py-0.5 rounded-full text-[11px] sm:text-xs font-bold bg-amber-100 text-amber-800 border border-amber-300 self-start sm:self-auto">
                                        Application Received — Under Specialist Review
                                    </span>
                                </div>

                                <div class="flex items-center justify-between py-1 gap-2">
                                    <span class="text-slate-500 font-medium">Service Fee:</span>
                                    <strong class="text-emerald-700 font-extrabold text-sm sm:text-base">৳ <span x-text="submittedApp.total_service_fee"></span> BDT</strong>
                                </div>
                            </div>

                            <!-- Next Steps Milestone Indicator -->
                            <div class="mt-3.5 sm:mt-4 p-3 sm:p-4 rounded-xl bg-blue-50 border border-blue-200 text-xs text-blue-950 space-y-1">
                                <strong class="font-bold flex items-center gap-1.5 text-[#0B1F3A]">
                                    <svg class="w-3.5 h-3.5 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <span>What happens next?</span>
                                </strong>
                                <p class="text-slate-700 text-[11.5px] sm:text-xs">1. Our visa specialist will audit your passport & documents within 30-60 minutes.</p>
                                <p class="text-slate-700 text-[11.5px] sm:text-xs">2. We will contact you via WhatsApp / Phone to confirm embassy appointment.</p>
                            </div>

                            <!-- Modal Action Buttons -->
                            <div class="mt-4 sm:mt-6 pt-3.5 sm:pt-4 border-t border-slate-100 flex flex-col sm:flex-row gap-2.5 sm:gap-3">
                                <a 
                                    :href="submittedApp.tracking_url" 
                                    class="btn btn-primary py-3 sm:py-3.5 px-4 text-xs sm:text-sm font-bold shadow-md flex items-center justify-center gap-2 flex-1 w-full"
                                >
                                    <svg class="w-4 h-4 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                                    <span>View Live Tracking</span>
                                </a>

                                <button 
                                    type="button" 
                                    @click="startNewApplication()"
                                    class="btn btn-outline py-3 sm:py-3.5 px-4 text-xs sm:text-sm font-bold shadow-sm flex items-center justify-center gap-2 flex-1 w-full border-slate-300 hover:bg-slate-50 text-slate-700"
                                >
                                    <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                    <span>Apply For Another Visa</span>
                                </button>

                                <a 
                                    :href="submittedApp.whatsapp_url" 
                                    target="_blank"
                                    class="btn btn-gold py-3 sm:py-3.5 px-4 text-xs sm:text-sm font-bold shadow-md flex items-center justify-center gap-2 flex-1 w-full"
                                >
                                    <svg class="w-4 h-4 fill-current flex-shrink-0" viewBox="0 0 24 24">
                                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                                    </svg>
                                    <span>WhatsApp Specialist</span>
                                </a>
                            </div>
                        </div>
                    </template>

                    <!-- ================= FAILED / VALIDATION ERROR STATE ================= -->
                    <template x-if="modalState === 'failed'">
                        <div>
                            <!-- Top Decorative Animated Badge (Error / Warning) -->
                            <div class="text-center pb-4 sm:pb-5 border-b border-slate-100">
                                <div class="relative w-14 h-14 sm:w-16 sm:h-16 md:w-20 md:h-20 mx-auto mb-3 flex items-center justify-center">
                                    <div class="absolute inset-0 bg-rose-400 rounded-full animate-ping opacity-20"></div>
                                    <div class="relative w-14 h-14 sm:w-16 sm:h-16 md:w-20 md:h-20 bg-rose-100 text-rose-600 rounded-full flex items-center justify-center shadow-inner ring-4 sm:ring-8 ring-rose-50">
                                        <svg class="w-7 h-7 sm:w-8 sm:h-8 md:w-10 md:h-10 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                    </div>
                                </div>
                                <span class="px-3 py-0.5 sm:py-1 bg-rose-50 border border-rose-300 text-rose-700 font-bold text-[10px] sm:text-xs uppercase tracking-wider rounded-full inline-block mb-1.5">
                                    Attention Required
                                </span>
                                <h3 class="text-lg sm:text-2xl md:text-3xl font-extrabold text-[#0B1F3A] font-heading leading-snug" x-text="modalErrorTitle || 'Please Check The Following Errors'">
                                </h3>
                                <p class="text-xs sm:text-sm text-slate-500 mt-1 max-w-md mx-auto leading-relaxed">
                                    We could not complete your visa submission due to the item(s) below. Please correct them to proceed.
                                </p>
                            </div>

                            <!-- Error Messages List Card -->
                            <div class="my-3.5 sm:my-5 p-3 sm:p-4 rounded-xl sm:rounded-2xl bg-rose-50/80 border border-rose-200/90 text-slate-800 space-y-2 max-h-48 sm:max-h-56 overflow-y-auto">
                                <div class="flex items-center gap-2 text-rose-800 font-bold text-xs sm:text-sm">
                                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <span>Please review and fix:</span>
                                </div>
                                <ul class="space-y-1.5 text-xs sm:text-sm">
                                    <template x-for="(err, idx) in modalErrorList" :key="idx">
                                        <li class="flex items-start gap-2 p-2 rounded-lg sm:rounded-xl bg-white border border-rose-100 shadow-2xs text-rose-950 font-medium">
                                            <span class="w-4 h-4 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center text-[10px] font-bold flex-shrink-0 mt-0.5">•</span>
                                            <span class="leading-relaxed text-[11.5px] sm:text-xs" x-text="err"></span>
                                        </li>
                                    </template>
                                </ul>
                            </div>

                            <!-- Error Guidance Tip -->
                            <div class="p-2.5 sm:p-3 rounded-xl bg-amber-50 border border-amber-200/80 text-amber-900 text-xs flex items-center gap-2">
                                <svg class="w-4 h-4 text-amber-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                                <p class="leading-relaxed text-[11px] sm:text-xs">Click <strong>"Fix Errors & Continue"</strong> to return to the specific step and update your information.</p>
                            </div>

                            <!-- Modal Error Action Buttons -->
                            <div class="mt-4 sm:mt-6 pt-3.5 sm:pt-4 border-t border-slate-100 flex flex-col sm:flex-row gap-2.5 sm:gap-3">
                                <button 
                                    type="button" 
                                    @click="closeModalAndFix()" 
                                    class="btn btn-primary py-3 sm:py-3.5 px-4 text-xs sm:text-sm font-bold shadow-md flex items-center justify-center gap-2 flex-1 w-full"
                                >
                                    <svg class="w-4 h-4 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    <span>Fix Errors & Continue</span>
                                </button>

                                <a 
                                    :href="'https://wa.me/8801805464294?text=' + encodeURIComponent('Hello Emisha Visa Desk, I need help submitting my visa application. Error: ' + (modalErrorList[0] || 'Validation error'))" 
                                    target="_blank"
                                    class="btn btn-whatsapp py-3 sm:py-3.5 px-4 text-xs sm:text-sm font-bold shadow-md flex items-center justify-center gap-2 flex-1 w-full"
                                >
                                    <svg class="w-4 h-4 fill-current flex-shrink-0" viewBox="0 0 24 24">
                                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                                    </svg>
                                    <span>Get Help on WhatsApp</span>
                                </a>
                            </div>
                        </div>
                    </template>

                    <div class="mt-3 text-center pb-1">
                        <template x-if="modalState === 'success'">
                            <button type="button" @click="closeStatusModal()" class="text-xs text-slate-400 hover:text-slate-600 font-semibold underline">
                                Go to Live Tracking &rarr;
                            </button>
                        </template>
                        <template x-if="modalState === 'failed'">
                            <button type="button" @click="closeModalAndFix()" class="text-xs text-slate-400 hover:text-slate-600 font-semibold underline">
                                Dismiss & Fix Information
                            </button>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
function visaOnboardingWizard(destinations, schengenCountries, initialSlug, draftData, uploadQuota, submissionToken, isAlreadySubmitted, submittedApplicationData) {
    return {
        currentStep: 1,
        submissionToken: submissionToken || '{{ $submissionToken ?? '' }}',
        applicationStatus: isAlreadySubmitted ? 'SUBMITTED' : 'DRAFT', // 'DRAFT' | 'SUBMITTING' | 'SUBMITTED' | 'FAILED' | 'RESUBMITTING'
        docSubmissionMode: 'gdrive', // 'gdrive' | 'files'
        destinations: destinations,
        schengenCountriesList: schengenCountries,
        selectedCountryId: '{{ $selectedCountryId ?? 1 }}',
        selectedTypeId: '{{ $selectedTypeId ?? 1 }}',
        activeChecklist: {},
        uploadedFiles: {},
        uploadedFileSizes: {},
        uploadQuota: uploadQuota || {
            attempts: 0,
            max_attempts: 3,
            remaining_attempts: 3,
            is_blocked: false,
            is_cooldown: false,
            max_reached: false,
            remaining_seconds: 0,
            whatsapp_raw: '8801805464294',
            whatsapp_helpline: '+880 1805-464294'
        },
        formattedCooldownTimer: '',
        cooldownInterval: null,
        passportWarning: null,
        passportWarningValid: true,
        schengenMainCountry: null,
        autoSaved: false,
        autoSaveTimer: null,
        errors: {},
        isSubmitting: false,
        isSubmittedSuccessfully: isAlreadySubmitted ? true : false,
        showStatusModal: false,
        modalState: 'success', // 'success' | 'failed'
        modalErrorTitle: 'Please check the following errors:',
        modalErrorList: [],
        copiedRef: false,
        submittedApp: submittedApplicationData || {
            reference_number: '',
            country_name: '',
            flag: '',
            applicant_name: '',
            total_service_fee: '',
            tracking_url: '#',
            whatsapp_url: '#',
        },

        steps: [
            { id: 1, title: 'Select Destination', shortTitle: 'Destination' },
            { id: 2, title: 'Personal Profile', shortTitle: 'Profile' },
            { id: 3, title: 'Passport Information', shortTitle: 'Passport' },
            { id: 4, title: 'Travel Purpose & Itinerary', shortTitle: 'Travel' },
            { id: 5, title: 'Employment & Financials', shortTitle: 'Finance' },
            { id: 6, title: 'Travel History & Refusals', shortTitle: 'History' },
            { id: 7, title: 'Co-Travelers & Stay', shortTitle: 'Stay' },
            { id: 8, title: 'Document Uploads', shortTitle: 'Documents' },
            { id: 9, title: 'Application Review', shortTitle: 'Review' },
            { id: 10, title: 'Fee & Confirmation', shortTitle: 'Submit' },
        ],

        form: {
            destination_slug: initialSlug || 'thailand',
            full_name: draftData.full_name || '{{ old('full_name', '') }}',
            email: draftData.email || '{{ old('email', '') }}',
            phone: draftData.phone || '{{ old('phone', '') }}',
            whatsapp: draftData.whatsapp || '',
            date_of_birth: draftData.date_of_birth || '{{ old('date_of_birth', '') }}',
            gender: draftData.gender || 'Male',
            marital_status: draftData.marital_status || 'Single',
            nationality: draftData.nationality || 'Bangladeshi',
            living_in_bangladesh: draftData.living_in_bangladesh || 'yes',
            current_city: draftData.current_city || 'Dhaka',
            residence_country: draftData.residence_country || 'Bangladesh',
            residence_status: draftData.residence_status || 'Citizen',
            
            passport_number: draftData.passport_number || '{{ old('passport_number', '') }}',
            passport_type: draftData.passport_type || 'Ordinary / Regular',
            passport_issuing_country: draftData.passport_issuing_country || 'Bangladesh',
            passport_issue_date: draftData.passport_issue_date || '',
            passport_expiry_date: draftData.passport_expiry_date || '',
            place_of_birth: draftData.place_of_birth || 'Dhaka',
            
            travel_purpose: draftData.travel_purpose || 'Tourism',
            travel_date: draftData.travel_date || '{{ old('travel_date', '') }}',
            return_date: draftData.return_date || '',
            cities_to_visit: draftData.cities_to_visit || '',
            host_name: draftData.host_name || '',
            host_relationship: draftData.host_relationship || '',
            host_phone: draftData.host_phone || '',
            host_address: draftData.host_address || '',
            
            schengen_countries: draftData.schengen_countries || [],
            schengen_nights: draftData.schengen_nights || {},
            first_entry_country: draftData.first_entry_country || '',
            
            employment_status: draftData.employment_status || 'employed',
            employer_name: draftData.employer_name || '',
            job_title: draftData.job_title || '',
            company_address: draftData.company_address || '',
            business_name: draftData.business_name || '',
            business_type: draftData.business_type || '',
            institution_name: draftData.institution_name || '',
            student_id: draftData.student_id || '',
            monthly_income: draftData.monthly_income || '',
            has_bank_statement: draftData.has_bank_statement || 'yes',
            funding_source: draftData.funding_source || 'self',
            sponsor_name: draftData.sponsor_name || '',
            sponsor_relationship: draftData.sponsor_relationship || '',
            
            has_travelled: draftData.has_travelled || 'no',
            countries_visited: draftData.countries_visited || '',
            has_visa_refusal: draftData.has_visa_refusal || 'no',
            refusal_country: draftData.refusal_country || '',
            refusal_year: draftData.refusal_year || '',
            refusal_reason: draftData.refusal_reason || '',
            
            co_travelers: draftData.co_travelers || [],
            accommodation_type: draftData.accommodation_type || 'Hotel',
            hotel_name: draftData.hotel_name || '',
            documents_drive_link: draftData.documents_drive_link || '{{ old('documents_drive_link', '') }}',
            payment_method: draftData.payment_method || 'bkash_online',
            applicant_notes: draftData.applicant_notes || '',
        },

        init() {
            this.refreshChecklist();
            this.checkPassportValidity();
            this.startCooldownTimer();
            if (this.form.destination_slug === 'europe-schengen') {
                this.calculateSchengenRouting();
            }

            @if($errors->any())
                this.modalState = 'failed';
                this.modalErrorTitle = 'Please check the following errors:';
                this.modalErrorList = @js($errors->all());
                this.showStatusModal = true;
            @elseif(session('error'))
                this.modalState = 'failed';
                this.modalErrorTitle = 'Application Error';
                this.modalErrorList = [@js(session('error'))];
                this.showStatusModal = true;
            @elseif(session('success') && session('show_status_modal'))
                this.isSubmittedSuccessfully = true;
                this.modalState = 'success';
                this.showStatusModal = true;
            @endif
        },

        startCooldownTimer() {
            if (this.cooldownInterval) clearInterval(this.cooldownInterval);
            if (!this.uploadQuota || this.uploadQuota.remaining_seconds <= 0) return;

            const updateTimer = () => {
                if (this.uploadQuota.remaining_seconds > 0) {
                    let s = this.uploadQuota.remaining_seconds;
                    let h = Math.floor(s / 3600);
                    let m = Math.floor((s % 3600) / 60);
                    let sec = s % 60;
                    if (h > 0) {
                        this.formattedCooldownTimer = `${String(h).padStart(2, '0')}:${String(m).padStart(2, '0')}:${String(sec).padStart(2, '0')}`;
                    } else {
                        this.formattedCooldownTimer = `${String(m).padStart(2, '0')}:${String(sec).padStart(2, '0')}`;
                    }
                    this.uploadQuota.remaining_seconds--;
                } else {
                    this.uploadQuota.is_blocked = false;
                    this.uploadQuota.is_cooldown = false;
                    this.formattedCooldownTimer = '00:00';
                    clearInterval(this.cooldownInterval);
                }
            };

            updateTimer();
            this.cooldownInterval = setInterval(updateTimer, 1000);
        },

        get currentDestination() {
            return this.destinations[this.form.destination_slug] || this.destinations['thailand'];
        },

        get requiredDocsCount() {
            return Object.values(this.activeChecklist).filter(d => d.required).length;
        },

        get uploadedCount() {
            let count = 0;
            for (let code in this.activeChecklist) {
                if (this.activeChecklist[code].required && this.uploadedFiles[code]) {
                    count++;
                }
            }
            return count;
        },

        get remainingCount() {
            return Math.max(0, this.requiredDocsCount - this.uploadedCount);
        },

        selectDestination(slug) {
            this.form.destination_slug = slug;
            this.refreshChecklist();
            this.checkPassportValidity();
            this.triggerAutoSave();
        },

        addCoTraveler() {
            this.form.co_travelers.push({ name: '', relationship: '', passport: '' });
            this.triggerAutoSave();
        },

        removeCoTraveler(idx) {
            this.form.co_travelers.splice(idx, 1);
            this.triggerAutoSave();
        },

        calculateSchengenRouting() {
            if (!this.form.schengen_countries || this.form.schengen_countries.length === 0) {
                this.schengenMainCountry = null;
                return;
            }

            let maxNights = -1;
            let longest = [];
            for (let c of this.form.schengen_countries) {
                let n = parseInt(this.form.schengen_nights[c] || 0);
                if (n > maxNights) {
                    maxNights = n;
                    longest = [c];
                } else if (n === maxNights && maxNights > 0) {
                    longest.push(c);
                }
            }

            this.schengenMainCountry = longest.length > 0 ? longest[0] : this.form.schengen_countries[0];
            this.triggerAutoSave();
        },

        checkPassportValidity() {
            if (!this.form.passport_expiry_date) {
                this.passportWarning = null;
                return;
            }

            let expiry = new Date(this.form.passport_expiry_date);
            let travel = this.form.travel_date ? new Date(this.form.travel_date) : new Date();
            let monthsReq = this.currentDestination?.passport_validity_months || 6;

            let diffMonths = (expiry.getFullYear() - travel.getFullYear()) * 12 + (expiry.getMonth() - travel.getMonth());

            if (diffMonths < 0) {
                this.passportWarning = 'Your passport is already expired. Please renew before submission.';
                this.passportWarningValid = false;
            } else if (diffMonths < monthsReq) {
                this.passportWarning = 'Warning: ' + this.currentDestination?.name + ' immigration requires at least ' + monthsReq + ' months validity. Your passport has approximately ' + diffMonths + ' months remaining.';
                this.passportWarningValid = false;
            } else {
                this.passportWarning = 'Passport validity meets ' + this.currentDestination?.name + ' immigration requirement (' + diffMonths + ' months validity).';
                this.passportWarningValid = true;
            }
        },

        handleFileUpload(event, code) {
            let file = event.target.files[0];
            if (!file) return;

            if (this.uploadQuota && this.uploadQuota.is_blocked) {
                event.target.value = '';
                delete this.uploadedFiles[code];
                delete this.uploadedFileSizes[code];

                this.modalState = 'failed';
                this.modalErrorTitle = 'Upload Cooldown Active';
                this.modalErrorList = [
                    'File uploads are currently locked during cooldown to protect storage integrity.',
                    'Please wait for the timer to finish, or contact our WhatsApp Support (+8801805464294) to fast-forward immediately.'
                ];
                this.showStatusModal = true;
                return;
            }

            let docConfig = this.activeChecklist[code] || {};
            let maxMb = docConfig.max_size_mb || 10;
            let maxBytes = maxMb * 1024 * 1024;

            // 1. Strict File Size Validation
            if (file.size > maxBytes) {
                let actualMb = (file.size / (1024 * 1024)).toFixed(1);
                event.target.value = '';
                delete this.uploadedFiles[code];
                delete this.uploadedFileSizes[code];

                this.modalState = 'failed';
                this.modalErrorTitle = 'File Exceeds Maximum Size Limit';
                this.modalErrorList = [
                    `"${file.name}" is ${actualMb} MB, which exceeds the maximum allowed limit of ${maxMb} MB for ${docConfig.name || 'this document'}.`,
                    `Please compress your document or choose a file under ${maxMb} MB. You can also paste your Google Drive folder link in Option 1 for larger files.`
                ];
                this.showStatusModal = true;
                return;
            }

            // 2. Strict File Type / Extension Validation
            let ext = file.name.split('.').pop().toLowerCase();
            let allowedExts = ['pdf', 'jpg', 'jpeg', 'png', 'webp'];
            if (!allowedExts.includes(ext)) {
                event.target.value = '';
                delete this.uploadedFiles[code];
                delete this.uploadedFileSizes[code];

                this.modalState = 'failed';
                this.modalErrorTitle = 'Unsupported File Format';
                this.modalErrorList = [
                    `"${file.name}" has an unsupported format (.${ext}).`,
                    'Only safe document & image formats are accepted: PDF, JPG, JPEG, PNG, WEBP.'
                ];
                this.showStatusModal = true;
                return;
            }

            this.uploadedFiles[code] = file.name;
            this.uploadedFileSizes[code] = (file.size / (1024 * 1024)).toFixed(1) + ' MB';
        },

        refreshChecklist() {
            let base = this.currentDestination?.base_documents || {};
            let list = JSON.parse(JSON.stringify(base));

            // Conditional Rules
            if (this.form.employment_status === 'employed') {
                list['employment_noc'] = {
                    name: 'Employment NOC & Leave Sanction Letter',
                    description: 'Official letterhead NOC with salary, joining date & sanctioned leave.',
                    required: true,
                    is_conditional: true,
                    condition_reason: 'Required for Employed',
                    accepted_types: 'PDF, JPG, PNG',
                    max_size_mb: 10,
                };
            } else if (this.form.employment_status === 'business_owner' || this.form.employment_status === 'self_employed') {
                list['business_registration'] = {
                    name: 'Trade License / Business Registration',
                    description: 'Updated Trade License / Certificate of Incorporation.',
                    required: true,
                    is_conditional: true,
                    condition_reason: 'Required for Business',
                    accepted_types: 'PDF, JPG, PNG',
                    max_size_mb: 15,
                };
            } else if (this.form.employment_status === 'student') {
                list['student_id_noc'] = {
                    name: 'Student ID Card & Enrollment Letter',
                    description: 'Valid Student ID card copy and leave approval from school/university.',
                    required: true,
                    is_conditional: true,
                    condition_reason: 'Required for Students',
                    accepted_types: 'PDF, JPG, PNG',
                    max_size_mb: 10,
                };
            }

            if (this.form.travel_purpose === 'visiting_family_friends') {
                list['invitation_letter'] = {
                    name: 'Host Invitation Letter & Host ID',
                    description: 'Signed letter from host with host contact, relationship and passport copy.',
                    required: true,
                    is_conditional: true,
                    condition_reason: 'Required for Family/Friend Visit',
                    accepted_types: 'PDF, JPG, PNG',
                    max_size_mb: 15,
                };
            }

            if (this.form.funding_source === 'sponsored' || this.form.funding_source === 'family_funded') {
                list['sponsor_documents'] = {
                    name: 'Sponsor Bank Statement & Guarantee',
                    description: 'Sponsor bank statement, employment/business proof and relationship certificate.',
                    required: true,
                    is_conditional: true,
                    condition_reason: 'Required for Sponsored Trip',
                    accepted_types: 'PDF, JPG, PNG',
                    max_size_mb: 20,
                };
            }

            if (this.form.has_visa_refusal === 'yes') {
                list['refusal_letter'] = {
                    name: 'Previous Visa Refusal Letter (If Available)',
                    description: 'Official refusal notice to help consultants address previous grounds.',
                    required: false,
                    is_conditional: true,
                    condition_reason: 'Optional: Address Refusal',
                    accepted_types: 'PDF, JPG, PNG',
                    max_size_mb: 10,
                };
            }

            this.activeChecklist = list;
        },

        validateCurrentStep() {
            this.errors = {};
            let valid = true;

            if (this.currentStep === 2) {
                if (!this.form.full_name || this.form.full_name.trim() === '') {
                    this.errors.full_name = 'Full legal name as on passport is required.';
                    valid = false;
                }
                if (!this.form.email || !this.form.email.includes('@')) {
                    this.errors.email = 'Valid email address is required.';
                    valid = false;
                }
                if (!this.form.phone || this.form.phone.trim() === '') {
                    this.errors.phone = 'Phone number is required.';
                    valid = false;
                }
                if (!this.form.date_of_birth) {
                    this.errors.date_of_birth = 'Date of birth is required.';
                    valid = false;
                }
                if (this.form.living_in_bangladesh === 'no') {
                    if (!this.form.residence_country) {
                        this.errors.residence_country = 'Residence country is required.';
                        valid = false;
                    }
                    if (!this.form.residence_status) {
                        this.errors.residence_status = 'Residence status is required.';
                        valid = false;
                    }
                }
            }

            if (this.currentStep === 3) {
                if (!this.form.passport_number || this.form.passport_number.trim() === '') {
                    this.errors.passport_number = 'Passport number is required.';
                    valid = false;
                }
                if (!this.form.passport_expiry_date) {
                    this.errors.passport_expiry_date = 'Passport expiry date is required.';
                    valid = false;
                }
            }

            if (this.currentStep === 4) {
                if (!this.form.travel_date) {
                    this.errors.travel_date = 'Intended departure date is required.';
                    valid = false;
                }
            }

            return valid;
        },

        nextStep() {
            if (!this.validateCurrentStep()) {
                return;
            }
            if (this.currentStep < this.steps.length) {
                this.currentStep++;
                window.scrollTo({ top: 120, behavior: 'smooth' });
                this.triggerAutoSave();
            }
        },

        prevStep() {
            if (this.currentStep > 1) {
                this.currentStep--;
                window.scrollTo({ top: 120, behavior: 'smooth' });
            }
        },

        goToStep(step) {
            if (step <= this.currentStep || this.isStepCompleted(step)) {
                this.currentStep = step;
                window.scrollTo({ top: 120, behavior: 'smooth' });
            }
        },

        isStepCompleted(step) {
            return step < this.currentStep;
        },

        triggerAutoSave() {
            clearTimeout(this.autoSaveTimer);
            this.autoSaveTimer = setTimeout(() => {
                fetch('{{ route('visa.onboarding.draft') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(this.form)
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        this.autoSaved = true;
                        setTimeout(() => this.autoSaved = false, 3000);
                    }
                })
                .catch(() => {});
            }, 800);
        },

        copyReference(ref) {
            if (!ref) return;
            navigator.clipboard.writeText(ref).then(() => {
                this.copiedRef = true;
                setTimeout(() => this.copiedRef = false, 2500);
            });
        },

        submitVisaForm() {
            if (this.isSubmitting) return;
            if (this.applicationStatus === 'SUBMITTED' || this.isSubmittedSuccessfully) {
                if (this.submittedApp && this.submittedApp.tracking_url && this.submittedApp.tracking_url !== '#') {
                    window.location.href = this.submittedApp.tracking_url;
                } else {
                    window.location.href = '{{ route('visa.track') }}';
                }
                return;
            }
            this.isSubmitting = true;
            this.applicationStatus = 'SUBMITTING';

            const formEl = document.getElementById('visaOnboardingForm');
            const formData = new FormData(formEl);

            fetch('{{ route('visa.apply.store') }}', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(async res => {
                const data = await res.json().catch(() => ({}));
                this.isSubmitting = false;

                if (res.ok && data.status === 'success') {
                    this.applicationStatus = 'SUBMITTED';
                    this.isSubmittedSuccessfully = true;
                    this.modalState = 'success';
                    this.submittedApp = {
                        reference_number: data.reference_number,
                        country_name: data.country_name,
                        flag: data.flag,
                        applicant_name: data.applicant_name,
                        total_service_fee: data.total_service_fee,
                        tracking_url: data.tracking_url,
                        whatsapp_url: data.whatsapp_url,
                    };
                    this.showStatusModal = true;
                    return;
                }

                // Handle validation error (422) or server error - Form data & inputs remain completely preserved!
                this.isSubmittedSuccessfully = false;
                this.applicationStatus = 'FAILED';
                this.modalState = 'failed';
                this.modalErrorTitle = data.message || 'Please check the following errors:';
                
                let errList = [];
                if (data.errors && typeof data.errors === 'object') {
                    for (let field in data.errors) {
                        if (Array.isArray(data.errors[field])) {
                            errList.push(...data.errors[field]);
                        } else if (typeof data.errors[field] === 'string') {
                            errList.push(data.errors[field]);
                        }
                    }
                } else if (data.error) {
                    errList.push(data.error);
                }

                if (errList.length === 0) {
                    errList.push(data.message || 'An unexpected error occurred during visa submission. Please check your details and try again.');
                }

                this.modalErrorList = errList;
                this.showStatusModal = true;
            })
            .catch(err => {
                this.isSubmitting = false;
                this.isSubmittedSuccessfully = false;
                this.applicationStatus = 'FAILED';
                this.modalState = 'failed';
                this.modalErrorTitle = 'Connection / Submission Error';
                this.modalErrorList = ['Unable to complete your request at this moment. Please check your internet connection or reach out directly to our WhatsApp Visa Desk.'];
                this.showStatusModal = true;
            });
        },

        closeStatusModal() {
            this.showStatusModal = false;
            if (this.modalState === 'success' || this.isSubmittedSuccessfully) {
                // When visa apply was successful, closing the modal keeps the application locked into the SUBMITTED overview
                this.applicationStatus = 'SUBMITTED';
                this.isSubmittedSuccessfully = true;
                window.scrollTo({ top: 120, behavior: 'smooth' });
            } else {
                // When visa apply failed, keep all filled data and navigate to the step to fix
                this.applicationStatus = 'RESUBMITTING';
                this.closeModalAndFix();
            }
        },

        startNewApplication() {
            this.isSubmitting = false;
            this.isSubmittedSuccessfully = false;
            this.applicationStatus = 'DRAFT';
            this.showStatusModal = false;
            // Clear server session draft
            fetch('{{ route('visa.onboarding.draft') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({})
            }).catch(() => {});
            // Redirect to clean application page with new token
            window.location.href = '{{ route('visa.apply') }}?new=1';
        },

        closeModalAndFix() {
            this.showStatusModal = false;
            
            // Smart step navigator based on error list
            let hasProfileErr = this.modalErrorList.some(e => /name|email|phone|birth|residence/i.test(e));
            let hasPassportErr = this.modalErrorList.some(e => /passport|expiry/i.test(e));
            let hasTravelErr = this.modalErrorList.some(e => /travel|schengen|departure/i.test(e));
            let hasFinanceErr = this.modalErrorList.some(e => /employment|income|sponsor|bank/i.test(e));
            let hasDocErr = this.modalErrorList.some(e => /document|photo|noc|file|upload/i.test(e));

            if (hasProfileErr) {
                this.goToStep(2);
            } else if (hasPassportErr) {
                this.goToStep(3);
            } else if (hasTravelErr) {
                this.goToStep(4);
            } else if (hasFinanceErr) {
                this.goToStep(5);
            } else if (hasDocErr) {
                this.goToStep(8);
            } else {
                window.scrollTo({ top: 200, behavior: 'smooth' });
            }
        }
    }
}
</script>
@endpush
@endsection
