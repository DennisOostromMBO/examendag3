-- Stored Procedure: sp_get_families_with_allergies
-- Returns families with allergy details for the overview page


CREATE PROCEDURE sp_get_families_with_allergies(IN allergy_id INT)
BEGIN
    IF allergy_id IS NULL THEN
        SELECT 
            f.id AS familie_id,
            f.name AS familie_naam,
            f.description AS familie_omschrijving,
            f.adults AS volwassenen,
            f.children AS kinderen,
            f.babies AS babys,
            (SELECT CONCAT(p2.first_name, ' ', IFNULL(p2.insertion, ''), ' ', p2.last_name)
             FROM persons p2
             WHERE p2.family_id = f.id AND p2.is_representative = 1
             LIMIT 1) AS vertegenwoordiger,
            -- Only select MIN(a.id) to get one allergy per family for deduplication
            MIN(a.name) AS allergie_naam,
            MIN(a.description) AS allergie_omschrijving
        FROM families f
        JOIN persons p ON p.family_id = f.id
        JOIN allergy_person ap ON ap.person_id = p.id
        JOIN allergies a ON a.id = ap.allergy_id
        GROUP BY f.id
        ORDER BY f.name;
    ELSE
        SELECT 
            f.id AS familie_id,
            f.name AS familie_naam,
            f.description AS familie_omschrijving,
            f.adults AS volwassenen,
            f.children AS kinderen,
            f.babies AS babys,
            (SELECT CONCAT(p2.first_name, ' ', IFNULL(p2.insertion, ''), ' ', p2.last_name)
             FROM persons p2
             WHERE p2.family_id = f.id AND p2.is_representative = 1
             LIMIT 1) AS vertegenwoordiger,
            a.name AS allergie_naam,
            a.description AS allergie_omschrijving
        FROM families f
        JOIN persons p ON p.family_id = f.id
        JOIN allergy_person ap ON ap.person_id = p.id
        JOIN allergies a ON a.id = ap.allergy_id
        WHERE a.id = allergy_id
        GROUP BY f.id
        ORDER BY f.name;
    END IF;
END


