<?php

namespace App\Http\Controllers;

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
     * Show product details (read-only view)
     */
    public function showProduct($id)
    {
        $product = $this->productStockService->getProductDetails($id);

        if (!$product) {
            return redirect()->route('stocks.overview')->with('error', 'Product niet gevonden.');
        }

        $stockInfo = $this->productStockService->getProductStockInfo($id);

        return view('stocks.product-show', compact('product', 'stockInfo'));
    }

    /**
     * Show product edit form
     */
    public function editProduct($id)
    {
        $product = $this->productStockService->getProductDetails($id);

        if (!$product) {
            return redirect()->route('stocks.overview')->with('error', 'Product niet gevonden.');
        }

        $stockInfo = $this->productStockService->getProductStockInfo($id);
        $categories = $this->productStockService->getActiveCategories();

        return view('stocks.product-edit', compact('product', 'stockInfo', 'categories'));
    }

    /**
     * Update product delivered quantity
     */
    public function updateProduct(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'delivered_quantity' => 'required|integer|min:0',
            'delivery_date' => 'nullable|date'
        ]);

        $result = $this->productStockService->updateDeliveredQuantity(
            $id,
            $request->delivered_quantity,
            $request->delivery_date
        );

        if ($result['success']) {
            return redirect()->route('stocks.product.show', $id)
                           ->with('success', 'De productgegevens zijn gewijzigd');
        } else {
            if ($result['result'] === 'INSUFFICIENT_STOCK') {
                return redirect()->back()
                               ->with('error', 'Er worden meer producten uitgeleverd dan er in voorraad zijn')
                               ->withInput();
            } else {
                return redirect()->back()
                               ->with('error', 'Er is een fout opgetreden bij het bijwerken.')
                               ->withInput();
            }
        }
    }

    /**
     * Show warehouse details for editing
     */
    public function showWarehouse($id)
    {
        $warehouse = $this->productStockService->getWarehouseDetails($id);

        if (!$warehouse) {
            return redirect()->route('stocks.overview')->with('error', 'Magazijn niet gevonden.');
        }

        return view('stocks.warehouse-details', compact('warehouse'));
    }

    /**
     * Update warehouse details
     */
    public function updateWarehouse(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'received_date' => 'required|date',
            'delivery_date' => 'nullable|date',
            'package_unit' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'note' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        $success = $this->productStockService->updateWarehouse($id, $data);

        if ($success) {
            return redirect()->route('stocks.warehouse.show', $id)
                           ->with('success', 'Magazijn succesvol bijgewerkt!');
        } else {
            return redirect()->back()
                           ->with('error', 'Er is een fout opgetreden bij het bijwerken van het magazijn.')
                           ->withInput();
        }
    }
}
