<?php
    session_start();
    require_once 'user/init.php';
    include_once 'user/user_class.php';
    $user = new USER($DB_con);
    if($user->is_loggedin()):
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'partials/head.php'; ?>
        <link rel="stylesheet" href="css/profile.css">
    	<link rel="stylesheet" href="css/posts.css"/>
    	<link rel="stylesheet" href="css/userSettingsModal.css"/>
		<link rel="stylesheet" href="css/dialog.css">

		<script src="js/constants/main.js"></script>
		<script src="js/snippets/timeToText.js"></script>
		<script src="js/snippets/dialog.js"></script>
		<script src="js/post/openPost.js"></script>
		<script src="js/post/deletePost.js"></script>
		<script src="js/comment/submitComment.js"></script>
		<script src="js/comment/displayComments.js"></script>
		<script src="js/profile/userSettings.js"></script>
		<script src="js/profile/profileMain.js"></script>
    </head>
    <body>

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

			!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],
			p=/^http:/.test(d.location)?'http':'https';
			if(!d.getElementById(id)){js=d.createElement(s);
			js.id=id;js.src=p+'://platform.twitter.com/widgets.js';
			fjs.parentNode.insertBefore(js,fjs);
			}}(document, 'script', 'twitter-wjs');

		</script>

		<script type="text/javascript" async src="https://platform.twitter.com/widgets.js"></script>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <div class = "container-fluid">
            <header>
                <div class="main-menu col-xs-12">

                    <!-- back button -->
                    <div class="back-arrow col-xs-2 col-sm-1 col-md-1 col-lg-1">
                           <a href="index.php"><i class="fa fa-arrow-left m_arrow_back"></i></a>
                     </div>
                    <!-- profile name -->
                    <div class="col-xs-6 col-sm-7 col-md-8 col-lg-9 profile-name">
                        <?php
                            if ($user->is_loggedin())
                            {
                                require_once "../includes/DatabaseHandler.php";
                                $user_info = Database::instance()->run_query(
                                    "SELECT * FROM users WHERE username = ?",
                                    [$_SESSION['user_session']]
                                )->get_results();

                                echo "<h4 class=\"main-menu-h4\">" . $user_info[0]->username . "</h4>";
                            }
                        ?>
                    </div>
                    <div class="back-icon col-xs-4 col-sm-4 col-md-3 col-lg-2">
                        <?php
                            if($user->is_loggedin()) {
                                echo '<a class="logout" href="API/update/logout.php"><h4 style = "padding-right: 10px; word-spacing: 2px;">Logout <i class="fa fa-power-off"></i></h4></a>';
                            } else {
                                include 'user/login.php';
                                include 'user/register.php';
                            }
                        ?>
                    </div>
                </div>
            </header>

			<div class = "profileCoverBG">

				<!-- PROFILE BANNER -->
				<div class="col-xs-12 profile-header" id="<?php echo $_SESSION['user_session']; ?>">
					<div class="vertical-align">
						<!-- profile image -->
						<?php if(!empty($user_info[0]->profile_img)): ?>
							<img class="profile-img animated bounceInDown userSettings" src="uploads/posts/thumb_<?php echo $user_info[0]->profile_img; ?>" class="change-profile-image">
						<?php else: ?>
							<img class="profile-img animated bounceInDown userSettings" src="img/default.png" class="change-profile-image">
						<?php endif; ?>
					</div>
				</div>
				<!-- /PROFILE BANNER -->

				<!-- user settings -->
				<div class="userSettings">
					<i class="fa fa-cog"></i> Settings
				</div>

			</div>

            <!-- POSTS -->
			<div class="posts-container">

                <div class="always-center-posts">
    				<?php include "API/read/userPosts.php"; ?>
                </div>
			</div>


			<!-- /POSTS -->
			<div id="fb-root"></div>

            <?php require_once "partials/postModal.php"; ?>
            <?php require_once "partials/dialog.html"; ?>

            <script>
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

                $('.logout').on("click", function(event) {
                    event.preventDefault();

                    var formURL = $(this).attr("href");

                    $.ajax({
                        type: 'GET',
                        url: formURL,
                        dataType: 'json',
                        encode: true,
                        cache: false,
                        contentType: false,
                        processData: false
                    })
                    .done(function(response) {
                        console.log(response);
                        if (response == "true") {
                            location.reload();
                        }
                    });

                });



                var user = $('.profile-header').attr('id');

				$('img').on('click', function() {
					if ($('.img-container').attr('postUsername') == user) {
						$('.deleteButtonContainer').append('<button type="button" class = "deletePostButton">Delete <i class="fa fa-trash"></i></button>');
					}
				});

				$('.modalPost').on('click', function() {
					$('.deleteButtonContainer').html("");
				});

				$('.close').on('click', function() {
					$('.deleteButtonContainer').html("");
				});

                // Open dialog delete post:
				$('.deleteButtonContainer').delegate('.deletePostButton', 'click', function()
				{
					var dialogTitle = "Are you sure you want to delete this post?";
					var confirm = "Delete";
					var cancel = "cancel";

					dialog(dialogTitle, confirm, cancel);	// Open dialog

				});
            </script>

        </div>

		<?php require_once "partials/editUserModal.php"; ?>
    </body>
</html>
<?php
    else:
        header("Location: index.php");
        exit;
    endif;
?>
