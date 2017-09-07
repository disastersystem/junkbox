	
	
/*---------------------------------------------------------------------------*/
/* 					V A R I A B L E S   D E C L R A T I O N
/*---------------------------------------------------------------------------*/
	
	var eventsList = [];
	
	var sportIconList =
	[
		'alpine skiing',
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
		'speed skating'
	];
	
	var renderClock = false;	// Whether the clock should be rendered or not.

	
/*---------------------------------------------------------------------------*/
/* 								F U N C T I O N S
/*---------------------------------------------------------------------------*/
	/*
	*	if the current month isn't February, return 12.
	*		if the current date doesn't match any Olympic dates, return 12.
	*/
	function getCurrentDate()
	{
		var dateCheck = false;
		
		var today = new Date();
		
		var day = parseInt( today.getDate() );
		
		
		if(today.getMonth() == 1) 	// is this month February?  
		{
			var day = parseInt( today.getDate() ); 	// get date.
		
			return searchDate(day);		// Returns index array.
		}
		else
			return 0; 	// returns 12.
	}
	
	function randomAnimation()
	{
		var nr = Math.floor((Math.random() * 3) + 1);
		switch(nr)
		{
			case 1: return "left"; 		break;
			case 2: return "top"; 		break; 
			case 3: return "scale"; 	break;
		}
	}
	
	function initCurEvents(day)
	{
		var eventItems = [];
		
		for(var i = 0; i < eventsList.length; i++)
		{
			if(eventsList[i][3] == day)
				eventItems.push(eventsList[i]);	
		}

		return eventItems;
	}
	/**
	 * Find sport and return matching icon:
	 * Parameter: sport in text format.
	 */
	function findSportIcon(sport)
	{
		var check = false;
		var icon = 0;
		
		for (var i = 0; i < sportIconList.length; i++)
		{
			if(sport == sportIconList[i])
			{
				check = true;
				icon = i;
				break;
			}
			else
				check = false;
		}
		
		if(check)
			return icon;
		else
			return 0;
	}
	
	function renderEvents(day)
	{
		
		$('.eventsContainer').css('overflow-y','none');
		
		if (olDates[getCurrentDate()] == olDates[mainIndex])
			renderClock = true;
		else
			renderClock = false;
		
		var eventItem = initCurEvents(day);

		$('.events').html('');
		
		if( eventItem.length > 0 )
		{	
			var anim = randomAnimation();
			
			for(var i = 0; i < eventItem.length; i++)
			{
				if(renderClock)
				{
					// Converts array element to string type:
					var element = 
					[
						'<a href = "posts.php?event_id='+eventItem[i][0]+'" >',
							'<li>',
								'<div class = "col-lg-6 col-md-4 col-sm-5 col-xs-5">',
									'<div class = "progBG">',
										'<div class = "event" startTime = "'+eventItem[i][4]+'">',
											'<div class = "clockText"></div>',
											'<div class = "clock"></div>',
											'<div class = "seconds"></div>',
										'</div>',
										'<div class = "progRad"></div>',
									'</div>',
								'</div>',
								'<div class = "title">'+eventItem[i][2]+'</div>',
								'<div class = "eventStatus">'+eventItem[i][7]+'</div>',
								'<div class = "teams">'+eventItem[i][6]+'</div>',
								'<div class = "location"> '+eventItem[i][1]+' <i class="fa fa-map-marker"></i></div>',
							'</li>',
						'</a>'
					].join('');
				}
				else
				{
					// Converts array element to string type:
					
					var startTimeView = eventItem[i][4].substring(0,5);
					
					var element = 
					[
						'<a href = "posts.php?event_id='+eventItem[i][0]+'" >',
							'<li>',
								'<h4  class = "regStartTime"><sup>Starts at</sup><br> ' + startTimeView + '</h4>',
								'<div class = "title">'+eventItem[i][2]+'</div>',
								'<div class = "eventStatus">'+eventItem[i][7]+'</div>',
								'<div class = "teams">'+eventItem[i][6]+'</div>',
								'<div class = "location"> '+eventItem[i][1]+' <i class="fa fa-map-marker"></i></div>',
							'</li>',
						'</a>'
					].join('');
				}
					
				$('.events').append(element);	
				
				var icon = findSportIcon(eventItem[i][2]);
				
				var time = i / 5 +.5;
				$('.events li').eq(i).css('-webkit-animation', anim + ' ' + time + 's');
				$('.events li').eq(i).css('background-image','url("img/sportIcons/'+icon+'.png")');
				
				
				
			}
			
			setTimeout(function()
			{
				$('.eventsContainer').css('overflow-y','auto');
			}, 1000 * (eventItem.length / 5 + .5) );
			
			// Long shadow:
			var str  = "";
			
			for(var i = 0; i <= 30; i+=.3)
			{
				str += i + 'px ' + i + 'px #168696,';
			}
			$('.events li').find('.title')
			.css({'text-shadow' : str});
			
			// End long shadow.
			
			if(renderClock)
			{
				// set clock progress:
				var index = 0;
				$('.events li').each(function() 			// Loop through all events.
				{
					index = $('.events li').index(this);
					setProgress($(this), index); 					// Calculate progress.
					$(this).css('background-position','center center');
					$(this).css('background-size','48px 48px');
					$(this).css('box-shadow','0 4px #078');
				});
				// End set clock progress.
			}
			
			return true;
		}
		else
			$('.events').html('<h1 class = "minorError" style = "font-size: 200%;">No Events Today</h1>');
	}
	
	function calcRemainingTime(event, startTime) 		// Calculate the percentage of countdown:
	{
		var hourNow = parseInt(new Date().getHours());
		var minNow  = parseInt(new Date().getMinutes());
		var secNow  = parseInt(new Date().getSeconds());
		
		var startHour = parseInt(startTime.slice(0,2));
		var startMin  = parseInt(startTime.slice(3,5));
		var startSec = 0;
		
		var totStartMin  = startHour * 60 + startMin;
		var totNowMin  = hourNow * 60 + minNow;
		
		var totStartSec = totStartMin * 60 + startSec;
		var totNowSec = totNowMin * 60 + secNow;
		
		var curDate = olDates[getCurrentDate()];		// Get current date.
		
		if(totStartMin > totNowMin || olDates[mainIndex] > curDate ) 	// Event hasn't started.
		{
			var additionalHours = 24 * (olDates[mainIndex] - curDate);
			
			var ss = totStartSec - totNowSec;
			
			var hh = Math.floor(ss / 3600);
			ss -= hh * 3600; 
			
			var mm  = Math.floor(ss / 60);
			ss -= mm * 60; 
			
			hh += additionalHours;
			
			if(hh < 10)
			{
				hh = hh.toString();
				hh = "0".concat(hh);
			}	
			if(mm < 10)
			{
				mm = mm.toString();
				mm = "0".concat(mm);
			}
			if(ss < 10)
			{
				ss = ss.toString();
				ss = "0".concat(ss);
			}
			
			event.find('.clockText').text('starts in');
			event.find('.clock').text(hh + ':' + mm);
			event.find('.seconds').text(ss);
		}
		else
			event.find('.clockText').html('finished');
		/*--------------------*/
		
		var newMinNow = minNow / 60;
		var newStartMin = startMin / 60;
		
		var diffStart = startHour + newStartMin;
		var diffNow = hourNow + newMinNow;
		
		var temp = diffStart - diffNow
	
		var diff = 24 - temp;
		
		var prcnt = diff / 24 * 100;
	
		return prcnt;
	
	}

	function setProgress(elem, index)
	{
		var event = elem.find('.event'); 				// Refer this as event
		
		var progress = calcRemainingTime				// Get data: year, month, percentage.
		(event, event.attr('startTime')); 
		
		var progBar = elem.find('.progRad'); 			// Get progress bar to set percentage.
		
		var step = 25;									// Each step is 25%.
		
		var res = 0; 									// Result of the calculated percentage.
		var node = 0; 									// Clip path polygon node to manipulate.
		
														// The calculated percentage, set node.
		
		if(progress <= step) 							//  0%  -  25%. 
			node = 1;
		else if(progress <= step * 2) 					// 25%  -  50%.
			node = 2;
		else if(progress <= step * 3) 					// 50%  -  75%.
			node = 3;
		else if(progress <= step * 4) 					// 75%  -  100%.
			node = 4;
			
		
		/* 
			The clip path polygon uses coordinates in
			percentage to determine the position.
			Node one & two has 0 as 100% and node three
			and four vice versa.
		*/
		
		if(node < 3) 									// The node is either 1 or 2.
			res =  100 - (progress - (step * (node-1))) / step * 100;
		else
			res = (progress - (step * (node-1))) / step * 100;	
		
		switch(node)   // Set result value in percentage relative to the node value.
		{
			case 1:
			progBar.css
			({
				'-webkit-clip-path':'polygon(50% 50%, 100% 100%, '+ res +'% 100%, 50% 50%, 50% 50%, 50% 50%)',
				'clip-path':'polygon(50% 50%, 100% 100%, '+ res +'% 100%, 50% 50%, 50% 50%, 50% 50%)'
			});
			break;
			
			case 2:
			progBar.css
			({
				'-webkit-clip-path':'polygon(50% 50%, 100% 100%, 0% 100%, 0% '+ res +'%, 50% 50%, 50% 50%)',
				'clip-path':'polygon(50% 50%, 100% 100%, 0% 100%, 0% '+ res +'%, 50% 50%, 50% 50%)'
			});
			break;
			
			case 3:
			progBar.css
			({
				'-webkit-clip-path':'polygon(50% 50%, 100% 100%, 0% 100%, 0% 0%, '+ res +'% 0%, 50% 50%)',
				'clip-path':'polygon(50% 50%, 100% 100%, 0% 100%, 0% 0%, '+ res +'% 0%, 50% 50%)'
			});
			break;
			
			case 4:
			progBar.css
			({
				'-webkit-clip-path':'polygon(50% 50%, 100% 100%, 0% 100%, 0% 0%, 100% 0%, 100% '+ res +'%)',
				'clip-path':'polygon(50% 50%, 100% 100%, 0% 100%, 0% 0%, 100% 0%, 100% '+ res +'%)'
			});
			break;
		}
	}

	function update()
	{	
		if( renderClock )
		{
			var index = 0;
			$('.events li').each(function() 			// Loop through all events.
			{
				index = $('.events li').index(this);
				setProgress($(this), index); 					// Calculate progress.
				
			});
		}
	}
	
/*---------------------------------------------------------------------------*/
/* 						 		A J A X   C A L L S
/*---------------------------------------------------------------------------*/
	function loadEvents()
	{
		var url = "API/read/events.php";
		
		$.ajax
		({
			type: 	"GET",
			url: 	url,
			crossDomain: true,
			success: function(data)
			{
				
				
				
				eventsList = JSON.parse(data);
				
				mainIndex = getCurrentDate();	// array index.
				
				renderEvents(olDates[mainIndex]);
				
				
				
				return true;
				
			},
			error: function(xhr, status, error)
			{	
				alert(xhr.responseText);			  
			}
			
			
		});
		
	}





/*---------------------------------------------------------------------------*/	
