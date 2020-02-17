
<!--################Delete User#######################-->
<div class="modal fade" id="studyDelete">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Delete Study</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form action="#" method="post">
            <div class="modal-body">                
                <div class="form-group" >
                   <p>
                      You are about to delete Study
                      <span id="delespan_study_name" ></span>. 
                      <br/>
                      Are you sure?   
                   </p>                 
                   <input type="hidden" id="delete_studyid" name="delete_studyid" />         
                </div>

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">
                    Cancel
                </button>                
                <button type="button" id="dele_study_btn" 
                class="btn btn-danger" data-dismiss="modal">
                    Delete
                </button>
            </div>
            </form>
        </div>
    </div>
</div>
