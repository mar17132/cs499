
/*
interviewer_permissions setup rows
*/


/*
study_to_survey_pop setup rows
*/
CALL add_group_to_study(
    (SELECT id FROM study WHERE name = "Harry Potter Favorite Movie"),
    (SELECT id FROM sample_group WHERE sample_name = "Group1")    
    );

UPDATE study_to_survey_pop SET completed=1,number_of_tries=1
WHERE 
survey_population_id=
(SELECT id FROM survey_population WHERE fname = 'Abraham' AND lname = 'Simpson')
AND sample_group_id=(SELECT id FROM sample_group WHERE sample_name = "Group1")
AND study_id=(SELECT id FROM study WHERE name = "Harry Potter Favorite Movie");

UPDATE study_to_survey_pop SET locked=1
WHERE 
survey_population_id=
(SELECT id FROM survey_population WHERE fname = 'Maggie' AND lname = 'Simpson')
AND sample_group_id=(SELECT id FROM sample_group WHERE sample_name = "Group1")
AND study_id=(SELECT id FROM study WHERE name = "Harry Potter Favorite Movie");

UPDATE study_to_survey_pop SET completed=1,number_of_tries=1
WHERE 
survey_population_id=
(SELECT id FROM survey_population WHERE fname = 'Bart' AND lname = 'Simpson')
AND sample_group_id=(SELECT id FROM sample_group WHERE sample_name = "Group1")
AND study_id=(SELECT id FROM study WHERE name = "Harry Potter Favorite Movie");



CALL add_group_to_study(
    (SELECT id FROM study WHERE name = "Star Wars Favorite Movie"),
    (SELECT id FROM sample_group WHERE sample_name = "Group2")    
    );  

UPDATE study_to_survey_pop SET locked=1
WHERE 
survey_population_id=
(SELECT id FROM survey_population WHERE fname = 'Waylon' AND lname = 'Smithers')
AND sample_group_id=(SELECT id FROM sample_group WHERE sample_name = "Group2")
AND study_id=(SELECT id FROM study WHERE name = "Star Wars Favorite Movie"); 

UPDATE study_to_survey_pop SET locked=1
WHERE 
survey_population_id=
(SELECT id FROM survey_population WHERE fname = 'Patty' AND lname = 'Bouvier')
AND sample_group_id=(SELECT id FROM sample_group WHERE sample_name = "Group2")
AND study_id=(SELECT id FROM study WHERE name = "Star Wars Favorite Movie"); 

UPDATE study_to_survey_pop SET completed=1,number_of_tries=1
WHERE 
survey_population_id=
(SELECT id FROM survey_population WHERE fname = 'Clancy' AND lname = 'Wiggum')
AND sample_group_id=(SELECT id FROM sample_group WHERE sample_name = "Group2")
AND study_id=(SELECT id FROM study WHERE name = "Star Wars Favorite Movie");

UPDATE study_to_survey_pop SET completed=1,number_of_tries=1
WHERE 
survey_population_id=
(SELECT id FROM survey_population WHERE fname = 'Milhouse' AND lname = 'Van Houten')
AND sample_group_id=(SELECT id FROM sample_group WHERE sample_name = "Group2")
AND study_id=(SELECT id FROM study WHERE name = "Star Wars Favorite Movie");



