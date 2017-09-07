/* fine tune the game card layout */
function calcGameLayout() {

    var bodyHeight = $('#content').first().outerHeight();
    var bodyWidth = $('#content').first().outerWidth();
    var hud = $('#HUD').first().outerHeight();

    var space = ( (bodyHeight - hud) / 2);

    $('.cards').css({ 'height': space + 'px' });

    var cardsHeight = (space / 2) - 10;
    var cardsWidth = (bodyWidth / 2) - 14;

    $('.droppable-cards').css({
        'height': cardsHeight + 'px',
        'width': cardsWidth + 'px'
    });

    $('.draggable-cards').css({
        'height': cardsHeight + 'px',
        'width': cardsWidth + 'px'
    });

}
