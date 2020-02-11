
<?php
/*
*
*/

require_once 'api.db_connect.php';
require_once 'api.json_converter.php';


function getAllPop()
{
    //This will get all users names
    //and type 

        GLOBAL $dbObject;
        GLOBAL $toJsonString; 
    
        $dbObject->querySelect("select id,
        concat('<span class=\'fname\'>',fname,'</span>',
        if(mname,concat(' <span class=\'mname\'>',mname,'</span> '),' '),
        '<span class=\'lname\'>',lname,'</span>') as name, 
        concat('<span class=\'street\'>',street,'</span>',
        if(apt,concat(' <span class=\'apt\'>','#',apt,'</span>'),' '), 
        '<span class=\'city\'>',city,'</span>, <span class=\'state\'>',
        state, '</span> <span class=\'zip\'> ', zip,'</span>') as address, 
        phone from survey_population;");
        if($dbObject->isDberror())
        {
            return $dbObject->getDberror();
        }
        else
        {
            if(count($dbObject->getSQLResults()) > 0)
            {
                //user exisit
                $toJsonString->jsonEncode($dbObject->getSQLResults());
                
                return '{"status":"good","results":"true",'. $toJsonString->getdbrowString() . '}';
            }
            else
            {
                //user does not exisist
                return '{"status":"good","results":"false"}';
            }
        }    
}

function getAllGroups()
{
    //This will get all users names
    //and type 

        GLOBAL $dbObject;
        GLOBAL $toJsonString; 
    
        $dbObject->querySelect("select * from sample_groups;");
        if($dbObject->isDberror())
        {
            return $dbObject->getDberror();
        }
        else
        {
            if(count($dbObject->getSQLResults()) > 0)
            {
                //user exisit
                $toJsonString->jsonEncode($dbObject->getSQLResults());
                
                return '{"status":"good","results":"true",'. $toJsonString->getdbrowString() . '}';
            }
            else
            {
                //user does not exisist
                return '{"status":"good","results":"false"}';
            }
        }    
}

function getPopGroups($popid)
{
    //This will get all users names
    //and type 

        GLOBAL $dbObject;
        GLOBAL $toJsonString; 
    
        $dbObject->querySelect("select sample_group_id 
                    from surveyp_to_sampleg where survey_population_id='$popid'");
        if($dbObject->isDberror())
        {
            return $dbObject->getDberror();
        }
        else
        {
            if(count($dbObject->getSQLResults()) > 0)
            {
                //user exisit
                $toJsonString->jsonEncode($dbObject->getSQLResults());
                
                return '{"status":"good","results":"true",'. $toJsonString->getdbrowString() . '}';
            }
            else
            {
                //user does not exisist
                return '{"status":"good","results":"false"}';
            }
        }    
}

function deletePop($popid)
{
    //this will test if there is a user with pass
    GLOBAL $dbObject;
    GLOBAL $toJsonString; 

    $dbObject->queryDelete("delete from survey_population
            where id='$popid'");
    if($dbObject->isDberror())
    {
        return '{"status":"error","results":"'.$dbObject->getDberror().'"}';
    }
    else
    {
        if($dbObject->get_affected_rows() > 0)
        {
            return '{"status":"good","results":"The population person was deleted!"}';
        }
        else
        {
            //user does not exisist
            return '{"status":"error","results":"No records to delete."}';
        }
    }  
}


function updatePop($callArray)
{
    //this will test if there is a user with pass
    GLOBAL $dbObject;
    GLOBAL $toJsonString; 
    $popid = $callArray['id'];
    $endKey = array_key_last($callArray);
    $added = false;
    $queryString = "update survey_population set ";

    foreach($callArray as $key => $value)
    {
        if($key != 'type' && $key != 'return_results' && $key != 'id')
        {
            if($value != null || trim($value) != "")
            {
                $queryString .= $key ."='" . $value . "'";
                $added = true;
            }

            if($key != $endKey && $added)
            {
                $queryString .= ",";
                $added = false;
            }
        }
    }

    $dbObject->queryUpdate("$queryString where id='$popid'");
    if($dbObject->isDberror())
    {
        return '{"status":"error","results":"'.$dbObject->getDberror().'",
        "query":"'.$queryString.'"}';
    }
    else
    {
        if($dbObject->get_affected_rows() > 0)
        {
            return '{"status":"good","results":"The population person was Updated!"}';
        }
        else
        {
            //user does not exisist
            return '{"status":"error","results":"No records to update."}';
        }
    }  
}

function addPop($uname,$pass,$type)
{
    //this will test if there is a user with pass
    GLOBAL $dbObject;
    GLOBAL $toJsonString; 

    $dbObject->queryInsert("insert into survey_users(uname,passwd,type_id)
    values('$uname','".password_hash($pass,PASSWORD_DEFAULT)."','$type')");
    if($dbObject->isDberror())
    {
        return '{"status":"error","results":"'.$dbObject->getDberror().'",
        "query":"'.$queryString.'"}';
    }
    else
    {
        if($dbObject->get_affected_rows() > 0)
        {
            return '{"status":"good","results":"The user was Added!"}';
        }
        else
        {
            //user does not exisist
            return '{"status":"error","results":"No user was not Added."}';
        }
    }  
}

function updatePopGroups($permisArray)
{
    //this will get one users permissions
    GLOBAL $dbObject;
    GLOBAL $toJsonString;   

    $updateArray = (array) $permisArray;
    $queryString = "";
    
    foreach($updateArray as $permis)
    {   
        $explodeArray = explode(",",$permis);
        $queryString .="update interviewer_permissions set allowed_permission='";
        $queryString .= $explodeArray[2]."' where survey_users_id='";
        $queryString .= $explodeArray[0]."' and study_id ='";
        $queryString .= $explodeArray[1]."';";
    }

    $dbObject->queryUpdateMult($queryString);

    if($dbObject->isDberror())
    {
        return $dbObject->getDberror();
    }
    else
    { 
        return '{"status":"good","results":"The user permissions have been updated"}';
    }  

}




?>

