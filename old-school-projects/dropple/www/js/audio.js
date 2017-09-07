/**
*	Audio files
*	Each function creates a new Audio object.
*	The object is assigned with properties based on the usage. 
*	Returns sound object.
*/

// The main soundtrack, played at the front page:
function initMainTheme()
{	
	var mainTheme = new Audio('audio/mainTheme.mp3'); 
	mainTheme.loop = true;
	mainTheme.volume = 0.5;
	return mainTheme;
}

// In Game mode: If the level is cleared successfully. 
function initClearLevel()
{
	var levelClear = new Audio('audio/levelClear.wav'); 
	levelClear.volume = 0.5;
	return levelClear;
}

// In Game mode: If the level is failure. 
function initFailLevel()
{
	var levelFail = new Audio('audio/levelFail.wav'); 
	levelFail.volume = 0.5;
	return levelFail;
}

// In Game mode: If the item is placed in correct placeholder.
function initCorrectItem()
{
	var correctItem = new Audio('audio/correct.wav'); 
	correctItem.volume = 1;
	return correctItem;
}