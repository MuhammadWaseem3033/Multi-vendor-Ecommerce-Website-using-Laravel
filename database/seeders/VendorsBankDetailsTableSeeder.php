<?php

namespace Database\Seeders;

use App\Models\VendorsBankDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorsBankDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendorBusinessDetails = 
        [
            [
                'id'=>1,
                'vendor_id'=>1,
                'bank_name'=>'MCB',
                'account_holder_name' => 'Rana Waseem',
                'account_number' => '123456789',
                'bank_ifsc_code' => '7689', 
                
            ],
        ];
        VendorsBankDetail::insert($vendorBusinessDetails);
        
    }
}
