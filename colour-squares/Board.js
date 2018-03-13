'use strict'

export default class Board {
	constructor(svgElem) {
		this.svg = svgElem
	}

	drawBoard() {
    	const chars = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h']
		const nums = [8, 7, 6, 5, 4, 3, 2, 1]
		var squares = []

    	for (var row = 0; row < 8; row++) {
	        for (var column = 0; column < 8; column++) {
	            /* odd square gets a light colour, even gets dark */
	            if (row % 2 == 0)
	                var colour = (column % 2 == 0) ?  '#F0D9B5' : '#B58863'
	            else
	                var colour = (column % 2 == 0) ? '#B58863' : '#F0D9B5'
	            
	            /* draw the square */
	            var square = board.rect(70, 70).move(column * 70, row * 70).attr({
	                fill: colour,
	                id: chars[column] + nums[row]
	            })

	            squares.push(square)
	        }
	    }

	    return squares
    }




}