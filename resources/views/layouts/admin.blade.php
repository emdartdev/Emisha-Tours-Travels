<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Executive Command') — Emisha Tours & Travels</title>

    <!-- Anti-Flash Theme Initializer (Defaults to Light Mode) -->
    <script>
        (function() {
            try {
                const savedTheme = localStorage.getItem('admin-theme');
                if (savedTheme === 'dark') {
                    document.documentElement.classList.remove('light');
                    document.documentElement.classList.add('dark');
                    document.documentElement.setAttribute('data-theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    document.documentElement.classList.add('light');
                    document.documentElement.setAttribute('data-theme', 'light');
                }
            } catch (e) {
                document.documentElement.classList.remove('dark');
                document.documentElement.classList.add('light');
                document.documentElement.setAttribute('data-theme', 'light');
            }
        })();
    </script>

    <!-- Google Fonts: Plus Jakarta Sans & Playfair Display -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap" rel="stylesheet">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
        }
        .font-serif {
            font-family: 'Playfair Display', Georgia, serif;
        }
        /* Custom scrollbars */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: rgba(15, 23, 42, 0.05);
        }
        html.dark ::-webkit-scrollbar-track {
            background: rgba(15, 23, 42, 0.6);
        }
        ::-webkit-scrollbar-thumb {
            background: rgba(212, 175, 55, 0.4);
            border-radius: 9999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(212, 175, 55, 0.7);
        }
        [x-cloak] { display: none !important; }
    </style>

    @stack('styles')
