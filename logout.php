<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/models/user.php');
    
    User::logout();
    
    // return home
    header('Location: http://'.$_SERVER['SERVER_NAME']);  
?>