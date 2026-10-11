@php
    $phone = App\Models\Setting::get('contact_phone', '+880 1805-464291');
    $whatsapp = App\Models\Setting::get('contact_whatsapp', '+880 1805-464291');
    $email = App\Models\Setting::get('contact_email', 'info@emishatours.com');
    $hours = App\Models\Setting::get('office_hours', 'Saturday – Thursday: 10:00 AM – 6:30 PM');
@endphp

<!-- Top Utility Bar (Desktop & Tablets >= 768px) -->
<div class="top-bar hidden md:block bg-[#071527] border-b border-white/[0.08] text-xs text-white/80 py-2">
    <div class="container-custom flex justify-between items-center">
        <div class="flex items-center space-x-6">
            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}" class="flex items-center gap-2 hover:text-[#D4AF37] transition-colors">
                <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                <span class="font-medium tracking-wide">{{ $phone }}</span>
            </a>
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsapp) }}?text=Hello%20Emisha%20Tours,%20I%20would%20like%20to%20inquire%20about%20travel%20services." target="_blank" class="flex items-center gap-2 hover:text-[#D4AF37] transition-colors">
                <svg class="w-3.5 h-3.5 text-[#25D366]" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                <span class="font-medium tracking-wide">WhatsApp 24/7</span>
            </a>
            <a href="mailto:{{ $email }}" class="flex items-center gap-2 hover:text-[#D4AF37] transition-colors">
                <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                <span class="font-medium tracking-wide">{{ $email }}</span>
            </a>
        </div>
        <div class="flex items-center space-x-4">
            <span class="text-white/60 tracking-wide font-light hidden lg:inline">{{ $hours }}</span>
            <!-- Language Switcher in Top Bar -->
            @include('components.language-switcher', ['variant' => 'compact'])
        </div>
    </div>
</div>

<!-- Main Sticky Header & Navigation -->
<header 
    class="main-navbar bg-[#0B1F3A]/95 backdrop-blur-xl border-b border-white/[0.08] sticky top-0 z-50 shadow-[0_4px_30px_rgba(0,0,0,0.2)] transition-all h-[60px] sm:h-[70px] flex items-center"
    x-data="{ 
        mobileMenuOpen: false,
        init() {
            this.$watch('mobileMenuOpen', value => {
                if (value) {
                    document.body.classList.add('overflow-hidden');
                } else {
                    document.body.classList.remove('overflow-hidden');
                }
            });
        }
    }"
    @keydown.escape.window="mobileMenuOpen = false"
