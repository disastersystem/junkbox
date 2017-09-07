<div class="modal modalEditUser" tabindex="-1" post-id = "0" role="dialog" aria-labelledby="myModalLabel" style="padding: 0;">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>

				<h4 class="modal-title" id="myModalLabel">Edit profile information</h4>
			</div>
			<div class="modal-body">

				<form style="text-align: center;" action="API/update/updateProfileImage.php" method="post" enctype="multipart/form-data" class="upload-form" id="upload-form">
					<h4 style="text-align: center; margin: 30px 0;">Change profile picture</h4>

					<div class="upload-container">
						<div class="upload-choices">
							<div class="upload-button">
								<input type="file" id="inputcamera" class="inputfile" name="camera[]" accept="image/*" capture>
								<!-- <span class="hint-block">Camera</span> -->
								<label for="inputcamera" class="inputlabel">
									<div class="upload-icon">
										<i class="fa fa-camera"></i>
									</div>
								</label>
							</div>

							<div class="upload-button">
								<input type="file" id="inputgallery" class="inputfile" accept="image/*" name="media[]">
								<!-- <span class="hint-block">Gallery</span> -->
								<label for="inputgallery" class="inputlabel">
									<div class="upload-icon">
										<i class="fa fa-upload"></i>
									</div>
								</label>
							</div>
						</div>
						<div class="preview-window">
							<?php if(!empty($user_info[0]->profile_img)): ?>
								<div class="preview-window">
									<img style="height: 100%; width: auto; display: block; margin: 0 auto;"
										src="uploads/posts/thumb_<?php echo $user_info[0]->profile_img; ?>"
										class="change-profile-image">
								</div>
							<?php else: ?>
								<div class="preview-window">
									<img style="height: 100%; width: auto; display: block; margin: 0 auto;" src="img/default.png" class="change-profile-image">
								</div>
							<?php endif; ?>
						</div>
					</div>


					<div class="bb">
						<input type="submit" style="margin: 20px 0;" value="Save" class="change-picture-button" disabled="disabled">
					</div>

				</form>

				<div class="row status-message"></div>

				<form action="API/update/changePassword.php" method="post" class="upload-form" id="upload-form">
					<h4 style="text-align: center; margin-top: 40px; padding: 30px 0 0 0; border-top: 1px solid #ccc;">Change password</h4>
					<div class="passwordContainer">
						<label>Current Password:</label>
						<input name="currentPassword" type = "password" role = "curPwd" placeholder = "current password">

						<label>New Password:</label>
						<input name="newPassword" type = "password" role = "newPwd" placeholder = "new password">

						<label>Confirm Password:</label>
						<input name="confirmNewPassword" type = "password" role = "conPwd" placeholder = "confirm password" class = "disabledInput" disabled>

						<div style="text-align: center; margin-top: 30px;">
							<input type = "submit" class = "saveSettings" value = "Save">
						<div>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>

<!-- Catches the selected file and displays it on the page -->
<script src="js/camera2.js"></script>
<script>
	$('.upload-form').on("submit", function(event) {
		event.preventDefault();

		var form = $(this);
		var formData = new FormData(form[0]);

		var formURL = form.attr("action");

		$.ajax({
			type: 'POST',
			url: formURL,
			data: formData,
			dataType: 'json',
			encode: true,
			cache: false,
			contentType: false,
			processData: false
		})
		.done(function(response) {
			$(".status-message").empty().html('<h2>' + response[0] + '</h2>');
			// setInterval(function() {
			// 	$(".status-message").empty();
			// }, 3000);
			//location.reload();

			if (response[1]) {
				$('.profile-img').attr("src", "uploads/posts/thumb_" + response[1]);
			}
		})
		.fail(function(response) {
			$(".status-message").empty().html("Something went wrong " + response.responseText);
		});

	});
</script>
