<?php
	require_once "../includes/initialize.php";

	if (isset($_POST["register"])) {

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
			if ( $User->create_user([$email, $hashed_passphrase, date("Y-m-d"), 1]) ) {
				# set a new success message in a session, so we can display it on the page we redirect to
				Session::message("message", "Registered successfully.");
				if ($User->login($email, $passphrase)) {
					redirect("index.php");
				}
				redirect("register.php");
			}

		} else {
			# If the validation failed.
			$errors = "";
			foreach ($validated->get_errors() as $error) {
				$errors .= $error . "<br>";
			}
		}
	}
?>
<?php require_once "partials/header.php"; ?>
	<h1>Register</h1>
	<form action="register.php" method="post" id="register" class="form">
		<label for="email">E-mail</label>
		<input type="text" name="email" value="<?php if (isset($_POST['email'])) { echo safe_output($_POST['email']); } ?>">
		<label for="passphrase">Passphrase</label>
		<input type="password" name="passphrase">
		<input type="submit" name="register" value="Join" class="submit-button">
	</form>
	<div class="error">
		<?php if (isset($errors)) { echo $errors; } ?>
	</div>
<?php require_once "partials/footer.php"; ?>
