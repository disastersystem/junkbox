<?php
	require_once "../includes/initialize.php";

	if (isset($_POST["login"])) {
		$errors = "";

		$Validation = new Validation();
		# The unique rule checks whether the email entered already exists in
		# the users table. The database has a UNIQUE index, but this way we can give the user feedback.
		$validated = $Validation->check_values($_POST, [
			"email" => ["required" => true, "email" => true],
			"passphrase" => ["required" => true]
		]);

		if ($validated->passed()) {
			$email = $_POST["email"];
			$passphrase = $_POST["passphrase"];

			$User = new User();
			# login() checks the email and passphrase provided, and also sets a session.
			if ($User->login($email, $passphrase)) {
				Session::message("message", "Successfully signed in.");
				redirect("index.php");
			} else {
				$errors .= "wrong username or password<br>";
			}
		} else {
			# If the validation failed.
			foreach ($validated->get_errors() as $error) {
				$errors .= $error . "<br>";
			}
		}
	}
?>
<?php require_once "partials/header.php"; ?>
	<h1>Sign in</h1>
	<form action="login.php" method="post" id="login" class="form">
		<label for="email">E-mail</label>
		<input type="text" name="email" value="<?php if (isset($_POST['email'])) { echo safe_output($_POST['email']); } ?>" id="email">
		<label for="passphrase">Passphrase</label>
		<input type="password" name="passphrase" id="passphrase">
		<input type="submit" name="login" value="Sign in" class="submit-button">
	</form>
	<div class="error">
		<?php if (isset($errors)) { echo $errors; } ?>
	</div>
<?php require_once "partials/footer.php"; ?>
