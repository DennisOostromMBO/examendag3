<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

class Allergy extends Model
{
    /**
     * Call the stored procedure to get families with allergies.
     *
     * @param int|null $allergyId
     * @return array
     */
    public static function getFamiliesWithAllergies($allergyId = null)
    {
        $param = is_null($allergyId) ? null : (int)$allergyId;
        $results = DB::select('CALL sp_get_families_with_allergies(?)', [$param]);
        return $results;
    }
}
