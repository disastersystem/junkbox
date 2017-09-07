<?php
/*
	Author: Henrik Oddløkken.

	File:	setup.php

	Description:
					This file creates the the database for the webpage.
					And its tables.
*/

/*---------------------------------------------------------------------------*/
/*							T A B L E   U S E R	S
/*---------------------------------------------------------------------------*/

$query = "CREATE DATABASE IF NOT EXISTS susannlundekvam2;
		  USE susannlundekvam2;

		  CREATE TABLE IF NOT EXISTS users
		  (
			username VARCHAR(32) NOT NULL PRIMARY KEY,
  			password VARCHAR(64) NOT NULL,

			profile_img VARCHAR(64) NOT NULL
		  )";

$sth = $db->prepare($query);
$sth->execute();

$pwd = password_hash("ok", PASSWORD_DEFAULT);

$usernames = ['heenriko', 'robin', 'susann', 'snorre'];
$profileImgs = ['img/default.png', 'img/heman.gif', 'img/default.png', 'img/default.png'];

for( $i = 0; $i < count($usernames); $i++ )
{
	$query = "INSERT INTO users (username, password, profile_img) VALUES('$usernames[$i]','$pwd','$profileImgs[$i]')";
	$sth = $db->prepare($query);
	$sth->execute();
}



/*---------------------------------------------------------------------------*/
/*						 T A B L E   A T H L E T E
/*---------------------------------------------------------------------------*/

$query = "CREATE TABLE IF NOT EXISTS athletes
(
	athlete_id INT(11) NOT NULL PRIMARY KEY,
	username VARCHAR(32) NOT NULL,

	firstname VARCHAR(32) NOT NULL,
	surname VARCHAR(32) NOT NULL,

	nation VARCHAR(32) NOT NULL,

	gold INT,
	silver INT,
	bronze INT,

	FOREIGN KEY (athlete_id) REFERENCES users(username) ON DELETE CASCADE
)";

$sth = $db->prepare($query);
$sth->execute();

/*---------------------------------------------------------------------------*/
/*						T A B L E   L O C A T I O N S
/*---------------------------------------------------------------------------*/

$query = "CREATE TABLE IF NOT EXISTS locations
(
	location_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
	location_name VARCHAR(32) NOT NULL
)";
$sth = $db->prepare($query);
$sth->execute();

$locations = [
	'Amphitheatre',
	'Olympic Cavern',
	'Viking Ship',
	'Kristins hall',
	'Youth hall',
	'Curling hall',
	'Sliding centre',
	'Hafjell',
	'Hafjell',
	'Oslo',
	'Lysgårdsbakkene',
	'Birkebeineren'
	];

for( $i = 1; $i <= count($locations); $i++ )
{
	$a = $i;
	$a--;
	$query = "INSERT INTO locations (location_id, location_name) VALUES('$i','$locations[$a]')";
	$sth = $db->prepare($query);
	$sth->execute();
}

/*---------------------------------------------------------------------------*/
/*						T A B L E   S P O R T S
/*---------------------------------------------------------------------------*/

$query = "CREATE TABLE IF NOT EXISTS sports
(
	sport_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
	sport_name VARCHAR(32) NOT NULL

)";
$sth = $db->prepare($query);
$sth->execute();

$sports = ['alpine skiing',
		'biathlon',
		'bobsleigh',
		'curling',
		'figure skating',
		'freestyle skiing',
		'ice hockey',
		'luge',
		'nordic combined',
		'skeleton',
		'ski jumping',
		'snowboard',
		'speed skating'];

for( $i = 1; $i <= count($sports); $i++ )
{
	$a = $i;
	$a--;
	$query = "INSERT INTO sports (sport_id,sport_name) VALUES('$i','$sports[$a]')";
	$sth = $db->prepare($query);
	$sth->execute();
}

/*---------------------------------------------------------------------------*/
/*						T A B L E   I M A G E S
/*---------------------------------------------------------------------------*/


