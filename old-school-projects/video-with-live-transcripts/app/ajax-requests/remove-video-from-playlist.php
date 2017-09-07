<?php
require_once "../../includes/initialize.php";

$user = new User;
if ($user->logged_in()) {

    $playlist_id = $_GET['p_id'];
    $video_id = $_GET['v_id'];

    $Playlist = new Playlist;

    # first check if user owns playlist
    if ($Playlist->user_owns_playlist($user->user_data()[0]->id, $playlist_id)) {

        if ($Playlist->remove_from_playlist($playlist_id, $video_id))
    		echo '{"success":"Video removed from playlist."}'; exit;
        else
    		echo '{"error":"Something mysterious went wrong."}'; exit;

    } else {
        echo '{"error":"This ain\'t yo\' playlist."}'; exit;
    }

} else {
	# if the user is not logged in
	echo '{"error":"You\'re not logged in."}';
    exit;
}
