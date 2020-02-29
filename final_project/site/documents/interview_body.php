
<?php require_once 'header.php'; ?>




<nav class="navbar navbar-expand-sm bg-light justify-content-center page-title">
    <h3 class="justify-content-center page-name">Interviews</h3>
</nav>

<div class="interview-table-con container">
<nav class="navbar navbar-expand-sm bg-dark interview-cmd-bar">
    <button type="button" class="btn btn-secondary btn-sm int-cmd-btn int-cmd-btn-active"
            id="int-que-btn" >
        Que
    </button>
    <button type="button" class="btn btn-secondary btn-sm int-cmd-btn"
            id="int-progess-btn" >
        Progress
    </button>
    <button type="button" class="btn btn-secondary btn-sm int-cmd-btn"
            id="int-completed-btn" >
        Completed
    </button>
</nav>
     <?php include_once 'partial/interview_que_table.php'; ?>    
</div>

<?php include_once 'partial/interview_respons_modal.php'; ?>

<?php include_once 'partial/information_modal.php'; ?>

<?php include_once 'partial/error_modal.php'; ?>

<script type="text/javascript" src="../scripts/get_api_data.js" ></script>  
<script type="text/javascript" src="../scripts/interview_body.js" ></script>    


<?php include_once 'footer.php'; ?>


