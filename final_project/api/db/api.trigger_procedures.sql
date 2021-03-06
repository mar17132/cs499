
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

CREATE DEFINER = 'csfinaluser'@'localhost' TRIGGER add_study_permissions 
AFTER INSERT ON study FOR EACH ROW 
BEGIN
    DECLARE study_id INT;
    DECLARE finished INT DEFAULT 0;
    DECLARE userid INT;   
    
    DECLARE usercursor CURSOR FOR SELECT id FROM csfinal.survey_users;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET finished = 1;

    SET study_id = (SELECT id FROM study ORDER BY id DESC LIMIT 1);

    OPEN usercursor;    

    insert_loop: LOOP
        FETCH usercursor INTO userid;
        IF finished = 1 THEN
            LEAVE insert_loop;
        END IF;
        INSERT INTO interviewer_permissions
        (study_id,survey_users_id)
        VALUES(
            study_id,
            userid
        );
    END LOOP;
    CLOSE usercursor;
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

CREATE DEFINER = 'csfinaluser'@'localhost' PROCEDURE add_group_to_study
(IN studyid INT, IN groupid INT)
BEGIN
    DECLARE finished INTEGER DEFAULT 0;
    DECLARE popid INTEGER;   
    
    DECLARE popCursor CURSOR FOR SELECT survey_population_id 
    FROM surveyp_to_sampleg WHERE sample_group_id=groupid AND member='1';
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET finished = 1;

    OPEN popCursor;    

    insert_loop: LOOP
        FETCH popCursor INTO popid;
        IF finished = 1 THEN
            LEAVE insert_loop;
        END IF;
        INSERT INTO study_to_survey_pop
        (survey_population_id,sample_group_id,study_id)
        VALUES(
            popid,
            groupid,
            studyid
        );
    END LOOP;
    CLOSE popCursor;

    SELECT * FROM study_to_survey_pop 
    WHERE sample_group_id=groupid AND study_id=studyid;

END$$

CREATE DEFINER = 'csfinaluser'@'localhost' TRIGGER add_pop_to_que
AFTER INSERT ON study_to_survey_pop FOR EACH ROW 
BEGIN

    DECLARE pop_survey_id INT;

    SET pop_survey_id = (SELECT id FROM study_to_survey_pop ORDER BY id DESC LIMIT 1);

    INSERT INTO survey_queue(study_to_survey_pop_id)
    VALUES(pop_survey_id);

END$$

CREATE DEFINER = 'csfinaluser'@'localhost' TRIGGER add_popgroup_study
AFTER UPDATE ON surveyp_to_sampleg FOR EACH ROW 
BEGIN

    DECLARE studyid INT;
    DECLARE finished INTEGER DEFAULT 0; 
    
    DECLARE studyCursor CURSOR FOR SELECT DISTINCT(study_id) FROM study_to_survey_pop
    WHERE study_to_survey_pop.sample_group_id = NEW.sample_group_id;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET finished = 1;
    
    IF NEW.member = 1 AND OLD.member = 0 THEN
        OPEN studyCursor;    

        insert_loop: LOOP
            FETCH studyCursor INTO studyid;
            IF finished = 1 THEN
                LEAVE insert_loop;
            END IF;
        
                INSERT INTO study_to_survey_pop
                (survey_population_id,sample_group_id,study_id)
                VALUES(
                    NEW.survey_population_id,
                    NEW.sample_group_id,
                    studyid
                );

        END LOOP;
        CLOSE studyCursor;
    ELSEIF NEW.member = 0 AND OLD.member = 1 THEN
        DELETE FROM study_to_survey_pop WHERE 
        study_to_survey_pop.survey_population_id = NEW.survey_population_id
        AND study_to_survey_pop.sample_group_id = NEW.sample_group_id;
    END IF;    
END$$


