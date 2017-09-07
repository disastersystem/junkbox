
/*---------------------------------------------------------------------------*/
/* 					V A R I A B L E S   D E C L R A T I O N
/*---------------------------------------------------------------------------*/

	var START_DATE 	 =	 12;
	var END_DATE 	 =	 21; 
	
	var mainIndex 	 = 	 0;
	
	var olDates 	 =   [];				// Store all dates.
	
	var eventDateSrc =   '<div class = "eventDate"></div>';
	
/*---------------------------------------------------------------------------*/
/* 								F U N C T I O N S
/*---------------------------------------------------------------------------*/

	function initDates()
	{
		for(var i = START_DATE; i <= END_DATE; i++)
		{
			$('.eventDates').append('<div class = "eventDate">' + i + '</div>');
		
			olDates.push(i);
		}
	}
	
	function scrollToDate()
	{
		var dateBoxHeight = 0;
		
		/* if ( $(window).width() > MOBILE_WIDTH )
			dateBoxHeight = $('.activeDate').outerHeight(true) / 2;	// Desktop / Tablet
		else */
			dateBoxHeight = $('.activeDate').outerHeight(true);		// Mobile.
		
		$('.eventDates').scrollTop( $('.eventDates').scrollTop() 
		+ $('.eventDate').eq(mainIndex).position().top  - dateBoxHeight);
	}
	
	function disablePaginationButtons()
	{
		$('.datePrev').removeClass('disabledPagButton');
		$('.dateNext').removeClass('disabledPagButton');

		switch(mainIndex)
		{
			case 0: 				
				$('.datePrev').addClass('disabledPagButton');
				break;
				
			case olDates.length-1:
				$('.dateNext').addClass('disabledPagButton'); 
				break;
		}
	}
	
	function searchDate(day)
	{
		var dateCheck = false;
		
		for(var i = 0; i < olDates.length; i++)
		{
			if(day == olDates[i])
			{
				dateCheck = true;
				break;
			}
			else
				dateCheck = false;
		}
		
		if(dateCheck) 		// found date
				return day;
			else 			// could not find the date.
				return 0; 	// set to 12 == 0
	}
	
	/**
	* 	Set marker in calender for selected date.
	*	Add header date.
	*/
	function setDateIndex()
	{
		$('.eventDate').removeClass('activeDate').css('-webkitAnimation','');
		$('.eventDate').eq(mainIndex).addClass('activeDate').css('-webkitAnimation','scale .4s');
		
		$('.headerDate').html('<span class = "headerNr">'+olDates[mainIndex] + '</span>february');
		
		disablePaginationButtons();
	}
	
	/**
	* Calculate the height of window and menu 
	* to set the size of the event page.
	*/
	function calcCalender()
	{
		
	 	if($(window).width() < 800)
			$('.calenderHeader').html('<i class="fa fa-calendar"></i>')
		else
			$('.calenderHeader').html('dates <i class="fa fa-calendar"></i>')
		
		// Get menu size:
		var mainMenuH = parseInt( $('.main-menu').outerHeight(true) );
		var subMenuH  = parseInt( $('.navCustom').outerHeight(true) );
		
		
		// Set calenderBar to windowHeight, subtract menus height:
		$('.eventDates').css('height',$(window).height() - mainMenuH - subMenuH );
		
		// Set eventsContainer to windowHeight, subtract menus height:
		$('.eventsContainer').css('height',$(window).height() - mainMenuH - subMenuH );
		
		var calenderContentHeight = $('.datePrev').outerHeight(true) + $('.dateNext').outerHeight(true) + $('.calenderHeader').outerHeight(true);
		
		$('.eventDates').css('height' , $('.eventsContainer').outerHeight(true) - calenderContentHeight);
				
		setDateIndex();		

	}


	