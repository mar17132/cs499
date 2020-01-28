
<?php require_once 'header.php'; ?>

<?php
/*
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $userActions = new apiconnection();
    $userActions->setPage("final_project/api/scripts/api.call.php");
    $userActions->setParameters(array(
        'type'=>'user',
        'return_results'=>'all'
    ));
    $userActions->connect_api();
        
    $jsonTophp->clearVars();
    $jsonTophp->json_to_array($userActions->getResults());
    $returnArray = $jsonTophp->getjsonArray();

}*/

//header("refresh: 10;");

?>

<?php 
    /*
    $userConnection = new apiconnection();
    $userConnection->setPage("final_project/api/scripts/api.call.php");
    $userConnection->setParameters(array(
        'type'=>'user',
        'return_results'=>'all'
    ));
    $userConnection->connect_api();

    $jsonTophp->clearVars();    
    $jsonTophp->json_to_array($userConnection->getResults());
    $returnArray = $jsonTophp->getjsonArray();
       */ 
?>

<nav class="navbar navbar-expand-sm bg-light justify-content-center page-title">
    <h3 class="justify-content-center page-name">Users</h3>
</nav>

<div class="user-table container">
  <!--  <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Username</th>
                <th scope="col">Type</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>

            <?php 
             /*   foreach($returnArray['rows'] as $row)
                {
                    echo "<tr>";
                    echo "<td scope='row' class='uname'>". $row['uname'] . "</td>";
                    echo "<td class='utype'>" . $row['type'] . "</td>";
                    echo "<td>
                          <input type='hidden' value='". $row['id'] . "'/>  
                          <button type='button' class='btn btn-secondary editbtn'
                          data-toggle='modal' data-target='#userEdit'>
                          Edit
                          </button>
                          <button type='button' class='btn btn-secondary deletebtn"; 
                          
                    if($_SESSION['uname'] == $row['uname'])
                    {
                        echo " disbtn' disabled >";
                    }
                    else
                    {
                        echo "' data-toggle='modal' data-target='#userDelete'>";
                    }      
                    echo " 
                          Delete
                          </button>
                          </td>";
                    echo "</tr>";
                }*/
            ?>
        </tbody>
    </table> -->
    <?php require_once '../scripts/user_table.php'; ?>
</div>

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

<!--################Edit User#######################-->
<div class="modal fade" id="userEdit">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit User</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form action="#" method="post">
            <div class="modal-body">                
                <div class="form-group" >
                    <input type="hidden" id="edit_uid" name="edit_uid" /> 
                    <label for="uname">User Name </lable>
                    <input type="text" class="form-control" id="uname" 
                        name="uname" placeholder="Username" required="required"/>
                </div>
                <div class="form-group" >
                    <label for="passwd">Password</lable>
                    <input type="password" class="form-control" id="passwd" 
                        name="passwd" placeholder="password" required="required"/>
                </div>
                <div class="form-group" >
                    <label for="type_id">User Type</lable>
                    <select class="form-control" id="type_id" name="type_id">
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
                <button type="button" id="update_user_btn" 
                class="btn btn-success" data-dismiss="modal">
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

<!--################Delete User#######################-->
<div class="modal fade" id="userDelete">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Delete User</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form action="#" method="post">
            <div class="modal-body">                
                <div class="form-group" >
                   <p>
                      You are about to delete user <span id="delespan_uname" ></span>. 
                      <br/>
                      Are you sure?   
                   </p>        
                   <input type="hidden" id="delete_uname" name="delete_uname" /> 
                   <input type="hidden" id="delete_uid" name="delete_uid" />         
                </div>

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">
                    Cancel
                </button>                
                <button type="button" id="delete_user_btn" 
                class="btn btn-danger" data-dismiss="modal">
                    Delete
                </button>
            </div>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript" src="../scripts/user_body.js" ></script>    


<?php include_once 'footer.php'; ?>


