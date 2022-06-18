<?php
require_once "connection.php";
$table = "cafes";
$msg = "";

if(isset($_POST['submit'])){
    if (!file_exists('./images/')) {
        mkdir('./images', 0777, true);
    }
    $uploadType=$_POST['upload_type'];
    
    $name=$_POST['cafe_name'];
    $loc=$_POST['cafe_location'];
    $desc=$_POST['cafe_description'];
    
    if($uploadType == "local"){
        $target="./images/". md5(uniqid(time())).basename($_FILES['image']['name']);
        
        if(! move_uploaded_file($_FILES['image']['tmp_name'],$target)){
            $msg="File not saved";
        }
    }
    else if($uploadType == "public"){
        $target = $_POST['image'];
        if(substr($target, 0, 4) != "http"){
            $msg = "Invalid URL!";
        }
    }
    
    if($msg == ""){
        $sql="INSERT INTO $table(name, location, description, image, uploadType)VALUES('$name','$loc','$desc','$target','$uploadType')";
        mysqli_query($con,$sql);
        
        header('location:profile.php');
    }
    else{
        echo $msg;
        echo "<br/><a href='profile.php'>Back</a>";
    }  
    
}
?>