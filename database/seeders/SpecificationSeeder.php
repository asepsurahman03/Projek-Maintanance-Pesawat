<?php

namespace Database\Seeders;

use App\Models\Section;
use App\Models\Specification;
use Illuminate\Database\Seeder;

class SpecificationSeeder extends Seeder
{
    public function run(): void
    {
        $section01 = Section::where('section_number', '01')->first();

        // Source: Cessna 172-Series Service Manual, Section 1 — General Specifications
        // All values sourced directly from the manual specification tables.
        $specs = [
            // ── Aircraft ───────────────────────────────────────────────────────────────
            ['category' => 'Aircraft', 'name' => 'Gross Weight',           'value' => '2300',  'unit' => 'lbs',    'model' => null, 'year' => null, 'source_page' => 4,  'sort_order' => 1,
             'notes' => 'Maximum gross weight for 172M series.'],
            ['category' => 'Aircraft', 'name' => 'Empty Weight (approx.)', 'value' => '1393',  'unit' => 'lbs',    'model' => null, 'year' => null, 'source_page' => 4,  'sort_order' => 2,
             'notes' => 'Approximate. Varies by installed equipment.'],
            ['category' => 'Aircraft', 'name' => 'Useful Load (approx.)',  'value' => '907',   'unit' => 'lbs',    'model' => null, 'year' => null, 'source_page' => 4,  'sort_order' => 3],
            ['category' => 'Aircraft', 'name' => 'Wing Span',              'value' => '35',    'unit' => 'ft 10 in','model'=> null, 'year' => null, 'source_page' => 4,  'sort_order' => 4],
            ['category' => 'Aircraft', 'name' => 'Wing Area',              'value' => '174',   'unit' => 'sq ft',  'model' => null, 'year' => null, 'source_page' => 4,  'sort_order' => 5],
            ['category' => 'Aircraft', 'name' => 'Overall Length',         'value' => '26',    'unit' => 'ft 11 in','model'=> null, 'year' => null, 'source_page' => 4,  'sort_order' => 6],
            ['category' => 'Aircraft', 'name' => 'Overall Height',         'value' => '8',     'unit' => 'ft 11 in','model'=> null, 'year' => null, 'source_page' => 4,  'sort_order' => 7],

            // ── Fuel ───────────────────────────────────────────────────────────────────
            ['category' => 'Fuel',     'name' => 'Total Fuel Capacity',    'value' => '40',    'unit' => 'U.S. gal','model'=> null, 'year' => null, 'source_page' => 5,  'sort_order' => 1,
             'notes' => 'Two tanks, 20 gallons each.'],
            ['category' => 'Fuel',     'name' => 'Usable Fuel',            'value' => '38',    'unit' => 'U.S. gal','model'=> null, 'year' => null, 'source_page' => 5,  'sort_order' => 2],
            ['category' => 'Fuel',     'name' => 'Fuel Grade — Lycoming',  'value' => '100/130 (green) or 100LL (blue)', 'unit' => '', 'model' => '172K/L/M', 'year' => null, 'source_page' => 5, 'sort_order' => 3,
             'notes' => 'Minimum octane rating as specified in the manual.'],
            ['category' => 'Fuel',     'name' => 'Unusable Fuel',          'value' => '2',     'unit' => 'U.S. gal','model'=> null, 'year' => null, 'source_page' => 5,  'sort_order' => 4],

            // ── Oil ────────────────────────────────────────────────────────────────────
            ['category' => 'Oil',      'name' => 'Engine Oil Capacity — Lycoming', 'value' => '8', 'unit' => 'U.S. qt', 'model' => '172K/L/M', 'year' => null, 'source_page' => 5, 'sort_order' => 1,
             'notes' => 'Do not operate with less than 6 quarts.'],
            ['category' => 'Oil',      'name' => 'Minimum Oil Level — Lycoming',   'value' => '6', 'unit' => 'U.S. qt', 'model' => '172K/L/M', 'year' => null, 'source_page' => 5, 'sort_order' => 2],
            ['category' => 'Oil',      'name' => 'Oil Grade — Above 60°F',         'value' => 'SAE 50 or SAE 40', 'unit' => '', 'model' => null, 'year' => null, 'source_page' => 5, 'sort_order' => 3],
            ['category' => 'Oil',      'name' => 'Oil Grade — 30°F to 90°F',       'value' => 'SAE 40',           'unit' => '', 'model' => null, 'year' => null, 'source_page' => 5, 'sort_order' => 4],
            ['category' => 'Oil',      'name' => 'Oil Grade — Below 10°F',         'value' => 'SAE 20W or Diluted','unit'=> '', 'model' => null, 'year' => null, 'source_page' => 5, 'sort_order' => 5],

            // ── Engine ─────────────────────────────────────────────────────────────────
            ['category' => 'Engine',   'name' => 'Engine Make',            'value' => 'Lycoming',           'unit' => '',       'model' => '172K/L/M', 'year' => null, 'source_page' => 4, 'sort_order' => 1],
            ['category' => 'Engine',   'name' => 'Engine Model',           'value' => 'O-320-E2D',          'unit' => '',       'model' => '172K/L/M', 'year' => null, 'source_page' => 4, 'sort_order' => 2,
             'notes' => '"Blue-Streak" series. Air-cooled, wet-sump, four-cylinder, horizontally-opposed, direct-drive, carbureted.'],
            ['category' => 'Engine',   'name' => 'Rated Horsepower',       'value' => '150',                'unit' => 'HP',     'model' => '172K/L/M', 'year' => null, 'source_page' => 4, 'sort_order' => 3],
            ['category' => 'Engine',   'name' => 'Rated RPM',              'value' => '2700',               'unit' => 'RPM',    'model' => '172K/L/M', 'year' => null, 'source_page' => 4, 'sort_order' => 4],
            ['category' => 'Engine',   'name' => 'Displacement',           'value' => '319.8',              'unit' => 'cu in',  'model' => '172K/L/M', 'year' => null, 'source_page' => 4, 'sort_order' => 5],
            ['category' => 'Engine',   'name' => 'Compression Ratio',      'value' => '7.0:1',              'unit' => '',       'model' => '172K/L/M', 'year' => null, 'source_page' => 4, 'sort_order' => 6],
            ['category' => 'Engine',   'name' => 'TBO — Lycoming O-320',   'value' => '2000',               'unit' => 'hours',  'model' => '172K/L/M', 'year' => null, 'source_page' => 4, 'sort_order' => 7,
             'notes' => 'TBO as recommended by manufacturer. Verify current TBO per applicable service instructions.'],

            // ── Propeller ──────────────────────────────────────────────────────────────
            ['category' => 'Propeller','name' => 'Propeller Type',         'value' => 'Fixed Pitch',        'unit' => '',       'model' => '172K/L/M', 'year' => null, 'source_page' => 4, 'sort_order' => 1],
            ['category' => 'Propeller','name' => 'Propeller Manufacturer', 'value' => 'McCauley',           'unit' => '',       'model' => '172K/L/M', 'year' => null, 'source_page' => 4, 'sort_order' => 2],
            ['category' => 'Propeller','name' => 'Diameter',               'value' => '75',                 'unit' => 'in',     'model' => '172K/L/M', 'year' => null, 'source_page' => 4, 'sort_order' => 3],
            ['category' => 'Propeller','name' => 'Minimum Diameter',       'value' => '73',                 'unit' => 'in',     'model' => '172K/L/M', 'year' => null, 'source_page' => 4, 'sort_order' => 4],

            // ── Landing Gear ───────────────────────────────────────────────────────────
            ['category' => 'Landing Gear','name' => 'Main Tire Size',      'value' => '6.00-6',             'unit' => '',       'model' => null, 'year' => null, 'source_page' => 5, 'sort_order' => 1],
            ['category' => 'Landing Gear','name' => 'Main Tire Pressure',  'value' => '29',                 'unit' => 'psi',    'model' => null, 'year' => null, 'source_page' => 5, 'sort_order' => 2],
            ['category' => 'Landing Gear','name' => 'Nose Tire Size',      'value' => '5.00-5',             'unit' => '',       'model' => null, 'year' => null, 'source_page' => 5, 'sort_order' => 3],
            ['category' => 'Landing Gear','name' => 'Nose Tire Pressure',  'value' => '30',                 'unit' => 'psi',    'model' => null, 'year' => null, 'source_page' => 5, 'sort_order' => 4],

            // ── Flight Controls ────────────────────────────────────────────────────────
            ['category' => 'Flight Controls','name' => 'Aileron Travel — Up',  'value' => '20 ± 2',         'unit' => 'deg',    'model' => null, 'year' => null, 'source_page' => 6, 'sort_order' => 1],
            ['category' => 'Flight Controls','name' => 'Aileron Travel — Down','value' => '15 ± 2',         'unit' => 'deg',    'model' => null, 'year' => null, 'source_page' => 6, 'sort_order' => 2],
            ['category' => 'Flight Controls','name' => 'Elevator Travel — Up', 'value' => '28 ± 2',         'unit' => 'deg',    'model' => null, 'year' => null, 'source_page' => 6, 'sort_order' => 3],
            ['category' => 'Flight Controls','name' => 'Elevator Travel — Down','value'=> '23 ± 2',         'unit' => 'deg',    'model' => null, 'year' => null, 'source_page' => 6, 'sort_order' => 4],
            ['category' => 'Flight Controls','name' => 'Rudder Travel — Left',  'value'=> '16 ± 2',         'unit' => 'deg',    'model' => null, 'year' => null, 'source_page' => 6, 'sort_order' => 5],
            ['category' => 'Flight Controls','name' => 'Rudder Travel — Right', 'value'=> '16 ± 2',         'unit' => 'deg',    'model' => null, 'year' => null, 'source_page' => 6, 'sort_order' => 6],
            ['category' => 'Flight Controls','name' => 'Flap Travel — Down',    'value'=> '30 ± 2',         'unit' => 'deg',    'model' => null, 'year' => null, 'source_page' => 6, 'sort_order' => 7],

            // ── Torque ─────────────────────────────────────────────────────────────────
            // Source: Figure 1-4 — Torque Chart
            ['category' => 'Torque','name' => '8-32 NC Thread',         'value' => '12–15',   'unit' => 'in-lb', 'model' => null, 'year' => null, 'source_page' => 8, 'sort_order' => 1, 'notes' => 'Steel, non-threaded insert'],
            ['category' => 'Torque','name' => '10-24 NC Thread',        'value' => '20–25',   'unit' => 'in-lb', 'model' => null, 'year' => null, 'source_page' => 8, 'sort_order' => 2, 'notes' => 'Steel, non-threaded insert'],
            ['category' => 'Torque','name' => '10-32 NF Thread',        'value' => '25–30',   'unit' => 'in-lb', 'model' => null, 'year' => null, 'source_page' => 8, 'sort_order' => 3, 'notes' => 'Steel, non-threaded insert'],
            ['category' => 'Torque','name' => '1/4-20 NC Thread',       'value' => '60–80',   'unit' => 'in-lb', 'model' => null, 'year' => null, 'source_page' => 8, 'sort_order' => 4, 'notes' => 'Steel, non-threaded insert'],
            ['category' => 'Torque','name' => '1/4-28 NF Thread',       'value' => '70–90',   'unit' => 'in-lb', 'model' => null, 'year' => null, 'source_page' => 8, 'sort_order' => 5, 'notes' => 'Steel, non-threaded insert'],
            ['category' => 'Torque','name' => '5/16-18 NC Thread',      'value' => '100–140', 'unit' => 'in-lb', 'model' => null, 'year' => null, 'source_page' => 8, 'sort_order' => 6, 'notes' => 'Steel, non-threaded insert'],
            ['category' => 'Torque','name' => '5/16-24 NF Thread',      'value' => '140–180', 'unit' => 'in-lb', 'model' => null, 'year' => null, 'source_page' => 8, 'sort_order' => 7, 'notes' => 'Steel, non-threaded insert'],
            ['category' => 'Torque','name' => '3/8-16 NC Thread',       'value' => '160–190', 'unit' => 'in-lb', 'model' => null, 'year' => null, 'source_page' => 8, 'sort_order' => 8, 'notes' => 'Steel, non-threaded insert'],
            ['category' => 'Torque','name' => '3/8-24 NF Thread',       'value' => '190–240', 'unit' => 'in-lb', 'model' => null, 'year' => null, 'source_page' => 8, 'sort_order' => 9, 'notes' => 'Steel, non-threaded insert'],
            ['category' => 'Torque','name' => '7/16-14 NC Thread',      'value' => '450–500', 'unit' => 'in-lb', 'model' => null, 'year' => null, 'source_page' => 8, 'sort_order' => 10,'notes' => 'Steel, non-threaded insert'],
            ['category' => 'Torque','name' => '7/16-20 NF Thread',      'value' => '480–690', 'unit' => 'in-lb', 'model' => null, 'year' => null, 'source_page' => 8, 'sort_order' => 11,'notes' => 'Steel, non-threaded insert'],
            ['category' => 'Torque','name' => '1/2-13 NC Thread',       'value' => '480–690', 'unit' => 'in-lb', 'model' => null, 'year' => null, 'source_page' => 8, 'sort_order' => 12,'notes' => 'Steel, non-threaded insert'],
            ['category' => 'Torque','name' => '1/2-20 NF Thread',       'value' => '660–780', 'unit' => 'in-lb', 'model' => null, 'year' => null, 'source_page' => 8, 'sort_order' => 13,'notes' => 'Steel, non-threaded insert'],
        ];

        foreach ($specs as $s) {
            Specification::firstOrCreate(
                ['category' => $s['category'], 'name' => $s['name'], 'model' => $s['model'] ?? null],
                [
                    'section_id'  => $section01?->id,
                    'value'       => $s['value'],
                    'unit'        => $s['unit'] ?? null,
                    'year'        => $s['year'] ?? null,
                    'notes'       => $s['notes'] ?? null,
                    'source_page' => $s['source_page'] ?? null,
                    'sort_order'  => $s['sort_order'],
                ]
            );
        }

        $this->command->info('Seeded ' . count($specs) . ' specifications.');
    }
}
