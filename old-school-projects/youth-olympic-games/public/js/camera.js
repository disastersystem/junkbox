(function () {
	var takePicture = $("#take-picture");
	var takeVideo = $("#take-video");
	var uploadMedia = $("#upload-media");

	var waitForImage = $(".display-when-ready");
	var statusMessage = $(".status-message");

	var imagePreview = $('#image-preview');
	var videoPreview = $('#video-preview');

	var uploadChoices = $('#uploadChoices');

	/* add event listeners to the upload inputs */
	takePicture.on("change", function(event) { showPreview(); });
	takeVideo.on("change", function(event) { showPreview(); });
	uploadMedia.on("change", function(event) { showPreview(); });

	function showPreview() {

		/* Get a reference to the taken picture or chosen file */
		var files = event.target.files;
		var file;

		if (files && files.length > 0) {
			file = files[0];

			var reader = new FileReader();
			reader.onload = function(event) {

				var result = event.target.result;
				var dataType = result.split("data:");

				/* if the file uploaded is an image */
				if (dataType[1].charAt(0) === "i") {
					the_url = event.target.result;
					imagePreview.html("<img class='media' data-media-type='1' src='" + the_url + "'>");
			    }

				/* if the file uploaded is a video */
			    if (dataType[1].charAt(0) === "v") {
					the_url = event.target.result;

					var vid = [
						"<div class='media' data-media-type='2' id='vid-box' style='height: 300px; background-color: #ddd; line-height: 300px; text-align: center;'>",
							"<span style='color: #ccc;' class='glyphicon glyphicon-facetime-video'></span>",
						"</div>"
					].join('');

					videoPreview.html(vid);
			    }

				// uploadButton.html(""); /* clear the loading icon */
			    waitForImage.css("display", "block");
				uploadChoices.css("display", "none");
			}

			/* when the file is read it triggers the onload event above */
			reader.readAsDataURL(file);
		}
	}

	var clearPicturePreview = $("#clear-picture-preview");

	clearPicturePreview.on("click", function(event) {
		imagePreview.html("");
		videoPreview.html("");

		waitForImage.css("display", "none");
		uploadChoices.css("display", "block");
	});

})();
