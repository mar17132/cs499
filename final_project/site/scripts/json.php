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

    public function getdbrowString()
    {
        return $this->dbrowString;
    }

    public function clearVars()
    {
        $this->dbrowString = '';
        $this->jsonvarsString = '';
    }
}

$phpToString = new php_to_json();




class json_to_php
{
    private $jsonArray = array();
    private $jsonString = NULL;

    public function json_to_array($jstring)
    {
        $arrayString = explode('"',trim($jstring)); 

        $newkey = NULL;
        $newVal = NULL;
        $newArraykey = NULL;
        $newArrayVal = NULL;
        $isArray = false;
        $newArray = array();
        $haystack = array("{",":","}","}]","[{","}]}",",",":[{",",","{ ");
        $arrayEndHaystack = array("}]","}]}","},","}, {","},{");    

        foreach($arrayString as $jsonVar)
        {    
            $jsonVar = trim($jsonVar);
            $jsonVar = rtrim($jsonVar);
           // $jsonVar = str_replace(array("\n\r", "\n", "\r"," ","\t"), "", $jsonVar);

            if($newkey == NULL && !$isArray)
            {
                if(!in_array($jsonVar,$haystack) && similar_text($jsonVar, "{") == 0)
                {
                    $newkey = $jsonVar;
                }

            }
            elseif($newVal == NULL && !$isArray)
            {
                
                if(!in_array($jsonVar,$haystack))
                {
                    $newVal = $jsonVar;
                }
                elseif(strcmp($jsonVar,":[{") == 0)
                {
                    $isArray = true;
                }
            }
            elseif($isArray)
            {
                if(in_array($jsonVar,$arrayEndHaystack))
                {                   
                    $this->addArray($newkey,$newArray);

                    if(strcmp($jsonVar,"},{") == 0)
                    {
                        
                        $newArrayVal= NULL;
                        $newArraykey = NULL;
                        $newArray = NULL; 
                    }
                    else
                    {
                        $newkey = NULL;
                        $newVal = NULL;                        
                        $newArrayVal= NULL;
                        $newArraykey = NULL;
                        $newArray = NULL; 

                        $isArray = false;
                    }    
                }
                elseif(!in_array($jsonVar,$haystack))
                {
                    
                    if($newArraykey == NULL)
                    {           
                        $newArraykey = $jsonVar;                            
                    }
                    elseif($newArrayVal == NULL)
                    {
                        $newArrayVal = $jsonVar;
                    }
                                        
                    if($newArrayVal != NULL && $newArraykey != NULL)
                    {
                        $newArray[$newArraykey] = $newArrayVal;
                        $newArrayVal = NULL;
                        $newArraykey = NULL;
                    }                    
                }
            }           
            else
            {
                if($isArray)
                {
                    $this->addArray($newkey,$newValArray);
                    $newkey = NULL;
                    $newVal = NULL;
                }
                else
                {
                    $this->addOneVar($newkey,$newVal);
                    $newkey = NULL;
                    $newVal = NULL;
                }

            }

        }

    }

    public function addArray($key,$val_array)
    {

        $this->jsonArray[$key][] = $val_array;
    }

    public function addOneVar($key,$val)
    {
        $this->jsonArray[$key] = $val;
    }

    public function getjsonArray()
    {
        return $this->jsonArray;
    }

    public function clearVars()
    {
        $this->jsonArray = NULL;
        $this->jsonString = NULL;
        $this->jsonArray = array();
    }

}

$jsonTophp = new json_to_php();

?>


