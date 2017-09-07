function calculatePostsLayout() {
	var bodyHeight = $('body').first().outerHeight();
	var midBarHeight = $('.mid-bar').first().outerHeight();
	var menuHeight = $('.main-menu').first().outerHeight();

	var barHeight = ((bodyHeight - menuHeight - midBarHeight) / 2);

	$('.bar').css({ 'height': barHeight + 'px' });

	var postBarHeight = $('.bar').first().outerHeight();
	$('.row-posts').css({
		'height': (postBarHeight / 2) + 'px'
	});

	var h = $('.row-posts').first().outerHeight();
	$('.post').css({
		'height': (h - 4) + 'px'
	});

	/* set the width of the posts equal to the height */
	var postHeight = $('.post').first().outerHeight();
	$('.post').css({
		'width': postHeight + 'px'
	});

	/* set the height of the fixed next button elements */
	$('.scrollAudience').css({
		'height': barHeight + 'px',
		'top': menuHeight + barHeight + midBarHeight + 'px',
		/* substract 30 to raise it a little bit and make it appear more centered */
		'line-height': (barHeight - 30) + 'px'
	});

	$('.scrollAthletes').css({
		'height': barHeight + 'px',
		'top': menuHeight + 'px',
		'line-height': (barHeight - 30) + 'px'
	});

	$('.minorError').css({
		'bottom': (barHeight / 2) + 'px'
	});


	/* collapse the layout to one row */
	if ($(window).height() < 600)
	{
		$('.row-posts-2').css({ 'display': 'none' });
		$('.row-posts').css({ 'height': '100%' });

		var fg = $('.bar').first().outerHeight();
		$('.row-posts').css({ 'height': fg + 'px' });

		var h = $('.row-posts').first().outerHeight();
		$(".post").css({ 'height': (h - 4) + 'px' });

		var postHeight = $('.post').first().outerHeight();
		$('.post').css({ 'width': postHeight + 'px' });
	}
}
