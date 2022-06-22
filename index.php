<?php
    session_start();
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
        <title>CaféBook</title>
    </head>
    
    <body>
        <?php 
        
        require_once 'securityHandler.php';

        if(isset($_SESSION['email'])){ 
            echo PageHandler::getLoggedInPage($_COOKIE['email']);
        }else if(isset($_COOKIE['email']) && isset($_COOKIE['token'])){
            if(checkUserToken($_COOKIE['email'], $_COOKIE['token'])){
                $_SESSION['email'] = $_COOKIE['email'];
                echo PageHandler::getLoggedInPage($_COOKIE['email']);
            }  
        }
        else{
            echo PageHandler::getHomePage();
        }

        ?>
    </body>
</html>