>
    <div class="container-custom w-full flex justify-between items-center">
        
        <!-- Brand Logo -->
        <a href="{{ route('home') }}" class="flex items-center flex-shrink-0 group" title="Emisha Tours & Travels Home">
            <img 
                src="{{ asset('images/logo.png') }}" 
                alt="Emisha Tours & Travels" 
                class="h-[30px] xs:h-[36px] sm:h-[44px] md:h-[48px] max-h-[48px] w-auto object-contain transition-transform duration-300 group-hover:scale-105 drop-shadow-[0_2px_8px_rgba(212,175,55,0.3)]"
            >
        </a>

        <!-- Desktop Navigation Links (>= 1024px) -->
        <nav class="hidden lg:flex items-center space-x-1 xl:space-x-2">
            <a href="{{ route('home') }}" class="px-2.5 xl:px-3 py-1.5 rounded-lg text-[13px] xl:text-[13.5px] font-medium whitespace-nowrap transition-all duration-200 {{ request()->routeIs('home') ? 'text-[#D4AF37] bg-white/10 font-semibold' : 'text-white/85 hover:text-white hover:bg-white/5' }}">
                {{ __('nav.home') }}
            </a>
            <a href="{{ route('tours.index') }}" class="px-2.5 xl:px-3 py-1.5 rounded-lg text-[13px] xl:text-[13.5px] font-medium whitespace-nowrap transition-all duration-200 {{ request()->routeIs('tours*') ? 'text-[#D4AF37] bg-white/10 font-semibold' : 'text-white/85 hover:text-white hover:bg-white/5' }}">
                {{ __('nav.tours') }}
            </a>
            <a href="{{ route('destinations.index') }}" class="px-2.5 xl:px-3 py-1.5 rounded-lg text-[13px] xl:text-[13.5px] font-medium whitespace-nowrap transition-all duration-200 {{ request()->routeIs('destinations*') ? 'text-[#D4AF37] bg-white/10 font-semibold' : 'text-white/85 hover:text-white hover:bg-white/5' }}">
                {{ __('nav.destinations') }}
            </a>
            <a href="{{ route('visa.index') }}" class="px-2.5 xl:px-3 py-1.5 rounded-lg text-[13px] xl:text-[13.5px] font-medium whitespace-nowrap transition-all duration-200 {{ request()->routeIs('visa*') ? 'text-[#D4AF37] bg-white/10 font-semibold' : 'text-white/85 hover:text-white hover:bg-white/5' }}">
                {{ __('nav.visa') }}
            </a>
            <a href="{{ route('ticketing.index') }}" class="px-2.5 xl:px-3 py-1.5 rounded-lg text-[13px] xl:text-[13.5px] font-medium whitespace-nowrap transition-all duration-200 {{ request()->routeIs('ticketing*') ? 'text-[#D4AF37] bg-white/10 font-semibold' : 'text-white/85 hover:text-white hover:bg-white/5' }}">
                {{ __('nav.ticketing') }}
            </a>
            <a href="{{ route('blog.index') }}" class="px-2.5 xl:px-3 py-1.5 rounded-lg text-[13px] xl:text-[13.5px] font-medium whitespace-nowrap transition-all duration-200 {{ request()->routeIs('blog*') ? 'text-[#D4AF37] bg-white/10 font-semibold' : 'text-white/85 hover:text-white hover:bg-white/5' }}">
                {{ __('nav.blog') }}
            </a>
            <a href="{{ route('about') }}" class="px-2.5 xl:px-3 py-1.5 rounded-lg text-[13px] xl:text-[13.5px] font-medium whitespace-nowrap transition-all duration-200 {{ request()->routeIs('about') ? 'text-[#D4AF37] bg-white/10 font-semibold' : 'text-white/85 hover:text-white hover:bg-white/5' }}">
                {{ __('nav.about') }}
            </a>
            <a href="{{ route('contact.index') }}" class="px-2.5 xl:px-3 py-1.5 rounded-lg text-[13px] xl:text-[13.5px] font-medium whitespace-nowrap transition-all duration-200 {{ request()->routeIs('contact*') ? 'text-[#D4AF37] bg-white/10 font-semibold' : 'text-white/85 hover:text-white hover:bg-white/5' }}">
                {{ __('nav.contact') }}
            </a>
        </nav>

        <!-- Right Action Button & Language Toggle (Desktop >= 1024px) -->
        <div class="hidden lg:flex items-center gap-3 flex-shrink-0 pl-2">
            @include('components.language-switcher')

            <a href="{{ route('visa.apply') }}" class="btn btn-gold btn-sm whitespace-nowrap font-semibold tracking-wide shadow-[0_4px_16px_rgba(212,175,55,0.25)] min-h-[40px]">
                <span>{{ __('nav.visa_apply') }}</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>

        <!-- Mobile / Tablet Header Actions (< 1024px) -->
        <div class="flex items-center gap-1.5 sm:gap-2 lg:hidden flex-shrink-0">
            <!-- Mobile Language Switcher -->
            @include('components.language-switcher', ['variant' => 'compact'])

            <!-- 1-Tap Mobile WhatsApp -->
            <button 
                type="button" 
                @click="window.dispatchEvent(new CustomEvent('open-whatsapp-modal'))" 
                class="w-8 h-8 sm:w-9 sm:h-9 rounded-xl bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 flex items-center justify-center text-xs transition active:scale-95 hover:bg-emerald-500/30 cursor-pointer"
                title="WhatsApp Department Hub"
                aria-label="WhatsApp Department Support"
            >
                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
            </button>

            <!-- Mobile Compact CTA Button -->
            <a href="{{ route('visa.apply') }}" class="btn btn-gold btn-xs px-2.5 sm:px-3 py-1.5 min-h-[34px] text-[11px] font-bold shadow-sm whitespace-nowrap">
                {{ __('common.apply_now') }}
            </a>

            <!-- Mobile Animated Hamburger Button -->
            <button 
                type="button" 
                @click="mobileMenuOpen = !mobileMenuOpen" 
                class="w-8 h-8 sm:w-9 sm:h-9 rounded-xl bg-white/10 text-white border border-white/15 flex items-center justify-center transition active:scale-95 hover:bg-white/15 focus:outline-none cursor-pointer"
                aria-label="Toggle Navigation Menu"
            >
                <svg x-show="!mobileMenuOpen" class="w-4.5 h-4.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                <svg x-show="mobileMenuOpen" class="w-4.5 h-4.5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    </div>

    <!-- Mobile Fullscreen Backdrop Overlay -->
    <div 
        x-show="mobileMenuOpen" 
        x-transition:enter="transition-opacity ease-linear duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="mobileMenuOpen = false"
        class="fixed inset-0 bg-black/75 backdrop-blur-sm z-40 lg:hidden"
        style="display: none;"
    ></div>

    <!-- Mobile Full Slide-Down Drawer Menu -->
    <div 
        x-show="mobileMenuOpen" 
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="-translate-y-4 opacity-0"
        x-transition:enter-end="translate-y-0 opacity-100"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="translate-y-0 opacity-100"
        x-transition:leave-end="-translate-y-4 opacity-0"
        class="lg:hidden fixed top-[60px] sm:top-[70px] left-0 right-0 h-[calc(100dvh-60px)] sm:h-[calc(100dvh-70px)] bg-[#071527] z-50 overflow-y-auto border-t border-white/[0.08]"
        style="display: none; -webkit-overflow-scrolling: touch;"
    >
        <div class="px-4 sm:px-5 py-6 pb-[calc(2.5rem+env(safe-area-inset-bottom,0px))] space-y-4 max-w-lg mx-auto">
            
            <!-- Language Switcher in Drawer Top -->
            <div class="flex items-center justify-between p-3 rounded-2xl bg-white/5 border border-white/10">
                <span class="text-xs font-semibold text-white/70">{{ __('common.language') }}:</span>
                @include('components.language-switcher')
            </div>

            <!-- Navigation Links List with Icons & Badges -->
            <div class="space-y-1">
                <a 
                    href="{{ route('home') }}" 
                    class="flex items-center justify-between px-3.5 py-3 rounded-xl text-sm font-semibold transition {{ request()->routeIs('home') ? 'bg-white/10 text-[#D4AF37] border-l-4 border-[#D4AF37]' : 'text-white/90 hover:bg-white/5 hover:text-white' }}"
                    @click="mobileMenuOpen = false"
                >
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        <span>{{ __('nav.home') }}</span>
                    </div>
                    @if(request()->routeIs('home'))
                        <span class="w-1.5 h-1.5 rounded-full bg-[#D4AF37]"></span>
                    @endif
                </a>

                <a 
                    href="{{ route('tours.index') }}" 
                    class="flex items-center justify-between px-3.5 py-3 rounded-xl text-sm font-semibold transition {{ request()->routeIs('tours*') ? 'bg-white/10 text-[#D4AF37] border-l-4 border-[#D4AF37]' : 'text-white/90 hover:bg-white/5 hover:text-white' }}"
                    @click="mobileMenuOpen = false"
                >
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>{{ __('nav.tours') }}</span>
                    </div>
                    @if(request()->routeIs('tours*'))
                        <span class="w-1.5 h-1.5 rounded-full bg-[#D4AF37]"></span>
                    @endif
                </a>

                <a 
                    href="{{ route('destinations.index') }}" 
                    class="flex items-center justify-between px-3.5 py-3 rounded-xl text-sm font-semibold transition {{ request()->routeIs('destinations*') ? 'bg-white/10 text-[#D4AF37] border-l-4 border-[#D4AF37]' : 'text-white/90 hover:bg-white/5 hover:text-white' }}"
                    @click="mobileMenuOpen = false"
                >
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span>{{ __('nav.destinations') }}</span>
                    </div>
                    @if(request()->routeIs('destinations*'))
                        <span class="w-1.5 h-1.5 rounded-full bg-[#D4AF37]"></span>
                    @endif
                </a>

                <a 
                    href="{{ route('visa.index') }}" 
                    class="flex items-center justify-between px-3.5 py-3 rounded-xl text-sm font-semibold transition {{ request()->routeIs('visa*') ? 'bg-white/10 text-[#D4AF37] border-l-4 border-[#D4AF37]' : 'text-white/90 hover:bg-white/5 hover:text-white' }}"
                    @click="mobileMenuOpen = false"
                >
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <span>{{ __('nav.visa') }}</span>
                    </div>
                    @if(request()->routeIs('visa*'))
                        <span class="w-1.5 h-1.5 rounded-full bg-[#D4AF37]"></span>
                    @endif
                </a>

                <a 
                    href="{{ route('ticketing.index') }}" 
                    class="flex items-center justify-between px-3.5 py-3 rounded-xl text-sm font-semibold transition {{ request()->routeIs('ticketing*') ? 'bg-white/10 text-[#D4AF37] border-l-4 border-[#D4AF37]' : 'text-white/90 hover:bg-white/5 hover:text-white' }}"
                    @click="mobileMenuOpen = false"
                >
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                        <span>{{ __('nav.ticketing') }}</span>
                    </div>
                    @if(request()->routeIs('ticketing*'))
                        <span class="w-1.5 h-1.5 rounded-full bg-[#D4AF37]"></span>
                    @endif
                </a>

                <a 
                    href="{{ route('gallery.index') }}" 
                    class="flex items-center justify-between px-3.5 py-3 rounded-xl text-sm font-semibold transition {{ request()->routeIs('gallery*') ? 'bg-white/10 text-[#D4AF37] border-l-4 border-[#D4AF37]' : 'text-white/90 hover:bg-white/5 hover:text-white' }}"
                    @click="mobileMenuOpen = false"
                >
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span>{{ __('nav.gallery') }}</span>
                    </div>
                    @if(request()->routeIs('gallery*'))
                        <span class="w-1.5 h-1.5 rounded-full bg-[#D4AF37]"></span>
                    @endif
                </a>

                <a 
                    href="{{ route('blog.index') }}" 
                    class="flex items-center justify-between px-3.5 py-3 rounded-xl text-sm font-semibold transition {{ request()->routeIs('blog*') ? 'bg-white/10 text-[#D4AF37] border-l-4 border-[#D4AF37]' : 'text-white/90 hover:bg-white/5 hover:text-white' }}"
                    @click="mobileMenuOpen = false"
                >
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                        <span>{{ __('nav.blog') }}</span>
                    </div>
                    @if(request()->routeIs('blog*'))
                        <span class="w-1.5 h-1.5 rounded-full bg-[#D4AF37]"></span>
                    @endif
                </a>

                <a 
                    href="{{ route('about') }}" 
                    class="flex items-center justify-between px-3.5 py-3 rounded-xl text-sm font-semibold transition {{ request()->routeIs('about') ? 'bg-white/10 text-[#D4AF37] border-l-4 border-[#D4AF37]' : 'text-white/90 hover:bg-white/5 hover:text-white' }}"
                    @click="mobileMenuOpen = false"
                >
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        <span>{{ __('nav.about') }}</span>
                    </div>
                    @if(request()->routeIs('about'))
                        <span class="w-1.5 h-1.5 rounded-full bg-[#D4AF37]"></span>
                    @endif
                </a>

                <a 
                    href="{{ route('contact.index') }}" 
                    class="flex items-center justify-between px-3.5 py-3 rounded-xl text-sm font-semibold transition {{ request()->routeIs('contact*') ? 'bg-white/10 text-[#D4AF37] border-l-4 border-[#D4AF37]' : 'text-white/90 hover:bg-white/5 hover:text-white' }}"
                    @click="mobileMenuOpen = false"
                >
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <span>{{ __('nav.contact') }}</span>
                    </div>
                    @if(request()->routeIs('contact*'))
                        <span class="w-1.5 h-1.5 rounded-full bg-[#D4AF37]"></span>
                    @endif
                </a>
            </div>

            <!-- Direct Instant Contact Action Cards -->
            <div class="pt-4 border-t border-white/[0.08] space-y-2.5">
                <a 
                    href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsapp) }}?text=Hello%20Emisha%20Tours,%20I%20would%20like%20to%20plan%20a%20trip." 
                    target="_blank" 
                    class="btn btn-whatsapp w-full py-3 text-xs font-bold flex items-center justify-center gap-2 rounded-xl"
                >
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                    <span>{{ __('common.whatsapp_us') }} 24/7</span>
                </a>
                
                <a 
                    href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}" 
                    class="btn btn-outline-white w-full py-3 text-xs font-semibold flex items-center justify-center gap-2 rounded-xl"
                >
                    <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    <span>{{ __('common.call_us') }}: {{ $phone }}</span>
                </a>
            </div>

            <!-- Mobile Drawer Info Footer -->
            <div class="pt-3 border-t border-white/[0.08] text-[11px] text-white/50 text-center space-y-1">
                <div>{{ __('common.office_hours') }}: {{ $hours }}</div>
                <div>Emisha Tours & Travels • Dhaka, Bangladesh</div>
            </div>
        </div>
    </div>
</header>
