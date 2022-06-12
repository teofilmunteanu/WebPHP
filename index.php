<?php
    class PageHandler{
        public static function getHomePage(){
            return file_get_contents('./indexMain.php');
        }

        public static function getLoggedInPage($userEmail){
            return file_get_contents('./indexLoggedIn.php');
        }
    }
?>

<html>
    <head>
        <title>Page1</title>
    </head>
    
    <body>
        <?php 
        if(isset($_COOKIE['email']) && isset($_COOKIE['password'])){
            echo PageHandler::getLoggedInPage($_COOKIE['email']);
        } else{
            echo PageHandler::getHomePage();
        }
        ?>

    </body>
</html>