CREATE DEFINER = 'csfinaluser'@'localhost' PROCEDURE start_cancel_survey
(IN queid INT, IN userid INT, IN start_cancel BOOLEAN)
BEGIN
    DECLARE sspopid INTEGER; 

    SET sspopid = (SELECT study_to_survey_pop_id FROM survey_queue WHERE id=queid);


    IF start_cancel = 1 THEN

        UPDATE study_to_survey_pop SET locked=1 WHERE id=sspopid;

        UPDATE survey_queue SET in_waiting_queue=0 WHERE id=queid;

        INSERT INTO survey_interview
        (study_to_survey_pop_id,survey_users_id,type_id)
        VALUES(
            sspopid,
            userid,
            8
        );

        SELECT id AS surv_int_id FROM survey_interview ORDER BY id DESC LIMIT 1;

    ELSEIF start_cancel = 0 THEN

        UPDATE study_to_survey_pop SET locked=0 WHERE id=sspopid;

        UPDATE survey_queue SET in_waiting_queue=1 WHERE id=queid;

        DELETE FROM survey_interview WHERE study_to_survey_pop_id=sspopid
        AND (interview_end = '' OR interview_end IS NULL) AND type_id=8;

    END IF;

END$$


CREATE DEFINER = 'csfinaluser'@'localhost' PROCEDURE end_survey
(IN interviewerid INT,IN queid INT,IN popid INT,IN studyid INT,IN groupid INT,
IN typeid INT,IN surveyintID INT)
BEGIN
    DECLARE study_numoftry INTEGER; 
    DECLARE pop_numoftry INTEGER;

    SET study_numoftry = (SELECT try_amount FROM study WHERE id=studyid);
    SET pop_numoftry = (SELECT number_of_tries FROM study_to_survey_pop WHERE
    study_id=studyid AND sample_group_id=groupid 
    AND survey_population_id=popid) + 1;

    UPDATE survey_interview SET interview_end=current_timestamp(),type_id=typeid
    WHERE id=surveyintID;

    IF (typeid = 3 OR typeid = 2) OR pop_numoftry = study_numoftry THEN

        UPDATE study_to_survey_pop SET locked=0,number_of_tries=pop_numoftry,
        completed=1 WHERE study_id=studyid AND sample_group_id=groupid
        AND survey_population_id=popid; 

    ELSEIF (typeid = 4 OR typeid = 1) AND pop_numoftry < study_numoftry THEN

        UPDATE study_to_survey_pop SET locked=0,number_of_tries=pop_numoftry
        WHERE study_id=studyid AND sample_group_id=groupid
        AND survey_population_id=popid;

        UPDATE survey_queue SET in_waiting_queue=1 WHERE id=queid;

    END IF;

END$$

CREATE DEFINER = 'csfinaluser'@'localhost' PROCEDURE record_anwsers_mult_check
(IN survintervewid INT,IN questionid INT, IN anwserid INT,IN quest_typeid INT)
BEGIN

    IF quest_typeid = 9 THEN
        INSERT INTO respons_to_checkbox(question_id,survey_interview_id,
        anwsers_checkbox_id)
        VALUES(
            questionid,
            survintervewid,
            anwserid
        );
    ELSEIF quest_typeid = 11 THEN
        INSERT INTO respons_to_multi_choice(question_id,survey_interview_id,
        anwsers_multi_choices_id)
        VALUES(
            questionid,
            survintervewid,
            anwserid
        );
    END IF;

END$$

CREATE DEFINER = 'csfinaluser'@'localhost' PROCEDURE record_anwsers_fill
(IN survintervewid INT,IN questionid INT, IN anwser VARCHAR(255))
BEGIN

    INSERT INTO respons_to_fillinblank(question_id,survey_interview_id,respons)
    VALUES(
        questionid,
        survintervewid,
        anwser
    );

END$$

CREATE DEFINER = 'csfinaluser'@'localhost' PROCEDURE system_count()
BEGIN
    
    CREATE TEMPORARY TABLE count_table(
        study_count INT,
        pop_count INT,
        user_count INT
    );

    INSERT INTO count_table(study_count,pop_count,user_count)
    VALUES(
        (SELECT COUNT(id) FROM study),
        (SELECT COUNT(id) FROM survey_population),
        (SELECT COUNT(id) FROM survey_users)
    );

    SELECT * FROM count_table;

    DROP TEMPORARY TABLE count_table;

