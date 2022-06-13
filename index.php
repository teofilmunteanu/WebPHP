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
        <title>Page1</title>
    </head>
    
    <body>
        <?php 
        
        require_once 'securityHandler.php';
        
        if(isset($_COOKIE['email']) && isset($_COOKIE['token'])){
            if(isset($_SESSION['email']) || checkUserToken($_COOKIE['email'], $_COOKIE['token'])){
                echo PageHandler::getLoggedInPage($_COOKIE['email']);
            } 
        } else{
            echo PageHandler::getHomePage();
        }
        ?>
        <a href =<?php echo "http://localhost/Examen1/0index.php"?>>asdfasdf</a>
    </body>
</html>
