<?php

namespace Database\Seeders;

use App\Models\ProductsFilterValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsFilterValueTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $FilterValue = [
            ['id' => 1,'filter_id' => 1,'filter_value' => 'cotton','status' => 1],
            ['id' => 2,'filter_id' => 1,'filter_value' => 'polyester','status' => 1],
            ['id' => 3,'filter_id' => 2,'filter_value' => '4 GB','status' => 1],
            ['id' => 4,'filter_id' => 2,'filter_value' => '8 GB','status' => 1],
        ];
        ProductsFilterValue::insert($FilterValue);
    }
}
