
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
$groupArray = null;


function allConnectStudy()
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

function allgroups()
{
    GLOBAL $jsonTophp;
    GLOBAL $myapiURL;

    $dbconnections = new apiconnection();
    $dbconnections->setPage($myapiURL."api.call.php");
    $dbconnections->setParameters(array(
        'type'=>'population',
        'return_results'=>'allgroups'
    ));
    $dbconnections->connect_api();

    $jsonTophp->clearVars();   
    $jsonTophp->json_to_array($dbconnections->getResults());
    return $jsonTophp->getjsonArray();
}

$groupArray = allgroups();
$studyArray = allConnectStudy();

?>


<table class="table connect_group_table">
    <tbody>
    <tr>
        <td>
            <div class="form-group" >
                <label for="connectStudyid">Study</lable>
                <select class="form-control form-input connenct-group-form" id="connectStudyid" 
                name="connectStudyid">
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
                <label for="connectgroupid">Group</lable>
                <select class="form-control form-input connenct-group-form" id="connectgroupid" 
                name="connectgroupid">
                    <option value='null'>Choose Group</option>
                    <?php 
                        foreach($groupArray['rows'] as $row)
                        {
                        echo "<option value='".$row['id']."'>";
                        echo $row['sample_name'];
                        echo "</option>";
                        }                         
                    ?>
                </select>
            </div>
        </td>
        </tr>
    </tbody>
</table>

