@extends('layouts.admin')
@section('title', 'Aircraft Models')

@section('content')

<!-- Header & Actions -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-200 dark:border-slate-800">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white tracking-tight flex items-center gap-3">
            <span>Aircraft Models & Serial Ranges</span>
            <span class="px-2.5 py-0.5 rounded-full bg-sky-100 dark:bg-sky-500/10 border border-sky-200 dark:border-sky-500/30 text-sky-700 dark:text-sky-400 text-xs font-mono font-semibold">
                {{ $models->total() }} Total
            </span>
        </h1>
        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Cross-reference Skyhawk production years, Reims variants, and serial ranges</p>
    </div>

    <div class="flex items-center gap-3">
        <a href="{{ route('admin.models.create') }}"
           class="px-4 py-2.5 rounded-xl bg-gradient-to-r from-sky-600 to-blue-600 hover:from-sky-500 hover:to-blue-500 text-white text-xs font-semibold flex items-center gap-2 shadow-lg shadow-sky-950/40 transition-all hover:scale-105 active:scale-95">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span>Register Model</span>
        </a>
    </div>
</div>

<!-- Table Card -->
<div class="rounded-3xl bg-white dark:bg-slate-950/80 border border-slate-200 dark:border-slate-800/90 overflow-hidden shadow-sm dark:shadow-2xl">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm border-collapse">
            <thead>
                <tr class="border-b border-slate-200 dark:border-slate-800 bg-slate-50/70 dark:bg-slate-950/90 text-[11px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                    <th class="px-6 py-4">Model Code</th>
                    <th class="px-6 py-4">Popular Name</th>
                    <th class="px-6 py-4">Year</th>
                    <th class="px-6 py-4">Serial Number Range</th>
                    <th class="px-6 py-4">Engine</th>
                    <th class="px-6 py-4">Source Page</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800/60 font-medium text-slate-700 dark:text-slate-300">
                @forelse($models as $model)
                <tr class="hover:bg-slate-50 dark:hover:bg-slate-900/60 transition-colors group">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2.5 py-1 rounded-xl bg-sky-50 dark:bg-sky-950/60 border border-sky-200 dark:border-sky-500/30 text-sky-700 dark:text-sky-400 font-mono text-xs font-bold">
                            {{ $model->model }}
                        </span>
                    </td>
                    <td class="px-6 py-4 font-bold text-slate-900 dark:text-slate-100">
                        {{ $model->popular_name }}
                    </td>
                    <td class="px-6 py-4 font-mono font-bold text-slate-900 dark:text-white whitespace-nowrap">
                        {{ $model->year }}
                    </td>
                    <td class="px-6 py-4 font-mono text-xs text-slate-500 whitespace-nowrap">
                        {{ $model->serial_beginning ?? '—' }} {{ $model->serial_ending ? 'thru ' . $model->serial_ending : '& on' }}
                    </td>
                    <td class="px-6 py-4 text-xs font-mono text-slate-500">
                        {{ $model->engine ?? 'Lycoming O-320' }}
                    </td>
                    <td class="px-6 py-4 font-mono text-xs text-slate-500 whitespace-nowrap">
                        {{ $model->source_page ? 'p.' . $model->source_page : '—' }}
                    </td>
                    <td class="px-6 py-4 text-right whitespace-nowrap">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.models.edit', $model) }}"
                               class="px-3 py-1.5 rounded-xl bg-sky-50 dark:bg-sky-600/20 hover:bg-sky-100 dark:hover:bg-sky-600/30 border border-sky-200 dark:border-sky-500/30 text-sky-700 dark:text-sky-300 hover:text-sky-900 dark:hover:text-white text-xs font-semibold transition-all">
                                Edit
                            </a>
                            <form method="POST" action="{{ route('admin.models.destroy', $model) }}" class="inline"
                                  onsubmit="return confirm('Delete model {{ $model->model }} ({{ $model->year }})?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="p-2 rounded-xl bg-rose-50 dark:bg-rose-950/40 hover:bg-rose-100 dark:hover:bg-rose-900/60 border border-rose-200 dark:border-rose-800/40 text-rose-600 dark:text-rose-400 hover:text-rose-700 dark:hover:text-rose-300 transition-colors"
                                        title="Delete Model">
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
                            <p class="font-bold text-slate-800 dark:text-slate-200 text-sm">No models registered</p>
                            <a href="{{ route('admin.models.create') }}" class="inline-block mt-3 px-4 py-2 rounded-xl bg-sky-600 text-white text-xs font-semibold">Register First Model</a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($models->hasPages())
    <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-800/80 bg-slate-50/50 dark:bg-slate-950/40">
        {{ $models->links() }}
    </div>
    @endif
</div>

@endsection
