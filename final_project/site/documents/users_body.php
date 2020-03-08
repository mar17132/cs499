
<?php 

require_once 'header.php'; 

?>




<nav class="navbar navbar-expand-sm bg-light justify-content-center page-title">
    <h3 class="justify-content-center page-name">Users</h3>
</nav>

<div class="user-table container">
<nav class="navbar navbar-expand-sm bg-dark user-cmd-bar">
    <button type="button" class="btn btn-secondary btn-sm adduser-btn"
            id="add-user-btn" >
        Add User
    </button>
</nav>
     <?php require_once 'partial/user_table.php';  ?>
</div>

<?php include_once 'partial/user_permissions_modal.php'; ?>

<?php include_once 'partial/user_add_edit_modal.php'; ?>

<?php include_once 'partial/user_delete_modal.php'; ?>

<?php include_once 'partial/information_modal.php'; ?>

<?php include_once 'partial/error_modal.php'; ?>

<script type="text/javascript" src="../scripts/get_api_data.js" ></script>  
<script type="text/javascript" src="../scripts/user_body.js" ></script>    


<?php include_once 'footer.php'; ?>


