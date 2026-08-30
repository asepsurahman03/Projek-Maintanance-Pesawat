<?php

namespace App\Http\Controllers;

use App\Models\Specification;
use Illuminate\Http\Request;

class SpecificationController extends Controller
{
    public function index(Request $request)
    {
        $model = $request->get('model');
        $year  = $request->get('year');

        $query = Specification::with('section')->orderBy('category')->orderBy('sort_order');

        if ($model) $query->where('model', $model);
        if ($year)  $query->where('year', $year);

        $allSpecs = $query->get();
        $grouped  = $allSpecs->groupBy('category');

        $models = Specification::select('model')->distinct()->whereNotNull('model')->pluck('model');
        $years  = Specification::select('year')->distinct()->whereNotNull('year')->pluck('year');

        $categories = [
            'Aircraft'      => ['icon' => '✈️', 'color' => 'blue'],
            'Engine'        => ['icon' => '⚙️', 'color' => 'slate'],
            'Fuel'          => ['icon' => '⛽', 'color' => 'amber'],
            'Oil'           => ['icon' => '🛢️', 'color' => 'orange'],
            'Propeller'     => ['icon' => '🔄', 'color' => 'green'],
            'Landing Gear'  => ['icon' => '🛬', 'color' => 'sky'],
            'Flight Controls'=>['icon' => '🎮', 'color' => 'purple'],
            'Tires'         => ['icon' => '⭕', 'color' => 'red'],
        ];

        return view('specifications.index', compact(
            'grouped', 'categories', 'models', 'years', 'model', 'year'
        ));
    }
}
