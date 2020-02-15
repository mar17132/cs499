
<?php 
require_once file_exists('../../scripts/global_config.php') ? 
'../../scripts/global_config.php' : '../scripts/global_config.php';
require_once file_exists('../../scripts/sessions.php') ?
'../../scripts/sessions.php' : '../scripts/sessions.php';
require_once file_exists("../../scripts/api_connect.php") ? 
"../../scripts/api_connect.php" : "../scripts/api_connect.php"; 
?>

<?php

$allGroupsArray = null;

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $allGroupsArray = allGroups();
}

function allGroups()
{
    GLOBAL $jsonTophp;

    $groupsPop = new apiconnection();
    $groupsPop->setPage("final_project/api/scripts/api.call.php");
    $groupsPop->setParameters(array(
        'type'=>'population',
        'return_results'=>'allgroups'
    ));
    $groupsPop->connect_api();

    $jsonTophp->clearVars();   
    $jsonTophp->json_to_array($groupsPop->getResults());
    return $jsonTophp->getjsonArray();
}


?>

<table class="table table-striped popGroupTable">
    <thead>
        <tr>
            <th scope="col">Group</th>
            <th scope="col">Action</th>
        </tr>
    </thead>  
    <tbody>
        <?php
            if($allGroupsArray)
            {
                foreach($allGroupsArray['rows'] as $row)
                {
                    echo "<tr>";
                    echo "<td scope='row' class='allgroupname'>"
                          . $row['sample_name']. "</td>";
                    echo "<td>
                          <div class='form-group' >  
                          <input type='hidden' class='hidden-all-group-id' value='
                          ".$row['id']."' />";
                    echo "<button type='button' class='all-group-del-btn btn btn-secondary pop-delete-btn'> ";                 
                    echo "Delete</button></div>";  
                    echo "</tr>";
                }
            }
        ?>
    </tbody>
</table>

