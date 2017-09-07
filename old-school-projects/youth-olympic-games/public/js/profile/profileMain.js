$(document).ready(function()
{

	// Open Post:
	$('.img-container').on('click', function()
	{
		openPost( $(this) );
	});

	// Delete posts:
	$('.deletePostButton').on('click', function()
	{
		var dialogTitle = "Are you sure you want to delete this post?";
		var confirm = "Delete";
		var cancel = "cancel";
		
		dialog(dialogTitle, confirm, cancel);	// Open dialog
	});
	
	// Delete post-> CONFIRMED
	$('.customDialog input[role=confirm]').on('click', function()
	{
		var postID = $('.modalPost').attr('post-id');
		
		if (deletePost( postID ) );	// Confirm that the post was successfully deleted.
		{
			$('.modalPost').modal('hide');
			$('div [postid = ' + postID + ']').remove();
			
			$(this).parent().hide();		// Close dialog.
		}
	});
	
	// Delete post-> CANCEL
	$('.customDialog input[role=cancel]').on('click', function()
	{
		$(this).parent().hide();		// Close dialog.
	});

	// Submit comment:
	$('.submitComment').on('click', function()
	{
		submitComment();
	});

	/* - - - - - - - - - - - - - - - - - - - - */

	$('.userSettings').on('click', function()
	{
		openUserSettingsModal();
	});

	$('.passwordContainer input').on('change', function()
	{
		var status = validatePassword($(this)) ? true : false;

		setInputStatus($(this), status);
	});

	$('.passwordContainer input').on('focus',function()
	{
		$(this).removeClass('badPwd');
	});


});
