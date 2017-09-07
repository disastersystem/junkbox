<?php

require_once "../../../includes/DatabaseHandler.php";

$event_id = $_GET["event_id"];

$athletes_posts = Database::instance()->run_query(
    "SELECT *
    FROM posts
    INNER JOIN media
    ON posts.media_id = media.media_id
    INNER JOIN users
    ON users.username = posts.username
    WHERE posts.event_id = ?
    AND posts.user_type = 2
    ORDER BY posts.post_id DESC;",
    [$event_id]
)->get_results();


echo json_encode($athletes_posts);
