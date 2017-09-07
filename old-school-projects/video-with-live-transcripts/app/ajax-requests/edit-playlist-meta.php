<?php
require_once "../../includes/initialize.php";

$user = new User;
if ($user->logged_in()) {

    $playlist_id = $_POST['playlist-id'];
    $playlist_desc = $_POST['playlist-desc'];
    $playlist_title = $_POST['playlist-title'];

    $Playlist = new Playlist;

    # first check if user owns playlist
    if ($Playlist->user_owns_playlist($user->user_data()[0]->id, $playlist_id)) {

        if ($Playlist->update( [$playlist_title, $playlist_desc, $playlist_id]) )
    		echo '{"success":"Playlist informasjon updated."}';
        else
    		echo '{"error":"Something mysterious went wrong."}';

    } else {
        echo '{"error":"This ain\'t yo\' playlist."}'; exit;
    }

} else {
	# if the user is not logged in
	echo '{"error":"You\'re not logged in"}';
    exit;
}
