
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

function getStudyTypes()
{
    //this will test if there is a user with pass
    GLOBAL $dbObject;
    GLOBAL $toJsonString; 

    $dbObject->querySelect("select type.id,type.type,type_class.typeClass from type  
            inner join type_class on type.type_class_id = type_class.id
            where type_class.typeClass = 'Study'");
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

function getQuestionTypes()
{
    //this will test if there is a user with pass
    GLOBAL $dbObject;
    GLOBAL $toJsonString; 

    $dbObject->querySelect("select type.id,type.type,type_class.typeClass from type  
            inner join type_class on type.type_class_id = type_class.id
            where type_class.typeClass = 'Question'");
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
        concat(pop.fname,' ',pop.lname) as name, sgroup.id as groupid,
        study.id as studyid
        from study_to_survey_pop
        join sample_group sgroup on 
        sgroup.id = study_to_survey_pop.sample_group_id
        join survey_population pop on 
        study_to_survey_pop.survey_population_id = pop.id
        join study on study_to_survey_pop.study_id = study.id
        where study.id='$studyid'");

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

function allstudyQuestions($studyid)
{
    //This will get all users names
    //and type 

        GLOBAL $dbObject;
        GLOBAL $toJsonString; 

        $dbObject->querySelect("select study.id as studyid,
        question.id as questionid, question.question
        from study
        join study_to_question on study_to_question.study_id = study.id
        join question on study_to_question.question_id = question.id
        where study.id = '$studyid'
        order by question.id ASC");

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
                return '{"status":"good","results":"false","query":"select study.id as studyid,
                    question.id as questionid, question.question
                    from study
                    join study_to_question on study_to_question.study_id = study.id
                    join question on study_to_question.question_id = question.id
                    where study.id = '.$studyid.'
                    order by question.id ASC"}';
            }
        }    
}

function getQuestion($studyid,$questionid)
{
    //This will get all users names
    //and type 

        GLOBAL $dbObject;
        GLOBAL $toJsonString; 

        $answerT = "";

        $dbObject->querySelect("select type_id from question where id='$questionid'");

        $typeid = $dbObject->getSQLResults();

        if($typeid)
        {

            switch($typeid[0]['type_id'])
            {
                case '9':
                    $answerT = "anwsers_checkbox";
                break;
                case '10':
                    $answerT = "anwsers_fill_in_blank";
                break;
                case '11':
                    $answerT = "anwsers_multi_choices";
                break;
            }

            $dbObject->querySelect("
                select study.id as studyid, 
            question.id as questionid,
            question.question, question.question_order as qorder,
            question.order_Anwsers as isanwsers_order, question.type_id as qtype,
            anwser.id as anwserid, anwser.qorder as aorder, anwser.anwser
            from question
            join study_to_question on study_to_question.question_id = question.id
            join study on study_to_question.study_id = study.id
            join $answerT anwser on anwser.question_id = question.id 
            where study.id='$studyid' and question.id='$questionid'");

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
        else
        {
            //user does not exisist
            return '{"status":"error","results":"No type id","error":'.$dbObject->isDberror().'}';
        }   
}

function addquestion($questionArray)
{
    //This will get all users names
    //and type 

        GLOBAL $dbObject;
        GLOBAL $toJsonString; 

        $answerT = "";
        $answerQuery = "";
        $typeid = $questionArray['typeid'];
        $studyid = $questionArray['studyid'];
        $questionid = null;

        $dbObject->queryInsert("insert into question(question,order_Anwsers,
        question_order,type_id) values('".$questionArray['question']."',".
        $questionArray['qaorder'].",".$questionArray['qorder'].",".
        $questionArray['typeid'].")");

        if($dbObject->isDberror())
        {
            return $dbObject->getDberror();
        }
        else
        {

            switch($typeid)
            {
                case '9':
                    $answerT = "anwsers_checkbox";
                break;
                case '10':
                    $answerT = "anwsers_fill_in_blank";
                break;
                case '11':
                    $answerT = "anwsers_multi_choices";
                break;
            }

            $dbObject->querySelect("SELECT id FROM question where 
            question='".$questionArray['question']."'");
            $questionid = $dbObject->getSQLResults();

            if($questionid && !$dbObject->isDberror())
            {
                $dbObject->queryInsert("insert into study_to_question(question_id,
                study_id) values(".$questionid[0]['id'].",".$studyid.")");

                $lastKey = count($questionArray['values']);
                $countloop = 0;

                foreach($questionArray['values'] as $value)
                {   
                    if($typeid == '11' || $typeid == '10')
                    {
                        $explodArray = explode(",",$value);
                        $answerQuery .= "insert into $answerT (question_id,qorder,";
                        $answerQuery .= "anwser) values(".$questionid[0]['id'].",";
                        $answerQuery .= $explodArray[1].",'".$explodArray[0]."')";
                    }
                    else if ($typeid == '9')
                    {
                        $answerQuery .= "insert into $answerT (question_id,";
                        $answerQuery .= "anwser) values(".$questionid[0]['id'].",'";
                        $answerQuery .= $value."')";
                    }

                    if(($countloop + 1) != $lastKey)
                    {
                        $answerQuery .= ";";
                    }

                    $countloop++;
                }

                $dbObject->queryUpdateMult($answerQuery);    

                if($dbObject->isDberror())
                {
                    return $dbObject->getDberror();
                }
                else
                {
                    if($dbObject->get_affected_rows() > 0)
                    {                    
                        return '{"status":"good","results":"The question was added"}';
                    }
                    else
                    {
                        //user does not exisist
                        return '{"status":"good","results":"The question was not added"}';
                    }
                } 
            }
            else
            {
                return "{'status':'error','results':'No question id'}";
            }
        }
}

function updatequestion($questionArray)
{
    //This will get all users names
    //and type 

        GLOBAL $dbObject;
        GLOBAL $toJsonString; 

        $answerT = "";
        $answerQuery = "";
        $typeid = $questionArray['typeid'];
        $studyid = $questionArray['studyid'];
        $questionid = $questionArray['questionid'];

        $dbObject->queryUpdate("update question set question='"
        .$questionArray['question']."',order_Anwsers=".
        $questionArray['qaorder'].",question_order=".$questionArray['qorder'].
        ",type_id=".$questionArray['typeid']." where id='".$questionid."'");

        if($dbObject->isDberror())
        {
            return $dbObject->getDberror();
        }
        else
        {

            switch($typeid)
            {
                case '9':
                    $answerT = "anwsers_checkbox";
                break;
                case '10':
                    $answerT = "anwsers_fill_in_blank";
                break;
                case '11':
                    $answerT = "anwsers_multi_choices";
                break;
            }

            if(isset($questionid))
            {

                $lastKey = count($questionArray['values']);
                $countloop = 0;

                foreach($questionArray['values'] as $value)
                {   
                    $explodArray = explode(",",$value);

                    if($typeid == '11' || $typeid == '10')
                    {
                        if($explodArray[count($explodArray) -1 ] != 'null')
                        {
                            $answerQuery .= "update $answerT set question_id=";
                            $answerQuery .= "$questionid,qorder=";
                            $answerQuery .= $explodArray[1].",anwser='".$explodArray[0]."'";
                            $answerQuery .= "where id='".$explodArray[2]."'";
                        }
                        else
                        {
                            $answerQuery .= "insert into $answerT (question_id,qorder,";
                            $answerQuery .= "anwser) values(".$questionid.",";
                            $answerQuery .= $explodArray[1].",'".$explodArray[0]."')";
                        }
                    }
                    else if ($typeid == '9')
                    {
                        if($explodArray[count($explodArray) -1 ] != 'null')
                        {
                            $answerQuery .= "update $answerT question_id=";
                            $answerQuery .= $questionid.",anwser='";
                            $answerQuery .= $explodArray[0]."' where id=".$explodArray[1]."'";
                        }
                        else
                        {
                            $answerQuery .= "insert into $answerT (question_id,";
                            $answerQuery .= "anwser) values(".$questionid.",'";
                            $answerQuery .= $$explodArray[0]."')";
                        }
                    }

                    if(($countloop + 1) != $lastKey)
                    {
                        $answerQuery .= ";";
                    }

                    $countloop++;
                }

                $dbObject->queryUpdateMult($answerQuery);    

                if($dbObject->isDberror())
                {
                    return $dbObject->getDberror();
                }
                else
                {                   
                    return '{"status":"good","results":"The question was updated"}';
                } 
            }
            else
            {
                return "{'status':'error','results':'No question id'}";
            }
        }
}

function removeanwser($answerid,$questiontype)
{
    //This will get all users names
    //and type 

        GLOBAL $dbObject;
        GLOBAL $toJsonString; 

        $answerT = "";

        if($questiontype)
        {

            switch($questiontype)
            {
                case '9':
                    $answerT = "anwsers_checkbox";
                break;
                case '10':
                    $answerT = "anwsers_fill_in_blank";
                break;
                case '11':
                    $answerT = "anwsers_multi_choices";
                break;
            }

            $dbObject->queryDelete("delete from $answerT where id='$answerid'");

            if($dbObject->isDberror())
            {
                return $dbObject->getDberror();
            }
            else
            {
                if($dbObject->get_affected_rows() > 0)
                {
                    return '{"status":"good","results":"nothing","messeage":"The answer was removed"}';
                }
                else
                {
                    //user does not exisist
                    return '{"status":"good","results":"No records found."}';
                }
            } 
        }
        else
        {
            //user does not exisist
            return '{"status":"error","results":"No type id","error":'.$dbObject->isDberror().'}';
        }   
}

function deleteStudy($studyid)
{
    //this will test if there is a user with pass
    GLOBAL $dbObject;
    GLOBAL $toJsonString; 

    $dbObject->queryDelete("delete from study where id='$studyid'");
    if($dbObject->isDberror())
    {
        return '{"status":"error","results":"'.$dbObject->getDberror().'"}';
    }
    else
    {
        if($dbObject->get_affected_rows() > 0)
        {
            return '{"status":"good","results":"The study was deleted!"}';
        }
        else
        {
            //user does not exisist
            return '{"status":"error","results":"No records to delete."}';
        }
    }  
}

function removegroup($groupid,$studyid)
{
    //this will test if there is a user with pass
    GLOBAL $dbObject;
    GLOBAL $toJsonString; 

    $dbObject->queryDelete("delete from study_to_survey_pop where 
    sample_group_id='$groupid' and study_id='$studyid'");

    if($dbObject->isDberror())
    {
        return '{"status":"error","results":"'.$dbObject->getDberror().'"}';
    }
    else
    {
        if($dbObject->get_affected_rows() > 0)
        {
            return '{"status":"good","results":"The Group was removed!"}';
        }
        else
        {
            //user does not exisist
            return '{"status":"error","results":"No records to remove."}';
        }
    }  
}

function deleteQuestion($questionid)
{
    //this will test if there is a user with pass
    GLOBAL $dbObject;
    GLOBAL $toJsonString; 

    $dbObject->queryDelete("delete from question where id='$questionid'");

    if($dbObject->isDberror())
    {
        return '{"status":"error","results":"'.$dbObject->getDberror().'"}';
    }
    else
    {
        if($dbObject->get_affected_rows() > 0)
        {
            return '{"status":"good","results":"The Question was removed!"}';
        }
        else
        {
            //user does not exisist
            return '{"status":"error","results":"No records to remove."}';
        }
    }  
}

function connectGroup($groupid,$studyid)
{
    //this will test if there is a user with pass
    GLOBAL $dbObject;
    GLOBAL $toJsonString; 

    $dbObject->storedProcedures("call add_group_to_study($studyid,$groupid)");

    if($dbObject->isDberror())
    {
        return '{"status":"error","results":"'.$dbObject->getDberror().'"}';
    }
    else
    {
        if($dbObject->get_affected_rows() > 0)
        {
            return '{"status":"good","results":"The Group was Added!"}';
        }
        else
        {
            //user does not exisist
            return '{"status":"good","results":
                "No Group was added. The group does not have any population."}';
        }
    }  
}

function updateStudy($callArray)
{
    //this will test if there is a user with pass
    GLOBAL $dbObject;
    GLOBAL $toJsonString; 
    $studyid = $callArray['id'];
    $endKey = array_key_last($callArray);
    $added = false;
    $queryString = "update study set ";

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

    $dbObject->queryUpdate("$queryString where id='$studyid'");
    if($dbObject->isDberror())
    {
        return '{"status":"error","results":"'.$dbObject->getDberror().'",
        "query":"'.$queryString.'"}';
    }
    else
    {
        if($dbObject->get_affected_rows() > 0)
        {
            return '{"status":"good","results":"The study was Updated!"}';
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

    $dbObject->queryInsert("insert into study($keycol)
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
            return '{"status":"good","results":"The study was Added!"}';
        }
        else
        {
            //user does not exisist
            return '{"status":"error","results":"No study was Added."}';
        }
    }  
}





?>

