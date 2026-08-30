@extends('layouts.app')
@section('title', 'Page ' . $page . ' — Manual PDF Viewer')
@section('content_class', '')

@section('breadcrumb')
<x-breadcrumb :items="[
    ['label' => 'Manual', 'url' => route('manual.index')],
    ['label' => 'Page ' . $page]
]" />
@endsection

@section('content')
<div class="flex flex-col h-[calc(100vh-7rem)]">

    {{-- Toolbar --}}
    <div class="flex items-center justify-between px-4 py-2 bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 flex-shrink-0 no-print">
        <div class="flex items-center gap-3">
            <a href="{{ route('manual.page', max(1, $page - 1)) }}"
               data-nav="prev"
               class="btn-secondary btn-sm {{ $page <= 1 ? 'opacity-40 pointer-events-none' : '' }}"
               aria-label="Previous page">
                ← Prev
            </a>

            <form method="GET" action="" id="page-jump-form" class="flex items-center gap-2">
                <label class="text-sm text-slate-500">Page</label>
                <input type="number" name="pg" value="{{ $page }}" min="1" max="{{ $totalPages }}"
                       class="input w-16 text-center font-mono py-1 text-sm"
                       onchange="window.location='/manual/page/'+this.value">
                <span class="text-sm text-slate-500">/ {{ $totalPages }}</span>
            </form>

            <a href="{{ route('manual.page', min($totalPages, $page + 1)) }}"
               data-nav="next"
               class="btn-secondary btn-sm {{ $page >= $totalPages ? 'opacity-40 pointer-events-none' : '' }}"
               aria-label="Next page">
                Next →
            </a>
        </div>

        <div class="flex items-center gap-2">
            @if($currentSection)
            <span class="badge-blue hidden sm:inline-flex">Section {{ $currentSection->section_number }}</span>
            <span class="text-xs text-slate-500 hidden md:block truncate max-w-xs">{{ $currentSection->title }}</span>
            @endif
            <a href="{{ asset('cessna_172_1969-76_smv1975.pdf') }}" target="_blank"
               class="btn-secondary btn-sm">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                Open PDF
            </a>
        </div>
    </div>

    {{-- PDF Viewer --}}
    <div class="flex-1 relative bg-slate-700 dark:bg-slate-950">
        @php $pdfUrl = asset('cessna_172_1969-76_smv1975.pdf'); @endphp

        <div id="pdf-viewer" class="w-full h-full flex items-center justify-center">
            <div id="pdf-loading" class="text-center text-white py-16">
                <div class="animate-spin w-10 h-10 border-4 border-white/20 border-t-white rounded-full mx-auto mb-4"></div>
                <p class="text-sm">Loading page {{ $page }}...</p>
            </div>
            <canvas id="pdf-canvas" class="shadow-2xl" style="display:none; max-width:100%; max-height:100%;"></canvas>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// PDF.js viewer using CDN
(function() {
    const pdfUrl = "{{ asset('cessna_172_1969-76_smv1975.pdf') }}";
    const pageNum = {{ $page }};

    // Load PDF.js from CDN
    const script = document.createElement('script');
    script.src = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js';
    script.onload = function() {
        pdfjsLib.GlobalWorkerOptions.workerSrc =
            'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

        const loadingTask = pdfjsLib.getDocument(pdfUrl);
        loadingTask.promise.then(function(pdf) {
            return pdf.getPage(pageNum);
        }).then(function(page) {
            const canvas  = document.getElementById('pdf-canvas');
            const loading = document.getElementById('pdf-loading');
            const context = canvas.getContext('2d');

            const container   = document.getElementById('pdf-viewer');
            const viewport0   = page.getViewport({ scale: 1 });
            const scale       = Math.min(
                container.clientWidth  / viewport0.width,
                container.clientHeight / viewport0.height
            ) * 0.95;

            const viewport = page.getViewport({ scale });
            canvas.width   = viewport.width;
            canvas.height  = viewport.height;

            page.render({ canvasContext: context, viewport }).promise.then(function() {
                loading.style.display = 'none';
                canvas.style.display  = 'block';
            });
        }).catch(function(err) {
            document.getElementById('pdf-loading').innerHTML =
                '<div class="text-white text-center"><p class="text-lg mb-2">⚠️ PDF not available</p>' +
                '<p class="text-sm text-slate-400">Run <code class="bg-slate-700 px-2 py-1 rounded">php artisan storage:link</code> and ensure the PDF is in <code class="bg-slate-700 px-2 py-1 rounded">storage/app/public/manual/</code></p>' +
                '<a href="{{ route("manual.index") }}" class="mt-4 inline-block px-4 py-2 bg-blue-600 text-white rounded-lg text-sm">Back to Manual</a></div>';
        });
    };
    document.head.appendChild(script);
})();
</script>
@endpush
