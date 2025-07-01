<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $types = DB::table('suppliers')->select('supplier_type')->distinct()->pluck('supplier_type');
        $selectedType = $request->get('supplier_type');

        if ($selectedType) {
            $suppliers = DB::select('CALL spGetAllSuppliers()');
            // Filter suppliers in PHP omdat stored procedure geen WHERE accepteert
            $suppliers = collect($suppliers)->where('supplier_type', $selectedType);
        } else {
            $suppliers = DB::select('CALL spGetAllSuppliers()');
        }

        return view('suppliers.index', [
            'suppliers' => $suppliers,
            'types' => $types,
            'selectedType' => $selectedType,
        ]);
    }
}
