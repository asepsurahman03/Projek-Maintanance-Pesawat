<?php

namespace App\Http\Controllers;

use App\Models\Manual;
use App\Models\Section;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $manual   = Manual::first();
        $sections = Section::with('manual')->orderBy('sort_order')->get();
        $totalSections = $sections->count();

        // Last visited — stored in session
        $lastVisited = $request->session()->get('last_visited');

        $quickAccess = [
            ['label' => 'Engine',         'slug' => 'engine',         'icon' => '⚙️', 'color' => 'blue'],
            ['label' => 'Fuel System',    'slug' => 'fuel-system',    'icon' => '⛽', 'color' => 'amber'],
            ['label' => 'Electrical',     'slug' => 'electrical',     'icon' => '⚡', 'color' => 'yellow'],
            ['label' => 'Flight Controls','slug' => 'flight-controls','icon' => '✈️', 'color' => 'sky'],
            ['label' => 'Inspection',     'slug' => null, 'url' => '/inspection', 'icon' => '✅', 'color' => 'green'],
            ['label' => 'Wiring',         'slug' => null, 'url' => route('wiring'),     'icon' => '🔌', 'color' => 'purple'],
            ['label' => 'Torque Values',  'slug' => null, 'url' => route('torque'),     'icon' => '🔧', 'color' => 'orange'],
        ];

        return view('dashboard.index', compact(
            'manual', 'sections', 'totalSections', 'lastVisited', 'quickAccess'
        ));
    }
}
