@extends('layouts.admin')

@section('title', 'Blog & Travel Guides CMS')
@section('page_title', 'Travel Guides & Insights CMS')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 admin-card rounded-3xl p-6 border shadow-xl">
        <div>
            <h3 class="text-base font-extrabold text-[var(--admin-text-main)] tracking-tight">Travel Articles & Editorial Desk</h3>
            <p class="text-xs text-[var(--admin-text-muted)] mt-0.5">Publish SEO travel guides, visa policy updates, and holiday inspiration.</p>
        </div>

        <a href="{{ route('admin.blog.create') }}" class="px-5 py-2.5 bg-gradient-to-r from-[#D4AF37] to-[#B38F26] text-[#050D1A] font-extrabold rounded-xl text-xs uppercase tracking-wider hover:brightness-110 shadow-lg shadow-[#D4AF37]/20 transition flex items-center gap-2 self-start sm:self-auto">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
            <span>Write New Article</span>
        </a>
    </div>

    <div class="admin-card rounded-3xl border shadow-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="admin-table-head border-b text-[var(--admin-text-muted)] uppercase font-bold text-[10px]">
                    <tr>
                        <th class="py-4 px-6">Article Title</th>
                        <th class="py-4 px-6">Category</th>
                        <th class="py-4 px-6">Author</th>
                        <th class="py-4 px-6">Published Date</th>
                        <th class="py-4 px-6">Status</th>
                        <th class="py-4 px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y admin-table-divider">
                    @forelse($posts as $post)
                        <tr class="admin-table-row transition">
                            <td class="py-4 px-6">
                                <span class="font-extrabold text-[var(--admin-text-main)] block text-sm">{{ $post->title }}</span>
                                <div class="flex items-center gap-2 mt-0.5">
                                    <span class="text-[var(--admin-text-muted)] text-[11px] font-mono">{{ $post->slug }}</span>
                                    <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[10px] font-semibold {{ $post->title_bn ? 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20' : 'bg-amber-500/10 text-amber-600 dark:text-amber-400 border border-amber-500/20' }}">
                                        <span>EN ✓</span>
                                        <span>|</span>
                                        <span>{{ $post->title_bn ? 'BN ✓' : 'BN ⚠' }}</span>
                                    </span>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-2.5 py-1 admin-subtle border text-[var(--admin-text-main)] rounded-lg font-bold text-[11px]">
                                    {{ $post->category->name ?? 'General' }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-[var(--admin-text-main)] font-semibold">
                                {{ $post->author->name ?? 'Emisha Tours & Travels' }}
                            </td>
                            <td class="py-4 px-6 text-[var(--admin-text-muted)]">
                                {{ $post->published_at ? $post->published_at->format('M d, Y') : 'Draft' }}
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $post->status === 'published' ? 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/30' : 'bg-amber-500/10 text-amber-600 dark:text-amber-400 border border-amber-500/30' }}">
                                    {{ $post->status }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right space-x-2 whitespace-nowrap">
                                <a href="{{ route('admin.blog.edit', $post->id) }}" class="px-3 py-1.5 rounded-lg admin-subtle hover:brightness-110 text-[var(--admin-text-main)] font-bold text-xs border transition inline-block">
                                    Edit
                                </a>
                                <form action="{{ route('admin.blog.destroy', $post->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this article?')">
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
                            <td colspan="6" class="py-12 text-center text-[var(--admin-text-muted)] text-xs">No blog articles published yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($posts->hasPages())
            <div class="p-4 border-t admin-table-divider admin-table-head">
                {{ $posts->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
