<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductStockService
{
    /**
     * Get product stock overview using stored procedure
     */
    public function getStockOverview($categoryFilter = null)
    {
        try {
            $results = DB::select('CALL GetProductStockOverview(?)', [$categoryFilter]);
            return collect($results)->map(function ($item) {
                return [
                    'product_id' => $item->product_id,
                    'item_name' => $item->item_name,
                    'category' => $item->category,
                    'unit' => $item->unit,
                    'quantity' => $item->quantity,
                    'expiry_date' => $item->expiry_date,
                    'supplier' => $item->supplier,
                    'status' => $item->status,
                    'is_active' => $item->is_active
                ];
            })->toArray();
        } catch (\Exception $e) {
            Log::error('Error in getStockOverview: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Get active categories using stored procedure
     */
    public function getActiveCategories()
    {
        try {
            $results = DB::select('CALL GetActiveCategories()');
            return collect($results)->mapWithKeys(function ($item) {
                return [$item->name => $item->id];
            })->toArray();
        } catch (\Exception $e) {
            Log::error('Error in getActiveCategories: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Get product details using stored procedure
     */
    public function getProductDetails($productId)
    {
        try {
            $results = DB::select('CALL GetProductDetails(?)', [$productId]);
            return $results ? $results[0] : null;
        } catch (\Exception $e) {
            Log::error('Error in getProductDetails: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Update product using stored procedure
     */
    public function updateProduct($productId, $data)
    {
        try {
            $results = DB::select('CALL UpdateProduct(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                $productId,
                $data['name'],
                $data['category_id'],
                $data['allergy_type'] ?? null,
                $data['barcode'],
                $data['expiration_date'],
                $data['description'],
                $data['status'],
                $data['is_active'] ? 1 : 0,
                $data['note'] ?? null
            ]);
            
            return $results[0]->affected_rows > 0;
        } catch (\Exception $e) {
            Log::error('Error in updateProduct: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Get warehouse details using stored procedure
     */
    public function getWarehouseDetails($warehouseId)
    {
        try {
            $results = DB::select('CALL GetWarehouseDetails(?)', [$warehouseId]);
            return $results ? $results[0] : null;
        } catch (\Exception $e) {
            Log::error('Error in getWarehouseDetails: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Update warehouse using stored procedure
     */
    public function updateWarehouse($warehouseId, $data)
    {
        try {
            $results = DB::select('CALL UpdateWarehouse(?, ?, ?, ?, ?, ?, ?)', [
                $warehouseId,
                $data['received_date'],
                $data['delivery_date'] ?? null,
                $data['package_unit'],
                $data['quantity'],
                $data['is_active'] ? 1 : 0,
                $data['note'] ?? null
            ]);
            
            return $results[0]->affected_rows > 0;
        } catch (\Exception $e) {
            Log::error('Error in updateWarehouse: ' . $e->getMessage());
            return false;
        }
    }
}
