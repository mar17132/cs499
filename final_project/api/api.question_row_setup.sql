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
VALUES();


/*
study_to_question setup rows
*/
INSERT INTO study_to_question(question_id,study_id)
VALUES();


/*
anwsers_multi_choices setup rows
*/
INSERT INTO anwsers_multi_choices(question_id,multi_choice_order,anwser)
VALUES();


/*
anwsers_fill_in_blank setup rows
*/
INSERT INTO anwsers_fill_in_blank(question_id,preText)
VALUES();


/*
anwsers_checkbox setup rows
*/
INSERT INTO anwsers_checkbox(question_id,checkbox_order,anwser)
VALUES();


/*
respons_to_fillinblank setup rows
*/
INSERT INTO respons_to_fillinblank(question_id,survey_interview_id,respons)
VALUES();


/*
respons_to_checkbox setup rows
*/
INSERT INTO respons_to_checkbox(question_id,survey_interview_id,anwsers_checkbox_id)
VALUES();


/*
respons_to_multi_choice setup rows
*/
INSERT INTO respons_to_multi_choice(question_id,survey_interview_id,anwsers_multi_choices_id)
VALUES();




