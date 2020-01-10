/*
* Created By: Matthew Martin
* Created On: 01/01/2020
* Modified By: Matthew Martin
* Modified On: 01/01/2020
* Description: This script is to create start data for 
* study tables the csfinal project.
*/

USE csfinal;

/*
Study setup rows
*/
INSERT INTO study(name,type_id,order_questions,start_date,end_date,try_amount)
VALUES(
    "Star Wars Favorite Movie",
    (SELECT id FROM type WHERE type = "Movies"),
    0,
    '2020-01-01 00:00:00',
    '2020-04-15 00:00:00',
    1
);
INSERT INTO study(name,type_id,order_questions,start_date,end_date,try_amount)
VALUES(
    "Star Wars vs Star Trek",
    (SELECT id FROM type WHERE type = "Movies"),
    0,
    '2020-01-01 00:00:00',
    '2020-04-15 00:00:00',
    1
);
INSERT INTO study(name,type_id,order_questions,start_date,end_date,try_amount)
VALUES(
    "Harry Potter Favorite Movie",
    (SELECT id FROM type WHERE type = "Movies"),
    0,
    '2020-01-01 00:00:00',
    '2020-04-15 00:00:00',
    1
);

/*
interviewer_permissions setup rows
*/
INSERT INTO interviewer_permissions(study_id,survey_users_id,allowed_permission)
VALUES(
    (SELECT id FROM study WHERE name = "Harry Potter Favorite Movie"),
    (SELECT id FROM survey_users WHERE uname = "dav"),
    1
);
INSERT INTO interviewer_permissions(study_id,survey_users_id,allowed_permission)
VALUES(
    (SELECT id FROM study WHERE name = "Harry Potter Favorite Movie"),
    (SELECT id FROM survey_users WHERE uname = "harry"),
    1
);
INSERT INTO interviewer_permissions(study_id,survey_users_id,allowed_permission)
VALUES(
    (SELECT id FROM study WHERE name = "Harry Potter Favorite Movie"),
    (SELECT id FROM survey_users WHERE uname = "tom"),
    1
);
INSERT INTO interviewer_permissions(study_id,survey_users_id,allowed_permission)
VALUES(
    (SELECT id FROM study WHERE name = "Star Wars Favorite Movie"),
    (SELECT id FROM survey_users WHERE uname = "dav"),
    1
);
INSERT INTO interviewer_permissions(study_id,survey_users_id,allowed_permission)
VALUES(
    (SELECT id FROM study WHERE name = "Star Wars Favorite Movie"),
    (SELECT id FROM survey_users WHERE uname = "harry"),
    1
);
INSERT INTO interviewer_permissions(study_id,survey_users_id,allowed_permission)
VALUES(
    (SELECT id FROM study WHERE name = "Star Wars Favorite Movie"),
    (SELECT id FROM survey_users WHERE uname = "tom"),
    1
);

