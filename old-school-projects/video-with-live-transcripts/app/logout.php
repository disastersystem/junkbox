<?php
	require_once "../includes/initialize.php";

	$User = new User();
	# Run the logout() method which unsets the user session, and redirect back to the front page.
	$User->logout();
	Session::message("message", "Successfully signed out.");
	redirect("index.php");
?>
