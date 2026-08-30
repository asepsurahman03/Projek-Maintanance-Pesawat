@extends('layouts.app')
@section('title', 'Inspection Checklist — ' . $activeInterval)

@section('breadcrumb')
<div class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400 font-medium">
    <a href="{{ route('dashboard') }}" class="hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors">Home</a>
    <span>/</span>
    <span class="text-slate-900 dark:text-white font-semibold">Inspection Schedule Checklist</span>
</div>
@endsection

@section('content')
<div class="max-w-5xl mx-auto py-8 px-4 sm:px-6 lg:px-8 space-y-8">

    {{-- Header --}}
    <div class="pb-6 border-b border-slate-200 dark:border-slate-800">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-rose-100 dark:bg-rose-950/80 border border-rose-200 dark:border-rose-500/30 text-rose-700 dark:text-rose-400 text-xs font-mono mb-2">
            <span>SCHEDULED MAINTENANCE • SECTION 02</span>
        </div>
        <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Inspection Checklist</h1>
        <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">
            Standard factory maintenance cards. 100-hour inspections include all 50-hour items. 200-hour inspections include 50h & 100h items.
        </p>
    </div>

    {{-- Interval Tabs --}}
    <div class="flex items-center gap-2.5 overflow-x-auto pb-2 custom-scrollbar">
        @foreach($intervals as $interval)
        @php
        $isActive = $interval === $activeInterval;
        @endphp
        <a href="{{ route('inspection', ['interval' => $interval]) }}"
           class="px-4 py-2 rounded-2xl text-xs font-bold whitespace-nowrap transition-all flex items-center gap-2
                  {{ $isActive ? 'bg-gradient-to-r from-rose-600 to-pink-600 text-white shadow-lg shadow-rose-950/30' : 'bg-white dark:bg-slate-950/80 text-slate-700 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white border border-slate-200 dark:border-slate-800 shadow-sm' }}">
            <span>{{ $interval }}</span>
            @if(isset($counts[$interval]))
            <span class="px-1.5 py-0.2 rounded-md font-mono text-[10px] {{ $isActive ? 'bg-black/30 text-rose-100' : 'bg-slate-100 dark:bg-slate-900 text-slate-500 dark:text-slate-400' }}">
                {{ $counts[$interval] }}
            </span>
            @endif
        </a>
        @endforeach
    </div>

    {{-- Checklist Container --}}
    <div x-data="inspectionList('cessna172_inspection_{{ Str::slug($activeInterval) }}')" class="space-y-4">

        {{-- Progress Bar & Reset --}}
        <div class="p-5 rounded-3xl bg-white dark:bg-slate-950/80 border border-slate-200 dark:border-slate-800/90 flex flex-col sm:flex-row sm:items-center justify-between gap-4 shadow-sm dark:shadow-xl">
            <div class="space-y-1">
                <div class="text-xs font-mono text-slate-600 dark:text-slate-400">
                    Completion Status: <strong class="text-cyan-600 dark:text-cyan-400 font-bold" x-text="checkedCount"></strong> of <strong>{{ $items->count() }}</strong> tasks checked
                </div>
                <div class="w-48 h-2 rounded-full bg-slate-100 dark:bg-slate-900 overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-cyan-500 to-emerald-400 transition-all duration-300"
                         :style="'width: ' + (({{ $items->count() }} > 0) ? (checkedCount / {{ $items->count() }} * 100) : 0) + '%'"></div>
                </div>
            </div>

            <button @click="reset()" class="px-3.5 py-1.5 rounded-xl bg-slate-50 dark:bg-slate-900 hover:bg-rose-50 dark:hover:bg-rose-950/40 border border-slate-200 dark:border-slate-800 hover:border-rose-300 dark:hover:border-rose-500/30 text-rose-600 dark:text-rose-400 text-xs font-bold transition-colors"
                    x-show="checkedCount > 0" style="display:none">
                Reset Checked Items
            </button>
        </div>

        {{-- Tasks List --}}
        @if($items->count())
        <div class="space-y-3">
            @foreach($items as $item)
            <div class="rounded-3xl bg-white dark:bg-slate-950/80 border border-slate-200 dark:border-slate-800/90 p-5 flex items-start gap-4 transition-all duration-200 hover:bg-slate-50 dark:hover:bg-slate-900/60 shadow-xs dark:shadow-md"
                 :class="isChecked({{ $item->id }}) ? 'opacity-50 bg-slate-50 dark:bg-slate-950/40 border-emerald-300 dark:border-emerald-900/40' : ''">

                <button @click="toggle({{ $item->id }})"
                        class="mt-1 flex-shrink-0 w-6 h-6 rounded-xl border-2 flex items-center justify-center transition-all"
                        :class="isChecked({{ $item->id }})
                            ? 'bg-emerald-500 border-emerald-500 text-white dark:text-slate-950'
                            : 'border-slate-300 dark:border-slate-700 hover:border-cyan-500 bg-white dark:bg-slate-900'">
                    <svg x-show="isChecked({{ $item->id }})" class="w-4 h-4 font-bold" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                    </svg>
                </button>

                <div class="flex-1 min-w-0 space-y-1">
                    <div class="flex items-start justify-between gap-3">
                        <h3 class="text-sm font-bold text-slate-900 dark:text-slate-100"
                            :class="isChecked({{ $item->id }}) ? 'line-through text-slate-400 dark:text-slate-500' : ''">
                            {{ $item->item }}
                        </h3>
                        @if($item->source_page)
                        <a href="{{ route('manual.page', $item->source_page) }}" target="_blank"
                           class="text-xs font-mono text-blue-600 dark:text-blue-400 hover:text-cyan-600 dark:hover:text-cyan-300 hover:underline flex-shrink-0">
                            p.{{ $item->source_page }}
                        </a>
                        @endif
                    </div>

                    @if($item->description)
                    <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">{{ $item->description }}</p>
                    @endif

                    @if($item->notes)
                    <div class="p-2.5 rounded-xl bg-amber-50 dark:bg-amber-950/30 border border-amber-200 dark:border-amber-500/20 text-xs text-amber-800 dark:text-amber-300/90 flex items-start gap-2 mt-2">
                        <svg class="w-3.5 h-3.5 text-amber-500 dark:text-amber-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        <span>{{ $item->notes }}</span>
                    </div>
                    @endif

                    @if($item->section)
                    <div class="pt-2 text-[11px] font-mono text-cyan-600 dark:text-cyan-400">
                        Section Ref: §{{ $item->section->section_number }} — {{ $item->section->title }}
                    </div>
                    @endif
                </div>

            </div>
            @endforeach
        </div>
        @else
        <div class="rounded-3xl bg-white dark:bg-slate-950/80 border border-slate-200 dark:border-slate-800 p-16 text-center text-slate-500">
            <p class="font-bold text-slate-700 dark:text-slate-300">No inspection items found for this interval</p>
        </div>
        @endif

    </div>

</div>
@endsection
