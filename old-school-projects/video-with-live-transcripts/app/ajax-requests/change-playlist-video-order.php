<?php
require_once "../../includes/initialize.php";

$user = new User;
if ($user->logged_in()) {

    $playlist_id = $_POST['playlistId'];
    $new_position = $_POST['newPosition'];
    $old_position = $_POST['oldPosition'];

    $Playlist = new Playlist;

    # check if the user owns the playlist first
    if ($Playlist->user_owns_playlist($user->user_data()[0]->id, $playlist_id)) {

        $Playlist->change_sort_order(
                            $playlist_id,
                            $new_position,
                            $old_position
                        );
    } else {
        echo '{"error":"This ain\'t yo playlist."}'; exit;
    }

} else {
	# if the user is not logged in
	echo '{"error":"You\'re not logged in."}'; exit;
}
