
DELIMITER $$

CREATE DEFINER = 'csfinaluser'@'localhost' TRIGGER add_users_permissions 
AFTER INSERT ON survey_users FOR EACH ROW 
BEGIN
    DECLARE user_id INT;
    DECLARE num_of_study INT;

    SET user_id = (SELECT id FROM survey_users ORDER BY id DESC LIMIT 1);
    SET num_of_study = (SELECT COUNT(*) FROM study);

    insert_loop: LOOP
        if num_of_study < 1 THEN
            LEAVE insert_loop;
        END IF;
        INSERT INTO interviewer_permissions
        (study_id,survey_users_id)
        VALUES(
            num_of_study,
            user_id
        );
        SET num_of_study = num_of_study - 1;
    END LOOP;
END$$

DELIMITER ;
