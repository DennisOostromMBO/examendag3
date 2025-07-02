<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

class FoodParcel extends Model
{
    use HasFactory;

    protected $table = 'foodparcels';

    public function family(): BelongsTo
    {
        return $this->belongsTo(Family::class, 'family_id');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_foodparcel', 'foodparcel_id', 'product_id')
            ->withPivot('product_unit_count');
    }

    /**
     * Call the stored procedure to get all food parcels.
     *
     * @return array
     */
    public static function getAllFoodParcels()
    {
        return DB::select('CALL Get_all_FoodParcels()');
    }

    /**
     * Call the stored procedure to update food parcel status and issue date.
     *
     * @param int $foodparcelId
     * @param string $status
     * @param string|null $datumUitgifte
     * @return void
     */
    public static function updateFoodParcelStatusAndIssueDate($foodparcelId, $status, $datumUitgifte = null)
    {
        DB::statement('CALL Update_Food_Parcel_Status_And_IssueDate(?, ?, ?)', [
            $foodparcelId,
            $status,
            $datumUitgifte
        ]);
    }
}
