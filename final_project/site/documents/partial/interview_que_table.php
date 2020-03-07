
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
$permissionArray = null;


function allQue()
{
    GLOBAL $jsonTophp;

    $dbconnections = new apiconnection();
    $dbconnections->setPage("final_project/api/scripts/api.call.php");
    $dbconnections->setParameters(array(
        'type'=>'interview',
        'return_results'=>'allque'
    ));
    $dbconnections->connect_api();

    $jsonTophp->clearVars();   
    $jsonTophp->json_to_array($dbconnections->getResults());
    return $jsonTophp->getjsonArray();
}

function userPermission()
{
    GLOBAL $jsonTophp;

    $dbconnections = new apiconnection();
    $dbconnections->setPage("final_project/api/scripts/api.call.php");
    $dbconnections->setParameters(array(
        'type'=>'user',
        'return_results'=>'getStudyPermission',
        'userid' => $_SESSION['uid']
    ));
    $dbconnections->connect_api();

    $jsonTophp->clearVars();   
    $jsonTophp->json_to_array($dbconnections->getResults());
    return $jsonTophp->getjsonArray();
}



$queArray = allQue();

if($_SESSION['type'] != 'Admin')
{
    $permissionArray = userPermission();
}

?>


<table class="table table-striped int-que-table int-table-view">
    <thead>
        <tr>
            <th scope="col">Person</th>
            <th scope="col">Group</th>
            <th scope="col">Study</th>
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
            echo $row['studyname']."</td><td class='int-action'>";
            echo "<input type='hidden' class='int-quid' value='";
            echo $row['quid']."'/>";
            echo "<input type='hidden' class='int-popid' value='";
            echo $row['popid']."'/>";
            echo "<input type='hidden' class='int-studyid' value='";
            echo $row['studyid']."'/>";
            echo "<input type='hidden' class='int-groupid' value='";
            echo $row['groupid']."'/>";
            echo "<button type='button' class='btn btn-secondary int-start-survey-btn";

            if(isAllowed($row['studyid']))
            {
                echo "' >";
            }
            else
            {
                echo " disbtn' disabled >";
            }

            echo "Start Survey</button>";
            echo "</td></tr>";
        }        
    }
    
    function isAllowed($studyID)
    {
        GLOBAL $permissionArray;
        
        $returnValue = false;

        if($_SESSION['type'] == 'Admin')
        {
            $returnValue = true;
        }
        else 
        {
            if($permissionArray)
            {               
                foreach($permissionArray['rows'] as $study)
                {
                    if($study['study_id'] == $studyID)
                    {
                        $returnValue = true;
                    }
                }
            }
        }

        return $returnValue;
    }

    ?>
    </tbody>
</table>
 

