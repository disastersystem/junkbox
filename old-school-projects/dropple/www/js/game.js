/**
*	Main Game file
*
*	Description:
*	The file contains the Drag & Drop handler. Enabling the user to drag the
*   items into correct box placeholder.
*   ...
*
*/

var MAX_TIME = 60;							// Max time in seconds

var category = getUrlParameter("c");
var level = parseInt(getUrlParameter("l"));

var correctCards = 0;
var wrongCards = 0;
var correctCardsThreshold = parseInt(allCatgories[category][level].length);



var scoreCounterTimer = 0;

var counter = MAX_TIME; 					// The game loop time.
var globalTimer;							// The



var mainTheme = initMainTheme();
var clearLevel = initClearLevel();
var failLevel = initFailLevel();
var correctItem = initCorrectItem();


$(initGame); /* call the init() function once the DOM has loaded */

/**
*	The game has ended. Show game menu
*	If the level is 3 or higher the level will feature a scoreboard.
*	Parameter Victory (Boolean), whether the level was cleared or not.
*/
function endGame(victory)
{
	 $('#successMessage').show().addClass("animatedFast slideInLeft");


	if(level >= 3)
	{
		if(victory) 									// The level was cleared.
		{
			$('.endGameMsg').text('level cleared!');

			setTimeout(function()
			{
				clearLevel.play();						// Play clear level sound.
			},250);


			setScore();									// Display the score.
		}
		else 											// Failure.
		{
			$('.endGameMsg').text('level failed');
			setTimeout(function()
			{
				failLevel.play();						// Play fail level sound.
			},500);

			$('.timeRemain').css('display','none');
			$('.score').html('<span class = "scoreText" >score</span><br>0');
		}
	}
	else
	{
		$('.endGameMsg').text('level cleared!');

		setTimeout(function()
		{
			clearLevel.play();						// Play clear level sound.
		},250);
	}

}
/**
*	If level was cleared. Display the score for this level.
*/
function setScore()
{
	var score = scoreCounterTimer * 15; 				// Takes the remainder of the used time and multiply with 15.

	var countScore = 0; 								// Reset counter for score.
	var countRemainTimer = scoreCounterTimer;

	$('.timeRemain').show().text(countRemainTimer + ' x 15');
	$('.score').html('<span class = "scoreText" >score</span><br>0');

	setTimeout(function()
	{
		setInterval(function() 			// Display the score animated.
		{
			countScore += 15;
			countRemainTimer -= 1;

			if(countScore <= score)
				$('.score').html('<span class = "scoreText" >score</span><br>' + countScore);

			if(countRemainTimer >= 0)
				$('.timeRemain').text(countRemainTimer + ' x 15');

			if(countRemainTimer == 0)
			{
				$('.timeRemain').slideUp();
			}
		},40);
	},1000);

}

function pauseGame()
{
	clearInterval(globalTimer);
}

function resumeGame()
{
	globalTimer = setInterval(updateTimer, 1000);
}

function resetTimer()
{
	clearInterval(globalTimer);
	counter = MAX_TIME;
	$('#timer').text(MAX_TIME);
}

function updateTimer() {

    counter -= 1;

	// Times up!
	if(counter == 0)
	{
		resetTimer();
		endGame(false);
	}

	 $('#timer').text(counter);
}

function startGameTime() {

	$('#timer').text(MAX_TIME);
    globalTimer = setInterval(updateTimer, 1000);
}

/**
 * This is the main game function.
 *
 * Description:
 * This function is responsible for creating all the draggable and droppable cards.
 */
