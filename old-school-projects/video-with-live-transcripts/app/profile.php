<?php
	require_once "../includes/initialize.php";

	$user = new User;
 	if ($user->logged_in()) {

		$Video = new Video;
	    $Video->get_users_videos($user->user_data()[0]->id);
		$videos = $Video->get_data();

		$Playlist = new Playlist;
		$Playlist->get_users_playlists($user->user_data()[0]->id);
		$playlists = $Playlist->get_data();

		require_once "partials/header.php";
?>

<div id="column-wrapper">

	<div id="content">

		<nav class="profile-menu" style="text-align: center; margin: 60px 0 80px 0;">
			<a style="border: 1px solid #bbb; padding: 10px 20px; text-decoration: none;" href="upload.php">
				<span style="padding-right: 5px;">upload video</span>
				<i class="fa fa-film"></i>
			</a>
		</nav>

		<h3>videos</h3>

		<?php if (!empty($videos)): ?>
			<?php foreach($videos as $video): ?>
				<div class="row">
					<div class="column stuff">
						<div class="subitem" style="padding: 0;">
							<form class="video-title-form">
								<input type="text" name="video-title" value="<?php echo safe_output($video->title); ?>" class="video-title-text" placeholder="--no video title--">
								<input type="hidden" name="video-id" value="<?php echo safe_output($video->id); ?>">
								<input type="submit" class="video-title-submit" value="save" style="border-left: 0;">
							</form>
						</div>

						<a href="watch.php?id=<?php echo safe_output($video->id); ?>" style="text-decoration: none;">
							<div class="subitem vid" style="width: 97%;">
								<i class="fa fa-play-circle-o play-button" style="font-size: 70px;"></i>
							</div>
						</a>

						<div class="subitem">
							<div style="display: flex;">
								<select style="border: 1px solid #bbb; padding-left: 15px; padding-right: 15px;">
									<?php
										$Video->get_video_transcripts($video->id);
										$transcripts = $Video->get_data();
										if (!empty($transcripts)) {
											foreach($transcripts as $transcript) {
												echo "<option>" . safe_output($transcript->srclang) . "</option>";
											}
										} else {
											echo "<option> --No transcripts-- </option>";
										}
									?>
								</select>

								<a style="border: 1px solid #bbb; border-left: 0;" href="upload-transcript.php?id=<?php echo safe_output($video->id); ?>" class="add-transcript-button">
									add transcript
								</a>
							</div>
						</div>
					</div>

					<div class="column edit"></div>
				</div> <!-- /row -->

			<?php endforeach; ?>
		<?php else: ?>
			<p style="text-align: center;">You do not have any uploaded videos yet.</p>
		<?php endif; ?>
	</div>

	<div id="playlist-content">

		<nav class="profile-menu" style="text-align: center; margin: 60px 0 80px 0;">
			<a style="border: 1px solid #bbb; padding: 10px 20px; text-decoration: none;" href="create-playlist.php">
				<span style="padding-right: 5px;">create playlist</span>
				<i class="fa fa-list-ul"></i>
			</a>
		</nav>

		<h3>playlists</h3>

		<div id="playlists">
			<?php if (!empty($playlists)): ?>
				<?php foreach($playlists as $playlist): ?>
					<a href="playlist.php?id=<?php echo safe_output($playlist->id); ?>">
						<div class="row playlist-list">
							<?php echo safe_output($playlist->title); ?>
						</div>
					</a>
				<?php endforeach; ?>
			<?php else: ?>
				<p style="text-align: center;">You have not created any playlists yet.</p>
			<?php endif; ?>
		</div>
	</div>

</div> <!-- /column-wrapper -->

<script type="text/javascript" src="js/ajax-request.js"></script>
<script type="text/javascript">
	$('.video-title-form').on("submit", function(e) {
		e.preventDefault();

		// type, url, send data, container to append message
		ajaxRequest(
			"POST",
			"ajax-requests/update-video-title.php",
			new FormData($(this)[0]),
			'.ajaxMessageContainer'
		);
	});

	$('.create-playlist-form').on("submit", function(e) {
		e.preventDefault();

		// type, url, send data, container to append message
		ajaxRequest(
			"POST",
			"ajax-requests/create-playlist.php",
			new FormData($(this)[0]),
			'.ajaxMessageContainer'
		);

		// empty the fields
		$('.create-playlist-title').val('');
		$('.create-playlist-desc').val('');
	});
</script>

<?php
		require_once "partials/footer.php";
	} else {
		# if the user is not logged in
		redirect("index.php");
	}
?>
