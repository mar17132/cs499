
<?php 
require_once '../scripts/global_config.php';
require_once '../scripts/sessions.php';
require_once "../scripts/api_connect.php"; 
?>

<?php

$userPermission = null;

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $userPermission = new apiconnection();
    $userPermission->setPage("final_project/api/scripts/api.call.php");
    $userPermission->setParameters(array(
        'type'=>'user',
        'return_results'=>'permissions',
        'userid' => $_POST['userid']
    ));
    $userPermission->connect_api();

    $jsonTophp->clearVars();   
    $jsonTophp->json_to_array($userPermission->getResults());
    $userPermissionArray = $jsonTophp->getjsonArray();
}

?>

<table class="table table-striped userPermissionTable">
    <thead>
        <tr>
            <th scope="col">Study</th>
            <th scope="col">Permission</th>
        </tr>
    </thead>  
    <tbody>
        <?php
            if($userPermissionArray)
            {
                foreach($userPermissionArray['rows'] as $row)
                {
                    echo "<tr>";
                    echo "<td>". $row['study']. "</td>";
                    echo "<td>
                          <input type='hidden' class='hidden-studyid' value='
                          ".$row['study_id']."' />";

                    echo "</tr>";
                }
            }
        ?>
    </tbody>
</table>
