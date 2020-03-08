
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
        'return_results'=>'allcompleted'
    ));
    $dbconnections->connect_api();

    $jsonTophp->clearVars();   
    $jsonTophp->json_to_array($dbconnections->getResults());
    return $jsonTophp->getjsonArray();
}



$queArray = allQue();

?>


<table class="table table-striped int-completed-table int-table-view">
    <thead>
        <tr>
            <th scope="col">Person</th>
            <th scope="col">Group</th>
            <th scope="col">Study</th>
            <th scope='col'>Start Date</th>
            <th scope='col'>Start Time</th>
            <th scope='col'>End Date</th>
            <th scope='col'>End Time</th>
            <th scope='col'>Interviewer</th>
            <th scope='col'>Action</th>
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
            echo $row['startint_time']."</td><td class='int-enddate'>";
            echo $row['endint_date']."</td><td class='int-endtime'>";
            echo $row['endint_time']."</td><td class='int-uname'>";
            echo $row['uname']."</td><td class='int-action'>";
            echo "<input type='hidden' class='int-queid' value='";
            echo $row['quid']."'/>";
            echo "<input type='hidden' class='int-popid' value='";
            echo $row['popid']."'/>";
            echo "<input type='hidden' class='int-studyid' value='";
            echo $row['studyid']."'/>";
            echo "<input type='hidden' class='int-groupid' value='";
            echo $row['groupid']."'/>";
            echo "<input type='hidden' class='int-interviewid' value='";
            echo $row['interviewid']."'/>";
            echo "<input type='hidden' class='int-uid' value='";
            echo $row['uid']."'/>";
            echo "<button type='button' class='btn btn-secondary 
            int-show-anwsers-btn' data-toggle='modal' 
            data-target='#int_respons_modal'>
            Responses
            </button>";
            echo "</td></tr>";
        }
    }

    ?>
    </tbody>
</table>
 

