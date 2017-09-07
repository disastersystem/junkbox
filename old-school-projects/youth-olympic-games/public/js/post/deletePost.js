function deletePost(postID) // PostID to delete.
{
	$.ajax
	({
		type: 'POST',
		url: 'API/delete/deletePost.php',
		data: {	'postID' : postID },

		success: function(data)
		{
			return true;
		}
	});
}
