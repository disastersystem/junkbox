function toggleComment(check)
{
	var elem = $('.modal-footer');
	
	if(!check)
	{
		
		elem.find('.commentStatic').css('-webkit-animation','commentShow .6s');
		elem.find('.commentStatic').html('<i class="fa fa-comment"></i>');
		elem.find('.commentStatic').css({'width':'10%', 'left':'90%'});
		
		elem.find('textarea').css({'-webkit-animation':'left .6s', 'display':'inline'});
		elem.find('textarea').focus();
		
		check = true;
	}
	else
	{
		elem.find('.commentStatic').css('-webkit-animation','commentHide .6s');
		elem.find('.commentStatic').html('Comment <i class="fa fa-comment"></i>');
		elem.find('.commentStatic').css({'width':'100%', 'left':'0'});
		
		elem.find('textarea').css( 'display', 'none');
		
		check = false;
	}
	
	return check;
}