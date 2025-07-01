CREATE PROCEDURE spGetAllProductsBySupplierId(IN in_supplier_id INT)
BEGIN
    SELECT
        p.id,
        p.name,
        p.allergy_type,
        p.barcode,
        p.expiration_date
    FROM products p
    INNER JOIN product_supplier ps ON ps.product_id = p.id
    WHERE ps.supplier_id = in_supplier_id;
END;


