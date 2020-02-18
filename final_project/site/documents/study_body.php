
<?php require_once 'header.php'; ?>


<nav class="navbar navbar-expand-sm bg-light justify-content-center page-title">
    <h3 class="justify-content-center page-name">Studys</h3>
</nav>

<div class="study-table container">
<nav class="navbar navbar-expand-sm bg-dark study-cmd-bar">
    <button type="button" class="btn btn-secondary btn-sm study-cmd-btn"
            id="add-study-btn" data-toggle='modal' data-target='' >
        Add Study
    </button>
    <button type="button" class="btn btn-secondary btn-sm study-cmd-btn"
            id="add-question-btn" data-toggle='modal' data-target='#question_add_edit_modal'>
        Add Question
    </button>
    <button type="button" class="btn btn-secondary btn-sm study-cmd-btn"
            id="" data-toggle='modal' data-target='#'>
       Connect Group
    </button>
</nav>
     <?php require_once 'partial/study_table.php';  ?>
</div>

<?php include_once 'partial/study_add_edit_modal.php'; ?>

<?php include_once 'partial/study_delete_modal.php'; ?>

<?php include_once 'partial/study_groups_modal.php'; ?>

<?php include_once 'partial/study_questions_modal.php'; ?>

<?php include_once 'partial/question_add_edit_modal.php'; ?>

<?php include_once 'partial/information_modal.php'; ?>

<?php include_once 'partial/error_modal.php'; ?>

<script type="text/javascript" src="../scripts/get_api_data.js" ></script>  
<script type="text/javascript" src="../scripts/study_body.js" ></script>    


<?php include_once 'footer.php'; ?>


