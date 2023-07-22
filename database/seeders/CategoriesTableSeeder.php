<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryRecord = [
            [
                'id'=> 1, 'category_name'=>'Man','category_image'=>'image.jpg','url'=>'url.com','parent_id'=>'0','section_id'=>'1','meta_title'=>'fjdkjdk',
                'category_discount'=>'0.1','description'=>'jfkjdjkff','meta_description'=>'dowos,sedddc','meta_keywords'=>'oeiwie','status'=>'1',
            ],
            [
                'id'=> 2, 'category_name'=>'Woman','category_image'=>'image.jpg','url'=>'url.com','parent_id'=>'0','section_id'=>'1','meta_title'=>'fjdkjdk',
                'category_discount'=>'0.1','description'=>'jfkjdjkff','meta_description'=>'dowos,sedddc','meta_keywords'=>'oeiwie','status'=>'1',
            ],
            [
                'id'=> 3, 'category_name'=>'Kinds','category_image'=>'image.jpg','url'=>'url.com','parent_id'=>'0','section_id'=>'1','meta_title'=>'fjdkjdk',
                'category_discount'=>'0.1','description'=>'jfkjdjkff','meta_description'=>'dowos,sedddc','meta_keywords'=>'oeiwie','status'=>'1',
            ],
        ];
        Category::insert($categoryRecord);
    }
}
