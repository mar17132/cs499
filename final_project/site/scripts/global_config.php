<?php

$myURL = "http://" . $_SERVER['SERVER_NAME'] . "/final_project/site";
$myapiURL = "http://" . $_SERVER['SERVER_NAME'] . "/final_project/api/scripts/";
//$myURL = "https://" . $_SERVER['SERVER_NAME'];
//$myapiURL = "https://erawsoft.com/";

function get_array_key_last($arrayObj)
{
    $arraykeys = array_keys($arrayObj);
    $arrayIndex = (count($arraykeys) - 1);

    return $arraykeys[$arrayIndex];
}


?>
