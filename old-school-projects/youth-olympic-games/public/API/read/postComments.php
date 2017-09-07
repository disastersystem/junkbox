<?php
	require_once('../../../includes/db.php');					// Create Database.
	
	$comments = array();
	
	$query = "	SELECT * 
				FROM comments
				WHERE post_id = ?
				ORDER BY timestamp DESC";
				
	$sth = $db->prepare($query);					
	$sth->execute(array($_GET['post_id']));		
	
	while($row = $sth->fetch(PDO::FETCH_ASSOC))	// Fetch all rows as array
	{	
		$comment = array();
		
		$query = "	SELECT username, profile_img 
					FROM users
					WHERE username = ?";
				
		$foo = $db->prepare($query);					
		$foo->execute(array($row['username']));
		
		
		
		 if( $user = $foo->fetch() )
			$profileImg = $user['profile_img']; 
		
		array_push( $comment, $row['comment_id'], $row['username'], $profileImg, $row['comment_text'], $row['timestamp'] );
		array_push( $comments, $comment ); 
	}
	
	echo json_encode($comments);