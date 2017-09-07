<?php
session_start();
require_once "../../../includes/DatabaseHandler.php";
require_once "../../../includes/UploadHandler.php";

$upload = new UploadHandler();
if ($upload->saveMedia()) {

    Database::instance()->run_query(
        "UPDATE users
        SET profile_img = ?
        WHERE username = ?;",
        [$upload->getSrc(), $_SESSION["user_session"]]
    )->get_results();

    echo json_encode( ["updated", $upload->getSrc()] );

} else {
    echo json_encode("Could not upload file, please try again later");
    exit;
}
