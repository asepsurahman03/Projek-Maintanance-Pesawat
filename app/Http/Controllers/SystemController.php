<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    // Map of system slug → section numbers/description
    private array $systemMap = [
        'engine'         => ['11', '11A'],
        'fuel-system'    => ['12'],
        'electrical'     => ['16'],
        'flight-controls'=> ['06', '07', '08', '09', '10'],
        'landing-gear'   => ['05'],
        'instruments'    => ['15'],
        'utility'        => ['14'],
        'propeller'      => ['13'],
        'structural'     => ['18'],
        'wiring'         => ['20'],
    ];

    private array $systemInfo = [
        'engine'         => ['label' => 'Engine',           'icon' => '⚙️', 'color' => 'blue'],
        'fuel-system'    => ['label' => 'Fuel System',      'icon' => '⛽', 'color' => 'amber'],
        'electrical'     => ['label' => 'Electrical Systems','icon' => '⚡', 'color' => 'yellow'],
        'flight-controls'=> ['label' => 'Flight Controls',  'icon' => '✈️', 'color' => 'sky'],
        'landing-gear'   => ['label' => 'Landing Gear',     'icon' => '🛬', 'color' => 'slate'],
        'instruments'    => ['label' => 'Instruments',      'icon' => '🎛️', 'color' => 'green'],
        'utility'        => ['label' => 'Utility Systems',  'icon' => '🔧', 'color' => 'orange'],
        'propeller'      => ['label' => 'Propeller',        'icon' => '🔄', 'color' => 'teal'],
        'structural'     => ['label' => 'Structural Repair','icon' => '🏗️', 'color' => 'red'],
        'wiring'         => ['label' => 'Wiring Diagrams',  'icon' => '🔌', 'color' => 'purple'],
    ];

    public function index()
    {
        $systems = collect($this->systemInfo)->map(function ($info, $slug) {
            $sectionNums = $this->systemMap[$slug] ?? [];
            $sections = Section::whereIn('section_number', $sectionNums)->get();
            return array_merge($info, [
                'slug'     => $slug,
                'sections' => $sections,
                'url'      => route('systems.show', $slug),
            ]);
        });

        return view('systems.index', compact('systems'));
    }

    public function show(string $system)
    {
        if (!array_key_exists($system, $this->systemMap)) {
            abort(404, "System not found: {$system}");
        }

        $sectionNums = $this->systemMap[$system];
        $info        = $this->systemInfo[$system];

        $sections = Section::whereIn('section_number', $sectionNums)
            ->with(['subsections', 'figures', 'inspectionItems'])
            ->orderBy('sort_order')
            ->get();

        $allSystems = $this->systemInfo;

        return view('systems.show', compact('system', 'sections', 'info', 'allSystems'));
    }
}
