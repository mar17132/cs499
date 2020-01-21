<?php
/*
*
*/

require_once 'api.db_connect.php';
require_once 'api.json_converter.php';



function getAllUsers()
{
    //This will get all users names
    //and type 

        GLOBAL $dbObject;
        GLOBAL $toJsonString; 
    
        $dbObject->querySelect("select user.id,user.uname,type.type
                                from survey_users as user 
                                INNER JOIN type on user.type_id = type.id");
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

function getUserPermission($userID)
{
    //this will get one users permissions
    GLOBAL $dbObject;
    GLOBAL $toJsonString; 

    $dbObject->querySelect("SELECT myuser.id AS user_id,myuser.uname,type.type,
    study.id AS study_id,study.name AS study, 
    interviewer_permissions.allowed_permission AS permission
    FROM interviewer_permissions
    INNER JOIN study ON interviewer_permissions.study_id = study.id
    INNER JOIN survey_users AS myuser ON interviewer_permissions.survey_users_id = myuser.id
    INNER JOIN type ON myuser.type_id = type.id
    WHERE interviewer_permissions.survey_users_id = '$userID'");

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

function getUserLogin($myUser,$pass)
{
    //this will test if there is a user with pass
    GLOBAL $dbObject;
    GLOBAL $toJsonString; 

    $dbObject->querySelect("select * from survey_users 
                             where uname = '$myUser'");
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





?>

