@extends('layouts.app')

@section('title', 'Frequently Asked Questions (FAQ) | Emisha Tours & Travels')
@section('meta_description', 'Find answers to frequently asked questions about tour bookings, visa processing, flight tickets, cancellation policies, and payment terms with Emisha Tours.')

@section('schema')
@if(!empty($schema))
    {!! $schema !!}
@endif
@endsection

@section('content')
<!-- Hero Section -->
<div class="bg-[#0B1F3A] py-16 md:py-20 text-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#D4AF37_1px,transparent_1px)] [background-size:20px_20px]"></div>
    <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-gold/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full text-xs font-semibold bg-[#D4AF37]/15 text-[#D4AF37] uppercase tracking-widest mb-3 border border-[#D4AF37]/30">Help & Clarity</span>
        <h1 class="text-3xl md:text-5xl font-extrabold mb-4 text-white tracking-tight">
            <span class="text-white">Frequently Asked Questions</span>
        </h1>
        <p class="text-slate-200 max-w-2xl mx-auto text-base md:text-lg font-normal leading-relaxed">
            Everything you need to know about booking international holidays, visa processing requirements, payments, and airline ticketing.
        </p>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-20">
    <!-- Category Groups / Accordion -->
    @if(isset($faqs) && $faqs->count() > 0)
        @php
            $groupedFaqs = $faqs->groupBy('category');
        @endphp

        <div class="space-y-12">
            @foreach($groupedFaqs as $category => $categoryFaqs)
                <div>
                    <h2 class="text-xl font-bold font-heading text-[#0B1F3A] mb-5 pb-3 border-b border-gold/20 flex items-center justify-between">
                        <span>{{ ucfirst($category ?? 'General Questions') }}</span>
                        <span class="text-xs font-medium text-slate-400">({{ $categoryFaqs->count() }} Questions)</span>
                    </h2>

                    <div class="space-y-4">
                        @foreach($categoryFaqs as $faq)
                            <div class="border border-slate-100 rounded-[20px] overflow-hidden bg-white shadow-[0_4px_20px_rgba(11,31,58,0.03)] hover:shadow-[0_10px_30px_rgba(11,31,58,0.08)] transition-all duration-300">
                                <button type="button" 
                                        onclick="toggleFaq('faq-{{ $faq->id }}')" 
                                        class="w-full px-6 py-5 text-left flex items-center justify-between focus:outline-none group">
                                    <span class="font-bold text-[#0B1F3A] text-sm md:text-base pr-4 group-hover:text-gold transition-colors">{{ $faq->question }}</span>
                                    <span id="faq-icon-{{ $faq->id }}" class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-gold font-bold text-lg transition-transform duration-300 flex-shrink-0 border border-slate-100">+</span>
                                </button>
                                <div id="faq-answer-{{ $faq->id }}" class="hidden px-6 pb-6 pt-1 text-slate-600 text-sm leading-relaxed border-t border-slate-50 font-normal">
                                    {{ $faq->answer }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- Fallback if database empty -->
        <div class="space-y-4">
            <div class="border border-slate-100 rounded-[20px] p-6 bg-white shadow-[0_4px_20px_rgba(11,31,58,0.03)]">
                <h3 class="font-bold font-heading text-[#0B1F3A] mb-2">How early should I apply for my travel visa?</h3>
                <p class="text-slate-600 text-sm leading-relaxed font-normal">We recommend applying at least 3 to 4 weeks prior to your intended departure date to allow sufficient time for embassy processing and verification.</p>
            </div>
            <div class="border border-slate-100 rounded-[20px] p-6 bg-white shadow-[0_4px_20px_rgba(11,31,58,0.03)]">
                <h3 class="font-bold font-heading text-[#0B1F3A] mb-2">What is your tour cancellation and refund policy?</h3>
                <p class="text-slate-600 text-sm leading-relaxed font-normal">Cancellations made 21+ days before departure receive a full refund minus nominal processing costs. Detailed cancellation slabs are outlined in our booking agreement.</p>
            </div>
        </div>
    @endif

    <!-- Still have questions CTA -->
    <div class="mt-16 bg-white border border-slate-100 rounded-[24px] p-8 md:p-12 text-center shadow-[0_10px_30px_rgba(11,31,58,0.04)] relative overflow-hidden">
        <div class="w-14 h-14 rounded-2xl bg-gold/15 text-gold flex items-center justify-center mx-auto mb-4 border border-gold/20">
            <svg class="w-7 h-7 text-[#0B1F3A]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
        </div>
        <h3 class="text-2xl font-bold font-heading text-[#0B1F3A] mb-2">Still Have Questions?</h3>
        <p class="text-slate-500 text-sm max-w-lg mx-auto mb-8 font-normal leading-relaxed">
            Can't find the answer you're looking for? Please chat to our friendly team.
        </p>
        <div class="flex flex-wrap items-center justify-center gap-4">
            <a href="{{ route('contact.index') }}" class="px-7 py-3.5 bg-[#0B1F3A] hover:bg-gold hover:text-[#0B1F3A] text-gold font-bold text-xs uppercase tracking-wider rounded-xl transition-all duration-300 shadow-md">
                Contact Support Desk
            </a>
            <a href="https://wa.me/8801700000000" target="_blank" class="px-7 py-3.5 bg-emerald-600 text-white font-bold text-xs uppercase tracking-wider rounded-xl hover:bg-emerald-700 transition-all duration-300 shadow-md flex items-center gap-2">
                <span>WhatsApp Us Directly</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>
    </div>
</div>

<script>
function toggleFaq(id) {
    const rawId = id.replace('faq-', '');
    const answer = document.getElementById('faq-answer-' + rawId);
    const icon = document.getElementById('faq-icon-' + rawId);
    
    if (answer.classList.contains('hidden')) {
        answer.classList.remove('hidden');
        icon.textContent = '−';
        icon.classList.add('bg-gold/15', 'text-gold');
        icon.classList.remove('bg-slate-50');
    } else {
        answer.classList.add('hidden');
        icon.textContent = '+';
        icon.classList.remove('bg-gold/15');
        icon.classList.add('bg-slate-50');
    }
}
</script>
@endsection
