<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-950">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Executive Command Sign In — Emisha Tours & Travels</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap" rel="stylesheet">
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-serif { font-family: 'Playfair Display', Georgia, serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-[#040C18] relative overflow-hidden text-slate-100"
      x-data="{ showPass: false, email: 'admin@emishatours.com', pass: '' }">

    <!-- Ambient Luxury Background Glows -->
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-[#D4AF37]/10 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-blue-600/10 rounded-full blur-[140px] pointer-events-none"></div>

    <div class="max-w-md w-full relative z-10 space-y-8 bg-[#071324]/90 backdrop-blur-2xl p-8 sm:p-10 rounded-3xl border border-slate-700/60 shadow-2xl shadow-black/80">
        <!-- Logo & Header -->
        <div class="text-center">
            <div class="relative inline-block mb-3">
                <div class="absolute -inset-2 bg-gradient-to-r from-[#D4AF37] to-amber-500 rounded-2xl blur-md opacity-30"></div>
                <img 
                    src="{{ asset('images/logo.png') }}" 
                    alt="Emisha Tours & Travels" 
                    class="relative h-16 w-auto object-contain mx-auto drop-shadow-xl"
                >
            </div>
            <div class="flex items-center justify-center gap-1.5 mt-2">
                <span class="text-xs font-bold uppercase tracking-widest text-[#D4AF37]">EMISHA EXECUTIVE</span>
                <span class="px-1.5 py-0.2 text-[8.5px] font-extrabold bg-emerald-500/20 text-emerald-400 rounded border border-emerald-500/30">256-BIT SSL</span>
            </div>
            <h2 class="text-2xl font-extrabold text-white tracking-tight mt-1">Management Portal</h2>
            <p class="text-xs text-slate-400 mt-1">Authorized personnel authentication required</p>
        </div>

        @if(session('success'))
            <div class="p-4 bg-emerald-500/10 border border-emerald-500/30 rounded-2xl text-emerald-400 text-xs flex items-center gap-2">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="p-4 bg-rose-500/10 border border-rose-500/30 rounded-2xl text-rose-400 text-xs space-y-1">
                @foreach($errors->all() as $err)
                    <p class="flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>{{ $err }}</span>
                    </p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-[11px] font-bold uppercase tracking-wider text-slate-300 mb-1.5">Staff Email</label>
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
                        placeholder="admin@emishatours.com" 
                        class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-900/90 border border-slate-700 text-white placeholder-slate-500 focus:outline-none focus:border-[#D4AF37] focus:ring-1 focus:ring-[#D4AF37] text-sm transition"
                    >
                </div>
            </div>

            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <label for="password" class="block text-[11px] font-bold uppercase tracking-wider text-slate-300">Password</label>
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
                        placeholder="••••••••" 
                        class="w-full pl-10 pr-10 py-3 rounded-xl bg-slate-900/90 border border-slate-700 text-white placeholder-slate-500 focus:outline-none focus:border-[#D4AF37] focus:ring-1 focus:ring-[#D4AF37] text-sm transition"
                    >
                    <button type="button" @click="showPass = !showPass" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-200">
                        <svg x-show="!showPass" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        <svg x-show="showPass" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/></svg>
                    </button>
                </div>
            </div>

            <div class="flex items-center justify-between pt-1">
                <label class="flex items-center space-x-2 text-xs text-slate-400 cursor-pointer hover:text-slate-200">
                    <input type="checkbox" name="remember" class="rounded bg-slate-900 border-slate-700 text-[#D4AF37] focus:ring-[#D4AF37]">
                    <span>Keep session active</span>
                </label>
            </div>

            <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-[#D4AF37] via-[#E2C558] to-[#B38F26] hover:brightness-110 text-[#050D1A] font-extrabold rounded-xl shadow-lg shadow-[#D4AF37]/20 transition duration-200 text-xs uppercase tracking-wider flex items-center justify-center gap-2">
                <span>Access Command Suite</span>
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </button>
        </form>

        <!-- Quick Role Switcher helper -->
        <div class="pt-4 border-t border-slate-800 flex items-center justify-between text-[11px] text-slate-400">
            <span>Quick Fill:</span>
            <div class="flex items-center gap-1.5">
                <button type="button" 
                        @click="email = 'admin@emishatours.com'; pass = 'Emisha@01805464291#Naznin#@'" 
                        class="px-2 py-1 rounded bg-slate-800 hover:bg-slate-700 text-slate-200 border border-slate-700 transition">
                    Admin
                </button>
                <button type="button" 
                        @click="email = 'manager@emishatours.com'; pass = 'Emisha@01805464291#@Treker#@'" 
                        class="px-2 py-1 rounded bg-slate-800 hover:bg-slate-700 text-slate-200 border border-slate-700 transition">
                    Manager
                </button>
                <button type="button" 
                        @click="email = 'm1@emishatours.com'; pass = 'Emisha@583214#@Treker#@'" 
                        class="px-2 py-1 rounded bg-slate-800 hover:bg-slate-700 text-slate-200 border border-slate-700 transition">
                    Mod 1
                </button>
            </div>
        </div>

        <div class="text-center pt-2">
            <a href="{{ route('home') }}" class="text-xs text-slate-400 hover:text-[#D4AF37] transition inline-flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                <span>Back to Emisha Public Portal</span>
            </a>
        </div>
    </div>
</body>
</html>
