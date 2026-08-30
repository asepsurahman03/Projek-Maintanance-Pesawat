@extends('layouts.admin')
@section('title', 'Manual Sections')

@section('content')

<!-- Header & Actions -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-200 dark:border-slate-800">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white tracking-tight flex items-center gap-3">
            <span>Manual Sections</span>
            <span class="px-2.5 py-0.5 rounded-full bg-blue-100 dark:bg-blue-500/10 border border-blue-200 dark:border-blue-500/30 text-blue-700 dark:text-blue-400 text-xs font-mono font-semibold">
                {{ $sections->total() }} Total
            </span>
        </h1>
        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Manage core chapters, subsections, and technical page ranges</p>
    </div>

    <div class="flex items-center gap-3">
        <a href="{{ route('admin.sections.create') }}"
           class="px-4 py-2.5 rounded-xl bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-500 hover:to-cyan-500 text-white text-xs font-semibold flex items-center gap-2 shadow-lg shadow-cyan-950/40 transition-all hover:scale-105 active:scale-95">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span>Add Section</span>
        </a>
    </div>
</div>

<!-- Table Card -->
<div class="rounded-3xl bg-white dark:bg-slate-950/80 border border-slate-200 dark:border-slate-800/90 overflow-hidden shadow-sm dark:shadow-2xl">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm border-collapse">
            <thead>
                <tr class="border-b border-slate-200 dark:border-slate-800 bg-slate-50/70 dark:bg-slate-950/90 text-[11px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                    <th class="px-6 py-4">Section #</th>
                    <th class="px-6 py-4">Title & Description</th>
                    <th class="px-6 py-4">Page Range</th>
                    <th class="px-6 py-4 text-center">Subsections</th>
                    <th class="px-6 py-4">System Slug</th>
                    <th class="px-6 py-4 text-center">Sort</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800/60 font-medium text-slate-700 dark:text-slate-300">
                @forelse($sections as $section)
                <tr class="hover:bg-slate-50 dark:hover:bg-slate-900/60 transition-colors group">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="w-9 h-9 rounded-xl bg-blue-50 dark:bg-gradient-to-br dark:from-blue-600/30 dark:to-cyan-600/20 border border-blue-200 dark:border-cyan-500/30 flex items-center justify-center font-mono font-bold text-blue-600 dark:text-cyan-400 text-xs shadow-sm">
                            §{{ $section->section_number }}
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-bold text-slate-900 dark:text-slate-100 group-hover:text-cyan-600 dark:group-hover:text-cyan-300 transition-colors text-sm">
                            {{ $section->title }}
                        </div>
                        @if($section->description)
                        <div class="text-xs text-slate-500 dark:text-slate-400 mt-0.5 line-clamp-1 max-w-md">
                            {{ $section->description }}
                        </div>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($section->page_start)
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 font-mono text-xs text-slate-700 dark:text-slate-300">
                            <span>p.{{ $section->page_start }}</span>
                            @if($section->page_end)
                            <span class="text-slate-400">–</span>
                            <span>{{ $section->page_end }}</span>
                            @endif
                        </span>
                        @else
                        <span class="text-slate-400 font-mono text-xs">—</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center whitespace-nowrap">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-blue-50 dark:bg-blue-950/60 border border-blue-200 dark:border-blue-800/40 text-blue-700 dark:text-blue-300 font-mono text-xs font-bold">
                            {{ $section->subsections_count ?? $section->subsections()->count() }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($section->system_slug)
                        <span class="px-2.5 py-1 rounded-lg bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-[11px] font-mono text-cyan-600 dark:text-cyan-400">
                            {{ $section->system_slug }}
                        </span>
                        @else
                        <span class="text-slate-400 text-xs">—</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center whitespace-nowrap font-mono text-xs text-slate-500">
                        {{ $section->sort_order }}
                    </td>
                    <td class="px-6 py-4 text-right whitespace-nowrap">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('manual.section', $section->section_number) }}" target="_blank"
                               class="p-2 rounded-xl bg-slate-100 dark:bg-slate-900 hover:bg-slate-200 dark:hover:bg-slate-800 text-slate-600 dark:text-slate-400 hover:text-cyan-600 dark:hover:text-cyan-400 border border-slate-200 dark:border-slate-800 transition-colors"
                                title="Live Section Reader">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                            <a href="{{ route('admin.sections.edit', $section) }}"
                               class="px-3 py-1.5 rounded-xl bg-blue-50 dark:bg-blue-600/20 hover:bg-blue-100 dark:hover:bg-blue-600/30 border border-blue-200 dark:border-blue-500/30 text-blue-700 dark:text-blue-300 hover:text-blue-900 dark:hover:text-white text-xs font-semibold transition-all">
                                Edit
                            </a>
                            <form method="POST" action="{{ route('admin.sections.destroy', $section) }}" class="inline"
                                  onsubmit="return confirm('Delete section §{{ $section->section_number }} — {{ addslashes($section->title) }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="p-2 rounded-xl bg-rose-50 dark:bg-rose-950/40 hover:bg-rose-100 dark:hover:bg-rose-900/60 border border-rose-200 dark:border-rose-800/40 text-rose-600 dark:text-rose-400 hover:text-rose-700 dark:hover:text-rose-300 transition-colors"
                                        title="Delete Section">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-16 text-center text-slate-500">
                        <div class="max-w-sm mx-auto space-y-2">
                            <p class="font-bold text-slate-800 dark:text-slate-200 text-sm">No sections found</p>
                            <p class="text-xs text-slate-500">Create a new section or seed the database with initial manual data.</p>
                            <a href="{{ route('admin.sections.create') }}" class="inline-block mt-3 px-4 py-2 rounded-xl bg-blue-600 text-white text-xs font-semibold">Add First Section</a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($sections->hasPages())
    <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-800/80 bg-slate-50/50 dark:bg-slate-950/40">
        {{ $sections->links() }}
    </div>
    @endif
</div>

@endsection
