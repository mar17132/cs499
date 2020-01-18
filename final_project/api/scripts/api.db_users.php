<?php
/*
*
*/

require_once 'api.db_connect.php';


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




?>

