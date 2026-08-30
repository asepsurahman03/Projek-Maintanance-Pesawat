<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\Subsection;
use App\Models\Figure;
use App\Models\Specification;
use App\Models\AircraftModel;
use App\Models\InspectionItem;
use App\Models\Manual;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'sections'      => Section::count(),
            'paragraphs'    => Subsection::count(),
            'figures'       => Figure::count(),
            'specifications'=> Specification::count(),
            'models'        => AircraftModel::count(),
            'inspection'    => InspectionItem::count(),
        ];

        $manual    = Manual::first();
        $recentSections = Section::orderBy('updated_at', 'desc')->limit(5)->get();

        return view('admin.dashboard', compact('stats', 'manual', 'recentSections'));
    }
}
