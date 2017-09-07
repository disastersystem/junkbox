/*
	AUTHOR: 	Henrik Oddløkken

		T A B L E   OF   C O N T E N T S 
					
		- Variables Deceleration
			- Declare all states
			- Sound
			- Constants
			
		- Functions
			- setToPosition()
			- setAnimation()
			- moveBackground(endPosition)
			- initMainMenu()
			- resetSoundButtonsColor()
			
		- Pages | States (Functions)
			- pageStart				( State 1 )
			- pageSettings			( State 1 )
			- pageCategory			( State 2 )
			- pageLevel(catTitle)	( State 3 )
			
		- Window Events
			- Window load			( Initialize the view )
			- Window resize			( On orientation change )
			
		- User Interaction
			Adds event listeners to each button.
		
*/

/*---------------------------------------------------------------------------*/
$(document).ready(function()
{
	
/*---------------------------------------------------------------------------*/
/* 				V A R I A B L E S   D E C E L E R A T I O N
/*---------------------------------------------------------------------------*/
	
	curState = 0;									// Keeps current state in memory.

	var stateHome 	= $('.state[role=home]');		// State of front page.
	var stateSet  	= $('.state[role=settings]');	// State of settings.
	var stateCat  	= $('.state[role=category]');	// State of categories.
	var stateLevel  = $('.state[role=level]');		// State of levels of selected category.

	var mainTheme = initMainTheme();				// Audio object: Main Theme.
	
	var volume = 5;									// Keeps the current volume in memory
	
	var windowAnimate = false;						// The state of window being in animation.
	
	var SLIDE_STEP = 50;							// One background step in percentage for moving the background's x-position.
	var POPUP_TIME = 450;							// Animation time for "popUp" effect in milliseconds.
	var SLIDE_TIME = POPUP_TIME / SLIDE_STEP;		// How long the animation should take when moving the background in milliseconds.

/*---------------------------------------------------------------------------*/
/* 								F U N C T I O N S
/*---------------------------------------------------------------------------*/

	
	/**
	*	Set elements to position:
	*	Calculate from the current window size
	*/
	function setToPosition()
	{
		$('#mainMenu').css
		({
			'height' : $(window).height() + 'px'
		});
		
		//if(curState == 1)
			//$('.buttonItemsConainer').css('height',$(window).height() - $('.titleHeader').outerHeight());
	}
	
	/**
	*	Buttons with an animation that loops infinite.
	*/
	function setAnimation()
	{
		$('.button[role=playButton]').addClass('buttonMove');
	}
	
	/**
	*	Move the background
	*	Parameter endPosition is the position for where 
	*	the background view should be animated to.
	*/
	function moveBackground(endPosition)
	{
		windowAnimate = true;					// The window is currently animated.
		
												// Split to array e.g. ["0%", "50px"]:
		 var backgroundPos = $('#mainMenu')
		.css('backgroundPosition').split(" ");
												// Get the position of the current background position.
		var xPos = parseInt(backgroundPos[0]),
			yPos = parseInt(backgroundPos[1]); 
		
		var count = xPos;						// Keep the x position as a counter to draw each frame.
		
		function draw()							// Animate the background: 
		{
			$('#mainMenu').css('background-position',count + '% 0%');
			
			if(endPosition > xPos) 				// The end position is greater than the current background position, move right.
				count += 1;
			else 								// Move left.
				count -= 1;
		}
		
		setInterval(function() 					// Start moving the background.
		{
			if(count != endPosition)
				draw();
			else
				windowAnimate = false;
		},SLIDE_TIME,draw);
		
		/* if(xPos == 100 && dir)
			return false;
		else if(xPos == 0 && !dir)
			return true;
		
		return dir; */
	}
	
	/**
	*	On orientation change:
	*	Set window to new orientation.
	*/
	function screenSizeChange()
	{
		setToPosition();
	}
	
	/**
	*	Initializing the view.
	*	Render the view then remove the loading message.
	*	Return true when completed.
	*/
	function initMainMenu()
	{
		setToPosition();
		$('#loadingWrapper').css('display','none');
		
		return true;
	}
	/**
	*	Resets the colour of the sound buttons
	*/
	function resetSoundButtonsColor()
	{
		$('.buttonItems[role=addSound]').css
		({
			'background' : '#0a5',
			'border-bottom': '6px solid #085',
			'text-shadow':	'0 4px #085',
			'color':'#fff'
		});
		
		$('.buttonItems[role=subSound]').css
		({
			'background' : '#dd5454',
			'border-bottom': '6px solid #bd5454',
			'text-shadow':	'0 4px #bd5454',
			'color':'#fff'
		});
	}
	
/*---------------------------------------------------------------------------*/
/* 						   P A G E S  |  S T A T E S
/*---------------------------------------------------------------------------*/	
	/**
	*	Click Play from the menu:
	*	Hide this state.
	*	Display: categories.
	*/
	function pageStart()
	{
		curState = 0;
		moveBackground(0);
		
		// hide states:
		stateCat.css('display','none');
		stateSet.css('display','none');
		
		// Show Home:
		stateHome.addClass('popIn');
		stateHome.css('display','block');
		
		setToPosition();
	}
	
	/**
	*	Click Play from the menu:
	*	Hide this state.
	*	Display: Settings.
	*/
	function pageSettings()
	{
		curState = "settings";
		
		// hide states:
		stateHome.css('display','none');
		
		// Show Settings:
		stateSet.css('display','block');
		stateSet.find('.titleHeader .titleText').addClass('rightIn');
		stateSet.find('.buttonItems').css('display','block');
		
		
		setToPosition();
	}
	
	/**
	*	Click Play from the menu:
	*	Hide this state.
	*	Display: categories.
	*/
	function pageCategory()
	{
		curState = 1;
		moveBackground(SLIDE_STEP);
		
		// hide this state:
		stateHome.css('display','none');
		stateLevel.css('display','none');
		
		// Show category:
		stateCat.css('display','block');
		stateCat.find('.titleHeader .titleText').addClass('rightIn');
		setTimeout(function()
		{
			stateCat.find('.buttonItems').addClass('popIn');
		},POPUP_TIME);

		setToPosition();
	}
	
	/**
	*	Select a category from the menu:
	*	Hide this state.
	*	Display: the selected category's levels.
	*	Parameters: category title.
	*/
	function pageLevel(catTitle)
	{
		curState = 2;
		moveBackground(SLIDE_STEP * 2);
		
		var levelContainer = stateLevel.find('.buttonItemsConainer');
		
		levelContainer.empty();
		
		// hide this state:
		stateCat.css('display','none');
		
		// Show Levels:
		stateLevel.css('display','block');
		stateLevel.find('.titleHeader .titleText').addClass('rightIn').text(catTitle);
		
		// Get number of levels for this category 
			// (add +1, due to levels doesn't start at 0):
		var nrOfLvls = numberOfLevels( allCatgories[catTitle] ) + 1;
		
		// Add levels to view:
		for (var i = 1; i < nrOfLvls; i++)
		{
			var itemlevel =
			[
				'<a role = "level" class = "buttonItems"',
				'href="game.html?c=' + catTitle + '&l=' + i + '">',
				'level '+ i +'</a>'
			].join('');
			
			levelContainer.append(itemlevel);
			setTimeout(function()
			{
				levelContainer.find('.buttonItems').addClass('popIn');
			},POPUP_TIME);
		}
		
		setToPosition();
	}
	
/*---------------------------------------------------------------------------*/
/* 						 W I N D O W   E V E N T S
/*---------------------------------------------------------------------------*/
	/**
	*	Event listener for window loaded first time:
	*/
	$(window).load(function()
	{
		if( initMainMenu() )
		{
			mainTheme.play();
			
			//testSound();
			
			pageStart();
			setAnimation();
		}
		
		/* var move = true;
		
		setInterval(function()
		{
			move = moveBackground(move);
			console.log(move);
		},80); */
		
		
	});
	
	/**
	*	Event listener for window resized:
	*	Used to orientation changes, Landscape | Portrait.
	*/
	$(window).resize(function()
	{
		screenSizeChange();
	});

/*---------------------------------------------------------------------------*/
/* 						 U S E R   I N T E R A C T I O N
/*---------------------------------------------------------------------------*/
	
	/**
	*	Current state is first page: Play and settings.
	*	Go to "Settings"
	*/
	$('.button[role=settingsButton]').on('click',function()
	{
		if(!windowAnimate)
			pageSettings();
	});
	
	/**
	*	Current state is first page: Play and settings.
	*	Go to "Choose a Category"
	*/
	$('.button[role=playButton]').on('click',function()
	{
		if(!windowAnimate)
			pageCategory();
		
	});
	
	/**
	*	Current state is "Choose a Category".
	*	Go to This category's levels:
	*/
	$('.buttonItems[role=category]').on('click',function()
	{
		if(!windowAnimate)
			pageLevel( $(this).text() );
	});
	
	/**
	*	Go back one state.
	*	By keeping the number of the state as a global variable, 
	*   it is possible to reuse the back button with one function.
	*/
	$('.backButton').on('click',function()
	{
		// Not the first state?
		if(curState > 0)
			curState -= 1;
		
		// You are at settings, go to start.
		else if(curState == "settings")
			curState = 0;
		
		if(!windowAnimate)
		{
			switch(curState)
			{
				case 0: pageStart(); 	break;
				case 1: pageCategory(); break;
				case 2: pageLevel(); 	break;
			}
		}
	});
	
	/**
	*	At settings: Mute the soundtrack:
	*/
	$('.buttonItems[role=mute]').on('click',function()
	{
		if(!mainTheme.muted)
		{
			mainTheme.muted = true;
			
			$(this).css
			({
				'background' : '#046',
				'border-bottom': '6px solid #024',
				'text-shadow':	'0 4px #024',
				'color':'#aaa'
			});
		}
		else
		{
			mainTheme.muted = false;
			$(this).css
			({
				'background' : '#08a',
				'border-bottom': '6px solid #068',
				'text-shadow':	'0 4px #068',
				'color':'#fff'
			});
		}
	});
	
	/**  
	*	Turn the volume up:
	*/
	$('.buttonItems[role=addSound]').on('click',function()
	{
		if(volume != 10)
		{
			volume += 1;
			mainTheme.volume = volume / 10;
			
			resetSoundButtonsColor();
			
			if(volume == 10)
			{
				$(this).css
				({
					'background' : '#063',
					'border-bottom': '6px solid #041',
					'text-shadow':	'0 4px #041',
					'color':'#aaa'
				});
			}
		}
	});
	
	/**
	*	Turn the volume down:
	*/
	$('.buttonItems[role=subSound]').on('click',function()
	{
		if( volume != 0 )
		{	
			volume -= 1;
			mainTheme.volume = volume / 10;
			
			resetSoundButtonsColor();
			
			if(volume == 0)
			{
				$(this).css
				({
					'background' : '#bd5454',
					'border-bottom': '6px solid #9d3434',
					'text-shadow':	'0 4px #9d3434',
					'color':'#aaa'
				});
			}
		}
	});


/*---------------------------------------------------------------------------*/	
});// End doc ready.