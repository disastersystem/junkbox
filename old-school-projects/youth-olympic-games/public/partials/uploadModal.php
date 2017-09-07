<div class="modal" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<?php if ($user->is_loggedin()): ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">
					make a post in:
					<span><?php echo strtolower($event[0]->sport_name); ?></span>
				</h4>
			</div>
			<div class="modal-body" style="padding: 0;">
				<div class="row">
					<form action="API/create/uploadMedia.php" style="text-align: center;"method="post" enctype="multipart/form-data" class="upload-form" id="upload-form">
						<div class="row" id="uploadChoices" style="display: inline-block;">
							<!-- <div class="col-sm-4 col-xs-4 input-field">
								<div class="file-upload btn">
									<span class="glyphicon glyphicon-camera"></span>
									<input id="take-picture" class="upload" type="file" name="camera[]" accept="image/*" capture>
								</div>
								<div class="input-label">Take a picture</div>
							</div>

							<div class="col-sm-4 col-xs-4 input-field">
								<div class="file-upload btn">
									<span class="glyphicon glyphicon-facetime-video"></span>
									<input id="take-video" class="upload" type="file" name="video[]" accept="video/*" capture>
								</div>
								<div class="input-label">Record a video</div>
							</div>

							<div class="col-sm-4 col-xs-4 input-field">
								<div class="file-upload btn">
									<span class="glyphicon glyphicon-picture"></span>
									<input id="upload-media" class="upload" type="file" accept="image/*" name="media[]">
								</div>
								<div class="input-label">Upload media</div>
							</div> -->


								<div class="upload-button camera">
									<input type="file" id="take-picture" class="inputfile" name="camera[]" accept="image/*" capture>
									<label for="take-picture" class="inputlabel">
										<div class="upload-icon">
											<i class="fa fa-camera"></i>
										</div>
									</label>
									<span class="hint-block">Camera</span>
								</div>

								<div class="upload-button video">
									<input type="file" id="take-video" class="inputfile" name="video[]" accept="video/*" capture>
									<label for="take-video" class="inputlabel">
										<figure class="upload-icon">
											<i class="fa fa-video-camera"></i>
										</figure>
									</label>
									<span class="hint-block">Video</span>
								</div>

								<div class="upload-button">
									<input type="file" id="upload-media" class="inputfile" accept="image/*" name="media[]">
									<label for="upload-media" class="inputlabel">
										<div class="upload-icon">
											<i class="fa fa-upload"></i>
										</div>
									</label>
									<span class="hint-block">Gallery</span>
								</div>

						</div>

						<div class="status-message"></div>

						<div class="display-when-ready">
							<div id="clear-picture-preview">
								<span class="glyphicon glyphicon-remove"></span>
							</div>

							<div id="image-preview"><!-- image preview will be inserted here --></div>
							<div id="video-preview"><!-- video preview will be inserted here --></div>

							<div class="row image-comment">
								<textarea class="image-caption" name="media-caption" placeholder="What's up?"></textarea>
								<button type="submit" id="upload-button">Submit</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>

<!-- Catches the selected file and displays it on the page -->
<script src="js/camera.js"></script>
<!-- moves the file to the server -->
<script src="js/uploadMediaAjax.js"></script>
