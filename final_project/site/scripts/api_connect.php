<?php

require_once 'json.php';

class apiconnection
{
    private $myCurl = NULL;
    private $baseURL = "http://localhost/";
    private $page = NULL;
    private $myResults = NULL;
    private $parameters = array();

    public function __construct()
    {

    }

    public function __destruct()
    {

    }

    public function setPage($newPage)
    {
        $this->page = $newPage;
    }

    public function getPage()
    {
        return $this->page;
    }

    public function setParameters($newParam)
    {
        $this->parameters = $newParam;
    }

    public function getParameters()
    {
        return $this->parameters;
    }

    public function setParam($key,$val)
    {
        $this->parameters[$key] = $val;
    }

    public function connect_api()
    {
        $curlOptions = array(
            CURLOPT_URL => $this->baseURL . $this->page,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $this->parameters,
            CURLOPT_HEADER => false,
            CURLOPT_RETURNTRANSFER => true
        );

        $this->myCurl = curl_init(); 

        curl_setopt_array($this->myCurl,$curlOptions);

        $this->myResults = curl_exec($this->myCurl);

    }

    public function getResults()
    {
        if($this->myResults)
        {
            return $this->myResults;
        }
        else
        {
            return '{"status":"error","error","Failed to connect to the API"}';
        }
    }

}

/*$test = new apiconnection();
$test->setPage("final_project/api/scripts/api.call.php");
$test->setParameters(array('type'=>'user','return_results'=>'permissions',"userid"=>'5'));
$test->connect_api();

$theResults = $test->getResults();

//echo $theResults;

$jsonTophp->json_to_array($theResults);
$test2 = $jsonTophp->getjsonArray();

print_r($test2);

if(password_verify('Passw@rd99',$test2['rows'][0]['passwd']))
{
    print_r($test2);
}
else
{
    echo "this failed";
}*/


?>

