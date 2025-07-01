<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('suppliers')->insert([
            [
                'id' => 1,
                'name' => 'Albert Heijn',
                'contact_person' => 'Ruud ter Weijden',
                'supplier_number' => 'L0001',
                'supplier_type' => 'Bedrijf',
                'is_active' => true,
                'note' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Albertus Kerk',
                'contact_person' => 'Leo Pastoor',
                'supplier_number' => 'L0002',
                'supplier_type' => 'Instelling',
                'is_active' => true,
                'note' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Gemeente Utrecht',
                'contact_person' => 'Mohammed Yazidi',
                'supplier_number' => 'L0003',
                'supplier_type' => 'Overheid',
                'is_active' => true,
                'note' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'Boerderij Meerhoven',
                'contact_person' => 'Bertus van Driel',
                'supplier_number' => 'L0004',
                'supplier_type' => 'Particulier',
                'is_active' => true,
                'note' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'name' => 'Jan van der Heijden',
                'contact_person' => 'Jan van der Heijden',
                'supplier_number' => 'L0005',
                'supplier_type' => 'Donor',
                'is_active' => true,
                'note' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'name' => 'Vomar',
                'contact_person' => 'Jaco Pastorius',
                'supplier_number' => 'L0006',
                'supplier_type' => 'Bedrijf',
                'is_active' => true,
                'note' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'name' => 'DekaMarkt',
                'contact_person' => 'Sil den Dollaard',
                'supplier_number' => 'L0007',
                'supplier_type' => 'Bedrijf',
                'is_active' => true,
                'note' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'name' => 'Gemeente Vught',
                'contact_person' => 'Jan Blokker',
                'supplier_number' => 'L0008',
                'supplier_type' => 'Overheid',
                'is_active' => true,
                'note' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
