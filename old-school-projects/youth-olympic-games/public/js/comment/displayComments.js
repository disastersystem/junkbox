/*
*   Create a comment as HTML
*	Parameters: Comment Author, Comment Text, Comment Timestamp
*	Return HTML block, ready to insert into array.
*/
function commentToHtml(cAuthor, cAuthorImg, cText, cTime)
{
	if(cTime != "0")
		cTime = convertTimeToText(cTime);	// See js/timeToText.js.

	if (cAuthorImg == "") {
		var imageSource = "img/default.png";
	} else {
		var imageSource = "uploads/posts/thumb_" + cAuthorImg;
	}

	var comment =
	[
		'<div class="comment row">',

			'<img class="col-xs-2 comment-author-img" src="' + imageSource + '">',
			'<div class="col-xs-9 col-xs-offset-1 comment-author">' + cAuthor + '</div>',
			'<div class="col-xs-9 col-xs-offset-1 comment-body">' + cText + '</div>',
			'<div class="col-xs-12 comment-timestamp">' +cTime + ' </div>',
		'</div>'
	].join('');

	return comment;
}

/*
* Add all comments for this post into view.
* Return none
*/

function addToView(comments)
{
	var container = $('.comments-view');	// Comments container.
	container.html(''); 					// Reset containers content.

	if(comments.length > 0) 				// Comment exists:
	{
		for(var i = 0; i < comments.length; i++)
		{
			container.append(commentToHtml
			(
				comments[i][1], 	// Username.
				comments[i][2], 	// Profile image.
				comments[i][3],		// Comment text.
				comments[i][4]		// Timestamp.
			));
		}
	}
	else
	{
		container.append
		('<div class = "minorError" style = "margin-top: 10%;">No Comments</div>');
	}

	//container.css('-webkit-animation','down .4s');
}

function addNewCommentToView(comment)
{
	var container = $('.comments-view');	// Comments container.
	container.prepend(commentToHtml
	(
		comment[0], 				// Username.
		comment[1], 				// Profile image.
		comment[2], 				// Comment text.
		comment[3]					// Timestamp in text.
	));

	container.find('.comment:first').css('display','none');
	container.find('.comment:first').css({'-webkit-animation':'scale .4s', 'display' : 'block' });
	container.find('.minorError').remove();
}


function displayComments(postID)
{
	var comments = [];						// Stores all comments.

	$.ajax
	({
		type: 'GET',
		url: 'API/read/postComments.php?post_id=' + postID
	})
	.done(function(data)
	{
		comments = JSON.parse(data);
		addToView(comments);

	});
}
