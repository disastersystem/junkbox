<?php
require_once "../../includes/initialize.php";

$user = new User;
if ($user->logged_in()) {
	# only admins should be allowed to delete users
	if ($user->has_permission(2)) {

	    $id = $_GET["id"];

	    if ($user->delete($id))
			echo '{"success":"User successfully deleted."}';
	    else
			echo '{"error":"Something mysterious went wrong."}';

	} else {
		# if the user doesn't have admin permissions
		echo '{"error":"You do not have permission."}'; exit;
	}
} else {
	# if the user is not logged in
	echo '{"error":"You\'re not logged in."}'; exit;
}
