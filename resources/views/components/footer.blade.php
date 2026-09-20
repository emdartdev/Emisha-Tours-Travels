@php
    $phone = App\Models\Setting::get('contact_phone', '+880 1805-464291');
    $phone2 = App\Models\Setting::get('contact_phone_2', '+880 1805-464292');
    $phone3 = App\Models\Setting::get('contact_phone_3', '+880 1805-464293');
    $phone4 = App\Models\Setting::get('contact_phone_4', '+880 1805-464294');
    $whatsapp = App\Models\Setting::get('contact_whatsapp', '+880 1805-464291');
    $email = App\Models\Setting::get('contact_email', 'info@emishatours.com');
    $address = App\Models\Setting::get('office_address', 'Union Bank Building (6th Floor), 1281, East Monipur, Begum Rokeya Sarani, Mirpur, Dhaka');
    $landmark = App\Models\Setting::get('office_landmark', 'Kazipara Metro Station (Pillar No. 267)');
    $googleMapUrl = App\Models\Setting::get('google_maps_url', 'https://maps.app.goo.gl/yVBQmUfCS57Esag76');
    $hours = App\Models\Setting::get('office_hours', 'Saturday – Thursday: 10:00 AM – 6:30 PM');
    $footerAbout = App\Models\Setting::get('footer_about', 'Emisha Tours & Travels is a premier travel agency in Bangladesh offering customized international holiday packages, certified visa consultancy, and global air ticketing solutions tailored with luxury and reliability.');
    $disclaimer = App\Models\Setting::get('visa_disclaimer', 'Emisha Tours & Travels operates as an independent, certified travel consultancy and visa assistance provider. Final visa issuance decisions rest solely with the respective embassies and immigration authorities.');
    $fb = App\Models\Setting::get('facebook_url', 'https://facebook.com/emishatravels');
    $ig = App\Models\Setting::get('instagram_url', 'https://instagram.com/emishatravels');
    $yt = App\Models\Setting::get('youtube_url', 'https://youtube.com/@emishatravels');
    $li = App\Models\Setting::get('linkedin_url', 'https://linkedin.com/company/emishatravels');
@endphp

<!-- =========================================================================
     EMISHA TOURS & TRAVELS — MODERN LUXURY FOOTER & HOTLINES HUB
     ========================================================================= -->