END$$

CREATE DEFINER = 'csfinaluser'@'localhost' PROCEDURE study_stats()
BEGIN

    DECLARE finished INTEGER DEFAULT 0;
    DECLARE studyid INTEGER;   
    DECLARE studyname VARCHAR(255); 
    
    DECLARE studyCursor CURSOR FOR SELECT id,name FROM study;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET finished = 1;

    CREATE TEMPORARY TABLE study_stats_table(
        studyid INT,
        studyname VARCHAR(255),
        question_count INT,
        study_pop_count INT,
        completed_surveys_count INT
    );

    OPEN studyCursor;    

    insert_loop: LOOP
        FETCH studyCursor INTO studyid,studyname;
        IF finished = 1 THEN
            LEAVE insert_loop;
        END IF;

        INSERT INTO study_stats_table(studyid,studyname,
        question_count,study_pop_count,completed_surveys_count)
        VALUES(
            studyid,
            studyname,
            (SELECT COUNT(id) FROM study_to_question WHERE study_id=studyid),
            (SELECT COUNT(survey_population.id) FROM survey_population 
             JOIN study_to_survey_pop 
             ON study_to_survey_pop.survey_population_id = survey_population.id
             WHERE study_to_survey_pop.study_id = studyid
            ),
            (SELECT COUNT(id) FROM study_to_survey_pop 
             WHERE study_id=studyid AND completed=1
            )
        );

    END LOOP;

    CLOSE studyCursor;


    SELECT * FROM study_stats_table;

    DROP TEMPORARY TABLE study_stats_table;

END$$

CREATE DEFINER = 'csfinaluser'@'localhost' PROCEDURE checkbox_stats
(IN studyid INT,IN questionid INT,IN completed_count INT)
BEGIN

    DECLARE finished INTEGER DEFAULT 0;
    DECLARE anwserid INTEGER;
    DECLARE anwsername VARCHAR(255);

    DECLARE checkboxCursor CURSOR FOR SELECT  
    anwsers_checkbox.id AS anwserid,anwsers_checkbox.anwser 
    FROM anwsers_checkbox  
    JOIN study_to_question ON 
    anwsers_checkbox.question_id = study_to_question.question_id
    WHERE study_to_question.question_id=questionid 
    AND study_to_question.study_id=studyid;  

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET finished = 1;


    OPEN checkboxCursor;    

    insert_loop: LOOP
        FETCH checkboxCursor INTO anwserid,anwsername;
        IF finished = 1 THEN
            LEAVE insert_loop;
        END IF;

        INSERT INTO answer_stats_table
        (anwserid,anwsername,anwser_count,total_surveys)
        VALUES(
            anwserid,
            anwsername,
            (SELECT COUNT(respons_to_checkbox.anwsers_checkbox_id) 
            FROM respons_to_checkbox
            JOIN study_to_question ON 
            respons_to_checkbox.question_id = study_to_question.question_id
            JOIN anwsers_checkbox ON
            respons_to_checkbox.anwsers_checkbox_id = anwsers_checkbox.id
            WHERE study_to_question.question_id=questionid 
            AND study_to_question.study_id=studyid 
            AND respons_to_checkbox.anwsers_checkbox_id=anwserid
            ),
            completed_count
        );


    END LOOP;

    CLOSE checkboxCursor;

END$$

