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
    // LOGIN FIELDS FOR VALIDATION
    $fields->addField('username');
    $fields->addField('password');
    $fields->addField('password_verify');
    $fields->addField('userError');
    
    
    switch($action) {
        case '':
            include $rootDir.'/views/header.php';
            include $rootDir.'/views/login-form.php';
            include $rootDir.'/views/footer.php';
            break;
            
        case 'login':
            $username = (string)filter_input(INPUT_POST, 'username');
            $password =  (string)filter_input(INPUT_POST, 'password');
            
            $validate->text('username', $username);
            $validate->text('password', $password);
            
            if ($fields->hasErrors()) {
                include $rootDir.'/views/login-form.php';
                break;
            }
            
            $validate->user('userError', $username, $password);
            
            if ($fields->hasErrors()) {
                include $rootDir.'/views/login-form.php';
            } else {
                $user = new User();
                $login = $user->login($username, $password);
                // return home
                header('Location: http://'.$_SERVER['SERVER_NAME']);            
            }
            
            break;
    }


?>