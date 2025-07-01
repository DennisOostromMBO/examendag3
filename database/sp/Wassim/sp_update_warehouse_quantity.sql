-- Stored procedure to update warehouse quantity with validation
DELIMITER $$

CREATE PROCEDURE UpdateWarehouseQuantity(
    IN p_product_id BIGINT,
    IN p_new_quantity INT,
    IN p_delivery_date DATE,
    OUT p_result VARCHAR(255),
    OUT p_current_stock INT
)
BEGIN
    DECLARE current_warehouse_qty INT DEFAULT 0;
    DECLARE warehouse_id_val BIGINT;
    DECLARE exit_code INT DEFAULT 0;
    
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        SET p_result = 'DATABASE_ERROR';
        SET p_current_stock = 0;
    END;

    START TRANSACTION;

    -- Get current warehouse quantity for this product
    SELECT w.quantity, w.id 
    INTO current_warehouse_qty, warehouse_id_val
    FROM warehouses w
    INNER JOIN product_warehouse pw ON w.id = pw.warehouse_id
    WHERE pw.product_id = p_product_id
    AND w.is_active = 1
    LIMIT 1;

    SET p_current_stock = current_warehouse_qty;

    -- Check if new quantity is valid (not more than current stock)
    IF p_new_quantity > current_warehouse_qty THEN
        SET p_result = 'INSUFFICIENT_STOCK';
        ROLLBACK;
    ELSE
        -- Update warehouse quantity
        UPDATE warehouses 
        SET quantity = p_new_quantity,
            delivery_date = p_delivery_date,
            updated_at = NOW()
        WHERE id = warehouse_id_val;

        SET p_result = 'SUCCESS';
        COMMIT;
    END IF;
END$$

DELIMITER ;
