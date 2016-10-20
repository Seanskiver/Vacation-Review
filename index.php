<?php 
    // maintain sesssion
    session_start();
    
    // Model Includes 
    require_once('models/vacation.php');
    $rootDir = $_SERVER['DOCUMENT_ROOT'];
    // action
    $action = (isset($_REQUEST['action'])) ? $_REQUEST['action'] : '';    
    
    include $rootDir.'/views/header.php';

    
    switch($action) {
        default: 
            $vacation = new Vacation();
            
            $vacations = $vacation->getVacations();
            include 'views/vacations.php';
            break;
            
    }
    
include $rootDir.'/views/footer.php';

?>