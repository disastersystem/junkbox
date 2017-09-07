<?php session_start(); ?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Youth Olympic Games</title>
		<meta name="description" content="Youth Olympic Games">
		<meta name="viewport" content="width=device-width">
		<link rel="shortcut icon" type="image/png" href="img/favicon.png">

		<!-- jQuery -->
		<script type="text/javascript" src ="js/jquery.js"></script>

		<!-- Bootstrap -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

		<!-- Font-Awesome -->
		<link rel="stylesheet" href="css/font-awesome-4.4.0/css/font-awesome.min.css">

		<!-- Fonts -->
		<link href='https://fonts.googleapis.com/css?family=Lato:400' rel='stylesheet' type='text/css'>

		<!-- Our stylesheets -->
		<link rel="stylesheet" href="css/bootstrapReset.css">
		<link rel="stylesheet" href="css/global.css">
		<link rel="stylesheet" href="css/animation.css">
		<link rel="stylesheet" href="css/menu.css">
		<link rel="stylesheet" href="css/posts.css">
		<link rel="stylesheet" href="css/dialog.css">

		<!-- Our Javascript -->
		<script type = "text/javascript" src = "js/global.js"></script>
		<script src="js/calculatePostsLayout.js"></script>
		<script src="js/helpers.js"></script>
	</head>
	<body>

		<?php
			require_once 'user/init.php';
			include_once 'user/user_class.php';
			$user = new USER($DB_con);

			require_once "../includes/DatabaseHandler.php";
			$event = Database::instance()->run_query(
				"SELECT * FROM events
				INNER JOIN sports
				ON events.sport_id = sports.sport_id
				WHERE event_id = ? LIMIT 1",
				[$_GET["event_id"]]
			)->get_results();
		?>

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1047073321999123',
      xfbml      : true,
      version    : 'v2.5'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));


			function ajaxRequest(requestURL) {
				var event = getUrlParameter('event_id');

				return $.ajax({
					type: 'GET',
					url: 'API/read/' + requestURL + '.php?event_id=' + event,
					dataType: 'json',
					encode: true,
					cache: false,
					contentType: false,
					processData: false
				});
			}
		</script>
		<div class = "container-fluid">
			<header class="main-menu">
				<a href="index.php"><i class="fa fa-arrow-left m_arrow_back"></i></a>
				<h1>
					<?php echo strtolower($event[0]->sport_name); ?>
					<span class="sport-info">
						<?php echo strtolower($event[0]->sport_status); ?>
					</span>
					<span class="sport-info">
						<?php echo strtolower($event[0]->teams); ?>
					</span>
				</h1>

				<?php if (!$user->is_loggedin()): ?>
					<button class="post-button" data-toggle="modal" data-target=".loginRegisterModal" class="not-logged-in">
						<span class="glyphicon glyphicon-upload"></span>
					</button>
				<?php else: ?>
					<button id="<?php echo $_SESSION['user_session']; ?>" class="post-button" data-toggle="modal" data-target="#uploadModal">
						+
					</button>
				<?php endif; ?>
			</header>
			<div class="all-posts">
				<div class="hide-scrollbar">
				<div class="bar athletes-posts">
					<div class="row-posts row-posts-1">
						<script>
							 ajaxRequest("eventAthletesPosts").done(function(result) {

								if ($(window).height() < 600) {
 									var results = result;
 								} else {
 									var results = result.splice(0, (result.length / 2));
 								}

								if (result.length > 0) {
									results.forEach(function(obj) {

										if (obj.media_type == "1") {
											var post = [
												'<a href="#" data-toggle="modal" postCreated="' + obj.post_time + '" postProfileImage="' + obj.profile_img + '" postUsername="' + obj.username + '" postID = "' + obj.post_id + '" postTitle = "' + obj.post_text + '" data-target="#myModal">',
													'<div class="post" >',
														'<img src="uploads/posts/thumb_' + obj.src + '" data-full="uploads/posts/' + obj.src + '">',
													'</div>',
												'</a> '
											].join('');
										} else {
											var post = [
												'<a href="#" data-toggle="modal" postCreated="' + obj.post_time + '" postProfileImage="' + obj.profile_img + '" postUsername="' + obj.username + '" postID = "' + obj.post_id + '" postTitle = "' + obj.post_text + '" data-target="#myModal">',
													'<div class="post">',
														'<video src="uploads/posts/' + obj.src + '" type="video/mp4" poster="img/play-video.png">',
															'<source src="uploads/posts/' + obj.src + '" type="video/mp4">',
															'<source src="uploads/posts/' + obj.src + '" type="video/webm">',
															'<source src="uploads/posts/' + obj.src + '" type="video/ogg">',
														'</video>',
													'</div>',
												'</a> '
											].join('');
										}

										$(".athletes-posts > .row-posts-1").append(post);
									});
								} else {
									$(".athletes-posts")
										.append("<div class='minorError'>No posts from the athletes yet</div>");
								}

								// re-calculate the layout when new images is loaded with ajax
								calculatePostsLayout();
							});

						</script>
					</div>
					<div class="row-posts row-posts-2">
						<script>
							ajaxRequest("eventAthletesPosts").done(function(result)
							{
								result.splice(0, (result.length / 2));

								result.forEach(function(obj) {

									if (obj.media_type == "1") {
										var post = [
											'<a href="#" data-toggle="modal" postCreated="' + obj.post_time + '" postProfileImage="' + obj.profile_img + '" postUsername="' + obj.username + '" postID = "' + obj.post_id + '" postTitle = "' + obj.post_text + '" data-target="#myModal">',
												'<div class="post" >',
													'<img src="uploads/posts/thumb_' + obj.src + '" data-full="uploads/posts/' + obj.src + '">',
												'</div>',
											'</a> '
										].join('');
									} else {
										var post = [
											'<a href="#" data-toggle="modal" postCreated="' + obj.post_time + '" postProfileImage="' + obj.profile_img + '" postUsername="' + obj.username + '" postID = "' + obj.post_id + '" postTitle = "' + obj.post_text + '" data-target="#myModal">',
												'<div class="post">',
													'<video src="uploads/posts/' + obj.src + '" type="video/mp4" poster="img/play-video.png">',
														'<source src="uploads/posts/' + obj.src + '" type="video/mp4">',
														'<source src="uploads/posts/' + obj.src + '" type="video/webm">',
														'<source src="uploads/posts/' + obj.src + '" type="video/ogg">',
													'</video>',
												'</div>',
											'</a> '
										].join('');
									}

									$(".athletes-posts > .row-posts-2").append(post);
								});

								// re-calculate the layout when new images is loaded with ajax
								calculatePostsLayout();
							});
						</script>
					</div>

					<div class="scrollOn scrollAthletes"><i class="fa fa-chevron-right fa-2x"></i></div>

				</div> <!-- /.athletes-posts -->
				</div> <!-- /.hide-scrollbar -->

				<div class="mid-bar" style="border-top: 1px solid #ddd;border-bottom: 1px solid #ddd;">
					<div class="mid-bar-label">
						<div class="glyphicon glyphicon-chevron-up"></div>
						<div>athlete posts</div>
					</div>
					<div class="mid-bar-label">
						<div>audience posts</div>
						<div class="glyphicon glyphicon-chevron-down"></div>
					</div>
				</div>

				<div class="hide-scrollbar">
				<div class="bar audience-posts">
					<div class="row-posts row-posts-1">
						<script>
							 ajaxRequest("eventAudiencePosts").done(function(result) {

								if ($(window).height() < 600) {
									var results = result;
								} else {
									var results = result.splice(0, (result.length / 2));
								}

								if (result.length > 0) {
									results.forEach(function(obj) {

										if (obj.media_type == "1") {
											var post = [
												'<a href="#bbb" data-toggle="modal" postCreated="' + obj.post_time + '" postProfileImage="' + obj.profile_img + '" postUsername="' + obj.username + '" postID = "' + obj.post_id + '" postTitle = "' + obj.post_text + '" data-target="#myModal">',
													'<div class="post" >',
														'<img src="uploads/posts/thumb_' + obj.src + '" data-full="uploads/posts/' + obj.src + '">',
													'</div>',
												'</a> '
											].join('');
										} else {
											var post = [
												'<a href="#" data-toggle="modal" postCreated="' + obj.post_time + '" postProfileImage="' + obj.profile_img + '" postUsername="' + obj.username + '" postID = "' + obj.post_id + '" postTitle = "' + obj.post_text + '" data-target="#myModal">',
													'<div class="post">',
														'<video src="uploads/posts/' + obj.src + '" type="video/mp4" poster="img/play-video.png">',
															'<source src="uploads/posts/' + obj.src + '" type="video/mp4">',
															'<source src="uploads/posts/' + obj.src + '" type="video/webm">',
															'<source src="uploads/posts/' + obj.src + '" type="video/ogg">',
														'</video>',
													'</div>',
												'</a> '
											].join('');
										}

										$(".audience-posts > .row-posts-1").append(post);
									});
								} else {
									$(".audience-posts")
										.append("<div class='minorError'>No posts from the audience yet</div>");
								}

								// re-calculate the layout when new images is loaded with ajax
								calculatePostsLayout();
							});
						</script>
					</div>
					<div class="row-posts row-posts-2">
						<script>
							ajaxRequest("eventAudiencePosts").done(function(result) {

								result.splice(0, (result.length / 2));

								result.forEach(function(obj) {

									if (obj.media_type == "1") {
										var post = [
											'<a href="#aaa" data-toggle="modal" postCreated="' + obj.post_time + '" postProfileImage="' + obj.profile_img + '" postUsername="' + obj.username + '" postID = "' + obj.post_id + '" postTitle = "' + obj.post_text + '" data-target="#myModal">',
												'<div class="post">',
													'<img src="uploads/posts/thumb_' + obj.src + '" data-full="uploads/posts/' + obj.src + '">',
												'</div>',
											'</a> '
										].join('');
									} else {
										var post = [
											'<a href="index.php" data-toggle="modal" postCreated="' + obj.post_time + '" postProfileImage="' + obj.profile_img + '" postUsername="' + obj.username + '" postID = "' + obj.post_id + '" postTitle = "' + obj.post_text + '" data-target="#myModal">',
												'<div class="post">',
													'<video src="uploads/posts/' + obj.src + '" type="video/mp4" poster="img/play-video.png">',
														'<source src="uploads/posts/' + obj.src + '" type="video/mp4">',
														'<source src="uploads/posts/' + obj.src + '" type="video/webm">',
														'<source src="uploads/posts/' + obj.src + '" type="video/ogg">',
													'</video>',
												'</div>',
											'</a> '
										].join('');
									}

									$(".audience-posts > .row-posts-2").append(post);
								});

								// re-calculate the layout when new images is loaded with ajax
								calculatePostsLayout();
							});
						</script>
					</div>

					<div class="scrollOn scrollAudience"><i class="fa fa-chevron-right fa-2x"></i></div>

				</div> <!-- /.audience-posts -->
				</div> <!-- /.hide-scrollbar -->

			</div> <!-- /.all-posts -->
		</div> <!-- /.container-fluid -->

		<script src="js/horizontalScrollFunction.js"></script>
		<script src="js/constants/main.js"></script>
		<script src="js/snippets/timeToText.js"></script>
		<script src="js/snippets/dialog.js"></script>
		<script src="js/post/openPost.js"></script>
		<script src="js/post/deletePost.js"></script>
		<script src="js/comment/submitComment.js"></script>
		<script src="js/comment/displayComments.js"></script>

		<script>
			// enable horizontal scrolling on the .bar elements
			$(document).ready(function() {

				var user = $('.post-button').attr('id');

				$('a').on('click', function(e) {

					if ($(this).attr('postUsername') == user) {
						$('.deleteButtonContainer').append('<button type="button" class = "deletePostButton">Delete <i class="fa fa-trash"></i></button>');
					}

					$('#tweetBtn iframe').remove();
					var tweetBtn = $('<a></a>')
						.addClass('twitter-share-button')
						.attr('href', 'http://twitter.com/share')
						.attr('data-text', $(this).attr('postTitle'))
						.attr('data-hashtags', "YOG2016,Lillehammer");
					$('#tweetBtn').append(tweetBtn);
					twttr.widgets.load();
				});

				$('.modal-dialog').on('click', function() {
					$('.deleteButtonContainer').html("");
				});

				$('.close').on('click', function() {
					$('.deleteButtonContainer').html("");
				});

				$('.not-logged-in').on('click',function() {
					$('.loginRegisterModal').show();
				});

				$('.exitModal').click(function() {
					$('.loginRegisterModal').hide();
					$('.loginRegisterModal input').val("");
					$('.errorMessages').text("");
				});


				$('body').undelegate('click');

				calculatePostsLayout();

				// You can pass (optionally) scrolling amount
				$('.bar').hScroll(50); // scroll on mousewheel
				$('.audience-posts').bScroll(100); // scroll on button click
				$('.athletes-posts').cScroll(100);

				// Open Post:
				$('.row-posts').delegate('a','click', function()
				{
					openPost( $(this) );
				});

				$('.commentField textarea').on('click', function()
				{
					if($(window).width() < MOBILE_WIDTH)
					{
						$('body, html').scrollTop(500);
					}
				});

				// Open dialog delete post:
				$('.deleteButtonContainer').delegate('.deletePostButton', 'click', function()
				{
					var dialogTitle = "Are you sure you want to delete this post?";
					var confirm = "Delete";
					var cancel = "cancel";

					dialog(dialogTitle, confirm, cancel);	// Open dialog

				});

				// Delete post-> CONFIRMED
				$('.customDialog input[role=confirm]').on('click', function()
				{
					var postID = $('.modalPost').attr('post-id');

					if (deletePost( postID ) );
					{
						$('.modalPost').modal('hide');
						$('.row-posts a[postid = ' + postID + ']').remove();

						$(this).parent().hide();		// Close dialog.
					}
				});

				// Delete post-> CANCEL
				$('.customDialog input[role=cancel]').on('click', function()
				{
					$(this).parent().hide();		// Close dialog.
				});

				// Submit comment:
				$('body').delegate('.submitComment','click',function()
				{
					submitComment();
				});


				$('form').on("submit", function(event) {
	                event.preventDefault();

	                var form = $(this);
	                var formData = new FormData(form[0]);

	                var formURL = form.attr("action");

	                $.ajax({
	                    type: 'POST',
	                    url: formURL,
	                    data: formData,
	                    dataType: 'json',
	                    encode: true,
	                    cache: false,
	                    contentType: false,
	                    processData: false
	                })
	                .done(function(response) {
	                    if (response == "true") {
	                        location.reload();
	                    } else {
	                        $('.errorMessages').empty().html(response);
	                    }
	                })
	                .fail(function(response) {
	                    console.log("fail whale");
	                });

	            });

			});
		</script>

		<?php require_once 'partials/modals/loginRegister.php'; ?>
		<?php require_once "partials/uploadModal.php"; ?>
		<?php require_once "partials/dialog.html"; ?>
		<?php require_once "partials/postModal.php"; ?>

	</body>
</html>
