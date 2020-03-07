
<?php

require_once '../scripts/global_config.php';
require_once '../scripts/sessions.php';
require_once "../scripts/api_connect.php"; 

?>



<!DOCTYPE HTML>

<html lang="en" >
    <head>
	<meta charset="utf-8" />
        <title>CS Final</title>
        <link rel="stylesheet" href="../scripts/bootstrap/4.4.1/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="../styles/body.css"/>
        <link rel="stylesheet" href="../styles/main_menu.css"/>
        <link rel="stylesheet" href="../styles/user_body.css"/>
        <link rel="stylesheet" href="../styles/pop_body.css"/>
        <link rel="stylesheet" href="../styles/study_body.css"/>
        <link rel="stylesheet" href="../styles/interview_body.css"/>
        <link rel="stylesheet" href="../styles/page_controls.css"/>
        <script type="text/javascript" src="../scripts/jquery-3.4.1.min.js" ></script>
        <script type="text/javascript" src="../scripts/bootstrap/4.4.1/js/bootstrap.bundle.min.js" ></script>
        <style type="text/css">
        </style>    
    </head>
    <body>

    <?php include_once 'menu.php'; ?>

<input type='hidden' id='interviewer_uid' value='<?php echo $_SESSION['uid']?>' />

