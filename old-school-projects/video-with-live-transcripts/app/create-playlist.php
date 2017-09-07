<?php
	require_once "../includes/initialize.php";

	$user = new User;
	if ($user->logged_in()) {

		require_once "partials/header.php";
		?>
		<div class="fullscreen-element">

			<div class="close-fullscreen" style="padding: 20px;">
				<a href="profile.php" style="color: rgba(0, 0, 0, 0.8);">
					<i class="fa fa-chevron-circle-left" style="font-size: 70px;"></i>
				</a>
			</div>

			<form class="create-playlist-form">
			    <input name="playlist-title" type="text" class="create-playlist-title" placeholder="title">
			    <textarea name="playlist-desc" class="create-playlist-desc" placeholder="description"></textarea>
			    <input class="create-playlist-submit" type="submit" value="create">
			</form>

			<script type="text/javascript" src="js/ajax-request.js"></script>
			<script type="text/javascript">
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

		</div>

<?php
		require_once "partials/footer.php";
	}
?>
