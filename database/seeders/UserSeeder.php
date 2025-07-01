<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'person_id' => 1,
                'login_name' => 'Hans',
                'username' => 'hans@maaskantje.nl',
                'password' => '$2y$10$296RMzqzZqWENu9vyh6axed0DkfsuYkbvoI/AXVowCp/DL6zKiFOi',
                'is_logged_in' => true,
                'logged_in_at' => '2024-03-13 17:03:06',
                'logged_out_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'person_id' => 2,
                'login_name' => 'Jan',
                'username' => 'jan@maaskantje.nl',
                'password' => '$2y$10$296RMzqzZqWENu9vyh6axed0DkfsuYkbvoI/AXVowCp/DL3zKiF6i',
                'is_logged_in' => false,
                'logged_in_at' => '2024-03-13 15:13:23',
                'logged_out_at' => '2024-03-13 15:23:46',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'person_id' => 3,
                'login_name' => 'Herman',
                'username' => 'herman@maaskantje.nl',
                'password' => '$2y$10$296RMzqzZqWENu9vyh6axed0DkfsuYkbvoI/AXVuwCp/DL9zKiF2i',
                'is_logged_in' => true,
                'logged_in_at' => '2024-06-20 12:05:20',
                'logged_out_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
