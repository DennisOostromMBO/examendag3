<?php

namespace App\Http\Controllers;

use App\Models\FoodParcel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class FoodParcelController extends Controller
{
    public function index(Request $request)
    {
        $eetwens = $request->input('eetwens');
        $allParcels = collect(FoodParcel::getAllFoodParcels());

        // Filter if needed
        if ($eetwens && $eetwens !== 'all') {
            $allParcels = $allParcels->filter(function($parcel) use ($eetwens) {
                return isset($parcel->Eetwens) && $parcel->Eetwens === $eetwens;
            });
        }

        // Remove duplicate families by Gezinsnaam
        $uniqueParcels = $allParcels->unique('Gezinsnaam')->values();

        // Pagination (like AllergyController)
        $perPage = 3;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $pagedItems = $uniqueParcels->slice(($currentPage - 1) * $perPage, $perPage)->values();
        $foodParcels = new LengthAwarePaginator(
            $pagedItems,
            $uniqueParcels->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('food-packages.index', [
            'foodParcels' => $foodParcels,
            'eetwens' => $eetwens
        ]);
    }

    public function show($pakketnummer)
    {
        // Use the model method to call the SP
        $parcels = FoodParcel::getAllFoodParcels();
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
    // Show the edit form for a specific food parcel
    public function edit($pakketnummer)
    {
        // Use the model method to call the SP
        $parcels = FoodParcel::getAllFoodParcels();
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
        // Validate the incoming request data
        $request->validate([
            'Status' => 'required|string|max:50',
        ]);

        $status = $request->input('Status');
        // Use the model method to call the SP
        $parcels = FoodParcel::getAllFoodParcels();
        $pakket = collect($parcels)->firstWhere('Pakketnummer', $pakketnummer);
        if (!$pakket) {
            abort(404);
        }

        // Set the issue date if the status is 'Uitgereikt'
        $datumUitgifte = null;
        if ($status === 'Uitgereikt') {
            $datumUitgifte = Carbon::now()->toDateString();
        }

        // Find the foodparcel id by pakketnummer
        $foodparcelId = DB::table('foodparcels')->where('parcel_number', $pakketnummer)->value('id');

        // Use the model method to call the SP
        FoodParcel::updateFoodParcelStatusAndIssueDate($foodparcelId, $status, $datumUitgifte);

        // Redirect to show page with success message
        return redirect()
            ->route('food-packages.show', $pakketnummer)
            ->with('success', 'De wijziging is doorgevoerd');
    }
}
