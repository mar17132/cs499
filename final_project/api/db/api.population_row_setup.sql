/*
* Created By: Matthew Martin
* Created On: 01/01/2020
* Modified By: Matthew Martin
* Modified On: 01/01/2020
* Description: This script is to create start data for 
* population tables in the csfinal project.
*/

USE csfinal;

/*
sample_group setup rows
*/
INSERT INTO sample_group(sample_name)
VALUES(
    "Group1"
);
INSERT INTO sample_group(sample_name)
VALUES(
    "Group2"
);
INSERT INTO sample_group(sample_name)
VALUES(
    "Group3"
);

/*
survey_population setup rows
*/
INSERT INTO survey_population(fname,lname,street,city,state,zip,phone)
VALUES(
    "Hommer",
    "Simpson",
    "742 Evergreen Terrace",
    "Springfield",
    "UT",
    "84015",
    "555-555-5555"
);
INSERT INTO survey_population(fname,lname,street,city,state,zip,phone)
VALUES(
    "Marge",
    "Simpson",
    "742 Evergreen Terrace",
    "Springfield",
    "UT",
    "84015",
    "555-555-5555"
);
INSERT INTO survey_population(fname,lname,street,city,state,zip,phone)
VALUES(
    "Bart",
    "Simpson",
    "742 Evergreen Terrace",
    "Springfield",
    "UT",
    "84015",
    "555-555-5555"
);
INSERT INTO survey_population(fname,lname,street,city,state,zip,phone)
VALUES(
    "Lisa",
    "Simpson",
    "742 Evergreen Terrace",
    "Springfield",
    "UT",
    "84015",
    "555-555-5555"
);
INSERT INTO survey_population(fname,lname,street,city,state,zip,phone)
VALUES(
    "Maggie",
    "Simpson",
    "742 Evergreen Terrace",
    "Springfield",
    "UT",
    "84015",
    "555-555-5555"
);
INSERT INTO survey_population(fname,lname,street,city,state,zip,phone)
VALUES(
    "Abraham",
    "Simpson",
    "742 Evergreen Terrace",
    "Springfield",
    "UT",
    "84015",
    "555-555-5555"
);
INSERT INTO survey_population(fname,lname,street,city,state,zip,phone)
VALUES(
    "Moe",
    "Szyslak",
    "742 Evergreen Terrace",
    "Springfield",
    "UT",
    "84015",
    "555-555-5555"
);
INSERT INTO survey_population(fname,lname,street,city,state,zip,phone)
VALUES(
    "Monty",
    "Burns",
    "742 Evergreen Terrace",
    "Springfield",
    "UT",
    "84015",
    "555-555-5555"
);
INSERT INTO survey_population(fname,lname,street,city,state,zip,phone)
VALUES(
    "Ned",
    "Flanders",
    "742 Evergreen Terrace",
    "Springfield",
    "UT",
    "84015",
    "555-555-5555"
);
INSERT INTO survey_population(fname,lname,street,city,state,zip,phone)
VALUES(
    "Ralph",
    "Wiggum",
    "742 Evergreen Terrace",
    "Springfield",
    "UT",
    "84015",
    "555-555-5555"
);
INSERT INTO survey_population(fname,lname,street,city,state,zip,phone)
VALUES(
    "Otto",
    "Mann",
    "742 Evergreen Terrace",
    "Springfield",
    "UT",
    "84015",
    "555-555-5555"
);
INSERT INTO survey_population(fname,lname,street,city,state,zip,phone)
VALUES(
    "Clancy",
    "Wiggum",
    "742 Evergreen Terrace",
    "Springfield",
    "UT",
    "84015",
    "555-555-5555"
);
INSERT INTO survey_population(fname,lname,street,city,state,zip,phone)
VALUES(
    "Milhouse",
    "Van Houten",
    "742 Evergreen Terrace",
    "Springfield",
    "UT",
    "84015",
    "555-555-5555"
);
INSERT INTO survey_population(fname,lname,street,city,state,zip,phone)
VALUES(
    "Patty",
    "Bouvier",
    "742 Evergreen Terrace",
    "Springfield",
    "UT",
    "84015",
    "555-555-5555"
);
INSERT INTO survey_population(fname,lname,street,city,state,zip,phone)
VALUES(
    "Waylon",
    "Smithers",
    "742 Evergreen Terrace",
    "Springfield",
    "UT",
    "84015",
    "555-555-5555"
);

/*
surveyp_to_sampleg setup rows
*/
UPDATE surveyp_to_sampleg SET member=1 WHERE 
survey_population_id=(SELECT id FROM survey_population 
WHERE fname = 'Hommer' AND lname = 'Simpson')
AND
sample_group_id=(SELECT id FROM sample_group WHERE sample_name = 'Group1');

UPDATE surveyp_to_sampleg SET member=1 WHERE 
survey_population_id=(SELECT id FROM survey_population 
WHERE fname = 'Abraham' AND lname = 'Simpson')
AND
sample_group_id=(SELECT id FROM sample_group WHERE sample_name = 'Group1');

UPDATE surveyp_to_sampleg SET member=1 WHERE 
survey_population_id=(SELECT id FROM survey_population 
WHERE fname = 'Maggie' AND lname = 'Simpson')
AND
sample_group_id=(SELECT id FROM sample_group WHERE sample_name = 'Group1');

UPDATE surveyp_to_sampleg SET member=1 WHERE 
survey_population_id=(SELECT id FROM survey_population 
WHERE fname = 'Lisa' AND lname = 'Simpson')
AND
sample_group_id=(SELECT id FROM sample_group WHERE sample_name = 'Group1');

UPDATE surveyp_to_sampleg SET member=1 WHERE 
survey_population_id=(SELECT id FROM survey_population 
WHERE fname = 'Marge' AND lname = 'Simpson')
AND
sample_group_id=(SELECT id FROM sample_group WHERE sample_name = 'Group1');

UPDATE surveyp_to_sampleg SET member=1 WHERE 
survey_population_id=(SELECT id FROM survey_population 
WHERE fname = 'Bart' AND lname = 'Simpson')
AND
sample_group_id=(SELECT id FROM sample_group WHERE sample_name = 'Group1');


UPDATE surveyp_to_sampleg SET member=1 WHERE 
survey_population_id=(SELECT id FROM survey_population 
WHERE fname = 'Waylon' AND lname = 'Smithers')
AND
sample_group_id=(SELECT id FROM sample_group WHERE sample_name = 'Group2');

UPDATE surveyp_to_sampleg SET member=1 WHERE 
survey_population_id=(SELECT id FROM survey_population 
WHERE fname = 'Patty' AND lname = 'Bouvier')
AND
sample_group_id=(SELECT id FROM sample_group WHERE sample_name = 'Group2');

UPDATE surveyp_to_sampleg SET member=1 WHERE 
survey_population_id=(SELECT id FROM survey_population 
WHERE fname = 'Clancy' AND lname = 'Wiggum')
AND
sample_group_id=(SELECT id FROM sample_group WHERE sample_name = 'Group2');

UPDATE surveyp_to_sampleg SET member=1 WHERE 
survey_population_id=(SELECT id FROM survey_population 
WHERE fname = 'Milhouse' AND lname = 'Van Houten')
AND
sample_group_id=(SELECT id FROM sample_group WHERE sample_name = 'Group2');


