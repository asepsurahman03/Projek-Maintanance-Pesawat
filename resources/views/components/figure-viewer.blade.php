@props(['figure', 'showCaption' => true])
{{-- Figure viewer component with zoom + fullscreen --}}
<div x-data="figureViewer('{{ $figure->image_url ?? '' }}')" class="relative">

    {{-- Toolbar --}}
    <div class="flex items-center justify-between p-3 bg-slate-100 dark:bg-slate-800 rounded-t-xl border border-slate-200 dark:border-slate-700">
        <div class="flex items-center gap-2">
            <span class="badge-blue">Figure {{ $figure->figure_number }}</span>
            <span class="text-sm font-medium text-slate-700 dark:text-slate-300">{{ $figure->title }}</span>
        </div>
        <div class="flex items-center gap-1">
            <button @click="zoomOut()" class="btn-ghost btn-xs p-1.5" title="Zoom out" :disabled="scale <= 0.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM13 10H7"/></svg>
            </button>
            <span class="text-xs font-mono text-slate-500 w-10 text-center" x-text="Math.round(scale * 100) + '%'"></span>
            <button @click="zoomIn()" class="btn-ghost btn-xs p-1.5" title="Zoom in" :disabled="scale >= 4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
            </button>
            <button @click="reset()" class="btn-ghost btn-xs p-1.5" title="Reset">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
            </button>
            <button @click="toggleFullscreen()" class="btn-ghost btn-xs p-1.5" title="Fullscreen">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/></svg>
            </button>
        </div>
    </div>

    {{-- Image area --}}
    <div class="overflow-hidden bg-white dark:bg-slate-900 border border-t-0 border-slate-200 dark:border-slate-700 rounded-b-xl"
         :class="fullscreen ? 'fixed inset-0 z-50 rounded-none flex items-center justify-center bg-black' : 'relative max-h-[500px]'"
         style="cursor: zoom-in;">

        @if($figure->hasImage())
        <img src="{{ $figure->image_url }}"
             alt="{{ $figure->title }}"
             :style="`transform: scale(${scale}) translate(${translateX}px, ${translateY}px); transform-origin: center; transition: transform 0.2s ease;`"
             class="max-w-full max-h-full object-contain select-none"
             draggable="false">
        @else
        <div class="flex flex-col items-center justify-center py-16 px-8 text-center">
            <div class="w-16 h-16 bg-slate-100 dark:bg-slate-800 rounded-xl flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            <p class="text-sm font-medium text-slate-600 dark:text-slate-400">Figure {{ $figure->figure_number }}</p>
            <p class="text-xs text-slate-400 dark:text-slate-600 mt-1">Image not yet uploaded</p>
            @if($figure->page)
            <a href="{{ route('manual.page', $figure->page) }}" class="btn-secondary btn-sm mt-4">
                View in PDF — Page {{ $figure->page }}
            </a>
            @endif
        </div>
        @endif

        {{-- Fullscreen close button --}}
        <button x-show="fullscreen" @click="toggleFullscreen()"
                class="absolute top-4 right-4 p-2 bg-white/10 hover:bg-white/20 rounded-lg text-white transition-colors"
                style="display:none">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>

    {{-- Caption and source --}}
    @if($showCaption && ($figure->caption || $figure->page))
    <div class="mt-3 space-y-2">
        @if($figure->caption)
        <p class="text-sm text-slate-600 dark:text-slate-400 italic">{{ $figure->caption }}</p>
        @endif
        @if($figure->page)
        <x-source-reference :section="$figure->section?->section_number" :page="$figure->page" />
        @endif
    </div>
    @endif
</div>
