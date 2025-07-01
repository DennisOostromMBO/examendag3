<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoodwishFamilySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('foodwish_family')->insert([
            ['id' => 1, 'family_id' => 1, 'foodwish_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'family_id' => 2, 'foodwish_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'family_id' => 3, 'foodwish_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'family_id' => 4, 'foodwish_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'family_id' => 5, 'foodwish_id' => 2, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
