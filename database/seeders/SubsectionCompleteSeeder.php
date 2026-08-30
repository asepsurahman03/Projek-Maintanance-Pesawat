<?php

namespace Database\Seeders;

use App\Models\Section;
use App\Models\Subsection;
use Illuminate\Database\Seeder;

class SubsectionCompleteSeeder extends Seeder
{
    public function run(): void
    {
        $sections = Section::all()->keyBy('section_number');

        $data = [

            // ─── SECTION 3: FUSELAGE ──────────────────────────────────
            '03' => [
                [
                    'paragraph_number' => '3-1',
                    'title' => 'Fuselage — General Description',
                    'content' => "The Cessna 172-series fuselage is an all-metal, semi-monocoque structure consisting of bulkheads, longerons, stringers, and skin panels riveted together. The structure is designed to transmit all flight, landing, and ground loads to the wing spar carry-through structure.\n\nThe cabin area features aluminum alloy skin panels with flush rivets over most external surfaces. Access panels are located at strategic points to facilitate maintenance without requiring major disassembly.",
                    'page' => 61, 'sort_order' => 1,
                ],
                [
                    'paragraph_number' => '3-2',
                    'title' => 'Fuselage Skin Repair — Minor Damage',
                    'content' => "Minor skin damage (small dents, scratches, and minor cracks) may be repaired using standard aircraft sheet metal techniques. For damage exceeding the limits defined in AC 43.13-1B, consult Section 18 (Structural Repair) for acceptable repair methods.\n\nCAUTION: Ensure repairs maintain the original strength and aerodynamic surface finish. Improper repairs may affect flight characteristics.",
                    'page' => 63, 'sort_order' => 2,
                ],
                [
                    'paragraph_number' => '3-3',
                    'title' => 'Door Seals and Latches — Inspection & Adjustment',
                    'content' => "Inspect door seals annually or whenever drafts or water leaks are detected in the cabin. Door seals are made of neoprene rubber and are available as complete replacement kits.\n\nDoor latch adjustment: The door should close and latch firmly with minimum effort. If excessive force is required, adjust the door striker plate position by loosening the screws and repositioning. Tighten to 35-40 in-lb after adjustment.",
                    'page' => 65, 'sort_order' => 3,
                ],
                [
                    'paragraph_number' => '3-4',
                    'title' => 'Nose Bowl and Cowling — Removal & Installation',
                    'content' => "NOSE BOWL REMOVAL:\n1. Open upper cowl access door.\n2. Disconnect landing light wiring at quick-disconnect.\n3. Remove 14 screws (No. 10-32) securing nose bowl to engine mount ring.\n4. Slide bowl forward off fuselage.\n\nNOSE BOWL INSTALLATION:\nReverse removal procedure. Torque screws to 20-25 in-lb. Ensure all wiring is properly routed and secured away from exhaust heat sources.",
                    'page' => 68, 'sort_order' => 4,
                ],
                [
                    'paragraph_number' => '3-5',
                    'title' => 'Cabin Floor and Inspection Plates',
                    'content' => "Access to control cables, rudder pedal assemblies, and fuel selector valve is via removable floor panels. Panels are secured with quarter-turn fasteners.\n\nTo inspect rudder pedal bearings: Remove forward floor panel. Inspect pedal pivot pins for wear. Lubricate with MIL-G-7711 grease. Replace pins showing more than 0.005-inch elongation of pivot hole.",
                    'page' => 72, 'sort_order' => 5,
                ],
            ],

            // ─── SECTION 4: WINGS & EMPENNAGE ────────────────────────
            '04' => [
                [
                    'paragraph_number' => '4-1',
                    'title' => 'Wings — Description and Data',
                    'content' => "The Cessna 172 wing is a two-spar, externally braced, high-wing design of all-metal construction. The wing is built around front and rear spars connected by aluminum alloy wing ribs. External bracing consists of a single V-strut on each side.\n\nWing attach fittings at the fuselage are critical structural members and must be inspected at each annual inspection for cracks, corrosion, and loose fasteners.",
                    'page' => 81, 'sort_order' => 1,
                ],
                [
                    'paragraph_number' => '4-2',
                    'title' => 'Wing Strut — Inspection and Water Drain',
                    'content' => "Wing struts are hollow aluminum tubes with drain holes at the lower attachment fitting. These drain holes must be kept open to prevent water accumulation and corrosion inside the strut.\n\nINSPECTION PROCEDURE:\n1. Inspect strut for dents, wrinkles, or buckling — ANY deformation requires replacement.\n2. Check upper and lower attachment fittings for cracks and corrosion.\n3. Check drain holes are clear. Clean with compressed air if blocked.\n4. Inspect strut-to-wing fairings for security and condition.",
                    'page' => 83, 'sort_order' => 2,
                ],
                [
                    'paragraph_number' => '4-3',
                    'title' => 'Horizontal Stabilizer and Elevator — Description',
                    'content' => "The horizontal stabilizer is an all-metal, two-spar structure attached to the aft fuselage by four attach bolts at the front spar and two at the rear spar. The stabilizer is NOT adjustable.\n\nThe elevator consists of two panels joined at the centerline. The elevator trim tab is mounted on the right elevator panel and is actuated by a screw drive operated from the cockpit trim wheel.",
                    'page' => 88, 'sort_order' => 3,
                ],
                [
                    'paragraph_number' => '4-4',
                    'title' => 'Vertical Stabilizer and Rudder — Inspection',
                    'content' => "The swept vertical stabilizer is integral with the aft fuselage structure. Inspect at annual inspection:\n\n1. Inspect spar cap attach bolts for security and corrosion.\n2. Inspect leading and trailing edges for dents and cracks.\n3. Inspect hinge fittings for wear — allowable freeplay: 0.020 inch max.\n4. Inspect rudder stops for secure attachment and correct position.\n5. Check rudder cables for fraying at fairleads and pulleys.",
                    'page' => 92, 'sort_order' => 4,
                ],
            ],

            // ─── SECTION 6: AILERON CONTROL SYSTEM ──────────────────
            '06' => [
                [
                    'paragraph_number' => '6-1',
                    'title' => 'Aileron System — Description',
                    'content' => "The ailerons are of all-metal construction and are operated by push-pull tubes connected to a bellcrank in the wing, which is in turn connected to the control column by a torque tube and cable system.\n\nThe aileron system provides roll control. Both ailerons deflect differentially to provide coordinated rolling moments. The control column in the cockpit operates through chains and cables to the aileron torque tube.",
                    'page' => 131, 'sort_order' => 1,
                ],
                [
                    'paragraph_number' => '6-2',
                    'title' => 'Aileron Rigging — Travel and Alignment',
                    'content' => "AILERON TRAVEL LIMITS:\n• Up deflection: 30° (+1°, -0°)\n• Down deflection: 15° (+1°, -0°)\n\nRIGGING PROCEDURE:\n1. Place aircraft on jacks and level.\n2. Install rigging board or use protractor on aileron trailing edge.\n3. Set cable tension: 40-50 lbs at 70°F.\n4. With cables at correct tension, check aileron neutral position — trailing edge must be flush with wing trailing edge ±1/8 inch.\n5. Adjust push-pull tube lengths as required.",
                    'page' => 134, 'sort_order' => 2,
                ],
                [
                    'paragraph_number' => '6-3',
                    'title' => 'Aileron Removal and Installation',
                    'content' => "REMOVAL:\n1. Remove access panel at inboard aileron hinge.\n2. Disconnect push-pull tube from aileron bellcrank (retain hardware).\n3. Support aileron and remove hinge bolts (3 hinges).\n4. Slide aileron aft and remove.\n\nINSTALLATION:\nReverse removal procedure. Torque hinge bolts to 100-140 in-lb. Reconnect push-pull tube. Verify full travel and rigging per paragraph 6-2.",
                    'page' => 137, 'sort_order' => 3,
                ],
            ],

            // ─── SECTION 7: WING FLAP CONTROL SYSTEM ────────────────
            '07' => [
                [
                    'paragraph_number' => '7-1',
                    'title' => 'Wing Flap System — Description',
                    'content' => "The Cessna 172 uses electrically actuated, single-slotted wing flaps. Flaps are operated by a flap motor connected to a screw-jack actuator via a gear drive. The flap position is selected by a switch in the cockpit and indicated on a position indicator.\n\nFlap positions: 0°, 10°, 20°, and 30° (FULL). The system is protected by a circuit breaker on the instrument panel.",
                    'page' => 146, 'sort_order' => 1,
                ],
                [
                    'paragraph_number' => '7-2',
                    'title' => 'Flap Rigging and Travel',
                    'content' => "FLAP TRAVEL LIMITS:\n• 0° (UP): Full retracted\n• 10° (APPROACH): 10° ±1°\n• 20° (APPROACH): 20° ±1°\n• 30° (FULL): 30° ±1°\n\nRIGGING CHECK:\n1. With flaps UP and electrical power ON, select each flap position.\n2. Verify travel with protractor at flap trailing edge.\n3. Adjust flap limit switches if travel is out of tolerance.\n4. Check that flaps are symmetrical — both flaps must be within 1° of each other at each position.",
                    'page' => 149, 'sort_order' => 2,
                ],
                [
                    'paragraph_number' => '7-3',
                    'title' => 'Flap Motor and Actuator — Maintenance',
                    'content' => "The flap motor is located under the rear baggage shelf. Access by removing the baggage shelf panel.\n\nINSPECTION:\n1. Check motor brushes for wear — replace when worn to 1/2 original length.\n2. Inspect actuator screw threads for wear and corrosion — lubricate with MIL-G-7711.\n3. Check electrical connections for security and corrosion.\n4. Verify circuit breaker (7.5 amp) for proper size and condition.",
                    'page' => 153, 'sort_order' => 3,
                ],
            ],

            // ─── SECTION 8: ELEVATOR CONTROL SYSTEM ─────────────────
            '08' => [
                [
                    'paragraph_number' => '8-1',
                    'title' => 'Elevator System — Description',
                    'content' => "Elevator control is achieved through a push-pull tube from the control column to a bellcrank at the fuselage tail. From the bellcrank, a push-pull tube connects to the elevator.\n\nThe system is designed to provide positive pitch control throughout the certified flight envelope. The elevator is connected to the horizontal stabilizer by three hinge assemblies.",
                    'page' => 161, 'sort_order' => 1,
                ],
                [
                    'paragraph_number' => '8-2',
                    'title' => 'Elevator Rigging — Travel Limits',
                    'content' => "ELEVATOR TRAVEL LIMITS:\n• Up deflection: 28° (+1°, -0°)\n• Down deflection: 23° (+1°, -0°)\n\nRIGGING PROCEDURE:\n1. Level aircraft.\n2. Set elevator to neutral (trailing edge aligned with stabilizer).\n3. Check control column push-pull tube length.\n4. Verify travel at control column and at elevator.\n5. Adjust stop bolts at fuselage bellcrank if necessary.",
                    'page' => 164, 'sort_order' => 2,
                ],
                [
                    'paragraph_number' => '8-3',
                    'title' => 'Elevator Hinge — Inspection and Replacement',
                    'content' => "Elevator hinges must be inspected at each 100-hour and annual inspection.\n\nALLOWABLE FREEPLAY: Maximum 0.025 inch measured at trailing edge.\n\nIf freeplay exceeds limit:\n1. Remove elevator (3 hinge bolts).\n2. Inspect hinge bearings for wear and corrosion.\n3. Replace worn hinge assemblies — do not attempt to repair.\n4. Reinstall elevator, torque hinge bolts to 100-140 in-lb.\n5. Re-rig per paragraph 8-2.",
                    'page' => 168, 'sort_order' => 3,
                ],
            ],

            // ─── SECTION 9: ELEVATOR TRIM TAB CONTROL ───────────────
            '09' => [
                [
                    'paragraph_number' => '9-1',
                    'title' => 'Elevator Trim Tab — Description',
                    'content' => "The elevator trim tab is mounted on the inboard trailing edge of the right elevator. It is actuated by a screw drive connected by a cable to the trim wheel located between the front seats.\n\nA trim position indicator is provided on the instrument panel or as a placard. Trim tab neutral position (take-off trim) should be established and marked during annual rigging check.",
                    'page' => 176, 'sort_order' => 1,
                ],
                [
                    'paragraph_number' => '9-2',
                    'title' => 'Trim Tab Rigging and Travel',
                    'content' => "TRIM TAB TRAVEL LIMITS:\n• Nose down trim: 13° (+1°, -0°) from neutral\n• Nose up trim: 28° (+1°, -0°) from neutral\n\nTo adjust: Turn trim wheel to full nose-up, then to full nose-down. Measure travel with protractor. Adjust cable length at turnbuckle if out of limits. Trim wheel rotation: approximately 13 turns from full up to full down.",
                    'page' => 178, 'sort_order' => 2,
                ],
            ],

            // ─── SECTION 10: RUDDER CONTROL SYSTEM ──────────────────
            '10' => [
                [
                    'paragraph_number' => '10-1',
                    'title' => 'Rudder System — Description',
                    'content' => "Rudder control is provided by rudder pedals in the cockpit connected to the rudder by cables routed through the fuselage. The rudder pedals also control the nose wheel steering through a spring-loaded centering cam mechanism.\n\nNose wheel steering authority is limited to ±30° from center. Full rudder deflection provides ±16° (some models ±20°) of rudder movement.",
                    'page' => 186, 'sort_order' => 1,
                ],
                [
                    'paragraph_number' => '10-2',
                    'title' => 'Rudder Rigging — Travel and Cable Tension',
                    'content' => "RUDDER TRAVEL LIMITS:\n• Right deflection: 16° (+1°, -0°)\n• Left deflection: 16° (+1°, -0°)\n\nCABLE TENSION: 40-50 lbs at 70°F (standard locking safety cable).\n\nRIGGING:\n1. Level aircraft.\n2. Set rudder pedals to neutral.\n3. Check cable tension with tensiometer.\n4. Adjust turnbuckles equally on both sides to maintain neutral rudder position.\n5. Safety wire all turnbuckles after adjustment.",
                    'page' => 190, 'sort_order' => 2,
                ],
                [
                    'paragraph_number' => '10-3',
                    'title' => 'Nose Wheel Steering — Adjustment',
                    'content' => "The nose wheel is connected to the rudder pedals by a spring-loaded steering mechanism. The mechanism is designed to prevent shimmy and provide positive steering.\n\nSHIMMY DAMPENER: If nose wheel shimmy occurs, inspect shimmy dampener fluid level and condition. Fill with MIL-H-5606 hydraulic fluid. Replace if leaking.\n\nSteering alignment: With rudder pedals neutral, nose wheel must be centered within 0.5°.",
                    'page' => 194, 'sort_order' => 3,
                ],
            ],

            // ─── SECTION 11A: ENGINE — CONTINENTAL ──────────────────
            '11A' => [
                [
                    'paragraph_number' => '11A-1',
                    'title' => 'Continental Engine — Description (Reims F172)',
                    'content' => "Reims Aviation F172 variants are powered by the Continental O-300-D or O-300-E engine (145 HP at 2700 RPM). This horizontally-opposed, air-cooled, 6-cylinder engine differs from the Lycoming O-320 used in standard 172 variants.\n\nKey specifications:\n• Displacement: 301 cubic inches (4.9L)\n• Compression ratio: 7.0:1\n• Fuel grade: 80/87 minimum (100 LL compatible)\n• Oil capacity: 8 quarts (drain and fill capacity)",
                    'page' => 251, 'sort_order' => 1,
                ],
                [
                    'paragraph_number' => '11A-2',
                    'title' => 'Continental Engine — Ignition System',
                    'content' => "The ignition system consists of two Bendix magnetos (S4LN-20 series) and 12 Champion RHB-32E spark plugs. Both magnetos fire simultaneously on both the top and bottom spark plugs.\n\nMAGNETO TIMING: 26° BTC (Before Top Center) for both magnetos.\nSPARK PLUG GAP: 0.018-0.022 inch.\nOIL PRESSURE: Normal — 30-60 PSI in flight; minimum 10 PSI at idle.",
                    'page' => 258, 'sort_order' => 2,
                ],
                [
                    'paragraph_number' => '11A-3',
                    'title' => 'Continental Engine — Oil System Servicing',
                    'content' => "ENGINE OIL:\n• Minimum grade: Ashless Dispersant (AD) SAE 50 above 40°F\n• Multi-viscose: SAE 20W-50 for wide temperature ranges\n• Change interval: Every 50 hours (or every 4 months if less)\n• Oil filter: Champion CH48104 — replace at each oil change\n\nOIL SYSTEM CAPACITY: 8 quarts total (6 usable). Maintain level between 5-6 quarts for normal flight operations.",
                    'page' => 262, 'sort_order' => 3,
                ],
            ],

            // ─── SECTION 13: PROPELLER ───────────────────────────────
            '13' => [
                [
                    'paragraph_number' => '13-1',
                    'title' => 'Propeller — Description and Data',
                    'content' => "The standard propeller for the Cessna 172 is a fixed-pitch, two-blade, aluminum alloy propeller manufactured by McCauley (Model 1C172/BTM7553 or similar).\n\nPROPELLER DATA:\n• Diameter: 75 inches (190.5 cm)\n• Pitch (at 42-inch station): 55 inches\n• Weight: Approximately 22 lbs\n• Static RPM (full throttle, level): 2260-2290\n• Maximum continuous RPM: 2700",
                    'page' => 306, 'sort_order' => 1,
                ],
                [
                    'paragraph_number' => '13-2',
                    'title' => 'Propeller Removal and Installation',
                    'content' => "REMOVAL:\n1. Remove spinner and backing plate (8 screws).\n2. Remove 6 propeller flange bolts (5/16 inch).\n3. Carefully slide propeller off shaft — it weighs approximately 22 lbs.\n\nINSTALLATION:\n1. Clean propeller flange and crankshaft flange mating surfaces.\n2. Slide propeller onto flange.\n3. Install new self-locking bolts (DO NOT reuse old bolts).\n4. Torque bolts to 45-50 ft-lb in a star pattern.\n5. Safety wire all bolts per standard procedure.",
                    'page' => 309, 'sort_order' => 2,
                ],
                [
                    'paragraph_number' => '13-3',
                    'title' => 'Propeller Inspection — Damage Limits',
                    'content' => "INSPECT PROPELLER AT EACH 100-HOUR INSPECTION:\n\nACCEPTABLE DAMAGE (may be dressed with fine file or sandpaper):\n• Nicks and scratches less than 1/8 inch deep on leading edge\n• Minor surface corrosion\n• Small dents not extending to blade cuff\n\nREQUIRES REMOVAL FOR REPAIR OR REPLACEMENT:\n• Cracks of any size\n• Nicks deeper than 1/8 inch\n• Bent or twisted blade\n• Damage within 6 inches of blade tip\n• Any propeller involved in a ground strike",
                    'page' => 313, 'sort_order' => 3,
                ],
            ],

            // ─── SECTION 14: UTILITY SYSTEMS ─────────────────────────
            '14' => [
                [
                    'paragraph_number' => '14-1',
                    'title' => 'Brake System — Description and Servicing',
                    'content' => "The Cessna 172 is equipped with Mc Cauley or Cleveland single-disc hydraulic brakes on the main gear. Each main gear wheel has an independent brake operated by toe-operated pedals on both sets of rudder pedals.\n\nFLUID: MIL-H-5606 red hydraulic fluid.\nRESERVOIR: Located behind the firewall, left side. Check level through sight glass — level must be between MIN and MAX marks.\n\nBRAKE FLUSHING: Flush system every 200 hours or if fluid appears contaminated.",
                    'page' => 321, 'sort_order' => 1,
                ],
                [
                    'paragraph_number' => '14-2',
                    'title' => 'Pitot-Static System — Inspection and Leak Test',
                    'content' => "The pitot-static system provides pressure source for the airspeed indicator, altimeter, and vertical speed indicator.\n\nPITOT TUBE: Inspect for blockage (insects, moisture) before each flight. Tube is heated by an electric element — check heater operation before IFR flight.\n\nLEAK TEST PROCEDURE (per FAR 91.411):\nThe static system must be tested for leaks every 24 months for IFR flight. Test with calibrated leak tester. Maximum allowable leak: equivalent to 100 feet altitude loss in one minute.",
                    'page' => 325, 'sort_order' => 2,
                ],
                [
                    'paragraph_number' => '14-3',
                    'title' => 'Stall Warning System — Testing',
                    'content' => "A pneumatic stall warning device is installed in the leading edge of the left wing. The vane-actuated horn sounds approximately 5-10 knots above stall speed.\n\nTESTING:\n1. With engine running at idle.\n2. Slowly raise flap or carefully lift warning vane with a pencil.\n3. Horn should sound. If not, check wiring from wing to cockpit speaker/horn.\n4. Replace vane actuator if bent or corroded.\n\nWARNING: Do not obstruct vane opening during preflight cleaning.",
                    'page' => 330, 'sort_order' => 3,
                ],
            ],

            // ─── SECTION 15: INSTRUMENTS ─────────────────────────────
            '15' => [
                [
                    'paragraph_number' => '15-1',
                    'title' => 'Instrument Panel — Description',
                    'content' => "The instrument panel provides mounting for all flight, engine, and navigation instruments. The panel is mounted to the firewall and instrument sub-panel via vibration-isolating mounts to minimize engine vibration transmission to sensitive instruments.\n\nGYRO INSTRUMENTS (AI, DI, TC) are vacuum-driven from an engine-driven vacuum pump or venturi tube. Vacuum system nominal operating range: 4.5-5.5 in. Hg.",
                    'page' => 341, 'sort_order' => 1,
                ],
                [
                    'paragraph_number' => '15-2',
                    'title' => 'Instrument Removal and Installation',
                    'content' => "GENERAL PRECAUTIONS:\n• Always disconnect aircraft power before removing instruments.\n• Cap all pneumatic lines immediately after disconnection to prevent foreign object ingestion.\n• Handle gyro instruments carefully — do not invert or shake while spinning.\n\nREMOVAL:\n1. Remove screws from instrument bezel (usually 3 or 4).\n2. Carefully pull instrument straight out.\n3. Disconnect electrical connectors and pneumatic lines.\n4. Cap lines and label connectors for reinstallation.\n\nInstallation is the reverse of removal.",
                    'page' => 344, 'sort_order' => 2,
                ],
                [
                    'paragraph_number' => '15-3',
                    'title' => 'Vacuum System — Inspection and Service',
                    'content' => "VACUUM PUMP (dry-type): Engine-driven, pad-mounted pump provides vacuum for gyro instruments.\n\nVACUUM FILTER: Replace every 500 hours or at first indication of gyro instability.\n\nVACUUM GAUGE: Must read 4.5-5.5 in. Hg in cruise flight with all vacuum instruments operating. Low vacuum may indicate:\n• Worn or failed vacuum pump (replace pump)\n• Clogged vacuum filter (replace filter)\n• Leaking vacuum lines (inspect all line connections)",
                    'page' => 348, 'sort_order' => 3,
                ],
            ],

            // ─── SECTION 17: ELECTRONIC SYSTEMS ─────────────────────
            '17' => [
                [
                    'paragraph_number' => '17-1',
                    'title' => 'Electronic Systems — Notice (Section Deleted)',
                    'content' => "NOTE: Section 17 (Electronic Systems) was deleted from the Cessna 172-Series Service Manual (D1232-13) with the 1975 revision. Electronic equipment varies greatly between aircraft and is governed by the specific equipment manufacturer's installation and maintenance manuals.\n\nFor radio and avionics maintenance:\n• Refer to individual equipment manufacturer's manuals.\n• Avionics repairs must be performed by certified avionics technicians.\n• Inspect antenna mounts and coax connections at each annual inspection.\n• Follow applicable TSO and STC documentation for all installed equipment.",
                    'page' => 376, 'sort_order' => 1,
                ],
            ],

            // ─── SECTION 18: STRUCTURAL REPAIR ──────────────────────
            '18' => [
                [
                    'paragraph_number' => '18-1',
                    'title' => 'Structural Repair — General Principles',
                    'content' => "All structural repairs must comply with FAA Advisory Circular AC 43.13-1B (Aircraft Inspection, Repair & Alterations) unless a specific repair method is described in this section.\n\nPRINCIPLES:\n• Restore original strength — do not add unnecessary weight.\n• Use the same material as the original unless approved substitutes are available.\n• All repairs to primary structure require inspection by an authorized mechanic with IA authorization.\n• Document all repairs on FAA Form 337 if required.",
                    'page' => 377, 'sort_order' => 1,
                ],
                [
                    'paragraph_number' => '18-2',
                    'title' => 'Sheet Metal Repair — Acceptable Methods',
                    'content' => "SKIN REPAIRS — SMALL HOLES AND DENTS:\n• Holes under 1 inch: Fill with flush patch of same alloy, same or greater thickness.\n• Holes 1-3 inches: Use internal doubler plate of same material, 1.5× surrounding area.\n• Dents without cracks: Can remain if less than 1/10 depth of adjacent skin.\n\nMATERIAL: Match original 2024-T3 or 6061-T6 aluminum alloy. Rivets: MS20470AD or MS20426AD as applicable.\n\nNEVER use pop rivets for structural repairs without engineering approval.",
                    'page' => 381, 'sort_order' => 2,
                ],
                [
                    'paragraph_number' => '18-3',
                    'title' => 'Corrosion Control and Treatment',
                    'content' => "CORROSION TYPES:\n• Surface (white powder on aluminum): Remove with Scotch-Brite pad, treat with Alodine 1201, reprime.\n• Pitting corrosion: Must be assessed for depth — if pitting exceeds 10% of material thickness, replace affected part.\n• Intergranular corrosion: Identified by flaking layers — replace affected structure.\n\nCORROSION TREATMENT:\n1. Remove corrosion products mechanically.\n2. Treat with chemical conversion coating (Alodine or equivalent).\n3. Apply primer (zinc chromate or equivalent approved primer).\n4. Apply finish coat to restore aerodynamic surface.",
                    'page' => 387, 'sort_order' => 3,
                ],
            ],

            // ─── SECTION 19: PAINTING ────────────────────────────────
            '19' => [
                [
                    'paragraph_number' => '19-1',
                    'title' => 'Painting — Surface Preparation',
                    'content' => "Proper surface preparation is critical for paint adhesion and corrosion protection. All surfaces must be thoroughly cleaned before painting.\n\nSURFACE PREPARATION PROCEDURE:\n1. Wash surface with aliphatic naptha or MEK to remove grease and oils.\n2. Lightly sand with 220-grit sandpaper.\n3. Apply chemical conversion coating (Alodine 1201) to bare aluminum.\n4. Allow to dry completely (minimum 30 minutes at 70°F).\n5. Apply zinc chromate primer or approved equivalent.\n6. Allow primer to cure before applying finish coat.",
                    'page' => 396, 'sort_order' => 1,
                ],
                [
                    'paragraph_number' => '19-2',
                    'title' => 'Topcoat Application — Specifications',
                    'content' => "CESSNA-APPROVED FINISH SYSTEMS:\n• Polyurethane enamel (recommended): Provides best gloss retention and chemical resistance.\n• Acrylic lacquer: Easier application but less durable.\n\nAPPLICATION EQUIPMENT:\n• Spray gun: DeVilbiss JGA-502 or equivalent.\n• Reduction: Per manufacturer's specifications for temperature and humidity.\n• Film thickness: 1.5-2.5 mils dry film thickness.\n\nDo not apply paint at temperatures below 50°F or above 90°F, or when relative humidity exceeds 85%.",
                    'page' => 399, 'sort_order' => 2,
                ],
            ],
        ];

        $inserted = 0;
        foreach ($data as $sectionNum => $subsections) {
            $section = $sections->get($sectionNum);
            if (!$section) {
                $this->command->warn("Section §$sectionNum not found — skipping.");
                continue;
            }
            // Only add if section has no subsections yet
            $existingCount = Subsection::where('section_id', $section->id)->count();
            foreach ($subsections as $sub) {
                Subsection::updateOrCreate(
                    ['section_id' => $section->id, 'paragraph_number' => $sub['paragraph_number']],
                    [
                        'title'      => $sub['title'],
                        'content'    => $sub['content'],
                        'page'       => $sub['page'],
                        'sort_order' => $sub['sort_order'],
                    ]
                );
                $inserted++;
            }
        }
        $this->command->info("Inserted/updated $inserted subsections across 14 sections.");
    }
}
