<?php

namespace Database\Seeders;

use App\Models\Manual;
use Illuminate\Database\Seeder;

class ManualSeeder extends Seeder
{
    public function run(): void
    {
        Manual::firstOrCreate(
            ['title' => 'Cessna 172-Series Service Manual'],
            [
                'subtitle'       => 'Skyhawk Series',
                'edition'        => '1975 Edition (Rev. 1)',
                'coverage_start' => '1969',
                'coverage_end'   => '1976',
                'source_file'    => 'cessna_172_1969-76_smv1975.pdf',
                'description'    => 'Factory-recommended procedures for ground handling, servicing, '
                    . 'inspection, and maintenance of Cessna 172-Series aircraft including '
                    . 'Cessna 172, Skyhawk, Reims 172, and Reims/Cessna F172.',
                'publisher'      => 'Cessna Aircraft Company',
                'part_number'    => 'D1232-13',
                'total_pages'    => 414,
            ]
        );
    }
}