<footer class="main-footer bg-[#071527] text-white/80 pt-12 sm:pt-16 pb-8 border-t border-[#D4AF37]/30 relative overflow-hidden font-sans">
    
    <!-- Ambient Background Glow Accents -->
    <div class="absolute -top-24 left-1/4 w-96 h-96 bg-[#D4AF37]/5 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 right-10 w-96 h-96 bg-[#0B1F3A]/80 rounded-full blur-3xl pointer-events-none"></div>

    <div class="container-custom relative z-10 max-w-7xl">

        <!-- Top Pre-Footer Fast Consultation CTA Banner -->
        <div class="mb-12 sm:mb-16 p-6 sm:p-8 md:p-10 rounded-2xl sm:rounded-[28px] bg-gradient-to-r from-[#0B1F3A]/95 via-[#0E284D]/90 to-[#071527]/95 border border-white/10 shadow-[0_20px_50px_rgba(0,0,0,0.4)] backdrop-blur-xl flex flex-col lg:flex-row items-center justify-between gap-6 relative overflow-hidden">
            <!-- Subtle Gold Accent Light -->
            <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-[#D4AF37]/10 rounded-full blur-2xl pointer-events-none"></div>
            
            <div class="text-center lg:text-left max-w-2xl relative z-10">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#D4AF37]/15 border border-[#D4AF37]/30 text-[#D4AF37] text-xs font-bold uppercase tracking-wider mb-2.5">
                    <span class="w-2 h-2 rounded-full bg-[#D4AF37] animate-pulse"></span>
                    <span>Ready For Your Next Trip?</span>
                </div>
                <h3 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight font-heading">
                    Plan Your Journey With Emisha Tours & Travels
                </h3>
                <p class="text-xs sm:text-sm text-white/75 mt-2 leading-relaxed">
                    Get customized international holiday packages, fast visa assistance, and guaranteed best airfare quotes from our certified travel specialists.
                </p>
            </div>

            <div class="flex flex-wrap items-center justify-center gap-3.5 flex-shrink-0 w-full lg:w-auto relative z-10">
                <a 
                    href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsapp) }}?text={{ urlencode('Hello Emisha Tours, I would like to plan a tour package / visa assistance.') }}" 
                    target="_blank" 
                    class="btn btn-whatsapp text-xs sm:text-sm px-6 py-3 rounded-xl font-bold shadow-lg flex items-center justify-center gap-2.5 w-full sm:w-auto hover:scale-105 transition-transform"
                >
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                    <span>Chat on WhatsApp</span>
                </a>
                <a 
                    href="{{ route('contact') }}" 
                    class="btn btn-gold text-xs sm:text-sm px-6 py-3 rounded-xl font-bold shadow-lg flex items-center justify-center gap-2 w-full sm:w-auto hover:scale-105 transition-transform"
                >
                    <span>Request Custom Quote</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>
        </div>

        <!-- Main Footer Multi-Column Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-8 lg:gap-8 pb-12">
            
            <!-- Column 1: Brand & Interactive Head Office Map Card (lg:col-span-4) -->
            <div class="lg:col-span-4 space-y-5">
                <!-- Brand Logo -->
                <a href="{{ route('home') }}" class="inline-block group" title="Emisha Tours & Travels">
                    <img 
                        src="{{ asset('images/logo.png') }}" 
                        alt="Emisha Tours & Travels" 
                        class="h-[52px] sm:h-[58px] md:h-[62px] max-h-[62px] w-auto object-contain transition-transform duration-300 group-hover:scale-105 drop-shadow-[0_4px_16px_rgba(212,175,55,0.3)]"
                    >
                </a>
                
                <p class="text-xs sm:text-sm text-white/70 leading-relaxed max-w-sm">
                    {{ $footerAbout }}
                </p>

                <!-- Interactive Head Office Card with Google Map Link -->
                <div class="p-4 sm:p-5 rounded-2xl bg-white/[0.04] border border-white/10 hover:border-[#D4AF37]/50 transition-all duration-300 group shadow-lg">
                    <div class="flex items-start justify-between gap-3 mb-2.5">
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-xl bg-[#D4AF37]/15 border border-[#D4AF37]/30 flex items-center justify-center text-[#D4AF37] flex-shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div>
                                <span class="text-[10px] uppercase font-bold text-[#D4AF37] tracking-wider block">Head Office</span>
                                <h5 class="text-xs sm:text-sm font-bold text-white group-hover:text-[#D4AF37] transition-colors">Mirpur, Dhaka</h5>
                            </div>
                        </div>
                        <span class="inline-flex items-center gap-1.5 text-[10px] font-bold text-emerald-400 bg-emerald-500/10 px-2.5 py-0.5 rounded-full border border-emerald-500/20">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                            <span>Open Today</span>
                        </span>
                    </div>

                    <p class="text-xs text-white/80 leading-relaxed mb-2.5 font-medium">
                        {{ $address }}
                    </p>

                    <div class="flex items-center gap-1.5 text-[11px] text-[#D4AF37] bg-[#D4AF37]/10 px-3 py-1 rounded-lg border border-[#D4AF37]/20 mb-3.5">
                        <svg class="w-3.5 h-3.5 text-[#D4AF37] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h8m-8 4h8m-4 8v3m-5-3h10a2 2 0 002-2V6a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zm-1-6h.01M16 14h.01"/>
                        </svg>
                        <span class="font-semibold">{{ $landmark }}</span>
                    </div>

                    <!-- Direct Google Map Button -->
                    <a 
                        href="{{ $googleMapUrl }}" 
                        target="_blank" 
                        rel="noopener noreferrer" 
                        class="w-full py-2.5 px-4 rounded-xl bg-[#0B1F3A] hover:bg-[#D4AF37] text-[#D4AF37] hover:text-[#0B1F3A] border border-[#D4AF37]/30 hover:border-[#D4AF37] text-xs font-bold transition-all duration-200 flex items-center justify-center gap-2 shadow-sm"
                        title="View Emisha Tours & Travels on Google Maps"
                    >
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                        </svg>
                        <span>View on Google Maps</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </a>
                </div>

                <!-- Social Connect Handles -->
                <div>
                    <span class="block text-[11px] uppercase tracking-wider text-white/50 font-semibold mb-2.5">Connect With Us</span>
                    <div class="flex items-center space-x-2.5">
                        <a href="{{ $fb }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-xl bg-white/[0.08] hover:bg-[#D4AF37] hover:text-[#0B1F3A] text-white/80 flex items-center justify-center transition-all duration-200 hover:-translate-y-0.5 shadow-sm" aria-label="Facebook">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="{{ $ig }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-xl bg-white/[0.08] hover:bg-[#D4AF37] hover:text-[#0B1F3A] text-white/80 flex items-center justify-center transition-all duration-200 hover:-translate-y-0.5 shadow-sm" aria-label="Instagram">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        <a href="{{ $yt }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-xl bg-white/[0.08] hover:bg-[#D4AF37] hover:text-[#0B1F3A] text-white/80 flex items-center justify-center transition-all duration-200 hover:-translate-y-0.5 shadow-sm" aria-label="YouTube">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                        <a href="{{ $li }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-xl bg-white/[0.08] hover:bg-[#D4AF37] hover:text-[#0B1F3A] text-white/80 flex items-center justify-center transition-all duration-200 hover:-translate-y-0.5 shadow-sm" aria-label="LinkedIn">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Column 2: Holiday Tour Packages (lg:col-span-2) -->
            <div class="lg:col-span-2">
                <h4 class="text-xs sm:text-sm font-bold uppercase tracking-wider text-white mb-4 relative pb-2.5 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-8 after:h-0.5 after:bg-[#D4AF37] after:rounded-full">
                    Holiday Packages
                </h4>
                <ul class="space-y-2.5 text-xs sm:text-sm">
                    <li><a href="{{ route('tours.index') }}" class="text-white/70 hover:text-[#D4AF37] hover:translate-x-1 inline-block transition-all">All Holiday Packages</a></li>
                    <li><a href="{{ route('tours.index', ['destination' => 'thailand']) }}" class="text-white/70 hover:text-[#D4AF37] hover:translate-x-1 inline-block transition-all">Thailand Tours</a></li>
                    <li><a href="{{ route('tours.index', ['destination' => 'maldives']) }}" class="text-white/70 hover:text-[#D4AF37] hover:translate-x-1 inline-block transition-all">Maldives Luxury Packages</a></li>
                    <li><a href="{{ route('tours.index', ['destination' => 'dubai']) }}" class="text-white/70 hover:text-[#D4AF37] hover:translate-x-1 inline-block transition-all">Dubai City Holidays</a></li>
                    <li><a href="{{ route('tours.index', ['destination' => 'malaysia']) }}" class="text-white/70 hover:text-[#D4AF37] hover:translate-x-1 inline-block transition-all">Malaysia Vacations</a></li>
                    <li><a href="{{ route('tours.index', ['destination' => 'coxs-bazar']) }}" class="text-white/70 hover:text-[#D4AF37] hover:translate-x-1 inline-block transition-all">Cox's Bazar Beach Trip</a></li>
                    <li><a href="{{ route('destinations.index') }}" class="text-white/70 hover:text-[#D4AF37] hover:translate-x-1 inline-block transition-all">Explore Destinations</a></li>
                </ul>
            </div>

            <!-- Column 3: Visa Services & Online Portal (lg:col-span-2) -->
            <div class="lg:col-span-2">
                <h4 class="text-xs sm:text-sm font-bold uppercase tracking-wider text-white mb-4 relative pb-2.5 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-8 after:h-0.5 after:bg-[#D4AF37] after:rounded-full">
                    Visa Services
                </h4>
                <ul class="space-y-2.5 text-xs sm:text-sm">
                    <li>
                        <a href="{{ route('visa.apply') }}" class="text-[#D4AF37] font-bold hover:underline hover:translate-x-1 inline-flex items-center gap-1.5 transition-all">
                            <span>Online Visa Portal</span>
                            <span class="text-[9px] bg-[#D4AF37]/20 text-[#D4AF37] px-1.5 py-0.5 rounded font-extrabold uppercase">Apply</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('visa.track') }}" class="text-white/85 hover:text-[#D4AF37] hover:translate-x-1 inline-flex items-center gap-1.5 transition-all font-semibold">
                            <span>Track Application</span>
                            <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </li>
                    <li><a href="{{ route('visa.apply.slug', 'thailand') }}" class="text-white/70 hover:text-[#D4AF37] hover:translate-x-1 inline-block transition-all">Thailand E-Visa (৳6,000)</a></li>
                    <li><a href="{{ route('visa.apply.slug', 'malaysia') }}" class="text-white/70 hover:text-[#D4AF37] hover:translate-x-1 inline-block transition-all">Malaysia E-Visa (৳4,500)</a></li>
                    <li><a href="{{ route('visa.apply.slug', 'singapore') }}" class="text-white/70 hover:text-[#D4AF37] hover:translate-x-1 inline-block transition-all">Singapore Visa (৳6,000)</a></li>
                    <li><a href="{{ route('visa.apply.slug', 'japan') }}" class="text-white/70 hover:text-[#D4AF37] hover:translate-x-1 inline-block transition-all">Japan Visa (৳3,500)</a></li>
                    <li><a href="{{ route('visa.apply.slug', 'usa') }}" class="text-white/70 hover:text-[#D4AF37] hover:translate-x-1 inline-block transition-all">USA B1/B2 (৳15,000)</a></li>
                    <li><a href="{{ route('visa.apply.slug', 'europe-schengen') }}" class="text-white/70 hover:text-[#D4AF37] hover:translate-x-1 inline-block transition-all">Schengen Visa (৳15,000)</a></li>
                </ul>
            </div>

            <!-- Column 4: Quick Links & Information (lg:col-span-2) -->
            <div class="lg:col-span-2">
                <h4 class="text-xs sm:text-sm font-bold uppercase tracking-wider text-white mb-4 relative pb-2.5 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-8 after:h-0.5 after:bg-[#D4AF37] after:rounded-full">
                    Information
                </h4>
                <ul class="space-y-2.5 text-xs sm:text-sm">
                    <li><a href="{{ route('about') }}" class="text-white/70 hover:text-[#D4AF37] hover:translate-x-1 inline-block transition-all">About Emisha</a></li>
                    <li><a href="{{ route('blog.index') }}" class="text-white/70 hover:text-[#D4AF37] hover:translate-x-1 inline-block transition-all">Travel Guides & Blog</a></li>
                    <li><a href="{{ route('gallery') }}" class="text-white/70 hover:text-[#D4AF37] hover:translate-x-1 inline-block transition-all">Tour Photo Gallery</a></li>
                    <li><a href="{{ route('faq') }}" class="text-white/70 hover:text-[#D4AF37] hover:translate-x-1 inline-block transition-all">Frequently Asked Questions</a></li>
                    <li><a href="{{ route('ticketing') }}" class="text-white/70 hover:text-[#D4AF37] hover:translate-x-1 inline-block transition-all">Air Ticket Booking</a></li>
                    <li><a href="{{ route('contact') }}" class="text-white/70 hover:text-[#D4AF37] hover:translate-x-1 inline-block transition-all">Contact Us</a></li>
                    <li><a href="{{ route('page.show', 'privacy-policy') }}" class="text-white/70 hover:text-[#D4AF37] hover:translate-x-1 inline-block transition-all">Privacy Policy</a></li>
                </ul>
            </div>

            <!-- Column 5: Redesigned Office & Hotlines Hub (lg:col-span-2) -->
            <div class="lg:col-span-2 space-y-4">
                <h4 class="text-xs sm:text-sm font-bold uppercase tracking-wider text-white mb-4 relative pb-2.5 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-8 after:h-0.5 after:bg-[#D4AF37] after:rounded-full">
                    Department Hotlines
                </h4>

                <!-- Hotlines Card List (Mapped with Exact Purpose) -->
                <div class="space-y-2">
                    <!-- Line 1: Air Ticketing & Main Hotline -->
                    <a 
                        href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}" 
                        class="flex items-center justify-between p-2.5 rounded-xl bg-white/[0.06] hover:bg-[#D4AF37]/15 border border-white/10 hover:border-[#D4AF37]/50 transition-all duration-200 group"
                        title="Call Air Ticketing Desk"
                    >
                        <div class="flex items-center gap-2 min-w-0">
                            <span class="w-6 h-6 rounded-lg bg-[#D4AF37] text-[#0B1F3A] flex items-center justify-center flex-shrink-0">
                                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"/></svg>
                            </span>
                            <div class="truncate">
                                <span class="text-[10px] text-[#D4AF37] font-bold uppercase tracking-wider block">Air Ticketing</span>
                                <span class="text-xs font-bold text-white group-hover:text-[#D4AF37] transition-colors truncate block">
                                    {{ $phone }}
                                </span>
                            </div>
                        </div>
                        <span class="text-[9px] uppercase tracking-wider font-extrabold bg-[#D4AF37] text-[#0B1F3A] px-1.5 py-0.5 rounded shadow-2xs flex-shrink-0">
                            Hotline
                        </span>
                    </a>

                    <!-- Line 2: Hajj & Umrah Desk -->
                    <a 
                        href="tel:{{ preg_replace('/[^0-9+]/', '', $phone2) }}" 
                        class="flex items-center justify-between p-2.5 rounded-xl bg-white/[0.03] hover:bg-white/[0.08] border border-white/[0.08] hover:border-[#D4AF37]/40 transition-all duration-200 group"
                        title="Call Hajj & Umrah Desk"
                    >
                        <div class="flex items-center gap-2 min-w-0">
                            <span class="w-6 h-6 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center flex-shrink-0 group-hover:bg-emerald-500 group-hover:text-white transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            </span>
                            <div class="truncate">
                                <span class="text-[10px] text-emerald-400 font-bold uppercase tracking-wider block">Hajj & Umrah</span>
                                <span class="text-xs font-semibold text-white/90 group-hover:text-[#D4AF37] transition-colors truncate block">
                                    {{ $phone2 }}
                                </span>
                            </div>
                        </div>
                    </a>

                    <!-- Line 3: Emisha Academy -->
                    <a 
                        href="tel:{{ preg_replace('/[^0-9+]/', '', $phone3) }}" 
                        class="flex items-center justify-between p-2.5 rounded-xl bg-white/[0.03] hover:bg-white/[0.08] border border-white/[0.08] hover:border-[#D4AF37]/40 transition-all duration-200 group"
                        title="Call Academy Desk"
                    >
                        <div class="flex items-center gap-2 min-w-0">
                            <span class="w-6 h-6 rounded-lg bg-blue-500/20 text-blue-400 flex items-center justify-center flex-shrink-0 group-hover:bg-blue-500 group-hover:text-white transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5"/></svg>
                            </span>
                            <div class="truncate">
                                <span class="text-[10px] text-blue-400 font-bold uppercase tracking-wider block">Academy</span>
                                <span class="text-xs font-semibold text-white/90 group-hover:text-[#D4AF37] transition-colors truncate block">
                                    {{ $phone3 }}
                                </span>
                            </div>
                        </div>
                    </a>

                    <!-- Line 4: VISA Consultancy -->
                    <a 
                        href="tel:{{ preg_replace('/[^0-9+]/', '', $phone4) }}" 
                        class="flex items-center justify-between p-2.5 rounded-xl bg-white/[0.03] hover:bg-white/[0.08] border border-white/[0.08] hover:border-[#D4AF37]/40 transition-all duration-200 group"
                        title="Call VISA Desk"
                    >
                        <div class="flex items-center gap-2 min-w-0">
                            <span class="w-6 h-6 rounded-lg bg-amber-500/20 text-amber-400 flex items-center justify-center flex-shrink-0 group-hover:bg-amber-500 group-hover:text-[#0B1F3A] transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </span>
                            <div class="truncate">
                                <span class="text-[10px] text-[#D4AF37] font-bold uppercase tracking-wider block">VISA Services</span>
                                <span class="text-xs font-semibold text-white/90 group-hover:text-[#D4AF37] transition-colors truncate block">
                                    {{ $phone4 }}
                                </span>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Instant WhatsApp Modal Trigger Banner -->
                <button 
                    type="button"
                    onclick="window.dispatchEvent(new CustomEvent('open-whatsapp-modal'))" 
                    class="w-full p-2.5 rounded-xl bg-emerald-500/10 hover:bg-emerald-500/20 border border-emerald-500/30 hover:border-emerald-500/50 flex items-center justify-between text-xs transition-all group cursor-pointer text-left"
                >
                    <div class="flex items-center gap-2 min-w-0">
                        <span class="w-6 h-6 rounded-lg bg-emerald-500 text-white flex items-center justify-center flex-shrink-0 shadow-sm">
                            <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                        </span>
                        <div class="truncate">
                            <span class="text-[10px] text-emerald-400 font-bold uppercase tracking-wider block">WhatsApp Support Hub</span>
                            <span class="text-xs font-bold text-emerald-300 group-hover:text-emerald-200">Choose Department</span>
                        </div>
                    </div>
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse flex-shrink-0"></span>
                </button>

                <!-- Email Card -->
                <a 
                    href="mailto:{{ $email }}" 
                    class="p-2.5 rounded-xl bg-white/[0.03] hover:bg-white/[0.08] border border-white/[0.08] hover:border-[#D4AF37]/40 flex items-center gap-2 text-xs transition-all group"
                >
                    <div class="w-6 h-6 rounded-lg bg-[#D4AF37]/15 text-[#D4AF37] flex items-center justify-center flex-shrink-0">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <span class="text-xs font-semibold text-white/80 group-hover:text-[#D4AF37] transition-colors truncate">
                        {{ $email }}
                    </span>
                </a>

                <!-- Operating Hours Card -->
                <div class="p-3 rounded-xl bg-white/[0.02] border border-white/[0.06] text-xs text-white/60 space-y-1">
                    <div class="flex items-center gap-1.5 text-white/90 font-bold text-[11.5px]">
                        <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Office Hours</span>
                    </div>
                    <p class="text-[11px] text-white/75 leading-relaxed font-medium">
                        {{ $hours }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Compliance & Regulatory Visa Disclaimer Box -->
        @if($disclaimer)
        <div class="mt-4 p-4 rounded-xl bg-white/[0.03] border border-white/[0.08] text-xs text-white/60 leading-relaxed">
            <span class="text-[#D4AF37] font-bold">Important Notice:</span> {{ $disclaimer }}
        </div>
        @endif

        <!-- Footer Bottom Bar with Copyright & Safe Badges -->
        <div class="footer-bottom mt-8 pt-6 border-t border-white/[0.08] flex flex-col md:flex-row items-center justify-between text-xs text-white/50 gap-4">
            <div class="text-center md:text-left flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4">
                <span>© {{ date('Y') }} <strong class="text-white/90 font-bold">Emisha Tours & Travels</strong>. All Rights Reserved.</span>
                <span class="hidden sm:inline text-white/20">•</span>
                <span class="text-xs text-[#D4AF37]/90 font-semibold">Govt. Approved Travel Agency & Visa Desk</span>
            </div>
            
            <div class="flex flex-wrap items-center justify-center gap-3 sm:gap-4 text-xs">
                <a href="{{ route('page.show', 'privacy-policy') }}" class="hover:text-[#D4AF37] transition-colors">Privacy Policy</a>
                <span class="text-white/20">•</span>
                <a href="{{ route('page.show', 'terms-and-conditions') }}" class="hover:text-[#D4AF37] transition-colors">Terms of Service</a>
                <span class="text-white/20">•</span>
                <a href="{{ route('page.show', 'refund-cancellation-policy') }}" class="hover:text-[#D4AF37] transition-colors">Refund Policy</a>
                <span class="text-white/20">•</span>
                <a href="{{ route('page.show', 'visa-disclaimer') }}" class="hover:text-[#D4AF37] transition-colors">Visa Disclaimer</a>
            </div>
        </div>
    </div>
</footer>

<!-- =========================================================================
     FLOATING ACTION BUTTONS & DEPARTMENT POPUP MODAL DIALOG
     ========================================================================= -->
<div 
    x-data="{ showWhatsAppModal: false }"
    @open-whatsapp-modal.window="showWhatsAppModal = true"
    @keydown.escape.window="showWhatsAppModal = false"
>
    <!-- Floating Bottom-Right Buttons with Safe-Area Inset Support -->
    <div class="floating-actions fixed bottom-[calc(1rem+env(safe-area-inset-bottom,0px))] right-[calc(1rem+env(safe-area-inset-right,0px))] sm:bottom-6 sm:right-6 z-40 flex flex-col gap-2.5">
        <!-- Floating WhatsApp Button (Opens Interactive Department Modal) -->
        <button 
            type="button"
            @click="showWhatsAppModal = true" 
            class="w-12 h-12 sm:w-13 sm:h-13 rounded-full bg-[#25D366] hover:bg-[#20ba5a] text-white flex items-center justify-center shadow-[0_8px_24px_rgba(37,211,102,0.4)] hover:scale-110 hover:-translate-y-1 transition-all duration-200 active:scale-95 cursor-pointer relative group" 
            title="Open WhatsApp Department Desk" 
            aria-label="WhatsApp Support"
        >
            <span class="absolute -top-1 -right-1 flex h-3 w-3">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-300 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-white"></span>
            </span>
            <svg class="w-6 h-6 sm:w-7 sm:h-7 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
        </button>

        <!-- Floating Direct Call Hotline Button -->
        <a 
            href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}" 
            class="w-12 h-12 sm:w-13 sm:h-13 rounded-full bg-[#0B1F3A] text-[#D4AF37] border border-[#D4AF37]/50 flex items-center justify-center shadow-[0_8px_24px_rgba(11,31,58,0.5)] hover:scale-110 hover:-translate-y-1 transition-all duration-200 active:scale-95" 
            title="Call Primary Hotline: {{ $phone }}" 
            aria-label="Helpline Phone Call"
        >
            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
        </a>
    </div>

    <!-- Interactive WhatsApp Department Selection Modal Dialog -->
    <div 
        x-show="showWhatsAppModal" 
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
            @click.away="showWhatsAppModal = false"
            class="bg-white rounded-3xl sm:rounded-[32px] w-full max-w-lg md:max-w-xl p-4 sm:p-6 md:p-7 shadow-2xl border border-slate-100 relative overflow-hidden my-auto max-h-[90vh] max-h-[90dvh] flex flex-col"
        >
            <!-- Close Button -->
            <button 
                type="button" 
                @click="showWhatsAppModal = false" 
                class="absolute top-4 right-4 w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-800 flex items-center justify-center transition-colors z-20 cursor-pointer"
                aria-label="Close"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>

            <!-- Modal Header -->
            <div class="text-left pb-4 border-b border-slate-100 pr-8">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-300 text-emerald-800 text-[11px] font-bold uppercase tracking-wider mb-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>24/7 Live Support Desk</span>
                </div>
                <h3 class="text-xl sm:text-2xl font-extrabold text-[#0B1F3A] font-heading leading-snug">
                    Choose Your Department
                </h3>
                <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                    Select your required service to chat directly with our specialized officers on WhatsApp or make an instant phone call.
                </p>
            </div>

            <!-- Scrollable Department Cards List -->
            <div class="overflow-y-auto py-4 space-y-3 overscroll-contain pr-1">
                
                <!-- 1. Air Ticketing Desk -->
                <div class="p-3.5 sm:p-4 rounded-2xl bg-slate-50 hover:bg-blue-50/50 border border-slate-200/80 transition-all flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-xl bg-[#0B1F3A] text-[#D4AF37] flex items-center justify-center flex-shrink-0 shadow-sm">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"/></svg>
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <h4 class="text-sm font-bold text-[#0B1F3A]">Air Ticketing Desk</h4>
                                <span class="text-[9px] uppercase font-bold bg-[#D4AF37] text-[#0B1F3A] px-1.5 py-0.2 rounded">Hotline</span>
                            </div>
                            <p class="text-[11px] text-slate-500">Flight Bookings, Date Change & GDS Fares</p>
                            <span class="text-xs font-mono font-bold text-slate-800 block mt-0.5">{{ $phone }}</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 flex-shrink-0 self-end sm:self-center">
                        <a 
                            href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $phone) }}?text={{ urlencode('Hello Emisha Air Ticketing Desk, I need assistance regarding flight ticket booking / issuance.') }}" 
                            target="_blank"
                            class="px-3.5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs flex items-center gap-1.5 shadow-xs transition"
                        >
                            <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                            <span>WhatsApp</span>
                        </a>
                        <a 
                            href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}" 
                            class="p-2 rounded-xl bg-slate-200 hover:bg-slate-300 text-slate-700 transition"
                            title="Call {{ $phone }}"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- 2. Hajj & Umrah Desk -->
                <div class="p-3.5 sm:p-4 rounded-2xl bg-slate-50 hover:bg-emerald-50/50 border border-slate-200/80 transition-all flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-xl bg-emerald-900 text-emerald-300 flex items-center justify-center flex-shrink-0 shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-[#0B1F3A]">Hajj & Umrah Desk</h4>
                            <p class="text-[11px] text-slate-500">Custom Umrah Packages, VIP Visa & Hotel</p>
                            <span class="text-xs font-mono font-bold text-slate-800 block mt-0.5">{{ $phone2 }}</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 flex-shrink-0 self-end sm:self-center">
                        <a 
                            href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $phone2) }}?text={{ urlencode('Hello Emisha Hajj & Umrah Desk, I am inquiring about Umrah packages and VIP visa services.') }}" 
                            target="_blank"
                            class="px-3.5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs flex items-center gap-1.5 shadow-xs transition"
                        >
                            <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                            <span>WhatsApp</span>
                        </a>
                        <a 
                            href="tel:{{ preg_replace('/[^0-9+]/', '', $phone2) }}" 
                            class="p-2 rounded-xl bg-slate-200 hover:bg-slate-300 text-slate-700 transition"
                            title="Call {{ $phone2 }}"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- 3. Emisha Academy -->
                <div class="p-3.5 sm:p-4 rounded-2xl bg-slate-50 hover:bg-purple-50/50 border border-slate-200/80 transition-all flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-xl bg-purple-900 text-purple-300 flex items-center justify-center flex-shrink-0 shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5"/></svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-[#0B1F3A]">Emisha Academy</h4>
                            <p class="text-[11px] text-slate-500">Aviation, IATA GDS Training & Courses</p>
                            <span class="text-xs font-mono font-bold text-slate-800 block mt-0.5">{{ $phone3 }}</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 flex-shrink-0 self-end sm:self-center">
                        <a 
                            href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $phone3) }}?text={{ urlencode('Hello Emisha Academy, I am inquiring about travel training and IATA courses.') }}" 
                            target="_blank"
                            class="px-3.5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs flex items-center gap-1.5 shadow-xs transition"
                        >
                            <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                            <span>WhatsApp</span>
                        </a>
                        <a 
                            href="tel:{{ preg_replace('/[^0-9+]/', '', $phone3) }}" 
                            class="p-2 rounded-xl bg-slate-200 hover:bg-slate-300 text-slate-700 transition"
                            title="Call {{ $phone3 }}"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- 4. VISA Consultancy Desk -->
                <div class="p-3.5 sm:p-4 rounded-2xl bg-amber-50/70 border border-amber-200/80 transition-all flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-xl bg-[#0B1F3A] text-[#D4AF37] flex items-center justify-center flex-shrink-0 shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-[#0B1F3A]">VISA Services Desk</h4>
                            <p class="text-[11px] text-slate-600">Tourist Visas, Document Audit & Embassy</p>
                            <span class="text-xs font-mono font-bold text-slate-900 block mt-0.5">{{ $phone4 }}</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 flex-shrink-0 self-end sm:self-center">
                        <a 
                            href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $phone4) }}?text={{ urlencode('Hello Emisha Visa Desk, I need assistance regarding visa application and documentation.') }}" 
                            target="_blank"
                            class="px-3.5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs flex items-center gap-1.5 shadow-xs transition"
                        >
                            <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                            <span>WhatsApp</span>
                        </a>
                        <a 
                            href="tel:{{ preg_replace('/[^0-9+]/', '', $phone4) }}" 
                            class="p-2 rounded-xl bg-slate-200 hover:bg-slate-300 text-slate-700 transition"
                            title="Call {{ $phone4 }}"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </a>
                    </div>
                </div>

            </div>

            <!-- Modal Footer -->
            <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span>Head Office: Begum Rokeya Sarani, Mirpur, Dhaka</span>
                <button 
                    type="button" 
                    @click="showWhatsAppModal = false" 
                    class="text-[#0B1F3A] font-bold hover:underline cursor-pointer"
                >
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
