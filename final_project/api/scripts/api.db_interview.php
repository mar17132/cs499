
<?php
/*
*
*/

require_once 'api.db_connect.php';
require_once 'api.json_converter.php';


function getCompleteSurveys()
{
    //This will get all users names
    //and type 

        GLOBAL $dbObject;
        GLOBAL $toJsonString; 
    
        $dbObject->querySelect("select 
        qu.in_waiting_queue as que,qu.id as quid,
        date(sint.interview_start) as startint_date,time(sint.interview_start) as startint_time,
        date(sint.interview_end) as endint_date,time(sint.interview_end) as endint_time,
        sint.id as interviewid,concat(spop.fname,' ',spop.lname) as popname,
        spop.id as popid,susers.uname,susers.id as uid,sspop.completed,sspop.locked,
        type.type,sgroup.sample_name as groupname,sgroup.id as groupid,
        study.name as studyname,study.id as studyid
        from survey_interview sint
        join study_to_survey_pop sspop on sint.study_to_survey_pop_id = sspop.id
        join survey_queue qu on qu.study_to_survey_pop_id = sint.study_to_survey_pop_id
        join study on sspop.study_id = study.id
        join sample_group sgroup on sspop.sample_group_id = sgroup.id 
        join survey_population spop on sspop.survey_population_id = spop.id 
        join survey_users susers on sint.survey_users_id = susers.id 
        join type on sint.type_id = type.id
        where type.type = 'Completed'");

        if($dbObject->isDberror())
        {
            return $dbObject->getDberror();
        }
        else
        {
            if(count($dbObject->getSQLResults()) > 0)
            {
                //user exisit
                $toJsonString->jsonEncode($dbObject->getSQLResults());
                
                return '{"status":"good","results":"true",'. $toJsonString->getdbrowString() . '}';
            }
            else
            {
                //user does not exisist
                return '{"status":"good","results":"false"}';
            }
        }    
}

function getInProgresSurveys()
{
    //this will test if there is a user with pass
    GLOBAL $dbObject;
    GLOBAL $toJsonString; 

    $dbObject->querySelect("select 
qu.in_waiting_queue as que,qu.id as quid,
date(sint.interview_start) as startint_date,time(sint.interview_start) as startint_time,
sint.id as interviewid,concat(spop.fname,' ',spop.lname) as popname,
spop.id as popid,susers.uname,susers.id as uid,sspop.completed,sspop.locked,
type.type,sgroup.sample_name as groupname,sgroup.id as groupid,
study.name as studyname,study.id as studyid
from survey_interview sint
join study_to_survey_pop sspop on sint.study_to_survey_pop_id = sspop.id
join survey_queue qu on qu.study_to_survey_pop_id = sint.study_to_survey_pop_id
join study on sspop.study_id = study.id
join sample_group sgroup on sspop.sample_group_id = sgroup.id 
join survey_population spop on sspop.survey_population_id = spop.id 
join survey_users susers on sint.survey_users_id = susers.id 
join type on sint.type_id = type.id
where type.type = 'In Progress'");

    if($dbObject->isDberror())
    {
        return $dbObject->getDberror();
    }
    else
    {
        if(count($dbObject->getSQLResults()) > 0)
        {
            //user exisit
            $toJsonString->jsonEncode($dbObject->getSQLResults());
            
            return '{"status":"good","results":"true",'. $toJsonString->getdbrowString() . '}';
        }
        else
        {
            //user does not exisist
            return '{"status":"good","results":"false"}';
        }
    }  
}

function getQueSurveys()
{
    //This will get all users names
    //and type 

        GLOBAL $dbObject;
        GLOBAL $toJsonString; 
    
        $dbObject->querySelect("select 
        qu.in_waiting_queue as que,qu.id as quid,
        concat(spop.fname,' ',spop.lname) as popname,spop.id as popid,sspop.locked,
        sspop.completed,sgroup.sample_name as groupname,sgroup.id as groupid,
        study.name as studyname,study.id as studyid
        from survey_queue qu
        join study_to_survey_pop sspop on qu.study_to_survey_pop_id = sspop.id
        join study on sspop.study_id = study.id
        join sample_group sgroup on sspop.sample_group_id = sgroup.id 
        join survey_population spop on sspop.survey_population_id = spop.id
        where sspop.completed=0 and sspop.locked=0");

        if($dbObject->isDberror())
        {
            return $dbObject->getDberror();
        }
        else
        {
            if(count($dbObject->getSQLResults()) > 0)
            {
                //user exisit
                $toJsonString->jsonEncode($dbObject->getSQLResults());
                
                return '{"status":"good","results":"true",'. $toJsonString->getdbrowString() . '}';
            }
            else
            {
                //user does not exisist
                return '{"status":"good","results":"false"}';
            }
        }    
}



/*

select 
concat(spop.fname,' ',spop.lname) as popname, 
sint.id as intid,
susers.uname,
multia.anwser,
question.question as multiquestion
from survey_interview sint
right join study_to_survey_pop sspop on sint.study_to_survey_pop_id = sspop.id 
join survey_population spop on sspop.survey_population_id = spop.id 
join study on sspop.study_id = study.id 
join survey_users susers on sint.survey_users_id = susers.id 
join study_to_question on study_to_question.study_id = study.id
join question on study_to_question.question_id = question.id
join respons_to_multi_choice multi on multi.question_id = question.id
join anwsers_multi_choices multia on multia.id = multi.anwsers_multi_choices_id
order by sint.id;

*/

?>




