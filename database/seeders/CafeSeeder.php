<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CafeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cafes')->insert([
            'name' => 'Copper',
            'phone' => '',
            'address' => 'Cevizlik Mah. Dantelacı Sk. No:5/A Bakirköy/İstanbul',
            'address_link' => '',
            'insta_name' => 'copper_cafe',
            'insta_link' => '',
            'description' => '',
            'opening_time' => '10:00',
            'closing_time' => '23:00',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
