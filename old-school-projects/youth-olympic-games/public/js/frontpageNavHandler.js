/*
 * Handles the front page content:
 */
 
$(document).ready(function()
{ 
	
	var navIndex = 0;
	
	function setArrowPosition()
	{
		switch(navIndex)
		{
			case 0: $('#navArrow').animate({'left': '25%'},800); break;
			case 1: $('#navArrow').animate({'left': '75%'},800); break;
		}	
	} 
	 
	function setContent(url)
	{
		setArrowPosition();
		$('#frontpageContainer').load(url);
	}

	$('.navCustom li').on('click',function()
	{
		$('.navCustom li').removeClass('aaa');
		$('.navCustom li').css('-webkit-animation', '');
		
		var url = $(this).attr('data-url');
		
		
		var index = $('.navCustom li').index(this);
		
		navIndex = index;
		
		setContent(url);

		//$(this).addClass('aaa');
		
		/* if( $(this).attr('role') == 'event' )
			$(this).css('-webkit-animation', 'left .4s');
		else
			$(this).css('-webkit-animation', 'right .4s'); */
	});
	
	/*
	* Swipe right:
	*	Go to events.php
	*/
	$(function()
	{  
		$('#frontpageContainer').on( "swiperight", function()
		{
			if($(window).width() <= MOBILE_WIDTH)
			{
				if(navIndex == 1)
				{
					navIndex = 0;
					setContent('partials/events.php');
				}
			}
		});
	});
	
	
	/*
	* Swipe left:
	*	Go to statistics.php
	*/
	$(function()
	{  
		$('#frontpageContainer').on( "swipeleft", function()
		{
			if($(window).width() <= MOBILE_WIDTH)
			{
				if(navIndex == 0)
				{
					navIndex = 1;
					setContent('stats.php');
					
				}
			}
		});
	});
	
	$('.m_person').on('click',function()
	{
		$('.loginRegisterModal').show();
	});
	
	$('.exitModal').click(function()
	{
		$('.loginRegisterModal').hide();
		$('.loginRegisterModal input').val("");
		$('.errorMessages').text("");
	});
	
	

});
