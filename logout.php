
<?php
//TO MODIFY

/*
@include 'config.php';
session_start();
session_unset();
session_destroy();*/

//$cookie_name1='email';
//$cookie_name2='password';
unset($_COOKIE['email']);
unset($_COOKIE['password']);
setcookie('email', '', time() - 3600);
setcookie('password', '', time() - 3600);

header('location:index.php');

?>
