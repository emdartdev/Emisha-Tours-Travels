@props(['title', 'description', 'icon', 'link', 'linkText'])

<div class="service-card group bg-white border border-slate-100 rounded-[24px] p-8 shadow-[0_4px_20px_rgba(11,31,58,0.04)] hover:shadow-[0_16px_36px_rgba(11,31,58,0.1)] hover:border-[#D4AF37]/40 transition-all duration-300 flex flex-col h-full">
    <div class="service-icon-box w-14 h-14 rounded-2xl bg-gradient-to-br from-[#0B1F3A]/[0.04] to-[#D4AF37]/20 text-[#0B1F3A] group-hover:from-[#D4AF37] group-hover:to-[#E8D28A] flex items-center justify-center text-2xl mb-6 transition-all duration-300 shadow-sm">
        {!! $icon !!}
    </div>

    <h3 class="service-card-title text-xl font-bold text-[#0B1F3A] group-hover:text-[#0B1F3A] font-serif mb-3 leading-snug">
        {{ $title }}
    </h3>

    <p class="service-card-desc text-xs text-slate-500 leading-relaxed mb-6 flex-grow">
        {{ $description }}
    </p>

    <a href="{{ $link }}" class="service-card-link text-xs font-bold text-[#D4AF37] group-hover:text-[#0B1F3A] inline-flex items-center gap-2 transition-colors">
        <span>{{ $linkText }}</span>
        <svg class="w-4 h-4 group-hover:translate-x-1.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
    </a>
</div>
