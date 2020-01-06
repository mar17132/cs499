/*
* Created By: Matthew Martin
* Created On: 01/01/2020
* Modified By: Matthew Martin
* Modified On: 01/01/2020
* Description: This script is to create start data for the csfinal project.
*/

USE csfinal;


/*
type_class table insert rows
*/
INSERT INTO type_class(id,typeClass) VALUES("","Study");
INSERT INTO type_class(id,typeClass) VALUES("","Interviewer Response");
INSERT INTO type_class(id,typeClass) VALUES("","Question");
INSERT INTO type_class(id,typeClass) VALUES("","Users");

/*
type table insert rows
*/
INSERT INTO type(id,type,type_classtype_id_id) 
VALUES(
    "",
    "No Answer",
    (SELECT id FROM type_class WHERE typeClass = "Interviewer Response")
);
INSERT INTO type(id,type,type_class_id) 
VALUES(
    "",
    "Declined Survey",
    (SELECT id FROM type_class WHERE typeClass = "Interviewer Response")
);
INSERT INTO type(id,type,type_class_id) 
VALUES(
    "",
    "Completed"
    (SELECT id FROM type_class WHERE typeClass = "Interviewer Response")
);
INSERT INTO type(id,type,type_class_id) 
VALUES(
    "",
    "Call back later",
    (SELECT id FROM type_class WHERE typeClass = "Interviewer Response")
);
INSERT INTO type(id,type,type_class_id) 
VALUES(
    "",
    "Movies",
    (SELECT id FROM type_class WHERE typeClass = "Study")
);
INSERT INTO type(id,type,type_class_id) 
VALUES(
    "",
    "Music",
    (SELECT id FROM type_class WHERE typeClass = "Study")
);
INSERT INTO type(id,type,type_class_id) 
VALUES(
    "",
    "Computers",
    (SELECT id FROM type_class WHERE typeClass = "Study")
);
INSERT INTO type(id,type,type_class_id) 
VALUES(
    "",
    "Checkbox",
    (SELECT id FROM type_class WHERE typeClass = "Question")
);
INSERT INTO type(id,type,type_class_id) 
VALUES(
    "",
    "Fill in the blank",
    (SELECT id FROM type_class WHERE typeClass = "Question")
);
INSERT INTO type(id,type,type_class_id) 
VALUES(
    "",
    "Multiple Choice",
    (SELECT id FROM type_class WHERE typeClass = "Question")
);
INSERT INTO type(id,type,type_class_id) 
VALUES(
    "",
    "Interviewer",
    (SELECT id FROM type_class WHERE typeClass = "Users")
);
INSERT INTO type(id,type,type_class_id) 
VALUES(
    "",
    "Admin",
    (SELECT id FROM type_class WHERE typeClass = "Users")
);

/*
survey_users setup rows
*/
INSERT INTO survey_users(id,uname,passwd,type_id)
VALUES(
    "",
    "bob",
    PASSWORD('Passw@rd99'),
    (SELECT id FROM type WHERE type = "Admin")
);
INSERT INTO survey_users(id,uname,passwd,type_id)
VALUES(
    "",
    "dav",
    PASSWORD('Passw@rd99'),
    (SELECT id FROM type WHERE type = "Interviewer")
);
INSERT INTO survey_users(id,uname,passwd,type_id)
VALUES(
    "",
    "dick",
    PASSWORD('Passw@rd99'),
    (SELECT id FROM type WHERE type = "Admin")
);
INSERT INTO survey_users(id,uname,passwd,type_id)
VALUES(
    "",
    "harry",
    PASSWORD('Passw@rd99'),
    (SELECT id FROM type WHERE type = "Interviewer")    
);
INSERT INTO survey_users(id,uname,passwd,type_id)
VALUES(
    "",
    "tom",
    PASSWORD('Passw@rd99'),
    (SELECT id FROM type WHERE type = "Admin")
);
INSERT INTO survey_users(id,uname,passwd,type_id)
VALUES(
    "",
    "tom",
    PASSWORD('Passw@rd99'),
    (SELECT id FROM type WHERE type = "Interviewer")
);

