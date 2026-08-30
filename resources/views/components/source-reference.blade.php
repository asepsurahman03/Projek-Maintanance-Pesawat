@props(['section' => null, 'page' => null, 'paragraph' => null])
{{-- Source Reference badge --}}
<div class="source-ref mt-4">
    <svg class="w-3.5 h-3.5 text-blue-500 dark:text-blue-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    <div>
        <div class="font-semibold text-blue-700 dark:text-blue-300 mb-0.5">SOURCE</div>
        <div class="text-blue-600 dark:text-blue-400">Cessna 172-Series Service Manual</div>
        @if($section)
        <div class="text-blue-500 dark:text-blue-500">Section {{ $section }}</div>
        @endif
        @if($paragraph)
        <div class="text-blue-500 dark:text-blue-500">¶ {{ $paragraph }}</div>
        @endif
        @if($page)
        <div class="flex items-center gap-2 mt-1">
            <span>Page {{ $page }}</span>
            <a href="{{ route('manual.page', $page) }}" class="underline hover:no-underline text-blue-700 dark:text-blue-300">View Original →</a>
        </div>
        @endif
    </div>
</div>
