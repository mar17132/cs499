<?php

$testArray = array(array('bob' => 'manager','fruit' => 'apple'),array('dav' => 'no','dick' => 'harry'));

function is_multi_array($newArray)
{
    if(is_array($newArray))
    {
        foreach($newArray as $row)
        {
            if(!is_array($row))
            {
                return false;
            }
        }

        return true;
    }
    else
    {
        return false;
    }
}

function array_to_json($arrayjson)
{
    $jsonString = '';

    $endKey = end(array_keys($arrayjson));

    while(list($key,$val) = each($arrayjson))
    {
        $jsonString .= '"'.$key.'"'.':'.'"'.$val.'"';

        if(strcmp($endKey,$key) != 0)
        {
            $jsonString .= ',';
        }
    }

    return $jsonString;
}

function jsonEncode($arrayConvert)
{
    $jsonString = '{"rows":[';

    if(is_multi_array($arrayConvert))
    {
        foreach($arrayConvert as $index => $dbrow)
        {
            $jsonString .= '{';
            //$dbKeys = array_keys($dbrow);
           // $endKey = end(array_keys($dbrow));

            $jsonString .= array_to_json($dbrow);

            $jsonString .= '}';

            if($index < (count($arrayConvert) - 1))
            {
                $jsonString .= ',';
            }
        }
    }
    else
    {
        $jsonString .= '{';
        $jsonString .= array_to_json($arrayConvert);
        $jsonString .= '}';
    }

    return $jsonString . ']}';
}

echo jsonEncode($testArray);

print_r(json_decode('{"rows":[{"bob":"manager","fruit":"apple"},{"dav":"no","dick":"harry"}]}'));

?>
