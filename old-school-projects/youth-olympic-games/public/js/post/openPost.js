/*
*	OPEN A POST
*
*	Parameters: elem = .row-posts a (at post site),
*
*	Get postID, postTitle and postImageSrc from thumbnailPost
*	Set This data into a post modal.
*	Load the post's comments.
*/
function shareFB(url, title)
{
	FB.ui({
    method: 'share_open_graph',
    action_type: 'og.shares',
    action_properties: JSON.stringify({
        object : {
           'og:url': 'http://susannlundekvam.com/ol/public/', // your url to share
           'og:title': title,
           'og:image': url
        }
    })
    },
    // callback
    function(response)
	{
		if (response && !response.error_message) {
			// then get post content
			alert('successfully posted');
		} else {
			alert('Something went error.');
		}
	});

}

/* function shareTweet(url, title)
{
	twttr.widgets.createShareButton(
		"https:\/\/dev.twitter.com\/web\/tweet-button",
		document.getElementById("tweet-container"),
		{
			size: "large",
			via: "twitterdev",
			related: "twitterapi,twitter",
			text: "custom share text",
			hashtags: "example,demo"
		}
	);
} */

function openPost(elem)
{

	 // Get post data:
	var postID 			= elem.attr('postID');
	var postAuthor 		= elem.attr('postUsername');
	var postAuthorImg 	= elem.attr('postProfileImage');
	var postTime	 	= elem.attr('postCreated');
	var postHeader 		= elem.attr('postTitle');
	var postImgSrc 		= elem.find('img').attr('data-full');
	var videoSrc 		= elem.find('video').attr('src');

	// Share url:
	var url = "http://susannlundekvam.com/ol/public/";

	var shareUrl = url + "" + postImgSrc;

	// Set post data into modal:
	$('.modalPost').attr('post-id', postID);
	$('.modalPost').find('.modal-title').text(postHeader);

	if (postAuthorImg == "") {
		$('.authorImage').attr('src','img/default.png');
	} else {
		$('.authorImage').attr('src','uploads/posts/thumb_' + postAuthorImg);
	}


	$('.authorName').text(postAuthor);

	var timestamp = convertTimeToText(postTime)

	$('.authorTimestamp').text(timestamp);

	if (typeof postImgSrc !== "undefined") {
		$('.modalPost').find('.media-view').html('<img src="' + postImgSrc + '">');
	}

	if (typeof videoSrc !== "undefined") {
		$('.modalPost').find('.media-view').html('<video src="' + videoSrc + '" controls></video>');
	}

	$('.modalPost').find('.twitter-share-button').attr('href',shareUrl);

	$('.facebook').on('click',function()
	{
		shareFB(shareUrl, postHeader);
 	});

	/* $('.twitter').on('click',function()
	{
		shareTweet(shareUrl, postHeader);
 	}); */



	// See "js/comment/displayComments.js":
	displayComments(postID);

	// Show modal:
	$('.modalPost').modal('show');

	 // Add animation to modal-dialog:
	$('.modal-dialog').css('-webkit-animation','scale .4s');

	// Set focus at comment textarea:
	if( $(window).width() > MOBILE_WIDTH )
		$('.modalPost').find('textarea').focus();
}
