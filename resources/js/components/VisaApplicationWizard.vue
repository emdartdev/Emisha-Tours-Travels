<template>
  <div class="card-base p-4 sm:p-6 md:p-10 shadow-xl bg-white border border-slate-100 rounded-2xl sm:rounded-[24px]">
    <!-- Progress Indicator -->
    <div class="mb-6 sm:mb-10">
      <div class="flex items-center justify-between relative">
        <div class="absolute left-0 top-1/2 -translate-y-1/2 h-1 bg-slate-100 w-full z-0"></div>
        <div 
          class="absolute left-0 top-1/2 -translate-y-1/2 h-1 bg-[#D4AF37] transition-all duration-500 z-0"
          :style="{ width: ((step - 1) / 3 * 100) + '%' }"
        ></div>

        <div 
          v-for="s in 4" 
          :key="s"
          class="relative z-10 flex flex-col items-center"
        >
          <div 
            :class="step >= s ? 'bg-[#0B1F3A] text-[#D4AF37] border-2 border-[#D4AF37] shadow-lg shadow-[#0B1F3A]/20' : 'bg-white text-slate-400 border border-slate-200'"
            class="w-8 h-8 sm:w-10 sm:h-10 rounded-full flex items-center justify-center font-extrabold text-xs sm:text-sm transition-all"
          >
            {{ s }}
          </div>
          <span class="hidden sm:block text-[11px] font-bold mt-2 text-[#0B1F3A] text-center">
            {{ stepNames[s - 1] }}
          </span>
        </div>
      </div>
      <!-- Mobile Step Title Display -->
      <div class="block sm:hidden text-center mt-3">
        <span class="text-xs font-bold text-[#0B1F3A]">Step {{ step }}: {{ stepNames[step - 1] }}</span>
      </div>
    </div>

    <!-- Live Form Container -->
    <form @submit.prevent="submitForm" enctype="multipart/form-data">
      <!-- STEP 1: Country & Visa Type Selection -->
      <div v-show="step === 1" class="space-y-6">
        <h3 class="text-xl font-bold font-heading text-[#0B1F3A] pb-2 border-b border-slate-100">Step 1: Select Country & Visa Type</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Destination Country *</label>
            <select 
              v-model="form.visa_country_id" 
              @change="onCountryChange" 
              class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:border-[#D4AF37] text-sm text-[#0B1F3A] bg-white transition cursor-pointer"
              required
            >
              <option value="1">Thailand</option>
              <option value="2">Malaysia</option>
              <option value="3">United Arab Emirates (Dubai)</option>
              <option value="4">Singapore</option>
            </select>
          </div>

          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Visa Category *</label>
            <select 
              v-model="form.visa_type_id" 
              class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:border-[#D4AF37] text-sm text-[#0B1F3A] bg-white transition cursor-pointer"
              required
            >
              <option v-for="type in availableVisaTypes" :key="type.id" :value="type.id">
                {{ type.name }} (৳ {{ formatCurrency(type.fee) }})
              </option>
            </select>
          </div>
        </div>

        <div class="p-5 bg-[#F8FAFC] border border-slate-100 rounded-[20px] flex items-center justify-between shadow-2xs">
          <div class="flex items-center space-x-3">
            <div class="w-10 h-10 rounded-xl bg-[#D4AF37]/15 text-[#0B1F3A] flex items-center justify-center border border-gold/20 flex-shrink-0">
              <svg class="w-5 h-5 text-[#0B1F3A]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
            </div>
            <div>
              <span class="text-xs text-slate-500 font-medium block">Total Facilitation & Embassy Fee</span>
              <span class="text-lg font-extrabold text-[#0B1F3A]">৳ {{ formatCurrency(selectedVisaFee) }}</span>
            </div>
          </div>
          <span class="text-xs font-bold text-emerald-700 bg-emerald-50 border border-emerald-200 px-3 py-1 rounded-full">
            No Hidden Fees
          </span>
        </div>

        <div class="pt-6 flex justify-end">
          <button 
            type="button" 
            @click="nextStep"
            class="px-7 py-3.5 bg-[#0B1F3A] hover:bg-[#071527] text-[#D4AF37] font-extrabold rounded-xl text-xs uppercase tracking-wider shadow-lg transition flex items-center space-x-2"
          >
            <span>Next: Applicant Details</span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
          </button>
        </div>
      </div>

      <!-- STEP 2: Applicant Information -->
      <div v-show="step === 2" class="space-y-6">
        <h3 class="text-xl font-bold font-heading text-[#0B1F3A] pb-2 border-b border-slate-100">Step 2: Applicant Personal Details</h3>

        <div>
          <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Full Legal Name (as on Passport) *</label>
          <input 
            type="text" 
            v-model="form.full_name" 
            required 
            placeholder="e.g. MOHAMMED EMADUL HAQUE" 
            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:border-[#D4AF37] text-sm text-[#0B1F3A] transition"
          />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Email Address *</label>
            <input 
              type="email" 
              v-model="form.email" 
              required 
              placeholder="your.email@example.com" 
              class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:border-[#D4AF37] text-sm text-[#0B1F3A] transition"
            />
          </div>
          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Mobile / WhatsApp Number *</label>
            <input 
              type="tel" 
              v-model="form.phone" 
              required 
              placeholder="+880 1711 XXXXXX" 
              class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:border-[#D4AF37] text-sm text-[#0B1F3A] transition"
            />
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Date of Birth</label>
            <input 
              type="date" 
              v-model="form.date_of_birth" 
              class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:border-[#D4AF37] text-sm text-[#0B1F3A] transition"
            />
          </div>
          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Nationality</label>
            <input 
              type="text" 
              v-model="form.nationality" 
              class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:border-[#D4AF37] text-sm text-[#0B1F3A] transition"
            />
          </div>
          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Passport Number</label>
            <input 
              type="text" 
              v-model="form.passport_number" 
              placeholder="e.g. A01234567" 
              class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:border-[#D4AF37] text-sm text-[#0B1F3A] uppercase transition"
            />
          </div>
        </div>

        <div class="pt-6 flex justify-between">
          <button 
            type="button" 
            @click="prevStep" 
            class="px-6 py-3 border border-slate-200 text-slate-600 hover:bg-slate-50 font-bold rounded-xl text-xs uppercase tracking-wider transition"
          >
            Back
          </button>
          <button 
            type="button" 
            @click="nextStep" 
            class="px-7 py-3.5 bg-[#0B1F3A] hover:bg-[#071527] text-[#D4AF37] font-extrabold rounded-xl text-xs uppercase tracking-wider shadow-lg transition flex items-center gap-2"
          >
            <span>Next: Travel Info</span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
          </button>
        </div>
      </div>

      <!-- STEP 3: Travel Purpose & Occupation -->
      <div v-show="step === 3" class="space-y-6">
        <h3 class="text-xl font-bold font-heading text-[#0B1F3A] pb-2 border-b border-slate-100">Step 3: Travel Purpose & Occupation</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Primary Purpose of Travel</label>
            <select 
              v-model="form.travel_purpose" 
              class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:border-[#D4AF37] text-sm text-[#0B1F3A] bg-white transition cursor-pointer"
            >
              <option value="Tourism & Leisure">Tourism & Leisure</option>
              <option value="Business & Meetings">Business & Meetings</option>
              <option value="Medical Treatment">Medical Treatment</option>
              <option value="Family Visit">Family Visit</option>
              <option value="Student / Education">Student / Education</option>
            </select>
          </div>

          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Your Occupation / Profession *</label>
            <select 
              v-model="form.profession_type_id" 
              class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:border-[#D4AF37] text-sm text-[#0B1F3A] bg-white transition cursor-pointer" 
              required
            >
              <option value="1">Salaried Employee / Service Holder</option>
              <option value="2">Business Owner / Entrepreneur</option>
              <option value="3">Student</option>
              <option value="4">Freelancer / Remote Worker</option>
              <option value="5">Retired Person</option>
              <option value="6">Housewife</option>
              <option value="7">Other Professional</option>
            </select>
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Tentative Travel Date</label>
            <input 
              type="date" 
              v-model="form.travel_date" 
              class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:border-[#D4AF37] text-sm text-[#0B1F3A] transition"
            />
          </div>
          <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Expected Stay Duration</label>
            <input 
              type="text" 
              v-model="form.stay_duration" 
              placeholder="e.g. 10 Days" 
              class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:border-[#D4AF37] text-sm text-[#0B1F3A] transition"
            />
          </div>
        </div>

        <div class="pt-6 flex justify-between">
          <button 
            type="button" 
            @click="prevStep" 
            class="px-6 py-3 border border-slate-200 text-slate-600 hover:bg-slate-50 font-bold rounded-xl text-xs uppercase tracking-wider transition"
          >
            Back
          </button>
          <button 
            type="button" 
            @click="nextStep" 
            class="px-7 py-3.5 bg-[#0B1F3A] hover:bg-[#071527] text-[#D4AF37] font-extrabold rounded-xl text-xs uppercase tracking-wider shadow-lg transition flex items-center gap-2"
          >
            <span>Next: Document Upload</span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
          </button>
        </div>
      </div>

      <!-- STEP 4: Document Upload & Submission -->
      <div v-show="step === 4" class="space-y-6">
        <h3 class="text-xl font-bold font-heading text-[#0B1F3A] pb-2 border-b border-slate-100">Step 4: Secure Document Upload</h3>
        <p class="text-xs text-slate-500">Upload scans or photos now. Supporting files are encrypted in private storage.</p>

        <div class="space-y-4">
          <div class="p-5 border-2 border-dashed border-slate-200 rounded-[20px] bg-[#F8FAFC] hover:border-[#D4AF37]/50 transition">
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Passport Bio-Page Scan (PDF, JPG, PNG)</label>
            <input type="file" ref="passportFile" accept=".pdf,.jpg,.jpeg,.png" class="w-full text-xs text-slate-600">
          </div>

          <div class="p-5 border-2 border-dashed border-slate-200 rounded-[20px] bg-[#F8FAFC] hover:border-[#D4AF37]/50 transition">
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Recent Passport Size Photo (White Background)</label>
            <input type="file" ref="photoFile" accept=".jpg,.jpeg,.png" class="w-full text-xs text-slate-600">
          </div>

          <div class="p-5 border-2 border-dashed border-slate-200 rounded-[20px] bg-[#F8FAFC] hover:border-[#D4AF37]/50 transition">
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Last 6 Months Bank Statement (PDF/JPG)</label>
            <input type="file" ref="bankFile" accept=".pdf,.jpg,.jpeg,.png" class="w-full text-xs text-slate-600">
          </div>
        </div>

        <div class="p-4 rounded-[18px] bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs flex items-center gap-2">
          <svg class="w-4 h-4 text-emerald-700 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
          <span>All documents uploaded to Emisha Tours & Travels are encrypted and strictly confidential.</span>
        </div>

        <div class="pt-6 flex justify-between">
          <button 
            type="button" 
            @click="prevStep" 
            class="px-6 py-3 border border-slate-200 text-slate-600 hover:bg-slate-50 font-bold rounded-xl text-xs uppercase tracking-wider transition"
          >
            Back
          </button>
          <button 
            type="button" 
            @click="submitDirectForm"
            class="px-8 py-4 bg-[#D4AF37] hover:bg-[#C5A028] text-[#0B1F3A] font-extrabold rounded-xl text-sm uppercase tracking-wider shadow-xl transition flex items-center gap-2"
          >
            <span>Submit Application Now</span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
          </button>
        </div>
      </div>
    </form>
  </div>
</template>

<script setup>
import { ref, reactive, computed } from 'vue';

const step = ref(1);
const stepNames = ['Country & Type', 'Applicant Info', 'Travel Details', 'Documents'];

const passportFile = ref(null);
const photoFile = ref(null);
const bankFile = ref(null);

const form = reactive({
  visa_country_id: '1',
  visa_type_id: '1',
  full_name: '',
  email: '',
  phone: '',
  date_of_birth: '',
  nationality: 'Bangladeshi',
  passport_number: '',
  travel_purpose: 'Tourism & Leisure',
  profession_type_id: '1',
  travel_date: '',
  stay_duration: '7-10 Days'
});

const visaCatalog = {
  '1': [
    { id: '1', name: 'Tourist Visa (Single Entry)', fee: 6500 },
    { id: '2', name: 'Medical Visa (Single Entry)', fee: 8500 }
  ],
  '2': [
    { id: '3', name: 'Tourist e-Visa', fee: 7000 }
  ],
  '3': [
    { id: '4', name: '30 Days Tourist E-Visa', fee: 14000 },
    { id: '5', name: '60 Days Tourist E-Visa', fee: 23500 }
  ],
  '4': [
    { id: '6', name: 'Singapore Tourist E-Visa', fee: 6500 }
  ]
};

const availableVisaTypes = computed(() => {
  return visaCatalog[form.visa_country_id] || [];
});

const selectedVisaFee = computed(() => {
  const selected = availableVisaTypes.value.find(t => t.id === form.visa_type_id);
  return selected ? selected.fee : 6500;
});

const onCountryChange = () => {
  const types = availableVisaTypes.value;
  if (types.length > 0) {
    form.visa_type_id = types[0].id;
  }
};

const formatCurrency = (num) => {
  return new Intl.NumberFormat('en-BD').format(num);
};

const nextStep = () => {
  if (step.value < 4) step.value++;
};

const prevStep = () => {
  if (step.value > 1) step.value--;
};

const submitDirectForm = () => {
  // Submit standard HTML post form to Laravel backend
  const nativeForm = document.createElement('form');
  nativeForm.method = 'POST';
  nativeForm.action = '/visa/apply';
  nativeForm.enctype = 'multipart/form-data';

  const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
  if (csrf) {
    const inputCsrf = document.createElement('input');
    inputCsrf.type = 'hidden';
    inputCsrf.name = '_token';
    inputCsrf.value = csrf;
    nativeForm.appendChild(inputCsrf);
  }

  for (const [key, value] of Object.entries(form)) {
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = key;
    input.value = value;
    nativeForm.appendChild(input);
  }

  document.body.appendChild(nativeForm);
  nativeForm.submit();
};
</script>
