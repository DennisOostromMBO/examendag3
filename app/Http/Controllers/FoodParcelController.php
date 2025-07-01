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

    public function show($pakketnummer)
    {
        $parcels = \DB::select('CALL Get_all_FoodParcels()');
        $parcel = collect($parcels)->firstWhere('Pakketnummer', $pakketnummer);
        if (!$parcel) {
            abort(404);
        }

        // Build pakketten array for this family
        $pakketten = collect($parcels)
            ->where('Gezinsnaam', $parcel->Gezinsnaam)
            ->map(function($p) {
                return (object)[
                    'Pakketnummer' => $p->Pakketnummer,
                    'DatumSamenstelling' => $p->DatumSamenstelling,
                    'DatumUitgifte' => $p->DatumUitgifte,
                    'Status' => $p->Status,
                    'AantalProducten' => $p->AantalProducten,
                    'id' => $p->Pakketnummer // or another unique id if available
                ];
            })
            ->filter(function($p) {
                return !empty($p->Pakketnummer);
            })
            ->values();

        return view('food-packages.Show', compact('parcel', 'pakketten'));
    }
}
