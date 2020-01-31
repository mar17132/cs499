
<?php 
require_once 'global_config.php';
require_once 'sessions.php';
require_once "api_connect.php"; 
?>

<?php

$userConnection = new apiconnection();
$userConnection->setPage("final_project/api/scripts/api.call.php");
$userConnection->setParameters(array(
    'type'=>'user',
    'return_results'=>'all'
));
$userConnection->connect_api();

$jsonTophp->clearVars();   
$jsonTophp->json_to_array($userConnection->getResults());
$returnArray = $jsonTophp->getjsonArray();

?>

<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Username</th>
            <th scope="col">Type</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>

        <?php 
            foreach($returnArray['rows'] as $row)
            {
                echo "<tr>";
                echo "<td scope='row' class='uname'>". $row['uname'] . "</td>";
                echo "<td class='utype'>" . $row['type'] . "</td>";
                echo "<td>
                        <input type='hidden' value='". $row['id'] . "'/>  
                        <button type='button' class='btn btn-secondary editbtn'
                        data-toggle='modal' data-target='#userEdit'>
                        Edit
                        </button>
                        <button type='button' class='btn btn-secondary deletebtn"; 
                        
                if($_SESSION['uname'] == $row['uname'])
                {
                    echo " disbtn' disabled >";
                }
                else
                {
                    echo "' data-toggle='modal' data-target='#userDelete'>";
                }      
                echo " 
                        Delete
                        </button>
                        </td>";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>

