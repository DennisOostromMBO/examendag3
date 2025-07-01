<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoodwishSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('foodwishes')->insert([
            [
                'id' => 1,
                'name' => 'Geen Varken',
                'description' => 'Geen Varkensvlees',
                'is_active' => true,
                'note' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Veganistisch',
                'description' => 'Geen zuivelproducten en vlees',
                'is_active' => true,
                'note' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Vegetarisch',
                'description' => 'Geen vlees',
                'is_active' => true,
                'note' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'Omnivoor',
                'description' => 'Geen beperkingen',
                'is_active' => true,
                'note' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
