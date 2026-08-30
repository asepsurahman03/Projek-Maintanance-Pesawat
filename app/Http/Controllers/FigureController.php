<?php

namespace App\Http\Controllers;

use App\Models\Figure;
use App\Models\Section;
use Illuminate\Http\Request;

class FigureController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->get('category');
        $section  = $request->get('section');

        $query = Figure::with('section')->orderBy('figure_number');

        if ($category) $query->where('category', $category);
        if ($section)  $query->where('section_id', $section);

        $figures    = $query->paginate(24);
        $categories = Figure::select('category')->distinct()->whereNotNull('category')->pluck('category');
        $sections   = Section::orderBy('sort_order')->get(['id', 'section_number', 'title']);

        return view('figures.index', compact('figures', 'categories', 'sections', 'category', 'section'));
    }

    public function show(Figure $figure)
    {
        $figure->load('section');
        $section = $figure->section;

        // Adjacent figures in same section
        $prev = Figure::where('section_id', $figure->section_id)
            ->where('id', '<', $figure->id)->orderBy('id', 'desc')->first();
        $next = Figure::where('section_id', $figure->section_id)
            ->where('id', '>', $figure->id)->orderBy('id')->first();

        return view('figures.show', compact('figure', 'section', 'prev', 'next'));
    }
}
