<?php

namespace App\Http\Controllers;

use App\Models\Figure;

class WiringController extends Controller
{
    public function index()
    {
        $diagrams = Figure::with('section')
            ->where('category', 'wiring')
            ->orderBy('figure_number')
            ->get();

        $section = \App\Models\Section::where('section_number', '20')->first();

        return view('wiring.index', compact('diagrams', 'section'));
    }
}
