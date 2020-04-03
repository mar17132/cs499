<?php 
require_once 'global_config.php';
require_once 'sessions.php';
require_once 'api_connect.php'; 
require_once 'json.php';
?>

<?php

function javascript_to_apiQuery($postArray)
{
    GLOBAL $jsonTophp;
    GLOBAL $myapiURL;

    $dbconnections = new apiconnection();
    $dbconnections->setPage($myapiURL."api.call.php");
    $dbconnections->setParameters($postArray);
    $dbconnections->connect_api();

    return $dbconnections->getResults();
}

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    echo javascript_to_apiQuery($_POST);
}



?>
