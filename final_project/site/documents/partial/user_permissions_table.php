
<?php 
require_once '../../scripts/global_config.php';
require_once '../../scripts/sessions.php';
require_once "../../scripts/api_connect.php"; 
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
                    echo "<td scope='row' class='studyname'>"
                          . $row['study']. "</td>";
                    echo "<td>
                          <div class='form-group' >  
                          <input type='hidden' class='hidden-permis-uid' value='
                          ".$row['user_id']."' />
                          <input type='hidden' class='hidden-studyid' value='
                          ".$row['study_id']."' />";
                    echo "<select class='form-control form-input 
                          userpermission-select' >";  
                    echo "<option value='null'>Choose Permission</option>";  

                    if($row['permission'] == 1)
                    {
                        echo "<option value='1' selected='selected'>Allowed</option>"; 
                        echo "<option value='0' >Not Allowed</option>"; 
                    }
                    else
                    {
                        echo "<option value='1' >Allowed</option>"; 
                        echo "<option value='0' selected='selected'>Not Allowed</option>";
                    }

                    echo "</select></div>";  
                    echo "</tr>";
                }
            }
        ?>
    </tbody>
</table>

