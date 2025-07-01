<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

return new class extends Migration
{
    public function up(): void
    {
        // Drop bestaande procedures
        DB::unprepared('DROP PROCEDURE IF EXISTS spGetAllSuppliers');
        DB::unprepared('DROP PROCEDURE IF EXISTS spGetAllProductsBySupplierId');
        DB::unprepared('DROP PROCEDURE IF EXISTS spUpdateProducts');

        // Maak procedures aan
        $pathGetAllSuppliers = database_path('sp/Dennis/spGetAllSuppliers.sql');
        DB::unprepared(File::get($pathGetAllSuppliers));

        $pathGetAllProductsBySupplierId = database_path('sp/Dennis/spGetAllProductsBySupplierId.sql');
        DB::unprepared(File::get($pathGetAllProductsBySupplierId));

        $pathUpdateProducts = database_path('sp/Dennis/spUpdateProducts.sql');
        DB::unprepared(File::get($pathUpdateProducts));
    }

    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS spGetAllSuppliers');
        DB::unprepared('DROP PROCEDURE IF EXISTS spGetAllProductsBySupplierId');
        DB::unprepared('DROP PROCEDURE IF EXISTS spUpdateProducts');
    }
};
