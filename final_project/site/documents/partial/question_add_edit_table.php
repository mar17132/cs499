
<?php 
require_once file_exists('../../scripts/global_config.php') ? 
'../../scripts/global_config.php' : '../scripts/global_config.php';
require_once file_exists('../../scripts/sessions.php') ?
'../../scripts/sessions.php' : '../scripts/sessions.php';
require_once file_exists("../../scripts/api_connect.php") ? 
"../../scripts/api_connect.php" : "../scripts/api_connect.php"; 
?>

<?php

$studyArray = null;
$typeArray = null;

if($_SERVER['REQUEST_METHOD'] == 'POST')
{

}

function alltypes()
{
    GLOBAL $jsonTophp;
    GLOBAL $myapiURL;

    $dbconnections = new apiconnection();
    $dbconnections->setPage($myapiURL."api.call.php");
    $dbconnections->setParameters(array(
        'type'=>'study',
        'return_results'=>'questiontype'
    ));
    $dbconnections->connect_api();

    $jsonTophp->clearVars();   
    $jsonTophp->json_to_array($dbconnections->getResults());
    return $jsonTophp->getjsonArray();
}

function allstudy()
{
    GLOBAL $jsonTophp;
    GLOBAL $myapiURL;

    $dbconnections = new apiconnection();
    $dbconnections->setPage($myapiURL."api.call.php");
    $dbconnections->setParameters(array(
        'type'=>'study',
        'return_results'=>'all'
    ));
    $dbconnections->connect_api();

    $jsonTophp->clearVars();   
    $jsonTophp->json_to_array($dbconnections->getResults());
    return $jsonTophp->getjsonArray();
}

$typeArray = alltypes();
$studyArray = allstudy();

?>


<table class="table question_add_edit_table">
    <tbody>
    <tr>
        <td>
            <div class="form-group" >
                <label for="studyid">Study</lable>
                <select class="form-control form-input question-addedit-form" id="studyid" 
                name="studyid">
                    <option value='null'>Choose Study</option>
                    <?php 
                        foreach($studyArray['rows'] as $row)
                        {
                        echo "<option value='".$row['id']."'>";
                        echo $row['name'];
                        echo "</option>";
                        }                         
                    ?>
                </select>
            </div>
        </td>
        <td>
            <div class="form-group" >
                <label for="qtype">Question Type</lable>
                <select class="form-control form-input question-addedit-form" id="qtype" 
                name="qtype">
                    <option value='null'>Choose Type</option>
                    <?php 
                        foreach($typeArray['rows'] as $row)
                        {
                        echo "<option value='".$row['id']."'>";
                        echo $row['type'];
                        echo "</option>";
                        }                         
                    ?>
                </select>
            </div>
        </td>
        <td>
            <div class="form-group" >
                <label for="questaorder">Order Anwsers</lable>
                <select class="form-control form-input question-addedit-form" id="questaorder" 
                name="questaorder">
                    <option value='0'>False</option>
                    <option value='1'>True</option>
                </select>
            </div>
        </td>
        </tr>
        <tr>
        <td>              
            <div class="form-group" >
                <input class="form-input" type="hidden" id="quest_edit_id" 
                name="quest_edit_id" /> 
                <label for="question">Question</lable>
                <input type="text" class="form-control form-input question-addedit-form" id="question" 
                    name="question" placeholder="Question" />
            </div>
        </td>
        <td>              
            <div class="form-group" > 
                <label for="qorder">Order</lable>
                <input type="text" class="form-control form-input question-addedit-form" id="qorder" 
                    name="qorder" placeholder="Question Order" />
            </div>
        </td>
        <td></td>
        </tr>
    </tbody>
</table>
 

<nav class="navbar navbar-expand-sm study-group-namebar">
    <h3 class="study-group-name">
    Answers
    </h3>
    <span class="ml-auto add_question_anwser_span" >
        <button type="button" class="btn btn-warning quest_anwser_add_btn" id="quest_anwser_add_btn">   
        Add Answer
        </button>
    </span>            
</nav>

<div class="container question-answer-contain" >
    <table class="table answer_addedit_table">
             
        <tbody class="answer_addedit_tbody">
            
        </tbody>
    </table>    
</div>
