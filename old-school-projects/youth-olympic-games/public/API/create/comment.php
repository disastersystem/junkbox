<?php
	session_start();
	require_once('../../../includes/db.php');
	
	if( $_SESSION['user_session'] )
	{
		$uname = $_SESSION['user_session'];
		
		$userData = array();
		
		$query = " 	INSERT INTO comments (post_id, username, comment_text) VALUES(?,?,?)";
		$sth = $db->prepare($query);
		$sth->execute( array( $_POST['postID'], $uname, $_POST['content']) );
		
		$query = "SELECT username, profile_img
					FROM users
					WHERE username = ?";
					
		$sth = $db->prepare($query);					
		$sth->execute( array( $uname ) );
		
		if( $row = $sth->fetch() )
		{	
			array_push( $userData, $row['profile_img'], $uname );
			echo json_encode($userData);
		}
	}
	else
		echo "false";
	