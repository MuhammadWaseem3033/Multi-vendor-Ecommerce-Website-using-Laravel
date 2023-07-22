<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Banner;
class BannerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $createBanner = [
            [
                'id'=>1,
                'image'=>'stack-developers.png',
                'link'=>'spring-collection',
                'title'=>'Tihs image for SEO Perpose',
                'alt'=>'images',
                'status'=>1,
            ]
        ];
        Banner::insert($createBanner);
    }
}
