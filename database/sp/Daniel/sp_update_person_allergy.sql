-- Stored Procedure: sp_update_person_allergy
-- Updates a person's allergy (removes all and adds the new one)

CREATE PROCEDURE sp_update_person_allergy(
    IN in_person_id INT,
    IN in_allergy_id INT
)
BEGIN
    -- Remove all existing allergies for this person
    DELETE FROM allergy_person WHERE person_id = in_person_id;

    -- Add the new allergy
    INSERT INTO allergy_person (person_id, allergy_id, created_at, updated_at)
    VALUES (in_person_id, in_allergy_id, NOW(), NOW());
END
