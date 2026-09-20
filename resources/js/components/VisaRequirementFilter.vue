<template>
  <div class="bg-white rounded-[24px] p-6 md:p-8 border border-slate-100 shadow-[0_10px_30px_rgba(11,31,58,0.04)]">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-100">
      <div>
        <span class="text-xs font-bold text-[#D4AF37] uppercase tracking-wider">Dynamic Checklist</span>
        <h3 class="text-xl font-bold font-heading text-[#0B1F3A]">Required Documents By Profession</h3>
      </div>

      <!-- Prepared Checklist Tracker Progress -->
      <div class="bg-[#F8FAFC] px-4 py-2.5 rounded-[20px] border border-slate-100 flex items-center gap-3">
        <div class="text-right">
          <span class="text-[10px] uppercase font-bold text-slate-400 block">Readiness</span>
          <span class="text-xs font-bold text-[#0B1F3A]">{{ completedCount }} of {{ currentDocuments.length }} Ready</span>
        </div>
        <div class="w-12 h-12 rounded-full border-4 border-slate-200 flex items-center justify-center font-bold text-xs" :class="completedCount === currentDocuments.length ? 'border-emerald-500 text-emerald-600' : 'border-[#D4AF37] text-[#0B1F3A]'">
          {{ Math.round((completedCount / (currentDocuments.length || 1)) * 100) }}%
        </div>
      </div>
    </div>

    <!-- Profession Switcher Tabs -->
    <div class="flex items-center gap-2 py-6 overflow-x-auto scrollbar-none border-b border-slate-100">
      <button 
        type="button"
        v-for="prof in professions" 
        :key="prof.id"
        @click="selectedProfession = prof.id"
        :class="selectedProfession === prof.id ? 'bg-[#0B1F3A] text-[#D4AF37] shadow-lg shadow-[#0B1F3A]/20' : 'bg-slate-50 text-slate-600 hover:bg-slate-100'"
        class="px-4 py-2.5 rounded-xl text-xs font-bold whitespace-nowrap transition flex items-center gap-1.5"
      >
        <span>{{ prof.name }}</span>
      </button>
    </div>

    <!-- Active Profession Requirements List -->
    <div class="py-6 space-y-3">
      <div 
        v-for="(doc, index) in currentDocuments" 
        :key="index"
        @click="toggleCheck(index)"
        :class="checkedState[index] ? 'bg-emerald-50/50 border-emerald-200' : 'bg-[#F8FAFC] border-slate-100 hover:border-[#D4AF37]/50 hover:bg-white'"
        class="p-4 rounded-[18px] border transition cursor-pointer flex items-start justify-between gap-4 shadow-2xs"
      >
        <div class="flex items-start gap-3">
          <div 
            :class="checkedState[index] ? 'bg-emerald-600 text-white border-emerald-600' : 'border-slate-300 bg-white'"
            class="w-5 h-5 rounded-md border flex items-center justify-center text-xs flex-shrink-0 mt-0.5 transition"
          >
            <svg v-if="checkedState[index]" class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
          </div>
          <div>
            <h4 class="text-sm font-bold text-[#0B1F3A]" :class="{ 'line-through text-slate-400': checkedState[index] }">
              {{ doc.title }}
            </h4>
            <p class="text-xs text-slate-500 mt-0.5 leading-relaxed">{{ doc.description }}</p>
          </div>
        </div>

        <span 
          :class="doc.mandatory ? 'bg-red-50 text-red-600 border-red-200' : 'bg-slate-100 text-slate-500 border-slate-200'"
          class="text-[10px] font-bold px-2 py-0.5 rounded border uppercase flex-shrink-0"
        >
          {{ doc.mandatory ? 'Mandatory' : 'Supporting' }}
        </span>
      </div>
    </div>

    <!-- Bottom Action Bar -->
    <div class="pt-6 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4">
      <div class="text-xs text-slate-500 flex items-center gap-2">
        <svg class="w-4 h-4 text-[#D4AF37] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <span>Click on any document item above to check off items you have gathered.</span>
      </div>

      <a 
        href="/visa/apply" 
        class="w-full sm:w-auto px-6 py-3.5 bg-[#D4AF37] hover:bg-[#C5A028] text-[#0B1F3A] font-extrabold rounded-xl shadow-lg text-xs uppercase tracking-wider transition text-center flex items-center justify-center gap-2"
      >
        <span>Apply with these Documents</span>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
      </a>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, reactive } from 'vue';

const professions = [
  { id: 'job', name: 'Salaried Employee' },
  { id: 'business', name: 'Business Owner' },
  { id: 'student', name: 'Student' },
  { id: 'freelancer', name: 'Freelancer / IT' },
  { id: 'doctor', name: 'Doctor / Lawyer' },
  { id: 'housewife', name: 'Housewife' },
  { id: 'retired', name: 'Retired' },
];

const selectedProfession = ref('job');
const checkedState = reactive({});

