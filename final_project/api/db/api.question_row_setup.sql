/*
* Created By: Matthew Martin
* Created On: 01/01/2020
* Modified By: Matthew Martin
* Modified On: 01/01/2020
* Description: This script is to create start data for 
* question tables in the csfinal project.
*/

USE csfinal;

/*
10 of each type of question
*/
/*
question setup rows
*/
INSERT INTO question(question,order_Anwsers,question_order,type_id)
VALUES(
    "Do you like Disney Star Wars?",
    0,
    1,
    (SELECT id FROM type WHERE type = 'Multiple Choice')
);
INSERT INTO question(question,order_Anwsers,question_order,type_id)
VALUES(
    "Which of the following is your favorite Star Wars Movie?",
    0,
    1,
    (SELECT id FROM type WHERE type = 'Multiple Choice')
);
INSERT INTO question(question,order_Anwsers,question_order,type_id)
VALUES(
    "Out of the following Star Wars charaters, which ones do you like?",
    0,
    1,
    (SELECT id FROM type WHERE type = 'Checkbox')
);
INSERT INTO question(question,order_Anwsers,question_order,type_id)
VALUES(
    "Do you like Harry Potter?",
    0,
    1,
    (SELECT id FROM type WHERE type = 'Multiple Choice')
);
INSERT INTO question(question,order_Anwsers,question_order,type_id)
VALUES(
    "Which of the following is your favorite Harry Potter Movie?",
    0,
    1,
    (SELECT id FROM type WHERE type = 'Multiple Choice')
);
INSERT INTO question(question,order_Anwsers,question_order,type_id)
VALUES(
    "Out of the following Harry Potter charaters, which ones do you like?",
    0,
    1,
    (SELECT id FROM type WHERE type = 'Checkbox')
);
/*
study_to_question setup rows
*/
INSERT INTO study_to_question(question_id,study_id)
VALUES(
    (SELECT id FROM question WHERE question = 
    'Out of the following Harry Potter charaters, which ones do you like?'),
    (SELECT id FROM study WHERE name = 'Harry Potter Favorite Movie')
);
INSERT INTO study_to_question(question_id,study_id)
VALUES(
    (SELECT id FROM question WHERE question = 
    'Which of the following is your favorite Harry Potter Movie?'),
    (SELECT id FROM study WHERE name = 'Harry Potter Favorite Movie')
);
INSERT INTO study_to_question(question_id,study_id)
VALUES(
    (SELECT id FROM question WHERE question = 
    'Do you like Harry Potter?'),
    (SELECT id FROM study WHERE name = 'Harry Potter Favorite Movie')
);
INSERT INTO study_to_question(question_id,study_id)
VALUES(
    (SELECT id FROM question WHERE question = 
    'Which of the following is your favorite Star Wars Movie?'),
    (SELECT id FROM study WHERE name = 'Star Wars Favorite Movie')
);
INSERT INTO study_to_question(question_id,study_id)
VALUES(
    (SELECT id FROM question WHERE question = 
    'Out of the following Star Wars charaters, which ones do you like?'),
    (SELECT id FROM study WHERE name = 'Star Wars Favorite Movie')
);
INSERT INTO study_to_question(question_id,study_id)
VALUES(
    (SELECT id FROM question WHERE question = 
    'Do you like Disney Star Wars?'),
    (SELECT id FROM study WHERE name = 'Star Wars Favorite Movie')
);


