-- Stored Procedure: sp_get_families_with_allergies
-- Returns families with allergy details for the overview page


CREATE PROCEDURE sp_get_families_with_allergies(IN allergy_id INT)
BEGIN
    SELECT 
        f.name AS familie_naam,
        f.description AS familie_omschrijving,
        f.adults AS volwassenen,
        f.children AS kinderen,
        f.babies AS babys,
        -- Get representative's full name (first person with is_representative = 1 in this family)
        (SELECT CONCAT(p.first_name, ' ', IFNULL(p.insertion, ''), ' ', p.last_name)
         FROM persons p
         WHERE p.family_id = f.id AND p.is_representative = 1
         LIMIT 1) AS vertegenwoordiger,
        a.name AS allergie_naam,
        a.description AS allergie_omschrijving
    FROM families f
    CROSS JOIN allergies a
    WHERE (allergy_id IS NULL OR a.id = allergy_id)
    ORDER BY f.name, a.name;
END


