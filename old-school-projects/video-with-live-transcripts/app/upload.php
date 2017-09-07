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

			<p style="text-align: center;">
				Find the videos in you channel after upload
				<br>to edit the title and add transcripts.
			</p>

		    <form id="upload" method="post" action="ajax-requests/video-upload.php" enctype="multipart/form-data">
		        <div id="drop">
		            Drop Here<br>
		            <a>Browse</a>
		            <input type="file" name="upl" multiple>
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
