
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

function getInterviewRespons($varArray)
{
    //This will get all users names
    //and type 

        GLOBAL $dbObject;
        GLOBAL $toJsonString; 
    
        $dbObject->querySelect("select 
        sint.id as intid,concat(spop.fname,' ',spop.lname) as popname, 
        spop.id as popid,sgroup.id as groupid,sgroup.sample_name as groupname,
        susers.uname,susers.id as uid,study.id as studyid,
        study.name as study,question.id as questid,question.question,
        type.id as typeid,type.type,
        if(anwsers_checkbox.anwser is NULL or 
        anwsers_checkbox.anwser = '','null',anwsers_checkbox.anwser) 
        as checkbox_anwser,
        if(anwsers_multi_choices.anwser is NULL or 
        anwsers_multi_choices.anwser = '','null',anwsers_multi_choices.anwser) 
        as multi_anwser,
        if(respons_to_fillinblank.respons is NULL or 
        respons_to_fillinblank.respons = '','null',
        respons_to_fillinblank.respons) as fill_anwser
        from survey_interview sint
        join study_to_survey_pop sspop on sint.study_to_survey_pop_id = sspop.id 
        join survey_population spop on sspop.survey_population_id = spop.id 
        join sample_group sgroup on sspop.sample_group_id = sgroup.id
        join study on sspop.study_id = study.id 
        join survey_users susers on sint.survey_users_id = susers.id 
        join study_to_question on study_to_question.study_id = study.id
        join question on study_to_question.question_id = question.id
        join type on question.type_id = type.id
        left join respons_to_checkbox on 
        respons_to_checkbox.survey_interview_id=sint.id 
        and respons_to_checkbox.question_id=question.id
        left join anwsers_checkbox on 
        respons_to_checkbox.anwsers_checkbox_id=anwsers_checkbox.id
        left join respons_to_multi_choice on 
        respons_to_multi_choice.survey_interview_id=sint.id 
        and respons_to_multi_choice.question_id=question.id
        left join anwsers_multi_choices on 
        respons_to_multi_choice.anwsers_multi_choices_id=anwsers_multi_choices.id
        left join respons_to_fillinblank on 
        respons_to_fillinblank.survey_interview_id=sint.id 
        and respons_to_fillinblank.question_id=question.id
        where sint.id=".$varArray['intid']." and 
        spop.id=".$varArray['popid']." and study.id=".$varArray['studyid']." 
        and sgroup.id=".$varArray['groupid']." and susers.id=".$varArray['uid'].
        " order by sint.id,question.id;");


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

function getSurveyQuestions($studyid)
{
    //This will get all users names
    //and type 

        GLOBAL $dbObject;
        GLOBAL $toJsonString; 
    
        $dbObject->querySelect("select 
        study.id as studyid,study.name as study,question.id as questid,
        question.question,type.id as typeid,type.type,
        if(anwsers_checkbox.id is NULL or 
        anwsers_checkbox.id = '','null',anwsers_checkbox.id) 
        as checkbox_id,
        if(anwsers_checkbox.anwser is NULL or 
        anwsers_checkbox.anwser = '','null',anwsers_checkbox.anwser) 
        as checkbox_anwser,
        if(anwsers_multi_choices.id is NULL or 
        anwsers_multi_choices.id = '','null',anwsers_multi_choices.id) as multi_id,
        if(anwsers_multi_choices.anwser is NULL or 
        anwsers_multi_choices.anwser = '','null',anwsers_multi_choices.anwser) 
        as multi_anwser,anwsers_fill_in_blank.id as fill_id,
        if(anwsers_fill_in_blank.anwser is NULL or 
        anwsers_fill_in_blank.anwser = '','null',anwsers_fill_in_blank.anwser)
         as fill_anwser
        from study_to_question 
        join study on study_to_question.study_id = study.id
        join question on study_to_question.question_id = question.id
        join type on question.type_id = type.id
        left join anwsers_checkbox on anwsers_checkbox.question_id=question.id
        left join anwsers_multi_choices on anwsers_multi_choices.question_id=question.id
        left join anwsers_fill_in_blank  on anwsers_fill_in_blank .question_id=question.id
        where study.id=$studyid
        order by question.id, study.id;");


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

function getCompletedTypes()
{
    //this will test if there is a user with pass
    GLOBAL $dbObject;
    GLOBAL $toJsonString; 

    $dbObject->querySelect("select type.id,type.type,type_class.typeClass from type  
            inner join type_class on type.type_class_id = type_class.id
            where type_class.typeClass = 'Interviewer Response'");
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

function startCancelSurvey($queid,$userid,$startCancel)
{
    //this will test if there is a user with pass
    GLOBAL $dbObject;
    GLOBAL $toJsonString; 

    $dbObject->storedProcedures("
    call start_cancel_survey($queid,$userid,$startCancel)");

    if($dbObject->isDberror())
    {
        return '{"status":"error","results":"'.$dbObject->getDberror().'"}';
    }
    else
    {
        if($dbObject->get_affected_rows() > 0)
        {
            return '{"status":"good","results":"Survey Started or Cancelled"}';
        }
        else
        {
            //user does not exisist
            return '{"status":"good","results":"Could not start Survey"}';
        }
    }  
}

?>




