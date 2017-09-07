<?php
    session_start();
    require_once 'user/init.php';
    include_once 'user/user_class.php';
    $user = new USER($DB_con);

    // if($user->is_loggedin()):
?>
<!DOCTYPE html>
<html lang="en">
    <head>

		<?php include 'partials/head.php'; ?>
		<?php include 'partials/modals/loginRegister.php'; ?>
		<script type = "text/javascript" src = "js/frontpageNavHandler.js"></script>
        <link rel="stylesheet" href="css/stats.css"/>
	</head>
    <body>
        <div class = "container-fluid">
            <?php
				require_once('../includes/db.php');					// Create Database.
				include 'partials/main-menu.php';
			?>

			<ul class="navCustom col-xs-12" >
				<!-- Events -->
				<li class = "col-xs-6" role = "event" data-url = "partials/events.php"> events</li>

				<!-- Statistics -->
				<li class = "col-xs-6" role = "stats" data-url = "stats.php"> statistics</li>
				<div id = "navArrow"></div>
			</ul>

			<div id = "frontpageContainer" class = "col-xs-12">
				<?php include 'partials/events.php'; ?>
			</div>

        </div>
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
        </script>


    </body>
</html>
