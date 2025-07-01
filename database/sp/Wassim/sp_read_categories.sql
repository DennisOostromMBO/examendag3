-- Stored procedure to get all active categories
DELIMITER $$

CREATE PROCEDURE GetActiveCategories()
BEGIN
    SELECT 
        id,
        name,
        description
    FROM categories 
    WHERE is_active = 1
    ORDER BY name ASC;
END$$

DELIMITER ;
