<?php
/*
*
*/

require_once 'api.db_config.php';
require_once 'api.json_converter.php';


class mydbconnect
{
    private $uname = NULL;
    private $passwd = NULL;
    private $server = NULL;
    private $dbname = NULL;
    private $myConnect = NULL;
    private $dberror = NULL;
    private $selectResults = NULL;
    private $jsonConvert = NULL;

    public function __construct($name,$pass,$host,$database)
    {
        $this->uname = $name;
        $this->passwd = $pass;
        $this->$server = $host;
        $this->dbname = $database;
        $this->jsonConvert = new php_to_json();
    }

    public function __destruct()
    {
        $this->disconnect();
    }

    public function setUname($name)
    {
        $this->uname = $name;
    }

    public function setPasswd($pass)
    {
        $this->passwd = $pass;
    }

    public function setServer($host)
    {
        $this->server = $host;
    }

    public function setDbname($database)
    {
        $this->dbname = $database;
    }

    public function getUname()
    {
        return $this->uname;
    }

    public function getServer()
    {
        return $this->server;
    }

    public function getDbname()
    {
        return $this->dbname;
    }

    public function isDberror()
    {
        if(is_null($this->dberror))
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    public function getDberror()
    {
        return $this->dberror;
    }

    public function setConnection()
    {
        $this->dberror = NULL;
        if(!is_null($this->myConnect))
        {
            $this->myConnect = NULL;
        }
        
        $this->myConnect = 
        new mysqli($this->server,$this->uname,$this->passwd,$this->dbname);

        if($this->myConnect->connect_errno)
        {
           $this->dberror = "Cannot connect to database! " . $this->myConnect->connect_errno;
           exit(); 
        }

    }

    public function disconnect()
    {
        $this->dberror = NULL;
        $this->myConnect = NULL;
    }

    public function queryUpdate($sql)
    {
        $this->dberror = NULL;
        if(!is_null($this->myConnect))
        {
            if(!($this->myConnect->query($sql) === TRUE))
            {
                $this->dberror = "Not able to update! " . $this->myConnect->error;
            }
        }
        else
        {
            $this->dberror = "Database Connection is not set.";
            exit();
        }

    }

    public function querySelect($sql)
    {
        $this->dberror = NULL;
        if(!is_null($this->myConnect))
        {

            if($result = $this->myConnect->query($sql))
            {
                $mysqlArray = array();
                while($row = $result->fetch_assoc())
                {
                    $mysqlArray[] = $row;
                }

                //$this->jsonConvert->jsonEncode($mysqlArray);
                //$this->selectResults = $this->jsonConvert->getJsonString();
                $this->selectResults = $mysqlArray;
            }
            else
            {
                $this->dberror = "Not able to select! " . $this->myConnect->error;
            }
        }
        else
        {
            $this->dberror = "Database Connection is not set.";
            exit();
        }

    }

    public function queryInsert($sql)
    {
        $this->dberror = NULL;
        if(!is_null($this->myConnect))
        {
            if(!($this->myConnect->query($sql) === TRUE))
            {
                $this->dberror = "Not able to insert! " . $this->myConnect->error;
            }
        }
        else
        {
            $this->dberror = "Database Connection is not set.";
            exit();
        }

    }

    public function queryDelete($sql)
    {
        $this->dberror = NULL;
        if(!is_null($this->myConnect))
        {
            if(!($this->myConnect->query($sql) === TRUE))
            {
                $this->dberror = "Not able to delete! " . $this->myConnect->error;
            }
        }
        else
        {
            $this->dberror = "Database Connection is not set.";
            exit();
        }

    }

    public function getQuery()
    {
        return $this->myConnect;
    }

    public function getSQLResults()
    {
        $returnString = "";

        if($this->isDberror())
        {
            $returnString = '{"status":"error","error":'. $this->getDberror() . '}';
        }
        return $this->selectResults;
    }

    
}


//create db object
$dbObject = new mydbconnect($username,$password,$server,$database);


?>

