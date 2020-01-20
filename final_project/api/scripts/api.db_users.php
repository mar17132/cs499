<?php
/*
*
*/

require_once 'api.db_connect.php';


if(isset($_POST))
{
    
}


$dbObject->setConnection();

if(!$dbObject->isDberror())
{
    $dbObject->querySelect("select * from survey_users");
    if($dbObject->isDberror())
    {
        echo $dbObject->getDberror();
    }
    else
    {
        echo $dbObject->getSQLResults();
    }
}
else
{
    echo $dbObject->getDberror();
}


function getAllUsers()
{
    //This will get all users names
    //and type and permissions
}

function getUserPermission($myUser)
{
    //this will get one users permissions
}

function getUserLogin($myUser,$pass)
{
    //this will test if there is a user with pass
}





?>

