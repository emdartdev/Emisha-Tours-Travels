@props(['country'])

@php
    $primaryType = $country->visaTypes->first();
@endphp

<div class="card-base bg-white border border-slate-200/70 hover:border-[#D4AF37]/50 rounded-[22px] p-4 sm:p-5 md:p-6 flex flex-col justify-between h-full group shadow-[0_2px_14px_rgba(11,31,58,0.03)] hover:shadow-[0_16px_36px_rgba(11,31,58,0.09)] transition-all duration-300 hover:-translate-y-1 relative">
    <div>
        <!-- Header: Flag & Country Title & Badge -->
        <div class="flex items-start justify-between gap-2.5 sm:gap-3 mb-4">
            <div class="flex items-center gap-3 min-w-0">
                <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-2xl bg-slate-50 border border-slate-200/80 p-1 flex items-center justify-center overflow-hidden flex-shrink-0 shadow-2xs group-hover:scale-105 transition-transform">
                    <img 
                        src="{{ $country->flag_url }}" 
                        alt="{{ $country->country_name }} Flag" 
                        class="w-full h-full object-cover rounded-xl"
                        loading="lazy"
                    >
                </div>
                <div class="min-w-0">
                    <h3 class="text-base sm:text-lg md:text-xl font-bold font-serif text-[#0B1F3A] group-hover:text-[#D4AF37] transition-colors leading-tight truncate">
                        <a href="{{ route('visa.show', $country->slug) }}">
                            {{ $country->country_name }}
                        </a>
                    </h3>
                    @if($primaryType)
                        <span class="text-xs text-slate-400 font-medium block mt-0.5 truncate">{{ $primaryType->name }}</span>
                    @endif
                </div>
            </div>

            @if($country->featured)
                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-[#D4AF37]/10 text-[#927513] text-[10px] sm:text-[10.5px] font-bold tracking-wide flex-shrink-0">
                    <svg class="w-3 h-3 text-[#D4AF37]" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    <span>Popular</span>
                </span>
            @endif
        </div>

        <!-- Short Description -->
        <p class="text-xs text-slate-500 leading-relaxed line-clamp-2 mb-4 font-normal min-h-[34px]">
            {{ $country->short_description ?: 'Official embassy checklist inspection, document review, and online application support.' }}
        </p>

        <!-- Minimal Clean Metadata Chips -->
        @if($primaryType)
        <div class="flex items-center flex-wrap gap-1.5 sm:gap-2 text-xs text-slate-600 mb-5 pb-4 border-b border-slate-100">
            <div class="inline-flex items-center gap-1.5 px-2.5 sm:px-3 py-1 rounded-xl bg-slate-50 border border-slate-200/60 font-medium text-[11px] sm:text-xs">
                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>{{ $primaryType->processing_time }} {{ $primaryType->processing_time_unit }}</span>
            </div>
            <div class="inline-flex items-center gap-1.5 px-2.5 sm:px-3 py-1 rounded-xl bg-slate-50 border border-slate-200/60 font-medium text-[11px] sm:text-xs">
                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/></svg>
                <span>{{ $primaryType->entry_type ?: 'Single Entry' }}</span>
            </div>
            <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-xl bg-emerald-50 text-emerald-700 border border-emerald-200/60 font-medium text-[10.5px] sm:text-[11px]">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                <span>High Approval</span>
            </div>
        </div>
        @endif
    </div>

    <!-- Bottom: Pricing & Minimal Action Buttons -->
    <div>
        @if($primaryType)
        <div class="flex items-baseline justify-between mb-3.5">
            <div>
                <span class="text-[11px] sm:text-xs text-slate-400 font-medium block">Total Processing Fee</span>
                <span class="text-[10px] sm:text-[10.5px] text-slate-400">Embassy + Service charge</span>
            </div>
            <div class="text-right">
                <span class="text-lg sm:text-xl md:text-2xl font-black text-[#0B1F3A] font-serif group-hover:text-[#927513] transition-colors tracking-tight">
                    ৳{{ number_format($primaryType->starting_fee + $primaryType->service_fee, 0) }}
                </span>
            </div>
        </div>
        @endif

        <div class="flex items-center gap-2 sm:gap-2.5">
            <a href="{{ route('visa.show', $country->slug) }}" class="flex-1 py-2.5 px-3 min-h-[38px] rounded-xl bg-slate-50 hover:bg-slate-100 text-[#0B1F3A] text-xs font-semibold text-center transition border border-slate-200/70 hover:border-slate-300 flex items-center justify-center">
                Requirements
            </a>
            <a href="{{ route('visa.apply') }}?country={{ $country->id }}" class="py-2.5 px-4 sm:px-5 min-h-[38px] rounded-xl bg-[#0B1F3A] hover:bg-[#D4AF37] text-white hover:text-[#0B1F3A] text-xs font-bold transition shadow-xs flex items-center justify-center gap-1.5 flex-shrink-0">
                <span>Apply</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>
    </div>
</div>
