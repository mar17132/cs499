<?php
/*
*
*/

require_once 'api.db_connect.php';
require_once 'api.json_converter.php';



if(!empty($_POST))
{
    //'type'=>'user','return_results'=>'login','uname'=>'dav'
    $dbObject->setConnection();

    if(!$dbObject->isDberror())
    {
        if(strcmp($_POST["type"],'user') == 0)
        {
            switch($_POST['return_results'])
            {
                case 'login':
                    echo getUserLogin($_POST['uname'],$_POST['pass']);
                break;
                case 'all':
                    echo getAllUsers();
                break;    
            }
        }
        else
        {
            return '{"status":"good","results":"Bad type"}';
        }
    }
    else
    {
        echo $dbObject->getDberror();
    }
}





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

