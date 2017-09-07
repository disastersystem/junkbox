<?php
    session_start();
    require_once '../../user/init.php';
    include_once '../../user/user_class.php';
    $user = new USER($DB_con);

    if ( $user->logout() ) {
        echo json_encode("true");
    } else {
        
    }
?>
