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
     */
    public static function getAllWithContactInfo($type = null)
    {
        $suppliers = collect(DB::select('CALL spGetAllSuppliers()'));
        if ($type) {
            $suppliers = $suppliers->where('supplier_type', $type);
        }
        return $suppliers;
    }
}