/*
anwsers_multi_choices setup rows
*/
INSERT INTO anwsers_multi_choices(question_id,qorder,anwser)
VALUES(
    (SELECT id FROM question WHERE question = 'Do you like Disney Star Wars?'),
    1,
    "Yes"
);
INSERT INTO anwsers_multi_choices(question_id,qorder,anwser)
VALUES(
    (SELECT id FROM question WHERE question = 'Do you like Disney Star Wars?'),
    2,
    "No"
);
INSERT INTO anwsers_multi_choices(question_id,qorder,anwser)
VALUES(
    (SELECT id FROM question WHERE question = 'Do you like Harry Potter?'),
    1,
    "Yes"
);
INSERT INTO anwsers_multi_choices(question_id,qorder,anwser)
VALUES(
    (SELECT id FROM question WHERE question = 'Do you like Harry Potter?'),
    2,
    "No"
);
INSERT INTO anwsers_multi_choices(question_id,qorder,anwser)
VALUES(
    (SELECT id FROM question WHERE question = 
    'Which of the following is your favorite Star Wars Movie?'),
    1,
    "Revenge of the Sith"
);
INSERT INTO anwsers_multi_choices(question_id,qorder,anwser)
VALUES(
    (SELECT id FROM question WHERE question = 
    'Which of the following is your favorite Star Wars Movie?'),
    2,
    "The Empire Strikes Back"
);
INSERT INTO anwsers_multi_choices(question_id,qorder,anwser)
VALUES(
    (SELECT id FROM question WHERE question = 
    'Which of the following is your favorite Star Wars Movie?'),
    3,
    "A New Hope"
);
INSERT INTO anwsers_multi_choices(question_id,qorder,anwser)
VALUES(
    (SELECT id FROM question WHERE question = 
    'Which of the following is your favorite Star Wars Movie?'),
    4,
    "Return of the Jedi"
);
INSERT INTO anwsers_multi_choices(question_id,qorder,anwser)
VALUES(
    (SELECT id FROM question WHERE question = 
    'Which of the following is your favorite Harry Potter Movie?'),
    1,
    "Harry Potter and the Sorcerer&#39s Stone"
);
INSERT INTO anwsers_multi_choices(question_id,qorder,anwser)
VALUES(
    (SELECT id FROM question WHERE question = 
    'Which of the following is your favorite Harry Potter Movie?'),
    2,
    "Harry Potter and the Prisoner of Azkaban"
);
INSERT INTO anwsers_multi_choices(question_id,qorder,anwser)
VALUES(
    (SELECT id FROM question WHERE question = 
    'Which of the following is your favorite Harry Potter Movie?'),
    3,
    "Harry Potter and the Order of the Phoenix"
);
INSERT INTO anwsers_multi_choices(question_id,qorder,anwser)
VALUES(
    (SELECT id FROM question WHERE question = 
    'Which of the following is your favorite Harry Potter Movie?'),
    4,
    "Harry Potter and the Deathly Hallows Part 1"
);

/*
anwsers_fill_in_blank setup rows
*/
/*INSERT INTO anwsers_fill_in_blank(question_id,preText)
VALUES();*/


/*
anwsers_checkbox setup rows
*/
INSERT INTO anwsers_checkbox(question_id,qorder,anwser)
VALUES(
    (SELECT id FROM question WHERE question = 
    'Out of the following Harry Potter charaters, which ones do you like?'),
    1,
    "Harry Potter"
);
INSERT INTO anwsers_checkbox(question_id,qorder,anwser)
VALUES(
    (SELECT id FROM question WHERE question = 
    'Out of the following Harry Potter charaters, which ones do you like?'),
    2,
    "Hermione Granger"
);
INSERT INTO anwsers_checkbox(question_id,qorder,anwser)
VALUES(
    (SELECT id FROM question WHERE question = 
    'Out of the following Harry Potter charaters, which ones do you like?'),
    3,
    "Rubeus Hagrid"
);
INSERT INTO anwsers_checkbox(question_id,qorder,anwser)
VALUES(
    (SELECT id FROM question WHERE question = 
    'Out of the following Harry Potter charaters, which ones do you like?'),
    4,
    "Aberforth Dumbledore"
);
INSERT INTO anwsers_checkbox(question_id,qorder,anwser)
VALUES(
    (SELECT id FROM question WHERE question = 
    'Out of the following Harry Potter charaters, which ones do you like?'),
    5,
    "Ron Weasley"
);
INSERT INTO anwsers_checkbox(question_id,qorder,anwser)
VALUES(
    (SELECT id FROM question WHERE question = 
    'Out of the following Harry Potter charaters, which ones do you like?'),
    6,
    "Lord Voldemort"
);
INSERT INTO anwsers_checkbox(question_id,qorder,anwser)
VALUES(
    (SELECT id FROM question WHERE question = 
    'Out of the following Star Wars charaters, which ones do you like?'),
    1,
    "Luke Skywalker"
);
INSERT INTO anwsers_checkbox(question_id,qorder,anwser)
VALUES(
    (SELECT id FROM question WHERE question = 
    'Out of the following Star Wars charaters, which ones do you like?'),
    2,
    "Leia Organa"
);
INSERT INTO anwsers_checkbox(question_id,qorder,anwser)
VALUES(
    (SELECT id FROM question WHERE question = 
    'Out of the following Star Wars charaters, which ones do you like?'),
    3,
    "Han Solo"
);
INSERT INTO anwsers_checkbox(question_id,qorder,anwser)
VALUES(
    (SELECT id FROM question WHERE question = 
    'Out of the following Star Wars charaters, which ones do you like?'),
    4,
    "Chewbacca"
);
INSERT INTO anwsers_checkbox(question_id,qorder,anwser)
VALUES(
    (SELECT id FROM question WHERE question = 
    'Out of the following Star Wars charaters, which ones do you like?'),
    5,
    "Darth Vader"
);
INSERT INTO anwsers_checkbox(question_id,qorder,anwser)
VALUES(
    (SELECT id FROM question WHERE question = 
    'Out of the following Star Wars charaters, which ones do you like?'),
    6,
    "Yoda"
);


