$(document).ready(function()
{
	var str  = "";
	for(var i = 0; i <= 30; i+=.3)
	{
		str += i + 'px ' + i + 'px #168696,';
	}
	$('.eventsContainer li').find('.title')
	.css({'text-shadow' : str});

	
/*---------------------------------------------------------------------------*/

	
 /* var base 	= ["#fc6771", "#16a085", "#00aacc", "#d273ef"];
	var shade 	= ["#ef5364", "#039378", "#0093b3", "#c568d4"];
	var shadow 	= ["#cc3741", "#068065", "#0088aa", "#b253cf"]; 
	
	function setColor(elem, index)
	{
		var str  = "";
		for(var i = 0; i <= 50; i+=.3)
		{
			str += i + 'px ' + i + 'px '+ shade[index] +',';
		}
		elem
		.css
		({
			'background-color'	: base[index],
			'text-shadow' 		: str
		});
	}
	
	$('.navDesktop li').each(function()
	{
		var index = $('.navDesktop li').index(this);
		setColor($(this), index);
	});*/
});