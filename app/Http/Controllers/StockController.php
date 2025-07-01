<?php

namespace App\Http\Controllers;

use App\Services\ProductStockService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * StockController
 *
 * Handles all stock/voorraad related operations for the Voedselbank system.
 * This controller manages:
 * - Stock overview and filtering by categories
 * - Product details viewing and editing
 * - Warehouse/magazijn management
 * - Product quantity updates and delivery tracking
 *
 * @author Voedselbank Maaskantje Development Team
 * @version 1.0
 */
class StockController extends Controller
{
    /**
     * Service class that handles all stock-related business logic
     * Uses stored procedures and database operations for stock management
     *
     * @var ProductStockService
     */
    protected $productStockService;

    /**
     * Constructor - Inject the ProductStockService dependency
     *
     * @param ProductStockService $productStockService Service for stock operations
     */
    public function __construct(ProductStockService $productStockService)
    {
        $this->productStockService = $productStockService;
    }

    /**
     * Display the stock overview page (Overzicht Productvoorraden)
     *
     * Shows a filterable table of all products in stock with their details.
     * Users can filter by category to view specific product types.
     *
     * Features:
     * - Category filtering dropdown
     * - Product details table with name, category, quantity, expiry dates
     * - Links to individual product detail pages
     * - Warning messages when no products found
     *
     * @param Request $request HTTP request containing optional 'category' filter parameter
     * @return View Returns the stocks.index view with stock data and categories
     *
     * @route GET /voorraad
     * @route GET /overzicht-productvoorraden
     */
    public function index(Request $request): View
    {
        // Get the category filter from request parameters (optional)
        $categoryFilter = $request->get('category');

        // Get current page number from request (default to 1)
        $currentPage = $request->get('page', 1);
        $perPage = 10; // Items per page

        // Fetch stock data using stored procedures - filtered by category if provided
        $allStocks = $this->productStockService->getStockOverview($categoryFilter);

        // Convert to Laravel collection for pagination
        $stocksCollection = collect($allStocks);

        // Calculate pagination variables
        $total = $stocksCollection->count();
        $offset = ($currentPage - 1) * $perPage;

        // Get items for current page
        $stocks = $stocksCollection->slice($offset, $perPage)->values();

        // Create pagination data
        $pagination = [
            'current_page' => (int) $currentPage,
            'per_page' => $perPage,
            'total' => $total,
            'last_page' => ceil($total / $perPage),
            'from' => $offset + 1,
            'to' => min($offset + $perPage, $total)
        ];

        // Get all active categories for the filter dropdown
        $categories = $this->productStockService->getActiveCategories();

        // Return view with all necessary data for the stock overview page
        return view('stocks.index', compact('stocks', 'categories', 'categoryFilter', 'pagination'));
    }

    /**
     * Show product details (read-only view)
     *
     * Displays detailed information about a specific product including:
     * - Basic product info (name, barcode, expiry date)
     * - Current stock levels and location
     * - Warehouse information
     * - Received and delivery dates
     *
     * This is a read-only view - use editProduct() for modifications.
     *
     * @param int|string $id The product ID to display
     * @return RedirectResponse|View Returns product details view or redirects if product not found
     *
     * @route GET /product/{id}
     */
    public function showProduct($id)
    {
        // Retrieve product details from the service layer
        $product = $this->productStockService->getProductDetails($id);

        // Check if product exists - redirect with error if not found
        if (!$product) {
            return redirect()->route('stocks.overview')->with('error', 'Product niet gevonden.');
        }

        // Get additional stock information (quantities, dates, warehouse info)
        $stockInfo = $this->productStockService->getProductStockInfo($id);

        // Return the product details view with all relevant data
        return view('stocks.product-show', compact('product', 'stockInfo'));
    }

    /**
     * Show product edit form
     *
     * Displays an editable form for updating product stock information.
     * Allows modification of:
     * - Delivered quantities
     * - Delivery dates
     * - Stock levels
     *
     * Form includes validation and handles both successful updates and errors.
     *
     * @param int|string $id The product ID to edit
     * @return RedirectResponse|View Returns edit form view or redirects if product not found
     *
     * @route GET /product/{id}/edit
     */
    public function editProduct($id)
    {
        // Get product details for the edit form
        $product = $this->productStockService->getProductDetails($id);

        // Verify product exists before showing edit form
        if (!$product) {
            return redirect()->route('stocks.overview')->with('error', 'Product niet gevonden.');
        }

        // Get current stock information to pre-populate form fields
        $stockInfo = $this->productStockService->getProductStockInfo($id);

        // Get categories for any category-related form fields
        $categories = $this->productStockService->getActiveCategories();

        // Return edit form with all necessary data
        return view('stocks.product-edit', compact('product', 'stockInfo', 'categories'));
    }

