
/**
 * Convert FEN string to position object
 * returns false if the FEN string is invalid
 * 
 * @param {string} fen
 * @return {object}
 */
function fenToObj(fen) {
    // if (validFen(fen) !== true) {
    //     return false
    // }

    var COLUMNS = 'abcdefgh'.split('')

    // cut off any move, castling, etc info from the end
    // we're only interested in position information
    fen = fen.replace(/ .+$/, '')

    var rows = fen.split('/')
    var position = {}

    var currentRow = 8
    for (var i = 0; i < 8; i++) {
        var row = rows[i].split('')
        var colIndex = 0

        // loop through each character in the FEN section
        for (var j = 0; j < row.length; j++) {
            // number / empty squares
            if (row[j].search(/[1-8]/) !== -1) {
                var emptySquares = parseInt(row[j], 10)
                colIndex += emptySquares
            }
            // piece
            else {
                var square = COLUMNS[colIndex] + currentRow
                position[square] = fenToPieceCode(row[j])
                colIndex++
            }
        }

        currentRow--
    }

    return position
}

/**
 * Convert FEN piece code to bP, wK, etc.
 *
 * @param {string} one letter representing the piece (Q = queen, p = pawn etc.)
 * @return {string}
 */
function fenToPieceCode(piece) {
    // black piece
    if (piece.toLowerCase() === piece) {
        return 'b' + piece.toUpperCase()
    }

    // white piece
    return 'w' + piece.toUpperCase()
}

/**
 * Check for conditions: checkmate, check, draw, stalemate, threefold repetition
 *
 * @return {integer} status code
 */
function gameStatus() {
    if (game.in_checkmate()) {
        return 1
    } else if (game.in_check()) {
        return 2
    } else if (game.in_draw()) { // draw by 50-move rule or insufficient material
        return 3
    } else if (game.in_stalemate()) {
        return 4
    } else if (game.in_threefold_repetition()) {
        return 5
    }
}

/**
 * Count how many times a value is present in an array.
 * 
 * @param {array} 
 * @return {object} one property for each unique value with number 
 * of occurences of that value
 */
function occurences(array) {
    let counts = {}

    array.forEach(function(item) {
        // only get the two last characters of the move string, this contains the square information
        item = item.slice(-2)
        counts[item] = (counts[item] || 0) + 1
    })

    return counts
}


/**
 * 
 * 
 * @param {string} 
 */
function setPosition(fen) {
    var pos = fenToObj(fen)

    for (var key in pos) {
        if (pos.hasOwnProperty(key)) { //make sure that the key you get is an actual property of an object, and doesn't come from the prototype.
            var p = SVG.get(key).bbox()
            var path = 'pieces/' + pos[key] + '.svg'

            var piece = board.image(path, 60, 60)
                .move(p.cx - 30, p.cy - 30)
                .attr({ id: pos[key], class: 'piece'})

            // draggable code here

            // pieces.push(piece)
        }
    }

    return pos
}

/**
 * Draws the svg squares on the chessboard.
 * 
 * @return void
 */
function drawBoard() {
    const chars = 'abcdefgh'.split('')
    const nums = [8, 7, 6, 5, 4, 3, 2, 1]

    for (let row = 0; row < 8; row++) {
        for (let column = 0; column < 8; column++) {
            
            /* draw a 70x70 square */
            var square = board.rect(70, 70).move(column * 70, row * 70).attr({
                fill: '#F0D9B5',
                stroke: '#000',
                'stroke-width': 0.2,
                'stroke-opacity': 1,
                id: chars[column] + nums[row]
            })

            squares.push(square)
        }
    }
}