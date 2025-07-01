-- Stored procedure to read product stock overview with filters
DELIMITER $$

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
        AND c.name = p_category_filter
        ORDER BY p.name ASC;
    END IF;
END$$

DELIMITER ;
