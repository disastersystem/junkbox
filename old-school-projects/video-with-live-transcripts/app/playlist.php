<?php
	require_once "../includes/initialize.php";

	$user = new User;

	$Playlist = new Playlist;
	$Playlist->get_playlist_videos($_GET['id']);
	$videos = $Playlist->get_data();

	$Playlist->get_playlist_by_id($_GET['id']);
	$playlist = $Playlist->get_data();

	require_once "partials/header.php";
?>

<?php
	# if the user viewing the playlist is the playlist owner, let him edit the title and description
	if ($user->user_data()[0]->id == $playlist[0]->user_id):
?>
	<div class="row playlist-description">
		<div class="column edit">
			<form class="create-playlist-form" method="post" action="ajax-requests/edit-playlist-meta.php">
				<input name="playlist-title" type="text" class="create-playlist-title"
					placeholder="title" value="<?php echo safe_output($playlist[0]->title); ?>">
				<textarea name="playlist-desc" class="create-playlist-desc" placeholder="description"><?php echo safe_output($playlist[0]->description); ?></textarea>
				<input type="hidden" name="playlist-id" value="<?php echo safe_output($playlist[0]->id); ?>">
				<input type="submit" value="update" style="margin-top: 10px;">
			</form>
		</div>
	</div>
<?php else: ?>
	<h2><?php echo safe_output($playlist[0]->title); ?></h2>
	<div class="playlist-description"><?php echo safe_output($playlist[0]->description); ?></div>
<?php endif; ?>

<?php if (!empty($videos)): ?>
	<p style="text-align:center; margin-bottom: 50px;">Drag the videos to reorder its position.</p>
	<div id="simpleList" class="list-group">

	    <?php foreach($videos as $video): ?>

			<div class="list-group-item" data-id="<?php echo safe_output($video->sort_order); ?>" data-playlist="<?php echo safe_output($playlist[0]->id); ?>">
				<a href="watch.php?id=<?php echo safe_output($video->id); ?>">
					<h4><?php echo safe_output($video->title); ?></h4>
					<div class="vid">
						<i class="fa fa-play-circle-o fa-3x play-button"></i>
					</div>
				</a>
				<a href="ajax-requests/remove-video-from-playlist.php?v_id=<?php echo safe_output($video->id); ?>&p_id=<?php echo safe_output($playlist[0]->id); ?>" class="remove-video-from-playlist">
					<div class="meta">
						<?php echo safe_output( date("jS F, Y", strtotime($video->uploaded)) ); ?>
						<i class="fa fa-times"></i>
					</div>
				</a>
			</div>

	    <?php endforeach; ?>

	</div>

	<script type="text/javascript" src="js/libs/sortable/Sortable.min.js"></script>
	<script type="text/javascript">
		// our sotable plugin makes the videos sortable
		// we send an ajax request to update the video sort order once a video is dragged and dropped
		Sortable.create(simpleList, {
			onEnd: function (evt) {
				var newPos = evt.newIndex + 1; // element's new index within parent + 1
				var oldPos = evt.oldIndex + 1; // element's old index within parent + 1
				var pId = evt.item.getAttribute('data-playlist');

				// type, url, send data, container to append message
				ajaxRequest(
					"POST",
					"ajax-requests/change-playlist-video-order.php",
					{
						newPosition: newPos,
						playlistId: pId,
						oldPosition: oldPos
					},
					false,
					false
				);
			}

		});
	</script>

<?php else: ?>
    <p style="text-align: center;">
		This playlist is empty and hollow (just like your soul).
		<br>Find a video, and select the playlist from the "add to playlist" dropdown under the video.
	</p>
<?php endif; ?>

<script type="text/javascript" src="js/ajax-request.js"></script>
<script type="text/javascript">
	$('.create-playlist-form').on("submit", function(e) {
		e.preventDefault();

		// type, url, send data, container to append message
		ajaxRequest(
			"POST",
			"ajax-requests/edit-playlist-meta.php",
			new FormData($(this)[0]),
			'.ajaxMessageContainer'
		);
	});

	$('.remove-video-from-playlist').on("click", function(e) {
		e.preventDefault();

		if (confirm("Remove video?")) {
			// type, url, send data, container to append message
			ajaxRequest("GET", $(this).attr('href'), false, ".ajaxMessageContainer");
		}
	});
</script>

<?php
		require_once "partials/footer.php";
?>
