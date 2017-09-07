/**
 * Pause menu.
 */
function initDialog()
{


	$('#fillBG, .dialog').css('display','block');

	$('.dialog').addClass('popIn');

	$('.dialog').css
	({
		'top' : $(window).height() / 2 - $('.dialog').outerHeight(true) / 2,
		'left' : $(window).width() / 2 - $('.dialog').outerWidth(true) / 2
	});

	$('.dialog-btn[role=resume]').addClass('buttonMove');
}

function exitDialog()
{
	$('#fillBG, .dialog').css('display','none');
}
