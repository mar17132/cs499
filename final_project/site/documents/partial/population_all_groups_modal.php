<!-- The Modal -->


<!--################Permissions User#######################-->
<div class="modal fade" id="allGroups">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title ">
                    Groups
                </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form action="#" method="post">
                <p class="form-error-msg"></p>
            <div class="modal-body"> 
                <div class="container pop-all-groups-table" >

                </div>                
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">           
                <button type="button" class="btn btn-danger" 
                 data-dismiss="modal">
                    Close
                </button>
            </div>
            </form>

        </div>
    </div>
</div>



<!--################Permissions User#######################-->
<div class="modal fade" id="addGroups">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title ">
                    Add Group
                </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form action="#" method="post">
                <p class="form-error-msg"></p>
            <div class="modal-body"> 
                <div class="form-group add-group-container" >
                    <label for="groupname">Group Name</lable>
                    <input type="text" class="form-control form-addgroup-input" id="groupname" 
                    name="groupname" placeholder="Group Name"/>
                </div>                
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">           
                <button type="button" id="add_group_btn" 
                class="btn btn-success" >
                    Save
                </button>                
                <button type="button" class="btn btn-danger" 
                id="close_add_group_btn" data-dismiss="modal">
                    Close
                </button>
            </div>
            </form>

        </div>
    </div>
</div>


