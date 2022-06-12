
<?php
require_once "connection.php";

if(isset($_COOKIE['email']) && isset($_COOKIE['token'])){
    $email = $_COOKIE['email'];
    $token = $_COOKIE['token'];
    $sql="DELETE FROM usertokens WHERE email='$email' AND token='$token'";
    $query= mysqli_query($con, $sql)or die(mysqli_error($con));
    unset($_COOKIE['email']);
    unset($_COOKIE['token']);
    setcookie('email', '', time() - 3600);
    setcookie('token', '', time() - 3600);
}

session_start();
session_unset();
session_destroy();
header('location:index.php');

?>
