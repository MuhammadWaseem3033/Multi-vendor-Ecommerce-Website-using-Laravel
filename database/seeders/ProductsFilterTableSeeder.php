<?php

namespace Database\Seeders;

use App\Models\ProductsFilter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsFilterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prodcutFilter = [
            [
                'id'=>1,
                'cat_ids'=>'1,2,3,6,8',
                'filter_name'=>'Fabirc',
                'filter_culumn' => 'fabric',
                'status' => 1,
            ],
            [
                'id'=>2,
                'cat_ids'=>'4,5',
                'filter_name'=>'Ram',
                'filter_culumn' => 'ram',
                'status' => 1,
            ],
        ];
        ProductsFilter::insert($prodcutFilter);
    }
}
