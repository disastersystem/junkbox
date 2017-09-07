<?php

require_once('../../../includes/db.php');				

$query = "DELETE FROM posts WHERE post_id = ?";
	
	$sth = $db->prepare($query);					
	$sth->execute(array($_POST['postID']));						

	echo $_POST['postID'];