/*
respons_to_fillinblank setup rows
*/
/*INSERT INTO respons_to_fillinblank(question_id,survey_interview_id,respons)
VALUES();*/


/*
respons_to_checkbox setup rows
*/
INSERT INTO respons_to_checkbox
(question_id,survey_interview_id,anwsers_checkbox_id)
VALUES(
    (SELECT id FROM question WHERE question = 
    'Out of the following Harry Potter charaters, which ones do you like?'),
    (
        SELECT survey_interview.id FROM survey_interview 
        INNER JOIN study_to_survey_pop 
        ON survey_interview.study_to_survey_pop_id = study_to_survey_pop.id 
        INNER JOIN survey_population 
        ON study_to_survey_pop.survey_population_id = survey_population.id
        INNER JOIN sample_group 
        ON study_to_survey_pop.sample_group_id = sample_group.id
        INNER JOIN study ON study_to_survey_pop.study_id = study.id
        WHERE survey_population.fname = 'Abraham' AND survey_population.lname = 'Simpson'
        AND sample_group.sample_name = 'Group1' AND study.name = 'Harry Potter Favorite Movie' 
    ),
    (
        SELECT anwsers_checkbox.id FROM anwsers_checkbox 
        INNER JOIN question ON anwsers_checkbox.question_id = question.id
        WHERE question.question = 
        'Out of the following Harry Potter charaters, which ones do you like?'
        AND anwsers_checkbox.anwser = 'Harry Potter'    
    )
);
INSERT INTO respons_to_checkbox
(question_id,survey_interview_id,anwsers_checkbox_id)
VALUES(
    (SELECT id FROM question WHERE question = 
    'Out of the following Harry Potter charaters, which ones do you like?'),
    (
        SELECT survey_interview.id FROM survey_interview 
        INNER JOIN study_to_survey_pop 
        ON survey_interview.study_to_survey_pop_id = study_to_survey_pop.id 
        INNER JOIN survey_population 
        ON study_to_survey_pop.survey_population_id = survey_population.id
        INNER JOIN sample_group 
        ON study_to_survey_pop.sample_group_id = sample_group.id
        INNER JOIN study ON study_to_survey_pop.study_id = study.id
        WHERE survey_population.fname = 'Abraham' AND survey_population.lname = 'Simpson'
        AND sample_group.sample_name = 'Group1' AND study.name = 'Harry Potter Favorite Movie' 
    ),
    (
        SELECT anwsers_checkbox.id FROM anwsers_checkbox 
        INNER JOIN question ON anwsers_checkbox.question_id = question.id
        WHERE question.question = 
        'Out of the following Harry Potter charaters, which ones do you like?'
        AND anwsers_checkbox.anwser = 'Hermione Granger'    
    )
);
INSERT INTO respons_to_checkbox
(question_id,survey_interview_id,anwsers_checkbox_id)
VALUES(
    (SELECT id FROM question WHERE question = 
    'Out of the following Harry Potter charaters, which ones do you like?'),
    (
        SELECT survey_interview.id FROM survey_interview 
        INNER JOIN study_to_survey_pop 
        ON survey_interview.study_to_survey_pop_id = study_to_survey_pop.id 
        INNER JOIN survey_population 
        ON study_to_survey_pop.survey_population_id = survey_population.id
        INNER JOIN sample_group 
        ON study_to_survey_pop.sample_group_id = sample_group.id
        INNER JOIN study ON study_to_survey_pop.study_id = study.id
        WHERE survey_population.fname = 'Bart' AND survey_population.lname = 'Simpson'
        AND sample_group.sample_name = 'Group1' AND study.name = 'Harry Potter Favorite Movie' 
    ),
    (
        SELECT anwsers_checkbox.id FROM anwsers_checkbox 
        INNER JOIN question ON anwsers_checkbox.question_id = question.id
        WHERE question.question = 
        'Out of the following Harry Potter charaters, which ones do you like?'
        AND anwsers_checkbox.anwser = 'Lord Voldemort'    
    )
);
INSERT INTO respons_to_checkbox
(question_id,survey_interview_id,anwsers_checkbox_id)
VALUES(
    (SELECT id FROM question WHERE question = 
    'Out of the following Harry Potter charaters, which ones do you like?'),
    (
        SELECT survey_interview.id FROM survey_interview 
        INNER JOIN study_to_survey_pop 
        ON survey_interview.study_to_survey_pop_id = study_to_survey_pop.id 
        INNER JOIN survey_population 
        ON study_to_survey_pop.survey_population_id = survey_population.id
        INNER JOIN sample_group 
        ON study_to_survey_pop.sample_group_id = sample_group.id
        INNER JOIN study ON study_to_survey_pop.study_id = study.id
        WHERE survey_population.fname = 'Bart' AND survey_population.lname = 'Simpson'
        AND sample_group.sample_name = 'Group1' AND study.name = 'Harry Potter Favorite Movie' 
    ),
    (
        SELECT anwsers_checkbox.id FROM anwsers_checkbox 
        INNER JOIN question ON anwsers_checkbox.question_id = question.id
        WHERE question.question = 
        'Out of the following Harry Potter charaters, which ones do you like?'
        AND anwsers_checkbox.anwser = 'Rubeus Hagrid'    
    )
);
INSERT INTO respons_to_checkbox
(question_id,survey_interview_id,anwsers_checkbox_id)
VALUES(
    (SELECT id FROM question WHERE question = 
    'Out of the following Star Wars charaters, which ones do you like?'),
    (
        SELECT survey_interview.id FROM survey_interview 
        INNER JOIN study_to_survey_pop 
        ON survey_interview.study_to_survey_pop_id = study_to_survey_pop.id 
        INNER JOIN survey_population 
        ON study_to_survey_pop.survey_population_id = survey_population.id
        INNER JOIN sample_group 
        ON study_to_survey_pop.sample_group_id = sample_group.id
        INNER JOIN study ON study_to_survey_pop.study_id = study.id
        WHERE survey_population.fname = 'Milhouse' AND survey_population.lname = 'Van Houten'
        AND sample_group.sample_name = 'Group2' AND study.name = 'Star Wars Favorite Movie' 
    ),
    (
        SELECT anwsers_checkbox.id FROM anwsers_checkbox 
        INNER JOIN question ON anwsers_checkbox.question_id = question.id
        WHERE question.question = 
        'Out of the following Star Wars charaters, which ones do you like?'
        AND anwsers_checkbox.anwser = 'Yoda'    
    )
);
INSERT INTO respons_to_checkbox
(question_id,survey_interview_id,anwsers_checkbox_id)
VALUES(
    (SELECT id FROM question WHERE question = 
    'Out of the following Star Wars charaters, which ones do you like?'),
    (
        SELECT survey_interview.id FROM survey_interview 
        INNER JOIN study_to_survey_pop 
        ON survey_interview.study_to_survey_pop_id = study_to_survey_pop.id 
        INNER JOIN survey_population 
        ON study_to_survey_pop.survey_population_id = survey_population.id
        INNER JOIN sample_group 
        ON study_to_survey_pop.sample_group_id = sample_group.id
        INNER JOIN study ON study_to_survey_pop.study_id = study.id
        WHERE survey_population.fname = 'Milhouse' AND survey_population.lname = 'Van Houten'
        AND sample_group.sample_name = 'Group2' AND study.name = 'Star Wars Favorite Movie' 
    ),
    (
        SELECT anwsers_checkbox.id FROM anwsers_checkbox 
        INNER JOIN question ON anwsers_checkbox.question_id = question.id
        WHERE question.question = 
        'Out of the following Star Wars charaters, which ones do you like?'
        AND anwsers_checkbox.anwser = 'Darth Vader'    
    )
);
INSERT INTO respons_to_checkbox
(question_id,survey_interview_id,anwsers_checkbox_id)
VALUES(
    (SELECT id FROM question WHERE question = 
    'Out of the following Star Wars charaters, which ones do you like?'),
    (
        SELECT survey_interview.id FROM survey_interview 
        INNER JOIN study_to_survey_pop 
        ON survey_interview.study_to_survey_pop_id = study_to_survey_pop.id 
        INNER JOIN survey_population 
        ON study_to_survey_pop.survey_population_id = survey_population.id
        INNER JOIN sample_group 
        ON study_to_survey_pop.sample_group_id = sample_group.id
        INNER JOIN study ON study_to_survey_pop.study_id = study.id
        WHERE survey_population.fname = 'Clancy' AND survey_population.lname = 'Wiggum'
        AND sample_group.sample_name = 'Group2' AND study.name = 'Star Wars Favorite Movie' 
    ),
    (
        SELECT anwsers_checkbox.id FROM anwsers_checkbox 
        INNER JOIN question ON anwsers_checkbox.question_id = question.id
        WHERE question.question = 
        'Out of the following Star Wars charaters, which ones do you like?'
        AND anwsers_checkbox.anwser = 'Luke Skywalker'    
    )
);

