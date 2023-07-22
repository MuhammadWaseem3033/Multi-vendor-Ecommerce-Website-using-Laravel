<?php

namespace Database\Seeders;

use App\Models\Products_Attribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductAttributeTabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productTableSeeder = [
            [
                'id'=>1,
                 'product_id'=>2,
                 'size'=>'small',
                 'price'=>1000,
                 'stock'=>10,
                 'sku'=>'Reejj-S',
                 'status'=>1,
            ],
            [
                'id'=>2,
                 'product_id'=>2,
                 'size'=>'medium',
                 'price'=>1000,
                 'stock'=>10,
                 'sku'=>'Reejj-M',
                 'status'=>1,
            ],
            [
                'id'=>3,
                 'product_id'=>2,
                 'size'=>'large',
                 'price'=>1000,
                 'stock'=>10,
                 'sku'=>'Reejj-L',
                 'status'=>1,
            ],
        ];
        Products_Attribute::insert($productTableSeeder);
    }
}
