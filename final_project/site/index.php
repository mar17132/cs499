


<?php 
require_once file_exists("scripts/global_config.php") ? 
"scripts/global_config.php" : "../scripts/global_config.php";
require_once file_exists("scripts/sessions.php") ? 
"scripts/sessions.php" : "../scripts/sessions.php";
require_once file_exists("scripts/api_connect.php") ?
 "scripts/api_connect.php" : "../scripts/api_connect.php"; 
?>

<?php

$studyArray = null;

function allConnectStudy()
{
    GLOBAL $jsonTophp;
    GLOBAL $myapiURL;

    $dbconnections = new apiconnection();
    $dbconnections->setPage($myapiURL."api.call.php");
    $dbconnections->setParameters(array(
        'type'=>'study',
        'return_results'=>'all'
    ));
    $dbconnections->connect_api();

    $jsonTophp->clearVars();   
    $jsonTophp->json_to_array($dbconnections->getResults());
    return $jsonTophp->getjsonArray();
}

$studyArray = allConnectStudy();

?>

<?php require_once 'documents/header_index.php'; ?>


<nav class="navbar navbar-expand-sm bg-light justify-content-center page-title dash-title">
    <h3 class="justify-content-center page-name">Dashboad</h3>
</nav>

<div class="row justify-content-center dashboard-rows">
    <div class="col-3">
        <div class="system_count_con container">
            <nav class="navbar navbar-expand-sm bg-dark 
            system-count-cmd-bar dashboard-nav-cmd justify-content-center">
                <span class="dashboard-stat-lable" >System Count</span>
            </nav>
            <?php require_once 'documents/partial/system_count_table.php';  ?>
        </div>
    </div>
    <div class="col-8">
        <div class="study_stats_con container">
            <nav class="navbar navbar-expand-sm bg-dark
            dashboard-nav-cmd justify-content-center study-stats-cmd-bar">
                <span class="dashboard-stat-lable" >Study Stats</span>
            </nav>
            <?php require_once 'documents/partial/study_stats_table.php';   ?>
        </div>
    </div>
</div>

<div class="question_stats_con container">
    <nav class="navbar navbar-expand-sm bg-dark
     dashboard-nav-cmd justify-content-center question-stats-cmd-bar">
     <span class="dashboard-stat-lable" >Question Stats</span>
    </nav>
    <nav class="navbar navbar-expand-sm question-stats-cmd-bar">
        <div class="form-group form-inline dashboard-inline-select " >
            <div class="dashboard-col-select">
                <label for="studyid" class="dashboard-inline-lable ">Study</lable>
                <select id='studyid' 
                class="form-control form-input dashboard-select-input" >
                    <option value='null'>Choose Study</option>
                    <?php 
                        foreach($studyArray['rows'] as $row)
                        {
                        echo "<option value='".$row['id']."'>";
                        echo $row['name'];
                        echo "</option>";
                        }                         
                    ?>
                </select>
            </div>

            <div class="dashboard-col-select">
                <label for="questionid" class="dashboard-inline-lable">Question</lable>
                <select id='questionid' 
                class="form-control form-input dashboard-select-input" 
                disabled="disabled">
                    <option value='null'>Choose Question</option>
                </select>
            </div>
        </div>
    </nav>
     
</div>

<script type="text/javascript" src="scripts/get_api_data.js" ></script> 
<script type="text/javascript" src="scripts/index.js" ></script> 

<?php require_once 'documents/footer.php'; ?>

