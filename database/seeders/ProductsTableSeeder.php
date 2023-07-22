<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $createProduct = 
        [
            [
                'id'=> 1,'product_name'=> 'Iphone 15 Pro Max','section_id'=>2,'category_id'=>22,'brand_id'=>8,
                'vendor_id'=>1,'admin_id'=>0,'admin_type'=>'vendor','product_code'=>'1423','product_color'=>'blue','product_price'=>'500000',
                'product_discount'=>'10','product_weight'=>'500','product_image'=>'','product_vedio'=>'','discription'=>'',
                'meta_title'=>'','meta_discription'=>'','meta_kaywords'=>'','is_featured'=>'Yes','status'=>'1',
            ],            
            [
                'id'=> 2,'product_name'=> 'Casual TShirt','section_id'=>1,'category_id'=>1,'brand_id'=>4,
                'vendor_id'=>0,'admin_id'=>1,'admin_type'=>'vendor','product_code'=>'1423','product_color'=>'blue','product_price'=>'500000',
                'product_discount'=>'10','product_weight'=>'500','product_image'=>'','product_vedio'=>'','discription'=>'',
                'meta_title'=>'','meta_discription'=>'','meta_kaywords'=>'','is_featured'=>'Yes','status'=>1,
            ],
        ];
        Product::insert($createProduct);
    }
}
