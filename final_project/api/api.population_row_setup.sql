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
survey_population setup rows
*/
INSERT INTO survey_population(fname,mname,lname,street,city,zip,state,phone)
VALUES(
    "Hommer",
    "",
    "Simpsons",
    "742 Evergreen Terrace",
    "Springfield",
    "UT",
    "84015",
    "555-555-5555"
);
INSERT INTO survey_population(fname,mname,lname,city,street,city,zip,state,phone)
VALUES(
    "Marge",
    "",
    "Simpsons",
    "742 Evergreen Terrace",
    "Springfield",
    "UT",
    "84015",
    "555-555-5555"
);
INSERT INTO survey_population(fname,mname,lname,street,city,zip,state,phone)
VALUES(
    "Bart",
    "",
    "Simpsons",
    "742 Evergreen Terrace",
    "Springfield",
    "UT",
    "84015",
    "555-555-5555"
);
INSERT INTO survey_population(fname,mname,lname,street,city,zip,state,phone)
VALUES(
    "Lisa",
    "",
    "Simpsons",
    "742 Evergreen Terrace",
    "Springfield",
    "UT",
    "84015",
    "555-555-5555"
);
INSERT INTO survey_population(fname,mname,lname,street,city,zip,state,phone)
VALUES(
    "Maggie",
    "",
    "Simpsons",
    "742 Evergreen Terrace",
    "Springfield",
    "UT",
    "84015",
    "555-555-5555"
);
INSERT INTO survey_population(fname,mname,lname,street,city,zip,state,phone)
VALUES(
    "Abraham",
    "",
    "Simpsons",
    "742 Evergreen Terrace",
    "Springfield",
    "UT",
    "84015",
    "555-555-5555"
);
INSERT INTO survey_population(fname,mname,lname,street,city,zip,state,phone)
VALUES(
    "Moe",
    "",
    "Szyslak",
    "742 Evergreen Terrace",
    "Springfield",
    "UT",
    "84015",
    "555-555-5555"
);
INSERT INTO survey_population(fname,mname,lname,street,city,zip,state,phone)
VALUES(
    "Monty",
    "",
    "Burns",
    "742 Evergreen Terrace",
    "Springfield",
    "UT",
    "84015",
    "555-555-5555"
);
INSERT INTO survey_population(fname,mname,lname,street,city,zip,state,phone)
VALUES(
    "Ned",
    "",
    "Flanders",
    "742 Evergreen Terrace",
    "Springfield",
    "UT",
    "84015",
    "555-555-5555"
);
INSERT INTO survey_population(fname,mname,lname,street,city,zip,state,phone)
VALUES(
    "Ralph",
    "",
    "Wiggum",
    "742 Evergreen Terrace",
    "Springfield",
    "UT",
    "84015",
    "555-555-5555"
);
INSERT INTO survey_population(fname,mname,lname,street,city,zip,state,phone)
VALUES(
    "Otto",
    "",
    "Mann",
    "742 Evergreen Terrace",
    "Springfield",
    "UT",
    "84015",
    "555-555-5555"
);
INSERT INTO survey_population(fname,mname,lname,street,city,zip,state,phone)
VALUES(
    "Clancy",
    "",
    "Wiggum",
    "742 Evergreen Terrace",
    "Springfield",
    "UT",
    "84015",
    "555-555-5555"
);
INSERT INTO survey_population(fname,mname,lname,street,city,zip,state,phone)
VALUES(
    "Milhouse",
    "",
    "Van Houten",
    "742 Evergreen Terrace",
    "Springfield",
    "UT",
    "84015",
    "555-555-5555"
);
INSERT INTO survey_population(fname,mname,lname,street,city,zip,state,phone)
VALUES(
    "Patty",
    "",
    "Bouvier",
    "742 Evergreen Terrace",
    "Springfield",
    "UT",
    "84015",
    "555-555-5555"
);
INSERT INTO survey_population(fname,mname,lname,street,city,zip,state,phone)
VALUES(
    "Waylon",
    "",
    "Smithers",
    "742 Evergreen Terrace",
    "Springfield",
    "UT",
    "84015",
    "555-555-5555"
);

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
surveyp_to_sampleg setup rows
*/
INSERT INTO surveyp_to_sampleg(survey_population_id,sample_group_id)
VALUES(
    (SELECT id FROM survey_population WHERE fname = 'Hommer' AND lname = 'Simpsons'),
    (SELECT id FROM sample_group WHERE sample_name = 'Group1')
);
INSERT INTO surveyp_to_sampleg(survey_population_id,sample_group_id)
VALUES(
    (SELECT id FROM survey_population WHERE fname = 'Abraham' AND lname = 'Simpsons'),
    (SELECT id FROM sample_group WHERE sample_name = 'Group1')
);
INSERT INTO surveyp_to_sampleg(survey_population_id,sample_group_id)
VALUES(
    (SELECT id FROM survey_population WHERE fname = 'Maggie' AND lname = 'Simpsons'),
    (SELECT id FROM sample_group WHERE sample_name = 'Group1')
);
INSERT INTO surveyp_to_sampleg(survey_population_id,sample_group_id)
VALUES(
    (SELECT id FROM survey_population WHERE fname = 'Lisa' AND lname = 'Simpsons'),
    (SELECT id FROM sample_group WHERE sample_name = 'Group1')
);
INSERT INTO surveyp_to_sampleg(survey_population_id,sample_group_id)
VALUES(
    (SELECT id FROM survey_population WHERE fname = 'Marge' AND lname = 'Simpsons'),
    (SELECT id FROM sample_group WHERE sample_name = 'Group1')
);
INSERT INTO surveyp_to_sampleg(survey_population_id,sample_group_id)
VALUES(
    (SELECT id FROM survey_population WHERE fname = 'Bart' AND lname = 'Simpsons'),
    (SELECT id FROM sample_group WHERE sample_name = 'Group1')
);
INSERT INTO surveyp_to_sampleg(survey_population_id,sample_group_id)
VALUES(
    (SELECT id FROM survey_population WHERE fname = 'Waylon' AND lname = 'Smithers'),
    (SELECT id FROM sample_group WHERE sample_name = 'Group2')
);
INSERT INTO surveyp_to_sampleg(survey_population_id,sample_group_id)
VALUES(
    (SELECT id FROM survey_population WHERE fname = 'Patty' AND lname = 'Bouvier'),
    (SELECT id FROM sample_group WHERE sample_name = 'Group2')
);
INSERT INTO surveyp_to_sampleg(survey_population_id,sample_group_id)
VALUES(
    (SELECT id FROM survey_population WHERE fname = 'Clancy' AND lname = 'Wiggum'),
    (SELECT id FROM sample_group WHERE sample_name = 'Group2')
);
INSERT INTO surveyp_to_sampleg(survey_population_id,sample_group_id)
VALUES(
    (SELECT id FROM survey_population WHERE fname = 'Milhouse' AND lname = 'Van Houten'),
    (SELECT id FROM sample_group WHERE sample_name = 'Group2')
);

