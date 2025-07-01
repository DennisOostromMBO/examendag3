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
     * Update warehouse quantity with validation
     */
    public function updateWarehouseQuantity($productId, $newQuantity, $deliveryDate = null)
    {
        try {
            $results = DB::select('CALL UpdateWarehouseQuantity(?, ?, ?, @result, @current_stock)', [
                $productId,
                $newQuantity,
                $deliveryDate
            ]);

            $output = DB::select('SELECT @result as result, @current_stock as current_stock');

            return [
                'success' => $output[0]->result === 'SUCCESS',
                'result' => $output[0]->result,
                'current_stock' => $output[0]->current_stock
            ];
        } catch (\Exception $e) {
            Log::error('Error in updateWarehouseQuantity: ' . $e->getMessage());
            return [
                'success' => false,
                'result' => 'ERROR',
                'current_stock' => 0
            ];
        }
    }

    /**
     * Update delivered quantity with validation against available stock
     */
    public function updateDeliveredQuantity($productId, $deliveredQuantity, $deliveryDate = null)
    {
        try {
            // Get current stock info
            $stockInfo = $this->getProductStockInfo($productId);

            // Check if delivered quantity exceeds available stock
            if ($deliveredQuantity > $stockInfo['current_stock']) {
                return [
                    'success' => false,
                    'result' => 'INSUFFICIENT_STOCK',
                    'current_stock' => $stockInfo['current_stock']
                ];
            }

            // Update the delivered quantity in product_warehouse table
            $results = DB::update('
                UPDATE product_warehouse pw
                INNER JOIN warehouses w ON pw.warehouse_id = w.id
                SET pw.delivered_quantity = ?, w.delivery_date = ?
                WHERE pw.product_id = ? AND w.is_active = 1
            ', [$deliveredQuantity, $deliveryDate, $productId]);

            return [
                'success' => $results > 0,
                'result' => 'SUCCESS',
                'current_stock' => $stockInfo['current_stock']
            ];
        } catch (\Exception $e) {
            Log::error('Error in updateDeliveredQuantity: ' . $e->getMessage());
            return [
                'success' => false,
                'result' => 'ERROR',
                'current_stock' => 0
            ];
        }
    }

    /**
     * Get current warehouse quantity for product
     */
    public function getCurrentQuantity($productId)
    {
        try {
            $results = DB::select('
                SELECT w.quantity, w.id as warehouse_id
                FROM warehouses w
                INNER JOIN product_warehouse pw ON w.id = pw.warehouse_id
                WHERE pw.product_id = ? AND w.is_active = 1
                LIMIT 1
            ', [$productId]);

            return $results ? $results[0]->quantity : 0;
        } catch (\Exception $e) {
            Log::error('Error in getCurrentQuantity: ' . $e->getMessage());
            return 0;
        }
    }

    /**
     * Get comprehensive stock information for a product
     */
    public function getProductStockInfo($productId)
    {
        try {
            $results = DB::select('
                SELECT
                    w.quantity as current_stock,
                    w.delivery_date,
                    w.received_date,
                    pw.delivered_quantity,
                    w.package_unit,
                    pw.location as warehouse_location
                FROM warehouses w
                INNER JOIN product_warehouse pw ON w.id = pw.warehouse_id
                WHERE pw.product_id = ? AND w.is_active = 1
                LIMIT 1
            ', [$productId]);

            if ($results) {
                $result = $results[0];
                return [
                    'current_stock' => $result->current_stock,
                    'delivered_quantity' => $result->delivered_quantity ?? 0,
                    'available_for_delivery' => $result->current_stock - ($result->delivered_quantity ?? 0),
                    'delivery_date' => $result->delivery_date,
                    'received_date' => $result->received_date,
                    'warehouse_name' => 'Benicum',
                    'warehouse_location' => $result->warehouse_location ?? 'Benicum'
                ];
            }

            return [
                'current_stock' => 0,
                'delivered_quantity' => 0,
                'available_for_delivery' => 0,
                'delivery_date' => null,
                'received_date' => null,
                'warehouse_name' => 'Benicum',
                'warehouse_location' => 'Benicum'
            ];
        } catch (\Exception $e) {
            Log::error('Error in getProductStockInfo: ' . $e->getMessage());
            return [
                'current_stock' => 0,
                'delivered_quantity' => 0,
                'available_for_delivery' => 0,
                'delivery_date' => null,
                'received_date' => null,
                'warehouse_name' => 'Benicum',
                'warehouse_location' => 'Benicum'
            ];
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
                $data['note'] ?? null,
                $data['is_active'] ? 1 : 0
            ]);

            return $results[0]->affected_rows > 0;
        } catch (\Exception $e) {
            Log::error('Error in updateWarehouse: ' . $e->getMessage());
            return false;
        }
    }
}
