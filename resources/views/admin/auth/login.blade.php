<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#030712]">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Executive Sign In — Emisha Tours & Travels</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { 
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif; 
        }
        .font-heading { 
            font-family: 'Outfit', 'Plus Jakarta Sans', sans-serif; 
        }
        [x-cloak] { display: none !important; }

        /* Modern subtle grid background */
        .bg-grid-pattern {
            background-image: radial-gradient(rgba(212, 175, 55, 0.12) 1px, transparent 1px);
            background-size: 32px 32px;
        }

        /* Glassmorphism */
        .glass-card {
            background: rgba(11, 23, 44, 0.75);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(212, 175, 55, 0.18);
        }

        .glass-input {
            background: rgba(4, 12, 24, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .glass-input:focus {
            background: rgba(7, 19, 36, 0.9);
            border-color: #D4AF37;
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.15);
        }
    </style>
</head>
<body class="h-full bg-[#030712] text-slate-100 antialiased relative overflow-x-hidden selection:bg-[#D4AF37] selection:text-[#030712]"
      x-data="{ 
          showPass: false, 
          email: '{{ old('email', '') }}', 
          pass: '', 
          submitting: false
      }">

    <!-- Ambient Glowing Orbs -->
    <div class="fixed top-0 left-1/4 w-[600px] h-[600px] bg-[#D4AF37]/10 rounded-full blur-[140px] pointer-events-none -translate-y-1/2"></div>
    <div class="fixed bottom-0 right-1/4 w-[500px] h-[500px] bg-blue-600/10 rounded-full blur-[150px] pointer-events-none translate-y-1/3"></div>

    <!-- Main Container -->
    <div class="min-h-screen w-full flex items-center justify-center p-4 sm:p-6 lg:p-10 relative z-10 bg-grid-pattern">
        
        <div class="w-full max-w-5xl grid grid-cols-1 lg:grid-cols-12 rounded-[32px] overflow-hidden glass-card shadow-[0_25px_70px_rgba(0,0,0,0.85)] border border-slate-800/80">
            
            <!-- Left Pane: Modern Luxury Brand & Feature Showcase (Visible on Large Screens) -->
            <div class="hidden lg:flex lg:col-span-6 flex-col justify-between p-12 bg-gradient-to-br from-[#071324]/95 via-[#0B1A30]/90 to-[#040C18]/95 relative overflow-hidden border-r border-slate-800/60">
                <!-- Background decorative light rays -->
                <div class="absolute -top-24 -left-24 w-72 h-72 bg-[#D4AF37]/15 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute bottom-10 right-10 w-60 h-60 bg-sky-500/10 rounded-full blur-3xl pointer-events-none"></div>

                <!-- Top Header -->
                <div class="relative z-10">
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-3.5 group">
                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-[#D4AF37] to-[#99791D] p-0.5 shadow-lg shadow-[#D4AF37]/20 group-hover:scale-105 transition duration-300">
                            <div class="w-full h-full bg-[#071324] rounded-[14px] flex items-center justify-center p-2">
                                <img src="{{ asset('images/logo.png') }}" alt="Emisha Tours" class="max-h-full max-w-full object-contain">
                            </div>
                        </div>
                        <div>
                            <span class="block font-heading font-extrabold text-lg text-white tracking-wide leading-tight">EMISHA</span>
                            <span class="block text-[10px] font-bold tracking-[0.25em] text-[#D4AF37] uppercase">Tours & Travels</span>
                        </div>
                    </a>
                </div>

                <!-- Center Content: Value Highlights -->
                <div class="relative z-10 my-8 space-y-6">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-[#D4AF37]/10 border border-[#D4AF37]/25 text-[#D4AF37] text-xs font-semibold tracking-wide">
                        <span class="w-2 h-2 rounded-full bg-[#D4AF37] animate-ping"></span>
                        <span class="w-2 h-2 rounded-full bg-[#D4AF37] -ml-3"></span>
                        <span>Enterprise Control Suite</span>
                    </div>

                    <h1 class="font-heading text-3xl xl:text-4xl font-extrabold text-white leading-tight tracking-tight">
                        Powering exceptional journeys with <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#D4AF37] via-[#F3E5AB] to-[#D4AF37]">seamless management</span>.
                    </h1>

                    <p class="text-slate-400 text-sm leading-relaxed max-w-md">
                        Centralized command center for managing international tour packages, visa applications, customer inquiries, and flight bookings.
                    </p>

                    <!-- Feature Pills -->
                    <div class="space-y-3 pt-2">
                        <div class="flex items-center gap-3 p-3 rounded-2xl bg-slate-900/50 border border-slate-800/80 backdrop-blur-sm">
                            <div class="w-9 h-9 rounded-xl bg-[#D4AF37]/15 flex items-center justify-center text-[#D4AF37] flex-shrink-0 border border-[#D4AF37]/20">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            </div>
                            <div class="min-w-0">
                                <h4 class="text-xs font-bold text-white">Consular Visa Pipeline</h4>
                                <p class="text-[11px] text-slate-400 truncate">Live document tracking & multi-stage status management</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 p-3 rounded-2xl bg-slate-900/50 border border-slate-800/80 backdrop-blur-sm">
                            <div class="w-9 h-9 rounded-xl bg-blue-500/15 flex items-center justify-center text-blue-400 flex-shrink-0 border border-blue-500/20">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div class="min-w-0">
                                <h4 class="text-xs font-bold text-white">Dynamic Content CMS</h4>
                                <p class="text-[11px] text-slate-400 truncate">Bilingual holiday packages, guides & destination curation</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Status -->
                <div class="relative z-10 flex items-center justify-between pt-6 border-t border-slate-800/80 text-[11px] text-slate-500">
                    <span class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        <span class="text-slate-400 font-medium">All systems operational</span>
                    </span>
                    <span class="font-mono text-slate-500">SSL 256-Bit Encrypted</span>
                </div>
            </div>

            <!-- Right Pane: Minimal Clean Sign In Form -->
            <div class="lg:col-span-6 p-8 sm:p-12 lg:p-14 flex flex-col justify-center bg-[#071324]/80 relative">
                
                <!-- Mobile Brand Header -->
                <div class="lg:hidden text-center mb-8">
                    <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-[#D4AF37]/10 border border-[#D4AF37]/20 p-2.5 mb-3 shadow-lg shadow-[#D4AF37]/10">
                        <img src="{{ asset('images/logo.png') }}" alt="Emisha Tours" class="max-h-full max-w-full object-contain">
                    </div>
                    <h2 class="font-heading text-xl font-extrabold text-white">EMISHA TOURS & TRAVELS</h2>
                    <p class="text-xs text-[#D4AF37] font-semibold tracking-wider uppercase mt-0.5">Executive Management Suite</p>
                </div>

                <!-- Form Header -->
                <div class="mb-8 text-center lg:text-left">
                    <h2 class="font-heading text-2xl sm:text-3xl font-extrabold text-white tracking-tight">Executive Sign In</h2>
                    <p class="text-slate-400 text-xs sm:text-sm mt-1.5">Enter authorized staff credentials to access your control panel</p>
                </div>

                <!-- Notifications -->
                @if(session('success'))
                    <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/30 rounded-2xl text-emerald-400 text-xs flex items-center gap-3">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 p-4 bg-rose-500/10 border border-rose-500/30 rounded-2xl text-rose-400 text-xs space-y-1.5">
                        @foreach($errors->all() as $err)
                            <div class="flex items-center gap-2 font-medium">
                                <svg class="w-4 h-4 flex-shrink-0 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>{{ $err }}</span>
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- Login Form -->
                <form action="{{ route('admin.login.submit') }}" method="POST" @submit="submitting = true" class="space-y-5">
                    @csrf

                    <!-- Email Field -->
                    <div class="space-y-1.5">
                        <label for="email" class="block text-xs font-semibold text-slate-300">Staff Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"/></svg>
                            </div>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                x-model="email"
                                required 
                                placeholder="name@emishatours.com" 
                                class="w-full pl-10 pr-4 py-3 rounded-xl glass-input text-white placeholder-slate-500 text-sm focus:outline-none"
                            >
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div class="space-y-1.5">
                        <div class="flex items-center justify-between">
                            <label for="password" class="block text-xs font-semibold text-slate-300">Password</label>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            </div>
                            <input 
                                :type="showPass ? 'text' : 'password'" 
                                id="password" 
                                name="password" 
                                x-model="pass"
                                required 
                                placeholder="••••••••••••" 
                                class="w-full pl-10 pr-11 py-3 rounded-xl glass-input text-white placeholder-slate-500 text-sm focus:outline-none"
                            >
                            <button 
                                type="button" 
                                @click="showPass = !showPass" 
                                class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-200 transition focus:outline-none"
                                tabindex="-1"
                                aria-label="Toggle password visibility"
                            >
                                <svg x-show="!showPass" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                <svg x-show="showPass" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/></svg>
                            </button>
                        </div>
                    </div>

                    <!-- Remember & Options -->
                    <div class="flex items-center justify-between pt-1">
                        <label class="flex items-center gap-2.5 text-xs text-slate-400 cursor-pointer select-none hover:text-slate-200 transition">
                            <input type="checkbox" name="remember" class="w-4 h-4 rounded bg-slate-900 border-slate-700 text-[#D4AF37] focus:ring-[#D4AF37] focus:ring-offset-0">
                            <span>Keep session authenticated</span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        :disabled="submitting"
                        class="w-full py-3.5 px-6 rounded-xl bg-gradient-to-r from-[#D4AF37] via-[#E5C761] to-[#B89224] hover:brightness-110 text-[#071324] font-extrabold text-xs uppercase tracking-wider shadow-lg shadow-[#D4AF37]/20 hover:shadow-[#D4AF37]/35 transition-all duration-300 flex items-center justify-center gap-2 group disabled:opacity-75 cursor-pointer"
                    >
                        <span x-show="!submitting" class="flex items-center gap-2">
                            <span>Sign In to Command Center</span>
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </span>
                        <span x-show="submitting" class="flex items-center gap-2" x-cloak>
                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-[#071324]" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            <span>Authenticating...</span>
                        </span>
                    </button>
                </form>



                <!-- Back to Main Website -->
                <div class="mt-8 text-center">
                    <a href="{{ route('home') }}" class="text-xs text-slate-400 hover:text-[#D4AF37] transition inline-flex items-center gap-2 font-medium group">
                        <svg class="w-3.5 h-3.5 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        <span>Return to Emisha Public Portal</span>
                    </a>
                </div>
            </div>

        </div>

    </div>

</body>
</html>
