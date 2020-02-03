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




