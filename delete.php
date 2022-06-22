<?php
require_once 'connection.php';
$sql1="SELECT * FROM cafes WHERE id='{$_GET['id']}'";
$query=mysqli_query($con, $sql1) or die(mysqli_error($con));
$row=mysqli_fetch_array($query);
unlink($row["image"]);
$sql2="DELETE FROM cafes WHERE id='{$_GET['id']}'";
$query=mysqli_query($con, $sql2) or die(mysqli_error($con));
if($_GET['page']=='profile'){
    header('location:profile.php?content_type='.$_GET['last_content_type']);
}
else{
    header('location:index.php');
}

?>