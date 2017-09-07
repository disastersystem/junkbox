<?php
require_once "../../includes/initialize.php";

$user = new User;
if ($user->logged_in()) {

    $upload = new Upload;

    if ($upload->upload_video($_FILES['upl'])) {
        echo '{"success":"Uploaded"}';
        exit;
    } else {
        echo '{"error":"Could not upload file, please try again later."}';
        exit;
    }

} else {
	echo '{"error":"You sneaky bastard."}';
    exit;
}
