@if(\App\Models\Setting::get('cookie_consent_enabled', '1') == '1')
<div 
    x-data="{
        showBanner: false,
        showPreferences: false,
        consentAnalytics: true,
        consentMarketing: true,
        init() {
            const consent = localStorage.getItem('emisha_cookie_consent');
            if (!consent) {
                // Show banner after brief delay
                setTimeout(() => { this.showBanner = true; }, 1200);
            } else if (consent === 'necessary') {
                this.consentAnalytics = false;
                this.consentMarketing = false;
            }
        },
        acceptAll() {
            localStorage.setItem('emisha_cookie_consent', 'all');
            localStorage.setItem('emisha_consent_analytics', '1');
            localStorage.setItem('emisha_consent_marketing', '1');
            this.showBanner = false;
            this.showPreferences = false;
            window.dispatchEvent(new CustomEvent('cookie-consent-updated', { detail: { mode: 'all' } }));
        },
        rejectNonEssential() {
            localStorage.setItem('emisha_cookie_consent', 'necessary');
            localStorage.setItem('emisha_consent_analytics', '0');
            localStorage.setItem('emisha_consent_marketing', '0');
            this.consentAnalytics = false;
            this.consentMarketing = false;
            this.showBanner = false;
            this.showPreferences = false;
            window.dispatchEvent(new CustomEvent('cookie-consent-updated', { detail: { mode: 'necessary' } }));
        },
        savePreferences() {
            const mode = (this.consentAnalytics && this.consentMarketing) ? 'all' : ((!this.consentAnalytics && !this.consentMarketing) ? 'necessary' : 'custom');
            localStorage.setItem('emisha_cookie_consent', mode);
            localStorage.setItem('emisha_consent_analytics', this.consentAnalytics ? '1' : '0');
            localStorage.setItem('emisha_consent_marketing', this.consentMarketing ? '1' : '0');
            this.showBanner = false;
            this.showPreferences = false;
            window.dispatchEvent(new CustomEvent('cookie-consent-updated', { detail: { mode: mode } }));
        }
    }"
    x-show="showBanner"
    x-transition:enter="transition ease-out duration-300 transform"
    x-transition:enter-start="opacity-0 translate-y-8"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-200 transform"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 translate-y-8"
    class="fixed bottom-4 sm:bottom-6 left-4 right-4 sm:left-auto sm:right-6 z-[9999] max-w-lg w-full"
    x-cloak