$query = "CREATE TABLE IF NOT EXISTS media
(
	media_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
	src VARCHAR(64) NOT NULL

)";
$sth = $db->prepare($query);
$sth->execute();


/*---------------------------------------------------------------------------*/
/*						T A B L E   E V E N T S
/*---------------------------------------------------------------------------*/

$query = "CREATE TABLE IF NOT EXISTS events
(
	event_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
	location_id INT NOT NULL,
	sport_id INT NOT NULL,
	start_date VARCHAR(32) NOT NULL,
	end_date VARCHAR(32) NOT NULL,
	teams VARCHAR(12),
	sport_status VARCHAR(64) NOT NULL,

	FOREIGN KEY (location_id) REFERENCES locations(location_id),
	FOREIGN KEY (sport_id) REFERENCES sports(sport_id)
)";
$sth = $db->prepare($query);
$sth->execute();
	
	
	// 12
	$time = strtotime('12-02-2016 14:00:00');
	$event1S = date('d-m-Y H:i:s',$time);

	$time = strtotime('12-02-2016 16:00:00');
	$event1E = date('d-m-Y H:i:s',$time);

		$query = "INSERT INTO events
		(event_id, location_id, sport_id, start_date, end_date, teams, sport_status)
		VALUES('1','3', '7', '$event1S', '$event1E', 'SVK - NOR', 'Tournament | Women' )";
		$sth = $db->prepare($query);
		$sth->execute();

	$time = strtotime('12-02-2016 14:00:00');
	$event2S = date('d-m-Y H:i:s',$time);

	$time = strtotime('12-02-2016 16:00:00');
	$event2E = date('d-m-Y H:i:s',$time);

		$query = "INSERT INTO events
		(event_id, location_id, sport_id, start_date, end_date, teams, sport_status)
		VALUES('2', '4', '7', '$event2S', '$event2E', 'FIN - NOR', 'Tournament | Men' )";
		$sth = $db->prepare($query);
		$sth->execute();
	
	$time = strtotime('12-02-2016 09:30:00');
	$event3S = date('d-m-Y H:i:s',$time);

	$time = strtotime('12-02-2016 12:30:00');
	$event3E = date('d-m-Y H:i:s',$time);

		$query = "INSERT INTO events
		(event_id, location_id, sport_id, start_date, end_date, teams, sport_status)
		VALUES('3', '5', '4', '$event3S', '$event3E', 'JPN - ITA', 'Mixed team round robin' )";
		$sth = $db->prepare($query);
		$sth->execute();
		
	$time = strtotime('12-02-2016 12:30:00');
	$event3S = date('d-m-Y H:i:s',$time);

	$time = strtotime('12-02-2016 15:30:00');
	$event3E = date('d-m-Y H:i:s',$time);

		$query = "INSERT INTO events
		(event_id, location_id, sport_id, start_date, end_date, teams, sport_status)
		VALUES('3', '5', '4', '$event3S', '$event3E', 'SWE - NOR', 'Mixed team round robin' )";
		$sth = $db->prepare($query);
		$sth->execute();
		
	
		
	// 13
	
	$time = strtotime('13-02-2016 14:00:00');
	$event4S = date('d-m-Y H:i:s',$time);

	$time = strtotime('13-02-2016 15:30:00');
	$event4E = date('d-m-Y H:i:s',$time);

		$query = "INSERT INTO events
		(event_id, location_id, sport_id, start_date, end_date, sport_status)
		VALUES('4', '1', '5', '$event4S', '$event4E', 'Pairs short program' )";
		$sth = $db->prepare($query);
		$sth->execute();

	$time = strtotime('13-02-2016 16:00:00');
	$event5S = date('d-m-Y H:i:s',$time);

	$time = strtotime('13-02-2016 18:25:00');
	$event5E = date('d-m-Y H:i:s',$time);

		$query = "INSERT INTO events
		(event_id, location_id, sport_id, start_date, end_date, sport_status)
		VALUES('5', '1', '5', '$event5S', '$event5E', 'Short program | Men' )";
		$sth = $db->prepare($query);
		$sth->execute();

	$time = strtotime('13-02-2016 10:30:00');
	$event6S = date('d-m-Y H:i:s',$time);

	$time = strtotime('13-02-2016 13:30:00');
	$event6E = date('d-m-Y H:i:s',$time);

		$query = "INSERT INTO events
		(event_id, location_id, sport_id, start_date, end_date, sport_status)
		VALUES('6', '3', '13', '$event6S', '$event6E', '500m | Ladies and Mens' )";
		$sth = $db->prepare($query);
		$sth->execute();

	$time = strtotime('13-02-2016 13:00:00');
	$event7S = date('d-m-Y H:i:s',$time);

	$time = strtotime('13-02-2016 16:00:00');
	$event7E = date('d-m-Y H:i:s',$time);

		$query = "INSERT INTO events
		(event_id, location_id, sport_id, start_date, end_date, sport_status)
		VALUES('7', '4', '7', '$event7S', '$event7E', 'Skills Challenge Q1')";
		$sth = $db->prepare($query);
		$sth->execute();

	$time = strtotime('13-02-2016 17:00:00');
	$event8S = date('d-m-Y H:i:s',$time);

	$time = strtotime('13-02-2016 19:00:00');
	$event8E = date('d-m-Y H:i:s',$time);

		$query = "INSERT INTO events
		(event_id, location_id, sport_id, start_date, end_date, 'teams' sport_status)
		VALUES('8', '4', '7', '$event8S', '$event8E','CZE - SVK', 'Tournament | Womens' )";
		$sth = $db->prepare($query);
		$sth->execute();
		
	$time = strtotime('13-02-2016 09:00:00');
	$event9S = date('d-m-Y H:i:s',$time);

	$time = strtotime('13-02-2016 12:30:00');
	$event9E = date('d-m-Y H:i:s',$time);

		$query = "INSERT INTO events
		(event_id, location_id, sport_id, start_date, end_date, 'teams' sport_status)
		VALUES('9', '6', '4', '$event9S', '$event9E','USA - SUI', 'Mixed team round robin' )";
		$sth = $db->prepare($query);
		$sth->execute();
		
	$time = strtotime('13-02-2016 10:00:00');
	$event9S = date('d-m-Y H:i:s',$time);

	$time = strtotime('13-02-2016 12:00:00');
	$event9E = date('d-m-Y H:i:s',$time);

		$query = "INSERT INTO events
		(event_id, location_id, sport_id, start_date, end_date, 'teams' sport_status)
		VALUES('9', '7', '8', '$event9S', '$event9E','USA - SUI', 'Mixed team round robin' )";
		$sth = $db->prepare($query);
		$sth->execute();
	
	// 14
	
	$time = strtotime('14-02-2016 10:00:00');
	$event10S = date('d-m-Y H:i:s',$time);

	$time = strtotime('14-02-2016 12:00:00');
	$event10E = date('d-m-Y H:i:s',$time);

		$query = "INSERT INTO events
		(event_id, location_id, sport_id, start_date, end_date, sport_status)
		VALUES('10', '3', '13', '$event10S', '$event10E', '1500m | Ladies and Mens' )";
		$sth = $db->prepare($query);
		$sth->execute();
		
	$time = strtotime('14-02-2016 09:00:00');
	$event11S = date('d-m-Y H:i:s',$time);

	$time = strtotime('14-02-2016 10:00:00');
	$event11E = date('d-m-Y H:i:s',$time);

		$query = "INSERT INTO events
		(event_id, location_id, sport_id, start_date, end_date, sport_status)
		VALUES('11', '10', '12', '$event11S', '$event11E', 'Halfpipe finals | Ladies' )";
		$sth = $db->prepare($query);
		$sth->execute();
		
	$time = strtotime('15-02-2016 09:00:00');
	$event12S = date('d-m-Y H:i:s',$time);

	$time = strtotime('15-02-2016 10:00:00');
	$event12E = date('d-m-Y H:i:s',$time);

		$query = "INSERT INTO events
		(event_id, location_id, sport_id, start_date, end_date, sport_status)
		VALUES('12', '10', '12', '$event12S', '$event12E', 'Halfpipe finals | Ladies' )";
		$sth = $db->prepare($query);
		$sth->execute();
		
	$time = strtotime('15-02-2016 09:00:00');
	$event12S = date('d-m-Y H:i:s',$time);

	$time = strtotime('15-02-2016 10:00:00');
	$event12E = date('d-m-Y H:i:s',$time);

		$query = "INSERT INTO events
		(event_id, location_id, sport_id, start_date, end_date, sport_status)
		VALUES('13', '10', '12', '$event12S', '$event12E', 'Halfpipe finals | Ladies' )";
		$sth = $db->prepare($query);
		$sth->execute();
		
	$time = strtotime('16-02-2016 09:00:00');
	$event12S = date('d-m-Y H:i:s',$time);

	$time = strtotime('16-02-2016 10:00:00');
	$event12E = date('d-m-Y H:i:s',$time);

		$query = "INSERT INTO events
		(event_id, location_id, sport_id, start_date, end_date, sport_status)
		VALUES('14', '10', '12', '$event12S', '$event12E', 'Halfpipe finals | Ladies' )";
		$sth = $db->prepare($query);
		$sth->execute();
		
	$time = strtotime('15-02-2016 09:00:00');
	$event12S = date('d-m-Y H:i:s',$time);

	$time = strtotime('15-02-2016 10:00:00');
	$event12E = date('d-m-Y H:i:s',$time);

		$query = "INSERT INTO events
		(event_id, location_id, sport_id, start_date, end_date, sport_status)
		VALUES('15', '10', '12', '$event12S', '$event12E', 'Halfpipe finals | Ladies' )";
		$sth = $db->prepare($query);
		$sth->execute();
		
	$time = strtotime('15-02-2016 09:00:00');
	$event12S = date('d-m-Y H:i:s',$time);

	$time = strtotime('15-02-2016 10:00:00');
	$event12E = date('d-m-Y H:i:s',$time);

		$query = "INSERT INTO events
		(event_id, location_id, sport_id, start_date, end_date, sport_status)
		VALUES('16', '10', '12', '$event12S', '$event12E', 'Halfpipe finals | Ladies' )";
		$sth = $db->prepare($query);
		$sth->execute();


