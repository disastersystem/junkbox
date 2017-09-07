<?php
	require_once "../includes/initialize.php";

	# check whether the user got here with a search request
	if (isset($_GET['search'])) {
		$Search = new Search("%" . $_GET['search-term'] . "%");

		# search for vidoes matching the users search term
		$Search->search_videos();
		$videos = $Search->search_data();

		# search for playlists matching the users search term
		$Search->search_playlists();
		$playlists = $Search->search_data();

	} else {
		$Video = new Video;
		$Video->get_all_videos();
		$videos = $Video->get_data();
	}

	require_once "partials/header.php";
?>

<div class="search-menu-container">
	<div class="search-menu">
		<form method="get" action="index.php" class="search-form" style="padding: 0; margin: 0;">
			<input type="text" name="search-term" placeholder="search videos and playlists" style="width: 350px;">
			<input type="submit" name="search" value="Search" style="margin-left: 4px;">
		</form>
	</div>
</div>

<div style="margin-top: 60px; display: block;">

	<div class="list-group">

		<?php if (!empty($videos)): ?>
			<?php foreach($videos as $video): ?>

				<div class="list-group-item">
					<a href="watch.php?id=<?php echo safe_output($video->id); ?>">
						<h4><?php echo safe_output($video->title); ?></h4>
						<div class="vid">
							<i class="fa fa-play-circle-o fa-3x play-button"></i>
						</div>
						<p><?php echo safe_output( date("jS F, Y", strtotime($video->uploaded)) ); ?></p>
					</a>
				</div>

			<?php endforeach; ?>
		<?php else: ?>

			<p style="text-align: center;">No videos. Booooo.</p>

		<?php endif; ?>
	</div>


	<?php if (isset($_GET['search'])): ?>
		<div class="list-group" style="display: block; max-width: 500px; margin: 0 auto;">

			<?php if (!empty($playlists)): ?>
				<?php foreach($playlists as $playlist): ?>

					<a href="playlist.php?id=<?php echo safe_output($playlist->id); ?>">
						<div class="playlist-list" style="padding: 0px 20px 20px 30px;">
							<h4><?php echo safe_output($playlist->title); ?></h4>
							<div><?php echo safe_output($playlist->description); ?></div>
						</div>
					</a>

				<?php endforeach; ?>
			<?php else: ?>
				<p style="text-align: center;">No playlist matches search.</p>
			<?php endif; ?>

		</div>
	<?php endif; ?>

</div> <!-- /column-wrapper -->


<?php require_once "partials/footer.php"; ?>
