<?php

namespace Database\Seeders;

use App\Models\Figure;
use App\Models\Section;
use Illuminate\Database\Seeder;

class FigureSeeder extends Seeder
{
    public function run(): void
    {
        $sections = Section::all()->keyBy('section_number');

        $figures = [
            // Section 1
            ['sec' => '01', 'fig' => '1-1', 'title' => 'Cessna 172 Three-View Principal Dimensions', 'page' => 3, 'category' => 'general', 'caption' => 'General dimensions and three-view projection of Cessna Model 172 and Skyhawk.'],
            ['sec' => '01', 'fig' => '1-2', 'title' => 'Aircraft Station Reference Diagram', 'page' => 6, 'category' => 'structural', 'caption' => 'Fuselage and wing station diagram for weight and balance calculation reference.'],
            ['sec' => '01', 'fig' => '1-4', 'title' => 'Standard Torque Chart — Non-structural & Structural Fasteners', 'page' => 8, 'category' => 'general', 'caption' => 'Installation torque limits for AN and standard aircraft threaded fasteners.'],

            // Section 2
            ['sec' => '02', 'fig' => '2-1', 'title' => 'Lubrication Diagram & Servicing Points', 'page' => 27, 'category' => 'general', 'caption' => 'Lubrication chart showing servicing intervals, lubricant specifications, and fitting locations.'],

            // Section 5
            ['sec' => '05', 'fig' => '5-1', 'title' => 'Main Landing Gear Installation & Attachment', 'page' => 102, 'category' => 'landing gear', 'caption' => 'Main gear spring steel / tubular strut attachment forgings and wheel alignment shims.'],
            ['sec' => '05', 'fig' => '5-4', 'title' => 'Nose Gear Oleo Strut Assembly & Shimmy Damper', 'page' => 108, 'category' => 'landing gear', 'caption' => 'Detailed cross-section of nose gear oleo strut, lower trunnion, and fluid service points.'],
            ['sec' => '05', 'fig' => '5-7', 'title' => 'Goodyear Single-Disc Hydraulic Brake Assembly', 'page' => 114, 'category' => 'landing gear', 'caption' => 'Brake caliper assembly, lining replacement, brake disc, and hydraulic piston seals.'],

            // Section 6
            ['sec' => '06', 'fig' => '6-1', 'title' => 'Aileron Control System Cable Routing and Rigging', 'page' => 133, 'category' => 'flight controls', 'caption' => 'Control wheel chains, sprockets, cable routing through wing pulleys, and bellcrank rigging.'],

            // Section 11
            ['sec' => '11', 'fig' => '11-1', 'title' => 'Lycoming O-320-E2D Engine Installation & Mounts', 'page' => 203, 'category' => 'engine', 'caption' => 'Engine mount isolation dynafocal bushings, firewall fittings, and engine baffling.'],
            ['sec' => '11', 'fig' => '11-3', 'title' => 'Magneto Timing and Ignition Harness Routing', 'page' => 214, 'category' => 'engine', 'caption' => 'Dual magneto installation, internal timing marks, and spark plug harness leads.'],

            // Section 12
            ['sec' => '12', 'fig' => '12-1', 'title' => 'Gravity-Feed Fuel System Schematic Diagram', 'page' => 288, 'category' => 'fuel', 'caption' => 'Complete fuel flow schematic from wing tanks through selector valve, strainer, and carburetor.'],

            // Section 13
            ['sec' => '13', 'fig' => '13-1', 'title' => 'McCauley Fixed-Pitch Propeller & Spinner Installation', 'page' => 308, 'category' => 'propeller', 'caption' => 'Propeller bolt torque sequence, spinner bulkhead, and tracking measurement procedure.'],

            // Section 16
            ['sec' => '16', 'fig' => '16-1', 'title' => '14-Volt DC Power Distribution & Circuit Breaker Panel', 'page' => 358, 'category' => 'electrical', 'caption' => 'Alternator master, battery contactor, split bus bar arrangement, and circuit protection.'],

            // Section 20 - Wiring Diagrams
            ['sec' => '20', 'fig' => '20-1', 'title' => 'Main Power Distribution & Alternator Charging Circuit', 'page' => 407, 'category' => 'wiring', 'caption' => 'Electrical power generation, voltage regulator, split bus distribution, and ground returns.'],
            ['sec' => '20', 'fig' => '20-2', 'title' => 'External and Internal Lighting Circuits Schematic', 'page' => 409, 'category' => 'wiring', 'caption' => 'Landing light, taxi light, navigation lights, strobe/beacon, and instrument floodlight circuits.'],
            ['sec' => '20', 'fig' => '20-3', 'title' => 'Engine Gauges and Stall Warning Horn Circuit', 'page' => 411, 'category' => 'wiring', 'caption' => 'Oil pressure/temp sensors, cylinder head temp, fuel quantity transmitters, and stall warning system.'],
            ['sec' => '20', 'fig' => '20-4', 'title' => 'Ignition Switch and Starter Contactor Circuit', 'page' => 413, 'category' => 'wiring', 'caption' => 'Keyed ignition switch, magneto P-lead grounding circuits, starter solenoid, and starter interlock.'],
        ];

        foreach ($figures as $f) {
            $section = $sections[$f['sec']] ?? null;
            if (!$section) continue;

            Figure::firstOrCreate(
                [
                    'section_id' => $section->id,
                    'figure_number' => $f['fig'],
                ],
                [
                    'title' => $f['title'],
                    'page' => $f['page'],
                    'category' => $f['category'],
                    'caption' => $f['caption'],
                ]
            );
        }

        $this->command->info('Seeded ' . count($figures) . ' figure references from the manual.');
    }
}
