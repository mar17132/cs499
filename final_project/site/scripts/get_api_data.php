<?php 
require_once 'global_config.php';
require_once 'sessions.php';
require_once 'api_connect.php'; 
require_once 'json.php';
?>

<?php

function javascript_to_apiQuery($postParams)
{
    GLOBAL $jsonTophp;
    GLOBAL $myapiURL;

    $dbconnections = new apiconnection();
    $dbconnections->setPage($myapiURL."api.call.php");
    $dbconnections->setParameters($postParams);
    $dbconnections->connect_api();

    return $dbconnections->getResults();
}

function paramString($key,$value)
{
    if(gettype($value) != "array")
    {
        return trim($key)."=". trim($value);
    }
    else
    {
        $newString = "";
        $lastValueKey = get_array_key_last($value);

        foreach($value as $valueKey => $valueValue)
        {
            $newString .= trim($key) . "[" . trim($valueKey) . "]=";
            $newString .= trim($valueValue);

            if($valueKey != $lastValueKey)
            {
                $newString .= "&";
            }
        }

        return $newString;
    }
}

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $sendstring = "";
    $lastKey = get_array_key_last($_POST);

    foreach($_POST as $key => $value)
    {
        $sendstring .= paramString($key,$value);

        if($key != $lastKey)
        {
            $sendstring .= "&";
        }
    }

  
    echo javascript_to_apiQuery($sendstring);
}



?>
