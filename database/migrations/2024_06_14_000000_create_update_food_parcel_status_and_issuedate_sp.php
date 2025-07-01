<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

return new class extends Migration
{
    public function up(): void
    {
        // Drop bestaande procedure
        DB::unprepared('DROP PROCEDURE IF EXISTS Update_Food_Parcel_Status_And_IssueDate');

        // Procedure aanmaken vanuit SQL-bestand
        $path = database_path('sp/Mahdi/Update_Food_Parcels.sql');
        DB::unprepared(File::get($path));

        // Also (re)create the Get_all_FoodParcels procedure from SQL file if needed
        $getAllPath = database_path('sp/Mahdi/Get_all_FoodParcels.sql');
        if (file_exists($getAllPath)) {
            DB::unprepared(File::get($getAllPath));
        }
    }

    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS Update_Food_Parcel_Status_And_IssueDate');
        DB::unprepared('DROP PROCEDURE IF EXISTS Get_all_FoodParcels');
    }
};