/*
survey_population setup rows
*/
INSERT INTO survey_population(id,fname,mname,lname,street,apt,zip,state,phone)
VALUES(
    "",
    "Hommer",
    "",
    "Simpsons",
    "742 Evergreen Terrace",
    "",
    "Springfield",
    "UT",
    "84015",
    "555-555-5555"
);
INSERT INTO survey_population(id,fname,mname,lname,street,apt,zip,state,phone)
VALUES(
    "",
    "Marge",
    "",
    "Simpsons",
    "742 Evergreen Terrace",
    "",
    "Springfield",
    "UT",
    "84015",
    "555-555-5555"
);
INSERT INTO survey_population(id,fname,mname,lname,street,apt,zip,state,phone)
VALUES(
    "",
    "Bart",
    "",
    "Simpsons",
    "742 Evergreen Terrace",
    "",
    "Springfield",
    "UT",
    "84015",
    "555-555-5555"
);
INSERT INTO survey_population(id,fname,mname,lname,street,apt,zip,state,phone)
VALUES(
    "",
    "Lisa",
    "",
    "Simpsons",
    "742 Evergreen Terrace",
    "",
    "Springfield",
    "UT",
    "84015",
    "555-555-5555"
);
INSERT INTO survey_population(id,fname,mname,lname,street,apt,zip,state,phone)
VALUES(
    "",
    "Maggie",
    "",
    "Simpsons",
    "742 Evergreen Terrace",
    "",
    "Springfield",
    "UT",
    "84015",
    "555-555-5555"
);
INSERT INTO survey_population(id,fname,mname,lname,street,apt,zip,state,phone)
VALUES(
    "",
    "Abraham",
    "",
    "Simpsons",
    "742 Evergreen Terrace",
    "",
    "Springfield",
    "UT",
    "84015",
    "555-555-5555"
);
INSERT INTO survey_population(id,fname,mname,lname,street,apt,zip,state,phone)
VALUES(
    "",
    "Moe",
    "",
    "Szyslak",
    "742 Evergreen Terrace",
    "",
    "Springfield",
    "UT",
    "84015",
    "555-555-5555"
);
INSERT INTO survey_population(id,fname,mname,lname,street,apt,zip,state,phone)
VALUES(
    "",
    "Monty",
    "",
    "Burns",
    "742 Evergreen Terrace",
    "",
    "Springfield",
    "UT",
    "84015",
    "555-555-5555"
);
INSERT INTO survey_population(id,fname,mname,lname,street,apt,zip,state,phone)
VALUES(
    "",
    "Ned",
    "",
    "Flanders",
    "742 Evergreen Terrace",
    "",
    "Springfield",
    "UT",
    "84015",
    "555-555-5555"
);
INSERT INTO survey_population(id,fname,mname,lname,street,apt,zip,state,phone)
VALUES(
    "",
    "Ralph",
    "",
    "Wiggum",
    "742 Evergreen Terrace",
    "",
    "Springfield",
    "UT",
    "84015",
    "555-555-5555"
);
INSERT INTO survey_population(id,fname,mname,lname,street,apt,zip,state,phone)
VALUES(
    "",
    "Otto",
    "",
    "Mann",
    "742 Evergreen Terrace",
    "",
    "Springfield",
    "UT",
    "84015",
    "555-555-5555"
);
INSERT INTO survey_population(id,fname,mname,lname,street,apt,zip,state,phone)
VALUES(
    "",
    "Clancy",
    "",
    "Wiggum",
    "742 Evergreen Terrace",
    "",
    "Springfield",
    "UT",
    "84015",
    "555-555-5555"
);
INSERT INTO survey_population(id,fname,mname,lname,street,apt,zip,state,phone)
VALUES(
    "",
    "Milhouse",
    "",
    "Van Houten",
    "742 Evergreen Terrace",
    "",
    "Springfield",
    "UT",
    "84015",
    "555-555-5555"
);
INSERT INTO survey_population(id,fname,mname,lname,street,apt,zip,state,phone)
VALUES(
    "",
    "Patty",
    "",
    "Bouvier",
    "742 Evergreen Terrace",
    "",
    "Springfield",
    "UT",
    "84015",
    "555-555-5555"
);
INSERT INTO survey_population(id,fname,mname,lname,street,apt,zip,state,phone)
VALUES(
    "",
    "Waylon",
    "",
    "Smithers",
    "742 Evergreen Terrace",
    "",
    "Springfield",
    "UT",
    "84015",
    "555-555-5555"
);

/*
sample_group setup rows
*/
INSERT INTO sample_group(id,sample_name)
VALUES(
    "",
    "Group1"
);
INSERT INTO sample_group(id,sample_name)
VALUES(
    "",
    "Group2"
);
INSERT INTO sample_group(id,sample_name)
VALUES(
    "",
    "Group3"
);

/*
surveyp_to_sampleg setup rows
*/


/*
Study setup rows
*/


/*
interview_permission setup rows
*/


/*
study_to_survey_pop setup rows
*/


/*
survey_interview setup rows
*/


/*
question setup rows
*/


/*
study_to_question setup rows
*/


/*
10 of each type of question
*/



