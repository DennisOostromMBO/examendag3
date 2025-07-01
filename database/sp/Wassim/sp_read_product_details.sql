-- Stored procedure to get detailed product information
DELIMITER $$

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
END$$

DELIMITER ;
