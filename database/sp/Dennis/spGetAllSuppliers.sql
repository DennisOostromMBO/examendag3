CREATE PROCEDURE spGetAllSuppliers()
BEGIN
    SELECT
        s.id,
        s.name,
        s.contact_person,
        s.supplier_number,
        s.supplier_type,
        c.email,
        c.mobile
    FROM suppliers s
    INNER JOIN contact_supplier cs ON cs.supplier_id = s.id
    INNER JOIN contacts c ON c.id = cs.contact_id;
END;
