<?php
require_once "../../includes/initialize.php";

$user = new User;
if ($user->logged_in()) {
	# only admins should be allowed to add users
	if ($user->has_permission(2)) {

	    $Validation = new Validation();
	    # The unique rule checks whether the email entered already exists in
	    # the users table. The database has a UNIQUE index, but this way we can give the user feedback.
	    $validated = $Validation->check_values($_POST, [
	        "email" => [
	            "required" => true,
				"email" => true,
	            "max" => 50,
	            "min" => 3,
	            "unique" => "users"
	        ],
	        "passphrase" => [
	            "required" => true,
	            "min" => 6
	        ]
	    ]);

	    if ($validated->passed()) {
	        $email = $_POST["email"];
	        $passphrase = $_POST["passphrase"];

	        # hash the password
	        $hashed_passphrase = password_hash($passphrase, PASSWORD_DEFAULT);

	        # Insert the user. Every user gets a permission level of 1,
	        # in order to make an admin account you have to do it directly in the database.
	        $User = new User();
	        if ( $User->create_user([$email, $hashed_passphrase, date("Y-m-d"), 2]) )
	            echo '{"success":"User successfully created."}';
	        else
				echo '{"error":"Something mysterious went wrong."}';


	    } else {
	        # If the validation failed.
	        $errors = "";
	        foreach ($validated->get_errors() as $error) {
	            $errors .= $error . "<br>";
	        }

	        # return the errors to the ajax request calling this page
			echo '{"error":"' . $errors . '"}'; exit;
	    }

	} else {
		# if the user doesn't have admin permissions
		echo '{"error":"You do not have permission."}'; exit;
	}
} else {
	# if the user is not logged in
	echo '{"error":"You\'re not logged in."}'; exit;
}
