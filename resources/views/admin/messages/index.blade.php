@extends('layouts.admin')

@section('title', 'Contact Inquiries & Feedback')
@section('page_title', 'Contact Messages & Customer Inquiries')

@section('content')
<div class="space-y-6">
    <div class="admin-card rounded-3xl border shadow-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="admin-table-head border-b text-[var(--admin-text-muted)] uppercase font-bold text-[10px]">
                    <tr>
                        <th class="py-4 px-6">Sender Details</th>
                        <th class="py-4 px-6">Service Area</th>
                        <th class="py-4 px-6">Message Body</th>
                        <th class="py-4 px-6">Received Date</th>
                        <th class="py-4 px-6">Status</th>
                        <th class="py-4 px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y admin-table-divider">
                    @forelse($messages as $msg)
                        <tr class="admin-table-row transition {{ $msg->status === 'unread' ? 'bg-amber-500/5 font-semibold' : '' }}">
                            <td class="py-4 px-6">
                                <span class="font-extrabold text-[var(--admin-text-main)] block text-sm">{{ $msg->name }}</span>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="text-[var(--admin-text-muted)] font-mono text-[11px]">{{ $msg->phone }}</span>
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $msg->phone) }}?text=Hello%20{{ urlencode($msg->name) }},%20thank%20you%20for%20contacting%20Emisha%20Tours%20&%20Travels." 
                                       target="_blank" 
                                       class="p-1 rounded bg-emerald-500/20 text-emerald-600 dark:text-emerald-400 hover:bg-emerald-500 hover:text-white transition" 
                                       title="WhatsApp Chat">
                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.664-.699c.971.53 1.771.78 2.796.78 3.182 0 5.768-2.587 5.768-5.766.001-3.187-2.575-5.766-5.768-5.766zm-1.077 7.748l-.348-.175c-.538-.27-1.127-.86-1.397-1.399l-.176-.348c-.08-.158-.029-.314.07-.413l.422-.423c.094-.094.094-.247 0-.341l-.846-.846c-.094-.094-.247-.094-.341 0l-.361.361c-.347.348-.445.856-.251 1.309.431 1.009 1.258 1.836 2.267 2.268.453.193.962.096 1.309-.251l.361-.361c.094-.094.094-.247 0-.341l-.846-.846c-.094-.094-.247-.094-.341 0l-.422.423c-.099.099-.255.15-.413.07z"/></svg>
                                    </a>
                                </div>
                                <a href="mailto:{{ $msg->email }}" class="text-[#D4AF37] hover:underline text-[10px] block mt-0.5">{{ $msg->email }}</a>
                            </td>
                            <td class="py-4 px-6 font-bold text-[var(--admin-text-main)]">
                                <span class="px-2.5 py-1 admin-subtle border rounded-lg">
                                    {{ $msg->service ?? 'General Inquiry' }}
                                </span>
                            </td>
                            <td class="py-4 px-6 max-w-sm">
                                <p class="text-[var(--admin-text-main)] leading-relaxed text-xs">{{ $msg->message }}</p>
                            </td>
                            <td class="py-4 px-6 text-[var(--admin-text-muted)] text-[11px]">
                                {{ $msg->created_at->format('M d, Y h:i A') }}
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider
                                    @if($msg->status === 'unread') bg-amber-500/10 text-amber-600 dark:text-amber-400 border border-amber-500/30 animate-pulse
                                    @elseif($msg->status === 'replied') bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/30
                                    @else admin-subtle text-[var(--admin-text-muted)] border @endif">
                                    {{ $msg->status }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right space-x-1.5 whitespace-nowrap">
                                @if($msg->status === 'unread')
                                    <form action="{{ route('admin.contact-messages.read', $msg->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="px-2.5 py-1.5 admin-subtle hover:brightness-110 text-[var(--admin-text-main)] font-bold rounded-lg border transition">
                                            Mark Read
                                        </button>
                                    </form>
                                @endif

                                @if($msg->status !== 'replied')
                                    <form action="{{ route('admin.contact-messages.replied', $msg->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="px-2.5 py-1.5 bg-emerald-500/20 hover:bg-emerald-600 text-emerald-600 dark:text-emerald-400 hover:text-white font-bold rounded-lg border border-emerald-500/30 transition">
                                            Replied
                                        </button>
                                    </form>
                                @endif

                                <form action="{{ route('admin.contact-messages.destroy', $msg->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this message?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 text-[var(--admin-text-muted)] hover:text-rose-500 rounded-lg transition" title="Delete">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-[var(--admin-text-muted)] text-xs">
                                No contact messages received yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($messages->hasPages())
            <div class="p-4 border-t admin-table-divider admin-table-head">
                {{ $messages->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
