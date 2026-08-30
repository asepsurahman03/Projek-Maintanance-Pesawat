@props(['links'])
{{-- Pagination component wrapping Laravel's paginator --}}
<div class="flex items-center justify-between py-4">
    <div class="text-sm text-slate-500 dark:text-slate-400">
        Showing {{ $links->firstItem() }}–{{ $links->lastItem() }} of {{ $links->total() }} results
    </div>
    <div class="flex items-center gap-1">
        @if($links->onFirstPage())
            <span class="btn-secondary btn-sm opacity-40 cursor-not-allowed">← Prev</span>
        @else
            <a href="{{ $links->previousPageUrl() }}" class="btn-secondary btn-sm">← Prev</a>
        @endif

        @foreach($links->getUrlRange(max(1, $links->currentPage()-2), min($links->lastPage(), $links->currentPage()+2)) as $page => $url)
            @if($page == $links->currentPage())
                <span class="btn-primary btn-sm">{{ $page }}</span>
            @else
                <a href="{{ $url }}" class="btn-secondary btn-sm">{{ $page }}</a>
            @endif
        @endforeach

        @if($links->hasMorePages())
            <a href="{{ $links->nextPageUrl() }}" class="btn-secondary btn-sm">Next →</a>
        @else
            <span class="btn-secondary btn-sm opacity-40 cursor-not-allowed">Next →</span>
        @endif
    </div>
</div>
