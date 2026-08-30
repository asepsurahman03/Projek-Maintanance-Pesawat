<?php

namespace App\Http\Controllers;

use App\Models\Manual;
use App\Models\Section;
use App\Models\Subsection;
use Illuminate\Http\Request;

class ManualController extends Controller
{
    public function index()
    {
        $manual   = Manual::with('sections')->first();
        $sections = Section::orderBy('sort_order')->get();

        return view('manual.index', compact('manual', 'sections'));
    }

    public function section(Request $request, string $section)
    {
        $sectionModel = Section::where('section_number', $section)
            ->orWhere('system_slug', $section)
            ->orWhere('id', $section)
            ->with(['subsections', 'figures'])
            ->firstOrFail();

        $sections = Section::orderBy('sort_order')->get(); // for sidebar

        // Prev / next sections
        $prev = Section::where('sort_order', '<', $sectionModel->sort_order)
            ->orderBy('sort_order', 'desc')->first();
        $next = Section::where('sort_order', '>', $sectionModel->sort_order)
            ->orderBy('sort_order')->first();

        // Track last visited
        $request->session()->put('last_visited', [
            'title' => $sectionModel->title,
            'route' => route('manual.section', $sectionModel->section_number),
            'section' => $sectionModel->section_number,
        ]);

        // Build TOC from subsections
        $toc = $sectionModel->subsections->whereNotNull('paragraph_number');

        return view('manual.section', compact(
            'sectionModel', 'sections', 'prev', 'next', 'toc'
        ));
    }

    public function page(Request $request, int $page)
    {
        $manual   = Manual::first();
        $sections = Section::orderBy('sort_order')->get();

        // Find section containing this page
        $currentSection = Section::where('page_start', '<=', $page)
            ->where('page_end', '>=', $page)
            ->first();

        $totalPages = $manual?->total_pages ?? 414;

        return view('manual.page', compact(
            'page', 'manual', 'sections', 'currentSection', 'totalPages'
        ));
    }
}
