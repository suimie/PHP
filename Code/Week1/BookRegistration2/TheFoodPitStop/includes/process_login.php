<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ThePitStop_PHP/init.php';

$fmsg = "";
//if (isset($_POST['email']) and isset($_POST['password'])) {
if (filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING) and filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING)){

    //$mypassword = test_input($_POST['password']);
    $mypassword = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

//$password = md5($_POST['password']);
   //$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    //if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $myusername = $email;
    //}

    $count = user_login($myusername, $mypassword);
    
    if ($count > 0) {
        session_start();
        $_SESSION['username'] = $myusername;
        $fmsg = "Succeeded to Login";
        header("location:../index.php?content=home&login=succ");
    } else {
        unset($_SESSION); 
        session_destroy();
        $fmsg = "Invalid Login Credentials.";
        header("location:../index.php?content=login&msg=$fmsg&useremail=$myusername");
    }
}



