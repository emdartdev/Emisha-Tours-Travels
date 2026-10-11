@php
    $phone = App\Models\Setting::get('contact_phone', '+880 1805-464291');
    $phone2 = App\Models\Setting::get('contact_phone_2', '+880 1805-464292');
    $phone3 = App\Models\Setting::get('contact_phone_3', '+880 1805-464293');
    $phone4 = App\Models\Setting::get('contact_phone_4', '+880 1805-464294');
    $whatsapp = App\Models\Setting::get('contact_whatsapp', '+880 1805-464291');
    $email = App\Models\Setting::get('contact_email', 'info@emishatours.com');
    $address = app()->getLocale() === 'bn' 
        ? App\Models\Setting::get('office_address_bn', 'ইউনিয়ন ব্যাংক ভবন (৬ষ্ঠ তলা), ১২৮১, পূর্ব মনিপুর, বেগম রোকেয়া সরণি, মিরপুর, ঢাকা') 
        : App\Models\Setting::get('office_address', 'Union Bank Building (6th Floor), 1281, East Monipur, Begum Rokeya Sarani, Mirpur, Dhaka');
    $landmark = app()->getLocale() === 'bn'
        ? App\Models\Setting::get('office_landmark_bn', 'কাজীপাড়া মেট্রো স্টেশন (পিলার নং ২৬৭)')
        : App\Models\Setting::get('office_landmark', 'Kazipara Metro Station (Pillar No. 267)');
    $googleMapUrl = App\Models\Setting::get('google_maps_url', 'https://maps.app.goo.gl/yVBQmUfCS57Esag76');
    $hours = app()->getLocale() === 'bn'
        ? App\Models\Setting::get('office_hours_bn', 'শনিবার – বৃহস্পতিবার: সকাল ১০:০০ – সন্ধ্যা ৬:৩০')
        : App\Models\Setting::get('office_hours', 'Saturday – Thursday: 10:00 AM – 6:30 PM');
    $footerAbout = app()->getLocale() === 'bn'
        ? App\Models\Setting::get('footer_about_bn', 'এমিসা ট্যুরস অ্যান্ড ট্রাভেলস বাংলাদেশের একটি বিশ্বস্ত ট্রাভেল এজেন্সি, যা আন্তর্জাতিক ছুটির প্যাকেজ, সার্টিফাইড ভিসা কনসালটেন্সি এবং গ্লোবাল এয়ার টিকেটিং সল্যুশন প্রদান করে।')
        : App\Models\Setting::get('footer_about', 'Emisha Tours & Travels is a premier travel agency in Bangladesh offering customized international holiday packages, certified visa consultancy, and global air ticketing solutions tailored with luxury and reliability.');
    $disclaimer = app()->getLocale() === 'bn'
        ? App\Models\Setting::get('visa_disclaimer_bn', 'এমিসা ট্যুরস অ্যান্ড ট্রাভেলস একটি স্বাধীন, সার্টিফাইড ট্রাভেল কনসালটেন্সি এবং ভিসা সহায়তা প্রদানকারী প্রতিষ্ঠান। ভিসা ইস্যু করার চূড়ান্ত সিদ্ধান্ত সংশ্লিষ্ট দূতাবাস ও ইমিগ্রেশন কর্তৃপক্ষের উপর নির্ভরশীল।')
        : App\Models\Setting::get('visa_disclaimer', 'Emisha Tours & Travels operates as an independent, certified travel consultancy and visa assistance provider. Final visa issuance decisions rest solely with the respective embassies and immigration authorities.');
    $fb = App\Models\Setting::get('facebook_url', 'https://facebook.com/emishatravels');
    $ig = App\Models\Setting::get('instagram_url', 'https://instagram.com/emishatravels');
    $yt = App\Models\Setting::get('youtube_url', 'https://youtube.com/@emishatravels');
    $li = App\Models\Setting::get('linkedin_url', 'https://linkedin.com/company/emishatravels');
@endphp

<!-- =========================================================================
     EMISHA TOURS & TRAVELS — MODERN MINIMAL LUXURY FOOTER
     ========================================================================= -->
