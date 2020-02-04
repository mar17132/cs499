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

function getUserLogin($myUser)
{
    //this will test if there is a user with pass
    GLOBAL $dbObject;
    GLOBAL $toJsonString; 

    $dbObject->querySelect("select users.id, users.uname, users.passwd, type.type
                            from survey_users as users 
                            INNER JOIN type ON users.type_id = type.id
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

function getUserTypes()
{
    //this will test if there is a user with pass
    GLOBAL $dbObject;
    GLOBAL $toJsonString; 

    $dbObject->querySelect("select type.id,type.type,type_class.typeClass from type  
            inner join type_class on type.type_class_id = type_class.id
            where type_class.typeClass = 'Users'");
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


function deleteUser($uid,$uname)
{
    //this will test if there is a user with pass
    GLOBAL $dbObject;
    GLOBAL $toJsonString; 

    $dbObject->queryDelete("delete from survey_users
            where uname = '$uname' and id = '$uid'");
    if($dbObject->isDberror())
    {
        return '{"status":"error","results":"'.$dbObject->getDberror().'"}';
    }
    else
    {
        if($dbObject->get_affected_rows() > 0)
        {
            return '{"status":"good","results":"The user was deleted!"}';
        }
        else
        {
            //user does not exisist
            return '{"status":"error","results":"No records to delete."}';
        }
    }  
}


function updateUser($uid,$uname,$pass,$type)
{
    //this will test if there is a user with pass
    GLOBAL $dbObject;
    GLOBAL $toJsonString; 
    $queryString = "update survey_users set ";

    if($uname != null || $uname != "")
    {
        $queryString .= "uname='". $uname . "',";
    }

    if($pass != null || $pass != "")
    {
        $queryString .= "passwd='". password_hash($pass,PASSWORD_DEFAULT) . "',";
    }

    if($type != null || $type != "")
    {
        $queryString .= "type_id='". $type . "' ";
    }


    $dbObject->queryUpdate("$queryString where id='$uid'");
    if($dbObject->isDberror())
    {
        return '{"status":"error","results":"'.$dbObject->getDberror().'",
        "query":"'.$queryString.'"}';
    }
    else
    {
        if($dbObject->get_affected_rows() > 0)
        {
            return '{"status":"good","results":"The user was Updated!"}';
        }
        else
        {
            //user does not exisist
            return '{"status":"error","results":"No records to update."}';
        }
    }  
}

function addUser($uname,$pass,$type)
{
    //this will test if there is a user with pass
    GLOBAL $dbObject;
    GLOBAL $toJsonString; 

    $dbObject->queryInsert("insert into survey_users(uname,passwd,type_id)
    values('$uname','".password_hash($pass,PASSWORD_DEFAULT)."','$type')");
    if($dbObject->isDberror())
    {
        return '{"status":"error","results":"'.$dbObject->getDberror().'",
        "query":"'.$queryString.'"}';
    }
    else
    {
        if($dbObject->get_affected_rows() > 0)
        {
            return '{"status":"good","results":"The user was Added!"}';
        }
        else
        {
            //user does not exisist
            return '{"status":"error","results":"No user was not Added."}';
        }
    }  
}

function updateUserPermission($permisArray)
{
    //this will get one users permissions
    GLOBAL $dbObject;
    GLOBAL $toJsonString;   

    $updateArray = (array) $permisArray;
    $queryString = "";
    
    foreach($updateArray as $permis)
    {   
        $explodeArray = explode(",",$permis);
        $queryString .="update interviewer_permissions set allowed_permission='";
        $queryString .= $explodeArray[2]."' where survey_users_id='";
        $queryString .= $explodeArray[0]."' and study_id ='";
        $queryString .= $explodeArray[1]."';";
    }

    $dbObject->queryUpdateMult($queryString);

    if($dbObject->isDberror())
    {
        return $dbObject->getDberror();
    }
    else
    { 
        return '{"status":"good","results":"The user permissions have been updated"}';
    }  

}



?>

