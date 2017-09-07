<?php
	require_once "../includes/DatabaseHandler.php";

	$user = $_SESSION["user_session"];

	$user_posts = Database::instance()->run_query(
		"SELECT * FROM posts
		INNER JOIN media
		ON posts.media_id = media.media_id
		INNER JOIN users
	    ON users.username = posts.username
		WHERE posts.username = ?
		ORDER BY posts.post_id DESC;",
		[$user]
	);

	if ($user_posts->get_count() > 0)
	{
		echo '<div class="row" style="margin-bottom: 30px;"><h3>Your posts</h3></div>';
		
		foreach ($user_posts->get_results() as $post)
		{
			if ($post->media_type == "1") {
				echo '<div class="img-container" postUsername="' . $post->username . '" postProfileImage="' . $post->profile_img . '" postCreated="' . $post->post_time . '" postID="' . $post->post_id . '" postTitle="' . $post->post_text . '">';
					echo '<img src="uploads/posts/thumb_' . $post->src . '" data-full="uploads/posts/' . $post->src . '">';
				echo '</div>';
			}

			if ($post->media_type == "2") {
				echo '<div class="img-container" postUsername="' . $post->username . '" postProfileImage="' . $post->profile_img . '" postCreated="' . $post->post_time . '" postID="' . $post->post_id . '" postTitle="' . $post->post_text . '">';
					echo '<video src="uploads/posts/' . $post->src . '" poster="img/play-video.png"></video>';
				echo '</div>';
			}
		}
	}
	else echo "<div class = 'minorError' style = 'margin-top: 0px; width: initial;  margin-left: -80px;' >You have no posts,<br>You're a freak</div>";
