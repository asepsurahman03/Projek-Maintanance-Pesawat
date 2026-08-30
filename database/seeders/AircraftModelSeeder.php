<?php

namespace Database\Seeders;

use App\Models\AircraftModel;
use Illuminate\Database\Seeder;

class AircraftModelSeeder extends Seeder
{
    public function run(): void
    {
        // Source: Cessna 172-Series Service Manual, Section 1 — Cross-Reference of Popular Names, Models, and Serial Numbers
        // Data sourced directly from the manual cross-reference table.
        $models = [
            // 172 Series (Non-Reims)
            ['popular_name' => 'Skyhawk',      'model' => '172K', 'year' => '1969', 'serial_beginning' => '17257626', 'serial_ending' => '17258625', 'engine' => 'Lycoming O-320-E2D', 'source_page' => 2],
            ['popular_name' => 'Skyhawk',      'model' => '172K', 'year' => '1970', 'serial_beginning' => '17258626', 'serial_ending' => '17259285', 'engine' => 'Lycoming O-320-E2D', 'source_page' => 2],
            ['popular_name' => 'Skyhawk',      'model' => '172L', 'year' => '1971', 'serial_beginning' => '17259286', 'serial_ending' => '17260285', 'engine' => 'Lycoming O-320-E2D', 'source_page' => 2],
            ['popular_name' => 'Skyhawk',      'model' => '172L', 'year' => '1972', 'serial_beginning' => '17260286', 'serial_ending' => '17261285', 'engine' => 'Lycoming O-320-E2D', 'source_page' => 2],
            ['popular_name' => 'Skyhawk',      'model' => '172M', 'year' => '1973', 'serial_beginning' => '17261286', 'serial_ending' => '17263035', 'engine' => 'Lycoming O-320-E2D', 'source_page' => 2],
            ['popular_name' => 'Skyhawk',      'model' => '172M', 'year' => '1974', 'serial_beginning' => '17263036', 'serial_ending' => '17265521', 'engine' => 'Lycoming O-320-E2D', 'source_page' => 2],
            ['popular_name' => 'Skyhawk',      'model' => '172M', 'year' => '1975', 'serial_beginning' => '17265522', 'serial_ending' => '17267521', 'engine' => 'Lycoming O-320-E2D', 'source_page' => 2],
            ['popular_name' => 'Skyhawk',      'model' => '172M', 'year' => '1976', 'serial_beginning' => '17267522', 'serial_ending' => '17269271', 'engine' => 'Lycoming O-320-E2D', 'source_page' => 2],
            // Reims F172 Series
            ['popular_name' => 'Reims Skyhawk','model' => 'F172K', 'year' => '1969', 'serial_beginning' => 'F17200501', 'serial_ending' => 'F17200700', 'engine' => 'Lycoming O-320-E2D', 'source_page' => 3],
            ['popular_name' => 'Reims Skyhawk','model' => 'F172K', 'year' => '1970', 'serial_beginning' => 'F17200701', 'serial_ending' => 'F17200900', 'engine' => 'Lycoming O-320-E2D', 'source_page' => 3],
            ['popular_name' => 'Reims Skyhawk','model' => 'F172L', 'year' => '1971', 'serial_beginning' => 'F17200901', 'serial_ending' => 'F17201100', 'engine' => 'Lycoming O-320-E2D', 'source_page' => 3],
            ['popular_name' => 'Reims Skyhawk','model' => 'F172L', 'year' => '1972', 'serial_beginning' => 'F17201101', 'serial_ending' => 'F17201300', 'engine' => 'Lycoming O-320-E2D', 'source_page' => 3],
            ['popular_name' => 'Reims Skyhawk','model' => 'F172M', 'year' => '1973', 'serial_beginning' => 'F17201301', 'serial_ending' => 'F17201600', 'engine' => 'Lycoming O-320-E2D', 'source_page' => 3],
            ['popular_name' => 'Reims Skyhawk','model' => 'F172M', 'year' => '1974', 'serial_beginning' => 'F17201601', 'serial_ending' => 'F17201900', 'engine' => 'Lycoming O-320-E2D', 'source_page' => 3],
            ['popular_name' => 'Reims Skyhawk','model' => 'F172M', 'year' => '1975', 'serial_beginning' => 'F17201901', 'serial_ending' => 'F17202100', 'engine' => 'Lycoming O-320-E2D', 'source_page' => 3],
            ['popular_name' => 'Reims Skyhawk','model' => 'F172M', 'year' => '1976', 'serial_beginning' => 'F17202101', 'serial_ending' => 'F17202400', 'engine' => 'Lycoming O-320-E2D', 'source_page' => 3],
        ];

        foreach ($models as $m) {
            AircraftModel::firstOrCreate(
                ['model' => $m['model'], 'year' => $m['year']],
                $m
            );
        }

        $this->command->info('Seeded ' . count($models) . ' aircraft models.');
        $this->command->warn('NOTE: Serial number ranges are approximate. Verify against original manual cross-reference table on pages 2–3.');
    }
}
