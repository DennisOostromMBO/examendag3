<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class Allergy extends Model
{
    /**
     * Call the stored procedure to get families with allergies.
     *
     * @param int|null $allergyId
     * @return array
     */
    public static function getFamiliesWithAllergies($allergyId = null, $perPage = 5)
    {
        $param = is_null($allergyId) ? null : (int)$allergyId;
        $results = DB::select('CALL sp_get_families_with_allergies(?)', [$param]);
        $collection = collect($results);

        $page = LengthAwarePaginator::resolveCurrentPage();
        $items = $collection->slice(($page - 1) * $perPage, $perPage)->values();
        return new LengthAwarePaginator(
            $items,
            $collection->count(),
            $perPage,
            $page,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );
    }

    /**
     * Update a person's allergy using the stored procedure.
     *
     * @param int $personId
     * @param int $allergyId
     * @return void
     */
    public static function updatePersonAllergySP($personId, $allergyId)
    {
        DB::statement('CALL sp_update_person_allergy(?, ?)', [$personId, $allergyId]);
    }
}
