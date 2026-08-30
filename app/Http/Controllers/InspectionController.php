<?php

namespace App\Http\Controllers;

use App\Models\InspectionItem;
use Illuminate\Http\Request;

class InspectionController extends Controller
{
    public function index(Request $request)
    {
        $activeInterval = $request->get('interval', '50 hours');
        $intervals = InspectionItem::intervals();

        $items = InspectionItem::with('section')
            ->where('interval', $activeInterval)
            ->orderBy('sort_order')
            ->get();

        $counts = [];
        foreach ($intervals as $interval) {
            $counts[$interval] = InspectionItem::where('interval', $interval)->count();
        }

        return view('inspection.index', compact('items', 'intervals', 'activeInterval', 'counts'));
    }
}
