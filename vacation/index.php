<?php 
    session_start();
    
    // Action
    $action = (isset($_REQUEST['action'])) ? $_REQUEST['action'] : '';
    // document root
    $rootDir = $_SERVER['DOCUMENT_ROOT'];
    
    // Require models
    require_once($rootDir.'/models/file.php');
    require_once($rootDir.'/models/vacation.php');
    require_once($rootDir.'/models/review.php');
    
    // Objects
    $vacation = new Vacation();
    $review = new Review();
    $file = new File();
    
    
    if (!isset($_SESSION['username'])) {
        header('location: /signup/');
    }

    switch($action) {
        case 'post_vacation':
            $user_id = $_SESSION['user_id'];
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
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
            
            // Add record to DB
            $exists = $vacation->addVacation($name, $filePath, $description);
            
            if (!empty($exists)) {
                
                include $rootDir.'/views/vacation-form.php';
            }
            
            break;
        
        case 'view_vacation':
            // ID FROM REQUEST
            $id = filter_input(INPUT_GET, 'vacId', FILTER_SANITIZE_STRING);

            // Get vacation spot data plus its reviews
            $vac = $vacation->getOneVacation($id);
            $reviews = $review->getVacationReviews($id);

            
            include $rootDir.'/views/vacation_reviews.php';
            break;
        
        case 'post_review':
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
            $rating = filter_input(INPUT_POST, 'rating', FILTER_SANITIZE_NUMBER_INT);
            $body = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_STRING);
            $vacationId = filter_input(INPUT_POST, 'vacId', FILTER_SANITIZE_NUMBER_INT);
            
            
            try { 
                $review->postReview($_SESSION['user_id'], $vacationId, $title, $body, $rating); 
            }
            catch (Exception $e) { 
                $error = $e->getMessage;
                include $rootDir.'/views/vacation_reviews.php';
            }
            
            break;
        
        default: 
            include $rootDir.'/views/vacation-form.php';
            break;
    }
    
    
?>