<footer class="main-footer bg-[#050D1A] text-slate-300 pt-14 sm:pt-20 pb-10 border-t border-[#D4AF37]/30 relative overflow-hidden font-sans selection:bg-[#D4AF37] selection:text-[#050D1A]">
    
    <!-- Ambient Background Lighting Orbs -->
    <div class="absolute -top-32 left-1/4 w-[500px] h-[500px] bg-[#D4AF37]/8 rounded-full blur-[140px] pointer-events-none"></div>
    <div class="absolute bottom-0 right-10 w-[600px] h-[600px] bg-blue-600/5 rounded-full blur-[160px] pointer-events-none"></div>

    <div class="container-custom relative z-10 max-w-7xl">

        <!-- 1. Top Pre-Footer Trust Proposition Strip -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5 pb-12 sm:pb-16 border-b border-white/10">
            <!-- Trust 1 -->
            <div class="flex items-center gap-3.5 p-4 rounded-2xl bg-white/[0.03] border border-white/5 hover:border-[#D4AF37]/30 transition-all duration-300 group">
                <div class="w-11 h-11 rounded-xl bg-[#D4AF37]/10 text-[#D4AF37] border border-[#D4AF37]/20 flex items-center justify-center flex-shrink-0 group-hover:scale-105 group-hover:bg-[#D4AF37] group-hover:text-[#050D1A] transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <div>
                    <h4 class="text-xs font-bold text-white uppercase tracking-wider">{{ app()->getLocale() === 'bn' ? 'সরকারি অনুমোদিত এজেন্সি' : 'Govt. Approved Agency' }}</h4>
                    <p class="text-[11px] text-slate-400 mt-0.5">{{ app()->getLocale() === 'bn' ? 'সার্টিফাইড ট্রাভেল ও ভিসা সেবা' : 'Certified travel & visa assistance' }}</p>
                </div>
            </div>

            <!-- Trust 2 -->
            <div class="flex items-center gap-3.5 p-4 rounded-2xl bg-white/[0.03] border border-white/5 hover:border-[#D4AF37]/30 transition-all duration-300 group">
                <div class="w-11 h-11 rounded-xl bg-[#D4AF37]/10 text-[#D4AF37] border border-[#D4AF37]/20 flex items-center justify-center flex-shrink-0 group-hover:scale-105 group-hover:bg-[#D4AF37] group-hover:text-[#050D1A] transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <h4 class="text-xs font-bold text-white uppercase tracking-wider">{{ app()->getLocale() === 'bn' ? '১০০% স্বচ্ছ মূল্যতালিকা' : '100% Transparent Rates' }}</h4>
                    <p class="text-[11px] text-slate-400 mt-0.5">{{ app()->getLocale() === 'bn' ? 'কোনো লুকানো চার্জ নেই' : 'No hidden fees or surprises' }}</p>
                </div>
            </div>

            <!-- Trust 3 -->
            <div class="flex items-center gap-3.5 p-4 rounded-2xl bg-white/[0.03] border border-white/5 hover:border-[#D4AF37]/30 transition-all duration-300 group">
                <div class="w-11 h-11 rounded-xl bg-[#D4AF37]/10 text-[#D4AF37] border border-[#D4AF37]/20 flex items-center justify-center flex-shrink-0 group-hover:scale-105 group-hover:bg-[#D4AF37] group-hover:text-[#050D1A] transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <div>
                    <h4 class="text-xs font-bold text-white uppercase tracking-wider">{{ app()->getLocale() === 'bn' ? 'দ্রুত ভিসা প্রসেসিং' : 'Fast-Track Visa Filing' }}</h4>
                    <p class="text-[11px] text-slate-400 mt-0.5">{{ app()->getLocale() === 'bn' ? 'অভিজ্ঞ অডিট ও ফাইল প্রস্তুতি' : 'Professional scrutiny & submission' }}</p>
                </div>
            </div>

            <!-- Trust 4 -->
            <div class="flex items-center gap-3.5 p-4 rounded-2xl bg-white/[0.03] border border-white/5 hover:border-[#D4AF37]/30 transition-all duration-300 group">
                <div class="w-11 h-11 rounded-xl bg-[#D4AF37]/10 text-[#D4AF37] border border-[#D4AF37]/20 flex items-center justify-center flex-shrink-0 group-hover:scale-105 group-hover:bg-[#D4AF37] group-hover:text-[#050D1A] transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
                <div>
                    <h4 class="text-xs font-bold text-white uppercase tracking-wider">{{ app()->getLocale() === 'bn' ? '২৪/৭ সার্বক্ষণিক সহায়তা' : '24/7 Dedicated Support' }}</h4>
                    <p class="text-[11px] text-slate-400 mt-0.5">{{ app()->getLocale() === 'bn' ? 'ফোন ও হোয়াটসঅ্যাপ হেল্পডেস্ক' : 'Direct phone & WhatsApp team' }}</p>
                </div>
            </div>
        </div>

        <!-- 2. Main Multi-Column Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 lg:gap-8 py-12 sm:py-16">
            
            <!-- Col 1: Brand, Address & Social Handles (lg:col-span-4) -->
            <div class="lg:col-span-4 space-y-6">
                <!-- Brand Emblem -->
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3 group" title="Emisha Tours & Travels">
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-[#D4AF37] to-[#927513] p-0.5 shadow-lg shadow-[#D4AF37]/20 group-hover:scale-105 transition duration-300">
                        <div class="w-full h-full bg-[#071324] rounded-[14px] flex items-center justify-center p-2">
                            <img src="{{ asset('images/logo.png') }}" alt="Emisha Tours & Travels" class="max-h-full max-w-full object-contain">
                        </div>
                    </div>
                    <div>
                        <span class="block font-heading font-extrabold text-lg text-white tracking-wide leading-tight">EMISHA</span>
                        <span class="block text-[10px] font-bold tracking-[0.25em] text-[#D4AF37] uppercase">Tours & Travels</span>
                    </div>
                </a>
                
                <p class="text-xs sm:text-sm text-slate-400 leading-relaxed max-w-sm">
                    {{ $footerAbout }}
                </p>

                <!-- Head Office Location & Navigation Card -->
                <div class="p-4 sm:p-5 rounded-2xl bg-white/[0.04] border border-white/10 hover:border-[#D4AF37]/40 transition-all duration-300 shadow-lg">
                    <div class="flex items-start justify-between gap-3 mb-2.5">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-lg bg-[#D4AF37]/15 text-[#D4AF37] flex items-center justify-center flex-shrink-0">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div>
                                <span class="text-[10px] font-bold uppercase tracking-wider text-[#D4AF37] block">{{ app()->getLocale() === 'bn' ? 'প্রধান কার্যালয়' : 'Head Office' }}</span>
                                <h5 class="text-xs sm:text-sm font-bold text-white">{{ app()->getLocale() === 'bn' ? 'মিরপুর, ঢাকা' : 'Mirpur, Dhaka' }}</h5>
                            </div>
                        </div>
                        <span class="inline-flex items-center gap-1.5 text-[10px] font-bold text-emerald-400 bg-emerald-500/10 px-2.5 py-0.5 rounded-full border border-emerald-500/20">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                            <span>{{ app()->getLocale() === 'bn' ? 'আজ খোলা' : 'Open Today' }}</span>
                        </span>
                    </div>

                    <p class="text-xs text-slate-300 leading-relaxed mb-2 font-normal">
                        {{ $address }}
                    </p>

                    <div class="flex items-center gap-1.5 text-[11px] text-[#D4AF37] bg-[#D4AF37]/10 px-2.5 py-1 rounded-lg border border-[#D4AF37]/20 mb-3 font-medium">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h8m-8 4h8m-4 8v3m-5-3h10a2 2 0 002-2V6a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zm-1-6h.01M16 14h.01"/></svg>
                        <span>{{ $landmark }}</span>
                    </div>

                    <a 
                        href="{{ $googleMapUrl }}" 
                        target="_blank" 
                        rel="noopener noreferrer" 
                        class="w-full py-2 px-3.5 rounded-xl bg-[#0B1F3A] hover:bg-[#D4AF37] text-[#D4AF37] hover:text-[#050D1A] border border-[#D4AF37]/30 hover:border-[#D4AF37] text-xs font-bold transition-all flex items-center justify-center gap-2 group"
                    >
                        <span>{{ app()->getLocale() === 'bn' ? 'গুগল ম্যাপে লোকেশন দেখুন' : 'Get Google Maps Direction' }}</span>
                        <svg class="w-3.5 h-3.5 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </a>
                </div>

                <!-- Social Connect Handles -->
                <div>
                    <span class="block text-[11px] uppercase tracking-wider text-slate-500 font-semibold mb-2.5">{{ app()->getLocale() === 'bn' ? 'সামাজিক যোগাযোগ মাধ্যমে যুক্ত থাকুন' : 'Follow Our Journey' }}</span>
                    <div class="flex items-center space-x-2">
                        <a href="{{ $fb }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-xl bg-white/[0.06] hover:bg-[#D4AF37] hover:text-[#050D1A] text-slate-300 flex items-center justify-center transition-all duration-200 hover:-translate-y-0.5" aria-label="Facebook">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="{{ $ig }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-xl bg-white/[0.06] hover:bg-[#D4AF37] hover:text-[#050D1A] text-slate-300 flex items-center justify-center transition-all duration-200 hover:-translate-y-0.5" aria-label="Instagram">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        <a href="{{ $yt }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-xl bg-white/[0.06] hover:bg-[#D4AF37] hover:text-[#050D1A] text-slate-300 flex items-center justify-center transition-all duration-200 hover:-translate-y-0.5" aria-label="YouTube">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                        <a href="{{ $li }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-xl bg-white/[0.06] hover:bg-[#D4AF37] hover:text-[#050D1A] text-slate-300 flex items-center justify-center transition-all duration-200 hover:-translate-y-0.5" aria-label="LinkedIn">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Col 2: Holiday Tour Packages (lg:col-span-2) -->
            <div class="lg:col-span-2 space-y-4">
                <h4 class="text-xs sm:text-sm font-bold uppercase tracking-wider text-white relative pb-2.5 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-8 after:h-0.5 after:bg-[#D4AF37] after:rounded-full font-heading">
                    {{ app()->getLocale() === 'bn' ? 'হলিডে প্যাকেজ' : 'Holiday Tours' }}
                </h4>
                <ul class="space-y-2 text-xs sm:text-sm">
                    <li><a href="{{ route('tours.index') }}" class="text-slate-400 hover:text-[#D4AF37] hover:translate-x-1 inline-block transition-all">{{ app()->getLocale() === 'bn' ? 'সকল প্যাকেজ' : 'All Holiday Packages' }}</a></li>
                    <li><a href="{{ route('tours.index', ['destination' => 'thailand']) }}" class="text-slate-400 hover:text-[#D4AF37] hover:translate-x-1 inline-block transition-all">{{ app()->getLocale() === 'bn' ? 'থাইল্যান্ড ট্যুর' : 'Thailand Tours' }}</a></li>
                    <li><a href="{{ route('tours.index', ['destination' => 'maldives']) }}" class="text-slate-400 hover:text-[#D4AF37] hover:translate-x-1 inline-block transition-all">{{ app()->getLocale() === 'bn' ? 'মালদ্বীপ লাক্সারি প্যাকেজ' : 'Maldives Packages' }}</a></li>
                    <li><a href="{{ route('tours.index', ['destination' => 'dubai']) }}" class="text-slate-400 hover:text-[#D4AF37] hover:translate-x-1 inline-block transition-all">{{ app()->getLocale() === 'bn' ? 'দুবাই সিটি হলিডে' : 'Dubai City Holidays' }}</a></li>
                    <li><a href="{{ route('tours.index', ['destination' => 'malaysia']) }}" class="text-slate-400 hover:text-[#D4AF37] hover:translate-x-1 inline-block transition-all">{{ app()->getLocale() === 'bn' ? 'মালয়েশিয়া ভ্যাকেশন' : 'Malaysia Vacations' }}</a></li>
                    <li><a href="{{ route('tours.index', ['destination' => 'coxs-bazar']) }}" class="text-slate-400 hover:text-[#D4AF37] hover:translate-x-1 inline-block transition-all">{{ app()->getLocale() === 'bn' ? 'কক্সবাজার সমুদ্র ভ্রমণ' : "Cox's Bazar Beach Trip" }}</a></li>
                    <li><a href="{{ route('destinations.index') }}" class="text-slate-400 hover:text-[#D4AF37] hover:translate-x-1 inline-block transition-all">{{ app()->getLocale() === 'bn' ? 'বিশ্ব গন্তব্যসমূহ' : 'Global Destinations' }}</a></li>
                </ul>
            </div>

            <!-- Col 3: Visa Services & Direct Portals (lg:col-span-2) -->
            <div class="lg:col-span-2 space-y-4">
                <h4 class="text-xs sm:text-sm font-bold uppercase tracking-wider text-white relative pb-2.5 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-8 after:h-0.5 after:bg-[#D4AF37] after:rounded-full font-heading">
                    {{ app()->getLocale() === 'bn' ? 'ভিসা সার্ভিস' : 'Visa Services' }}
                </h4>
                <ul class="space-y-2 text-xs sm:text-sm">
                    <li>
                        <a href="{{ route('visa.apply') }}" class="text-[#D4AF37] font-bold hover:underline hover:translate-x-1 inline-flex items-center gap-1.5 transition-all">
                            <span>{{ app()->getLocale() === 'bn' ? 'অনলাইন ভিসা পোর্টাল' : 'Online Visa Portal' }}</span>
                            <span class="text-[9px] bg-[#D4AF37]/20 text-[#D4AF37] px-1.5 py-0.2 rounded font-extrabold uppercase">Apply</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('visa.track') }}" class="text-slate-300 font-semibold hover:text-[#D4AF37] hover:translate-x-1 inline-flex items-center gap-1.5 transition-all">
                            <span>{{ app()->getLocale() === 'bn' ? 'আবেদন ট্র্যাকিং' : 'Track Application' }}</span>
                            <svg class="w-3 h-3 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </li>
                    <li><a href="{{ route('visa.apply.slug', 'thailand') }}" class="text-slate-400 hover:text-[#D4AF37] hover:translate-x-1 inline-block transition-all">{{ app()->getLocale() === 'bn' ? 'থাইল্যান্ড ই-ভিসা' : 'Thailand E-Visa' }}</a></li>
                    <li><a href="{{ route('visa.apply.slug', 'malaysia') }}" class="text-slate-400 hover:text-[#D4AF37] hover:translate-x-1 inline-block transition-all">{{ app()->getLocale() === 'bn' ? 'মালয়েশিয়া ই-ভিসা' : 'Malaysia E-Visa' }}</a></li>
                    <li><a href="{{ route('visa.apply.slug', 'singapore') }}" class="text-slate-400 hover:text-[#D4AF37] hover:translate-x-1 inline-block transition-all">{{ app()->getLocale() === 'bn' ? 'সিঙ্গাপুর ভিসা' : 'Singapore Visa' }}</a></li>
                    <li><a href="{{ route('visa.apply.slug', 'japan') }}" class="text-slate-400 hover:text-[#D4AF37] hover:translate-x-1 inline-block transition-all">{{ app()->getLocale() === 'bn' ? 'জাপান ভিসা' : 'Japan Visa' }}</a></li>
                    <li><a href="{{ route('visa.apply.slug', 'usa') }}" class="text-slate-400 hover:text-[#D4AF37] hover:translate-x-1 inline-block transition-all">{{ app()->getLocale() === 'bn' ? 'ইউএসএ বি১/বি২' : 'USA B1/B2 Visa' }}</a></li>
                    <li><a href="{{ route('visa.apply.slug', 'europe-schengen') }}" class="text-slate-400 hover:text-[#D4AF37] hover:translate-x-1 inline-block transition-all">{{ app()->getLocale() === 'bn' ? 'শেঞ্জেন ভিসা' : 'Schengen Visa' }}</a></li>
                </ul>
            </div>

            <!-- Col 4: Quick Links & Information (lg:col-span-2) -->
            <div class="lg:col-span-2 space-y-4">
                <h4 class="text-xs sm:text-sm font-bold uppercase tracking-wider text-white relative pb-2.5 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-8 after:h-0.5 after:bg-[#D4AF37] after:rounded-full font-heading">
                    {{ app()->getLocale() === 'bn' ? 'তথ্য ও সাহায্য' : 'Company & Help' }}
                </h4>
                <ul class="space-y-2 text-xs sm:text-sm">
                    <li><a href="{{ route('about') }}" class="text-slate-400 hover:text-[#D4AF37] hover:translate-x-1 inline-block transition-all">{{ app()->getLocale() === 'bn' ? 'এমিসা সম্পর্কে' : 'About Emisha' }}</a></li>
                    <li><a href="{{ route('blog.index') }}" class="text-slate-400 hover:text-[#D4AF37] hover:translate-x-1 inline-block transition-all">{{ app()->getLocale() === 'bn' ? 'ভ্রমণ গাইড ও ব্লগ' : 'Travel Guides & Blog' }}</a></li>
                    <li><a href="{{ route('gallery.index') }}" class="text-slate-400 hover:text-[#D4AF37] hover:translate-x-1 inline-block transition-all">{{ app()->getLocale() === 'bn' ? 'ফটো গ্যালারি' : 'Tour Gallery' }}</a></li>
                    <li><a href="{{ route('faq.index') }}" class="text-slate-400 hover:text-[#D4AF37] hover:translate-x-1 inline-block transition-all">{{ app()->getLocale() === 'bn' ? 'সাধারণ জিজ্ঞাসা (FAQ)' : 'FAQ & Support' }}</a></li>
                    <li><a href="{{ route('ticketing.index') }}" class="text-slate-400 hover:text-[#D4AF37] hover:translate-x-1 inline-block transition-all">{{ app()->getLocale() === 'bn' ? 'এয়ার টিকিট বুকিং' : 'Air Ticketing' }}</a></li>
                    <li><a href="{{ route('contact.index') }}" class="text-slate-400 hover:text-[#D4AF37] hover:translate-x-1 inline-block transition-all">{{ app()->getLocale() === 'bn' ? 'যোগাযোগ ও অফিস' : 'Contact Us' }}</a></li>
                    <li><a href="{{ route('pages.show', 'privacy-policy') }}" class="text-slate-400 hover:text-[#D4AF37] hover:translate-x-1 inline-block transition-all">{{ app()->getLocale() === 'bn' ? 'গোপনীয়তা নীতি' : 'Privacy Policy' }}</a></li>
                </ul>
            </div>

            <!-- Col 5: Departmental Hotlines & Fast WhatsApp Desk (lg:col-span-2) -->
            <div class="lg:col-span-2 space-y-3.5">
                <h4 class="text-xs sm:text-sm font-bold uppercase tracking-wider text-white relative pb-2.5 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-8 after:h-0.5 after:bg-[#D4AF37] after:rounded-full font-heading">
                    {{ app()->getLocale() === 'bn' ? 'বিভাগীয় হটলাইন' : 'Hotlines Desk' }}
                </h4>

                <!-- Hotlines Card 1: Air Ticketing -->
                <a 
                    href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}" 
                    class="flex items-center justify-between p-2.5 rounded-xl bg-white/[0.04] hover:bg-[#D4AF37]/15 border border-white/10 hover:border-[#D4AF37]/50 transition-all duration-200 group"
                    title="Air Ticketing Hotline"
                >
                    <div class="flex items-center gap-2 min-w-0">
                        <span class="w-6 h-6 rounded-lg bg-[#D4AF37] text-[#050D1A] flex items-center justify-center flex-shrink-0 font-bold text-xs">
                            ✈
                        </span>
                        <div class="truncate">
                            <span class="text-[9.5px] text-[#D4AF37] font-bold uppercase tracking-wider block">{{ app()->getLocale() === 'bn' ? 'এয়ার টিকেটিং' : 'Air Ticketing' }}</span>
                            <span class="text-xs font-bold text-white group-hover:text-[#D4AF37] transition-colors truncate block">
                                {{ $phone }}
                            </span>
                        </div>
                    </div>
                </a>

                <!-- Hotlines Card 2: Hajj & Umrah -->
                <a 
                    href="tel:{{ preg_replace('/[^0-9+]/', '', $phone2) }}" 
                    class="flex items-center justify-between p-2.5 rounded-xl bg-white/[0.04] hover:bg-emerald-500/15 border border-white/10 hover:border-emerald-500/40 transition-all duration-200 group"
                    title="Hajj & Umrah Desk"
                >
                    <div class="flex items-center gap-2 min-w-0">
                        <span class="w-6 h-6 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center flex-shrink-0 font-bold text-xs">
                            🕋
                        </span>
                        <div class="truncate">
                            <span class="text-[9.5px] text-emerald-400 font-bold uppercase tracking-wider block">{{ app()->getLocale() === 'bn' ? 'হজ ও ওমরাহ' : 'Hajj & Umrah' }}</span>
                            <span class="text-xs font-semibold text-slate-200 group-hover:text-emerald-300 transition-colors truncate block">
                                {{ $phone2 }}
                            </span>
                        </div>
                    </div>
                </a>

                <!-- Hotlines Card 3: Visa Consultancy -->
                <a 
                    href="tel:{{ preg_replace('/[^0-9+]/', '', $phone4) }}" 
                    class="flex items-center justify-between p-2.5 rounded-xl bg-white/[0.04] hover:bg-amber-500/15 border border-white/10 hover:border-amber-500/40 transition-all duration-200 group"
                    title="Visa Services Desk"
                >
                    <div class="flex items-center gap-2 min-w-0">
                        <span class="w-6 h-6 rounded-lg bg-amber-500/20 text-amber-400 flex items-center justify-center flex-shrink-0 font-bold text-xs">
                            🛂
                        </span>
                        <div class="truncate">
                            <span class="text-[9.5px] text-amber-400 font-bold uppercase tracking-wider block">{{ app()->getLocale() === 'bn' ? 'ভিসা সার্ভিস' : 'VISA Services' }}</span>
                            <span class="text-xs font-semibold text-slate-200 group-hover:text-amber-300 transition-colors truncate block">
                                {{ $phone4 }}
                            </span>
                        </div>
                    </div>
                </a>

                <!-- Interactive WhatsApp Support Modal Trigger -->
                <button 
                    type="button" 
                    onclick="window.dispatchEvent(new CustomEvent('open-whatsapp-modal'))" 
                    class="w-full p-2.5 rounded-xl bg-emerald-500/15 hover:bg-emerald-500/25 border border-emerald-500/30 hover:border-emerald-500/60 flex items-center justify-between text-xs transition-all duration-200 group cursor-pointer text-left"
                >
                    <div class="flex items-center gap-2 min-w-0">
                        <span class="w-6 h-6 rounded-lg bg-emerald-500 text-white flex items-center justify-center flex-shrink-0 shadow-sm">
                            <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                        </span>
                        <div class="truncate">
                            <span class="text-[9.5px] text-emerald-400 font-bold uppercase tracking-wider block">{{ app()->getLocale() === 'bn' ? 'হোয়াটসঅ্যাপ সহায়তা' : 'WhatsApp Hub' }}</span>
                            <span class="text-xs font-bold text-emerald-300 group-hover:text-emerald-200">{{ app()->getLocale() === 'bn' ? 'বিভাগ নির্বাচন' : 'Choose Desk' }}</span>
                        </div>
                    </div>
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse flex-shrink-0"></span>
                </button>

                <!-- Email Link -->
                <a 
                    href="mailto:{{ $email }}" 
                    class="p-2 rounded-xl bg-white/[0.03] hover:bg-white/[0.08] border border-white/10 hover:border-[#D4AF37]/40 flex items-center gap-2 text-xs transition-all duration-200 group"
                >
                    <div class="w-5 h-5 rounded-md bg-[#D4AF37]/15 text-[#D4AF37] flex items-center justify-center flex-shrink-0">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <span class="text-xs text-slate-300 group-hover:text-[#D4AF37] transition-colors truncate">
                        {{ $email }}
                    </span>
                </a>
            </div>
        </div>

        <!-- 3. Visa Regulatory Compliance Disclaimer -->
        @if($disclaimer)
        <div class="p-3.5 sm:p-4 rounded-xl bg-white/[0.02] border border-white/5 text-[11.5px] text-slate-400 leading-relaxed font-normal">
            <span class="text-[#D4AF37] font-semibold">{{ app()->getLocale() === 'bn' ? 'আইনগত বিজ্ঞপ্তি:' : 'Important Notice:' }}</span> {{ $disclaimer }}
        </div>
        @endif

        <!-- 4. Footer Bottom Bar (Copyright, Legal Links & Language Switcher) -->
        <div class="footer-bottom mt-8 pt-6 border-t border-white/10 flex flex-col md:flex-row items-center justify-between text-xs text-slate-500 gap-4">
            <div class="text-center md:text-left flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-3">
                <span>© {{ date('Y') }} <strong class="text-white font-semibold">Emisha Tours & Travels</strong>. {{ app()->getLocale() === 'bn' ? 'সর্বস্বত্ব সংরক্ষিত।' : 'All Rights Reserved.' }}</span>
                <span class="hidden sm:inline text-white/20">•</span>
                <span class="text-xs text-[#D4AF37]/90 font-medium">{{ app()->getLocale() === 'bn' ? 'সরকারি অনুমোদিত ট্রাভেল ও ভিসা কনসালটেন্সি' : 'Govt. Approved Travel & Visa Consultancy' }}</span>
            </div>
            
            <div class="flex flex-wrap items-center justify-center gap-3 sm:gap-4 text-xs">
                <a href="{{ route('pages.show', 'privacy-policy') }}" class="hover:text-[#D4AF37] transition-colors">{{ app()->getLocale() === 'bn' ? 'গোপনীয়তা নীতি' : 'Privacy Policy' }}</a>
                <span class="text-white/20">•</span>
                <a href="{{ route('pages.show', 'terms-and-conditions') }}" class="hover:text-[#D4AF37] transition-colors">{{ app()->getLocale() === 'bn' ? 'শর্তাবলী' : 'Terms' }}</a>
                <span class="text-white/20">•</span>
                <a href="{{ route('pages.show', 'refund-cancellation-policy') }}" class="hover:text-[#D4AF37] transition-colors">{{ app()->getLocale() === 'bn' ? 'রিফান্ড নীতি' : 'Refund Policy' }}</a>
                <span class="text-white/20">•</span>
                <a href="{{ route('pages.show', 'visa-disclaimer') }}" class="hover:text-[#D4AF37] transition-colors">{{ app()->getLocale() === 'bn' ? 'ভিসা ডিসক্লেইমার' : 'Disclaimer' }}</a>
                <span class="text-white/20">•</span>
                
                <!-- Footer Language Switcher Component -->
                <div class="inline-flex items-center">
                    <x-language-switcher variant="footer" />
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- =========================================================================
     FLOATING ACTION BUTTONS & DEPARTMENT POPUP MODAL
     ========================================================================= -->
