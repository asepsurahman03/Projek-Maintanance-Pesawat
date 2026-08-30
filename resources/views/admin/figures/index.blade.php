@extends('layouts.admin')
@section('title', 'Technical Figures')

@section('content')

<!-- Header & Actions -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-200 dark:border-slate-800">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white tracking-tight flex items-center gap-3">
            <span>Technical Figures & Schematics</span>
            <span class="px-2.5 py-0.5 rounded-full bg-amber-100 dark:bg-amber-500/10 border border-amber-200 dark:border-amber-500/30 text-amber-700 dark:text-amber-400 text-xs font-mono font-semibold">
                {{ $figures->total() }} Total
            </span>
        </h1>
        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Upload and catalog schematic diagrams, exploded part views, and wiring blueprints</p>
    </div>

    <div class="flex items-center gap-3">
        <a href="{{ route('admin.figures.create') }}"
           class="px-4 py-2.5 rounded-xl bg-gradient-to-r from-amber-600 to-orange-600 hover:from-amber-500 hover:to-orange-500 text-white text-xs font-semibold flex items-center gap-2 shadow-lg shadow-amber-950/40 transition-all hover:scale-105 active:scale-95">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span>Upload Figure</span>
        </a>
    </div>
</div>

<!-- Table Card -->
<div class="rounded-3xl bg-white dark:bg-slate-950/80 border border-slate-200 dark:border-slate-800/90 overflow-hidden shadow-sm dark:shadow-2xl">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm border-collapse">
            <thead>
                <tr class="border-b border-slate-200 dark:border-slate-800 bg-slate-50/70 dark:bg-slate-950/90 text-[11px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                    <th class="px-6 py-4">Figure #</th>
                    <th class="px-6 py-4">Title & Details</th>
                    <th class="px-6 py-4">Section Ref</th>
                    <th class="px-6 py-4">Page</th>
                    <th class="px-6 py-4">Category</th>
                    <th class="px-6 py-4 text-center">Preview</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800/60 font-medium text-slate-700 dark:text-slate-300">
                @forelse($figures as $figure)
                <tr class="hover:bg-slate-50 dark:hover:bg-slate-900/60 transition-colors group">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="px-3 py-1.5 rounded-xl bg-amber-50 dark:bg-gradient-to-br dark:from-amber-600/30 dark:to-orange-600/20 border border-amber-200 dark:border-amber-500/30 font-mono font-bold text-amber-700 dark:text-amber-400 text-xs inline-block">
                            Fig. {{ $figure->figure_number }}
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-bold text-slate-900 dark:text-slate-100 group-hover:text-amber-600 dark:group-hover:text-amber-300 transition-colors text-sm">
                            {{ $figure->title }}
                        </div>
                        @if($figure->caption)
                        <div class="text-xs text-slate-500 dark:text-slate-400 mt-0.5 line-clamp-1 max-w-md">
                            {{ $figure->caption }}
                        </div>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($figure->section)
                        <span class="text-xs font-mono text-blue-600 dark:text-blue-400">§{{ $figure->section->section_number }} {{ Str::limit($figure->section->title, 20) }}</span>
                        @else
                        <span class="text-slate-400 text-xs">—</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap font-mono text-xs text-slate-500">
                        {{ $figure->page ? 'p.' . $figure->page : '—' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($figure->category)
                        <span class="px-2.5 py-1 rounded-lg bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-[11px] font-mono text-amber-700 dark:text-amber-400">
                            {{ $figure->category }}
                        </span>
                        @else
                        <span class="text-slate-400 text-xs">—</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center whitespace-nowrap">
                        @if($figure->hasImage())
                        <div class="w-10 h-10 mx-auto rounded-lg overflow-hidden border border-slate-200 dark:border-slate-800 bg-slate-100 dark:bg-slate-900 p-0.5">
                            <img src="{{ $figure->image_url }}" alt="{{ $figure->title }}" class="w-full h-full object-contain">
                        </div>
                        @else
                        <span class="text-slate-400 text-xs">—</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right whitespace-nowrap">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.figures.edit', $figure) }}"
                               class="px-3 py-1.5 rounded-xl bg-amber-50 dark:bg-amber-600/20 hover:bg-amber-100 dark:hover:bg-amber-600/30 border border-amber-200 dark:border-amber-500/30 text-amber-700 dark:text-amber-300 hover:text-amber-900 dark:hover:text-white text-xs font-semibold transition-all">
                                Edit
                            </a>
                            <form method="POST" action="{{ route('admin.figures.destroy', $figure) }}" class="inline"
                                  onsubmit="return confirm('Delete Figure {{ $figure->figure_number }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="p-2 rounded-xl bg-rose-50 dark:bg-rose-950/40 hover:bg-rose-100 dark:hover:bg-rose-900/60 border border-rose-200 dark:border-rose-800/40 text-rose-600 dark:text-rose-400 hover:text-rose-700 dark:hover:text-rose-300 transition-colors"
                                        title="Delete Figure">
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
                            <p class="font-bold text-slate-800 dark:text-slate-200 text-sm">No figures found</p>
                            <a href="{{ route('admin.figures.create') }}" class="inline-block mt-3 px-4 py-2 rounded-xl bg-amber-600 text-white text-xs font-semibold">Upload First Figure</a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($figures->hasPages())
    <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-800/80 bg-slate-50/50 dark:bg-slate-950/40">
        {{ $figures->links() }}
    </div>
    @endif
</div>

@endsection
