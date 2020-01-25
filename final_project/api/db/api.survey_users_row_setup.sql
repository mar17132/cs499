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
Passw@rd99
*/
INSERT INTO survey_users(uname,passwd,type_id)
VALUES(
    "bob",
    "$2y$10$24HpxepBPMapioLZ8GiG.OMZMHBKmChfRXlnNARr1qpZlpBs9/EX6",
    (SELECT id FROM type WHERE type = "Admin")
);
INSERT INTO survey_users(uname,passwd,type_id)
VALUES(
    "dav",
    "$2y$10$24HpxepBPMapioLZ8GiG.OMZMHBKmChfRXlnNARr1qpZlpBs9/EX6",
    (SELECT id FROM type WHERE type = "Interviewer")
);
INSERT INTO survey_users(uname,passwd,type_id)
VALUES(
    "dick",
    "$2y$10$24HpxepBPMapioLZ8GiG.OMZMHBKmChfRXlnNARr1qpZlpBs9/EX6",
    (SELECT id FROM type WHERE type = "Admin")
);
INSERT INTO survey_users(uname,passwd,type_id)
VALUES(
    "harry",
    "$2y$10$24HpxepBPMapioLZ8GiG.OMZMHBKmChfRXlnNARr1qpZlpBs9/EX6",
    (SELECT id FROM type WHERE type = "Interviewer")    
);
INSERT INTO survey_users(uname,passwd,type_id)
VALUES(
    "tom",
    "$2y$10$24HpxepBPMapioLZ8GiG.OMZMHBKmChfRXlnNARr1qpZlpBs9/EX6",
    (SELECT id FROM type WHERE type = "Admin")
);
INSERT INTO survey_users(uname,passwd,type_id)
VALUES(
    "barry",
    "$2y$10$24HpxepBPMapioLZ8GiG.OMZMHBKmChfRXlnNARr1qpZlpBs9/EX6",
    (SELECT id FROM type WHERE type = "Interviewer")
);
