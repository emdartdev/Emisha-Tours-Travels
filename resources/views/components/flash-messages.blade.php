@if(session('success') && !session('contact_success_modal') && !session('show_status_modal') && !session('ticket_success_modal'))
<div class="px-4 lg:px-8 pt-4">
    <div class="p-4 rounded-2xl bg-emerald-950/80 border border-emerald-500/40 text-emerald-300 flex items-start gap-3 shadow-xl backdrop-blur-md" role="alert">
        <svg class="w-5 h-5 text-emerald-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <div class="text-xs font-semibold">
            {{ session('success') }}
        </div>
    </div>
</div>
@endif

@if(session('error'))
<div class="px-4 lg:px-8 pt-4">
    <div class="p-4 rounded-2xl bg-rose-950/80 border border-rose-500/40 text-rose-300 flex items-start gap-3 shadow-xl backdrop-blur-md" role="alert">
        <svg class="w-5 h-5 text-rose-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <div class="text-xs font-semibold">
            {{ session('error') }}
        </div>
    </div>
</div>
@endif

@if($errors->any())
<div class="px-4 lg:px-8 pt-4">
    <div class="p-4 rounded-2xl bg-amber-950/80 border border-amber-500/40 text-amber-300 shadow-xl backdrop-blur-md" role="alert">
        <div class="flex items-center gap-2 font-bold text-xs mb-2 text-amber-300">
            <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            <span>Please check the following:</span>
        </div>
        <ul class="list-disc list-inside text-xs space-y-1 text-amber-200/90 pl-2">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif
