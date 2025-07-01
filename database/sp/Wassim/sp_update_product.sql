-- Stored procedure to update product information
DELIMITER $$

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
END$$

DELIMITER ;
