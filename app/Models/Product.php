<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    /**
     * Haal een product op via id.
     */
    public static function findProduct($id)
    {
        return DB::table('products')->where('id', $id)->first();
    }

    /**
     * Haal de huidige houdbaarheidsdatum op van een product.
     */
    public static function getExpirationDate($id)
    {
        return DB::table('products')->where('id', $id)->value('expiration_date');
    }

    /**
     * Update de houdbaarheidsdatum via stored procedure.
     */
    public static function updateExpirationDate($id, $expiration_date)
    {
        DB::statement('CALL spUpdateProducts(?, ?)', [$id, $expiration_date]);
    }
}
