<?php
require_once "../../includes/initialize.php";

$user = new User;
if ($user->logged_in()) {

    $upload = new Upload;

    $video_id = @$_GET['id'];
    $transcript_lang = @$_POST['language'];

    if ($upload->add_transcript($_FILES['upl'], $video_id, $transcript_lang)) {
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
