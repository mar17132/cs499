
<?php 
require_once 'scripts/global_config.php';
require_once 'scripts/sessions.php';
require_once "scripts/api_connect.php"; 
?>

<?php

$responsArray = null;


function getStudyRespons()
{
    GLOBAL $jsonTophp;
    GLOBAL $myapiURL;

    $groupsPop = new apiconnection();
    $groupsPop->setPage($myapiURL."api.call.php");
    $groupsPop->setParameters(array(
        'type'=>'dashboard',
        'return_results'=>'getstudystats'
    ));
    $groupsPop->connect_api();
    
    $jsonTophp->clearVars();   
    $jsonTophp->json_to_array($groupsPop->getResults());
    return $jsonTophp->getjsonArray();
}

$responsArray = getStudyRespons();

?>

<?php 

if(isset($responsArray['rows']))
{
    
?>

<table class="table table-striped study-count-table">
    <thead>
        <tr>
            <th scope="col" class='text-center'>Study</th>
            <th scope="col" class='text-center'>Number of Questions</th>
            <th scope="col" class='text-center'>Number of Population</th>
            <th scope="col" class='text-center'>Completed Surveys</th>
            <th scope="col" class='text-center'>Percentage Done</th>
        </tr>
    </thead> 
    <tbody>
        <?php 

            foreach($responsArray['rows'] as $row)
            {
                echo "<tr><td scope='row' class='text-center'>";
                echo $row['studyname']."</td><td class='text-center'>";
                echo $row['question_count']."</td><td class='text-center'>";
                echo $row['study_pop_count']."</td><td class='text-center'>";
                echo $row['completed_surveys_count']."</td><td class='text-center'>";
                echo number_format(calStudyDone($row['completed_surveys_count'],
                $row['study_pop_count']),0)."%";
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


function calStudyDone($completed,$total)
{
    $returnval = 0;

    if($total != 0)
    {
        $returnval = ($completed/$total) * 100;
    }

    return $returnval;
}

?>
