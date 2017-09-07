<?php
    session_start();
    require_once '../../user/init.php';
    include_once '../../user/user_class.php';
    $user = new USER($DB_con);

    if ( $user->login($_POST["txt_username"], $_POST["txt_password"]) ) {
        echo json_encode("true");
    } else {
        echo json_encode($user->get_errors());
    }
?>
