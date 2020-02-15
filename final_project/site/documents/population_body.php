
<?php require_once 'header.php'; ?>




<nav class="navbar navbar-expand-sm bg-light justify-content-center page-title">
    <h3 class="justify-content-center page-name">Population</h3>
</nav>

<div class="pop-table container">
<nav class="navbar navbar-expand-sm bg-dark pop-cmd-bar">
    <button type="button" class="btn btn-secondary btn-sm pop-cmd-btn"
            id="add-pop-btn" data-toggle='modal' data-target='#pop_Add_Edit' >
        Add Person
    </button>
    <button type="button" class="btn btn-secondary btn-sm pop-cmd-btn"
            id="view-Groups-btn" data-toggle='modal' data-target='#allGroups'>
        View Groups
    </button>
    <button type="button" class="btn btn-secondary btn-sm pop-cmd-btn"
            id="add-Groups-btn" >
        Add Groups
    </button>
</nav>
     <?php require_once 'partial/population_table.php';  ?>
</div>

<?php include_once 'partial/population_group_modal.php'; ?>

<?php include_once 'partial/population_all_groups_modal.php'; ?>

<?php include_once 'partial/pop_add_edit_modal.php'; ?>

<?php include_once 'partial/pop_delete_modal.php'; ?>

<?php include_once 'partial/information_modal.php'; ?>

<?php include_once 'partial/error_modal.php'; ?>

<script type="text/javascript" src="../scripts/get_api_data.js" ></script>  
<script type="text/javascript" src="../scripts/pop_body.js" ></script>    


<?php include_once 'footer.php'; ?>


