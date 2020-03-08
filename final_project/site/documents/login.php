
<?php 

require_once '../scripts/global_config.php';
include_once 'header_login.php'; 

?>


<?php

$login_error = "";


if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $newConnection = new apiconnection();
   // $newConnection->setPage("final_project/api/scripts/api.call.php");
    $newConnection->setPage($myapiURL."api.call.php");
    $newConnection->setParameters(array(
        'type'=>'user',
        'return_results'=>'login',
        "uname"=>$_POST['uname']
    ));
    $newConnection->connect_api();

    $jsonTophp->json_to_array($newConnection->getResults());
    $returnArray = $jsonTophp->getjsonArray();

    if(password_verify($_POST['pass'],$returnArray['rows'][0]['passwd']))
    {
        setLoginSession($returnArray['rows'][0]);
        header("location:../index.php");
    }
    else
    {
        $login_error = "Incorrect username or password!";
    }

}


?>


<div class="login-form">
    <form action="login.php" method="post">
        <h2 class="text-center">Log in</h2> 
        <span class="error">
            <?php
                if(!empty($login_error))
                {
                    echo($login_error);
                }
            ?>
        </span>      
        <div class="form-group">
            <input type="text" class="form-control" 
            name="uname" placeholder="Username" required="required">
        </div>
        <div class="form-group">
            <input type="password" 
            name="pass" class="form-control" placeholder="Password" required="required">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Log in</button>
        </div>  
    </form>
</div>  

<?php include_once 'footer_login.php'; ?>

