<?php
session_start();

require_once "../../../includes/DatabaseHandler.php";
require_once "../../../includes/UploadHandler.php";

$event_id = $_POST["event_id"];
$media_type = $_POST["media_type"];

$posts_text = isset($_POST["media-caption"]) ? $_POST["media-caption"] : "";
$user = isset($_SESSION["user_session"]) ? $_SESSION["user_session"] : "none";

$upload = new UploadHandler();

if ($upload->saveMedia()):
    $db_response = Database::instance()->run_query(
        "INSERT INTO media (src) VALUES (?)",
        [$upload->getSrc()]
    );

    if (!$db_response->get_error()):
        $media_id = $db_response->get_last_inserted_id();
        $current_time = date('Y-m-d H:i:s');

        $create_post = Database::instance()->run_query(
            "INSERT INTO posts (event_id, media_id, media_type, username, user_type, post_time, post_text)
            VALUES (?, ?, ?, ?, ?, ?, ?)",
            [$event_id, $media_id, $media_type, $user, 1, $current_time, $posts_text]
        );

        if (!$create_post->get_error()):
            echo json_encode("File uploaded"); exit();
        else:
            echo json_encode("Could not upload file, please try again later"); exit();
        endif;

    else:
        echo json_encode("Could not upload file, please try again later"); exit();
    endif;

else:
    echo json_encode("Could not upload file, please try again later"); exit();
endif;
