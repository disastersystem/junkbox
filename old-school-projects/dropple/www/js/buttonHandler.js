/**
*	Add event handlers to buttons for game.html
*
*/

$(document).ready(function()
{
/**
*	Item Sound:
*	This is a demonstration for spelling the name of the animal.
*	Works for level 3 of category animal
*	When the user clicks the placeholder box for e.g. "Lion",
*	the game will spell "Lion".
*/

$('body').delegate('.droppable-cards','click',function()
{
	if(level >= 2 && category == "animals")
	{
		var animalName = $(this).text();		// Get the name of the animal.

		var sound = new Audio('audio/'+animalName+'.mp3');
		sound.play();
	}
});



/**
*	Dialog buttons.
*	The dialog is being used as a pause menu in the game.
*	The intention was to reuse this dialog for other potentially purposes.
*	The following buttons are the presented in the pause menu.
*/
	// Open dialog:
	$('#pause').on('click',function()
	{
		pauseGame();
		initDialog();
	});

	// Exit Dialog by clicking resume:
	$('.dialog-btn[role=resume]').on('click',function()
	{
		exitDialog();
		resumeGame();
	});

	// Exit Dialog by restarting the game:
	$('.dialog-btn[role=retry]').on('click',function()
	{
		exitDialog();
		resetTimer();
		resumeGame();
	});



});
