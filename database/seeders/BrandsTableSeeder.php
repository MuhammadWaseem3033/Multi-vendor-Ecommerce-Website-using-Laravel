<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $createBrands = [
            ['id' => '1', 'name' => 'Samsung', 'status' => 1],
            ['id' => '2', 'name' => 'Lenevo', 'status' => 1,],
            ['id' => '3', 'name' => 'Nokia', 'status' => 1,],
            ['id' => '4', 'name' => 'Armani', 'status' => 1,],
            ['id' => '5', 'name' => 'Gochi', 'status' => 1],
        ];
        Brand::insert($createBrands);
    }
}
