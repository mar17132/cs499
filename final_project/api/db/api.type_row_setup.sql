/*
* Created By: Matthew Martin
* Created On: 01/01/2020
* Modified By: Matthew Martin
* Modified On: 01/01/2020
* Description: This script is to create start data for the 
* type table csfinal project.
*/

USE csfinal;


/*
type_class table insert rows
*/
INSERT INTO type_class(id,typeClass) VALUES(NULL,"Study");
INSERT INTO type_class(id,typeClass) VALUES(NUll,"Interviewer Response");
INSERT INTO type_class(id,typeClass) VALUES(NULL,"Question");
INSERT INTO type_class(id,typeClass) VALUES(NULL,"Users");
INSERT INTO type_class(id,typeClass) VALUES(NULL,"Progress");

/*
type table insert rows
*/
INSERT INTO type(type,type_class_id) 
VALUES(
    "No Answer",
    (SELECT id FROM type_class WHERE typeClass = "Interviewer Response")
);
INSERT INTO type(type,type_class_id) 
VALUES(
    "Declined Survey",
    (SELECT id FROM type_class WHERE typeClass = "Interviewer Response")
);
INSERT INTO type(type,type_class_id) 
VALUES(
    "Completed",
    (SELECT id FROM type_class WHERE typeClass = "Interviewer Response")
);
INSERT INTO type(type,type_class_id) 
VALUES(
    "Call back later",
    (SELECT id FROM type_class WHERE typeClass = "Interviewer Response")
);
INSERT INTO type(type,type_class_id) 
VALUES(
    "Movies",
    (SELECT id FROM type_class WHERE typeClass = "Study")
);
INSERT INTO type(type,type_class_id) 
VALUES(
    "Music",
    (SELECT id FROM type_class WHERE typeClass = "Study")
);
INSERT INTO type(type,type_class_id) 
VALUES(
    "Computers",
    (SELECT id FROM type_class WHERE typeClass = "Study")
);
INSERT INTO type(type,type_class_id) 
VALUES(
    "In Progress",
    (SELECT id FROM type_class WHERE typeClass = "Progress")
);
INSERT INTO type(type,type_class_id) 
VALUES(
    "Checkbox",
    (SELECT id FROM type_class WHERE typeClass = "Question")
);
INSERT INTO type(type,type_class_id) 
VALUES(
    "Fill in the blank",
    (SELECT id FROM type_class WHERE typeClass = "Question")
);
INSERT INTO type(type,type_class_id) 
VALUES(
    "Multiple Choice",
    (SELECT id FROM type_class WHERE typeClass = "Question")
);
INSERT INTO type(type,type_class_id) 
VALUES(
    "Interviewer",
    (SELECT id FROM type_class WHERE typeClass = "Users")
);
INSERT INTO type(type,type_class_id) 
VALUES(
    "Admin",
    (SELECT id FROM type_class WHERE typeClass = "Users")
);

