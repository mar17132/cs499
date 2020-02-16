
DELIMITER $$

CREATE DEFINER = 'csfinaluser'@'localhost' TRIGGER add_users_permissions 
AFTER INSERT ON survey_users FOR EACH ROW 
BEGIN
    DECLARE user_id INT;
    DECLARE finished INT DEFAULT 0;
    DECLARE studyid INT;   
    
    DECLARE studycursor CURSOR FOR SELECT id FROM csfinal.study;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET finished = 1;

    SET user_id = (SELECT id FROM survey_users ORDER BY id DESC LIMIT 1);

    OPEN studycursor;    

    insert_loop: LOOP
        FETCH studycursor INTO studyid;
        IF finished = 1 THEN
            LEAVE insert_loop;
        END IF;
        INSERT INTO interviewer_permissions
        (study_id,survey_users_id)
        VALUES(
            studyid,
            user_id
        );
    END LOOP;
    CLOSE studycursor;
END$$


CREATE DEFINER = 'csfinaluser'@'localhost' TRIGGER add_population_person_groups
AFTER INSERT ON survey_population FOR EACH ROW 
BEGIN
    DECLARE pop_person_id INT;
    DECLARE finished INTEGER DEFAULT 0;
    DECLARE groupid INTEGER;   
    
    DECLARE groupCursor CURSOR FOR SELECT id FROM sample_group;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET finished = 1;

    SET pop_person_id = (SELECT id FROM survey_population ORDER BY id DESC LIMIT 1);

    OPEN groupCursor;    

    insert_loop: LOOP
        FETCH groupCursor INTO groupid;
        IF finished = 1 THEN
            LEAVE insert_loop;
        END IF;
        INSERT INTO surveyp_to_sampleg
        (survey_population_id,sample_group_id)
        VALUES(
            pop_person_id,
            groupid
        );
    END LOOP;
    CLOSE groupCursor;
END$$

CREATE DEFINER = 'csfinaluser'@'localhost' TRIGGER add_group_to_pops
AFTER INSERT ON sample_group FOR EACH ROW 
BEGIN
    DECLARE sample_group_id INT;
    DECLARE finished INTEGER DEFAULT 0;
    DECLARE popid INTEGER;   
    
    DECLARE popCursor CURSOR FOR SELECT id FROM survey_population;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET finished = 1;

    SET sample_group_id = (SELECT id FROM sample_group ORDER BY id DESC LIMIT 1);

    OPEN popCursor;    

    insert_loop: LOOP
        FETCH popCursor INTO popid;
        IF finished = 1 THEN
            LEAVE insert_loop;
        END IF;
        INSERT INTO surveyp_to_sampleg
        (survey_population_id,sample_group_id)
        VALUES(
            popid,
            sample_group_id
        );
    END LOOP;
    CLOSE popCursor;
END$$


DELIMITER ;
