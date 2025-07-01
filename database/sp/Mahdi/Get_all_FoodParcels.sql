CREATE PROCEDURE Get_all_FoodParcels()
BEGIN
    SELECT
        f.name AS Gezinsnaam,
        f.description AS Omschrijving,
        f.adults AS Volwassenen,
        f.children AS Kinderen,
        f.babies AS Babys,
        CONCAT(p.first_name, ' ', IFNULL(p.insertion, ''), ' ', p.last_name) AS Vertegenwoordiger,
        fw.name AS Eetwens,
        fp.parcel_number AS Pakketnummer,
        fp.composition_date AS DatumSamenstelling,
        fp.issue_date AS DatumUitgifte,
        fp.status AS Status,
        COALESCE(SUM(pfp.product_unit_count), 0) AS AantalProducten
    FROM families f
    LEFT JOIN persons p ON p.family_id = f.id AND p.is_representative = 1
    LEFT JOIN foodwish_family fwf ON fwf.family_id = f.id
    LEFT JOIN foodwishes fw ON fw.id = fwf.foodwish_id
    LEFT JOIN foodparcels fp ON fp.family_id = f.id
    LEFT JOIN product_foodparcel pfp ON pfp.foodparcel_id = fp.id
    GROUP BY
        f.id, f.name, f.description, f.adults, f.children, f.babies,
        p.first_name, p.insertion, p.last_name,
        fw.name,
        fp.parcel_number, fp.composition_date, fp.issue_date, fp.status
    ORDER BY fp.composition_date DESC;
END;