<div 
    x-data="{ showWhatsAppModal: false }"
    @open-whatsapp-modal.window="showWhatsAppModal = true"
    @keydown.escape.window="showWhatsAppModal = false"
>
    <!-- Floating Quick Actions -->
    <div class="floating-actions fixed bottom-[calc(1rem+env(safe-area-inset-bottom,0px))] right-[calc(1rem+env(safe-area-inset-right,0px))] sm:bottom-6 sm:right-6 z-40 flex flex-col gap-2.5">
        <!-- WhatsApp Department Launcher Button -->
        <button 
            type="button" 
            @click="showWhatsAppModal = true" 
            class="w-12 h-12 sm:w-13 sm:h-13 rounded-full bg-[#25D366] hover:bg-[#20ba5a] text-white flex items-center justify-center shadow-[0_8px_24px_rgba(37,211,102,0.4)] hover:scale-110 hover:-translate-y-1 transition-all duration-200 active:scale-95 cursor-pointer relative group" 
            title="{{ app()->getLocale() === 'bn' ? 'হোয়াটসঅ্যাপ বিভাগীয় ডেস্ক' : 'WhatsApp Department Desk' }}" 
            aria-label="WhatsApp Support"
        >
            <span class="absolute -top-1 -right-1 flex h-3 w-3">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-300 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-white"></span>
            </span>
            <svg class="w-6 h-6 sm:w-7 sm:h-7 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
        </button>

        <!-- Direct Helpline Call Button -->
        <a 
            href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}" 
            class="w-12 h-12 sm:w-13 sm:h-13 rounded-full bg-[#0B1F3A] text-[#D4AF37] border border-[#D4AF37]/50 flex items-center justify-center shadow-[0_8px_24px_rgba(11,31,58,0.5)] hover:scale-110 hover:-translate-y-1 transition-all duration-200 active:scale-95" 
            title="Call Primary Hotline: {{ $phone }}" 
            aria-label="Helpline Phone Call"
        >
            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
        </a>
    </div>

    <!-- Interactive WhatsApp Department Selection Modal -->
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
            class="bg-white rounded-3xl sm:rounded-[32px] w-full max-w-lg md:max-w-xl p-5 sm:p-7 shadow-2xl border border-slate-100 relative overflow-hidden my-auto max-h-[90vh] flex flex-col"
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
                    <span>{{ app()->getLocale() === 'bn' ? '২৪/৭ লাইভ সাপোর্ট ডেস্ক' : '24/7 Live Support Desk' }}</span>
                </div>
                <h3 class="text-xl sm:text-2xl font-extrabold text-[#0B1F3A] font-heading leading-snug">
                    {{ app()->getLocale() === 'bn' ? 'আপনার প্রয়োজনীয় বিভাগ নির্বাচন করুন' : 'Choose Your Department' }}
                </h3>
                <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                    {{ app()->getLocale() === 'bn' ? 'আমাদের বিশেষজ্ঞ কর্মকর্তাদের সাথে সরাসরি হোয়াটসঅ্যাপে চ্যাট করতে বা ফোন কল করতে সেবাটি বেছে নিন।' : 'Select your required service to chat directly with our specialized officers on WhatsApp or make an instant phone call.' }}
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
                                <h4 class="text-sm font-bold text-[#0B1F3A]">{{ app()->getLocale() === 'bn' ? 'এয়ার টিকেটিং ডেস্ক' : 'Air Ticketing Desk' }}</h4>
                                <span class="text-[9px] uppercase font-bold bg-[#D4AF37] text-[#0B1F3A] px-1.5 py-0.2 rounded">{{ app()->getLocale() === 'bn' ? 'হটলাইন' : 'Hotline' }}</span>
                            </div>
                            <p class="text-[11px] text-slate-500">{{ app()->getLocale() === 'bn' ? 'ফ্লাইট বুকিং, তারিখ পরিবর্তন ও জিডিএস ফেয়ার' : 'Flight Bookings, Date Change & GDS Fares' }}</p>
                            <span class="text-xs font-mono font-bold text-slate-800 block mt-0.5">{{ $phone }}</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 flex-shrink-0 self-end sm:self-center">
                        <a 
                            href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $phone) }}?text={{ urlencode(app()->getLocale() === 'bn' ? 'হ্যালো এমিসা এয়ার টিকেটিং ডেস্ক, আমার ফ্লাইট টিকেট বুকিং / তথ্য প্রয়োজন।' : 'Hello Emisha Air Ticketing Desk, I need assistance regarding flight ticket booking / issuance.') }}" 
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
                            <h4 class="text-sm font-bold text-[#0B1F3A]">{{ app()->getLocale() === 'bn' ? 'হজ ও ওমরাহ ডেস্ক' : 'Hajj & Umrah Desk' }}</h4>
                            <p class="text-[11px] text-slate-500">{{ app()->getLocale() === 'bn' ? 'কাস্টম ওমরাহ প্যাকেজ, ভিআইপি ভিসা ও হোটেল' : 'Custom Umrah Packages, VIP Visa & Hotel' }}</p>
                            <span class="text-xs font-mono font-bold text-slate-800 block mt-0.5">{{ $phone2 }}</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 flex-shrink-0 self-end sm:self-center">
                        <a 
                            href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $phone2) }}?text={{ urlencode(app()->getLocale() === 'bn' ? 'হ্যালো এমিসা হজ ও ওমরাহ ডেস্ক, আমি ওমরাহ প্যাকেজ সম্পর্কে জানতে চাচ্ছি।' : 'Hello Emisha Hajj & Umrah Desk, I am inquiring about Umrah packages and VIP visa services.') }}" 
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
                            <h4 class="text-sm font-bold text-[#0B1F3A]">{{ app()->getLocale() === 'bn' ? 'এমিসা একাডেমি' : 'Emisha Academy' }}</h4>
                            <p class="text-[11px] text-slate-500">{{ app()->getLocale() === 'bn' ? 'এভিয়েশন, আইএটিএ জিডিএস প্রশিক্ষণ ও কোর্স' : 'Aviation, IATA GDS Training & Courses' }}</p>
                            <span class="text-xs font-mono font-bold text-slate-800 block mt-0.5">{{ $phone3 }}</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 flex-shrink-0 self-end sm:self-center">
                        <a 
                            href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $phone3) }}?text={{ urlencode(app()->getLocale() === 'bn' ? 'হ্যালো এমিসা একাডেমি, আমি ট্রাভেল ট্রেনিং ও আইএটিএ কোর্স সম্পর্কে জানতে আগ্রহী।' : 'Hello Emisha Academy, I am inquiring about travel training and IATA courses.') }}" 
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
                            <h4 class="text-sm font-bold text-[#0B1F3A]">{{ app()->getLocale() === 'bn' ? 'ভিসা সার্ভিস ডেস্ক' : 'VISA Services Desk' }}</h4>
                            <p class="text-[11px] text-slate-600">{{ app()->getLocale() === 'bn' ? 'ট্যুরিস্ট ভিসা, ডকুমেন্ট অডিট ও দূতাবাস সহায়তা' : 'Tourist Visas, Document Audit & Embassy' }}</p>
                            <span class="text-xs font-mono font-bold text-slate-900 block mt-0.5">{{ $phone4 }}</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 flex-shrink-0 self-end sm:self-center">
                        <a 
                            href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $phone4) }}?text={{ urlencode(app()->getLocale() === 'bn' ? 'হ্যালো এমিসা ভিসা ডেস্ক, আমার ভিসা আবেদন ও ডকুমেন্ট সংক্রান্ত তথ্য প্রয়োজন।' : 'Hello Emisha Visa Desk, I need assistance regarding visa application and documentation.') }}" 
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
                <span>{{ app()->getLocale() === 'bn' ? 'প্রধান কার্যালয়: বেগম রোকেয়া সরণি, মিরপুর, ঢাকা' : 'Head Office: Begum Rokeya Sarani, Mirpur, Dhaka' }}</span>
                <button 
                    type="button" 
                    @click="showWhatsAppModal = false" 
                    class="text-[#0B1F3A] font-bold hover:underline cursor-pointer"
                >
                    {{ app()->getLocale() === 'bn' ? 'বন্ধ করুন' : 'Close' }}
                </button>
            </div>
        </div>
    </div>
</div>