/*---------------------------------------------------------------------------*/
/*						T A B L E   P O S T S
/*---------------------------------------------------------------------------*/

$query = "CREATE TABLE IF NOT EXISTS posts
(
	post_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
	event_id INT NOT NULL,
	media_id INT,
	media_type INT,
	username VARCHAR(32) NOT NULL,
	user_type TINYINT(2),
	post_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	post_text VARCHAR(128) NOT NULL,

	FOREIGN KEY (event_id) REFERENCES events(event_id),
	FOREIGN KEY (media_id) REFERENCES media(media_id),
	FOREIGN KEY (username) REFERENCES users(username)

)";
$sth = $db->prepare($query);
$sth->execute();



/*---------------------------------------------------------------------------*/
/*						T A B L E   C O M M E N T S
/*---------------------------------------------------------------------------*/


$query =
"CREATE TABLE IF NOT EXISTS comments
(
	comment_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
	post_id INT NOT NULL,
	username VARCHAR(32) NOT NULL,
	comment_text VARCHAR(1024) NOT NULL,
	timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

	FOREIGN KEY (username) REFERENCES users(username) ON DELETE CASCADE,
	FOREIGN KEY (post_id) REFERENCES posts(post_id) ON DELETE CASCADE
)";

$sth = $db->prepare($query);
$sth->execute();


/*---------------------------------------------------------------------------*/
