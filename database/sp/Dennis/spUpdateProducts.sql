DELIMITER $$

CREATE PROCEDURE spUpdateProducts(
    IN in_product_id INT,
    IN in_expiration_date DATE
)
BEGIN
    UPDATE products
    SET expiration_date = in_expiration_date
    WHERE id = in_product_id;
END$$

DELIMITER ;
