
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


function getQuestionDashboardStats()
{
    GLOBAL $jsonTophp;
    GLOBAL $myapiURL;

    $groupsPop = new apiconnection();
    $groupsPop->setPage($myapiURL."api.call.php");
    $groupsPop->setParameters(array(
        'type'=>'dashboard',
        'return_results'=>'questionstats',
        'studyid'=>$_POST['studyid'],
        'questionid'=>$_POST['questionid']
    ));
    $groupsPop->connect_api();
    
    $jsonTophp->clearVars();   
    $jsonTophp->json_to_array($groupsPop->getResults());
    return $jsonTophp->getjsonArray();
}

$responsArray = getQuestionDashboardStats();

?>

<?php 

if(isset($responsArray['rows']))
{
    
?>

<table class="table table-striped question-stat-table">
    <thead>
        <tr>
            <th scope="col" class='text-center'>Answer</th>            
            <th scope="col" class='text-center'>Number of Selected</th>
            <th scope="col" class='text-center'>Percentage</th>
        </tr>
    </thead> 
    <tbody>
        <?php 

            foreach($responsArray['rows'] as $row)
            {
                echo "<tr><td scope='row' class='text-center'>";
                echo $row['anwsername']."</td><td class='text-center'>";
                echo $row['anwser_count']."</td><td class='text-center'>";
                echo number_format(calAnwserPercent($row['anwser_count'],
                $row['total_surveys']),0)."%";
                echo "</td><td></tr>";
            }        
        ?>
    </tbody>
</table>

<?php 

}
else
{
    echo "<h7>No records recorded.</h7>";
} 


function calAnwserPercent($completed,$total)
{
    $returnval = 0;

    if($total != 0)
    {
        $returnval = ($completed/$total) * 100;
    }

    return $returnval;
}

?>
