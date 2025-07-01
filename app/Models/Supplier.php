<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Supplier extends Model
{
    use HasFactory;

    /**
     * Haal alle unieke supplier types op.
     */
    public static function getAllTypes()
    {
        return DB::table('suppliers')->select('supplier_type')->distinct()->pluck('supplier_type');
    }

    /**
     * Haal alle suppliers op via de stored procedure, optioneel gefilterd op type.
     * Zorg dat het id-veld altijd aanwezig is.
     */
    public static function getAllWithContactInfo($type = null)
    {
        $suppliers = collect(DB::select('CALL spGetAllSuppliers()'))->map(function ($item) {
            return (array) $item;
        });
        if ($type) {
            $suppliers = $suppliers->where('supplier_type', $type);
        }
        return $suppliers->values();
    }

    /**
     * Haal de supplier info op voor een specifieke supplier.
     */
    public static function getSupplierInfo($supplierId)
    {
        return self::where('id', $supplierId)->first();
    }

    /**
     * Haal alle producten op voor een supplier via de stored procedure.
     */
    public static function getProductsBySupplierId($supplierId)
    {
        return DB::select('CALL spGetAllProductsBySupplierId(?)', [$supplierId]);
    }
}
