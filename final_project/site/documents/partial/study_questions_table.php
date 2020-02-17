
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
    $allGroupsArray = allstudygroups();
}

function allstudygroups()
{
    GLOBAL $jsonTophp;

    $groupsstudy = new apiconnection();
    $groupsstudy->setPage("final_project/api/scripts/api.call.php");
    $groupsstudy->setParameters(array(
        'type'=>'study',
        'return_results'=>'studygroups',
        'id'=>$_POST['id']
    ));
    $groupsstudy->connect_api();

    $jsonTophp->clearVars();   
    $jsonTophp->json_to_array($groupsstudy->getResults());
    return $jsonTophp->getjsonArray();
}


if($allGroupsArray && $allGroupsArray['results'] == 'true')
{
    $currentGroup = "";

    foreach($allGroupsArray['rows'] as $row)
    {
        if($currentGroup == "" && $currentGroup != $row['sample_name'])
        {
            if($currentGroup != "")
            {
                echo "</tbody></table>";
            }   

            echo '<nav class="navbar navbar-expand-sm study-group-namebar">
                <h3 class="study-group-name">
                    '.$row['sample_name'].'
                </h3>
                <span class="ml-auto" >
                <input type="hidden" value="'.$row['groupid'].'" 
                class="study-groupid-modal" />
                <input type="hidden" value="'.$row['studyid'].'" 
                class="studyid-group-modal" />
                <button type="button" class="btn btn-danger study-removegroup-btn">   
                 Remove </button></span>            
                 </nav>';

            echo '
            <table class="table table-striped studyGroupTable">
                <thead>
                    <tr>
                        <th scope="col">Person Name</th>
                    </tr>
                </thead>  
                <tbody>';
            
            $currentGroup = $row['sample_name'];

        }


  
        echo "<tr>";
        echo "<td scope='row' class='pop_personname'>"
                . $row['name']. "</td>";
        echo "</tr>";
    }
}
else
{
    echo '<h6 class="study-group-name">
    No groups connected to the study.
    </h6>';
}



?>
   


