
<?php 
require_once file_exists("../scripts/global_config.php") ? 
"../scripts/global_config.php" : "../../scripts/global_config.php";
require_once file_exists("../scripts/sessions.php") ? 
"../scripts/sessions.php" : "../../scripts/sessions.php";
require_once file_exists("../scripts/api_connect.php") ?
 "../scripts/api_connect.php" : "../../scripts/api_connect.php"; 
?>

<?php

$responsArray = null;


function getQuestionDashboard()
{
    GLOBAL $jsonTophp;
    GLOBAL $myapiURL;

    $groupsPop = new apiconnection();
    $groupsPop->setPage($myapiURL."api.call.php");
    $groupsPop->setParameters(array(
        'type'=>'dashboard',
        'return_results'=>'questionselect',
        'studyid'=>$_POST['studyid']
    ));
    $groupsPop->connect_api();
    
    $jsonTophp->clearVars();   
    $jsonTophp->json_to_array($groupsPop->getResults());
    return $jsonTophp->getjsonArray();
}

$responsArray = getQuestionDashboard();

?>


<?php 

if(isset($responsArray['rows']))
{
    foreach($responsArray['rows'] as $row)
    {
        echo "<option class='question-options-tag' ";
        echo "value='".$row['id']."'>";
        echo $row['question'];
        echo "</option>";    
    }
}

?>


