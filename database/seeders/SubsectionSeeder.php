<?php

namespace Database\Seeders;

use App\Models\Section;
use App\Models\Subsection;
use Illuminate\Database\Seeder;

class SubsectionSeeder extends Seeder
{
    public function run(): void
    {
        $sections = Section::all()->keyBy('section_number');

        $data = [
            // Section 1
            '01' => [
                [
                    'paragraph_number' => '1-1',
                    'title' => 'General Description',
                    'content' => "The Cessna Model 172 and Skyhawk are all-metal, four-place, high-wing, single-engine airplanes equipped with tricycle landing gear and designed for general utility purposes. This manual contains factory-recommended procedures for servicing and maintaining 1969 through 1976 Skyhawk and Model 172 aircraft.\n\nAll aircraft feature an all-metal, semi-monocoque fuselage, externally braced high wings with all-metal flaps and ailerons, and an empennage with swept vertical stabilizer and rudder.",
                    'page' => 1,
                    'sort_order' => 1,
                ],
                [
                    'paragraph_number' => '1-2',
                    'title' => 'Serial Number and Model Identification',
                    'content' => "The airplane serial number and model designation are stamped on an identification plate attached to the left forward doorpost or left side of the fuselage under the horizontal stabilizer. Always refer to this serial number when ordering replacement parts or referencing maintenance instructions.\n\nReims Aviation manufactured models are identified with an 'F' prefix preceding the model and serial number (e.g. F172M).",
                    'page' => 2,
                    'sort_order' => 2,
                ],
                [
                    'paragraph_number' => '1-3',
                    'title' => 'General Specifications and Dimensions',
                    'content' => "PRINCIPAL DIMENSIONS:\n• Wing Span: 35 ft 10 in\n• Length: 26 ft 11 in\n• Height (maximum with nose gear depressed): 8 ft 11 in\n• Wing Area: 174 sq ft\n• Wheel Base: 65 in\n• Wheel Tread: 106 in (108 in on tubular gear)\n• Propeller Ground Clearance: 13 in",
                    'page' => 4,
                    'sort_order' => 3,
                ],
                [
                    'paragraph_number' => '1-4',
                    'title' => 'Torque Data and Guidelines',
                    'content' => "Correct torque application is essential for flight safety. Unless otherwise specified in maintenance procedures, all bolts and nuts should be torqued in accordance with the standard torque values given in Figure 1-4.\n\nIMPORTANT: The standard torque table applies only to installation torque on clean, dry threads. Do not use this table to check the tightness of previously installed fasteners.",
                    'page' => 8,
                    'sort_order' => 4,
                ],
            ],

            // Section 2
            '02' => [
                [
                    'paragraph_number' => '2-1',
                    'title' => 'Ground Handling and Towing',
                    'content' => "When towing the aircraft, utilize the nose gear towing lugs and an approved tow bar. Do not push on the control surfaces, propeller tips, or wing struts. Maximum nose wheel steering angle during towing is 30° each side of center. Exceeding this limit may damage the nose gear steering stops and internal mechanism.",
                    'page' => 25,
                    'sort_order' => 1,
                ],
                [
                    'paragraph_number' => '2-2',
                    'title' => 'Jacking and Leveling',
                    'content' => "Jacking points are provided on the main gear struts. When jacking the entire airplane, install universal jack points in the wing tie-down fittings. Ensure tail ballast or tie-down is secured to prevent the aircraft from tipping forward.\n\nLeveling: Longitudinal and lateral leveling lugs are located on the left side of the fuselage forward of the horizontal stabilizer.",
                    'page' => 26,
                    'sort_order' => 2,
                ],
                [
                    'paragraph_number' => '2-3',
                    'title' => 'Lubrication Requirements and Procedures',
                    'content' => "Lubricate all moving parts at intervals specified in the Lubrication Chart (Figure 2-1). Use only specified aviation-grade lubricants. Wipe fittings clean before greasing to prevent abrasive contaminants from entering bearing surfaces.\n\nControl pulley bearings are sealed and normally require no lubrication during scheduled maintenance unless sluggish.",
                    'page' => 27,
                    'sort_order' => 3,
                ],
                [
                    'paragraph_number' => '2-4',
                    'title' => 'Scheduled Inspection Intervals',
                    'content' => "Periodic inspections are organized into 50-hour, 100-hour, and 200-hour intervals, plus Annual and Special inspections.\n• 100-Hour Inspection: Includes all 50-hour inspection requirements.\n• 200-Hour Inspection: Includes all 50-hour and 100-hour inspection requirements.\n• Annual Inspection: Must be performed by an appropriately rated mechanic with Inspection Authorization (IA).",
                    'page' => 28,
                    'sort_order' => 4,
                ],
            ],

            // Section 5
            '05' => [
                [
                    'paragraph_number' => '5-1',
                    'title' => 'Main Landing Gear Description & Servicing',
                    'content' => "The main landing gear consists of one-piece tubular steel spring gear struts (1971 and on) or flat spring steel struts (1969–1970) bolted directly to fuselage carry-through forgings. The main wheels feature Goodyear single-disc hydraulic brake assemblies.\n\nTire inflation pressure for main wheels is 29 psi. Inspect wheel bearings for proper lubrication and play every 100 hours.",
                    'page' => 101,
                    'sort_order' => 1,
                ],
                [
                    'paragraph_number' => '5-2',
                    'title' => 'Nose Gear Oleo Strut Servicing',
                    'content' => "The nose gear incorporates an air-oil oleo strut. To service the strut:\n1. Release all air pressure through the Schrader valve.\n2. Remove valve core and compress strut fully.\n3. Fill with MIL-H-5606 hydraulic fluid to bottom of filler opening.\n4. Reinstall valve core and inflate with dry nitrogen or clean dry air until 2.25 inches of chrome strut is exposed with normal static weight.",
                    'page' => 105,
                    'sort_order' => 2,
                ],
                [
                    'paragraph_number' => '5-3',
                    'title' => 'Brake System Bleeding and Maintenance',
                    'content' => "The brake system is a single-disc, hydraulically-actuated system operated by toe pedals on the rudder pedals. Bleeding the system:\n1. Fill master cylinder reservoirs with MIL-H-5606 red hydraulic fluid.\n2. Connect pressure bleeder to bleeder valve on wheel brake caliper.\n3. Pump fluid upward through master cylinder until all air bubbles are expelled from reservoir.",
                    'page' => 112,
                    'sort_order' => 3,
                ],
            ],

            // Section 11
            '11' => [
                [
                    'paragraph_number' => '11-1',
                    'title' => 'Lycoming O-320-E2D Engine General Information',
                    'content' => "The engine installed is an Avco Lycoming O-320-E2D rated at 150 brake horsepower at 2700 RPM. It is a four-cylinder, horizontally opposed, direct-drive, air-cooled, wet-sump engine equipped with a Marvel-Schebler MA-4SPA carburetor and dual Bendix/Slick magnetos.\n\nCompression ratio: 7.0:1. Displacement: 319.8 cubic inches. Firing order: 1-3-2-4.",
                    'page' => 201,
                    'sort_order' => 1,
                ],
                [
                    'paragraph_number' => '11-2',
                    'title' => 'Engine Removal and Installation Procedures',
                    'content' => "Before removing the engine, turn fuel selector OFF, disconnect battery ground cable, and ensure ignition switch is OFF. Disconnect throttle, mixture, and carb heat controls, engine baffle seals, starter and alternator wiring, oil pressure and temperature sensing lines, and vacuum lines.\n\nSupport engine with hoist attached to engine lifting eyes. Remove four engine mount bolts securing engine to airframe firewall.",
                    'page' => 205,
                    'sort_order' => 2,
                ],
                [
                    'paragraph_number' => '11-3',
                    'title' => 'Ignition System and Magneto Timing',
                    'content' => "Magneto timing to engine is 25° Before Top Dead Center (BTDC) for both right and left magnetos on the O-320-E2D. Use an approved timing light or buzz box.\n\nSpark plugs are Champion REM40E or equivalent. Gap setting: 0.015 to 0.021 inches. Torque spark plugs to 300–360 in-lb (25–30 ft-lb).",
                    'page' => 212,
                    'sort_order' => 3,
                ],
                [
                    'paragraph_number' => '11-4',
                    'title' => 'Engine Troubleshooting Guide',
                    'content' => "COMMON ENGINE TROUBLESHOOTING SYMPTOMS:\n\n1. Engine Fails to Start:\n• Fuel selector OFF or empty tank.\n• Mixture control in IDLE CUT-OFF.\n• Over-priming (flooded engine) — open throttle full, mixture IDLE CUT-OFF, crank until starts.\n• Fouled or incorrectly gapped spark plugs.\n• Faulty magneto switch or grounding lead.\n\n2. Rough Running:\n• Carburetor icing — apply CARB HEAT full on.\n• Spark plug fouling — lean mixture slightly on run-up.\n• Sticking valve or defective ignition harness.",
                    'page' => 220,
                    'sort_order' => 4,
                ],
            ],

            // Section 12
            '12' => [
                [
                    'paragraph_number' => '12-1',
                    'title' => 'Fuel System Description & Operation',
                    'content' => "The fuel system is a gravity-feed system consisting of two 20-gallon fuel tanks (one in each wing), a fuel selector valve (LEFT, BOTH, RIGHT, OFF), a fuel strainer with quick-drain valve, a carburetor, and a manual primer system.\n\nTotal capacity: 40 U.S. gallons. Usable fuel: 38 gallons. Unusable fuel: 2 gallons. Use 100LL (blue) or 100/130 (green) aviation gasoline.",
                    'page' => 286,
                    'sort_order' => 1,
                ],
                [
                    'paragraph_number' => '12-2',
                    'title' => 'Fuel Strainer and Screen Servicing',
                    'content' => "The fuel strainer is mounted on the lower left forward side of the firewall. Daily preflight: drain fuel sample into clear cup to check for water, sediment, and proper fuel color (blue for 100LL).\n\nEvery 50 hours: remove strainer bowl and clean the wire mesh screen with clean solvent. Replace bowl gasket if hardened or damaged.",
                    'page' => 290,
                    'sort_order' => 2,
                ],
                [
                    'paragraph_number' => '12-3',
                    'title' => 'Carburetor Maintenance and Idle Adjustment',
                    'content' => "The Marvel-Schebler MA-4SPA carburetor requires periodic idle RPM and mixture adjustment.\n\n1. Warm engine to normal operating temperature.\n2. Adjust idle speed stop screw to obtain 600–650 RPM.\n3. Adjust idle mixture screw for maximum RPM, then turn slightly rich (counterclockwise) to obtain a 25–50 RPM drop.\n4. Check acceleration from idle to full power.",
                    'page' => 295,
                    'sort_order' => 3,
                ],
            ],

            // Section 16
            '16' => [
                [
                    'paragraph_number' => '16-1',
                    'title' => '14-Volt Electrical System Overview',
                    'content' => "Power is supplied by a 14-volt, direct-current electrical system powered by a 60-amp engine-driven alternator and a 12-volt, 25-ampere-hour battery located in a battery box on the left forward side of the firewall.\n\nCircuit protection is provided by push-to-reset circuit breakers located on the lower left instrument panel. An over-voltage sensor automatically opens the alternator field circuit in case of voltage regulator failure.",
                    'page' => 356,
                    'sort_order' => 1,
                ],
                [
                    'paragraph_number' => '16-2',
                    'title' => 'Alternator and Voltage Regulator Testing',
                    'content' => "Regulated bus voltage should be maintained at 14.0 ± 0.3 volts at 1500 RPM with average electrical load. If voltage exceeds 16.0 volts, the over-voltage relay will trip. To reset, turn ALT master switch OFF, then ON.\n\nAlternator drive belt tension: 1/4 to 5/16 inch deflection midway between alternator pulley and starter ring gear pulley under 10 lbs thumb pressure.",
                    'page' => 360,
                    'sort_order' => 2,
                ],
                [
                    'paragraph_number' => '16-3',
                    'title' => 'Battery Servicing and Maintenance',
                    'content' => "Inspect battery every 50 hours (every 25 hours in warm climates). Maintain electrolyte level at the bottom of the split ring in each cell with distilled water.\n\nSpecific gravity when fully charged is 1.275 to 1.285 at 80°F. Clean terminals with baking soda solution and coat with petroleum jelly to inhibit corrosion. Ensure battery drain/vent tube is clear.",
                    'page' => 365,
                    'sort_order' => 3,
                ],
            ],

            // Section 20
            '20' => [
                [
                    'paragraph_number' => '20-1',
                    'title' => 'Wiring Diagram Symbols and Conventions',
                    'content' => "This section contains complete electrical wiring schematics for 1969 through 1976 Cessna 172-Series aircraft.\n\nWire color coding, gauge numbers, wire identification codes, and connector pinouts conform to Cessna factory standards. Refer to Figure 20-1 through 20-8 for specific sub-system diagrams including power distribution, lighting, ignition, and avionics bus wiring.",
                    'page' => 406,
                    'sort_order' => 1,
                ],
            ],
        ];

        $totalSubsections = 0;
        foreach ($data as $secNum => $subs) {
            $section = $sections[$secNum] ?? null;
            if (!$section) continue;

            foreach ($subs as $sub) {
                Subsection::firstOrCreate(
                    [
                        'section_id' => $section->id,
                        'paragraph_number' => $sub['paragraph_number'],
                    ],
                    [
                        'title' => $sub['title'],
                        'content' => $sub['content'],
                        'page' => $sub['page'],
                        'sort_order' => $sub['sort_order'],
                    ]
                );
                $totalSubsections++;
            }
        }

        $this->command->info("Seeded {$totalSubsections} technical manual paragraphs across sections.");
    }
}
