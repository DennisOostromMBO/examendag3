<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoodparcelSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('foodparcels')->insert([
            [
                'id' => 1,
                'family_id' => 1,
                'parcel_number' => 1,
                'composition_date' => '2024-04-06',
                'issue_date' => '2024-04-07',
                'status' => 'Uitgereikt',
                'is_active' => true,
                'note' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'family_id' => 1,
                'parcel_number' => 2,
                'composition_date' => '2024-04-13',
                'issue_date' => null,
                'status' => 'NietUitgereikt',
                'is_active' => true,
                'note' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'family_id' => 1,
                'parcel_number' => 3,
                'composition_date' => '2024-04-20',
                'issue_date' => null,
                'status' => 'NietMeerIngeschreven',
                'is_active' => true,
                'note' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'family_id' => 2,
                'parcel_number' => 4,
                'composition_date' => '2024-04-06',
                'issue_date' => '2024-04-07',
                'status' => 'Uitgereikt',
                'is_active' => true,
                'note' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'family_id' => 2,
                'parcel_number' => 5,
                'composition_date' => '2024-04-13',
                'issue_date' => '2024-04-14',
                'status' => 'Uitgereikt',
                'is_active' => true,
                'note' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'family_id' => 2,
                'parcel_number' => 6,
                'composition_date' => '2024-04-20',
                'issue_date' => null,
                'status' => 'NietUitgereikt',
                'is_active' => true,
                'note' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
