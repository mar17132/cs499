
<?php 
require_once file_exists("../scripts/global_config.php") ? 
"../scripts/global_config.php" : "../../scripts/global_config.php";
require_once file_exists("../scripts/sessions.php") ? 
"../scripts/sessions.php" : "../../scripts/sessions.php";
require_once file_exists("../scripts/api_connect.php") ?
 "../scripts/api_connect.php" : "../../scripts/api_connect.php"; 
?>

<?php

$study_table_Connection = new apiconnection();
$study_table_Connection->setPage("final_project/api/scripts/api.call.php");
$study_table_Connection->setParameters(array(
    'type'=>'study',
    'return_results'=>'all'
));
$study_table_Connection->connect_api();

$jsonTophp->clearVars();   
$jsonTophp->json_to_array($study_table_Connection->getResults());
$returnStudyArray = $jsonTophp->getjsonArray();

?>

<table class="table table-striped studyTable">
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Type</th>
            <th scope="col">Order</th>
            <th scope="col">Contact</th>
            <th scope="col">Start</th>
            <th scope="col">End</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>

        <?php 
            foreach($returnStudyArray['rows'] as $row)
            {
                echo "<tr>";
                echo "<td scope='row' class='studyname'>". $row['name'] . "</td>";
                echo "<td class='studytype'>" . $row['typename'] . "</td>";
                echo "<td class='studyorder'>".
                $row['order_questions'] = 1 ? 'True' : 'False'."</td>";
                echo "<td class='studytrys'>". $row['try_amount']."</td>";
                echo "<td class='startdate' >".$row['start']. "</td>";
                echo "<td class='enddate' >".$row['end']. "</td>";
                //Action buttons
                echo "<td>
                        <input type='hidden' value='". $row['id'] . "'/>  
                        <button type='button' class='btn btn-secondary study-edit-btn'
                        data-toggle='modal' data-target='#'>
                        Edit
                        </button>
                        <button type='button' class='btn btn-secondary study-pop-btn'
                        data-toggle='modal' data-target='#study_groups_modal'>
                        Groups
                        </button>
                        <button type='button' class='btn btn-secondary study-questions-btn'
                        data-toggle='modal' data-target='#'>
                        Questions
                        </button>
                        <button type='button' class='btn btn-secondary study-delete-btn";              
                echo "' data-toggle='modal' data-target='#'>";                    
                echo " 
                        Delete
                        </button>
                        </td>";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>

