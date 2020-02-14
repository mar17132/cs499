
<?php 
require_once '../../scripts/global_config.php';
require_once '../../scripts/sessions.php';
require_once "../../scripts/api_connect.php"; 
?>

<?php

$allGroupsArray = null;
$allPersonGroups = null;

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    //$allGroupsArray = allGroups();
    $allPersonGroups = personsGroups($_POST['id']);
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

function personsGroups($popid)
{
    GLOBAL $jsonTophp;

    $personGroups = new apiconnection();
    $personGroups->setPage("final_project/api/scripts/api.call.php");
    $personGroups->setParameters(array(
        'type'=>'population',
        'return_results'=>'groups',
        'id' => $popid
    ));
    $personGroups->connect_api();

    $jsonTophp->clearVars();   
    $jsonTophp->json_to_array($personGroups->getResults());
    return $jsonTophp->getjsonArray();
}

?>

<table class="table table-striped popGroupTable">
    <thead>
        <tr>
            <th scope="col">Group</th>
            <th scope="col">Member</th>
        </tr>
    </thead>  
    <tbody>
        <?php
            if($allPersonGroups)
            {
                foreach($allPersonGroups['rows'] as $row)
                {
                    echo "<tr>";
                    echo "<td scope='row' class='sample-groupname'>"
                          . $row['groupname']. "</td>";
                    echo "<td>
                          <div class='form-group' >  
                          <input type='hidden' class='hidden-pop-id' value='
                          ".$row['popid']."' />
                          <input type='hidden' class='hidden-pop-group-id' value='
                          ".$row['groupid']."' />";
                    echo "<input type='checkbox' class='group-chkbox form-check-input' "; 
                    if($row['member'])
                    {
                        echo "checked='checked' />";
                    }
                    else
                    {
                        echo "/>";
                    }
                    echo "</div>";  
                    echo "</tr>";
                }
            }
        ?>
    </tbody>
</table>

