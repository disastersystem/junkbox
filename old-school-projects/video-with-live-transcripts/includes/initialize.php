<?php

# session_start needs to come first so we might as well start it here
session_start();

# get the path to the includes folder, so we can include this file in any subfolder
$path = dirname(__FILE__);

# include classes
require_once $path . "/Session.php";
require_once $path . "/Database.php";
require_once $path . "/DBSetup.php";
require_once $path . "/Validation.php";
require_once $path . "/User.php";
require_once $path . "/Upload.php";
require_once $path . "/Video.php";
require_once $path . "/Playlist.php";
require_once $path . "/Search.php";

# include functions
require_once $path . "/functions.php";

# create the database if it doesn't already exists
$DBSetup = new DBSetup();
$DBSetup->create();
