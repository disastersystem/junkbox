(function () {
	var takePicture = $("#inputcamera");
	var uploadMedia = $("#inputgallery");

	var statusMessage = $(".status-message");

	var imagePreview = $('.change-profile-image');

	/* add event listeners to the upload inputs */
	takePicture.on("change", function(event) { showPreview(); });
	uploadMedia.on("change", function(event) { showPreview(); });

	function showPreview() {
		$('.change-picture-button').prop('disabled', false);

		/* Get a reference to the taken picture or chosen file */
		var files = event.target.files;
		var file;

		if (files && files.length > 0) {
			file = files[0];

			statusMessage.html('<i class="fa fa-circle-o-notch fa-spin fa-3x"></i>');

			var reader = new FileReader();
			reader.onload = function(event) {

				var result = event.target.result;
				var dataType = result.split("data:");

				/* if the file uploaded is an image */
				if (dataType[1].charAt(0) === "i") {
					the_url = event.target.result;
					imagePreview.attr("src", the_url);
			    }

				/* if the file uploaded is a video */
			    if (dataType[1].charAt(0) === "v") {}

				statusMessage.html(""); /* clear the loading icon */
			}

			/* when the file is read it triggers the onload event above */
			reader.readAsDataURL(file);


		}
	}

	var clearPicturePreview = $("#clear-picture-preview");

	clearPicturePreview.on("click", function(event) {
		imagePreview.attr("src", "img/default.png");
	});

})();
