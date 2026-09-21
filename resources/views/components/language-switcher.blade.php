@props(['variant' => 'default'])

@php
    $currentLocale = app()->getLocale();
@endphp

@if($variant === 'compact')
    <!-- Compact Pill Switcher (Header / Top Bar) -->
    <div class="inline-flex items-center p-0.5 rounded-full bg-white/10 border border-white/15 text-[11px] font-semibold select-none backdrop-blur-md" role="group" aria-label="Language Selector">
        <a 
            href="{{ route('lang.switch', 'en') }}" 
            class="px-2 py-0.5 rounded-full transition-all duration-200 {{ $currentLocale === 'en' ? 'bg-[#D4AF37] text-[#071527] font-extrabold shadow-sm' : 'text-white/80 hover:text-white' }}"
            title="Switch to English"
        >
            EN
        </a>
        <a 
            href="{{ route('lang.switch', 'bn') }}" 
            class="px-2 py-0.5 rounded-full transition-all duration-200 {{ $currentLocale === 'bn' ? 'bg-[#D4AF37] text-[#071527] font-extrabold shadow-sm' : 'text-white/80 hover:text-white' }}"
            title="বাংলায় পরিবর্তন করুন"
        >
            বাং
        </a>
    </div>
@elseif($variant === 'footer')
    <!-- Footer Language Switcher -->
    <div class="inline-flex items-center gap-2 p-1 rounded-xl bg-slate-900 border border-slate-800 text-xs font-semibold select-none">
        <span class="text-slate-400 pl-2 text-[11px] uppercase font-bold flex items-center gap-1.5">
            <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/></svg>
            <span>Language:</span>
        </span>
        <div class="inline-flex items-center p-0.5 rounded-lg bg-slate-800/80">
            <a 
                href="{{ route('lang.switch', 'en') }}" 
                class="px-3 py-1 rounded-md transition-all duration-200 {{ $currentLocale === 'en' ? 'bg-[#D4AF37] text-[#071527] font-extrabold shadow-sm' : 'text-slate-300 hover:text-white' }}"
            >
                English
            </a>
            <a 
                href="{{ route('lang.switch', 'bn') }}" 
                class="px-3 py-1 rounded-md transition-all duration-200 {{ $currentLocale === 'bn' ? 'bg-[#D4AF37] text-[#071527] font-extrabold shadow-sm' : 'text-slate-300 hover:text-white' }}"
            >
                বাংলা
            </a>
        </div>
    </div>
@else
    <!-- Standard Pill Switcher (Navbar & Mobile Drawer) -->
    <div class="inline-flex items-center p-1 rounded-xl bg-white/10 border border-white/20 text-xs font-semibold select-none backdrop-blur-md" role="group" aria-label="Language Selector">
        <a 
            href="{{ route('lang.switch', 'en') }}" 
            class="flex items-center gap-1.5 px-3 py-1 rounded-lg transition-all duration-200 {{ $currentLocale === 'en' ? 'bg-gradient-to-r from-[#D4AF37] to-[#B38F26] text-[#071527] font-extrabold shadow-sm' : 'text-white/80 hover:text-white hover:bg-white/5' }}"
            title="English Version"
        >
            <span>EN</span>
        </a>
        <a 
            href="{{ route('lang.switch', 'bn') }}" 
            class="flex items-center gap-1.5 px-3 py-1 rounded-lg transition-all duration-200 {{ $currentLocale === 'bn' ? 'bg-gradient-to-r from-[#D4AF37] to-[#B38F26] text-[#071527] font-extrabold shadow-sm' : 'text-white/80 hover:text-white hover:bg-white/5' }}"
            title="বাংলা সংস্করণ"
        >
            <span>বাংলা</span>
        </a>
    </div>
@endif
