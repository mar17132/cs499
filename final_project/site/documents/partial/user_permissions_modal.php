<!-- The Modal -->


<!--################Permissions User#######################-->
<div class="modal fade" id="userPermissions">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title addedit_title">
                    <span class="username-permission" ></span>Permissions
                </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form action="#" method="post">
                <p class="form-error-msg"></p>
            <div class="modal-body"> 
                <div class="container user-permission-table" >
                    <?php include_once 'user_permissions_table.php'; ?>
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