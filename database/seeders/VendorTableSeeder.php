<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vendor;
class VendorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendorRecord = [
            [
                'id'=> 1,
                'name' => 'john',
                'address' => 'jatoi',
                'city' => 'dgkhan',
                'state' => 'punjab',
                'country' => 'pakistan',
                'pincode' => 'ccf-101',
                'mobile' => '03406523132',
                'email' => 'john@admin.com',
                'status' => 0,
            ]
        ];
        Vendor::insert($vendorRecord);

    }
}