CREATE DEFINER = 'csfinaluser'@'localhost' PROCEDURE multi_stats
(IN studyid INT,IN questionid INT,IN completed_count INT)
BEGIN

    DECLARE finished INTEGER DEFAULT 0;
    DECLARE anwserid INTEGER;
    DECLARE anwsername VARCHAR(255);

    DECLARE multiCursor CURSOR FOR SELECT  
    anwsers_multi_choices.id AS anwserid,anwsers_multi_choices.anwser 
    FROM anwsers_multi_choices  
    JOIN study_to_question ON 
    anwsers_multi_choices.question_id = study_to_question.question_id
    WHERE study_to_question.question_id=questionid 
    AND study_to_question.study_id=studyid;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET finished = 1;


    OPEN multiCursor;    

    insert_loop: LOOP
        FETCH multiCursor INTO anwserid,anwsername;
        IF finished = 1 THEN
            LEAVE insert_loop;
        END IF;

        INSERT INTO answer_stats_table
        (anwserid,anwsername,anwser_count,total_surveys)
        VALUES(
            anwserid,
            anwsername,
            (SELECT COUNT(respons_to_multi_choice.anwsers_multi_choices_id) 
            FROM respons_to_multi_choice
            JOIN study_to_question ON 
            respons_to_multi_choice.question_id = study_to_question.question_id
            JOIN anwsers_multi_choices ON
            respons_to_multi_choice.anwsers_multi_choices_id = 
            anwsers_multi_choices.id
            WHERE study_to_question.question_id=questionid 
            AND study_to_question.study_id=studyid 
            AND respons_to_multi_choice.anwsers_multi_choices_id=anwserid
            ),
            completed_count
        );


    END LOOP;

    CLOSE multiCursor;

END$$

CREATE DEFINER = 'csfinaluser'@'localhost' PROCEDURE fill_stats
(IN studyid INT,IN questionid INT,IN completed_count INT)
BEGIN

    DECLARE finished INTEGER DEFAULT 0;
    DECLARE anwsername VARCHAR(255);

    DECLARE fillinCursor CURSOR FOR 
    SELECT DISTINCT respons_to_fillinblank.respons 
    FROM respons_to_fillinblank
    JOIN study_to_question ON 
    respons_to_fillinblank.question_id = study_to_question.question_id
    WHERE study_to_question.question_id=questionid 
    AND study_to_question.study_id=studyid;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET finished = 1;

    OPEN fillinCursor;    

    insert_loop: LOOP
        FETCH fillinCursor INTO anwsername;
        IF finished = 1 THEN
            LEAVE insert_loop;
        END IF;

        INSERT INTO answer_stats_table
        (anwsername,anwser_count,total_surveys)
        VALUES(
            anwsername,
            (SELECT COUNT(respons_to_fillinblank.respons) 
            FROM respons_to_fillinblank
            JOIN study_to_question ON 
            respons_to_fillinblank.question_id=study_to_question.question_id
            WHERE study_to_question.question_id=questionid 
            AND study_to_question.study_id=studyid
            AND respons_to_fillinblank.respons=anwsername
            ),
            completed_count
        );
    END LOOP;

    CLOSE fillinCursor;

END$$

CREATE DEFINER = 'csfinaluser'@'localhost' PROCEDURE question_stats
(IN studyid INT,IN questionid INT)
BEGIN

   DECLARE typeid INTEGER;
   DECLARE num_of_serveys INTEGER; 

   SET typeid = (SELECT type_id FROM question WHERE id=questionid);
   SET num_of_serveys = (SELECT COUNT(study_to_survey_pop.id) 
   FROM study_to_survey_pop 
   JOIN survey_interview 
   ON survey_interview.study_to_survey_pop_id = study_to_survey_pop.id
   WHERE study_to_survey_pop.completed=1 
   AND study_to_survey_pop.study_id=studyid 
   AND survey_interview.type_id=3);

    CREATE TEMPORARY TABLE answer_stats_table(
        anwserid INT,
        anwsername VARCHAR(255),
        anwser_count INT,
        total_surveys INT
    );

    IF typeid = 9 THEN
    /*checkbox*/
    CALL checkbox_stats(studyid,questionid,num_of_serveys);
    ELSEIF typeid = 11 THEN
    /*Multiple Choice*/
    CALL multi_stats(studyid,questionid,num_of_serveys);
    ELSEIF typeid = 10 THEN
    /*Fill in the blank*/
    CALL fill_stats(studyid,questionid,num_of_serveys);
    END IF;

   SELECT * FROM answer_stats_table;

   DROP TEMPORARY TABLE answer_stats_table;

END$$

DELIMITER ;


