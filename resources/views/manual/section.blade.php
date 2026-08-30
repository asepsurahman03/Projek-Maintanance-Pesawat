@extends('layouts.app')
@section('title', 'Section ' . $sectionModel->section_number . ' — ' . $sectionModel->title)

@section('breadcrumb')
<div class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400 font-medium">
    <a href="{{ route('dashboard') }}" class="hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors">Home</a>
    <span>/</span>
    <a href="{{ route('manual.index') }}" class="hover:text-cyan-600 dark:hover:text-cyan-400 transition-colors">Manual</a>
    <span>/</span>
    <span class="text-slate-900 dark:text-white font-semibold">Section {{ $sectionModel->section_number }} — {{ $sectionModel->title }}</span>
</div>
@endsection

@section('content')
<div class="max-w-5xl mx-auto py-8 px-4 sm:px-6 lg:px-8 space-y-8">

    {{-- Section Header Banner --}}
    <div class="rounded-3xl bg-gradient-to-br from-white to-slate-50 dark:from-slate-950 dark:via-slate-900 dark:to-blue-950 text-slate-900 dark:text-white border border-slate-200 dark:border-slate-800 p-6 sm:p-8 shadow-sm dark:shadow-2xl" x-data="{ showPdf: false }">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-blue-600 to-cyan-600 flex items-center justify-center font-mono font-extrabold text-white text-base shadow-lg shadow-cyan-950 flex-shrink-0">
                    §{{ Str::padLeft($sectionModel->section_number, 2, '0') }}
                </div>
                <div class="space-y-1">
                    <div class="text-[11px] font-mono font-semibold text-cyan-600 dark:text-cyan-400 uppercase tracking-wider">Cessna 172 Service Manual • D1232-13</div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Section {{ $sectionModel->section_number }} — {{ $sectionModel->title }}</h1>
                    @if($sectionModel->description)
                    <p class="text-slate-600 dark:text-slate-300 text-sm max-w-2xl leading-relaxed pt-1">{{ $sectionModel->description }}</p>
                    @endif
                    @if($sectionModel->page_start)
                    <div class="flex items-center gap-2 pt-1">
                        <span class="px-2 py-0.5 rounded-lg bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-xs font-mono text-slate-600 dark:text-slate-400">
                            Pages {{ $sectionModel->page_start }}–{{ $sectionModel->page_end }}
                        </span>
                        <span class="text-xs text-slate-500 dark:text-slate-500">
                            ({{ ($sectionModel->page_end - $sectionModel->page_start + 1) }} pages)
                        </span>
                    </div>
                    @endif
                </div>
            </div>

            <div class="flex items-center gap-2 flex-shrink-0 flex-wrap">
                @if($sectionModel->page_start)
                {{-- PDF Viewer Toggle --}}
                <button @click="showPdf = !showPdf"
                        class="px-4 py-2.5 rounded-xl transition-all shadow-sm text-xs font-bold flex items-center gap-2"
                        :class="showPdf ? 'bg-amber-100 dark:bg-amber-950/60 border border-amber-300 dark:border-amber-500/40 text-amber-800 dark:text-amber-300' : 'bg-slate-100 dark:bg-slate-900 hover:bg-slate-200 dark:hover:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-200'">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                    <span x-text="showPdf ? 'Hide PDF Viewer' : 'View Original PDF'"></span>
                </button>
                @endif
            </div>
        </div>

        {{-- Inline PDF Viewer --}}
        @if($sectionModel->page_start)
        <div x-show="showPdf"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="mt-6 rounded-2xl overflow-hidden border border-slate-200 dark:border-slate-700 shadow-xl"
             style="display:none;">
            <div class="flex items-center justify-between px-4 py-2.5 bg-slate-100 dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 text-xs font-mono">
                <span class="text-slate-600 dark:text-slate-400 font-bold">
                    📄 Original PDF — Section {{ $sectionModel->section_number }} (p.{{ $sectionModel->page_start }})
                </span>
                <a href="/cessna_172_1969-76_smv1975.pdf#page={{ $sectionModel->page_start }}" target="_blank"
                   class="flex items-center gap-1.5 text-cyan-600 dark:text-cyan-400 hover:text-cyan-700 dark:hover:text-cyan-300 transition-colors font-semibold">
                    Open Full PDF ↗
                </a>
            </div>
            <iframe
                src="/cessna_172_1969-76_smv1975.pdf#page={{ $sectionModel->page_start }}&toolbar=1&navpanes=0&scrollbar=1"
                class="w-full"
                style="height: 680px;"
                title="Section {{ $sectionModel->section_number }} — {{ $sectionModel->title }} — Original PDF">
                <p class="p-4 text-xs text-slate-500">Your browser does not support PDF viewing inline. <a href="/cessna_172_1969-76_smv1975.pdf#page={{ $sectionModel->page_start }}" class="text-cyan-600 underline">Open PDF directly →</a></p>
            </iframe>
        </div>
        @endif
    </div>

    {{-- Subsections / Procedures --}}
    @if($sectionModel->subsections->count())
    <div class="space-y-6">
        @foreach($sectionModel->subsections as $sub)
        <div id="{{ $sub->paragraph_number ? 'para-' . Str::slug($sub->paragraph_number) : 'sub-' . $sub->id }}"
             class="scroll-mt-20 rounded-3xl bg-white dark:bg-slate-950/80 border border-slate-200 dark:border-slate-800/90 p-6 sm:p-8 shadow-sm dark:shadow-xl space-y-4"
             x-data="paragraphTranslator(@js($sub->content), @js($sub->title))">

            <div class="flex items-start justify-between gap-4 pb-4 border-b border-slate-100 dark:border-slate-800/80">
                <div class="space-y-1">
                    @if($sub->paragraph_number)
                    <div class="font-mono text-xs font-bold text-cyan-600 dark:text-cyan-400">¶ {{ $sub->paragraph_number }}</div>
                    @endif
                    @if($sub->title)
                    <h2 class="text-lg font-bold text-slate-900 dark:text-white tracking-tight" x-text="showTranslated && translatedTitle ? translatedTitle : '{{ $sub->title }}'">
                        {{ $sub->title }}
                    </h2>
                    @endif
                </div>

                {{-- Translate button --}}
                @if($sub->content)
                <button @click="toggle()"
                        class="px-3 py-1.5 rounded-xl border text-xs font-semibold flex items-center gap-2 transition-all flex-shrink-0"
                        :class="showTranslated ? 'bg-cyan-50 dark:bg-cyan-950/60 text-cyan-700 dark:text-cyan-300 border-cyan-300 dark:border-cyan-500/40 shadow-sm' : 'bg-slate-50 dark:bg-slate-900 hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white border-slate-200 dark:border-slate-800'"
                        title="Terjemahkan paragraf ini ke Bahasa Indonesia">
                    <span x-show="!loading" class="text-sm">🌐</span>
                    <span x-show="loading" class="animate-spin w-3 h-3 border-2 border-cyan-500 border-t-transparent rounded-full" style="display:none"></span>
                    <span x-text="showTranslated ? 'Lihat Asli (EN)' : 'Terjemahkan (ID)'"></span>
                </button>
                @endif
            </div>

            {{-- Original Content --}}
            @if($sub->content)
            <div x-show="!showTranslated" class="text-sm leading-relaxed text-slate-700 dark:text-slate-300 font-normal space-y-2">
                {!! nl2br(e($sub->content)) !!}
            </div>

            {{-- Translated Content --}}
            <div x-show="showTranslated" class="p-5 bg-gradient-to-r from-blue-50 to-cyan-50 dark:from-blue-950/40 dark:to-cyan-950/30 border border-blue-200 dark:border-cyan-500/30 rounded-2xl space-y-2" style="display:none">
                <div class="flex items-center gap-2 pb-2 border-b border-blue-200/60 dark:border-cyan-800/40">
                    <span class="text-xs font-bold text-blue-900 dark:text-cyan-300 flex items-center gap-1.5">
                        <span>🇮🇩</span> Terjemahan Bahasa Indonesia
                    </span>
                    <span class="text-[10px] text-blue-600 dark:text-cyan-400/70 font-mono ml-auto">Multi-Provider AI / Cache</span>
                </div>
                <div class="text-sm leading-relaxed text-slate-800 dark:text-slate-200" x-html="translatedHtml"></div>
            </div>
            @endif

            @if($sub->page)
            <div class="pt-3 border-t border-slate-100 dark:border-slate-800/60 flex items-center justify-between text-xs font-mono text-slate-500">
                <span>Ref: Section {{ $sectionModel->section_number }} • Para {{ $sub->paragraph_number }}</span>
                <span class="text-cyan-600 dark:text-cyan-400">Manual Page {{ $sub->page }}</span>
            </div>
            @endif
        </div>
        @endforeach
    </div>
    @else
    <div class="rounded-3xl bg-white dark:bg-slate-950/80 border border-slate-200 dark:border-slate-800/90 p-12 text-center text-slate-500">
        <p class="font-bold text-slate-900 dark:text-white text-base">Procedural Text Content</p>
        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">This section is available in full original scanned format.</p>
        <a href="{{ route('manual.page', $sectionModel->page_start ?? 1) }}"
           class="mt-4 inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-blue-600 to-cyan-600 text-white text-xs font-bold shadow-lg shadow-cyan-950/40">
            Open Original PDF (Page {{ $sectionModel->page_start ?? 1 }}) →
        </a>
    </div>
    @endif

    {{-- Figures in this section --}}
    @if($sectionModel->figures->count())
    <div class="space-y-4 pt-6">
        <h2 class="text-lg font-bold text-slate-900 dark:text-white tracking-tight flex items-center gap-2">
            <span class="w-2.5 h-2.5 rounded-full bg-amber-400"></span>
            Associated Technical Figures ({{ $sectionModel->figures->count() }})
        </h2>
        <div class="grid sm:grid-cols-2 gap-4">
            @foreach($sectionModel->figures as $figure)
            <div class="rounded-3xl bg-white dark:bg-slate-950/80 border border-slate-200 dark:border-slate-800 p-5 shadow-sm dark:shadow-xl space-y-3">
                <div class="flex items-center justify-between">
                    <span class="px-2.5 py-1 rounded-lg bg-amber-50 dark:bg-amber-950/40 border border-amber-200 dark:border-amber-500/30 text-amber-700 dark:text-amber-400 text-xs font-mono font-bold">
                        Fig. {{ $figure->figure_number }}
                    </span>
                    @if($figure->page)
                    <span class="text-xs font-mono text-slate-500">p.{{ $figure->page }}</span>
                    @endif
                </div>
                <div class="font-bold text-sm text-slate-900 dark:text-white">{{ $figure->title }}</div>
                @if($figure->hasImage())
                <div class="rounded-xl overflow-hidden bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-2">
                    <img src="{{ $figure->image_url }}" alt="{{ $figure->title }}" class="w-full h-44 object-contain">
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Prev / Next Navigation --}}
    <div class="pt-6 border-t border-slate-200 dark:border-slate-800 flex items-center justify-between gap-4">
        @if($prev)
        <a href="{{ route('manual.section', $prev->section_number) }}"
           class="flex items-center gap-3 px-5 py-3 rounded-2xl bg-white dark:bg-slate-950 hover:bg-slate-50 dark:hover:bg-slate-900 border border-slate-200 dark:border-slate-800 hover:border-cyan-500/40 text-slate-700 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white transition-all shadow-sm">
            <svg class="w-4 h-4 text-cyan-600 dark:text-cyan-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            <div class="min-w-0 text-left">
                <div class="text-[10px] uppercase font-bold text-slate-400 dark:text-slate-500">Previous Section</div>
                <div class="text-xs font-bold text-slate-800 dark:text-slate-200 truncate">§{{ $prev->section_number }} — {{ $prev->title }}</div>
            </div>
        </a>
        @else
        <div></div>
        @endif

        @if($next)
        <a href="{{ route('manual.section', $next->section_number) }}"
           class="flex items-center gap-3 px-5 py-3 rounded-2xl bg-white dark:bg-slate-950 hover:bg-slate-50 dark:hover:bg-slate-900 border border-slate-200 dark:border-slate-800 hover:border-cyan-500/40 text-slate-700 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white transition-all shadow-sm ml-auto">
            <div class="min-w-0 text-right">
                <div class="text-[10px] uppercase font-bold text-slate-400 dark:text-slate-500">Next Section</div>
                <div class="text-xs font-bold text-slate-800 dark:text-slate-200 truncate">§{{ $next->section_number }} — {{ $next->title }}</div>
            </div>
            <svg class="w-4 h-4 text-cyan-600 dark:text-cyan-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>
        @endif
    </div>

</div>
@endsection
