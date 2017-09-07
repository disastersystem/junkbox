<?php
	require_once "../includes/initialize.php";

	$Video = new Video;
	$video = $Video->get_video_by_id($_GET['id']);

	# contruct the video source url here in order to keep the html a little cleaner
	$vid_src = 'videos/' . $video[0]->user_id . '/' . $video[0]->id . '/' . $video[0]->src . '.' . $video[0]->type;

	require_once "partials/header.php";
?>

<div class="video-container">
	<h4 style="font-size: 25px;"><?php echo $video[0]->title; ?></h4>
    <video id="video" preload="metadata" controls>
        <?php if (!empty($video)): ?>
            <source src="<?php echo safe_output($vid_src); ?>" type="video/<?php echo safe_output($video[0]->type); ?>">

			<?php
				$Video->get_video_transcripts($video[0]->id);
				$transcripts = $Video->get_data();
				$tra_src = 'videos/' . $video[0]->user_id . '/' . $video[0]->id . '/';
			?>
			<?php foreach($transcripts as $transcript): ?>
				<track
					id="<?php echo safe_output($video[0]->title) . '_' . safe_output($transcript->srclang) ?>"
					src="<?php echo safe_output($tra_src) . safe_output($transcript->src) . '.' . safe_output($transcript->type); ?>"
					label="<?php echo safe_output($transcript->srclang) . ' subtitles'?>"
					srclang="<?php echo safe_output($transcript->srclang) ?>"
					kind="subtitles" default
				>
			<?php endforeach; ?>
        <?php endif; ?>
        Your browser does not support the <code>video</code> element.
    </video>
	<script type="text/javascript">
		//better having to turn up the volume, then down
		document.getElementsByTagName('video')[0].volume = 0.2;
	</script>

	<!-- transcript textbox -->
	<div id="textbox"></div>

	<?php
		$user = new User; if ($user->logged_in()):
		$Playlist = new Playlist;
		$Playlist->get_users_playlists($user->user_data()[0]->id);
		$playlists = $Playlist->get_data();
	?>
		<select class="playlist-select" name="playlist-select">
			<option>Add to playlist</option>
			<?php foreach($playlists as $playlist): ?>
				<option value="<?php echo safe_output($playlist->id); ?>"><?php echo safe_output($playlist->title); ?></option>
			<?php endforeach;?>
		</select>
		<input type="hidden" value="<?php echo safe_output($video[0]->id); ?>" class="vid-id">
	<?php endif; ?>
	<script type="text/javascript" src="js/ajax-request.js"></script>
	<script type="text/javascript">
		$('.playlist-select').on('change', function(e) {
			e.preventDefault();

			// type, url, send data, container to append message
			ajaxRequest(
				"POST",
				"ajax-requests/add-video-to-playlist.php",
				{ playlistid: $('.playlist-select').val(), videoid: $('.vid-id').val() },
				'.ajaxMessageContainer',
				false
			);
		});
	</script>

	<div id="transcript-buttons">
		Show subtitles:
		<!-- transcript language buttons -->
		<?php foreach($transcripts as $transcript): ?>
			<button id="<?php echo 'button_' . safe_output($transcript->srclang); ?>" class="button_lang" type="button" name="button"><?php echo safe_output($transcript->srclang); ?></button>
		<?php endforeach; ?>
	</div>

	<!-- video upload date -->
	<div class="meta-data">
        <p class="upload-date"><?php echo safe_output( date("jS F, Y", strtotime($video[0]->uploaded)) ); ?></p>
    </div>

	<script type="text/javascript" src="js/video.js"></script>
</div>

<?php require_once "partials/footer.php"; ?>
