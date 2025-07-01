CREATE PROCEDURE Update_Food_Parcel_Status_And_IssueDate(
    IN p_foodparcel_id INT,
    IN p_status VARCHAR(50),
    IN p_issue_date DATE
)
BEGIN
    UPDATE foodparcels
    SET
        status = p_status,
        issue_date = p_issue_date
    WHERE id = p_foodparcel_id;
END;
