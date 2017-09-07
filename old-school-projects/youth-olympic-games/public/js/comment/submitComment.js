function submitComment()
{

	var elem = $('.submitComment');
	
	var commentText = elem.parent().prev().find('textarea');
	var commentTextValue = commentText.val();
	 
	// Comment is not empty:
	if( commentTextValue != "" ) 		
	{
		var post = elem.closest('.modalPost');
		var postID = parseInt(post.attr('post-id'));
		
		$.ajax
		({
			type: 'POST',
			data: {	'postID' : postID, 'content' : commentTextValue },
			url: 'API/create/comment.php'
		})
		.done(function(data)
		{	
			
			if(data == "false")
			{
				alert('you nedd to log in');
			}
			else
			{
				var userData = JSON.parse(data); 	// 0: profileImg, 1: username.
				
				var profileImg = userData[0];
				var uname = userData[1];
				
				var commentArray = [uname, profileImg, commentTextValue, "Just now"];
				
				addNewCommentToView(commentArray);
				
				commentText.val("").blur();
			}
			
		});
		
		//status = true;
		
	} 
	else
	{	
		
		elem.css('-webkit-animation','textJump .4s');
		elem.css({'background-color':'#dd5454','outline-color':'#ad2424'});
		
		setTimeout(function()
		{
			elem.css('-webkit-animation','');
			elem.css({'background-color':'#28b0cc','outline-color':'#28b0cc'});
		},1000);
		
		//status = false;
	}
	
	//return status;
}
