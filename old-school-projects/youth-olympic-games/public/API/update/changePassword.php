<?php
session_start();
require_once "../../../includes/DatabaseHandler.php";


$current_password = isset($_POST["currentPassword"]) ? $_POST["currentPassword"] : "";
$new_password = isset($_POST["newPassword"]) ? $_POST["newPassword"] : "";
$confirm_new_password = isset($_POST["confirmNewPassword"]) ? $_POST["confirmNewPassword"] : "";

$user = Database::instance()->run_query(
    "SELECT * FROM users
    WHERE username = ?;",
    [$_SESSION["user_session"]]
)->get_results();

if (!empty($new_password) && !empty($confirm_new_password)) {

    if ( password_verify($current_password, $user[0]->password) ) {

        if ($new_password == $confirm_new_password) {

            $password = password_hash($new_password, PASSWORD_DEFAULT);

            Database::instance()->run_query(
                "UPDATE users
                SET password = ?
                WHERE username = ?;",
                [$password, $_SESSION["user_session"]]
            )->get_results();

            echo json_encode(["Password successfully changed."]);
        } else {
            echo json_encode(["Passwords do not match."]);
        }

    } else {
        echo json_encode(["Wrong current password."]);
    }

} else {
    echo json_encode(["You must fill in a new password and confirm password."]);
}
