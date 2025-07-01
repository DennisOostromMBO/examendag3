-- Stored Procedure: sp_get_families_with_allergies
-- Returns families with allergy details for the overview page


CREATE PROCEDURE sp_get_families_with_allergies(IN allergy_id INT)
BEGIN
    SELECT 
        f.Naam AS familie_naam,
        f.Omschrijving AS familie_omschrijving,
        (SELECT COUNT(*) FROM persons p WHERE p.family_id = f.Id AND p.type = 'volwassene') AS volwassenen,
        (SELECT COUNT(*) FROM persons p WHERE p.family_id = f.Id AND p.type = 'kind') AS kinderen,
        (SELECT COUNT(*) FROM persons p WHERE p.family_id = f.Id AND p.type = 'baby') AS babys,
        v.Naam AS vertegenwoordiger,
        a.Naam AS allergie_naam,
        a.Omschrijving AS allergie_omschrijving
    FROM families f
    JOIN contact_family cf ON cf.family_id = f.Id
    JOIN persons v ON v.Id = f.vertegenwoordiger_id
    JOIN foodwishes fw ON fw.family_id = f.Id
    JOIN allergies a ON a.Id = fw.allergy_id
    WHERE (allergy_id IS NULL OR a.Id = allergy_id)
    GROUP BY f.Id, a.Id;
END 


