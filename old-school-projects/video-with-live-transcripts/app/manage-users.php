<?php
	require_once "../includes/initialize.php";

	$user = new User;
 	if ($user->logged_in()) {
		# only admins should be able to see this page
		if ($user->has_permission(2)) {

			$user->find_all_users();
			$users = $user->user_data();

			require_once "partials/header.php";
?>
<h1>Manage Users</h1>

<form action="ajax-requests/add-user.php" method="post" id="register" class="form">
	<label for="email">E-mail</label>
	<input type="text" class="email" name="email" value="<?php if (isset($_POST['email'])) { echo safe_output($_POST['email']); } ?>">
	<label for="passphrase">Passphrase</label>
	<input type="password" class="passphrase" name="passphrase">
	<input type="submit" name="register" id="submitButton" value="Add user" class="submit-button">
</form>

<table id="manage-users-table">
	<tr>
		<th>E-mail</th>
		<th>Join Date</th>
		<th>Edit</th>
	</tr>
	<?php foreach($users as $user): ?>
		<tr>
			<td><?php echo safe_output($user->email); ?></td>
			<td><?php echo safe_output($user->joined); ?></td>
			<td>
				<a class="delete-user" href="ajax-requests/delete-user.php?id=<?php echo safe_output($user->id); ?>">
					<i class="fa fa-times"></i>
				</a>
			</td>
		</tr>
	<?php endforeach; ?>
</table>

<script type="text/javascript" src="js/ajax-request.js"></script>
<script type="text/javascript">
	$('#register').on("submit", function(e) {
		e.preventDefault();

		// type, url, send data, container to append message
		ajaxRequest(
			"POST",
			"ajax-requests/add-user.php",
			new FormData($(this)[0]),
			'.ajaxMessageContainer'
		);

		// empty the form fields
		$('.email').val('');
		$('.passphrase').val('');
	});

	$('.delete-user').on("click", function(e) {
		e.preventDefault();

		if (confirm("Delete user?")) {
			// type, url, send data, container to append message
			ajaxRequest("GET", $(this).attr('href'), false, ".ajaxMessageContainer");
		}
	});
</script>

<?php
			require_once "partials/footer.php";
		} else {
			# if the user doesn't have admin permissions
			redirect("index.php");
		}
	} else {
		# if the user is not logged in
		redirect("index.php");
	}
?>
