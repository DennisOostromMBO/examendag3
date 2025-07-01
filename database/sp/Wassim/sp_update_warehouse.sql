-- Stored procedure to update warehouse information
DELIMITER $$

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
END$$

DELIMITER ;
