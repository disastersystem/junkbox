var victory = [
	"http://rack.1.mshcdn.com/media/ZgkyMDEzLzA4LzA1LzI2L3N1Y2Nlc3MuNmQ2MTUuZ2lmCnAJdGh1bWIJODUweDg1MD4KZQlqcGc/2ce5ad70/c04/success.jpg"
];


$('.upload-form').on("submit", function(event) {
	event.preventDefault();

	var uploadButton = $("#upload-button");
	uploadButton.html('<i class="fa fa-circle-o-notch fa-spin fa-2x"></i>');
	uploadButton.prop('disabled', true);

	var form = $(this);
	var formData = new FormData(form[0]);

	var event = getUrlParameter('event_id');
	formData.append("event_id", event);
	var media_type = $(".media").attr("data-media-type");
	formData.append("media_type", media_type);

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
		$("#wait-for-image").css("display", "none");
		/*var rand = victory[Math.floor(Math.random() * victory.length)]; <img src="' + rand + '">*/
		$(".status-message").empty().html('<h2>' + response + '</h2>');

		uploadButton.html("Submit");
		uploadButton.prop('disabled', false);

		location.reload();
	})
	.fail(function(response) {
		$("#wait-for-image").css("display", "none");
		$(".status-message").empty().html("Something went wrong " + response.responseText);

		uploadButton.html("Submit");
		uploadButton.prop('disabled', false);
	});

});
