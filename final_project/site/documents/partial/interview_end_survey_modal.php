<!-- The Modal -->
<?php 

$typeArray = null;
//$uid = null;


function getCompletedType()
{
    GLOBAL $jsonTophp;
    GLOBAL $myapiURL;

    $pop_table_Connection = new apiconnection();
    $pop_table_Connection->setPage($myapiURL."api.call.php");
    $pop_table_Connection->setParameters(array(
        'type'=>'interview',
        'return_results'=>'completedtype'
    ));
    $pop_table_Connection->connect_api();
    
    $jsonTophp->clearVars();   
    $jsonTophp->json_to_array($pop_table_Connection->getResults());
    return $jsonTophp->getjsonArray();
}


$typeArray = (array) getCompletedType();
// $uid = $_SESSION['uid'];

?>


<!--################Add/Edit User#######################-->
<div class="modal fade" id="end_survey_modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title ">End Survey</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form action="#" method="post">
                <p class="form-error-msg"></p>
            <div class="modal-body">                
                <div class="form-group" >
                    <label for="surv-typeid">Survey End Status</lable>
                    <select class="form-control form-input" 
                            id="surv-typeid" name="surv-typeid">
                        <option value='null'>Choose Type</option>
                        <?php 
                           foreach($typeArray['rows'] as $typerow)
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