    /**
     * Update product delivered quantity
     *
     * Processes form submission to update product stock levels and delivery information.
     *
     * Validation Rules:
     * - delivered_quantity: required, integer, minimum 0
     * - delivery_date: optional, must be valid date format
     *
     * Business Logic:
     * - Checks if sufficient stock is available before allowing delivery
     * - Updates both delivered quantities and delivery dates
     * - Maintains stock integrity by preventing over-delivery
     *
     * Success: Redirects to product details page with success message
     * Failure: Returns to form with error message and preserves user input
     *
     * @param Request $request HTTP request containing form data
     * @param int|string $id The product ID to update
     * @return RedirectResponse Always returns a redirect response
     *
     * @route PUT /product/{id}
     */
    public function updateProduct(Request $request, $id): RedirectResponse
    {
        // Validate incoming form data
        $request->validate([
            'delivered_quantity' => 'required|integer|min:0',  // Must be non-negative integer
            'delivery_date' => 'nullable|date'                 // Optional date field
        ]);

        // Delegate business logic to service layer
        // Service handles database operations and business rules
        $result = $this->productStockService->updateDeliveredQuantity(
            $id,
            $request->delivered_quantity,
            $request->delivery_date
        );

        // Handle successful update
        if ($result['success']) {
            return redirect()->route('stocks.product.show', $id)
                           ->with('success', 'De productgegevens zijn gewijzigd');
        } else {
            // Handle specific business logic failures
            if ($result['result'] === 'INSUFFICIENT_STOCK') {
                // Insufficient stock error - return to form with specific message
                return redirect()->back()
                               ->with('error', 'Er worden meer producten uitgeleverd dan er in voorraad zijn')
                               ->withInput();  // Preserve user input
            } else {
                // Generic error handling for other failures
                return redirect()->back()
                               ->with('error', 'Er is een fout opgetreden bij het bijwerken.')
                               ->withInput();  // Preserve user input
            }
        }
    }

    /**
     * Show warehouse details for editing
     *
     * Displays detailed information about a specific warehouse/magazijn.
     * Shows warehouse-specific data that can be viewed and potentially edited.
     *
     * Used for warehouse management and viewing storage details.
     *
     * @param int|string $id The warehouse ID to display
     * @return RedirectResponse|View Returns warehouse details view or redirects if not found
     *
     * @route GET /warehouse/{id}
     */
    public function showWarehouse($id)
    {
        // Retrieve warehouse details from service layer
        $warehouse = $this->productStockService->getWarehouseDetails($id);

        // Check if warehouse exists - redirect with error if not found
        if (!$warehouse) {
            return redirect()->route('stocks.overview')->with('error', 'Magazijn niet gevonden.');
        }

        // Return warehouse details view
        return view('stocks.warehouse-details', compact('warehouse'));
    }

    /**
     * Update warehouse details
     *
     * Processes form submission to update warehouse/magazijn information.
     * Handles all warehouse-related data including dates, quantities, and status.
     *
     * Validation Rules:
     * - received_date: required, must be valid date
     * - delivery_date: optional, must be valid date if provided
     * - package_unit: required string, max 255 characters (e.g., "dozen", "pallets")
     * - quantity: required integer, minimum 0
     * - note: optional string for additional comments
     * - is_active: boolean flag for warehouse status
     *
     * Features:
     * - Checkbox handling for is_active status
     * - Comprehensive error handling
     * - Input preservation on validation failures
     *
     * @param Request $request HTTP request containing warehouse form data
     * @param int|string $id The warehouse ID to update
     * @return RedirectResponse Always returns a redirect response
     *
     * @route PUT /warehouse/{id}
     */
    public function updateWarehouse(Request $request, $id): RedirectResponse
    {
        // Validate all warehouse form fields
        $request->validate([
            'received_date' => 'required|date',           // When stock was received
            'delivery_date' => 'nullable|date',           // Optional delivery date
            'package_unit' => 'required|string|max:255',  // Packaging type (dozen, pallet, etc.)
            'quantity' => 'required|integer|min:0',       // Number of units
            'note' => 'nullable|string',                  // Optional notes/comments
            'is_active' => 'boolean'                      // Active status
        ]);

        // Prepare data for service layer
        $data = $request->all();

        // Handle checkbox: convert presence to boolean (checked = true, unchecked = false)
        $data['is_active'] = $request->has('is_active');

        // Delegate update operation to service layer
        $success = $this->productStockService->updateWarehouse($id, $data);

        // Handle success/failure responses
        if ($success) {
            // Success: redirect to warehouse details with confirmation
            return redirect()->route('stocks.warehouse.show', $id)
                           ->with('success', 'Magazijn succesvol bijgewerkt!');
        } else {
            // Failure: return to form with error message and preserve input
            return redirect()->back()
                           ->with('error', 'Er is een fout opgetreden bij het bijwerken van het magazijn.')
                           ->withInput();
        }
    }
}
