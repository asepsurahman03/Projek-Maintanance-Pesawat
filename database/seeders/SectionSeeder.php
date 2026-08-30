<?php

namespace Database\Seeders;

use App\Models\Manual;
use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    public function run(): void
    {
        $manual = Manual::where('title', 'Cessna 172-Series Service Manual')->firstOrFail();

        // Source: Cessna 172-Series Service Manual Table of Contents
        $sections = [
            ['number' => '01',  'title' => 'GENERAL DESCRIPTION',                              'slug' => null,             'page_start' => 1,   'page_end' => 24,  'sort' => 1,
             'description' => 'General description, aircraft dimensions, general specifications, aircraft certification, and cross-reference of popular names, models, and serial numbers.'],
            ['number' => '02',  'title' => 'GROUND HANDLING, SERVICING, CLEANING, LUBRICATION & INSPECTION',
             'slug' => null, 'page_start' => 25, 'page_end' => 60, 'sort' => 2,
             'description' => 'Procedures for ground handling, fueling, oil servicing, cleaning, lubrication, and inspection intervals.'],
            ['number' => '03',  'title' => 'FUSELAGE',                                         'slug' => null,             'page_start' => 61,  'page_end' => 80,  'sort' => 3,
             'description' => 'Fuselage structure, removal and installation procedures.'],
            ['number' => '04',  'title' => 'WINGS & EMPENNAGE',                                'slug' => null,             'page_start' => 81,  'page_end' => 100, 'sort' => 4,
             'description' => 'Wing and empennage removal, installation, and repair procedures.'],
            ['number' => '05',  'title' => 'LANDING GEAR & BRAKES',                            'slug' => 'landing-gear',   'page_start' => 101, 'page_end' => 130, 'sort' => 5,
             'description' => 'Main gear, nose gear, brake system, and tire service.'],
            ['number' => '06',  'title' => 'AILERON CONTROL SYSTEM',                           'slug' => 'flight-controls','page_start' => 131, 'page_end' => 145, 'sort' => 6,
             'description' => 'Aileron removal, installation, rigging, and adjustment.'],
            ['number' => '07',  'title' => 'WING FLAP CONTROL SYSTEM',                         'slug' => null,             'page_start' => 146, 'page_end' => 160, 'sort' => 7,
             'description' => 'Wing flap system removal, installation, and adjustment procedures.'],
            ['number' => '08',  'title' => 'ELEVATOR CONTROL SYSTEM',                          'slug' => null,             'page_start' => 161, 'page_end' => 175, 'sort' => 8,
             'description' => 'Elevator removal, installation, rigging, and adjustment.'],
            ['number' => '09',  'title' => 'ELEVATOR TRIM TAB CONTROL SYSTEM',                 'slug' => null,             'page_start' => 176, 'page_end' => 185, 'sort' => 9,
             'description' => 'Elevator trim tab system removal, installation, and adjustment.'],
            ['number' => '10',  'title' => 'RUDDER CONTROL SYSTEM',                            'slug' => null,             'page_start' => 186, 'page_end' => 200, 'sort' => 10,
             'description' => 'Rudder and rudder control cable removal, installation, and rigging.'],
            ['number' => '11',  'title' => 'ENGINE — LYCOMING "BLUE-STREAK"',                  'slug' => 'engine',         'page_start' => 201, 'page_end' => 250, 'sort' => 11,
             'description' => 'Lycoming O-320-E series air-cooled, wet-sump, four-cylinder, horizontally-opposed, direct-drive, carbureted engine. Removal, installation, troubleshooting, and maintenance.'],
            ['number' => '11A', 'title' => 'ENGINE — CONTINENTAL',                             'slug' => 'engine',         'page_start' => 251, 'page_end' => 285, 'sort' => 12,
             'description' => 'Continental engine removal, installation, troubleshooting, and maintenance procedures.'],
            ['number' => '12',  'title' => 'FUEL SYSTEM',                                      'slug' => 'fuel-system',    'page_start' => 286, 'page_end' => 305, 'sort' => 13,
             'description' => 'Fuel system, fuel tanks, fuel lines, fuel strainer, fuel selector valve, priming system, and carburetor.'],
            ['number' => '13',  'title' => 'PROPELLER',                                        'slug' => 'propeller',      'page_start' => 306, 'page_end' => 320, 'sort' => 14,
             'description' => 'Propeller removal, installation, inspection, and balance procedures.'],
            ['number' => '14',  'title' => 'UTILITY SYSTEMS',                                  'slug' => 'utility',        'page_start' => 321, 'page_end' => 340, 'sort' => 15,
             'description' => 'Heating and ventilating system, cabin windows, and utility system components.'],
            ['number' => '15',  'title' => 'INSTRUMENTS AND INSTRUMENT SYSTEMS',               'slug' => 'instruments',    'page_start' => 341, 'page_end' => 355, 'sort' => 16,
             'description' => 'Flight instruments, engine instruments, and instrument system maintenance.'],
            ['number' => '16',  'title' => 'ELECTRICAL SYSTEMS',                               'slug' => 'electrical',     'page_start' => 356, 'page_end' => 375, 'sort' => 17,
             'description' => 'Electrical system, battery, alternator, starter, switches, and wiring.'],
            ['number' => '17',  'title' => 'ELECTRONIC SYSTEMS — DELETED',                     'slug' => null,             'page_start' => 376, 'page_end' => 376, 'sort' => 18,
             'description' => 'Section 17 has been deleted from this edition of the manual.'],
            ['number' => '18',  'title' => 'STRUCTURAL REPAIR',                                'slug' => 'structural',     'page_start' => 377, 'page_end' => 395, 'sort' => 19,
             'description' => 'Structural repair procedures and allowable damage limits.'],
            ['number' => '19',  'title' => 'PAINTING',                                         'slug' => null,             'page_start' => 396, 'page_end' => 405, 'sort' => 20,
             'description' => 'Aircraft painting procedures, surface preparation, and finish systems.'],
            ['number' => '20',  'title' => 'WIRING DIAGRAMS',                                  'slug' => 'wiring',         'page_start' => 406, 'page_end' => 414, 'sort' => 21,
             'description' => 'Complete electrical wiring diagrams for all 172-Series variants covered in this manual.'],
        ];

        foreach ($sections as $s) {
            Section::firstOrCreate(
                ['manual_id' => $manual->id, 'section_number' => $s['number']],
                [
                    'title'       => $s['title'],
                    'description' => $s['description'],
                    'page_start'  => $s['page_start'],
                    'page_end'    => $s['page_end'],
                    'system_slug' => $s['slug'],
                    'sort_order'  => $s['sort'],
                ]
            );
        }

        $this->command->info('Seeded ' . count($sections) . ' sections.');
    }
}
