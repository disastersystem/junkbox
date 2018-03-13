
/**
 * convert FEN string to position object
 * returns false if the FEN string is invalid
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
 * convert FEN piece code to bP, wK, etc.
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
 * 
 */
function gameStatus() {
    if (game.in_checkmate()) {
        console.log('checkmate')
    }

    if (game.in_check()) {
        console.log('check')
    }

    if (game.in_draw()) {
        console.log('draw (50-move rule or insufficient material)')
    }

    if (game.in_stalemate()) {
        console.log('stalemated')
    }

    if (game.in_threefold_repetition()) {
        console.log('threefold repetition')
    }
}

function occurences(array) {
    let counts = {}

    array.forEach(function(item) {
        item = item.slice(-2)
        
        counts[item] = (counts[item] || 0) + 1
    })

    return counts
}