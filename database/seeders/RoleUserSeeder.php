<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleUserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('role_user')->insert([
            ['id' => 1, 'user_id' => 1, 'role_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'user_id' => 2, 'role_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'user_id' => 3, 'role_id' => 3, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
