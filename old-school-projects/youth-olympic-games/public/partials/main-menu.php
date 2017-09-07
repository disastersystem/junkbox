<header>
    <div class="main-menu col-xs-12">
        <!-- LOGO -->
        <div class="col-xs-9 col-md-11 col-lg-11">
            <a href="index.php" class="home-link">
                <img src="img/olympic-logo.png" class="ol-logo">
            </a>
            <a href="index.php" class="home-link">
                <h1 class="main-menu-h1">YOG 2016</h1>
            </a>
        </div>
        <!-- MENU ICON -->
        <?php
            if ($user->is_loggedin()) {
                require_once "../includes/DatabaseHandler.php";
                $user_info = Database::instance()->run_query(
                    "SELECT * FROM users WHERE username = ?",
                    [$_SESSION['user_session']]
                )->get_results();

                if (!empty($user_info[0]->profile_img)) {
                    echo '<a class="menu-icon col-xs-3 col-md-1 col-lg-1" href="profile.php">
                            <img class="profile-img" src="uploads/posts/thumb_' . $user_info[0]->profile_img . '" alt="User profile image.">
                          </a>';
                } else {
                    echo '<a class="menu-icon col-xs-3 col-md-1 col-lg-1" href="profile.php">
                            <img class="profile-img" src="img/default.png" alt="User profile image.">
                          </a>';
                }

            } else {
                echo "<a class=\"menu-icon col-xs-3 col-md-1 col-lg-1\" href=\"#\" data-toggle = 'modal' data-target = '.loginRegisterModal'><i class=\"fa fa-user m_person\"></i></a>";
            }
        ?>
    </div>
</header>
