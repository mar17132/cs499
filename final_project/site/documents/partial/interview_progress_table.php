
<?php 
require_once file_exists('../../scripts/global_config.php') ? 
'../../scripts/global_config.php' : '../scripts/global_config.php';
require_once file_exists('../../scripts/sessions.php') ?
'../../scripts/sessions.php' : '../scripts/sessions.php';
require_once file_exists("../../scripts/api_connect.php") ? 
"../../scripts/api_connect.php" : "../scripts/api_connect.php"; 
?>

<?php

$queArray = null;

function allQue()
{
    GLOBAL $jsonTophp;
    GLOBAL $myapiURL;

    $dbconnections = new apiconnection();
    $dbconnections->setPage($myapiURL."api.call.php");
    $dbconnections->setParameters(array(
        'type'=>'interview',
        'return_results'=>'allprogress'
    ));
    $dbconnections->connect_api();

    $jsonTophp->clearVars();   
    $jsonTophp->json_to_array($dbconnections->getResults());
    return $jsonTophp->getjsonArray();
}



$queArray = allQue();

?>


<table class="table table-striped int-progress-table int-table-view">
    <thead>
        <tr>
            <th scope="col">Person</th>
            <th scope="col">Group</th>
            <th scope="col">Study</th>
            <th scope='col'>Start Date</th>
            <th scope='col'>Start Time</th>
            <th scope='col'>Interviewer</th>
        </tr>
    </thead>
    <tbody>

    <?php 

    if($queArray)
    {
        foreach($queArray['rows'] as $row)
        {
            echo "<tr><td scope='row' class='int-popname'>";
            echo $row['popname']."</td><td class='int-groupname'>";
            echo $row['groupname']."</td><td class='int-studyname'>";
            echo $row['studyname']."</td><td class='int-startdate'>";
            echo $row['startint_date']."</td><td class='int-starttime'>";
            echo $row['startint_time']."</td><td class='int-uname'>";
            echo $row['uname']."</td>";
            echo "</tr>";
        }
    }

    ?>
    </tbody>
</table>
 

