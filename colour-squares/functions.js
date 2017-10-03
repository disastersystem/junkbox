var COLUMNS = 'abcdefgh'.split('')

// convert FEN string to position object
// returns false if the FEN string is invalid
function fenToObj(fen) {
    // if (validFen(fen) !== true) {
    //  return false;
    // }

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

// convert FEN piece code to bP, wK, etc
function fenToPieceCode(piece) {
    // black piece
    if (piece.toLowerCase() === piece) {
        return 'b' + piece.toUpperCase()
    }

    // white piece
    return 'w' + piece.toUpperCase()
}