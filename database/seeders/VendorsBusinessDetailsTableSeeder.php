<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VendorsBusinessDetail;
class VendorsBusinessDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendorBusinessDetails = 
        [
            [
                'vendor_id'=>1,
                'shop_name'=>'Rana Mobile Zone',
                'shop_address'=>'jatoi',
                'shop_city'=>'dgkhan',
                'shop_state'=> 'punjab',
                'shop_country' => 'pakistan',
                'shop_pincode' => 'ccf-101',
                'shop_mobile' => '03406523132',
                'shop_website' => 'Webmake.com',
                'shop_email' => 'john@admin.com',
                'address_proof' => 'Passport',
                'address_proof_image' =>'test.jpg' ,
                'business_licens_number' => '123456789',
                'gst_number' => '123456789',
                'pan_number' => '123456789',
            ],
        ];
        VendorsBusinessDetail::insert($vendorBusinessDetails);
        
    }
}
