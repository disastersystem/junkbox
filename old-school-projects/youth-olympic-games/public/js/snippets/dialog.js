function dialog(title, confirm, cancel)
{
	$('.customDialog').css({'display':'block', '-webkitAnimation':' top .4s'});
	
	$('.customDialog .dialogTitle').text(title);
	$('.customDialog input[role=confirm]').val(confirm);
	$('.customDialog input[role=cancel]').val(cancel);

}