</head>
<body class="min-h-screen lg:h-screen lg:overflow-hidden font-sans antialiased admin-main-wrapper" 
      x-data="{ 
          theme: localStorage.getItem('admin-theme') === 'dark' ? 'dark' : 'light',
          toggleTheme() {
              this.theme = this.theme === 'light' ? 'dark' : 'light';
              localStorage.setItem('admin-theme', this.theme);
              if (this.theme === 'dark') {
                  document.documentElement.classList.remove('light');
                  document.documentElement.classList.add('dark');
                  document.documentElement.setAttribute('data-theme', 'dark');
              } else {
                  document.documentElement.classList.remove('dark');
                  document.documentElement.classList.add('light');
                  document.documentElement.setAttribute('data-theme', 'light');
              }
          },
          sidebarOpen: false, 
          commandPaletteOpen: false,
          quickActionsOpen: false,
          profileMenuOpen: false
      }"
      @keydown.window.prevent.cmd.k="commandPaletteOpen = true"
      @keydown.window.prevent.ctrl.k="commandPaletteOpen = true"
      @keydown.escape.window="commandPaletteOpen = false; quickActionsOpen = false; profileMenuOpen = false">

    <div class="min-h-screen lg:h-screen flex lg:overflow-hidden">
        <!-- Backdrop for mobile drawer -->
        <div x-show="sidebarOpen" 
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="sidebarOpen = false" 
             class="fixed inset-0 bg-slate-950/80 backdrop-blur-sm z-40 lg:hidden" 
             x-cloak></div>

        <!-- Sidebar Navigation (Deep Navy Executive Bar - Fixed & Independent Scroll) -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'" 
               class="fixed inset-y-0 left-0 z-50 w-72 bg-[#071527] border-r border-slate-800 text-white transition-transform duration-300 ease-in-out lg:sticky lg:top-0 lg:h-screen lg:translate-x-0 flex flex-col shadow-2xl flex-shrink-0">
            
            <!-- Standard Admin Sidebar Header (Clean Vector & Typography) -->
            <div class="h-16 flex items-center justify-between px-5 bg-[#040E1B] border-b border-slate-800/80 relative flex-shrink-0">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group min-w-0" title="Emisha Operations Command Suite">
                    <!-- Standard Vector Brand Mark -->
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-[#D4AF37] via-amber-500 to-[#997A1E] p-[1px] shadow-md shadow-[#D4AF37]/20 flex-shrink-0 group-hover:scale-105 transition-transform duration-200">
                        <div class="w-full h-full bg-[#050E1C] rounded-[11px] flex items-center justify-center text-[#D4AF37]">
                            <svg class="w-5 h-5 transition-transform duration-300 group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                        </div>
                    </div>

                    <!-- Brand Typography & Sub-Badge -->
                    <div class="flex flex-col min-w-0">
                        <div class="flex items-center gap-1.5">
                            <span class="font-extrabold text-[13.5px] tracking-tight text-white group-hover:text-[#D4AF37] transition-colors duration-200 truncate">
                                Emisha Travels
                            </span>
                            <span class="px-1.5 py-0.2 text-[8px] font-black tracking-wider uppercase bg-[#D4AF37]/20 text-[#D4AF37] rounded border border-[#D4AF37]/40">
                                PRO
                            </span>
                        </div>
                        <div class="flex items-center gap-1.5 mt-0.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                            <span class="text-[10px] text-slate-400 font-medium tracking-wide">
                                Admin Dashboard
                            </span>
                        </div>
                    </div>
                </a>

                <!-- Mobile Drawer Close Button -->
                <button @click="sidebarOpen = false" class="lg:hidden p-1.5 text-slate-400 hover:text-white rounded-lg hover:bg-white/10 transition flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- Quick Search trigger in Sidebar -->
            <div class="px-4 pt-4 pb-2">
                <button @click="commandPaletteOpen = true" 
                        class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl bg-slate-900/90 border border-slate-800 text-slate-400 hover:text-slate-200 hover:border-[#D4AF37]/50 text-xs transition duration-200 group shadow-inner">
                    <div class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-[#D4AF37] group-hover:scale-110 transition duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        <span>Quick Command...</span>
                    </div>
                    <kbd class="px-1.5 py-0.5 text-[10px] font-semibold bg-slate-800 text-slate-300 rounded border border-slate-700">⌘K</kbd>
                </button>
            </div>

            <!-- Navigation Links -->
            <div class="flex-1 overflow-y-auto px-4 py-3 space-y-6 text-xs">
                <!-- Section 1: Dashboard -->
                <div>
                    <div class="text-[10px] font-bold uppercase tracking-wider text-[#D4AF37] px-3 mb-2 flex items-center gap-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#D4AF37]"></span>
                        <span>Intelligence</span>
                    </div>
                    <div class="space-y-1">
                        <a href="{{ route('admin.dashboard') }}" 
                           class="flex items-center justify-between px-3.5 py-2.5 rounded-xl transition duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-[#D4AF37] to-[#B38F26] text-[#050D1A] font-bold shadow-lg shadow-[#D4AF37]/20' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                            <div class="flex items-center gap-3">
                                <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/></svg>
                                <span>Operations Dashboard</span>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Section 2: Operations & Inbound Requests -->
                <div>
                    <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 px-3 mb-2 flex items-center justify-between">
                        <span>Operations & Leads</span>
                        <span class="text-[9px] text-slate-500 font-mono">LIVE</span>
                    </div>
                    <div class="space-y-1">
                        <!-- Visa Applications -->
                        <a href="{{ route('admin.visa.applications') }}" 
                           class="flex items-center justify-between px-3.5 py-2.5 rounded-xl transition duration-200 {{ request()->routeIs('admin.visa.applications*') ? 'bg-gradient-to-r from-[#D4AF37] to-[#B38F26] text-[#050D1A] font-bold shadow-lg shadow-[#D4AF37]/20' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                            <div class="flex items-center gap-3">
                                <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                <span>Visa Applications</span>
                            </div>
                            @if(($adminCounts['pending_visa'] ?? 0) > 0)
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold {{ request()->routeIs('admin.visa.applications*') ? 'bg-[#050D1A] text-[#D4AF37]' : 'bg-amber-500/20 text-amber-400 border border-amber-500/30 animate-pulse' }}">
                                    {{ $adminCounts['pending_visa'] }}
                                </span>
                            @endif
                        </a>

                        <!-- Tour Inquiries -->
                        <a href="{{ route('admin.inquiries') }}" 
                           class="flex items-center justify-between px-3.5 py-2.5 rounded-xl transition duration-200 {{ request()->routeIs('admin.inquiries*') ? 'bg-gradient-to-r from-[#D4AF37] to-[#B38F26] text-[#050D1A] font-bold shadow-lg shadow-[#D4AF37]/20' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                            <div class="flex items-center gap-3">
                                <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                <span>Tour Inquiries</span>
                            </div>
                            @if(($adminCounts['pending_inquiries'] ?? 0) > 0)
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold {{ request()->routeIs('admin.inquiries*') ? 'bg-[#050D1A] text-[#D4AF37]' : 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/30' }}">
                                    {{ $adminCounts['pending_inquiries'] }}
                                </span>
                            @endif
                        </a>

                        <!-- Ticket Requests -->
                        <a href="{{ route('admin.ticket-requests') }}" 
                           class="flex items-center justify-between px-3.5 py-2.5 rounded-xl transition duration-200 {{ request()->routeIs('admin.ticket-requests*') ? 'bg-gradient-to-r from-[#D4AF37] to-[#B38F26] text-[#050D1A] font-bold shadow-lg shadow-[#D4AF37]/20' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                            <div class="flex items-center gap-3">
                                <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/></svg>
                                <span>Air Ticket Requests</span>
                            </div>
                            @if(($adminCounts['pending_tickets'] ?? 0) > 0)
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold {{ request()->routeIs('admin.ticket-requests*') ? 'bg-[#050D1A] text-[#D4AF37]' : 'bg-cyan-500/20 text-cyan-400 border border-cyan-500/30' }}">
                                    {{ $adminCounts['pending_tickets'] }}
                                </span>
                            @endif
                        </a>

                        <!-- Messages -->
                        <a href="{{ route('admin.contact-messages') }}" 
                           class="flex items-center justify-between px-3.5 py-2.5 rounded-xl transition duration-200 {{ request()->routeIs('admin.contact-messages*') ? 'bg-gradient-to-r from-[#D4AF37] to-[#B38F26] text-[#050D1A] font-bold shadow-lg shadow-[#D4AF37]/20' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                            <div class="flex items-center gap-3">
                                <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                <span>Contact Inquiries</span>
                            </div>
                            @if(($adminCounts['unread_messages'] ?? 0) > 0)
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold {{ request()->routeIs('admin.contact-messages*') ? 'bg-[#050D1A] text-[#D4AF37]' : 'bg-rose-500/20 text-rose-400 border border-rose-500/30' }}">
                                    {{ $adminCounts['unread_messages'] }}
                                </span>
                            @endif
                        </a>
                    </div>
                </div>

                <!-- Section 3: Catalog & Travel Inventory -->
                <div>
                    <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 px-3 mb-2">Inventory & Catalog</div>
                    <div class="space-y-1">
                        <a href="{{ route('admin.tours.index') }}" 
                           class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition duration-200 {{ request()->routeIs('admin.tours*') ? 'bg-gradient-to-r from-[#D4AF37] to-[#B38F26] text-[#050D1A] font-bold shadow-lg shadow-[#D4AF37]/20' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>Tour Packages</span>
                        </a>

                        <a href="{{ route('admin.destinations.index') }}" 
                           class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition duration-200 {{ request()->routeIs('admin.destinations*') ? 'bg-gradient-to-r from-[#D4AF37] to-[#B38F26] text-[#050D1A] font-bold shadow-lg shadow-[#D4AF37]/20' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                            <span>Destinations</span>
                        </a>

                        <a href="{{ route('admin.visa.countries.index') }}" 
                           class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition duration-200 {{ request()->routeIs('admin.visa.countries*') ? 'bg-gradient-to-r from-[#D4AF37] to-[#B38F26] text-[#050D1A] font-bold shadow-lg shadow-[#D4AF37]/20' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"/></svg>
                            <span>Visa Countries & Rules</span>
                        </a>
                    </div>
                </div>

                <!-- Section 4: Publishing & Media -->
                <div>
                    <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 px-3 mb-2">Publishing & Media</div>
                    <div class="space-y-1">
                        <a href="{{ route('admin.blog.index') }}" 
                           class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition duration-200 {{ request()->routeIs('admin.blog*') ? 'bg-gradient-to-r from-[#D4AF37] to-[#B38F26] text-[#050D1A] font-bold shadow-lg shadow-[#D4AF37]/20' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                            <span>Travel Insights & Blog</span>
                        </a>

                        <a href="{{ route('admin.gallery.index') }}" 
                           class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition duration-200 {{ request()->routeIs('admin.gallery*') ? 'bg-gradient-to-r from-[#D4AF37] to-[#B38F26] text-[#050D1A] font-bold shadow-lg shadow-[#D4AF37]/20' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <span>Visual Gallery</span>
                        </a>
                    </div>
                </div>

                <!-- Section 5: Configuration -->
                <div>
                    <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 px-3 mb-2">Master Settings</div>
                    <div class="space-y-1">
                        <a href="{{ route('admin.settings') }}" 
                           class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition duration-200 {{ request()->routeIs('admin.settings') ? 'bg-gradient-to-r from-[#D4AF37] to-[#B38F26] text-[#050D1A] font-bold shadow-lg shadow-[#D4AF37]/20' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span>Platform Configuration</span>
                        </a>

                        <a href="{{ route('admin.settings.analytics') }}" 
                           class="flex items-center justify-between px-3.5 py-2.5 rounded-xl transition duration-200 {{ request()->routeIs('admin.settings.analytics*') ? 'bg-gradient-to-r from-[#D4AF37] to-[#B38F26] text-[#050D1A] font-bold shadow-lg shadow-[#D4AF37]/20' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                            <div class="flex items-center gap-3">
                                <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                                <span>Analytics & Pixels</span>
                            </div>
                            <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- User Profile & Session Footer -->
            <div class="p-4 border-t border-white/10 bg-[#040E1B]">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="relative">
                            <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-[#D4AF37] to-amber-300 text-[#050D1A] flex items-center justify-center font-extrabold text-xs shadow-md shadow-[#D4AF37]/20">
                                {{ substr(auth()->user()->name ?? 'Admin', 0, 1) }}
                            </div>
                            <span class="absolute -bottom-0.5 -right-0.5 w-2.5 h-2.5 bg-emerald-500 rounded-full border-2 border-[#040E1B]"></span>
                        </div>
                        <div class="text-xs truncate max-w-[130px]">
                            <div class="font-bold text-white truncate">{{ auth()->user()->name ?? 'Executive' }}</div>
                            <div class="text-[10px] text-slate-400 capitalize font-medium">{{ auth()->user()->role ?? 'Superadmin' }}</div>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" 
                                class="p-2 text-slate-400 hover:text-rose-400 hover:bg-rose-500/10 rounded-xl transition duration-200 group" 
                                title="Sign Out">
                            <svg class="w-4.5 h-4.5 group-hover:translate-x-0.5 transition duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-w-0 lg:h-screen lg:overflow-hidden admin-main-wrapper">
            <!-- Top Command Bar -->
            <header class="h-20 admin-header-bar border-b flex items-center justify-between px-4 lg:px-8 flex-shrink-0 z-30 shadow-sm backdrop-blur-md">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-[#D4AF37]">Management Suite</span>
                            <span class="text-slate-400 dark:text-slate-600">•</span>
                            <span class="text-[10px] text-emerald-600 dark:text-emerald-400 font-semibold flex items-center gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                Secure Mode
                            </span>
                        </div>
                        <h1 class="text-lg lg:text-xl font-extrabold tracking-tight" style="color: var(--admin-text-heading);">@yield('page_title', 'Executive Control')</h1>
                    </div>
                </div>

                <!-- Header Actions -->
                <div class="flex items-center gap-3">
                    <!-- Centralized Light / Dark Theme Switcher Button -->
                    <button @click="toggleTheme()" 
                            type="button"
                            class="flex items-center gap-2 px-3.5 py-2 rounded-xl border text-xs font-semibold transition-all duration-200 shadow-sm cursor-pointer"
                            :class="theme === 'dark' ? 'bg-slate-900 border-slate-700 text-amber-400 hover:border-amber-400/50' : 'bg-slate-100 border-slate-200 text-slate-700 hover:border-slate-300'"
                            :title="theme === 'dark' ? 'Switch to Light Mode' : 'Switch to Dark Mode'"
                            :aria-label="theme === 'dark' ? 'Switch to Light Mode' : 'Switch to Dark Mode'">
                        <!-- Sun icon for light mode -->
                        <span x-show="theme === 'light'" class="flex items-center gap-1.5 text-amber-600">
                            <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                            <span class="hidden sm:inline font-bold text-slate-700">Light</span>
                        </span>
                        <!-- Moon icon for dark mode -->
                        <span x-show="theme === 'dark'" class="flex items-center gap-1.5 text-indigo-300" x-cloak>
                            <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                            <span class="hidden sm:inline font-bold text-slate-200">Dark</span>
                        </span>
                    </button>

                    <!-- Quick Action Menu -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" 
                                class="flex items-center gap-2 px-3.5 py-2 rounded-xl bg-[#D4AF37] hover:bg-[#c49f2e] text-[#050D1A] font-bold text-xs shadow-lg shadow-[#D4AF37]/20 transition duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                            <span class="hidden sm:inline">Create New</span>
                        </button>

                        <div x-show="open" 
                             @click.outside="open = false" 
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-56 admin-dropdown-card border rounded-2xl shadow-2xl p-2 z-50 text-xs" 
                             x-cloak>
                            <a href="{{ route('admin.tours.create') }}" class="flex items-center gap-3 px-3 py-2.5 admin-dropdown-item rounded-xl transition">
                                <span class="p-1.5 rounded-lg bg-amber-500/20 text-[#D4AF37]"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></span>
                                <div>
                                    <div class="font-bold">New Tour Package</div>
                                    <div class="text-[10px] text-slate-400">Add holiday catalog package</div>
                                </div>
                            </a>
                            <a href="{{ route('admin.destinations.create') }}" class="flex items-center gap-3 px-3 py-2.5 admin-dropdown-item rounded-xl transition">
                                <span class="p-1.5 rounded-lg bg-blue-500/20 text-blue-500"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg></span>
                                <div>
                                    <div class="font-bold">Add Destination</div>
                                    <div class="text-[10px] text-slate-400">New country or city spot</div>
                                </div>
                            </a>
                            <a href="{{ route('admin.blog.create') }}" class="flex items-center gap-3 px-3 py-2.5 admin-dropdown-item rounded-xl transition">
                                <span class="p-1.5 rounded-lg bg-emerald-500/20 text-emerald-500"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg></span>
                                <div>
                                    <div class="font-bold">Publish Article</div>
                                    <div class="text-[10px] text-slate-400">Write travel blog or news</div>
                                </div>
                            </a>
                            <div class="border-t admin-table-divider my-1"></div>
                            <a href="{{ route('admin.visa.countries.create') }}" class="flex items-center gap-3 px-3 py-2.5 admin-dropdown-item rounded-xl transition">
                                <span class="p-1.5 rounded-lg bg-purple-500/20 text-purple-500"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"/></svg></span>
                                <div>
                                    <div class="font-bold">Add Visa Destination</div>
                                    <div class="text-[10px] text-slate-400">Configure rules & pricing</div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- View Live Website -->
                    <a href="{{ route('home') }}" 
                       target="_blank" 
                       class="text-xs font-bold flex items-center gap-2 px-3.5 py-2 rounded-xl border transition duration-200 shadow-sm group"
                       :class="theme === 'dark' ? 'bg-slate-900 border-slate-700 text-slate-300 hover:text-[#D4AF37] hover:border-[#D4AF37]/50' : 'bg-white border-slate-200 text-slate-700 hover:text-[#D4AF37] hover:border-[#D4AF37]/50'">
                        <span class="hidden sm:inline">Live Website</span>
                        <svg class="w-3.5 h-3.5 text-slate-400 group-hover:text-[#D4AF37] group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </a>
                </div>
            </header>

            <!-- Notification Messages -->
            @include('components.flash-messages')

            <!-- Main Page Content -->
            <main class="flex-1 overflow-y-auto p-4 lg:p-8 space-y-6">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Quick Command Palette Modal -->
    <div x-show="commandPaletteOpen" 
         class="fixed inset-0 z-50 overflow-y-auto p-4 sm:p-6 md:p-20" 
         role="dialog" 
         aria-modal="true" 
         x-cloak>
        <div x-show="commandPaletteOpen" 
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-slate-950/80 backdrop-blur-md transition-opacity" 
             @click="commandPaletteOpen = false"></div>

        <div x-show="commandPaletteOpen" 
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="mx-auto max-w-2xl transform divide-y divide-slate-200 dark:divide-slate-800 overflow-hidden rounded-2xl admin-modal-card border shadow-2xl transition-all relative z-10">
            <div class="relative">
                <svg class="pointer-events-none absolute left-4 top-3.5 h-5 w-5 text-[#D4AF37]" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                </svg>
                <input type="text" 
                       placeholder="Type a command or jump to module..." 
                       class="h-12 w-full border-0 bg-transparent pl-11 pr-4 text-[var(--admin-text-main)] placeholder:text-slate-400 focus:ring-0 text-sm focus:outline-none">
            </div>

            <div class="max-h-80 scroll-py-2 divide-y divide-slate-200 dark:divide-slate-800 overflow-y-auto p-2 text-xs">
                <div class="p-2 text-slate-400 font-bold uppercase tracking-wider text-[10px]">Operations & Data Desks</div>
                <div class="space-y-1">
                    <a href="{{ route('admin.visa.applications') }}" class="flex items-center justify-between p-2.5 rounded-xl admin-dropdown-item transition">
                        <div class="flex items-center gap-3">
                            <span class="p-1 rounded bg-amber-500/20 text-[#D4AF37]"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg></span>
                            <span class="font-semibold">Visa Applications & Dossiers</span>
                        </div>
                        <span class="text-[10px] text-slate-400">Jump ➔</span>
                    </a>
                    <a href="{{ route('admin.inquiries') }}" class="flex items-center justify-between p-2.5 rounded-xl admin-dropdown-item transition">
                        <div class="flex items-center gap-3">
                            <span class="p-1 rounded bg-blue-500/20 text-blue-500"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg></span>
                            <span class="font-semibold">Tour Inquiries & Leads</span>
                        </div>
                        <span class="text-[10px] text-slate-400">Jump ➔</span>
                    </a>
                    <a href="{{ route('admin.ticket-requests') }}" class="flex items-center justify-between p-2.5 rounded-xl admin-dropdown-item transition">
                        <div class="flex items-center gap-3">
                            <span class="p-1 rounded bg-cyan-500/20 text-cyan-500"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/></svg></span>
                            <span class="font-semibold">Air Ticket Requests</span>
                        </div>
                        <span class="text-[10px] text-slate-400">Jump ➔</span>
                    </a>
                    <a href="{{ route('admin.tours.index') }}" class="flex items-center justify-between p-2.5 rounded-xl admin-dropdown-item transition">
                        <div class="flex items-center gap-3">
                            <span class="p-1 rounded bg-purple-500/20 text-purple-500"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></span>
                            <span class="font-semibold">Tour Packages Manager</span>
                        </div>
                        <span class="text-[10px] text-slate-400">Jump ➔</span>
                    </a>
                    <a href="{{ route('admin.settings') }}" class="flex items-center justify-between p-2.5 rounded-xl admin-dropdown-item transition">
                        <div class="flex items-center gap-3">
                            <span class="p-1 rounded bg-slate-500/20 text-slate-400"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg></span>
                            <span class="font-semibold">Global Company Settings</span>
                        </div>
                        <span class="text-[10px] text-slate-400">Jump ➔</span>
                    </a>
                </div>
            </div>
            <div class="px-4 py-2.5 admin-subtle text-right text-[11px] text-slate-500">
                Press <kbd class="px-1 py-0.5 rounded border admin-table-divider font-mono">ESC</kbd> to exit
            </div>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