/*
survey_interview setup rows
*/
INSERT INTO survey_interview
(study_to_survey_pop_id,survey_users_id,interview_start,interview_end,type_id)
VALUES(
    (
     SELECT study_to_survey_pop.id FROM study_to_survey_pop INNER JOIN survey_population 
     ON study_to_survey_pop.survey_population_id = survey_population.id
     INNER JOIN sample_group 
     ON study_to_survey_pop.sample_group_id = sample_group.id
     INNER JOIN study ON study_to_survey_pop.study_id = study.id
     WHERE survey_population.fname = 'Abraham' AND survey_population.lname = 'Simpson'
     AND sample_group.sample_name = 'Group1' AND study.name = 'Harry Potter Favorite Movie'    
    ),
    (SELECT id FROM survey_users WHERE uname = 'dav'),
    '2020-01-01 15:00:00',
    '2020-01-01 15:10:00',
    (SELECT id FROM type WHERE type = 'Completed')
);
INSERT INTO survey_interview
(study_to_survey_pop_id,survey_users_id,interview_start,interview_end,type_id)
VALUES(
    (
     SELECT study_to_survey_pop.id FROM study_to_survey_pop INNER JOIN survey_population 
     ON study_to_survey_pop.survey_population_id = survey_population.id
     INNER JOIN sample_group 
     ON study_to_survey_pop.sample_group_id = sample_group.id
     INNER JOIN study ON study_to_survey_pop.study_id = study.id
     WHERE survey_population.fname = 'Maggie' AND survey_population.lname = 'Simpson'
     AND sample_group.sample_name = 'Group1' AND study.name = 'Harry Potter Favorite Movie'    
    ),
    (SELECT id FROM survey_users WHERE uname = 'dav'),
    '2020-01-01 15:25:00',
    NULL,
    (SELECT id FROM type WHERE type = 'In Progress')
);
INSERT INTO survey_interview
(study_to_survey_pop_id,survey_users_id,interview_start,interview_end,type_id)
VALUES(
    (
     SELECT study_to_survey_pop.id FROM study_to_survey_pop INNER JOIN survey_population 
     ON study_to_survey_pop.survey_population_id = survey_population.id
     INNER JOIN sample_group 
     ON study_to_survey_pop.sample_group_id = sample_group.id
     INNER JOIN study ON study_to_survey_pop.study_id = study.id
     WHERE survey_population.fname = 'Bart' AND survey_population.lname = 'Simpson'
     AND sample_group.sample_name = 'Group1' AND study.name = 'Harry Potter Favorite Movie'    
    ),
    (SELECT id FROM survey_users WHERE uname = 'harry'),
    '2020-01-01 15:25:00',
    '2020-01-01 15:45:00',
    (SELECT id FROM type WHERE type = 'Completed')
);
INSERT INTO survey_interview
(study_to_survey_pop_id,survey_users_id,interview_start,interview_end,type_id)
VALUES(
    (
     SELECT study_to_survey_pop.id FROM study_to_survey_pop INNER JOIN survey_population 
     ON study_to_survey_pop.survey_population_id = survey_population.id
     INNER JOIN sample_group 
     ON study_to_survey_pop.sample_group_id = sample_group.id
     INNER JOIN study ON study_to_survey_pop.study_id = study.id
     WHERE survey_population.fname = 'Waylon' AND survey_population.lname = 'Smithers'
     AND sample_group.sample_name = 'Group2' AND study.name = 'Star Wars Favorite Movie'    
    ),
    (SELECT id FROM survey_users WHERE uname = 'barry'),
    '2020-01-01 15:25:00',
    NULL,
    (SELECT id FROM type WHERE type = 'In Progress')
);
INSERT INTO survey_interview
(study_to_survey_pop_id,survey_users_id,interview_start,interview_end,type_id)
VALUES(
    (
     SELECT study_to_survey_pop.id FROM study_to_survey_pop INNER JOIN survey_population 
     ON study_to_survey_pop.survey_population_id = survey_population.id
     INNER JOIN sample_group 
     ON study_to_survey_pop.sample_group_id = sample_group.id
     INNER JOIN study ON study_to_survey_pop.study_id = study.id
     WHERE survey_population.fname = 'Patty' AND survey_population.lname = 'Bouvier'
     AND sample_group.sample_name = 'Group2' AND study.name = 'Star Wars Favorite Movie'    
    ),
    (SELECT id FROM survey_users WHERE uname = 'bob'),
    '2020-01-01 15:25:00',
    NULL,
    (SELECT id FROM type WHERE type = 'In Progress')
);
INSERT INTO survey_interview
(study_to_survey_pop_id,survey_users_id,interview_start,interview_end,type_id)
VALUES(
    (
     SELECT study_to_survey_pop.id FROM study_to_survey_pop INNER JOIN survey_population 
     ON study_to_survey_pop.survey_population_id = survey_population.id
     INNER JOIN sample_group 
     ON study_to_survey_pop.sample_group_id = sample_group.id
     INNER JOIN study ON study_to_survey_pop.study_id = study.id
     WHERE survey_population.fname = 'Milhouse' AND survey_population.lname = 'Van Houten'
     AND sample_group.sample_name = 'Group2' AND study.name = 'Star Wars Favorite Movie'    
    ),
    (SELECT id FROM survey_users WHERE uname = 'tom'),
    '2020-01-01 15:25:00',
    '2020-01-01 17:25:00',
    (SELECT id FROM type WHERE type = 'Completed')
);
INSERT INTO survey_interview
(study_to_survey_pop_id,survey_users_id,interview_start,interview_end,type_id)
VALUES(
    (
     SELECT study_to_survey_pop.id FROM study_to_survey_pop INNER JOIN survey_population 
     ON study_to_survey_pop.survey_population_id = survey_population.id
     INNER JOIN sample_group 
     ON study_to_survey_pop.sample_group_id = sample_group.id
     INNER JOIN study ON study_to_survey_pop.study_id = study.id
     WHERE survey_population.fname = 'Clancy' AND survey_population.lname = 'Wiggum'
     AND sample_group.sample_name = 'Group2' AND study.name = 'Star Wars Favorite Movie'    
    ),
    (SELECT id FROM survey_users WHERE uname = 'dick'),
    '2020-01-01 15:25:00',
    '2020-01-01 17:25:00',
    (SELECT id FROM type WHERE type = 'Completed')
);

