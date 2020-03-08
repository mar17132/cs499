<!-- The Modal -->
<?php 
require_once file_exists('../../scripts/global_config.php') ? 
'../../scripts/global_config.php' : '../scripts/global_config.php';
require_once file_exists('../../scripts/sessions.php') ?
'../../scripts/sessions.php' : '../scripts/sessions.php';
require_once file_exists("../../scripts/api_connect.php") ? 
"../../scripts/api_connect.php" : "../scripts/api_connect.php"; 
?>

<?php 

    $studyTypeConnection = new apiconnection();
    $studyTypeConnection->setPage($myapiURL."api.call.php");
    $studyTypeConnection->setParameters(array(
        'type'=>'study',
        'return_results'=>'types'
    ));

    $studyTypeConnection->connect_api();

    $jsonTophp->clearVars();
    $jsonTophp->json_to_array($studyTypeConnection->getResults());    
    $returnTypeArray = $jsonTophp->getjsonArray();  

?>

<!--################Add/Edit User#######################-->
<div class="modal fade" id="study_Add_Edit">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title study_modal_title">Edit Study</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form action="#" method="post">
                <p class="form-error-msg"></p>           
            <div class="modal-body">   
                <table class="table study-add-edit-table"> 
                <tbody>
                <tr>
                <td>              
                    <div class="form-group" >
                        <input type="hidden" id="studyid-edit" name="studyid-edit" /> 
                        <label for="sname">Study Name</lable>
                        <input type="text" class="form-control form-input study-addedit-form" id="sname" 
                            name="sname" placeholder="Study Name" />
                    </div>
                </td>
                <td>
                    <div class="form-group" >
                        <label for="studyType">Type</lable>
                        <select class="form-control form-input study-addedit-form" id="studyType" 
                            name="studyType">
                            <option value='null'>Choose Type</option>
                            <?php 
                                foreach($returnTypeArray['rows'] as $typerow)
                                {
                                    echo "<option value='".$typerow['id']."'>";
                                    echo $typerow['type'];
                                    echo "</option>";
                                }                         
                            ?>
                        </select>
                    </div>
                </td>
                <td>
                <div class="form-group" >
                        <label for="orderQuest">Order Questions</lable>
                        <select class="form-control form-input study-addedit-form" id="orderQuest" 
                            name="orderQuest">
                            <option value='null'>Choose Order</option>
                            <option value='1'>True</option>
                            <option value='0'>False</option>
                        </select>
                    </div>
                </td>
                </tr>
                <tr>
                <td>
                    <div class="form-group" >
                        <label for="tryammount">Contact Amount</lable>
                        <input type="text" class="form-control form-input study-addedit-form" id="tryamount" 
                            name="tryamount" placeholder="Contact Amount" />
                    </div>
                </td>    
                <td>
                    <div class="form-group" >
                        <label for="startdate">Start Date</lable>
                        <input type="text" class="form-control form-input study-addedit-form" id="startdate" 
                            name="startdate" placeholder="YYYY-MM-DD" />
                    </div>
                </td>
                <td>
                    <div class="form-group" >
                        <label for="enddate">End Date</lable>
                        <input type="text" class="form-control form-input study-addedit-form" id="enddate" 
                            name="enddate" placeholder="YYYY-MM-DD" />
                    </div>
                </td>
                <td></td>
                </tr>        
                </tbody>
                </table>                
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" id="studysaveAddEdit_btn" 
                class="btn btn-success" >
                    Save
                </button>                
                <button type="button" class="btn btn-danger" 
                data-dismiss="modal">
                    Close
                </button>
            </div>
            </form>

        </div>
    </div>
</div>