<?php


class php_to_json
{
    private $dbrowString = '';
    private $jsonvarsString = '';


    private function is_multi_array($newArray)
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

    private function array_to_json($arrayjson)
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
        $this->dbrowString = '"rows":[';

        if($this->is_multi_array($arrayConvert))
        {
            foreach($arrayConvert as $index => $dbrow)
            {
                $this->dbrowString .= '{';
                //$dbKeys = array_keys($dbrow);
            // $endKey = end(array_keys($dbrow));

                $this->dbrowString .= $this->array_to_json($dbrow);

                $this->dbrowString .= '}';

                if($index < (count($arrayConvert) - 1))
                {
                    $this->dbrowString .= ',';
                }
            }
        }
        else
        {
            $this->dbrowString .= '{';
            $this->dbrowString .= $this->array_to_json($arrayConvert);
            $this->dbrowString .= '}';
        }

        $this->dbrowString .= ']';
    }

    public function addJsonVars($jsonVarsArray)
    {
        $this->jsonvarsString = '"rows":[';

        if($this->is_multi_array($jsonVarsArray))
        {
            foreach($jsonVarsArray as $index => $dbrow)
            {
                $this->jsonvarsString .= '{';
                //$dbKeys = array_keys($dbrow);
            // $endKey = end(array_keys($dbrow));

                $this->jsonvarsString .= $this->array_to_json($dbrow);

                $this->jsonvarsString .= '}';

                if($index < (count($arrayConvert) - 1))
                {
                    $this->jsonvarsString .= ',';
                }
            }
        }
        else
        {
            $this->jsonvarsString .= '{';
            $this->jsonvarsString .= $this->array_to_json($jsonVarsArray);
            $this->jsonvarsString .= '}';
        }

        $this->jsonvarsString .= ']';
    }

    public function addOneJsonVar($var,$val)
    {
        $this->jsonvarsString .= '"'. $var . '":"' . $val . '"';
    }

    public function getJsonString()
    {
        $returnString = '';

        if(!empty($this->jsonvarsString))
        {
            $returnString  = '{' . $this->jsonvarsString . ',' . $this->dbrowString . '}';
        }
        elseif(!empty($this->dbrowString))
        {
            $returnString = '{' . $this->dbrowString . '}'; 
        }
        else
        {
            $returnString = false;
        }

        return $returnString;
    }
}


?>
