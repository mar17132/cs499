
<?php
/*
*
*/

require_once 'api.db_connect.php';
require_once 'api.json_converter.php';



function getsystemcount()
{
    //this will test if there is a user with pass
    GLOBAL $dbObject;
    GLOBAL $toJsonString; 

    $dbObject->storedProcedures("call system_count()");

    if($dbObject->isDberror())
    {
        return '{"status":"error","results":"'.$dbObject->getDberror().'"}';
    }
    else
    {
        if($dbObject->get_affected_rows() > 0)
        {
            $toJsonString->jsonEncode($dbObject->getSQLResults());

            return '{"status":"good","results":"refresh",'.
                    $toJsonString->getdbrowString() .'}';
        }
        else
        {
            //user does not exisist
            return '{"status":"good","results":"Could not get system stats"}';
        }
    }  
}


function getstudystats()
{
    //this will test if there is a user with pass
    GLOBAL $dbObject;
    GLOBAL $toJsonString; 

    $dbObject->storedProcedures("call study_stats()");

    if($dbObject->isDberror())
    {
        return '{"status":"error","results":"'.$dbObject->getDberror().'"}';
    }
    else
    {
        if($dbObject->get_affected_rows() > 0)
        {
            $toJsonString->jsonEncode($dbObject->getSQLResults());

            return '{"status":"good","results":"refresh",'.
                    $toJsonString->getdbrowString() .'}';
        }
        else
        {
            //user does not exisist
            return '{"status":"good","results":"Could not get study stats"}';
        }
    }  
}

function getquestionstats($studyid,$questionid)
{
    //this will test if there is a user with pass
    GLOBAL $dbObject;
    GLOBAL $toJsonString; 

    $dbObject->storedProcedures("call question_stats($studyid,$questionid)");

    if($dbObject->isDberror())
    {
        return '{"status":"error","results":"'.$dbObject->getDberror().'"}';
    }
    else
    {
        if($dbObject->get_affected_rows() > 0)
        {
            $toJsonString->jsonEncode($dbObject->getSQLResults());

            return '{"status":"good","results":"refresh",'.
                    $toJsonString->getdbrowString() .'}';
        }
        else
        {
            //user does not exisist
            return '{"status":"good","results":"Could not get question stats"}';
        }
    }  
}

function getquestionselect($studyid)
{
    //this will test if there is a user with pass
    GLOBAL $dbObject;
    GLOBAL $toJsonString; 

    $dbObject->querySelect("select question.id,question.question
    from question join study_to_question on 
    study_to_question.question_id=question.id
    where study_to_question.study_id=$studyid");

    if($dbObject->isDberror())
    {
        return '{"status":"error","results":"'.$dbObject->getDberror().'"}';
    }
    else
    {
        if($dbObject->get_affected_rows() > 0)
        {
            $toJsonString->jsonEncode($dbObject->getSQLResults());

            return '{"status":"good","results":"refresh",'.
                    $toJsonString->getdbrowString() .'}';
        }
        else
        {
            //user does not exisist
            return '{"status":"good","results":"Could not get question stats"}';
        }
    }  
}


?>




