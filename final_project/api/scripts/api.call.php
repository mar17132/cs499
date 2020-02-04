<?php

require_once 'api.db_connect.php';
require_once 'api.json_converter.php';
require_once 'api.db_users.php';
require_once 'api.db_population.php';
require_once 'api.db_study.php';


if(!empty($_POST))
{
    //'type'=>'user','return_results'=>'login','uname'=>'dav'
    $dbObject->setConnection();

    if(!$dbObject->isDberror())
    {            
        switch($_POST['type'])
        {
            case 'user':
                usertype();
            break;
            case 'population':
                populationtype();
            break;
            case 'study':
                studytype();
            break; 
            default:
                echo '{"status":"good","results":"Bad type"}';
            break;
        }

    }
    else
    {
        echo $dbObject->getDberror();
    }
}
else
{
    echo '{"status":"good","results":"No post"}';
}




function usertype()
{
    switch($_POST['return_results'])
    {
        case 'login':
            echo getUserLogin($_POST['uname']);
        break;
        case 'all':
            echo getAllUsers();
        break;
        case 'permissions':
            echo getUserPermission($_POST['userid']);
        break;
        case 'permissionsUpdate':
            echo updateUserPermission($_POST['values']);
        break;
        case 'types':
            echo getUserTypes();
        break;
        case 'delete':
            echo deleteUser($_POST['uid'],$_POST['uname']);
        break;
        case 'update':
            echo updateUser($_POST['uid'],$_POST['uname'],
            $_POST['passwd'],$_POST['type_id']);
        break;
        case 'add':
            echo addUser($_POST['uname'],$_POST['passwd'],$_POST['type_id']);
        break;
        default:
            echo '{"status":"good","results":"Bad return type"}';
        break;     
    }
}


function populationtype()
{
    switch($_POST['return_results'])
    {
        case 'login':
            echo getUserLogin($_POST['uname'],$_POST['pass']);
        break;
        case 'all':
            echo getAllUsers();
        break;
        case 'permissions':
            echo getUserPermission($_POST['userid']);
        break;
        default:
            echo '{"status":"good","results":"Bad return"}';
        break;     
    }
}


function studytype()
{
    switch($_POST['return_results'])
    {
        case 'login':
            echo getUserLogin($_POST['uname'],$_POST['pass']);
        break;
        case 'all':
            echo getAllUsers();
        break;
        case 'permissions':
            echo getUserPermission($_POST['userid']);
        break;
        default:
            echo '{"status":"good","results":"Bad return"}';
        break;     
    }
}



?>

