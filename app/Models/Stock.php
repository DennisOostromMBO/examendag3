<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Stock Model (Voorraad)
 *
 * Represents product stock/inventory in the Voedselbank system.
 * This model manages the relationship between products and their storage locations,
 * tracking quantities, dates, and warehouse information.
 *
 * Database Table: stocks (or voorraad)
 *
 * Key Relationships:
 * - Belongs to Product (many stocks can belong to one product)
 * - Belongs to Warehouse/Magazijn (many stocks stored in one warehouse)
 * - Belongs to Supplier/Leverancier (tracks where stock came from)
 *
 * Main Functions:
 * - Track product quantities in different locations
 * - Manage expiry dates and product freshness
 * - Handle stock movements (received, delivered)
 * - Maintain warehouse location data
 *
 * Business Rules:
 * - Stock quantities cannot be negative
 * - Delivery dates must be after or equal to received dates
 * - Products must exist before creating stock entries
 *
 * @author Voedselbank Maaskantje Development Team
 * @version 1.0
 *
 * @property int $id Primary key
 * @property int $product_id Foreign key to products table
 * @property int $warehouse_id Foreign key to warehouses table
 * @property int $supplier_id Foreign key to suppliers table
 * @property string $location Physical location within warehouse
 * @property int $quantity Number of items in stock
 * @property string $package_unit Unit type (piece, box, kg, etc.)
 * @property \Carbon\Carbon $received_date When stock was received
 * @property \Carbon\Carbon|null $delivery_date When stock was delivered (nullable)
 * @property \Carbon\Carbon $expiry_date Product expiration date
 * @property bool $is_active Whether stock entry is active
 * @property string|null $notes Optional notes about the stock
 * @property \Carbon\Carbon $created_at Record creation timestamp
 * @property \Carbon\Carbon $updated_at Record last update timestamp
 */
class Stock extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * Following Dutch naming convention for the Voedselbank system.
     *
     * @var string
     */
    protected $table = 'stocks';

    /**
     * The attributes that are mass assignable.
     * These fields can be safely filled using create() or fill() methods.
     *
     * Security: Only include fields that should be writable by users
     * Exclude sensitive fields like id, timestamps unless specifically needed
     *
     * @var array<string>
     */
    protected $fillable = [
        'product_id',
        'warehouse_id',
        'supplier_id',
        'location',
        'quantity',
        'package_unit',
        'received_date',
        'delivery_date',
        'expiry_date',
        'is_active',
        'notes'
    ];

    /**
     * The attributes that should be cast to native types.
     * Ensures proper data type handling when retrieving from database.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'received_date' => 'datetime',
        'delivery_date' => 'datetime',
        'expiry_date' => 'datetime',
        'is_active' => 'boolean',
        'quantity' => 'integer'
    ];

    /**
     * Relationship: Stock belongs to Product
     *
     * Each stock entry is associated with exactly one product.
     * Used to get product details like name, barcode, category etc.
     *
     * Usage: $stock->product->name
     *
     * @return BelongsTo<Product, Stock>
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Relationship: Stock belongs to Warehouse/Magazijn
     *
     * Each stock entry is stored in exactly one warehouse.
     * Used to track physical storage location and capacity.
     *
     * Usage: $stock->warehouse->name
     *
     * @return BelongsTo<Warehouse, Stock>
     */
    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }

    /**
     * Relationship: Stock belongs to Supplier/Leverancier
     *
     * Each stock entry comes from exactly one supplier.
     * Used for tracking supply chain and supplier performance.
     *
     * Usage: $stock->supplier->name
     *
     * @return BelongsTo<Supplier, Stock>
     */
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    /**
     * Scope: Get only active stock entries
     *
     * Filters stock records to only include active entries.
     * Useful for excluding archived or deactivated stock.
     *
     * Usage: Stock::active()->get()
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: Get stock that hasn't been delivered yet
     *
     * Filters to stock entries that are still in the warehouse
     * (delivery_date is null).
     *
     * Usage: Stock::available()->get()
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAvailable($query)
    {
        return $query->whereNull('delivery_date');
    }

    /**
     * Scope: Get stock expiring soon
     *
     * Filters to stock entries that expire within specified days.
     * Useful for alerts and inventory management.
     *
     * Usage: Stock::expiringSoon(7)->get() // expires in 7 days
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $days Number of days ahead to check
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeExpiringSoon($query, $days = 7)
    {
        return $query->where('expiry_date', '<=', now()->addDays($days))
                    ->where('expiry_date', '>=', now());
    }

    /**
     * Accessor: Get human-readable quantity with unit
     *
     * Returns a formatted string combining quantity and package unit.
     * Combines quantity and package_unit for display purposes.
     *
     * Usage: $stock->formatted_quantity // "25 stuks" or "10 dozen"
     *
     * @return string
     */
    public function getFormattedQuantityAttribute(): string
    {
        return $this->quantity . ' ' . ($this->package_unit ?? 'stuks');
    }

    /**
     * Accessor: Check if stock is expired
     *
     * Determines if the stock has passed its expiry date.
     *
     * Usage: $stock->is_expired
     *
     * @return bool
     */
    public function getIsExpiredAttribute(): bool
    {
        return $this->expiry_date < now();
    }

    /**
     * Accessor: Check if stock is delivered
     *
     * Determines if the stock has been delivered (has delivery_date).
     *
     * Usage: $stock->is_delivered
     *
     * @return bool
     */
    public function getIsDeliveredAttribute(): bool
    {
        return !is_null($this->delivery_date);
    }

    /**
     * Method: Calculate days until expiry
     *
     * Returns the number of days until the stock expires.
     * Negative values indicate expired stock.
     *
     * Usage: $stock->daysUntilExpiry()
     *
     * @return int Number of days (negative if expired)
     */
    public function daysUntilExpiry(): int
    {
        return now()->diffInDays($this->expiry_date, false);
    }
}