/*
survey_queue setup rows
*/

UPDATE survey_queue SET in_waiting_queue=0 WHERE 
study_to_survey_pop_id=
(
    SELECT study_to_survey_pop.id FROM study_to_survey_pop
    INNER JOIN study ON study_to_survey_pop.study_id = study.id
    INNER JOIN sample_group ON 
    study_to_survey_pop.sample_group_id = sample_group.id
    INNER JOIN survey_population ON 
    study_to_survey_pop.survey_population_id = survey_population.id
    WHERE survey_population.fname = 'Abraham' AND 
    survey_population.lname = 'Simpson'
    AND sample_group.sample_name = 'Group1' AND 
    study.name = 'Harry Potter Favorite Movie' 
);

UPDATE survey_queue SET in_waiting_queue=0 WHERE 
study_to_survey_pop_id=
(
    SELECT study_to_survey_pop.id FROM study_to_survey_pop
    INNER JOIN study ON study_to_survey_pop.study_id = study.id
    INNER JOIN sample_group ON 
    study_to_survey_pop.sample_group_id = sample_group.id
    INNER JOIN survey_population ON 
    study_to_survey_pop.survey_population_id = survey_population.id
    WHERE survey_population.fname = 'Maggie' AND 
    survey_population.lname = 'Simpson'
    AND sample_group.sample_name = 'Group1' AND 
    study.name = 'Harry Potter Favorite Movie' 
);

UPDATE survey_queue SET in_waiting_queue=0 WHERE 
study_to_survey_pop_id=
(
    SELECT study_to_survey_pop.id FROM study_to_survey_pop
    INNER JOIN study ON study_to_survey_pop.study_id = study.id
    INNER JOIN sample_group ON 
    study_to_survey_pop.sample_group_id = sample_group.id
    INNER JOIN survey_population ON 
    study_to_survey_pop.survey_population_id = survey_population.id
    WHERE survey_population.fname = 'Bart' AND 
    survey_population.lname = 'Simpson'
    AND sample_group.sample_name = 'Group1' AND 
    study.name = 'Harry Potter Favorite Movie' 
);


UPDATE survey_queue SET in_waiting_queue=0 WHERE 
study_to_survey_pop_id=
(
    SELECT study_to_survey_pop.id FROM study_to_survey_pop
    INNER JOIN study ON study_to_survey_pop.study_id = study.id
    INNER JOIN sample_group ON 
    study_to_survey_pop.sample_group_id = sample_group.id
    INNER JOIN survey_population ON 
    study_to_survey_pop.survey_population_id = survey_population.id
    WHERE survey_population.fname = 'Waylon' AND 
    survey_population.lname = 'Smithers'
    AND sample_group.sample_name = 'Group2' AND 
    study.name = 'Star Wars Favorite Movie' 
);

UPDATE survey_queue SET in_waiting_queue=0 WHERE 
study_to_survey_pop_id=
(
    SELECT study_to_survey_pop.id FROM study_to_survey_pop
    INNER JOIN study ON study_to_survey_pop.study_id = study.id
    INNER JOIN sample_group ON 
    study_to_survey_pop.sample_group_id = sample_group.id
    INNER JOIN survey_population ON 
    study_to_survey_pop.survey_population_id = survey_population.id
    WHERE survey_population.fname = 'Patty' AND 
    survey_population.lname = 'Bouvier'
    AND sample_group.sample_name = 'Group2' AND 
    study.name = 'Star Wars Favorite Movie' 
);

UPDATE survey_queue SET in_waiting_queue=0 WHERE 
study_to_survey_pop_id=
(
    SELECT study_to_survey_pop.id FROM study_to_survey_pop
    INNER JOIN study ON study_to_survey_pop.study_id = study.id
    INNER JOIN sample_group ON 
    study_to_survey_pop.sample_group_id = sample_group.id
    INNER JOIN survey_population ON 
    study_to_survey_pop.survey_population_id = survey_population.id
    WHERE survey_population.fname = 'Clancy' AND 
    survey_population.lname = 'Wiggum'
    AND sample_group.sample_name = 'Group2' AND 
    study.name = 'Star Wars Favorite Movie' 
);

UPDATE survey_queue SET in_waiting_queue=0 WHERE 
study_to_survey_pop_id=
(
    SELECT study_to_survey_pop.id FROM study_to_survey_pop
    INNER JOIN study ON study_to_survey_pop.study_id = study.id
    INNER JOIN sample_group ON 
    study_to_survey_pop.sample_group_id = sample_group.id
    INNER JOIN survey_population ON 
    study_to_survey_pop.survey_population_id = survey_population.id
    WHERE survey_population.fname = 'Milhouse' AND 
    survey_population.lname = 'Van Houten'
    AND sample_group.sample_name = 'Group2' AND 
    study.name = 'Star Wars Favorite Movie' 
);
