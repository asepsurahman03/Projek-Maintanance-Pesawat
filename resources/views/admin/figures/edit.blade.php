@extends('layouts.admin')
@section('title', 'Edit Figure ' . $figure->figure_number)

@section('content')
<div class="max-w-3xl">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.figures.index') }}" class="p-2 rounded-xl bg-slate-950 border border-slate-800 text-slate-400 hover:text-white transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <div>
            <h1 class="text-xl font-extrabold text-white tracking-tight">Edit Figure {{ $figure->figure_number }}</h1>
            <p class="text-xs text-slate-400 mt-0.5">{{ $figure->title }}</p>
        </div>
    </div>

    <div class="rounded-3xl bg-slate-950/80 border border-slate-800/90 p-6 sm:p-8 shadow-2xl">
        <form id="edit-form" method="POST" action="{{ route('admin.figures.update', $figure) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Section Reference</label>
                    <select name="section_id" required
                            class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent">
                        @foreach($sections as $s)
                        <option value="{{ $s->id }}" {{ $figure->section_id == $s->id ? 'selected' : '' }}>§{{ $s->section_number }} — {{ Str::limit($s->title, 25) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Figure Number</label>
                    <input type="text" name="figure_number" value="{{ old('figure_number', $figure->figure_number) }}" required
                           class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Figure Title</label>
                <input type="text" name="title" value="{{ old('title', $figure->title) }}" required
                       class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Source Page</label>
                    <input type="number" name="page" value="{{ old('page', $figure->page) }}"
                           class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Category</label>
                    <input type="text" name="category" value="{{ old('category', $figure->category) }}"
                       class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Caption & Notes</label>
                <textarea name="caption" rows="3"
                          class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent">{{ old('caption', $figure->caption) }}</textarea>
            </div>

            @if($figure->hasImage())
            <div class="p-4 rounded-2xl bg-slate-900/90 border border-slate-800 space-y-2">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Current Image Preview:</span>
                <img src="{{ $figure->image_url }}" alt="Preview" class="h-36 object-contain rounded-xl border border-slate-800 bg-slate-950 p-2">
            </div>
            @endif

            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Replace Image (Optional)</label>
                <input type="file" name="image" accept="image/*"
                       class="w-full px-4 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-sm text-slate-300 file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-amber-600/20 file:text-amber-400 hover:file:bg-amber-600/30 cursor-pointer">
            </div>
        </form>

        <div class="pt-6 mt-6 border-t border-slate-800/80 flex items-center justify-between">
            <form method="POST" action="{{ route('admin.figures.destroy', $figure) }}"
                  onsubmit="return confirm('Delete figure {{ $figure->figure_number }}?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 rounded-xl bg-rose-950/40 hover:bg-rose-900/60 border border-rose-800/40 text-rose-400 text-xs font-bold transition-colors">
                    Delete Figure
                </button>
            </form>

            <div class="flex items-center gap-3">
                <a href="{{ route('admin.figures.index') }}" class="px-5 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-slate-300 text-xs font-semibold transition-colors">
                    Cancel
                </a>
                <button type="submit" form="edit-form" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-amber-600 to-yellow-600 hover:from-amber-500 hover:to-yellow-500 text-white text-xs font-bold shadow-lg shadow-amber-950 transition-all hover:scale-105 active:scale-95">
                    Save Changes
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
