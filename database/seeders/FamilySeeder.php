<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FamilySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('families')->insert([
            [
                'id' => 1,
                'name' => 'ZevenhuizenGezin',
                'code' => 'G0001',
                'description' => 'Bijstandsgezin',
                'adults' => 2,
                'children' => 2,
                'babies' => 0,
                'total_persons' => 4,
                'is_active' => true,
                'note' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'BergkampGezin',
                'code' => 'G0002',
                'description' => 'Bijstandsgezin',
                'adults' => 2,
                'children' => 1,
                'babies' => 1,
                'total_persons' => 4,
                'is_active' => true,
                'note' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'HeuvelGezin',
                'code' => 'G0003',
                'description' => 'Bijstandsgezin',
                'adults' => 2,
                'children' => 0,
                'babies' => 0,
                'total_persons' => 2,
                'is_active' => true,
                'note' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'ScherderGezin',
                'code' => 'G0004',
                'description' => 'Bijstandsgezin',
                'adults' => 1,
                'children' => 0,
                'babies' => 2,
                'total_persons' => 3,
                'is_active' => true,
                'note' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'name' => 'DeJongGezin',
                'code' => 'G0005',
                'description' => 'Bijstandsgezin',
                'adults' => 1,
                'children' => 1,
                'babies' => 0,
                'total_persons' => 2,
                'is_active' => true,
                'note' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'name' => 'VanderBergGezin',
                'code' => 'G0006',
                'description' => 'AlleenGaande',
                'adults' => 1,
                'children' => 0,
                'babies' => 0,
                'total_persons' => 1,
                'is_active' => true,
                'note' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
