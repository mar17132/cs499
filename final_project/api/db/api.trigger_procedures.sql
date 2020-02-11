
DELIMITER $$

/*CREATE DEFINER = 'csfinaluser'@'localhost' TRIGGER add_users_permissions 
AFTER INSERT ON survey_users FOR EACH ROW 
BEGIN
    DECLARE user_id INT;
    DECLARE num_of_study INT;

    SET user_id = (SELECT id FROM survey_users ORDER BY id DESC LIMIT 1);
    SET num_of_study = (SELECT COUNT(*) FROM study);

    insert_loop: LOOP
        IF num_of_study < 1 THEN
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
END$$*/

CREATE DEFINER = 'csfinaluser'@'localhost' TRIGGER add_users_permissions 
AFTER INSERT ON survey_users FOR EACH ROW 
BEGIN
    DECLARE user_id INT;
    DECLARE finished INTEGER DEFAULT 0;
    DECLARE studyid INTEGER;
    
    SET user_id = (SELECT id FROM survey_users ORDER BY id DESC LIMIT 1);
    
    DECLARE studyCursor CURSOR FOR SELECT id FROM study;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET finished = 1;
    
    OPEN studyCursor;
    

    insert_loop: LOOP
        FETCH studyCursor INTO studyid;
        IF finished = 1 THEN
            LEAVE insert_loop;
        END IF;
        INSERT INTO interviewer_permissions
        (study_id,survey_users_id)
        VALUES(
            studyid,
            user_id
        );
        SET num_of_study = num_of_study - 1;
    END LOOP;
    CLOSE studyCursor;
END$$

CREATE DEFINER = 'csfinaluser'@'localhost' TRIGGER add_population_person_groups 
AFTER INSERT ON survey_population FOR EACH ROW 
BEGIN
    DECLARE pop_person_id INT;
    DECLARE num_of_groups INT;

    SET pop_person_id = (SELECT id FROM survey_population ORDER BY id DESC LIMIT 1);
    SET num_of_groups = (SELECT COUNT(*) FROM sample_group);

    insert_loop: LOOP
        IF num_of_groups < 1 THEN
            LEAVE insert_loop;
        END IF;
        INSERT INTO surveyp_to_sampleg
        (survey_population_id,sample_group_id)
        VALUES(
            pop_person_id,
            num_of_groups
        );
        SET num_of_groups = num_of_groups - 1;
    END LOOP;
END$$

DELIMITER ;
