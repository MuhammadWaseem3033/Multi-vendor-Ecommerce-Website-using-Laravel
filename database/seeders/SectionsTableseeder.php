<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionsTableseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sectionRecord = [
            
            [
                'id'=>1,
                'name'=> 'Clothing',
                'status' => 1,
            ],[
                'id'=>2,
                'name'=> 'Electronecs',
                'status' => 1,
            ],[
                'id'=>3,
                'name'=> 'Appliances',
                'status' => 1,
            ],
        ];
        Section::insert($sectionRecord);
    }
}
