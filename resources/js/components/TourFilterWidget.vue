<template>
  <div class="bg-white rounded-[24px] p-6 md:p-7 border border-slate-100 shadow-[0_10px_30px_rgba(11,31,58,0.04)] space-y-6">
    <div class="flex items-center justify-between pb-4 border-b border-slate-100">
      <h3 class="font-extrabold text-[#0B1F3A] text-base flex items-center gap-2">
        <svg class="w-4 h-4 text-[#D4AF37]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
        </svg>
        <span>Filter Packages</span>
      </h3>
      <button 
        type="button" 
        @click="resetFilters" 
        class="text-xs text-slate-400 hover:text-[#D4AF37] font-semibold transition"
      >
        Reset All
      </button>
    </div>

    <!-- Keyword Search -->
    <div>
      <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Search by Name</label>
      <input 
        type="text" 
        v-model="filters.search" 
        @keyup.enter="applyFilters"
        placeholder="e.g. Bangkok, Cox's Bazar..." 
        class="w-full px-4 py-2.5 rounded-xl border border-slate-200/90 focus:outline-none focus:border-[#D4AF37] focus:ring-2 focus:ring-[#D4AF37]/20 text-xs text-[#0B1F3A] transition"
      />
    </div>

    <!-- Price Range Slider -->
    <div>
      <div class="flex justify-between items-center mb-2">
        <label class="text-xs font-bold uppercase tracking-wider text-slate-700">Max Budget</label>
        <span class="text-xs font-extrabold text-[#D4AF37]">৳ {{ formatCurrency(filters.maxPrice) }}</span>
      </div>
      <input 
        type="range" 
        v-model.number="filters.maxPrice" 
        min="5000" 
        max="300000" 
        step="5000"
        class="w-full h-2 bg-slate-100 rounded-lg appearance-none cursor-pointer accent-[#D4AF37]"
      />
      <div class="flex justify-between text-[10px] text-slate-400 mt-1">
        <span>৳ 5,000</span>
        <span>৳ 300,000+</span>
      </div>
    </div>

    <!-- Duration Filter -->
    <div>
      <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Duration</label>
      <div class="grid grid-cols-2 gap-2">
        <button 
          type="button"
          v-for="dur in durationOptions" 
          :key="dur.value"
          @click="toggleDuration(dur.value)"
          :class="filters.duration === dur.value ? 'bg-[#0B1F3A] text-[#D4AF37] border-[#0B1F3A] shadow-sm' : 'bg-slate-50 text-slate-600 border-slate-100 hover:bg-slate-100'"
          class="px-3 py-2 rounded-xl text-xs font-semibold border transition text-center"
        >
          {{ dur.label }}
        </button>
      </div>
    </div>

    <!-- Sort By -->
    <div>
      <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Sort Packages</label>
      <select 
        v-model="filters.sort" 
        class="w-full px-3 py-2.5 rounded-xl border border-slate-200/90 focus:outline-none focus:border-[#D4AF37] text-xs text-[#0B1F3A] bg-white transition cursor-pointer"
      >
        <option value="featured">Featured First</option>
        <option value="price_low">Price: Low to High</option>
        <option value="price_high">Price: High to Low</option>
        <option value="duration_short">Shortest Duration</option>
        <option value="newest">Newest Added</option>
      </select>
    </div>

    <!-- Apply Filter Button -->
    <button 
      type="button" 
      @click="applyFilters"
      class="w-full py-3 bg-[#0B1F3A] hover:bg-[#071527] text-[#D4AF37] font-bold rounded-xl shadow-md transition duration-200 text-xs uppercase tracking-wider flex items-center justify-center space-x-1.5"
    >
      <span>Apply Filters</span>
      <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
      </svg>
    </button>
  </div>
</template>

<script setup>
import { ref, reactive, onMounted } from 'vue';

const durationOptions = [
  { label: 'All', value: '' },
  { label: '1 - 3 Days', value: '1-3' },
  { label: '4 - 7 Days', value: '4-7' },
  { label: '8+ Days', value: '8+' }
];

const filters = reactive({
  search: '',
  maxPrice: 200000,
  duration: '',
  sort: 'featured'
});

onMounted(() => {
  const urlParams = new URLSearchParams(window.location.search);
  if (urlParams.has('search')) filters.search = urlParams.get('search');
  if (urlParams.has('max_price')) filters.maxPrice = Number(urlParams.get('max_price'));
  if (urlParams.has('duration')) filters.duration = urlParams.get('duration');
  if (urlParams.has('sort')) filters.sort = urlParams.get('sort');
});

const formatCurrency = (val) => {
  return new Intl.NumberFormat('en-BD').format(val);
};

const toggleDuration = (val) => {
  filters.duration = filters.duration === val ? '' : val;
};

const resetFilters = () => {
  window.location.href = '/tours';
};

const applyFilters = () => {
  const params = new URLSearchParams(window.location.search);
  
  if (filters.search) params.set('search', filters.search);
  else params.delete('search');

  if (filters.maxPrice < 300000) params.set('max_price', filters.maxPrice);
  else params.delete('max_price');

  if (filters.duration) params.set('duration', filters.duration);
  else params.delete('duration');

  if (filters.sort && filters.sort !== 'featured') params.set('sort', filters.sort);
  else params.delete('sort');

  window.location.href = `/tours?${params.toString()}`;
};
</script>
