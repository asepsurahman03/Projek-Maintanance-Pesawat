<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ManualSeeder::class,
            SectionSeeder::class,
            SubsectionSeeder::class,
            FigureSeeder::class,
            AircraftModelSeeder::class,
            SpecificationSeeder::class,
            InspectionSeeder::class,
        ]);
    }
}
