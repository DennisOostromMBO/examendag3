<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

return new class extends Migration
{
    public function up(): void
    {
        // Drop the stored procedures if they exist
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_get_families_with_allergies');
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_update_person_allergy');

        // Load and create the stored procedures from the SQL files
        $spPath1 = database_path('sp/Daniel/sp_get_families_with_allergies.sql');
        $spPath2 = database_path('sp/Daniel/sp_update_person_allergy.sql');
        DB::unprepared(File::get($spPath1));
        DB::unprepared(File::get($spPath2));
    }

    public function down(): void
    {
        // Drop the stored procedures
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_get_families_with_allergies');
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_update_person_allergy');
    }
};
