<?php 
    // maintain sesssion
    session_start();
    
    if (!empty($_SESSION)) {
        print_r($_SESSION)."<br>";
        echo "<a href='logout.php'>Logout</a>";
    } else {
        echo "<a href='/login/'>Login</a><br>";
        echo "<a href='/signup/'>Sign up</a>";
    }
    echo "<br/>";
    
    echo "<a href='/vacation/'>Add a vacation spot</a>";

    

?>