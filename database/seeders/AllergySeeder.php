<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AllergySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('allergies')->insert([
            [
                'name' => 'Gluten',
                'description' => 'Allergisch voor gluten',
                'anaphylactic_risk' => 'zeer laag',
                'is_active' => true,
                'note' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pinda\'s',
                'description' => 'Allergisch voor pinda\'s',
                'anaphylactic_risk' => 'hoog',
                'is_active' => true,
                'note' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Schaaldieren',
                'description' => 'Allergisch voor schaaldieren',
                'anaphylactic_risk' => 'redelijk hoog',
                'is_active' => true,
                'note' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hazelnoten',
                'description' => 'Allergisch voor hazelnoten',
                'anaphylactic_risk' => 'laag',
                'is_active' => true,
                'note' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lactose',
                'description' => 'Allergisch voor lactose',
                'anaphylactic_risk' => 'zeer laag',
                'is_active' => true,
                'note' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Soja',
                'description' => 'Allergisch voor soja',
                'anaphylactic_risk' => 'zeer laag',
                'is_active' => true,
                'note' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
