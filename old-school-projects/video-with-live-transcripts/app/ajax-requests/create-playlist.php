<?php
require_once "../../includes/initialize.php";

$user = new User;
if ($user->logged_in()) {

    $Validation = new Validation();
    # The unique rule checks whether the email entered already exists in
    # the users table. The database has a UNIQUE index, but this way we can give the user feedback.
    $validated = $Validation->check_values($_POST, [
        "playlist-title" => [
            "required" => true
        ]
    ]);

    if ($validated->passed()) {

        $title = $_POST['playlist-title'];
        $desc = $_POST['playlist-desc'];

        $User = new User;
        $user_id = $User->user_data()[0]->id;

        $Playlist = new Playlist;
        if ($Playlist->create_playlist($title, $desc, $user_id)) {
            echo '{"success":"Playlist created."}';
        } else {
            echo '{"error":"Vote Donald Trump 2016"}';
        }

    } else {
        # If the validation failed.
        $errors = "";
        foreach ($validated->get_errors() as $error) {
            $errors .= $error . "<br>";
        }

        # return the errors to the ajax request calling this page
        echo '{"error":"' . $errors . '"}';
    }



} else {
    # if the user is not logged in
    echo '{"error":"You\'re not logged in."}'; exit;
}