function initGame() {
    /* Hide the success message */
    $('#successMessage').hide();

	$('#levelNr').text('level ' + level);

	/* add a timer if the level is 3 */
    if (level >= 3)
    {
		$('#timer').css('display','block');
        startGameTime();

		$('.timeRemain').css('display','block');
		$('.score').css('display','block');
    }

    /* Reset the game */
    correctCards = 0;
    wrongCards = 0;
	correctCardsThreshold = allCatgories[category][level].length;
    $('#cardPile').html('');
    $('#cardSlots').html('');

    var items = allCatgories[category][level];

    /* randomize the items array */
    items.sort(function() { return Math.random() - .5 });

    /* create DRAGGABLE cards with images */
    for (var i = 0; i < items.length; i++) {
        $('<div class="draggable-cards"><img class="cardImage" src="images/' + category + '/level' + level + '/' + items[i] + '.png"></div>')
        .data('item', items[i])
        .attr('id', 'card')
        .appendTo('#cardPile')
        .draggable({
            containment: '#content', // constrain it to the #content div
            stack: '#cardPile div',
            cursor: 'move',
            /* This makes the card slide back to its initial position when dropped,
            so that the user can try again. We'll turn this option off when the
            user has dragged the card to the correct slot */
            revert: true
        })
        .addClass("animated bounceInDown");
    }

    /* randomize again */
    items.sort(function() { return Math.random() - .5 });


	/**
	 * display 1 droppable slot when the level is 1,
	 * display 2 when the level is 2,
	 * else display as many as the number of draggable cards
	 */
	if (level == 1) {
		correctCardsThreshold = correctCardsThreshold - 3;
		var numCards = correctCardsThreshold;
	}
	else
		{ var numCards = items.length; }


    /* create DROPPABLE cards */
    for (var i = 0; i < numCards; i++) {
        $('<div class="droppable-cards">' + items[i] + '<i class="fa fa-volume-up"></i></div>')
        .data('item', items[i])
        .appendTo('#cardSlots')
        .droppable({
            /* Ensure that the slot will only accept our item cards,
            and not any other draggable element */
            accept: '#cardPile div',
            hoverClass: 'hovered',
            drop: handleCardDrop
        })
        .addClass("animated bounceInUp");
    }

	/* calculate the layout when the generated cards has been places (see js/calcGameLayout.js)*/
    calcGameLayout();

}


function handleCardDrop(event, ui) {
    var slotValue = $(this).data('item');
    var cardValue = ui.draggable.data('item');

    /* If the card was dropped into the correct slot,
    change the card colour, position it directly
    on top of the slot, and prevent it being dragged
    again */
    if (slotValue == cardValue) {
        ui.draggable.addClass('correct animated tada');
        ui.draggable.draggable('disable');
        $(this).droppable('disable');
        ui.draggable.position({ of: $(this), my: 'left top', at: 'left top' });
        ui.draggable.draggable('option', 'revert', false);
        correctCards++;
		correctItem.play();
    } else {

        if (level >= 2) {
            ui.draggable.addClass('wrong animated flash');
            ui.draggable.draggable('disable');
            // $(this).droppable('disable');
            // ui.draggable.position({ of: $(this), my: 'left top', at: 'left top' });
            ui.draggable.draggable('option', 'revert', true);
            correctCards++;
            wrongCards++;
        }
    }

    /* If all the cards have been placed correctly then display a message
    and reset the cards for another go */
    if (correctCards == correctCardsThreshold) {


		if (level >= 3)
        {
			if (wrongCards > 0)
			{
				resetTimer();

				setTimeout(function()
				{
					endGame(false);
				}, 1300);
			}
			else
			{
				scoreCounterTimer = counter;
				resetTimer();

				setTimeout(function()
				{
					endGame(true);
				}, 1300);
			}
		}
		else
		{

			/* wait a little while before showing the success screen so the last
			put-into-the-right-slot-animation can finish */
			setTimeout(function()
			{
				endGame(true);
			}, 1300);

		}
	}

}


/* Go to next level by incrementing level GET variable by 1 */
function nextLevel() {
    if ( level == numberOfLevels(allCatgories[category]) ) {
        var h = 1;
        var link = "c=" + category + "&l=" + h;
        window.location.search = link;
    } else {
        var h = level + 1;
        var link = "c=" + category + "&l=" + h;
        window.location.search = link;
    }
}

/* Go to previous level by decrementing level GET variable by 1 */
function prevLevel() {
    if ( level == 1 ) {
        var h = numberOfLevels(allCatgories[category]);
        var link = "c=" + category + "&l=" + h;
        window.location.search = link;
    } else {
        var h = level - 1;
        var link = "c=" + category + "&l=" + h;
        window.location.search = link;
    }
}
