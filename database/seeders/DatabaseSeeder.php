<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ProductsFilterValue;
use Illuminate\Database\Seeder;

use function Pest\Laravel\call;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // $this->call([AdminTableSeeder::class]);
        // $this->call([VendorTableSeeder::class]);
        // $this->call([VendorsBusinessDetailsTableSeeder::class]);
        // $this->call([VendorsBankDetailsTableSeeder::class]);
        // $this->call([CountrySeeder::class]);
        // $this->call([SectionsTableseeder::class]);
        // $this->call([CategoriesTableSeeder::class]);
        // $this->call([BrandsTableSeeder::class]);
        // $this->call([ProductsTableSeeder::class]);
        // $this->call([ProductAttributeTabelSeeder::class]);
        // $this->call([BannerTableSeeder::class]);
        $this->call([ProductsFilterTableSeeder::class]);
        // $this->call([ProductsFilterValueTableSeeder::class]);


    }
}
