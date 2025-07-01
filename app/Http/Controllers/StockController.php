<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class StockController extends Controller
{
    /**
     * Display the stock overview page (Overzicht Productvoorraden)
     */
    public function index(Request $request): View
    {
        $categoryFilter = $request->get('category');

        // Placeholder: In real implementation, this would fetch from database
        // For now, we'll use placeholder data to show the UI structure
        $stocks = $this->getPlaceholderStockData($categoryFilter);
        $categories = $this->getPlaceholderCategories();

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
}
