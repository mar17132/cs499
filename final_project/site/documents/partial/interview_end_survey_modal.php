<!-- The Modal -->
<?php 

    $userTypeConnection = new apiconnection();
    $userTypeConnection->setPage("final_project/api/scripts/api.call.php");
    $userTypeConnection->setParameters(array(
        'type'=>'user',
        'return_results'=>'types'
    ));

    $userTypeConnection->connect_api();

    $jsonTophp->clearVars();
    $jsonTophp->json_to_array($userTypeConnection->getResults());    
    $returnTypeArray = $jsonTophp->getjsonArray();  

?>


<!--################Add/Edit User#######################-->
<div class="modal fade" id="userAddEdit">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title addedit_title">Edit User</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form action="#" method="post">
                <p class="form-error-msg"></p>
            <div class="modal-body">                
                <div class="form-group" >
                    <label for="type_id">User Type</lable>
                    <select class="form-control form-input" 
                            id="type_id" name="type_id">
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
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" id="userAddEdit_btn" 
                class="btn btn-success" >
                    Save
                </button>                
                <button type="button" class="btn btn-danger" 
                id="userAddEdit_close_btn" data-dismiss="modal">
                    Close
                </button>
            </div>
            </form>

        </div>
    </div>
</div>