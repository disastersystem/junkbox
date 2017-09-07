<?php
require_once "../../includes/initialize.php";

$user = new User;
if ($user->logged_in()) {

    $playlist_id = $_POST['playlistid'];
    $video_id = $_POST['videoid'];

    $Playlist = new Playlist;
    if ($Playlist->add_to_playlist($playlist_id, $video_id))
		echo '{"success":"Video added to playlist."}';
    else
		echo '{"error":"Something mysterious went wrong."}';

} else {
	# if the user is not logged in
	echo '{"error":"You\'re not logged in."}'; exit;
}
