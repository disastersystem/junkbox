$(document).ready(function()
{
	
	initDates();	// Init all dates
	
	calcCalender(); // Calculate the calender positions due to window size.
	
	loadEvents();	// Load the events for current date. 
	

/*---------------------------------------------------------------------------*/
/* 						 W I N D O W   F U N C T I O N S
/*---------------------------------------------------------------------------*/

	$(window).load(function()
	{
		//$('.loadingWrapper').hide();
		//alcCalender();
	});
	
	$(window).resize(function()
	{
		calcCalender();
	});
	
	setInterval(function()
	{
		update();
	},1000);
	
/*---------------------------------------------------------------------------*/
/* 						 U S E R   I N T E R A C T I O N
/*---------------------------------------------------------------------------*/

	$('.eventDates').delegate('.eventDate','click',function()
	{
		mainIndex = $(this).index();	// Get date element.
		
		renderEvents(olDates[mainIndex]);
	
		setDateIndex();
	});
	

	$('.datePrev').click(function()
	{
		if(mainIndex > 0)
		{
			mainIndex -= 1;
			renderEvents(olDates[mainIndex]);
			setDateIndex();
			
			scrollToDate();
		}
		
		
	});

	$('.dateNext').click(function()
	{
		if(mainIndex < olDates.length-1)
		{
			mainIndex += 1;
			renderEvents(olDates[mainIndex]);
			setDateIndex();
			
			scrollToDate();
		}

	});
	
	/**
	* Click on event:
	*/
/* 	$('.events').delegate('li','click',function()
	{
		$(this).css('-webkitAnimation','scale .4s');
	}); */
		
}); // End doc ready.