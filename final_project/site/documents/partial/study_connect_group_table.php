
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


function alltypes()
{
    GLOBAL $jsonTophp;

    $dbconnections = new apiconnection();
    $dbconnections->setPage("final_project/api/scripts/api.call.php");
    $dbconnections->setParameters(array(
        'type'=>'study',
        'return_results'=>'questiontype'
    ));
    $dbconnections->connect_api();

    $jsonTophp->clearVars();   
    $jsonTophp->json_to_array($dbconnections->getResults());
    return $jsonTophp->getjsonArray();
}

function allgroups()
{
    GLOBAL $jsonTophp;

    $dbconnections = new apiconnection();
    $dbconnections->setPage("final_project/api/scripts/api.call.php");
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
$studyArray = allstudy();

?>


<table class="table question_add_edit_table">
    <tbody>
    <tr>
        <td>
            <div class="form-group" >
                <label for="connectStudyid">Study</lable>
                <select class="form-control form-input" id="connectStudyid" 
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
                <select class="form-control form-input" id="connectgroupid" 
                name="connectgroupid">
                    <option value='null'>Choose Type</option>
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

