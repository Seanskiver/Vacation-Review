<?php 
    session_start();
    
    // Action
    $action = (isset($_REQUEST['action'])) ? $_REQUEST['action'] : '';
    // document root
    $rootDir = $_SERVER['DOCUMENT_ROOT'];
    
    require_once($rootDir.'/models/file.php');
    
    if (!isset($_SESSION['username'])) {
        die("<a href='/login/'>Login</a> or <a href='/signup/'>Sign up </a> to post");
    }

    switch($action) {
        case 'post_vacation':
            $file = new File();
            
            $user_id = $_SESSION['user_id'];
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
            $fileUpload = $_FILES['img_upload'];

            
            // Validate file
            try {
                $file->handle_file($fileUpload);    
            } catch (Exception $e) {
                $error = $e->getMessage();
                include $rootDir.'/views/vacation-form.php';
            }
            
            // upload File
            try {
                $filePath = $file->upload_file($fileUpload);          
            } catch (Exception $e) {
                $error = $e->getMessage();
                include $rootDir.'/views/vacation-form.php';
            }
            
            
            break;
            
        default: 
            include $rootDir.'/views/vacation-form.php';
            break;
    }
    
    
?>