<?php

namespace App\Http\Controllers;

use App\Models\FoodParcel;
use Illuminate\Http\Request;

class FoodParcelController extends Controller
{
    public function index(Request $request)
    {
        $eetwens = $request->input('eetwens');
        $foodParcels = \DB::select('CALL Get_all_FoodParcels()');

        if ($eetwens && $eetwens !== 'all') {
            $foodParcels = array_filter($foodParcels, function($parcel) use ($eetwens) {
                return isset($parcel->Eetwens) && $parcel->Eetwens === $eetwens;
            });
        }

        return view('food-packages.index', compact('foodParcels', 'eetwens'));
    }
}
