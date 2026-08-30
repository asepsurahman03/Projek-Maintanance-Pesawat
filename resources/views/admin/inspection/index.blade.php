@extends('layouts.admin')
@section('title', 'Inspection Tasks')

@section('content')

<!-- Header & Actions -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-200 dark:border-slate-800">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white tracking-tight flex items-center gap-3">
            <span>Scheduled Inspection Tasks</span>
            <span class="px-2.5 py-0.5 rounded-full bg-rose-100 dark:bg-rose-500/10 border border-rose-200 dark:border-rose-500/30 text-rose-700 dark:text-rose-400 text-xs font-mono font-semibold">
                {{ $items->total() }} Total
            </span>
        </h1>
        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Manage 50-hour, 100-hour, 200-hour, and annual routine maintenance items</p>
    </div>

    <div class="flex items-center gap-3">
        <a href="{{ route('admin.inspection.create') }}"
           class="px-4 py-2.5 rounded-xl bg-gradient-to-r from-rose-600 to-pink-600 hover:from-rose-500 hover:to-pink-500 text-white text-xs font-semibold flex items-center gap-2 shadow-lg shadow-rose-950/40 transition-all hover:scale-105 active:scale-95">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span>Add Inspection Task</span>
        </a>
    </div>
</div>

<!-- Filter Tabs -->
<div class="flex items-center gap-2 overflow-x-auto pb-2 custom-scrollbar">
    <a href="{{ route('admin.inspection.index') }}"
       class="px-4 py-2 rounded-2xl text-xs font-bold whitespace-nowrap transition-all
              {{ !request('interval') ? 'bg-gradient-to-r from-rose-600 to-pink-600 text-white shadow-md shadow-rose-950/30' : 'bg-white dark:bg-slate-950/80 text-slate-700 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white border border-slate-200 dark:border-slate-800 shadow-sm' }}">
        All Intervals
    </a>
    @foreach(['50-Hour', '100-Hour', '200-Hour', 'Special / Annual'] as $int)
    <a href="{{ route('admin.inspection.index', ['interval' => $int]) }}"
       class="px-4 py-2 rounded-2xl text-xs font-bold whitespace-nowrap transition-all
              {{ request('interval') === $int ? 'bg-gradient-to-r from-rose-600 to-pink-600 text-white shadow-md shadow-rose-950/30' : 'bg-white dark:bg-slate-950/80 text-slate-700 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white border border-slate-200 dark:border-slate-800 shadow-sm' }}">
        {{ $int }}
    </a>
    @endforeach
</div>

<!-- Table Card -->
<div class="rounded-3xl bg-white dark:bg-slate-950/80 border border-slate-200 dark:border-slate-800/90 overflow-hidden shadow-sm dark:shadow-2xl">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm border-collapse">
            <thead>
                <tr class="border-b border-slate-200 dark:border-slate-800 bg-slate-50/70 dark:bg-slate-950/90 text-[11px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                    <th class="px-6 py-4">Interval</th>
                    <th class="px-6 py-4">Task Description & Details</th>
                    <th class="px-6 py-4">Section Ref</th>
                    <th class="px-6 py-4">Page</th>
                    <th class="px-6 py-4 text-center">Sort</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800/60 font-medium text-slate-700 dark:text-slate-300">
                @forelse($items as $item)
                <tr class="hover:bg-slate-50 dark:hover:bg-slate-900/60 transition-colors group">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2.5 py-1 rounded-xl bg-rose-50 dark:bg-rose-950/60 border border-rose-200 dark:border-rose-500/30 text-rose-700 dark:text-rose-400 font-mono text-xs font-bold">
                            {{ $item->interval }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-bold text-slate-900 dark:text-slate-100 group-hover:text-rose-600 dark:group-hover:text-rose-300 transition-colors text-sm">
                            {{ $item->item }}
                        </div>
                        @if($item->description)
                        <div class="text-xs text-slate-500 dark:text-slate-400 mt-0.5 line-clamp-1 max-w-md">
                            {{ $item->description }}
                        </div>
                        @endif
                        @if($item->notes)
                        <div class="text-[11px] text-amber-700 dark:text-amber-400 mt-1 font-mono">
                            ⚠ Note: {{ $item->notes }}
                        </div>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($item->section)
                        <span class="text-xs font-mono text-blue-600 dark:text-blue-400">§{{ $item->section->section_number }} {{ Str::limit($item->section->title, 20) }}</span>
                        @else
                        <span class="text-slate-400 text-xs">—</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 font-mono text-xs text-slate-500 whitespace-nowrap">
                        {{ $item->source_page ? 'p.' . $item->source_page : '—' }}
                    </td>
                    <td class="px-6 py-4 text-center whitespace-nowrap font-mono text-xs text-slate-500">
                        {{ $item->sort_order }}
                    </td>
                    <td class="px-6 py-4 text-right whitespace-nowrap">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.inspection.edit', $item) }}"
                               class="px-3 py-1.5 rounded-xl bg-rose-50 dark:bg-rose-600/20 hover:bg-rose-100 dark:hover:bg-rose-600/30 border border-rose-200 dark:border-rose-500/30 text-rose-700 dark:text-rose-300 hover:text-rose-900 dark:hover:text-white text-xs font-semibold transition-all">
                                Edit
                            </a>
                            <form method="POST" action="{{ route('admin.inspection.destroy', $item) }}" class="inline"
                                  onsubmit="return confirm('Delete inspection item: {{ addslashes($item->item) }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="p-2 rounded-xl bg-rose-50 dark:bg-rose-950/40 hover:bg-rose-100 dark:hover:bg-rose-900/60 border border-rose-200 dark:border-rose-800/40 text-rose-600 dark:text-rose-400 hover:text-rose-700 dark:hover:text-rose-300 transition-colors"
                                        title="Delete Task">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-16 text-center text-slate-500">
                        <div class="max-w-sm mx-auto space-y-2">
                            <p class="font-bold text-slate-800 dark:text-slate-200 text-sm">No inspection items found</p>
                            <a href="{{ route('admin.inspection.create') }}" class="inline-block mt-3 px-4 py-2 rounded-xl bg-rose-600 text-white text-xs font-semibold">Add First Task</a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($items->hasPages())
    <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-800/80 bg-slate-50/50 dark:bg-slate-950/40">
        {{ $items->links() }}
    </div>
    @endif
</div>

@endsection
