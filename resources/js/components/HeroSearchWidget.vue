<template>
  <div class="w-full bg-white/95 backdrop-blur-2xl rounded-2xl sm:rounded-[24px] md:rounded-[26px] p-3.5 sm:p-5 md:p-6 shadow-[0_20px_50px_-10px_rgba(7,21,39,0.25)] sm:shadow-[0_25px_60px_-15px_rgba(7,21,39,0.35)] border border-white/80 ring-1 ring-black/5 transition-all">
    
    <!-- Minimal Segmented Service Tabs -->
    <div class="flex items-center justify-start mb-3.5 sm:mb-5 overflow-x-auto scrollbar-none pb-1 -mx-1 px-1">
      <div class="inline-flex p-1 bg-slate-100/90 rounded-xl sm:rounded-2xl gap-1 border border-slate-200/60 shadow-inner w-full sm:w-auto">
        <!-- Tab 1: Holiday Packages -->
        <button 
          type="button"
          @click="activeTab = 'tours'"
          :class="activeTab === 'tours' 
            ? 'bg-[#0B1F3A] text-[#D4AF37] shadow-sm font-semibold' 
            : 'text-slate-600 hover:text-[#0B1F3A] hover:bg-white/70 font-medium'"
          class="flex-1 sm:flex-initial flex items-center justify-center space-x-1 sm:space-x-2 px-2 sm:px-4 py-2 rounded-lg sm:rounded-xl text-[10px] xs:text-[11px] sm:text-xs uppercase tracking-wider transition-all duration-200 flex-shrink-0 cursor-pointer"
        >
          <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
          <span class="whitespace-nowrap">Tour Packages</span>
        </button>

        <!-- Tab 2: Visa Services -->
        <button 
          type="button"
          @click="activeTab = 'visa'"
          :class="activeTab === 'visa' 
            ? 'bg-[#0B1F3A] text-[#D4AF37] shadow-sm font-semibold' 
            : 'text-slate-600 hover:text-[#0B1F3A] hover:bg-white/70 font-medium'"
          class="flex-1 sm:flex-initial flex items-center justify-center space-x-1 sm:space-x-2 px-2 sm:px-4 py-2 rounded-lg sm:rounded-xl text-[10px] xs:text-[11px] sm:text-xs uppercase tracking-wider transition-all duration-200 flex-shrink-0 cursor-pointer"
        >
          <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
          </svg>
          <span class="whitespace-nowrap">Visa Services</span>
        </button>

        <!-- Tab 3: Air Ticketing -->
        <button 
          type="button"
          @click="activeTab = 'flights'"
          :class="activeTab === 'flights' 
            ? 'bg-[#0B1F3A] text-[#D4AF37] shadow-sm font-semibold' 
            : 'text-slate-600 hover:text-[#0B1F3A] hover:bg-white/70 font-medium'"
          class="flex-1 sm:flex-initial flex items-center justify-center space-x-1 sm:space-x-2 px-2 sm:px-4 py-2 rounded-lg sm:rounded-xl text-[10px] xs:text-[11px] sm:text-xs uppercase tracking-wider transition-all duration-200 flex-shrink-0 cursor-pointer"
        >
          <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
          </svg>
          <span class="whitespace-nowrap">Air Ticketing</span>
        </button>
      </div>
    </div>

    <!-- TAB 1: TOUR PACKAGES SEARCH -->
    <div v-if="activeTab === 'tours'" class="grid grid-cols-1 md:grid-cols-12 gap-2.5 sm:gap-3.5 items-end">
      <!-- Destination Field -->
      <div class="md:col-span-4 relative">
        <label class="block text-[10px] sm:text-[10.5px] font-bold uppercase tracking-wider text-slate-400 mb-1 flex items-center gap-1">
          <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
          <span>Where to?</span>
        </label>
        <div class="relative bg-slate-50/90 hover:bg-slate-50 border border-slate-200/80 rounded-xl transition focus-within:bg-white focus-within:border-[#D4AF37] focus-within:ring-2 focus-within:ring-[#D4AF37]/15">
          <input 
            type="text" 
            v-model="tourQuery" 
            @focus="showTourSuggestions = true"
            placeholder="e.g. Thailand, Bali, Dubai..." 
            class="w-full pl-3.5 pr-8 py-2.5 h-[42px] sm:h-[44px] bg-transparent border-0 focus:outline-none text-xs sm:text-sm font-semibold text-[#0B1F3A] placeholder-slate-400"
          />
          <button 
            v-if="tourQuery" 
            @click="tourQuery = ''" 
            type="button" 
            class="absolute right-2.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 p-1"
          >
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
          </button>
        </div>

        <!-- Autocomplete Suggestions Dropdown -->
        <div 
          v-if="showTourSuggestions && filteredTourDestinations.length > 0" 
          class="absolute left-0 right-0 top-full mt-1.5 bg-white rounded-xl shadow-2xl border border-slate-100 py-1.5 z-50 max-h-48 sm:max-h-56 overflow-y-auto"
        >
          <div 
            v-for="item in filteredTourDestinations" 
            :key="item"
            @mousedown="selectTourDestination(item)"
            class="px-3.5 py-2 hover:bg-slate-50 cursor-pointer flex items-center justify-between text-xs font-semibold text-slate-700 hover:text-[#0B1F3A] transition"
          >
            <div class="flex items-center space-x-2">
              <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
              <span>{{ item }}</span>
            </div>
            <span class="text-[9px] text-[#D4AF37] uppercase font-bold tracking-wider">Popular</span>
          </div>
        </div>
      </div>

      <!-- Tour Category Dropdown -->
      <div class="md:col-span-3">
        <label class="block text-[10px] sm:text-[10.5px] font-bold uppercase tracking-wider text-slate-400 mb-1 flex items-center gap-1">
          <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
          <span>Tour Style</span>
        </label>
        <div class="relative bg-slate-50/90 hover:bg-slate-50 border border-slate-200/80 rounded-xl transition focus-within:bg-white focus-within:border-[#D4AF37] focus-within:ring-2 focus-within:ring-[#D4AF37]/15">
          <select 
            v-model="selectedCategory" 
            class="w-full pl-3.5 pr-8 py-2.5 h-[42px] sm:h-[44px] bg-transparent border-0 focus:outline-none text-xs sm:text-sm font-semibold text-[#0B1F3A] appearance-none cursor-pointer"
          >
            <option value="">All Categories</option>
            <option value="international-packages">International Tours</option>
            <option value="domestic-holidays">Domestic Holidays</option>
            <option value="honeymoon-specials">Honeymoon Specials</option>
            <option value="family-vacations">Family Vacations</option>
            <option value="adventure-trekking">Adventure & Trekking</option>
          </select>
          <svg class="w-4 h-4 text-slate-400 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
        </div>
      </div>

      <!-- Duration Dropdown -->
      <div class="md:col-span-3">
        <label class="block text-[10px] sm:text-[10.5px] font-bold uppercase tracking-wider text-slate-400 mb-1 flex items-center gap-1">
          <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          <span>Duration</span>
        </label>
        <div class="relative bg-slate-50/90 hover:bg-slate-50 border border-slate-200/80 rounded-xl transition focus-within:bg-white focus-within:border-[#D4AF37] focus-within:ring-2 focus-within:ring-[#D4AF37]/15">
          <select 
            v-model="selectedDuration" 
            class="w-full pl-3.5 pr-8 py-2.5 h-[42px] sm:h-[44px] bg-transparent border-0 focus:outline-none text-xs sm:text-sm font-semibold text-[#0B1F3A] appearance-none cursor-pointer"
          >
            <option value="">Any Duration</option>
            <option value="1-3">1 to 3 Days</option>
            <option value="4-7">4 to 7 Days (Popular)</option>
            <option value="8-14">8 to 14 Days</option>
            <option value="15+">15+ Days Extended</option>
          </select>
          <svg class="w-4 h-4 text-slate-400 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
        </div>
      </div>

      <!-- Search CTA Button -->
      <div class="md:col-span-2">
        <button 
          type="button" 
          @click="submitTourSearch"
          class="w-full btn btn-gold btn-md h-[42px] sm:h-[44px] rounded-xl font-bold shadow-md flex items-center justify-center gap-2 cursor-pointer text-xs sm:text-sm"
        >
          <span>Search</span>
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </button>
      </div>
    </div>

    <!-- TAB 2: VISA SERVICES SEARCH -->
    <div v-if="activeTab === 'visa'" class="grid grid-cols-1 md:grid-cols-12 gap-2.5 sm:gap-3.5 items-end">
      <!-- Destination Country -->
      <div class="md:col-span-5 relative">
        <label class="block text-[10px] sm:text-[10.5px] font-bold uppercase tracking-wider text-slate-400 mb-1 flex items-center gap-1">
          <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          <span>Destination Country</span>
        </label>
        <div class="relative bg-slate-50/90 hover:bg-slate-50 border border-slate-200/80 rounded-xl transition focus-within:bg-white focus-within:border-[#D4AF37] focus-within:ring-2 focus-within:ring-[#D4AF37]/15">
          <input 
            type="text" 
            v-model="visaCountryQuery" 
            placeholder="e.g. Thailand, Dubai, Schengen, UK..." 
            class="w-full pl-3.5 pr-8 py-2.5 h-[42px] sm:h-[44px] bg-transparent border-0 focus:outline-none text-xs sm:text-sm font-semibold text-[#0B1F3A] placeholder-slate-400"
          />
        </div>
      </div>

      <!-- Profession -->
      <div class="md:col-span-4">
        <label class="block text-[10px] sm:text-[10.5px] font-bold uppercase tracking-wider text-slate-400 mb-1 flex items-center gap-1">
          <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
          <span>Your Profession</span>
        </label>
        <div class="relative bg-slate-50/90 hover:bg-slate-50 border border-slate-200/80 rounded-xl transition focus-within:bg-white focus-within:border-[#D4AF37] focus-within:ring-2 focus-within:ring-[#D4AF37]/15">
          <select 
            v-model="selectedProfession" 
            class="w-full pl-3.5 pr-8 py-2.5 h-[42px] sm:h-[44px] bg-transparent border-0 focus:outline-none text-xs sm:text-sm font-semibold text-[#0B1F3A] appearance-none cursor-pointer"
          >
            <option value="">All Professions</option>
            <option value="salaried-job">Salaried Private / MNC Employee</option>
            <option value="business-owner">Business Owner / Proprietor</option>
            <option value="student">Student</option>
            <option value="doctor-lawyer">Doctor / Lawyer / Govt Officer</option>
          </select>
          <svg class="w-4 h-4 text-slate-400 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
        </div>
      </div>

      <!-- Action Button -->
      <div class="md:col-span-3">
        <button 
          type="button" 
          @click="submitVisaSearch"
          class="w-full btn btn-primary btn-md h-[42px] sm:h-[44px] rounded-xl font-bold shadow-md flex items-center justify-center gap-2 cursor-pointer text-xs sm:text-sm"
        >
          <span>Check Visa Req.</span>
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </button>
      </div>
    </div>

    <!-- TAB 3: AIR TICKETING FAST ROUTE -->
    <div v-if="activeTab === 'flights'" class="grid grid-cols-1 md:grid-cols-12 gap-2.5 sm:gap-3.5 items-end">
      <!-- Origin -->
      <div class="md:col-span-4">
        <label class="block text-[10px] sm:text-[10.5px] font-bold uppercase tracking-wider text-slate-400 mb-1 flex items-center gap-1">
          <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
          <span>From (Origin)</span>
        </label>
        <div class="relative bg-slate-50/90 hover:bg-slate-50 border border-slate-200/80 rounded-xl transition focus-within:bg-white focus-within:border-[#D4AF37] focus-within:ring-2 focus-within:ring-[#D4AF37]/15">
          <input 
            type="text" 
            v-model="flightOrigin" 
            placeholder="e.g. Dhaka (DAC)" 
            class="w-full pl-3.5 pr-8 py-2.5 h-[42px] sm:h-[44px] bg-transparent border-0 focus:outline-none text-xs sm:text-sm font-semibold text-[#0B1F3A] placeholder-slate-400"
          />
        </div>
      </div>

      <!-- Destination -->
      <div class="md:col-span-4">
        <label class="block text-[10px] sm:text-[10.5px] font-bold uppercase tracking-wider text-slate-400 mb-1 flex items-center gap-1">
          <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
          <span>To (Destination)</span>
        </label>
        <div class="relative bg-slate-50/90 hover:bg-slate-50 border border-slate-200/80 rounded-xl transition focus-within:bg-white focus-within:border-[#D4AF37] focus-within:ring-2 focus-within:ring-[#D4AF37]/15">
          <input 
            type="text" 
            v-model="flightDestination" 
            placeholder="e.g. Bangkok (BKK), Dubai (DXB)..." 
            class="w-full pl-3.5 pr-8 py-2.5 h-[42px] sm:h-[44px] bg-transparent border-0 focus:outline-none text-xs sm:text-sm font-semibold text-[#0B1F3A] placeholder-slate-400"
          />
        </div>
      </div>

      <!-- Action Button -->
      <div class="md:col-span-4">
        <button 
          type="button" 
          @click="submitFlightSearch"
          class="w-full btn btn-gold btn-md h-[42px] sm:h-[44px] rounded-xl font-bold shadow-md flex items-center justify-center gap-2 cursor-pointer text-xs sm:text-sm"
        >
          <span>Request Quote</span>
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </button>
      </div>
    </div>

    <!-- Quick Popular Suggestions Footer -->
    <div class="mt-3.5 pt-3 border-t border-slate-100 flex flex-wrap items-center justify-between gap-1.5 sm:gap-2 text-[10.5px] sm:text-[11px] text-slate-500">
      <div class="flex items-center gap-1.5 sm:gap-2 flex-wrap">
        <span class="font-bold text-[#0B1F3A] flex items-center gap-1">
          <svg class="w-3 h-3 text-[#D4AF37]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.527.82-1.17 2.094-1.782 3.822C7.747 8.528 6.94 10.373 6.94 12.5a5.06 5.06 0 0010.12 0c0-2.316-.92-4.485-2.22-6.526-.64-1.004-1.405-2.083-2.445-3.421z" clip-rule="evenodd"/></svg>
          <span>Trending:</span>
        </span>
        <a href="/tours?search=Thailand" class="text-slate-600 hover:text-[#D4AF37] hover:underline font-medium">Thailand</a>
        <span class="text-slate-300">•</span>
        <a href="/tours?search=Maldives" class="text-slate-600 hover:text-[#D4AF37] hover:underline font-medium">Maldives</a>
        <span class="text-slate-300">•</span>
        <a href="/tours?search=Dubai" class="text-slate-600 hover:text-[#D4AF37] hover:underline font-medium">Dubai</a>
        <span class="text-slate-300">•</span>
        <a href="/tours?search=Malaysia" class="text-slate-600 hover:text-[#D4AF37] hover:underline font-medium">Malaysia</a>
        <span class="text-slate-300">•</span>
        <a href="/tours?search=Cox" class="text-slate-600 hover:text-[#D4AF37] hover:underline font-medium">Cox's Bazar</a>
      </div>
      <div class="text-[10px] sm:text-[10.5px] text-slate-400 font-medium hidden sm:block">
        Direct partner rates • Instant confirmation
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';

