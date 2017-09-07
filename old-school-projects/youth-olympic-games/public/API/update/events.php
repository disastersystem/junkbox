<?php
	require_once('../../includes/db.php');					// Create Database.
	
	$query = "	SELECT * 
				FROM events";
				
	$event = $db->prepare($query);					
	$event->execute();		
	
	while($row = $event->fetch(PDO::FETCH_ASSOC))	// Fetch all rows as array
	{	
		
		
	}
	
	
	