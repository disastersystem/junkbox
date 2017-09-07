<?php
require_once "../../includes/initialize.php";

$user = new User;
if ($user->logged_in()) {

    if ($_POST['video-id']) {

		$video_title = trim($_POST['video-title']);
		$video_id = $_POST['video-id'];

        $video =  Database::instance()->run_query(
            "SELECT * FROM videos WHERE id = ?", [$video_id]
        )->get_results();

        # check if the user trying to update the title actually
        # is the owner of the video
        if ($video[0]->user_id == $user->user_data()[0]->id) {
            $video =  Database::instance()->run_query(
                "UPDATE videos SET title = ? WHERE id = ?", [$video_title, $video_id]
            )->get_results();

            echo '{"success":"Updated."}'; exit;
        } else {
			echo '{"error":"You sneaky bastard."}'; exit;
        }
    }
} else {
	echo '{"error":"You sneaky bastard."}'; exit;
}
