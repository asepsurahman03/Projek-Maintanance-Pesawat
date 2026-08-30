<?php

namespace Database\Seeders;

use App\Models\InspectionItem;
use App\Models\Section;
use Illuminate\Database\Seeder;

class InspectionCompleteSeeder extends Seeder
{
    public function run(): void
    {
        $section02 = Section::where('section_number', '02')->first();

        $items = [

            // ─── 50-HOUR INSPECTION ────────────────────────────────────────────────────
            // Engine area
            ['item' => 'Engine oil — check level and change if required',                 'interval' => '50 hours',  'sort_order' => 1,  'source_page' => 28, 'description' => 'Check oil level (dipstick). Change oil and clean/replace oil filter at 50-hour intervals or at first sign of contamination.'],
            ['item' => 'Fuel strainer — drain and clean',                                  'interval' => '50 hours',  'sort_order' => 2,  'source_page' => 28, 'description' => 'Remove and clean fuel strainer bowl and screen. Check for water or debris in fuel.'],
            ['item' => 'Engine controls — check travel and security',                      'interval' => '50 hours',  'sort_order' => 3,  'source_page' => 28, 'description' => 'Verify full travel on throttle, mixture, carb heat. Confirm controls return to idle freely.'],
            ['item' => 'Engine cowling — inspect for security and damage',                 'interval' => '50 hours',  'sort_order' => 4,  'source_page' => 28, 'description' => 'Check all cowl screws and fasteners. Inspect fiberglass cowl for cracks and stress marks.'],
            ['item' => 'Air induction system — check for obstructions',                   'interval' => '50 hours',  'sort_order' => 5,  'source_page' => 28, 'description' => 'Inspect air box and intake for bird nests, debris, or insect blockage.'],
            // Propeller
            ['item' => 'Propeller — inspect blades for nicks and security',               'interval' => '50 hours',  'sort_order' => 6,  'source_page' => 28, 'description' => 'Inspect each propeller blade for nicks, scratches, cracks. Dress minor nicks per Section 13. Check hub bolts for security.'],
            ['item' => 'Spinner — inspect for cracks and security',                       'interval' => '50 hours',  'sort_order' => 7,  'source_page' => 28, 'description' => 'Remove spinner. Inspect for cracks at back plate cut-outs. Reinstall and check all mounting screws.'],
            // Landing gear
            ['item' => 'Tire condition and inflation — check and service',                'interval' => '50 hours',  'sort_order' => 8,  'source_page' => 29, 'description' => 'Main tires: 29 psi. Nose tire: 30 psi. Inspect tread, sidewalls, and valve cores.'],
            ['item' => 'Brake fluid level — check and service',                           'interval' => '50 hours',  'sort_order' => 9,  'source_page' => 29, 'description' => 'Check brake reservoir fluid level. Use only MIL-H-5606 hydraulic fluid.'],
            ['item' => 'Nose gear oleo — check extension and fluid level',                'interval' => '50 hours',  'sort_order' => 10, 'source_page' => 29, 'description' => 'Nose strut extension: 3.75 inches under empty aircraft weight. Fill with MIL-H-5606 if low. Check for leaks.'],
            // Interior / systems
            ['item' => 'Flight instruments — check operation and lighting',               'interval' => '50 hours',  'sort_order' => 11, 'source_page' => 29, 'description' => 'Functionally test all flight and engine instruments. Verify instrument lights operate.'],
            ['item' => 'Avionics — check operation of all installed equipment',            'interval' => '50 hours',  'sort_order' => 12, 'source_page' => 29, 'description' => 'Turn on all radios, NAV/COM, transponder, and test normal operation.'],
            ['item' => 'Seats and seat belts — check security and adjustment',            'interval' => '50 hours',  'sort_order' => 13, 'source_page' => 29, 'description' => 'Check seat track locks hold firmly. Check belt buckle and shoulder harness latch mechanism.'],
            ['item' => 'Aircraft documents — verify on board and current',                 'interval' => '50 hours',  'sort_order' => 14, 'source_page' => 29, 'description' => 'Verify Airworthiness Certificate, Registration, POH, and Weight & Balance are in aircraft.'],

            // ─── 100-HOUR INSPECTION ──────────────────────────────────────────────────
            // Engine
            ['item' => 'Engine oil — drain and replace (change oil)',                     'interval' => '100 hours', 'sort_order' => 1,  'source_page' => 30, 'description' => 'Drain engine oil. Replace oil filter (Champion CH48104) or clean metal mesh screen. Check for metal particles in old oil.'],
            ['item' => 'Spark plugs — remove, inspect, clean and regap all',              'interval' => '100 hours', 'sort_order' => 2,  'source_page' => 30, 'description' => 'Remove all spark plugs. Clean with abrasive blast. Set gap: 0.018-0.022 inch. Rotate to opposite position (top to bottom). Replace if eroded or cracked.'],
            ['item' => 'Magnetos — check timing and inspect points',                       'interval' => '100 hours', 'sort_order' => 3,  'source_page' => 30, 'description' => 'Verify magneto timing at 25° BTC (Lycoming) or 26° BTC (Continental). Check breaker point gap: 0.016 inch.'],
            ['item' => 'Ignition harness — inspect for chafing and resistance',           'interval' => '100 hours', 'sort_order' => 4,  'source_page' => 30, 'description' => 'Inspect spark plug lead cables for chafing, cracking, and loose connections. Check insulation resistance with megger.'],
            ['item' => 'Carburetor air filter — clean or replace element',                 'interval' => '100 hours', 'sort_order' => 5,  'source_page' => 30, 'description' => 'Remove air filter element. Clean dry-type filter with compressed air. Replace if damaged or heavily contaminated.'],
            ['item' => 'Engine compartment — inspect for oil, fuel, exhaust leaks',      'interval' => '100 hours', 'sort_order' => 6,  'source_page' => 31, 'description' => 'Inspect all fuel lines, oil lines, intake tubes, and hose clamps for leaks. Wipe surfaces clean to aid detection.'],
            ['item' => 'Exhaust system — inspect for cracks, leaks, and security',       'interval' => '100 hours', 'sort_order' => 7,  'source_page' => 31, 'description' => 'Inspect exhaust stacks, collector ring, muffler, and heat exchanger. Cracks or holes are flight safety hazards — replace immediately.'],
            ['item' => 'Engine mounts — inspect for cracks and security',                 'interval' => '100 hours', 'sort_order' => 8,  'source_page' => 31, 'description' => 'Inspect tubular engine mount for cracks at weld joints. Check rubber bushings for deterioration. Torque mount bolts.'],
            // Electrical
            ['item' => 'Battery — check electrolyte level, gravity, and terminals',       'interval' => '100 hours', 'sort_order' => 9,  'source_page' => 31, 'description' => 'Check battery electrolyte at each cell (specific gravity 1.275-1.300 fully charged). Clean terminals. Check vent tube routing.'],
            ['item' => 'Alternator/generator — inspect and check output',                  'interval' => '100 hours', 'sort_order' => 10, 'source_page' => 31, 'description' => 'Inspect alternator belt tension (3/4-inch deflection under 15-lb force). Check brushes, output: 13.5-14.5V at cruise power.'],
            // Landing gear
            ['item' => 'Landing gear — lubricate per lubrication chart',                  'interval' => '100 hours', 'sort_order' => 11, 'source_page' => 31, 'description' => 'Lubricate all main gear pivot points and nose gear pivot, trunnion, and shimmy dampener per Section 2 lubrication chart.'],
            ['item' => 'Brake discs and linings — inspect for wear',                      'interval' => '100 hours', 'sort_order' => 12, 'source_page' => 32, 'description' => 'Inspect brake lining thickness — minimum 0.100 inch. Inspect discs for scoring. Check caliper movement on pins.'],
            // Flight controls
            ['item' => 'Control cables — inspect for fraying, rust, and tension',        'interval' => '100 hours', 'sort_order' => 13, 'source_page' => 32, 'description' => 'Inspect all flight control cables for broken strands, corrosion, and chafing at fairleads. Check tension with tensiometer.'],
            ['item' => 'Control surfaces — check hinges for freeplay and condition',     'interval' => '100 hours', 'sort_order' => 14, 'source_page' => 32, 'description' => 'Check all hinge bearings (aileron, elevator, rudder, flap). Max freeplay: 0.025 inch at trailing edge. Lubricate bearings.'],
            ['item' => 'Aileron travel — verify deflection limits',                       'interval' => '100 hours', 'sort_order' => 15, 'source_page' => 32, 'description' => 'Verify aileron travel: Up 30° / Down 15°. Adjust if outside tolerance by modifying push-pull tube length.'],
            ['item' => 'Elevator travel — verify deflection limits',                      'interval' => '100 hours', 'sort_order' => 16, 'source_page' => 32, 'description' => 'Verify elevator travel: Up 28° / Down 23°. Check trim tab travel: Nose down 13° / Nose up 28°.'],
            ['item' => 'Rudder travel — verify deflection limits',                        'interval' => '100 hours', 'sort_order' => 17, 'source_page' => 32, 'description' => 'Verify rudder travel: 16° each side of center. Check nose wheel steering centering and 30° limit.'],
            // Fuel system
            ['item' => 'Fuel system — inspect lines, valves, vents, and caps',          'interval' => '100 hours', 'sort_order' => 18, 'source_page' => 32, 'description' => 'Inspect all fuel plumbing for leaks, security, and chafing. Check fuel selector valve for proper detent positions. Check tank vent tubes.'],
            ['item' => 'Fuel tanks — sample and check for water/contamination',          'interval' => '100 hours', 'sort_order' => 19, 'source_page' => 32, 'description' => 'Drain fuel sump sample from each tank. Check for water, sediment, or discoloration.'],
            // Structure
            ['item' => 'Wing struts — inspect for dents, cracks, and drain holes',      'interval' => '100 hours', 'sort_order' => 20, 'source_page' => 33, 'description' => 'Inspect wing struts for buckling or damage. Ensure drain holes at lower fitting are clear. Check upper and lower attach fittings.'],
            ['item' => 'Firewall — inspect for cracks, warping, and penetrations',       'interval' => '100 hours', 'sort_order' => 21, 'source_page' => 33, 'description' => 'Inspect stainless steel firewall for cracks and penetration seal integrity. All penetrations must be properly sealed.'],
            ['item' => 'Empennage attach fittings — inspect for cracks and security',   'interval' => '100 hours', 'sort_order' => 22, 'source_page' => 33, 'description' => 'Inspect horizontal stabilizer attach fittings (4 front + 2 rear bolts). Inspect vertical stabilizer spar caps at fuselage.'],
            ['item' => 'Stall warning system — test operation',                           'interval' => '100 hours', 'sort_order' => 23, 'source_page' => 33, 'description' => 'With engine running at idle, lift stall warning vane. Confirm horn sounds. Inspect vane for damage or obstruction.'],
            ['item' => 'ELT — check battery expiration and operation',                   'interval' => '100 hours', 'sort_order' => 24, 'source_page' => 33, 'description' => 'Check ELT battery expiration date. Test in transmit mode per manufacturer instructions. Re-arm after test.', 'notes' => 'Test during first 5 minutes of any UTC hour for maximum 3 sweeps.'],
            ['item' => 'VOR receiver — check accuracy per FAR 91.171',                  'interval' => '100 hours', 'sort_order' => 25, 'source_page' => 33, 'description' => 'For IFR use, VOR must be checked within 30 days. Log check point, bearing, error, and signature.'],

            // ─── 200-HOUR INSPECTION ──────────────────────────────────────────────────
            ['item' => 'Engine oil cooler — inspect, flush, and pressure test',          'interval' => '200 hours', 'sort_order' => 1,  'source_page' => 34, 'description' => 'Remove and flush oil cooler. Pressure test to 65 PSI. Replace if found leaking or internally blocked.'],
            ['item' => 'Carburetor — overhaul or replacement',                            'interval' => '200 hours', 'sort_order' => 2,  'source_page' => 34, 'description' => 'Overhaul carburetor per Marvel-Schebler MA-4-5 instructions or replace with factory exchange unit.'],
            ['item' => 'Brake assemblies — disassemble, inspect, and measure',           'interval' => '200 hours', 'sort_order' => 3,  'source_page' => 34, 'description' => 'Disassemble brake calipers. Measure disc thickness (min 0.190 inch). Inspect O-rings, pistons, and cylinders.'],
            ['item' => 'Fuel tanks — internal inspection for sludge and corrosion',      'interval' => '200 hours', 'sort_order' => 4,  'source_page' => 34, 'description' => 'Access tank sumps for visual inspection. Check tank interior for corrosion, sealant delamination, and sludge accumulation.'],
            ['item' => 'Airframe structure — complete corrosion inspection',              'interval' => '200 hours', 'sort_order' => 5,  'source_page' => 35, 'description' => 'Inspect all structural members, skin panels, and fairings for corrosion. Treat and prime any affected areas.'],
            ['item' => 'Control cable end fittings — inspect for corrosion and cracking','interval' => '200 hours', 'sort_order' => 6,  'source_page' => 35, 'description' => 'Inspect swaged cable end fittings for cracks and corrosion. Replace any fitting showing damage or deformation.'],
            ['item' => 'Fuel selector valve — disassemble and inspect',                  'interval' => '200 hours', 'sort_order' => 7,  'source_page' => 35, 'description' => 'Remove fuel selector valve. Inspect valve core and O-rings for wear. Replace O-rings if suspect.'],
            ['item' => 'Vacuum pump — inspect and replace if worn',                      'interval' => '200 hours', 'sort_order' => 8,  'source_page' => 35, 'description' => 'Inspect dry-type vacuum pump for internal wear (metal filings in filter). Replace at 500 hours or sooner if vacuum is marginal.'],
            ['item' => 'Landing gear springs and rubber components — inspect',           'interval' => '200 hours', 'sort_order' => 9,  'source_page' => 35, 'description' => 'Inspect main gear spring steel rods for cracks and corrosion. Inspect rubber fairings and nose gear bungee cords.'],
            ['item' => 'Door hinges and latches — inspect and adjust all doors',         'interval' => '200 hours', 'sort_order' => 10, 'source_page' => 35, 'description' => 'Inspect and lubricate all door hinges. Adjust door latches and strikers for firm engagement. Check window seals.'],

            // ─── ANNUAL INSPECTION ────────────────────────────────────────────────────
            ['item' => 'Annual inspection — complete per FAR Part 43 Appendix D',       'interval' => 'Annual',    'sort_order' => 1,  'source_page' => 36, 'description' => 'Complete annual inspection per FAR 43 Appendix D. Must be performed by certificated mechanic holding Inspection Authorization (IA).',  'notes' => 'Aircraft must be returned to service with completed maintenance record entry signed by IA.'],
            ['item' => 'Altimeter and static system — test per FAR 91.411 (IFR only)',  'interval' => 'Annual',    'sort_order' => 2,  'source_page' => 36, 'description' => 'Altimeter and static system must be tested within preceding 24 calendar months for IFR flight.', 'notes' => 'Required every 24 months for IFR operation.'],
            ['item' => 'Transponder — test per FAR 91.413',                              'interval' => 'Annual',    'sort_order' => 3,  'source_page' => 36, 'description' => 'Transponder must be tested and inspected within preceding 24 calendar months.', 'notes' => 'Required every 24 months.'],
            ['item' => 'Weight and balance — verify and update as required',             'interval' => 'Annual',    'sort_order' => 4,  'source_page' => 36, 'description' => 'Verify Weight & Balance documentation reflects all current equipment installations. Update if equipment was added or removed.'],
            ['item' => 'Airworthiness Directives — review and ensure compliance',        'interval' => 'Annual',    'sort_order' => 5,  'source_page' => 36, 'description' => 'Review FAA Airworthiness Directives applicable to this aircraft serial number, engine, propeller, and installed equipment.'],
            ['item' => 'Aircraft logbooks — review and verify entries',                  'interval' => 'Annual',    'sort_order' => 6,  'source_page' => 36, 'description' => 'Review airframe, engine, and propeller logbooks. Confirm all required inspections are documented. Verify TTSN and times since overhaul.'],

            // ─── SPECIAL INSPECTIONS ──────────────────────────────────────────────────
            ['item' => 'Hard landing inspection',                                         'interval' => 'Special',   'sort_order' => 1,  'source_page' => 37, 'description' => 'Inspect landing gear, wing attach fittings, firewall, and engine mounts for damage.', 'notes' => 'Required before next flight following hard or overweight landing.'],
            ['item' => 'Lightning strike inspection',                                     'interval' => 'Special',   'sort_order' => 2,  'source_page' => 37, 'description' => 'Inspect entire aircraft, avionics, and electrical system after suspected lightning strike.', 'notes' => 'Required before next flight.'],
            ['item' => 'Propeller strike inspection',                                     'interval' => 'Special',   'sort_order' => 3,  'source_page' => 37, 'description' => 'Engine must be disassembled by qualified engine shop after propeller ground strike — internal damage may not be externally visible.', 'notes' => 'Required before next flight. Engine must be inspected by certificated shop.'],
            ['item' => 'Overweight landing inspection',                                   'interval' => 'Special',   'sort_order' => 4,  'source_page' => 37, 'description' => 'Inspect per hard landing inspection if landing was made at or above MTOW (2300 lbs). Check fuel vented or passengers deplaned prior to overweight condition.', 'notes' => 'Required before next flight if landing weight exceeded 2300 lbs.'],
            ['item' => 'Bird strike inspection',                                          'interval' => 'Special',   'sort_order' => 5,  'source_page' => 37, 'description' => 'Inspect affected area for structural damage. Inspect engine intake, cowling, and windshield if bird strike occurred in those areas.', 'notes' => 'Inspect before next flight if structural damage is suspected.'],
            ['item' => 'Fuel contamination inspection',                                   'interval' => 'Special',   'sort_order' => 6,  'source_page' => 37, 'description' => 'If wrong fuel type was introduced, defuel and flush tanks completely. Inspect injector/carb for contamination.', 'notes' => 'Aircraft grounded until fuel system inspected and correct fuel confirmed.'],
        ];

        $inserted = 0;
        foreach ($items as $item) {
            InspectionItem::updateOrCreate(
                [
                    'interval' => $item['interval'],
                    'item'     => $item['item'],
                ],
                [
                    'description' => $item['description'] ?? null,
                    'notes'       => $item['notes'] ?? null,
                    'sort_order'  => $item['sort_order'],
                    'source_page' => $item['source_page'],
                    'section_id'  => $section02?->id,
                ]
            );
            $inserted++;
        }
        $this->command->info("Inserted/updated $inserted inspection items.");
    }
}
