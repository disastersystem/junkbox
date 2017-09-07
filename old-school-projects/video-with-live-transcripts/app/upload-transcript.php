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

			<form id="upload" method="post" action="ajax-requests/upload-transcript.php?id=<?php echo safe_output($_GET['id']); ?>&lang=en" enctype="multipart/form-data">
				<div id="drop">
					Language<br>
					<select name="language" style="padding: 5px; margin-top: 10px;" class="language-select">
						<option value="choose">Choose Language</option>
						<option value="en">English</option>
						<option value="de">German</option>
						<option value="no">Norwegian</option>
						<option value="fr">Frence</option>
					</select>

					<div style="margin-top: 20px;"></div>
					<a style="display: none;" class="browse-button">Browse</a> <!-- or drop here -->
					<input type="file" name="upl">

					<script>
						$('.language-select').on('change', function() {
							$('.browse-button').css("display", "inline-block");
						});
					</script>
				</div>
				<ul><!-- The file uploads will be shown here --></ul>
			</form>
		</div>
		<!-- JavaScript Includes -->
		<script src="js/libs/jquery.knob.js"></script>

		<!-- jQuery File Upload Dependencies -->
		<script src="js/libs/jquery.ui.widget.js"></script>
		<script src="js/libs/jquery.iframe-transport.js"></script>
		<script src="js/libs/jquery.fileupload.js"></script>

		<!-- Our main JS file -->
		<script src="js/libs/script.js"></script>


		<?php

		require_once "partials/footer.php";
	}
