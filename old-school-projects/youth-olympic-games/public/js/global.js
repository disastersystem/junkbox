(function($)
{

	
/*----------------------------------------------------------------------------*/
/*						  C E N T E R I N G   O B J E C T
/*----------------------------------------------------------------------------*/
	$.fn.centerElem = function()
	{
		$(this).css
		({
			'top'  : $(window).height() / 2 - $(this).outerHeight() / 2,
			'left' : $(window).width()  / 2 - $(this).outerWidth()  / 2
		})
	}
	
/*----------------------------------------------------------------------------*/
/*					   T U R N   D O W N   F O R   W H A T ?
/*----------------------------------------------------------------------------*/
	
})(jQuery);
	