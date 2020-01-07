/*
* Created By: Matthew Martin
* Created On: 01/01/2020
* Modified By: Matthew Martin
* Modified On: 01/01/2020
* Description: This script is to create start data for 
* survey_users the csfinal project.
*/

USE csfinal;


/*
survey_users setup rows
*/
INSERT INTO survey_users(uname,passwd,type_id)
VALUES(
    "bob",
    PASSWORD('Passw@rd99'),
    (SELECT id FROM type WHERE type = "Admin")
);
INSERT INTO survey_users(uname,passwd,type_id)
VALUES(
    "dav",
    PASSWORD('Passw@rd99'),
    (SELECT id FROM type WHERE type = "Interviewer")
);
INSERT INTO survey_users(uname,passwd,type_id)
VALUES(
    "dick",
    PASSWORD('Passw@rd99'),
    (SELECT id FROM type WHERE type = "Admin")
);
INSERT INTO survey_users(uname,passwd,type_id)
VALUES(
    "harry",
    PASSWORD('Passw@rd99'),
    (SELECT id FROM type WHERE type = "Interviewer")    
);
INSERT INTO survey_users(uname,passwd,type_id)
VALUES(
    "tom",
    PASSWORD('Passw@rd99'),
    (SELECT id FROM type WHERE type = "Admin")
);
INSERT INTO survey_users(uname,passwd,type_id)
VALUES(
    "barry",
    PASSWORD('Passw@rd99'),
    (SELECT id FROM type WHERE type = "Interviewer")
);