/*
respons_to_multi_choice setup rows
*/
INSERT INTO respons_to_multi_choice
(question_id,survey_interview_id,anwsers_multi_choices_id)
VALUES(
        (SELECT id FROM question WHERE question = 
    'Which of the following is your favorite Star Wars Movie?'),
    (
        SELECT survey_interview.id FROM survey_interview 
        INNER JOIN study_to_survey_pop 
        ON survey_interview.study_to_survey_pop_id = study_to_survey_pop.id 
        INNER JOIN survey_population 
        ON study_to_survey_pop.survey_population_id = survey_population.id
        INNER JOIN sample_group 
        ON study_to_survey_pop.sample_group_id = sample_group.id
        INNER JOIN study ON study_to_survey_pop.study_id = study.id
        WHERE survey_population.fname = 'Clancy' AND survey_population.lname = 'Wiggum'
        AND sample_group.sample_name = 'Group2' AND study.name = 'Star Wars Favorite Movie' 
    ),
    (
        SELECT anwsers_multi_choices.id FROM anwsers_multi_choices 
        INNER JOIN question ON anwsers_multi_choices.question_id = question.id
        WHERE question.question = 
        'Which of the following is your favorite Star Wars Movie?'
        AND anwsers_multi_choices.anwser = 'The Empire Strikes Back'    
    )
);
INSERT INTO respons_to_multi_choice
(question_id,survey_interview_id,anwsers_multi_choices_id)
VALUES(
        (SELECT id FROM question WHERE question = 
    'Do you like Disney Star Wars?'),
    (
        SELECT survey_interview.id FROM survey_interview 
        INNER JOIN study_to_survey_pop 
        ON survey_interview.study_to_survey_pop_id = study_to_survey_pop.id 
        INNER JOIN survey_population 
        ON study_to_survey_pop.survey_population_id = survey_population.id
        INNER JOIN sample_group 
        ON study_to_survey_pop.sample_group_id = sample_group.id
        INNER JOIN study ON study_to_survey_pop.study_id = study.id
        WHERE survey_population.fname = 'Clancy' AND survey_population.lname = 'Wiggum'
        AND sample_group.sample_name = 'Group2' AND study.name = 'Star Wars Favorite Movie' 
    ),
    (
        SELECT anwsers_multi_choices.id FROM anwsers_multi_choices 
        INNER JOIN question ON anwsers_multi_choices.question_id = question.id
        WHERE question.question = 
        'Do you like Disney Star Wars?'
        AND anwsers_multi_choices.anwser = 'No'    
    )
);
INSERT INTO respons_to_multi_choice
(question_id,survey_interview_id,anwsers_multi_choices_id)
VALUES(
        (SELECT id FROM question WHERE question = 
    'Which of the following is your favorite Star Wars Movie?'),
    (
        SELECT survey_interview.id FROM survey_interview 
        INNER JOIN study_to_survey_pop 
        ON survey_interview.study_to_survey_pop_id = study_to_survey_pop.id 
        INNER JOIN survey_population 
        ON study_to_survey_pop.survey_population_id = survey_population.id
        INNER JOIN sample_group 
        ON study_to_survey_pop.sample_group_id = sample_group.id
        INNER JOIN study ON study_to_survey_pop.study_id = study.id
        WHERE survey_population.fname = 'Milhouse' AND survey_population.lname = 'Van Houten'
        AND sample_group.sample_name = 'Group2' AND study.name = 'Star Wars Favorite Movie' 
    ),
    (
        SELECT anwsers_multi_choices.id FROM anwsers_multi_choices 
        INNER JOIN question ON anwsers_multi_choices.question_id = question.id
        WHERE question.question = 
        'Which of the following is your favorite Star Wars Movie?'
        AND anwsers_multi_choices.anwser = 'Revenge of the Sith'    
    )
);
INSERT INTO respons_to_multi_choice
(question_id,survey_interview_id,anwsers_multi_choices_id)
VALUES(
        (SELECT id FROM question WHERE question = 
    'Do you like Disney Star Wars?'),
    (
        SELECT survey_interview.id FROM survey_interview 
        INNER JOIN study_to_survey_pop 
        ON survey_interview.study_to_survey_pop_id = study_to_survey_pop.id 
        INNER JOIN survey_population 
        ON study_to_survey_pop.survey_population_id = survey_population.id
        INNER JOIN sample_group 
        ON study_to_survey_pop.sample_group_id = sample_group.id
        INNER JOIN study ON study_to_survey_pop.study_id = study.id
        WHERE survey_population.fname = 'Milhouse' AND survey_population.lname = 'Van Houten'
        AND sample_group.sample_name = 'Group2' AND study.name = 'Star Wars Favorite Movie' 
    ),
    (
        SELECT anwsers_multi_choices.id FROM anwsers_multi_choices 
        INNER JOIN question ON anwsers_multi_choices.question_id = question.id
        WHERE question.question = 
        'Do you like Disney Star Wars?'
        AND anwsers_multi_choices.anwser = 'No'    
    )
);
INSERT INTO respons_to_multi_choice
(question_id,survey_interview_id,anwsers_multi_choices_id)
VALUES(
        (SELECT id FROM question WHERE question = 
    'Which of the following is your favorite Harry Potter Movie?'),
    (
        SELECT survey_interview.id FROM survey_interview 
        INNER JOIN study_to_survey_pop 
        ON survey_interview.study_to_survey_pop_id = study_to_survey_pop.id 
        INNER JOIN survey_population 
        ON study_to_survey_pop.survey_population_id = survey_population.id
        INNER JOIN sample_group 
        ON study_to_survey_pop.sample_group_id = sample_group.id
        INNER JOIN study ON study_to_survey_pop.study_id = study.id
        WHERE survey_population.fname = 'Abraham' AND survey_population.lname = 'Simpson'
        AND sample_group.sample_name = 'Group1' AND study.name = 'Harry Potter Favorite Movie' 
    ),
    (
        SELECT anwsers_multi_choices.id FROM anwsers_multi_choices 
        INNER JOIN question ON anwsers_multi_choices.question_id = question.id
        WHERE question.question = 
        'Which of the following is your favorite Harry Potter Movie?'
        AND anwsers_multi_choices.anwser = 'Harry Potter and the Order of the Phoenix'    
    )
);
INSERT INTO respons_to_multi_choice
(question_id,survey_interview_id,anwsers_multi_choices_id)
VALUES(
        (SELECT id FROM question WHERE question = 
    'Do you like Harry Potter?'),
    (
        SELECT survey_interview.id FROM survey_interview 
        INNER JOIN study_to_survey_pop 
        ON survey_interview.study_to_survey_pop_id = study_to_survey_pop.id 
        INNER JOIN survey_population 
        ON study_to_survey_pop.survey_population_id = survey_population.id
        INNER JOIN sample_group 
        ON study_to_survey_pop.sample_group_id = sample_group.id
        INNER JOIN study ON study_to_survey_pop.study_id = study.id
        WHERE survey_population.fname = 'Abraham' AND survey_population.lname = 'Simpson'
        AND sample_group.sample_name = 'Group1' AND study.name = 'Harry Potter Favorite Movie' 
    ),
    (
        SELECT anwsers_multi_choices.id FROM anwsers_multi_choices 
        INNER JOIN question ON anwsers_multi_choices.question_id = question.id
        WHERE question.question = 
        'Do you like Harry Potter?'
        AND anwsers_multi_choices.anwser = 'Yes'    
    )
);
INSERT INTO respons_to_multi_choice
(question_id,survey_interview_id,anwsers_multi_choices_id)
VALUES(
        (SELECT id FROM question WHERE question = 
    'Which of the following is your favorite Harry Potter Movie?'),
    (
        SELECT survey_interview.id FROM survey_interview 
        INNER JOIN study_to_survey_pop 
        ON survey_interview.study_to_survey_pop_id = study_to_survey_pop.id 
        INNER JOIN survey_population 
        ON study_to_survey_pop.survey_population_id = survey_population.id
        INNER JOIN sample_group 
        ON study_to_survey_pop.sample_group_id = sample_group.id
        INNER JOIN study ON study_to_survey_pop.study_id = study.id
        WHERE survey_population.fname = 'Bart' AND survey_population.lname = 'Simpson'
        AND sample_group.sample_name = 'Group1' AND study.name = 'Harry Potter Favorite Movie' 
    ),
    (
        SELECT anwsers_multi_choices.id FROM anwsers_multi_choices 
        INNER JOIN question ON anwsers_multi_choices.question_id = question.id
        WHERE question.question = 
        'Which of the following is your favorite Harry Potter Movie?'
        AND anwsers_multi_choices.anwser = 'Harry Potter and the Deathly Hallows Part 1'    
    )
);
INSERT INTO respons_to_multi_choice
(question_id,survey_interview_id,anwsers_multi_choices_id)
VALUES(
        (SELECT id FROM question WHERE question = 
    'Do you like Harry Potter?'),
    (
        SELECT survey_interview.id FROM survey_interview 
        INNER JOIN study_to_survey_pop 
        ON survey_interview.study_to_survey_pop_id = study_to_survey_pop.id 
        INNER JOIN survey_population 
        ON study_to_survey_pop.survey_population_id = survey_population.id
        INNER JOIN sample_group 
        ON study_to_survey_pop.sample_group_id = sample_group.id
        INNER JOIN study ON study_to_survey_pop.study_id = study.id
        WHERE survey_population.fname = 'Bart' AND survey_population.lname = 'Simpson'
        AND sample_group.sample_name = 'Group1' AND study.name = 'Harry Potter Favorite Movie' 
    ),
    (
        SELECT anwsers_multi_choices.id FROM anwsers_multi_choices 
        INNER JOIN question ON anwsers_multi_choices.question_id = question.id
        WHERE question.question = 
        'Do you like Harry Potter?'
        AND anwsers_multi_choices.anwser = 'Yes'    
    )
);









