<?php
require_once "connection.php";
session_start();
$table = "cafes";
$msg = "Saved";

if(isset($_POST['submit'])){
    $uploadType=$_POST['upload_type'];
    
    $name=$_POST['cafe_name'];
    $loc=$_POST['cafe_location'];
    $desc=$_POST['cafe_description'];
    $email=$_SESSION['email'];
    
    if($name=="" || $loc=="" || $desc==""){
        $msg="All fields are mandatory!";
    }
    else{
        $cafesSql="SELECT * FROM cafes WHERE name='$name' AND emailAssigned='$email';";
        $cafesResult=mysqli_query($con, $cafesSql)or die(mysqli_error($con));

        if(mysqli_num_rows($cafesResult) == 0){
            if($uploadType == "local"){
                if (!file_exists('./images/')) {
                    mkdir('./images', 0777, true);
                }

                $target="./images/". md5(uniqid(time())).basename($_FILES['image']['name']);

                if(! move_uploaded_file($_FILES['image']['tmp_name'],$target)){
                    $msg="File not saved!";
                }
                else{
                    $finfo = finfo_open(FILEINFO_MIME_TYPE);
                    $mimetype = finfo_file($finfo, $target);
                    $fileTypes = array("jpg", "jpeg", "png", "gif");
                    $ok = false;
                    foreach($fileTypes as $ft){
                        if($mimetype == 'image/'.$ft){
                            $ok = true;
                        }
                    }
                    if(! $ok){
                        $msg="Invalid file format!";
                    }
                }    
            }
            else if($uploadType == "public"){
                $target = $_POST['image'];
                if(substr($target, 0, 4) != "http"){
                    $msg = "Invalid URL!";
                }

                $fileTypes = array("jpg", "jpeg", "png", "gif");
                $ok = false;
                foreach($fileTypes as $ft){
                    if(str_ends_with($target, $ft)){
                        $ok = true;
                    }
                }
                if(! $ok){
                    $msg = "URL must point to an image! It should end in jpg/jpeg/png/gif.";
                }
            }
        }
        else{
            $msg = "Caffe already added to this user!";
        }
    }
    
    
    if($msg == "Saved"){
        $sql="INSERT INTO $table(name, location, description, image, uploadType, emailAssigned) VALUES('$name','$loc','$desc','$target','$uploadType', '$email')";
        mysqli_query($con,$sql);
        
        header('location:profile.php?content_type='.$uploadType);
    }
    
}
?>

<html>
    <head>
        <title>Upload Cafe</title>
        <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/css1/mystyles2.css" rel="stylesheet">

    </head>
    
    <body>
        <div class="wrapper">
            <div id="formContent">
                <?php 
                    echo $msg;
                ?>
                <br/>
                <a type="button" class="btn btn-primary" href='profile.php'>Back</a>
            </div>
        </div>
    </body>
</html>