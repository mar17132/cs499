

<?php
/*
$login_error = "";


if(test for seasion)
{

}
else
{
    if(test for Post)
    {

    }
    else
    {
        //set login_error
    }
}

*/

?>


<?php include_once 'header_login.php'; ?>

<div class="login-form">
    <form action="/examples/actions/confirmation.php" method="post">
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
            <input type="text" class="form-control" placeholder="Username" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="Password" required="required">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Log in</button>
        </div>  
    </form>
</div>  

<?php include_once 'footer_login.php'; ?>

