
<?php
/*
*
*/

require_once 'api.db_connect.php';
require_once 'api.json_converter.php';


function getAllStudy()
{
    //This will get all users names
    //and type 

        GLOBAL $dbObject;
        GLOBAL $toJsonString; 
    
        $dbObject->querySelect("select study.id,study.name,
        study.order_questions,date(study.start_date) as start,
        date(study.end_date) as end,
        study.try_amount, type.type as typename 
        from study join type on study.type_id = type.id");
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

function getAllStudyGroups($studyid)
{
    //This will get all users names
    //and type 

        GLOBAL $dbObject;
        GLOBAL $toJsonString; 
    
        $dbObject->querySelect("select sgroup.sample_name,
        concat(pop.fname,' ',pop.lname) as name
        from study_to_survey_pop
        join sample_group sgroup on 
        sgroup.id = study_to_survey_pop.sample_group_id
        join survey_population pop on 
        study_to_survey_pop.survey_population_id = pop.id
        join study on study_to_survey_pop.study_id = study.id
        where study.id='1'");
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

function deleteStudy($groupid)
{
    //this will test if there is a user with pass
    GLOBAL $dbObject;
    GLOBAL $toJsonString; 

    $dbObject->queryDelete("delete from sample_group where id='$groupid'");
    if($dbObject->isDberror())
    {
        return '{"status":"error","results":"'.$dbObject->getDberror().'"}';
    }
    else
    {
        if($dbObject->get_affected_rows() > 0)
        {
            return '{"status":"good","results":"The group was deleted!"}';
        }
        else
        {
            //user does not exisist
            return '{"status":"error","results":"No records to delete."}';
        }
    }  
}

function updateStudy($callArray)
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

function addStudy($callArray)
{
    //this will test if there is a user with pass
    GLOBAL $dbObject;
    GLOBAL $toJsonString; 

   
    $endKey = array_key_last($callArray);
    $added = false;
    $queryString = "";
    $keycol = "";

    foreach($callArray as $key => $value)
    {
        if($key != 'type' && $key != 'return_results' && $key != 'id')
        {
            if($value != null || trim($value) != "")
            {
                $queryString .= "'$value'";
                $keycol .= $key;
                $added = true;
            }

            if($key != $endKey && $added)
            {
                $queryString .= ",";
                $keycol .= ",";
                $added = false;
            }
        }
    }

    $dbObject->queryInsert("insert into survey_population($keycol)
    values($queryString)");

    if($dbObject->isDberror())
    {
        return '{"status":"error","results":"'.$dbObject->getDberror().'",
        "query":"'.$queryString.'"}';
    }
    else
    {
        if($dbObject->get_affected_rows() > 0)
        {
            return '{"status":"good","results":"The population person was Added!"}';
        }
        else
        {
            //user does not exisist
            return '{"status":"error","results":"No person was Added."}';
        }
    }  
}





?>

