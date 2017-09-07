<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Educational Videos</title>
		<meta name="viewport" content="width=device-width">
		<link rel="stylesheet" href="css/master.css">
		<link rel="stylesheet" href="css/video.css">
		<link rel="stylesheet" href="css/upload.css">
		<link rel="stylesheet" href="css/profile.css">
		<link rel="stylesheet" href="css/playlist.css">
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Play">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	</head>
	<body>
	<header class="master-header">
		<?php $User = new User; if (!$User->logged_in()): ?>
			<nav id="main">
				<a href="index.php">home</a>
				<a href="login.php">sign in</a>
				<a href="register.php">register</a>
			</nav>
		<?php endif; ?>

		<?php if ($User->logged_in()): ?>
			<nav id="logged-in">
				<a href="index.php">home</a>
				<a href="profile.php">my channel</a>
				<?php if ($User->has_permission(2)): ?>
					<a href="manage-users.php">manage users</a>
				<?php endif; ?>
				<a href="logout.php">logout (<?php echo safe_output($User->user_data()[0]->email); ?>)</a>
			</nav>
		<?php endif; ?>
	</header>

	<header id="mobile-header">
		<div id="nav-button">
			<span></span>
		</div>
	</header>

	<div id="mobile-nav">
		<ul>
			<?php if ($User->logged_in()): ?>
				<li><a href="index.php">home</a></li>
				<li><a href="profile.php">my channel</a></li>
				<?php if ($User->has_permission(2)): ?>
					<li><a href="manage-users.php">manage users</a></li>
				<?php endif; ?>
				<li><a href="upload.php">upload</a></li>
				<li><a href="logout.php">logout</a></li>
			<?php endif; ?>
		</ul>
	</div>

	<script type="text/javascript">
		$('#nav-button').on('click', function() {
			$('#nav-button').toggleClass('open');
			$('#mobile-nav').toggleClass('open');
		});
	</script>

	<?php if (Session::exists("message")): ?>
		<div class="message">
			<p>
				<?php
					# Print a message if any is set, then wipe it.
					echo Session::message("message", "");
				?>
			</p>
		</div>
	<?php endif; ?>

	<div id="content-wrapper">
		<!-- global containar that can be used for any ajax request response -->
		<div class="ajaxMessageContainer"></div>
