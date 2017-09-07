<?php
	require_once('../../../includes/db.php');					// Create Database.
	
	$events = array();
	
	$query = "	SELECT * 
				FROM events
				ORDER BY start_date";
				
	$event = $db->prepare($query);					
	$event->execute();		
	
	while($row = $event->fetch(PDO::FETCH_ASSOC))	// Fetch all rows as array
	{	
		$item = array();
	
		$queryLocation = "SELECT * 
						  FROM locations 
						  WHERE location_id = ?";
						  
		$sth = $db->prepare($queryLocation);
		$sth->execute(array($row['location_id']));
		
		if($locationItem = $sth->fetch())
			$location = $locationItem['location_name'];
		else
			$location = "ERROR";
		
		
		$querySport = "SELECT * 
					   FROM sports 
					   WHERE sport_id = ?";
						  
		$sth = $db->prepare($querySport);
		$sth->execute(array($row['sport_id']));
		
		if($sportItem = $sth->fetch())
			$sport = $sportItem['sport_name'];
		else
			$sport = "ERROR";
		
		if($row['teams'] == null)
			$row['teams'] = "";
		
		/*  Convert dates to simple format, 	
			EG: date = 12, clock start = 12:00:00 */
			
		$date = substr($row['start_date'],0,2);
		
		$startClock = substr($row['start_date'],11,12);
		$endClock = substr($row['end_date'],11,12);
		
		
		array_push( $item, $row['event_id'], $location, $sport, $date, $startClock, $endClock, $row['teams'], $row['sport_status']  );
		array_push( $events, $item ); 	
	}
	
	echo json_encode($events);
	
	