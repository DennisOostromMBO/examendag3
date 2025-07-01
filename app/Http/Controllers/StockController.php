<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Supplier;
use App\Services\ProductStockService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class StockController extends Controller
{
    protected $productStockService;

    public function __construct(ProductStockService $productStockService)
    {
        $this->productStockService = $productStockService;
    }

    /**
     * Display the stock overview page (Overzicht Productvoorraden)
     */
    public function index(Request $request): View
    {
        $categoryFilter = $request->get('category');

        // Use stored procedures to get data
        $stocks = $this->productStockService->getStockOverview($categoryFilter);
        $categories = $this->productStockService->getActiveCategories();

        return view('stocks.index', compact('stocks', 'categories', 'categoryFilter'));
    }

    /**
     * Get placeholder stock data for demonstration
     */
    private function getPlaceholderStockData($categoryFilter = null)
    {
        // Placeholder data - replace with actual database query
        $allStocks = [
            [
                'id' => 1,
                'item_name' => 'Brood Wit',
                'category' => 'AGF',
                'unit' => 'stuks',
                'quantity' => 50,
                'expiry_date' => '2025-07-15',
                'supplier' => 'Bakkerij Jansen'
            ],
            [
                'id' => 2,
                'item_name' => 'Appels',
                'category' => 'AGF',
                'unit' => 'kg',
                'quantity' => 25,
                'expiry_date' => '2025-07-10',
                'supplier' => 'Fruithandel Peters'
            ],
            [
                'id' => 3,
                'item_name' => 'Bananen',
                'category' => 'AGF',
                'unit' => 'kg',
                'quantity' => 30,
                'expiry_date' => '2025-07-08',
                'supplier' => 'Fruithandel Peters'
            ],
            [
                'id' => 4,
                'item_name' => 'Melk Halfvol',
                'category' => 'ZPE',
                'unit' => 'liter',
                'quantity' => 40,
                'expiry_date' => '2025-07-12',
                'supplier' => 'Zuivelhoeve'
            ],
            [
                'id' => 5,
                'item_name' => 'Yoghurt Naturel',
                'category' => 'ZPE',
                'unit' => 'bekers',
                'quantity' => 15,
                'expiry_date' => '2025-07-09',
                'supplier' => 'Zuivelhoeve'
            ]
        ];

        // Filter by category if specified
        if ($categoryFilter && $categoryFilter !== 'all') {
            $filteredStocks = array_filter($allStocks, function($stock) use ($categoryFilter) {
                return $stock['category'] === $categoryFilter;
            });

            // Return empty array for 'BVH' to demonstrate the empty state message
            if ($categoryFilter === 'BVH') {
                return [];
            }

            return array_values($filteredStocks);
        }

        return $allStocks;
    }

    /**
     * Get placeholder categories for demonstration
     */
    private function getPlaceholderCategories()
    {
        return [
            'AGF' => 'Aardappelen, Groenten en Fruit',
            'KV' => 'Kant en Klaar Voeding',
            'ZPE' => 'Zuivel, Plantaardig en Eieren',
            'BB' => 'Brood en Banket',
            'FSKT' => 'Frisdrank, Sappen, Koffie en Thee',
            'PRW' => 'Pasta, Rijst en Wereldkeukens',
            'SSKO' => 'Soepen, Sauzen, Kruiden en Oliën',
            'SKGC' => 'Snoep, Koek, Gebak en Chocolade',
            'BVH' => 'Baby Voeding en Hygiëne'
        ];
    }

    /**
     * Show product details for editing
     */
    public function showProduct(Request $request, $id): View
    {
        $product = $this->productStockService->getProductDetails($id);
        $categories = $this->productStockService->getActiveCategories();
        
        if (!$product) {
            abort(404, 'Product niet gevonden');
        }

        return view('stocks.product-details', compact('product', 'categories'));
    }

    /**
     * Update product using stored procedure
     */
    public function updateProduct(Request $request, $id): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'allergy_type' => 'nullable|string|max:255',
            'barcode' => 'required|string|max:255',
            'expiration_date' => 'required|date',
            'description' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'is_active' => 'boolean',
            'note' => 'nullable|string'
        ]);

        $success = $this->productStockService->updateProduct($id, $validated);

        if ($success) {
            return redirect()->route('stocks.overview')
                ->with('success', 'Product succesvol bijgewerkt');
        } else {
            return back()->with('error', 'Er is een fout opgetreden bij het bijwerken van het product');
        }
    }

    /**
     * Show warehouse details for editing
     */
    public function showWarehouse(Request $request, $id): View
    {
        $warehouse = $this->productStockService->getWarehouseDetails($id);
        
        if (!$warehouse) {
            abort(404, 'Magazijn niet gevonden');
        }

        return view('stocks.warehouse-details', compact('warehouse'));
    }

    /**
     * Update warehouse using stored procedure
     */
    public function updateWarehouse(Request $request, $id): RedirectResponse
    {
        $validated = $request->validate([
            'received_date' => 'required|date',
            'delivery_date' => 'nullable|date',
            'package_unit' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'is_active' => 'boolean',
            'note' => 'nullable|string'
        ]);

        $success = $this->productStockService->updateWarehouse($id, $validated);

        if ($success) {
            return redirect()->route('stocks.overview')
                ->with('success', 'Magazijn succesvol bijgewerkt');
        } else {
            return back()->with('error', 'Er is een fout opgetreden bij het bijwerken van het magazijn');
        }
    }
}
