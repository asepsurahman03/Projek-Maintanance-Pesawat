@extends('layouts.admin')
@section('title', 'Factory Specifications')

@section('content')

<!-- Header & Actions -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-200 dark:border-slate-800">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white tracking-tight flex items-center gap-3">
            <span>Factory Specifications</span>
            <span class="px-2.5 py-0.5 rounded-full bg-emerald-100 dark:bg-emerald-500/10 border border-emerald-200 dark:border-emerald-500/30 text-emerald-700 dark:text-emerald-400 text-xs font-mono font-semibold">
                {{ $specifications->total() }} Total
            </span>
        </h1>
        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Manage engine ratings, dimensions, fluid capacities, and torque limits</p>
    </div>

    <div class="flex items-center gap-3">
        <a href="{{ route('admin.specifications.create') }}"
           class="px-4 py-2.5 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 text-white text-xs font-semibold flex items-center gap-2 shadow-lg shadow-emerald-950/40 transition-all hover:scale-105 active:scale-95">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span>Add Specification</span>
        </a>
    </div>
</div>

<!-- Table Card -->
<div class="rounded-3xl bg-white dark:bg-slate-950/80 border border-slate-200 dark:border-slate-800/90 overflow-hidden shadow-sm dark:shadow-2xl">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm border-collapse">
            <thead>
                <tr class="border-b border-slate-200 dark:border-slate-800 bg-slate-50/70 dark:bg-slate-950/90 text-[11px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                    <th class="px-6 py-4">Specification Name</th>
                    <th class="px-6 py-4">Category</th>
                    <th class="px-6 py-4">Value / Limit</th>
                    <th class="px-6 py-4">Unit</th>
                    <th class="px-6 py-4">Model</th>
                    <th class="px-6 py-4">Year</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800/60 font-medium text-slate-700 dark:text-slate-300">
                @forelse($specifications as $spec)
                <tr class="hover:bg-slate-50 dark:hover:bg-slate-900/60 transition-colors group">
                    <td class="px-6 py-4 font-bold text-slate-900 dark:text-slate-100">
                        {{ $spec->name }}
                        @if($spec->notes)
                        <div class="text-[11px] text-slate-400 font-normal line-clamp-1 max-w-xs">{{ $spec->notes }}</div>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2.5 py-1 rounded-lg bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-[11px] font-mono text-emerald-700 dark:text-emerald-400 font-bold">
                            {{ $spec->category }}
                        </span>
                    </td>
                    <td class="px-6 py-4 font-mono font-bold text-cyan-600 dark:text-cyan-400 whitespace-nowrap">
                        {{ $spec->value }}
                    </td>
                    <td class="px-6 py-4 font-mono text-xs text-slate-500 whitespace-nowrap">
                        {{ $spec->unit ?? '—' }}
                    </td>
                    <td class="px-6 py-4 font-mono text-xs whitespace-nowrap">
                        @if($spec->model)
                        <span class="px-2 py-0.5 rounded bg-slate-100 dark:bg-slate-900 text-slate-700 dark:text-slate-300">{{ $spec->model }}</span>
                        @else<span class="text-slate-400">All</span>@endif
                    </td>
                    <td class="px-6 py-4 font-mono text-xs text-slate-500 whitespace-nowrap">
                        {{ $spec->year ?? '1969–1976' }}
                    </td>
                    <td class="px-6 py-4 text-right whitespace-nowrap">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.specifications.edit', $spec) }}"
                               class="px-3 py-1.5 rounded-xl bg-emerald-50 dark:bg-emerald-600/20 hover:bg-emerald-100 dark:hover:bg-emerald-600/30 border border-emerald-200 dark:border-emerald-500/30 text-emerald-700 dark:text-emerald-300 hover:text-emerald-900 dark:hover:text-white text-xs font-semibold transition-all">
                                Edit
                            </a>
                            <form method="POST" action="{{ route('admin.specifications.destroy', $spec) }}" class="inline"
                                  onsubmit="return confirm('Delete specification {{ addslashes($spec->name) }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="p-2 rounded-xl bg-rose-50 dark:bg-rose-950/40 hover:bg-rose-100 dark:hover:bg-rose-900/60 border border-rose-200 dark:border-rose-800/40 text-rose-600 dark:text-rose-400 hover:text-rose-700 dark:hover:text-rose-300 transition-colors"
                                        title="Delete Specification">
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
                            <p class="font-bold text-slate-800 dark:text-slate-200 text-sm">No specifications found</p>
                            <a href="{{ route('admin.specifications.create') }}" class="inline-block mt-3 px-4 py-2 rounded-xl bg-emerald-600 text-white text-xs font-semibold">Add First Specification</a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($specifications->hasPages())
    <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-800/80 bg-slate-50/50 dark:bg-slate-950/40">
        {{ $specifications->links() }}
    </div>
    @endif
</div>

@endsection
