<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SupplierController extends Controller
{
    /**
     * Toon het overzicht van leveranciers met filtermogelijkheid op type.
     */
    public function index(Request $request)
    {
        try {
            // Haal alle unieke supplier types op voor de dropdown
            $types = Supplier::getAllTypes();
            $selectedType = $request->get('supplier_type');

            // Haal alle suppliers op via de stored procedure, filter indien nodig
            $suppliers = Supplier::getAllWithContactInfo($selectedType);

            return view('suppliers.index', [
                'suppliers' => $suppliers,
                'types' => $types,
                'selectedType' => $selectedType,
            ]);
        } catch (\Throwable $e) {
            // Log de fout en toon een foutmelding
            Log::error('Fout bij ophalen leveranciers: ' . $e->getMessage());
            return back()->with('error', 'Er is een fout opgetreden bij het ophalen van de leveranciers.');
        }
    }
}
