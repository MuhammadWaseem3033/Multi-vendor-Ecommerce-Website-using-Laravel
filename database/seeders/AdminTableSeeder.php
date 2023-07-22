<?php

namespace Database\Seeders;

use App\Models\Admin;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminTables = [
            [
                'id' => 1,
                'name' => 'admin',
                'type' => 'superadmin',
                'vendor_id' => 0,
                'mobile' => '03406523132',
                'email' => 'admin@admin.com',
                'password' => Hash::make('password'),
                'image' => '',
                'status' => 1,
            ],
            [
                'id' => 2,
                'name' => 'john',
                'type' => 'vendor',
                'vendor_id' => 1,
                'mobile' => '03406523132',
                'email' => 'john@admin.com',
                'password' => Hash::make('password'),
                'image' => '',
                'status' => 1,
            ],
           
        ];
        Admin::insert($adminTables);
    }
}
