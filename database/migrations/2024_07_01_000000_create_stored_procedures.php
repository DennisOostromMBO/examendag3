<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoredProcedures extends Migration
{
    public function up()
    {
        // First, add the delivered_quantity column to product_warehouse table
        $this->addDeliveredQuantityColumn();

        // Then install all stored procedures
        $this->createGetProductStockOverviewProcedure();
        $this->createGetActiveCategoriesProcedure();
        $this->createUpdateProductProcedure();
        $this->createGetProductDetailsProcedure();
        $this->createUpdateWarehouseProcedure();
        $this->createGetWarehouseDetailsProcedure();
    }

    public function down()
    {
        // Drop stored procedures
        DB::unprepared('DROP PROCEDURE IF EXISTS GetProductStockOverview');
        DB::unprepared('DROP PROCEDURE IF EXISTS GetActiveCategories');
        DB::unprepared('DROP PROCEDURE IF EXISTS UpdateProduct');
        DB::unprepared('DROP PROCEDURE IF EXISTS GetProductDetails');
        DB::unprepared('DROP PROCEDURE IF EXISTS UpdateWarehouse');
        DB::unprepared('DROP PROCEDURE IF EXISTS GetWarehouseDetails');

        // Remove the delivered_quantity column
        Schema::table('product_warehouse', function (Blueprint $table) {
            $table->dropColumn('delivered_quantity');
        });
    }

    private function addDeliveredQuantityColumn()
    {
        if (!Schema::hasColumn('product_warehouse', 'delivered_quantity')) {
            Schema::table('product_warehouse', function (Blueprint $table) {
                $table->integer('delivered_quantity')->default(0)->after('location');
            });
        }
    }

    private function createGetProductStockOverviewProcedure()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS GetProductStockOverview');

        $procedure = "
        CREATE PROCEDURE GetProductStockOverview(
            IN p_category_filter VARCHAR(255)
        )
        BEGIN
            IF p_category_filter IS NULL OR p_category_filter = 'all' OR p_category_filter = '' THEN
                SELECT
                    p.id as product_id,
                    p.name as item_name,
                    c.name as category,
                    w.package_unit as unit,
                    w.quantity as quantity,
                    p.expiration_date as expiry_date,
                    CONCAT('Magazijn ', w.id) as supplier,
                    p.status,
                    p.is_active
                FROM products p
                INNER JOIN categories c ON p.category_id = c.id
                INNER JOIN product_warehouse pw ON p.id = pw.product_id
                INNER JOIN warehouses w ON pw.warehouse_id = w.id
                WHERE p.is_active = 1 AND c.is_active = 1 AND w.is_active = 1
                ORDER BY p.name ASC;
            ELSE
                SELECT
                    p.id as product_id,
                    p.name as item_name,
                    c.name as category,
                    w.package_unit as unit,
                    w.quantity as quantity,
                    p.expiration_date as expiry_date,
                    CONCAT('Magazijn ', w.id) as supplier,
                    p.status,
                    p.is_active
                FROM products p
                INNER JOIN categories c ON p.category_id = c.id
                INNER JOIN product_warehouse pw ON p.id = pw.product_id
                INNER JOIN warehouses w ON pw.warehouse_id = w.id
                WHERE p.is_active = 1
                AND c.is_active = 1
                AND w.is_active = 1
                AND c.name COLLATE utf8mb4_unicode_ci = p_category_filter COLLATE utf8mb4_unicode_ci
                ORDER BY p.name ASC;
            END IF;
        END";

        DB::unprepared($procedure);
    }

    private function createGetActiveCategoriesProcedure()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS GetActiveCategories');

        $procedure = "
        CREATE PROCEDURE GetActiveCategories()
        BEGIN
            SELECT
                id,
                name,
                description
            FROM categories
            WHERE is_active = 1
            ORDER BY name ASC;
        END";

        DB::unprepared($procedure);
    }

    private function createUpdateProductProcedure()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS UpdateProduct');

        $procedure = "
        CREATE PROCEDURE UpdateProduct(
            IN p_product_id BIGINT,
            IN p_name VARCHAR(255),
            IN p_category_id BIGINT,
            IN p_allergy_type VARCHAR(255),
            IN p_barcode VARCHAR(255),
            IN p_expiration_date DATE,
            IN p_description VARCHAR(255),
            IN p_status VARCHAR(255),
            IN p_is_active BOOLEAN,
            IN p_note TEXT
        )
        BEGIN
            DECLARE EXIT HANDLER FOR SQLEXCEPTION
            BEGIN
                ROLLBACK;
                RESIGNAL;
            END;

            START TRANSACTION;

            UPDATE products
            SET
                name = p_name,
                category_id = p_category_id,
                allergy_type = p_allergy_type,
                barcode = p_barcode,
                expiration_date = p_expiration_date,
                description = p_description,
                status = p_status,
                is_active = p_is_active,
                note = p_note,
                updated_at = NOW()
            WHERE id = p_product_id;

            COMMIT;

            SELECT ROW_COUNT() as affected_rows;
        END";

        DB::unprepared($procedure);
    }

    private function createGetProductDetailsProcedure()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS GetProductDetails');

        $procedure = "
        CREATE PROCEDURE GetProductDetails(
            IN p_product_id BIGINT
        )
        BEGIN
            SELECT
                p.id,
                p.name,
                p.category_id,
                c.name as category_name,
                p.allergy_type,
                p.barcode,
                p.expiration_date,
                p.description,
                p.status,
                p.is_active,
                p.note,
                p.created_at,
                p.updated_at
            FROM products p
            INNER JOIN categories c ON p.category_id = c.id
            WHERE p.id = p_product_id;
        END";

        DB::unprepared($procedure);
    }

    private function createUpdateWarehouseProcedure()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS UpdateWarehouse');

        $procedure = "
        CREATE PROCEDURE UpdateWarehouse(
            IN p_warehouse_id BIGINT,
            IN p_received_date DATE,
            IN p_delivery_date DATE,
            IN p_package_unit VARCHAR(255),
            IN p_quantity INT,
            IN p_is_active BOOLEAN,
            IN p_note TEXT
        )
        BEGIN
            DECLARE EXIT HANDLER FOR SQLEXCEPTION
            BEGIN
                ROLLBACK;
                RESIGNAL;
            END;

            START TRANSACTION;

            UPDATE warehouses
            SET
                received_date = p_received_date,
                delivery_date = p_delivery_date,
                package_unit = p_package_unit,
                quantity = p_quantity,
                is_active = p_is_active,
                note = p_note,
                updated_at = NOW()
            WHERE id = p_warehouse_id;

            COMMIT;

            SELECT ROW_COUNT() as affected_rows;
        END";

        DB::unprepared($procedure);
    }

    private function createGetWarehouseDetailsProcedure()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS GetWarehouseDetails');

        $procedure = "
        CREATE PROCEDURE GetWarehouseDetails(
            IN p_warehouse_id BIGINT
        )
        BEGIN
            SELECT
                w.id,
                w.received_date,
                w.delivery_date,
                w.package_unit,
                w.quantity,
                w.is_active,
                w.note,
                w.created_at,
                w.updated_at,
                GROUP_CONCAT(p.name SEPARATOR ', ') as products
            FROM warehouses w
            LEFT JOIN product_warehouse pw ON w.id = pw.warehouse_id
            LEFT JOIN products p ON pw.product_id = p.id
            WHERE w.id = p_warehouse_id
            GROUP BY w.id;
        END";

        DB::unprepared($procedure);
    }
}
