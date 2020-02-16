
<?php 
require_once file_exists("../scripts/global_config.php") ? 
"../scripts/global_config.php" : "../../scripts/global_config.php";
require_once file_exists("../scripts/sessions.php") ? 
"../scripts/sessions.php" : "../../scripts/sessions.php";
require_once file_exists("../scripts/api_connect.php") ?
 "../scripts/api_connect.php" : "../../scripts/api_connect.php"; 
?>

<?php

$pop_table_Connection = new apiconnection();
$pop_table_Connection->setPage("final_project/api/scripts/api.call.php");
$pop_table_Connection->setParameters(array(
    'type'=>'population',
    'return_results'=>'all'
));
$pop_table_Connection->connect_api();

$jsonTophp->clearVars();   
$jsonTophp->json_to_array($pop_table_Connection->getResults());
$returnArray = $jsonTophp->getjsonArray();

?>

<table class="table table-striped popTable">
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Address</th>
            <th scope="col">Phone</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>

        <?php 
            foreach($returnArray['rows'] as $row)
            {
                echo "<tr>";
                echo "<td scope='row' class='popname'>". $row['name'] . "</td>";
                echo "<td class='popaddress'>" . $row['address'] . "</td>";
                echo "<td class='popphone'>".$row['phone']."</td>";
                echo "<td>
                        <input type='hidden' value='". $row['id'] . "'/>  
                        <button type='button' class='btn btn-secondary pop-edit-btn'
                        data-toggle='modal' data-target='#pop_Add_Edit'>
                        Edit
                        </button>
                        <button type='button' class='btn btn-secondary pop-groups-btn'
                        data-toggle='modal' data-target='#popGroups'>
                        Groups
                        </button>
                        <button type='button' class='btn btn-secondary pop-delete-btn";              
                echo "' data-toggle='modal' data-target='#populaitonDelete'>";                    
                echo " 
                        Delete
                        </button>
                        </td>";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>

