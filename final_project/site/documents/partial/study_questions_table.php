
<?php 
require_once file_exists('../../scripts/global_config.php') ? 
'../../scripts/global_config.php' : '../scripts/global_config.php';
require_once file_exists('../../scripts/sessions.php') ?
'../../scripts/sessions.php' : '../scripts/sessions.php';
require_once file_exists("../../scripts/api_connect.php") ? 
"../../scripts/api_connect.php" : "../scripts/api_connect.php"; 
?>

<?php

$allQuestionsArray = null;

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $allQuestionsArray = allQuestions();
}

function allQuestions()
{
    GLOBAL $jsonTophp;

    $groupsPop = new apiconnection();
    $groupsPop->setPage("final_project/api/scripts/api.call.php");
    $groupsPop->setParameters(array(
        'type'=>'study',
        'return_results'=>'allquestions',
        'id'=>$_POST['id']
    ));
    $groupsPop->connect_api();

    $jsonTophp->clearVars();   
    $jsonTophp->json_to_array($groupsPop->getResults());
    return $jsonTophp->getjsonArray();
}

?>



<?php
if($allQuestionsArray && $allQuestionsArray['results']=='true')
{
    echo "<table class='table table-striped study_question_table'>
        <thead>
            <tr>
                <th scope='col'>Question</th>
                <th scope='col'>Action</th>
            </tr>
        </thead>  
        <tbody>";
    foreach($allQuestionsArray['rows'] as $row)
    {
        echo "<tr>";
        echo "<td scope='row' class='question_name'>"
                . $row['question']. "</td>";
        echo "<td><div class='form-group' > 
                <input type='hidden' 
                class='question-studyid' value='".$row['studyid']."' /> 
                <input type='hidden' 
                class='questionid-study' value='".$row['questionid']."' />";
        echo "<button type='button' 
        class='study-quest-edit-btn btn btn-warning'
        data-toggle='modal' data-target='#question_add_edit_modal'
        >Edit</button>
        <button type='button' 
        class='study-quest-del-btn btn btn-danger'>Delete</button>
        </div>";  
        echo "</tr>";
    }

    echo "  </tbody></table>";

}
else
{
    echo '<h6 class="study-group-name">
    No questions have been created for this study.
    </h6>';
}
?>
  

