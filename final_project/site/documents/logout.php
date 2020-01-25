
<?php 

require_once '../scripts/sessions.php';
include_once '../scripts/api_connect.php'; 

disLoginSession();

header("location:http://".$_SERVER['SERVER_NAME']."/final_project/site/documents/login.php");


?>
