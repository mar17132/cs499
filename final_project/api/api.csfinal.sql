/*
* Created By: Matthew Martin
* Created On: 10/28/2019
* Modified By: Matthew Martin
* Modified On: 1/1/2020
* Description: This script will create the tables needed for csfinal database.
*/

CREATE DATABASE IF NOT EXISTS csfinal;


USE csfinal;

/*
This table is a user table. The ones that will be interviewing and creating 
surveys.
*/
CREATE TABLE IF NOT EXISTS survey_users(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    uname VARCHAR(254) NOT NULL,
    passwd VARCHAR(60) NOT NULL,
    PRIMARY KEY(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*
This table is the population or people that can be interviewed.
*/
CREATE TABLE IF NOT EXISTS survey_population(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    fname VARCHAR(254) NOT NULL,
    mname VARCHAR(254) NULL,
    lname VARCHAR(254) NOT NULL,
    street VARCHAR(254) NOT NULL,
    apt VARCHAR(5) NULL,
    zip VARCHAR(10) NOT NULL,
    state VARCHAR(2) NOT NULL,
    phone VARCHAR(7) NOT NULL,
    PRIMARY KEY(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*
This table is the sample group or the portion of the population that will be
surveyed
*/
CREATE TABLE IF NOT EXISTS sample_group(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    sample_name VARCHAR(254) NOT NULL,
    PRIMARY KEY(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*
This table is to connect the people in the population to the sample group
*/
CREATE TABLE IF NOT EXISTS surveyp_to_sampleg(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    survey_population_id INT NOT NULL,
    sample_group_id INT NOT NULL,
    PRIMARY KEY(id),
    /*sample_group foreign key*/
    CONSTRAINT sample_group_to_surveyp_to_sampleg_fk_con
    FOREIGN KEY sample_group_to_surveyp_to_sampleg_fk(sample_group_id) 
    REFERENCES sample_group(id) 
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
    /*survey_population foreign key*/
    CONSTRAINT survey_population_to_surveyp_to_sampleg_fk_con
    FOREIGN KEY survey_population_to_surveyp_to_sampleg_fk(survey_population_id) 
    REFERENCES survey_population(id) 
    ON DELETE RESTRICT
    ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*
This table is to keep a unquie list of types for all tables
*/
CREATE TABLE IF NOT EXISTS type(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    type VARCHAR(100) NOT NULL,
    PRIMARY KEY(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*
This table is to create studys for the surveys. try_amount is the amount of times
the people of the population will be contacted for the survey until the interview
is completed or declaried completed. order_questions is if the questions are 
displayed in a certain order defined by the user
*/
CREATE TABLE IF NOT EXISTS study(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    type_id INT NOT NULL,
    order_questions BOOLEAN NOT NULL DEFAULT 0,
    start_date TIMESTAMP NOT NULL,
    end_date TIMESTAMP NOT NULL,
    try_amount INT NOT NULL DEFAULT 1,
    PRIMARY KEY(id),
    /*type foreign key*/
    CONSTRAINT study_to_type_fk_con
    FOREIGN KEY study_to_type_fk(type_id) 
    REFERENCES type(id) 
    ON DELETE RESTRICT
    ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*
This table is to connect group, population person, and study together. It
also indicates if the has been done or is currently in progress. 
*/
CREATE TABLE IF NOT EXISTS study_to_survey_pop(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    study_id INT NOT NULL,
    sample_group_id INT NOT NULL,
    survey_population_id INT NOT NULL,
    completed BOOLEAN NOT NULL DEFAULT 0,
    locked BOOLEAN NOT NULL DEFAULT 0,
    number_of_tries INT NOT NULL DEFAULT 0,
    PRIMARY KEY(id),
    /*sample_group foreign key*/
    CONSTRAINT sample_group_to_study_to_survey_pop_fk_con
    FOREIGN KEY sample_group_to_study_to_survey_pop_fk(sample_group_id) 
    REFERENCES sample_group(id) 
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
    /*study foreign key*/
    CONSTRAINT study_to_study_to_survey_pop_fk_con
    FOREIGN KEY study_to_study_to_survey_pop_fk(study_id) 
    REFERENCES study(id) 
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
    /*survey_population foreign key*/
    CONSTRAINT survey_population_to_study_to_survey_pop_fk_con
    FOREIGN KEY survey_population_to_study_to_survey_pop_fk(survey_population_id) 
    REFERENCES survey_population(id) 
    ON DELETE RESTRICT
    ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


/*
This table keeps track of which users is connducting the interview.
It has the start and end timestamps and status of the interview.
*/
CREATE TABLE IF NOT EXISTS survey_interview(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    study_to_survey_pop_id INT NOT NULL,
    survey_users_id INT NOT NULL,
    interview_start TIMESTAMP NOT NULL,
    interview_end TIMESTAMP NULL DEFAULT NULL,
    type_id INT NOT NULL DEFAULT ,/*TODO############# get an ID for default*/ 
    PRIMARY KEY(id),
    /*study_to_survey_pop foreign key*/
    CONSTRAINT study_to_survey_pop_to_survey_interview_fk_con
    FOREIGN KEY study_to_survey_pop_to_survey_interview_fk(study_to_survey_pop_id) 
    REFERENCES study_to_survey_pop(id) 
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
    /*survey_users foreign key*/
    CONSTRAINT survey_users_to_survey_interview_fk_con
    FOREIGN KEY survey_users_to_survey_interview_fk(survey_users_id) 
    REFERENCES survey_users(id) 
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
    /*type foreign key*/
    CONSTRAINT type_to_survey_interview_fk_con
    FOREIGN KEY type_to_survey_interview_fk(type_id) 
    REFERENCES type(id) 
    ON DELETE RESTRICT
    ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;



/*
###################QUESTIONS TABLES###################
*/

/*
This table is for creating the questions and what type of question. Order_Anwsers
is to tell if the anwsers will be displayed in a certain order defined by user.
question_order is where the question will be displayed. if question_order
 is -1 the order is off
*/
CREATE TABLE IF NOT EXISTS question(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    quesiton VARCHAR(254) NOT NULL,
    order_Anwsers BOOLEAN NOT NULL DEFAULT 0,
    question_order INT NOT NULL DEFAULT -1,
    type_id INT NOT NULL,
    PRIMARY KEY(id),
    /*type foreign key*/
    CONSTRAINT question_to_type_fk_con
    FOREIGN KEY quesiton_to_type_fk(type_id) 
    REFERENCES type(id) 
    ON DELETE RESTRICT
    ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*
This table connects the questions to the study.
*/
CREATE TABLE IF NOT EXISTS study_to_question(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    quesiton_id INT NOT NULL,
    study_id INT NOT NULL,
    PRIMARY KEY(id),
    /*study foreign key*/
    CONSTRAINT study_to_question_to_study_fk_con
    FOREIGN KEY study_to_question_to_study_fk(study_id) 
    REFERENCES study(id) 
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
    /*question foreign key*/
    CONSTRAINT study_to_question_to_question_fk_con
    FOREIGN KEY study_to_question_to_quesiton_fk(quesiton_id) 
    REFERENCES question(id) 
    ON DELETE RESTRICT
    ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*
This table is for the multi choces question anwsers. It linkes the anwers to 
the question and keeps track of the multi_choice_order the anwsers will appear.
If the multi_choice_order is -1 then order is off and 
*/
CREATE TABLE IF NOT EXISTS anwsers_multi_choices(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    quesiton_id INT NOT NULL,
    multi_choice_order INT NULL DEFAULT -1,
    anwser VARCHAR(254) NOT NULL,
    PRIMARY KEY(id),
    /*question foreign key*/
    CONSTRAINT anwsers_multi_choices_to_question_fk_con
    FOREIGN KEY sanwsers_multi_choices_to_quesiton_fk(quesiton_id) 
    REFERENCES question(id) 
    ON DELETE RESTRICT
    ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*
This table is to connect questions to fill in the blank. The table is for 
a pretext that is in the textbox before writing has started.
*/
CREATE TABLE IF NOT EXISTS anwsers_fill_in_blank(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    quesiton_id INT NOT NULL,
    preText VARCHAR(254) NULL,
    PRIMARY KEY(id),
    /*question foreign key*/
    CONSTRAINT anwsers_fill_in_blank_to_question_fk_con
    FOREIGN KEY anwsers_fill_in_blank_to_quesiton_fk(quesiton_id) 
    REFERENCES question(id) 
    ON DELETE RESTRICT
    ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*
This table is to connect questions to checkbox anwsers. It also tracks the 
order of the anwser. If checkbox_order is -1 then order is off.
*/
CREATE TABLE IF NOT EXISTS anwsers_checkbox(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    quesiton_id INT NOT NULL,
    checkbox_order INT NULL DEFAULT -1,
    anwser VARCHAR(254) NOT NULL,
    PRIMARY KEY(id),
    /*question foreign key*/
    CONSTRAINT anwsers_checkbox_to_question_fk_con
    FOREIGN KEY anwsers_checkbox_to_quesiton_fk(quesiton_id) 
    REFERENCES question(id) 
    ON DELETE RESTRICT
    ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*
The next tables are to recored the respones from the people that are surveyed.
*/

/*
Fill in the blank respons. This is for respons for the person of the population.
*/
CREATE TABLE IF NOT EXISTS respons_to_fillinblank(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    quesiton_id INT NOT NULL,
    survey_interview_id INT NOT NULL,
    respons VARCHAR(254) NOT NULL,
    PRIMARY KEY(id),
    /*question foreign key*/
    CONSTRAINT respons_to_fillinblank_to_question_fk_con
    FOREIGN KEY respons_to_fillinblank_to_quesiton_fk(quesiton_id) 
    REFERENCES question(id) 
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
    /*survey_interview foreign key*/
    CONSTRAINT respons_to_fillinblank_to_survey_interview_fk_con
    FOREIGN KEY respons_to_fillinblank_to_survey_interview_fk(survey_interview_id) 
    REFERENCES survey_interview(id) 
    ON DELETE RESTRICT
    ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


/*
This table is to connect the responses to the checkbox questions. It also 
connects the interview to the responses.
*/
CREATE TABLE IF NOT EXISTS respons_to_checkbox(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    quesiton_id INT NOT NULL,
    survey_interview_id INT NOT NULL,
    respons VARCHAR(254) NOT NULL,
    PRIMARY KEY(id),
    /*question foreign key*/
    CONSTRAINT respons_to_checkbox_to_question_fk_con
    FOREIGN KEY respons_to_checkbox_to_quesiton_fk(quesiton_id) 
    REFERENCES question(id) 
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
    /*survey_interview foreign key*/
    CONSTRAINT respons_to_checkbox_to_survey_interview_fk_con
    FOREIGN KEY respons_to_checkbox_to_survey_interview_fk(survey_interview_id) 
    REFERENCES survey_interview(id) 
    ON DELETE RESTRICT
    ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


/*
This table connects multi choice question to respons and the interview.
*/
CREATE TABLE IF NOT EXISTS respons_to_multi_choice(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    quesiton_id INT NOT NULL,
    survey_interview_id INT NOT NULL,
    respons VARCHAR(254) NOT NULL,
    PRIMARY KEY(id),
    /*question foreign key*/
    CONSTRAINT respons_to_multi_choice_to_question_fk_con
    FOREIGN KEY respons_to_multi_choice_to_quesiton_fk(quesiton_id) 
    REFERENCES question(id) 
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
    /*survey_interview foreign key*/
    CONSTRAINT respons_to_multi_choice_to_survey_interview_fk_con
    FOREIGN KEY respons_to_multi_choice_to_survey_interview_fk(survey_interview_id) 
    REFERENCES survey_interview(id) 
    ON DELETE RESTRICT
    ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Add Default Items*/

