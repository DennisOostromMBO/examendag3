-- Stored procedure to get warehouse details with product information
DELIMITER $$

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
END$$

DELIMITER ;