const professionDocuments = {
  job: [
    { title: 'Original Passport (Minimum 6 months validity)', description: 'Must have at least 2 blank visa pages.', mandatory: true },
    { title: 'Recent 2x Passport Photos (35mm x 45mm, White background)', description: 'Taken within last 3 months, matte finish.', mandatory: true },
    { title: 'Bank Statement (Last 6 Months) & Solvency Certificate', description: 'Minimum closing balance ৳150,000+ per applicant with official seal.', mandatory: true },
    { title: 'No Objection Certificate (NOC) / Leave Approval Letter', description: 'On company official letterhead stating designation, joining date, and approved leave.', mandatory: true },
    { title: 'Office ID Card & Visiting Card Copy', description: 'Clear photo or photocopy.', mandatory: false },
    { title: 'Salary Slips / Pay Stubs (Last 3 Months)', description: 'Required for UK, Schengen, USA, and Australian applications.', mandatory: false },
  ],
  business: [
    { title: 'Original Passport (Minimum 6 months validity)', description: 'Must have at least 2 blank visa pages.', mandatory: true },
    { title: 'Recent 2x Passport Photos (35mm x 45mm, White background)', description: 'Taken within last 3 months with official specifications.', mandatory: true },
    { title: 'Company & Personal Bank Statement (Last 6 Months)', description: 'Official bank solvency certificate attached.', mandatory: true },
    { title: 'Valid Trade License with Notarized English Translation', description: 'Updated renewal copy for current fiscal year.', mandatory: true },
    { title: 'Memorandum of Articles / Partnership Deed (If applicable)', description: 'For Limited / Partnership companies.', mandatory: false },
    { title: 'Official Company Letterhead Pad & Visiting Card', description: '2 blank letterheads for visa petition processing.', mandatory: true },
    { title: 'TIN Certificate & Latest Tax Return Receipt', description: 'Copy of tax acknowledgment slip.', mandatory: false },
  ],
  student: [
    { title: 'Original Passport (Minimum 6 months validity)', description: 'Must have at least 2 blank pages.', mandatory: true },
    { title: 'Recent 2x Passport Photos (White background)', description: 'Standard embassy format.', mandatory: true },
    { title: 'Valid Student ID Card & Leave / Enrollment Letter', description: 'Issued by current school, college, or university authority.', mandatory: true },
    { title: 'Sponsor (Parent) Bank Statement & Solvency Certificate', description: 'Last 6 months active account history with sufficient funds.', mandatory: true },
    { title: 'Parental Sponsorship Consent Letter', description: 'Stating financial responsibility for the trip.', mandatory: true },
  ],
  freelancer: [
    { title: 'Original Passport (Minimum 6 months validity)', description: 'With 2 blank pages minimum.', mandatory: true },
    { title: 'Recent 2x Passport Photos (White background)', description: 'Matte paper format.', mandatory: true },
    { title: 'Personal Bank Statement (Last 6 Months) with Solvency', description: 'Showing foreign remittance / freelancing inward transfers.', mandatory: true },
    { title: 'Freelancer / Marketplace Profile Summary', description: 'Top Rated / verified profile link (Upwork, Fiverr) or client contracts.', mandatory: true },
    { title: 'BASIS / ICT Freelancer ID Card (If available)', description: 'Helpful for expedited approvals.', mandatory: false },
  ],
  doctor: [
    { title: 'Original Passport (Minimum 6 months validity)', description: 'Valid for at least 6 months beyond travel.', mandatory: true },
    { title: 'Recent 2x Passport Photos (White background)', description: 'Standard visa size.', mandatory: true },
    { title: 'BMDC / Bar Council Certificate & Registration', description: 'Copy of medical or legal license.', mandatory: true },
    { title: 'Hospital / Chamber Letterhead or Institutional NOC', description: 'Leave confirmation letter.', mandatory: true },
    { title: 'Bank Statement (Last 6 Months) & Solvency', description: 'Healthy balance verified by bank.', mandatory: true },
  ],
  housewife: [
    { title: 'Original Passport (Minimum 6 months validity)', description: 'Valid passport with blank pages.', mandatory: true },
    { title: 'Recent 2x Passport Photos (White background)', description: 'Taken recently.', mandatory: true },
    { title: 'Spouse\'s Passport / NID Copy & Marriage Certificate (Nikahnama)', description: 'English translation with notary.', mandatory: true },
    { title: 'Spouse\'s Financial Sponsorship Documents (Bank & NOC)', description: 'Spouse\'s last 6 months bank statement and profession proof.', mandatory: true },
  ],
  retired: [
    { title: 'Original Passport (Minimum 6 months validity)', description: '6 months validity.', mandatory: true },
    { title: 'Recent 2x Passport Photos (White background)', description: 'Standard size.', mandatory: true },
    { title: 'Retirement Documents / Pension Book / Order Copy', description: 'Proof of government or private retirement.', mandatory: true },
    { title: 'Personal Bank Statement & Solvency Certificate', description: 'Last 6 months account statement.', mandatory: true },
  ]
};

const currentDocuments = computed(() => {
  return professionDocuments[selectedProfession.value] || professionDocuments.job;
});

const completedCount = computed(() => {
  return Object.values(checkedState).filter(Boolean).length;
});

const toggleCheck = (index) => {
  checkedState[index] = !checkedState[index];
};
</script>