>
    <div class="bg-[#071527]/95 backdrop-blur-xl border border-white/15 rounded-2xl sm:rounded-3xl p-5 sm:p-6 text-white shadow-2xl shadow-black/50">
        <!-- Main Consent Message -->
        <div class="flex items-start gap-4">
            <div class="w-10 h-10 rounded-xl bg-[#D4AF37]/15 border border-[#D4AF37]/30 text-[#D4AF37] flex items-center justify-center flex-shrink-0 mt-0.5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
            </div>
            <div class="min-w-0 flex-grow">
                <div class="flex items-center gap-2 mb-1">
                    <span class="text-xs font-bold text-white uppercase tracking-wider">{{ app()->getLocale() === 'bn' ? 'গোপনীয়তা ও কুকি সেটিংস' : 'Privacy & Cookie Choices' }}</span>
                    <span class="px-2 py-0.5 rounded-full text-[9px] font-bold bg-[#D4AF37]/20 text-[#D4AF37]">GDPR Compliant</span>
                </div>
                <p class="text-xs text-slate-300 leading-relaxed font-normal">
                    {{ app()->getLocale() === 'bn' ? 'আমরা একটি নিরবচ্ছিন্ন ভ্রমণ বুকিং অভিজ্ঞতা প্রদান, কার্যকারিতা পরিমাপ এবং ব্যক্তিগতকৃত গন্তব্য সুপারিশ প্রদানের জন্য কুকি ব্যবহার করি।' : 'We use cookies and telemetry pixels to provide a seamless travel booking experience, measure campaign effectiveness, and personalize destination recommendations.' }}
                </p>
            </div>
        </div>

        <!-- Granular Preferences Accordion -->
        <div x-show="showPreferences" x-collapse class="mt-4 pt-4 border-t border-white/10 space-y-3">
            <div class="flex items-center justify-between text-xs">
                <div>
                    <div class="font-bold text-white">{{ app()->getLocale() === 'bn' ? 'অপরিহার্য কুকি' : 'Strictly Necessary' }}</div>
                    <div class="text-[10px] text-slate-400">{{ app()->getLocale() === 'bn' ? 'নিরাপত্তা ও সেশন পরিচালনার জন্য অপরিহার্য।' : 'Essential for visa onboarding security & login sessions.' }}</div>
                </div>
                <span class="text-[10px] font-bold text-emerald-400 uppercase">{{ app()->getLocale() === 'bn' ? 'সর্বদা সক্রিয়' : 'Always Active' }}</span>
            </div>

            <div class="flex items-center justify-between text-xs pt-2 border-t border-white/5">
                <div>
                    <div class="font-bold text-white">{{ app()->getLocale() === 'bn' ? 'অ্যানালিটিক্স ও পারফরম্যান্স' : 'Analytics & Performance' }}</div>
                    <div class="text-[10px] text-slate-400">{{ app()->getLocale() === 'bn' ? 'বেনামী ট্রাফিক পরিমাপ।' : 'Anonymous traffic measurement (GA4, Clarity).' }}</div>
                </div>
                <input type="checkbox" x-model="consentAnalytics" class="rounded text-[#D4AF37] focus:ring-[#D4AF37] bg-white/10 border-white/20">
            </div>

            <div class="flex items-center justify-between text-xs pt-2 border-t border-white/5">
                <div>
                    <div class="font-bold text-white">{{ app()->getLocale() === 'bn' ? 'মার্কেটিং ও রিটার্গেটিং' : 'Marketing & Retargeting Pixels' }}</div>
                    <div class="text-[10px] text-slate-400">{{ app()->getLocale() === 'bn' ? 'ব্যক্তিগতকৃত বিজ্ঞাপনের জন্য।' : 'Personalized travel ads on Meta, Google & TikTok.' }}</div>
                </div>
                <input type="checkbox" x-model="consentMarketing" class="rounded text-[#D4AF37] focus:ring-[#D4AF37] bg-white/10 border-white/20">
            </div>
        </div>

        <!-- Action Buttons Bar -->
        <div class="mt-5 pt-3 border-t border-white/10 flex flex-wrap items-center justify-between gap-2.5">
            <button 
                type="button" 
                @click="showPreferences = !showPreferences" 
                class="text-[11px] font-semibold text-slate-300 hover:text-[#D4AF37] transition underline"
            >
                <span x-text="showPreferences ? '{{ app()->getLocale() === 'bn' ? 'পছন্দ লুকান' : 'Hide Preferences' }}' : '{{ app()->getLocale() === 'bn' ? 'কাস্টমাইজ করুন' : 'Customize Preferences' }}'">{{ app()->getLocale() === 'bn' ? 'কাস্টমাইজ করুন' : 'Customize' }}</span>
            </button>

            <div class="flex items-center gap-2">
                <template x-if="showPreferences">
                    <button 
                        type="button" 
                        @click="savePreferences()" 
                        class="px-3.5 py-1.5 rounded-xl text-xs font-semibold bg-white/10 hover:bg-white/20 text-white transition border border-white/15"
                    >
                        {{ app()->getLocale() === 'bn' ? 'সংরক্ষণ' : 'Save Choices' }}
                    </button>
                </template>

                <button 
                    type="button" 
                    @click="rejectNonEssential()" 
                    class="px-3.5 py-1.5 rounded-xl text-xs font-semibold bg-white/5 hover:bg-white/15 text-slate-200 transition border border-white/10"
                >
                    {{ app()->getLocale() === 'bn' ? 'প্রত্যাখ্যান' : 'Reject Non-Essential' }}
                </button>

                <button 
                    type="button" 
                    @click="acceptAll()" 
                    class="px-4 py-1.5 rounded-xl text-xs font-bold bg-gradient-to-r from-[#D4AF37] to-[#B38F26] text-[#050D1A] hover:brightness-110 transition shadow-md shadow-[#D4AF37]/20"
                >
                    {{ app()->getLocale() === 'bn' ? 'সব গ্রহণ করুন' : 'Accept All' }}
                </button>
            </div>
        </div>
    </div>
</div>
@endif

