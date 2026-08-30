<?php

namespace Database\Seeders;

use App\Models\InspectionItem;
use App\Models\Section;
use Illuminate\Database\Seeder;

class InspectionSeeder extends Seeder
{
    public function run(): void
    {
        $section02 = Section::where('section_number', '02')->first();

        // Source: Cessna 172-Series Service Manual, Section 2 — Inspection Chart
        // Note: 100-hour inspections include all 50-hour items.
        // 200-hour inspections include all 50-hour and 100-hour items.
        $items = [
            // ── 50-HOUR INSPECTION ─────────────────────────────────────────────────────
            ['item' => 'Engine oil — check level and condition',                 'interval' => '50 hours',  'sort_order' => 1,  'source_page' => 28,
             'description' => 'Check engine oil level. Change oil and filter/screen if contaminated or at 50-hour intervals.'],
            ['item' => 'Fuel strainer — clean and inspect',                      'interval' => '50 hours',  'sort_order' => 2,  'source_page' => 28,
             'description' => 'Remove, clean, and inspect fuel strainer bowl and screen.'],
            ['item' => 'Engine controls — check for proper travel and operation','interval' => '50 hours',  'sort_order' => 3,  'source_page' => 28,
             'description' => 'Check throttle, mixture, and carburetor heat controls for full travel and security.'],
            ['item' => 'Propeller — inspect for nicks, cracks, and security',   'interval' => '50 hours',  'sort_order' => 4,  'source_page' => 28,
             'description' => 'Inspect propeller blades and hub for nicks, scratches, cracks, and loose bolts.'],
            ['item' => 'Tire condition and inflation pressure',                  'interval' => '50 hours',  'sort_order' => 5,  'source_page' => 29,
             'description' => 'Main tires: 29 psi. Nose tire: 30 psi. Inspect tread and sidewall for damage.'],
            ['item' => 'Brake fluid level — inspect and service',               'interval' => '50 hours',  'sort_order' => 6,  'source_page' => 29,
             'description' => 'Check brake fluid reservoir level. Use MIL-H-5606 hydraulic fluid.'],
            ['item' => 'Aircraft interior — general inspection',                 'interval' => '50 hours',  'sort_order' => 7,  'source_page' => 29,
             'description' => 'Check seats, belts, and interior for condition and security.'],
            ['item' => 'Avionics and instruments — check operation',             'interval' => '50 hours',  'sort_order' => 8,  'source_page' => 29,
             'description' => 'Functionally check all avionics and instruments for proper operation.'],

            // ── 100-HOUR INSPECTION ────────────────────────────────────────────────────
            ['item' => 'Engine oil — change oil and filter/screen',             'interval' => '100 hours', 'sort_order' => 1,  'source_page' => 30,
             'description' => 'Drain and replace engine oil. Replace oil filter or clean screen. Inspect for metal particles.'],
            ['item' => 'Spark plugs — remove, inspect, clean, and gap',         'interval' => '100 hours', 'sort_order' => 2,  'source_page' => 30,
             'description' => 'Remove all spark plugs. Inspect for electrode wear and deposits. Clean and re-gap or replace as needed.'],
            ['item' => 'Magnetos — check timing and points',                    'interval' => '100 hours', 'sort_order' => 3,  'source_page' => 30,
             'description' => 'Inspect magneto timing. Check breaker points for condition and gap.'],
            ['item' => 'Carburetor air filter — clean and inspect',             'interval' => '100 hours', 'sort_order' => 4,  'source_page' => 30,
             'description' => 'Remove air filter element. Clean or replace. Inspect air box for debris.'],
            ['item' => 'Engine compartment — general inspection for leaks',     'interval' => '100 hours', 'sort_order' => 5,  'source_page' => 31,
             'description' => 'Inspect engine compartment for oil, fuel, and exhaust leaks. Check all hose clamps and fittings.'],
            ['item' => 'Exhaust system — inspect for cracks and security',      'interval' => '100 hours', 'sort_order' => 6,  'source_page' => 31,
             'description' => 'Inspect exhaust stacks, muffler, and heat exchanger for cracks, security, and carbon buildup.'],
            ['item' => 'Battery — check electrolyte level and terminals',       'interval' => '100 hours', 'sort_order' => 7,  'source_page' => 31,
             'description' => 'Check battery electrolyte level. Clean terminals. Check vent line. Check specific gravity.'],
            ['item' => 'Landing gear — lubricate and inspect',                  'interval' => '100 hours', 'sort_order' => 8,  'source_page' => 31,
             'description' => 'Lubricate main gear, nose gear, and steering per lubrication chart. Inspect for cracks and wear.'],
            ['item' => 'Control cables — inspect for fraying and wear',         'interval' => '100 hours', 'sort_order' => 9,  'source_page' => 32,
             'description' => 'Inspect all flight control cables for fraying, corrosion, and proper tension.'],
            ['item' => 'Flight control surfaces — check travel and rigging',    'interval' => '100 hours', 'sort_order' => 10, 'source_page' => 32,
             'description' => 'Check aileron, elevator, and rudder for full travel, security, and proper rigging.'],
            ['item' => 'Fuel system — inspect lines, valves, and vents',        'interval' => '100 hours', 'sort_order' => 11, 'source_page' => 32,
             'description' => 'Inspect fuel lines for leaks, chafing, and security. Check fuel selector valve operation. Check fuel vents.'],

            // ── 200-HOUR INSPECTION ────────────────────────────────────────────────────
            ['item' => 'Engine oil cooler — inspect and clean',                 'interval' => '200 hours', 'sort_order' => 1,  'source_page' => 34,
             'description' => 'Remove, inspect, and flush oil cooler. Check for cracks and blockage.'],
            ['item' => 'Carburetor — overhaul or replace',                      'interval' => '200 hours', 'sort_order' => 2,  'source_page' => 34,
             'description' => 'Overhaul or replace carburetor per manufacturer recommendations.'],
            ['item' => 'Brake assemblies — inspect linings and discs',          'interval' => '200 hours', 'sort_order' => 3,  'source_page' => 34,
             'description' => 'Disassemble brakes. Inspect linings, discs, and cylinders for wear. Replace if below limits.'],
            ['item' => 'Fuel tanks — inspect for leaks and contamination',      'interval' => '200 hours', 'sort_order' => 4,  'source_page' => 34,
             'description' => 'Inspect fuel tanks, filler caps, and gaskets. Sample for water and contaminants.'],
            ['item' => 'Airframe structure — inspect for corrosion and cracks', 'interval' => '200 hours', 'sort_order' => 5,  'source_page' => 35,
             'description' => 'Inspect fuselage, wing, and empennage structure for corrosion, cracks, and loose rivets.'],

            // ── SPECIAL INSPECTION ITEMS ──────────────────────────────────────────────
            ['item' => 'Hard landing inspection',                                'interval' => 'Special',   'sort_order' => 1,  'source_page' => 36,
             'description' => 'After any hard or overweight landing, inspect landing gear, wing attach fittings, and firewall for damage before next flight.',
             'notes' => 'Required before next flight following hard or overweight landing.'],
            ['item' => 'Lightning strike inspection',                            'interval' => 'Special',   'sort_order' => 2,  'source_page' => 36,
             'description' => 'After suspected lightning strike, inspect entire aircraft, avionics, and electrical system.',
             'notes' => 'Required before next flight.'],
            ['item' => 'Propeller strike inspection',                            'interval' => 'Special',   'sort_order' => 3,  'source_page' => 36,
             'description' => 'After propeller ground strike, engine must be inspected before further flight.',
             'notes' => 'Required before next flight. Engine teardown inspection may be required.'],
            ['item' => 'Overwater operation — 50-hour lubrication',             'interval' => 'Special',   'sort_order' => 4,  'source_page' => 36,
             'description' => 'For aircraft operated in overwater or high-humidity environments, lubricate per 50-hour schedule.',
             'notes' => 'Applicable when operating in corrosive environments.'],

            // ── ANNUAL INSPECTION ─────────────────────────────────────────────────────
            ['item' => 'Complete aircraft annual inspection per FAR Part 43',   'interval' => 'Annual',    'sort_order' => 1,  'source_page' => 37,
             'description' => 'Comprehensive inspection covering all systems. Must be performed by certified A&P mechanic with IA authorization.',
             'notes' => 'Required by regulation. Supersedes all periodic inspection items.'],
            ['item' => 'Airworthiness Directives — compliance check',           'interval' => 'Annual',    'sort_order' => 2,  'source_page' => 37,
             'description' => 'Review and verify compliance with all applicable Airworthiness Directives.'],
            ['item' => 'ELT — inspect and test',                                'interval' => 'Annual',    'sort_order' => 3,  'source_page' => 37,
             'description' => 'Inspect ELT battery and test as per manufacturer and regulatory requirements.'],
            ['item' => 'Altimeter system and transponder — certification',       'interval' => 'Annual',    'sort_order' => 4,  'source_page' => 37,
             'description' => 'Altimeter and static system test every 24 months. Transponder test every 24 months.',
             'notes' => '24-month regulatory requirement per FAR 91.413 and 91.411.'],
        ];

        foreach ($items as $i) {
            InspectionItem::firstOrCreate(
                ['item' => $i['item'], 'interval' => $i['interval']],
                [
                    'section_id'  => $section02?->id,
                    'description' => $i['description'] ?? null,
                    'notes'       => $i['notes'] ?? null,
                    'source_page' => $i['source_page'],
                    'sort_order'  => $i['sort_order'],
                ]
            );
        }

        $this->command->info('Seeded ' . count($items) . ' inspection items.');
    }
}
