
<!--################Delete User#######################-->
<div class="modal fade" id="connect_group_modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Connect Group</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form action="#" method="post">
            <div class="modal-body">                
                <div class="container connect-group-contain" >            
                    <?php include_once 'partial/study_connect_group_table.php'; ?>
                </div>  
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-success" 
                id="connect_group_save_btn">
                    Save
                </button>                
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Close
                </button>
            </div>
            </form>
        </div>
    </div>
</div>
