<!-- The Modal -->

<!--################Add/Edit User#######################-->
<div class="modal fade" id="pop_Add_Edit">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title addedit_pop_title">Edit Population</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form action="#" method="post">
                <p class="form-error-msg"></p>           
            <div class="modal-body">   
                <table class="table pop-add-edit-table"> 
                <tbody>
                <tr>
                <td>              
                    <div class="form-group" >
                        <input class="form-input" type="hidden" id="popid" name="popid" /> 
                        <label for="fname">First Name </lable>
                        <input type="text" class="form-control form-input" id="fname" 
                            name="fname" placeholder="First Name" />
                    </div>
                </td>
                <td>
                    <div class="form-group" >
                        <label for="mname">Middle Name </lable>
                        <input type="text" class="form-control form-input" id="mname" 
                            name="mname" placeholder="Middle Name" />
                    </div>
                </td>
                <td>
                    <div class="form-group" >
                        <label for="lname">Last Name </lable>
                        <input type="text" class="form-control form-input" id="lname" 
                            name="lname" placeholder="Last Name" />
                    </div>
                </td>
                </tr>
                <tr>
                <td>
                    <div class="form-group" >
                        <label for="street">Street</lable>
                        <input type="text" class="form-control form-input" id="street" 
                            name="street" placeholder="Street" />
                    </div>
                </td>
                <td>
                    <div class="form-group" >
                        <label for="apt">Appartment</lable>
                        <input type="text" class="form-control form-input" id="apt" 
                            name="apt" placeholder="Appartment" />
                    </div>
                </td>
                <td></td>
                </tr>
                <tr>
                <td>
                    <div class="form-group" >
                        <label for="city">City</lable>
                        <input type="text" class="form-control form-input" id="city" 
                            name="city" placeholder="City" />
                    </div>
                </td>
                <td>
                    <div class="form-group" >
                        <label for="state">State</lable>
                        <input type="text" class="form-control form-input" id="state" 
                            name="state" placeholder="State" />
                    </div>
                </td>
                <td>    
                    <div class="form-group" >
                        <label for="zip">Zip</lable>
                        <input type="text" class="form-control form-input" id="zip" 
                            name="zip" placeholder="Zip" />
                    </div>
                </td>
                </tr>
                <tr>
                <td>
                    <div class="form-group" >
                        <label for="phone">Phone</lable>
                        <input type="text" class="form-control form-input" id="phone" 
                            name="phone" placeholder="Phone Number" />
                    </div>
                </td>
                <td></td>
                <td></td>
                </tr>           
                </tbody>
                </table>                
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" id="popAddEdit_btn" 
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