const activeTab = ref('tours');

// Tour search state
const tourQuery = ref('');
const selectedCategory = ref('');
const selectedDuration = ref('');
const showTourSuggestions = ref(false);

const popularDestinations = [
  'Thailand', 'Malaysia', 'Dubai (UAE)', 'Singapore', 
  'Maldives', 'Bali (Indonesia)', 'Cox\'s Bazar', 'Sajek Valley', 'Sylhet & Sreemangal'
];

const filteredTourDestinations = computed(() => {
  if (!tourQuery.value) return popularDestinations;
  return popularDestinations.filter(d => 
    d.toLowerCase().includes(tourQuery.value.toLowerCase())
  );
});

const selectTourDestination = (destination) => {
  tourQuery.value = destination;
  showTourSuggestions.value = false;
};

const submitTourSearch = () => {
  const params = new URLSearchParams();
  if (tourQuery.value) params.append('search', tourQuery.value);
  if (selectedCategory.value) params.append('category', selectedCategory.value);
  if (selectedDuration.value) params.append('duration', selectedDuration.value);
  
  window.location.href = `/tours?${params.toString()}`;
};

// Visa search state
const visaCountryQuery = ref('');
const selectedProfession = ref('');

const submitVisaSearch = () => {
  const params = new URLSearchParams();
  if (visaCountryQuery.value) params.append('search', visaCountryQuery.value);
  if (selectedProfession.value) params.append('profession', selectedProfession.value);

  window.location.href = `/visa?${params.toString()}`;
};

// Flight search state
const flightOrigin = ref('Dhaka (DAC)');
const flightDestination = ref('');

const submitFlightSearch = () => {
  const params = new URLSearchParams();
  if (flightOrigin.value) params.append('origin', flightOrigin.value);
  if (flightDestination.value) params.append('destination', flightDestination.value);

  window.location.href = `/air-ticketing?${params.toString()}`;
};
</script>
