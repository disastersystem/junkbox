<?php


try 							// Attempt a connection to the database:
{
	$db = new PDO('mysql:host=127.0.0.1','root','');
	//$db = new PDO("mysql:host=susannlundekvam2.mysql.domeneshop.no;dbname=susannlundekvam2", "susannlundekvam2", "7zBiYeBmXXdLXEi");
}
catch (PDOException $e)			// If an error is detected
{
	if (isset($debug))			// If we are doing development
		die ('Unable to connect to database : '.$e->getMessage());

	else 						// Do NOT show above information to end users.
		die ('Unable to connect to database, please try again later');
}
include_once("createDB.php");
?>