/*
study_to_survey_pop setup rows
*/
INSERT INTO study_to_survey_pop
(study_id,sample_group_id,survey_population_id,completed,locked,number_of_tries)
VALUES(
    (SELECT id FROM study WHERE name = "Harry Potter Favorite Movie"),
    (SELECT id FROM sample_group WHERE sample_name = "Group1"),
    (SELECT id FROM survey_population WHERE fname = 'Hommer' AND lname = 'Simpsons'),
    0,
    0,
    1
);
INSERT INTO study_to_survey_pop
(study_id,sample_group_id,survey_population_id,completed,locked,number_of_tries)
VALUES(
    (SELECT id FROM study WHERE name = "Harry Potter Favorite Movie"),
    (SELECT id FROM sample_group WHERE sample_name = "Group1"),
    (SELECT id FROM survey_population WHERE fname = 'Abraham' AND lname = 'Simpsons'),
    1,
    0,
    1
);
INSERT INTO study_to_survey_pop
(study_id,sample_group_id,survey_population_id,completed,locked,number_of_tries)
VALUES(
    (SELECT id FROM study WHERE name = "Harry Potter Favorite Movie"),
    (SELECT id FROM sample_group WHERE sample_name = "Group1"),
    (SELECT id FROM survey_population WHERE fname = 'Maggie' AND lname = 'Simpsons'),
    0,
    1,
    1
);
INSERT INTO study_to_survey_pop
(study_id,sample_group_id,survey_population_id,completed,locked,number_of_tries)
VALUES(
    (SELECT id FROM study WHERE name = "Harry Potter Favorite Movie"),
    (SELECT id FROM sample_group WHERE sample_name = "Group1"),
    (SELECT id FROM survey_population WHERE fname = 'Lisa' AND lname = 'Simpsons'),
    0,
    0,
    1
);
INSERT INTO study_to_survey_pop
(study_id,sample_group_id,survey_population_id,completed,locked,number_of_tries)
VALUES(
    (SELECT id FROM study WHERE name = "Harry Potter Favorite Movie"),
    (SELECT id FROM sample_group WHERE sample_name = "Group1"),
    (SELECT id FROM survey_population WHERE fname = 'Marge' AND lname = 'Simpsons'),
    0,
    0,
    1
);
INSERT INTO study_to_survey_pop
(study_id,sample_group_id,survey_population_id,completed,locked,number_of_tries)
VALUES(
    (SELECT id FROM study WHERE name = "Harry Potter Favorite Movie"),
    (SELECT id FROM sample_group WHERE sample_name = "Group1"),
    (SELECT id FROM survey_population WHERE fname = 'Bart' AND lname = 'Simpsons'),
    0,
    1,
    1
);
INSERT INTO study_to_survey_pop
(study_id,sample_group_id,survey_population_id,completed,locked,number_of_tries)
VALUES(
    (SELECT id FROM study WHERE name = "Star Wars Favorite Movie"),
    (SELECT id FROM sample_group WHERE sample_name = "Group2"),
    (SELECT id FROM survey_population WHERE fname = 'Waylon' AND lname = 'Smithers'),
    0,
    1,
    1
);
INSERT INTO study_to_survey_pop
(study_id,sample_group_id,survey_population_id,completed,locked,number_of_tries)
VALUES(
    (SELECT id FROM study WHERE name = "Star Wars Favorite Movie"),
    (SELECT id FROM sample_group WHERE sample_name = "Group2"),
    (SELECT id FROM survey_population WHERE fname = 'Patty' AND lname = 'Bouvier'),
    0,
    1,
    1
);
INSERT INTO study_to_survey_pop
(study_id,sample_group_id,survey_population_id,completed,locked,number_of_tries)
VALUES(
    (SELECT id FROM study WHERE name = "Star Wars Favorite Movie"),
    (SELECT id FROM sample_group WHERE sample_name = "Group2"),
    (SELECT id FROM survey_population WHERE fname = 'Clancy' AND lname = 'Wiggum'),
    1,
    0,
    1
);
INSERT INTO study_to_survey_pop
(study_id,sample_group_id,survey_population_id,completed,locked,number_of_tries)
VALUES(
    (SELECT id FROM study WHERE name = "Star Wars Favorite Movie"),
    (SELECT id FROM sample_group WHERE sample_name = "Group2"),
    (SELECT id FROM survey_population WHERE fname = 'Milhouse' AND lname = 'Van Houten'),
    1,
    0,
    1
);

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
     WHERE survey_population.fname = 'Abraham' AND survey_population.lname = 'Simpsons'
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
     WHERE survey_population.fname = 'Maggie' AND survey_population.lname = 'Simpsons'
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
     WHERE survey_population.fname = 'Bart' AND survey_population.lname = 'Simpsons'
     AND sample_group.sample_name = 'Group1' AND study.name = 'Harry Potter Favorite Movie'    
    ),
    (SELECT id FROM survey_users WHERE uname = 'harry'),
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
INSERT INTO survey_queue(study_to_survey_pop_id,queue_timestamp,in_waiting_queue)
VALUES(
    (
      SELECT study_to_survey_pop.id FROM study_to_survey_pop
      INNER JOIN study ON study_to_survey_pop.study_id = study.id
      INNER JOIN sample_group ON study_to_survey_pop.sample_group_id = sample_group.id
      INNER JOIN survey_population ON study_to_survey_pop.survey_population_id = survey_population.id
      WHERE survey_population.fname = 'Hommer' AND survey_population.lname = 'Simpsons'
      AND sample_group.sample_name = 'Group1' AND study.name = 'Harry Potter Favorite Movie' 
    ),
    '2020-01-01 15:25:00',
    1
);
INSERT INTO survey_queue(study_to_survey_pop_id,queue_timestamp,in_waiting_queue)
VALUES(
    (
      SELECT study_to_survey_pop.id FROM study_to_survey_pop
      INNER JOIN study ON study_to_survey_pop.study_id = study.id
      INNER JOIN sample_group ON study_to_survey_pop.sample_group_id = sample_group.id
      INNER JOIN survey_population ON study_to_survey_pop.survey_population_id = survey_population.id
      WHERE survey_population.fname = 'Abraham' AND survey_population.lname = 'Simpsons'
      AND sample_group.sample_name = 'Group1' AND study.name = 'Harry Potter Favorite Movie' 
    ),
    '2020-01-01 13:25:00',
    0
);
INSERT INTO survey_queue(study_to_survey_pop_id,queue_timestamp,in_waiting_queue)
VALUES(
    (
      SELECT study_to_survey_pop.id FROM study_to_survey_pop
      INNER JOIN study ON study_to_survey_pop.study_id = study.id
      INNER JOIN sample_group ON study_to_survey_pop.sample_group_id = sample_group.id
      INNER JOIN survey_population ON study_to_survey_pop.survey_population_id = survey_population.id
      WHERE survey_population.fname = 'Maggie' AND survey_population.lname = 'Simpsons'
      AND sample_group.sample_name = 'Group1' AND study.name = 'Harry Potter Favorite Movie' 
    ),
    '2020-01-01 13:25:00',
    0
);
INSERT INTO survey_queue(study_to_survey_pop_id,queue_timestamp,in_waiting_queue)
VALUES(
    (
      SELECT study_to_survey_pop.id FROM study_to_survey_pop
      INNER JOIN study ON study_to_survey_pop.study_id = study.id
      INNER JOIN sample_group ON study_to_survey_pop.sample_group_id = sample_group.id
      INNER JOIN survey_population ON study_to_survey_pop.survey_population_id = survey_population.id
      WHERE survey_population.fname = 'Lisa' AND survey_population.lname = 'Simpsons'
      AND sample_group.sample_name = 'Group1' AND study.name = 'Harry Potter Favorite Movie' 
    ),
    '2020-01-01 13:25:00',
    1
);
INSERT INTO survey_queue(study_to_survey_pop_id,queue_timestamp,in_waiting_queue)
VALUES(
    (
      SELECT study_to_survey_pop.id FROM study_to_survey_pop
      INNER JOIN study ON study_to_survey_pop.study_id = study.id
      INNER JOIN sample_group ON study_to_survey_pop.sample_group_id = sample_group.id
      INNER JOIN survey_population ON study_to_survey_pop.survey_population_id = survey_population.id
      WHERE survey_population.fname = 'Marge' AND survey_population.lname = 'Simpsons'
      AND sample_group.sample_name = 'Group1' AND study.name = 'Harry Potter Favorite Movie' 
    ),
    '2020-01-01 13:25:00',
    1
);
INSERT INTO survey_queue(study_to_survey_pop_id,queue_timestamp,in_waiting_queue)
VALUES(
    (
      SELECT study_to_survey_pop.id FROM study_to_survey_pop
      INNER JOIN study ON study_to_survey_pop.study_id = study.id
      INNER JOIN sample_group ON study_to_survey_pop.sample_group_id = sample_group.id
      INNER JOIN survey_population ON study_to_survey_pop.survey_population_id = survey_population.id
      WHERE survey_population.fname = 'Bart' AND survey_population.lname = 'Simpsons'
      AND sample_group.sample_name = 'Group1' AND study.name = 'Harry Potter Favorite Movie' 
    ),
    '2020-01-01 13:25:00',
    0
);
INSERT INTO survey_queue(study_to_survey_pop_id,queue_timestamp,in_waiting_queue)
VALUES(
    (
      SELECT study_to_survey_pop.id FROM study_to_survey_pop
      INNER JOIN study ON study_to_survey_pop.study_id = study.id
      INNER JOIN sample_group ON study_to_survey_pop.sample_group_id = sample_group.id
      INNER JOIN survey_population ON study_to_survey_pop.survey_population_id = survey_population.id
      WHERE survey_population.fname = 'Waylon' AND survey_population.lname = 'Smithers'
      AND sample_group.sample_name = 'Group2' AND study.name = 'Star Wars Favorite Movie' 
    ),
    '2020-01-01 13:25:00',
    0
);
INSERT INTO survey_queue(study_to_survey_pop_id,queue_timestamp,in_waiting_queue)
VALUES(
    (
      SELECT study_to_survey_pop.id FROM study_to_survey_pop
      INNER JOIN study ON study_to_survey_pop.study_id = study.id
      INNER JOIN sample_group ON study_to_survey_pop.sample_group_id = sample_group.id
      INNER JOIN survey_population ON study_to_survey_pop.survey_population_id = survey_population.id
      WHERE survey_population.fname = 'Patty' AND survey_population.lname = 'Bouvier'
      AND sample_group.sample_name = 'Group2' AND study.name = 'Star Wars Favorite Movie' 
    ),
    '2020-01-01 13:25:00',
    0
);
INSERT INTO survey_queue(study_to_survey_pop_id,queue_timestamp,in_waiting_queue)
VALUES(
    (
      SELECT study_to_survey_pop.id FROM study_to_survey_pop
      INNER JOIN study ON study_to_survey_pop.study_id = study.id
      INNER JOIN sample_group ON study_to_survey_pop.sample_group_id = sample_group.id
      INNER JOIN survey_population ON study_to_survey_pop.survey_population_id = survey_population.id
      WHERE survey_population.fname = 'Clancy' AND survey_population.lname = 'Wiggum'
      AND sample_group.sample_name = 'Group2' AND study.name = 'Star Wars Favorite Movie' 
    ),
    '2020-01-01 13:25:00',
    0
);
INSERT INTO survey_queue(study_to_survey_pop_id,queue_timestamp,in_waiting_queue)
VALUES(
    (
      SELECT study_to_survey_pop.id FROM study_to_survey_pop
      INNER JOIN study ON study_to_survey_pop.study_id = study.id
      INNER JOIN sample_group ON study_to_survey_pop.sample_group_id = sample_group.id
      INNER JOIN survey_population ON study_to_survey_pop.survey_population_id = survey_population.id
      WHERE survey_population.fname = 'Milhouse' AND survey_population.lname = 'Van Houten'
      AND sample_group.sample_name = 'Group2' AND study.name = 'Star Wars Favorite Movie' 
    ),
    '2020-01-01 13:25:00',
    0
);




