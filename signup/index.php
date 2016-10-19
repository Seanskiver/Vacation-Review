<?php 
    // action
    $action = (isset($_REQUEST['action'])) ? $_REQUEST['action'] : '';
    // document root
    $rootDir = $_SERVER['DOCUMENT_ROOT'];
    // Model includes
    require_once($rootDir.'/models/fields.php');
    require_once($rootDir.'/models/validate.php');
    require_once($rootDir.'/models/user.php');
    
    print_r($_SESSSION);
    
    // Validation
    $validate = new Validate();
    $fields = $validate->getFields();
    // Field validation
    $fields->addField('username');
    $fields->addField('password');
    $fields->addField('password_verify');
    $fields->addField('userError');
    
    //User object

    
    
    switch($action) {
        case '':
            include $rootDir.'/views/header.php';
            include $rootDir.'/views/signup-form.php';
            include $rootDir.'/views/footer.php';
            break;
            
        case 'signup':
            // INPUT SANITIZATION
            $username = (string)filter_input(INPUT_POST, 'username');
            $password =  (string)filter_input(INPUT_POST, 'password');
            $password_verify = (string)filter_input(INPUT_POST, 'password_verify');
            // VALIDATION
            $validate->text('username', $username);
            $validate->text('password', $password);
            $validate->text('password_verify', $password_verify);
            $validate->verify('password', $password, $password_verify);
            // CHECK IF USERNAME IS TAKEN
            $validate->userTaken('userError', $username);
            
            // CHECK FOR USERNAME TAKEN ERRORS
            if ($fields->hasErrors()) {
                include $rootDir.'/views/signup-form.php';
            } else {
                $user = new User();
                echo "username: ".$username."&nbsp;&nbsp;&nbsp;&nbsp;password: ".$password."<br>";
                try {
                    $user->createUser($username, $password);    
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
                
                try {
                    $user->login($username, $password);
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
                
                // return home
                header('Location: http://'.$_SERVER['SERVER_NAME']);    
            }
            
            break;
    }
    
    

?>