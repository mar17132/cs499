<?php

session_start();


if(!getSession() && 
 strcmp($_SERVER['SCRIPT_NAME'],'/final_project/site/documents/login.php') != 0)
{
    header("location:../documents/login.php");
}

function getSession()
{
    return isset($_SESSION['loggedin']) ? $_SESSION['loggedin'] : false;
}

function setLoginSession($userArray)
{
    $_SESSION['loggedin'] = true;
    $_SESSION['uname'] =$userArray['uname'];
    $_SESSION['type'] = $userArray['type'];
    $_SESSION['uid'] = $userArray['id'];

}

function disLoginSession()
{
    unset($_SESSION['loggedin']);
    unset($_SESSION['uname']);
    unset($_SESSION['type']);
    unset($_SESSION['uid']);
}




?>

