
<!--################Delete User#######################-->
<div class="modal fade" id="populaitonDelete">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Delete Population Person</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form action="#" method="post">
            <div class="modal-body">                
                <div class="form-group" >
                   <p>
                      You are about to delete population person 
                      <span id="delespan_pop_name" ></span>. 
                      <br/>
                      Are you sure?   
                   </p>                 
                   <input type="hidden" id="delete_popid" name="delete_popid" />         
                </div>

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">
                    Cancel
                </button>                
                <button type="button" id="delete_pop_btn" 
                class="btn btn-danger" data-dismiss="modal">
                    Delete
                </button>
            </div>
            </form>
        </div>
    </div>
</div>
