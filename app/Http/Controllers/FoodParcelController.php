<?php

namespace App\Http\Controllers;

use App\Models\FoodParcel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FoodParcelController extends Controller
{
    public function index(Request $request)
    {
        $eetwens = $request->input('eetwens');
        $foodParcels = \DB::select('CALL Get_all_FoodParcels()');
        try {
            if ($eetwens && $eetwens !== 'all') {
            $foodParcels = array_filter($foodParcels, function($parcel) use ($eetwens) {
                return isset($parcel->Eetwens) && $parcel->Eetwens === $eetwens;
            });
            }
        } catch (\Exception $e) {
            // Log the error or handle it as needed
            return back()->withErrors(['msg' => 'Er is een fout opgetreden bij het filteren van de voedselpakketten.']);
        }

        // Remove duplicate families by Gezinsnaam (keep the first occurrence)
        $foodParcels = collect($foodParcels)
            ->unique('Gezinsnaam')
            ->values()
            ->all();

        return view('food-packages.index', compact('foodParcels', 'eetwens'));
    }

    public function show($pakketnummer)
    {
        $parcels = \DB::select('CALL Get_all_FoodParcels()');
        $parcel = collect($parcels)->firstWhere('Pakketnummer', $pakketnummer);
        if (!$parcel) {
            abort(404);
        }

        // Build pakketten array for this family, remove duplicates by Pakketnummer
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
            ->unique('Pakketnummer')
            ->values();

        return view('food-packages.Show', compact('parcel', 'pakketten'));
    }

    public function edit($pakketnummer)
    {
        $parcels = DB::select('CALL Get_all_FoodParcels()');
        $pakket = collect($parcels)->firstWhere('Pakketnummer', $pakketnummer);
        if (!$pakket) {
            abort(404);
        }
        // Only allow these statuses
        $statusOptions = [
            'Niet Uitgereikt',
            'NietMeerIngeschreven',
            'Uitgereikt'
        ];
        $disabled = $pakket->Status === 'NietMeerIngeschreven';
        return view('food-packages.edit', compact('pakket', 'statusOptions', 'disabled'));
    }

    public function update(Request $request, $pakketnummer)
    {
        $request->validate([
            'Status' => 'required|string|max:50',
        ]);

        $status = $request->input('Status');
        $parcels = DB::select('CALL Get_all_FoodParcels()');
        $pakket = collect($parcels)->firstWhere('Pakketnummer', $pakketnummer);
        if (!$pakket) {
            abort(404);
        }

        $datumUitgifte = null;
        if ($status === 'Uitgereikt') {
            $datumUitgifte = Carbon::now()->toDateString();
        }

        // Find the foodparcel id by pakketnummer
        $foodparcelId = DB::table('foodparcels')->where('parcel_number', $pakketnummer)->value('id');

        DB::statement('CALL Update_Food_Parcel_Status_And_IssueDate(?, ?, ?)', [
            $foodparcelId,
            $status,
            $datumUitgifte
        ]);

        // Redirect to show page with success message
        return redirect()
            ->route('food-packages.show', $pakketnummer)
            ->with('success', 'De wijziging is doorgevoerd');
    }
}
