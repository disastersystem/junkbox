	
function openUserSettingsModal()
{	
	// Show modal:
	$('.modalEditUser').modal('show');
	
	 // Add animation to modal-dialog:
	$('.modal-dialog').css('-webkit-animation','scale .4s');
}

function setInputStatus(inputElem, status)
{
	if(status)
		inputElem.addClass('correctPwd');
	else
		inputElem.addClass('badPwd');
}

function validatePassword(inputElem)
{
	var role = inputElem.attr('role');
	
	switch(role)
	{
		case 'curPwd': 
		
			
			console.log('check with php'); 
			return true; 
			break;
			
		case 'newPwd': 
			
		
			if(inputElem.val() != "")
			{
				if(inputElem.val().length >= MIN_PWD_LENGTH)
				{
					console.log('new password: ok');
					$('.passwordContainer input[role=conPwd]')
					.css('opacity','1').prop('disabled', false);
					
					return true;
				}
				else
				{	
					console.log('new password: needs atleast '+MIN_PWD_LENGTH+' chars');
					inputElem.val("");
					return false;
				}
			}
			else
			{
				console.log('new password: cannot have 0 chars');
				return false;
			}
			
			break;
			
		case 'conPwd': 
		
			
			
			if(inputElem.val() == $('.passwordContainer input[role=newPwd]').val() )
			{
				
				return true;
			}
			else
			{
				return false
			}
			
			break;
	}
	
	
}