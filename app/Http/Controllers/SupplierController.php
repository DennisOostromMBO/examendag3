<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    /**
     * Toon de producten van een leverancier.
     */
    public function show($id)
    {
        try {
            // Haal supplier info op
            $supplier = \App\Models\Supplier::getSupplierInfo($id);

            // Haal producten op via stored procedure
            $products = \App\Models\Supplier::getProductsBySupplierId($id);

            return view('suppliers.products', [
                'supplier' => $supplier,
                'products' => $products,
            ]);
        } catch (\Throwable $e) {
            Log::error('Fout bij ophalen producten van leverancier: ' . $e->getMessage());
            return back()->with('error', 'Er is een fout opgetreden bij het ophalen van de producten.');
        }
    }

    /**
     * Toon het formulier om de houdbaarheidsdatum van een product te wijzigen.
     */
    public function editProductExpiration($productId, Request $request)
    {
        $product = DB::table('products')->where('id', $productId)->first();
        $supplierId = $request->get('supplier_id');
        // Gebruik de juiste view in de suppliers map
        return view('suppliers.edit', compact('product', 'supplierId'));
    }

    /**
     * Werk de houdbaarheidsdatum van een product bij via stored procedure.
     */
    public function updateProductExpiration(Request $request, $productId)
    {
        $request->validate([
            'expiration_date' => 'required|date',
            'supplier_id' => 'required|integer'
        ]);

        $current = DB::table('products')->where('id', $productId)->value('expiration_date');
        $new = $request->input('expiration_date');

        // Alleen deze error als je verder dan 7 dagen invult
        if ($current && \Carbon\Carbon::parse($new)->gt(\Carbon\Carbon::parse($current)->addDays(7))) {
            return redirect()->back()->with('error', true);
        }

        DB::statement('CALL spUpdateProducts(?, ?)', [
            $productId,
            $new
        ]);

        return redirect()->back()->with('success', 'Houdbaarheidsdatum succesvol bijgewerkt.');
    }
}
