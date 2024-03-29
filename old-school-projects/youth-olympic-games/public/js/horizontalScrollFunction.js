jQuery(function($) {
	$.fn.hScroll = function (amount) {
		amount = amount || 120;
		$(this).bind("DOMMouseScroll mousewheel", function (event) {
			var oEvent = event.originalEvent,
			direction = oEvent.detail ? oEvent.detail * -amount : oEvent.wheelDelta,
			position = $(this).scrollLeft();
			position += direction > 0 ? -amount : amount;
			$(this).scrollLeft(position);
			event.preventDefault();
		});
	};

	$.fn.bScroll = function (amount) {
		amount = amount || 120;
		$(this).bind("click", ".scrollAthletes", function (event) {
			var oEvent = event.originalEvent,
			direction = oEvent.detail ? oEvent.detail * -amount : oEvent.wheelDelta,
			position = $(this).scrollLeft();
			position += direction > 0 ? -amount : amount;
			$(this).scrollLeft(position);
			event.preventDefault();
		});
	};

	$.fn.cScroll = function (amount) {
		amount = amount || 120;
		$(this).bind("click", ".scrollAudience", function (event) {
			var oEvent = event.originalEvent,
			direction = oEvent.detail ? oEvent.detail * -amount : oEvent.wheelDelta,
			position = $(this).scrollLeft();
			position += direction > 0 ? -amount : amount;
			$(this).scrollLeft(position);
			event.preventDefault();
		});
	};
});
