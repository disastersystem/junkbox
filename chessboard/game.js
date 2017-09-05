// var board;
// var game = new Chess();
// var totalMoves = 0;

// // do not pick up pieces if the game is over
// // only pick up pieces for White
// var onDragStart = function(source, piece, position, orientation) {
    
// };

// var makeRandomMove = function() {
//     var possibleMoves = game.moves();

//     // game over
//     if (possibleMoves.length === 0) {
//         return;
//     }

//     var randomIndex = Math.floor(Math.random() * possibleMoves.length);
//     game.move(possibleMoves[randomIndex]);
//     board.position(game.fen());
// };

// var onDrop = function(source, target) {
//     // see if the move is legal
//     var move = game.move({
//         from: source,
//         to: target,
//         promotion: 'q' // NOTE: always promote to a queen for example simplicity
//     });

//     // illegal move
//     if (move === null) {
//         return 'snapback';
//     }

//     // make random legal move for black
//     window.setTimeout(makeRandomMove, 250);
//     console.log(game.moves());
    
// };

// /* update the board position after the piece snap
//    for castling, en passant, pawn promotion */
// var onSnapEnd = function(source, piece, position, orientation) {
//     board.position(game.fen());

//     // console.log(game.ascii());
//     // console.log(game.board());

//     // if (game.in_checkmate() === true || game.in_draw() === true || piece.search(/^b/) !== -1) {
//     if (game.game_over()) {
//         $('.message').append('<p>checkmate atheist</p>');
//         return false;
//     }
//     // }
// };


// board = ChessBoard('board', {
//     draggable: true,
//     position: 'start',
//     onDragStart: onDragStart,
//     onDrop: onDrop,
//     onSnapEnd: onSnapEnd
// });

// /* reset the visual board and game array */
// $('#btn-start').on('click', function() {
//     game.reset();
//     board.start();
// });



// game.move('d4');
            // game.move('a6');
            // game.move('Nf3');
            // game.move('Nh6');
            // console.log(game.board());

            // var position = [
            //     /* pawns */   ['a2', 'pw'], ['b2', 'pw'], ['c2', 'pw'], ['d2', 'pw'], ['e2', 'pw'], ['f2', 'pw'], ['g2', 'pw'], ['h2', 'pw'],
            //     /* rooks */   ['a1', 'rw'], ['h1', 'rw'],
            //     /* knights */ ['b1', 'nw'], ['g1', 'nw'],
            //     /* bishops */ ['c1', 'bw'], ['f1', 'bw'],
            //     /* queen */   ['d1', 'qw'],
            //     /* king */    ['e1', 'kw'],

            //     // p3

            //     /* pawns */   ['a7', 'pb'], ['b7', 'pb'], ['c7', 'pb'], ['d7', 'pb'], ['e7', 'pb'], ['f7', 'pb'], ['g7', 'pb'], ['h7', 'pb'],
            //     /* rooks */   ['a8', 'rb'], ['h8', 'rb'],
            //     /* knights */ ['b8', 'nb'], ['g8', 'nb'],
            //     /* bishops */ ['c8', 'bb'], ['f8', 'bb'],
            //     /* queen */   ['d8', 'qb'],
            //     /* king */    ['e8', 'kb']
            // ];
            // console.log(game.fen());

            

            // var piece = move.charAt(0);
            //  if (piece == 'x' || move.charAt(0) == 'x') {
            //      piece.replace('x', '');
            //      console.log(piece);
            //  }
                
            //  if (piece == 'K') {
            //      SVG.get(move.substring(1)).fill('rgba(93, 34, 53, 0.5)');
            //  } else if (piece == 'Q') {
            //      SVG.get(move.substring(1)).fill('red');
            //  } else if (piece == 'R') {
            //      SVG.get(move.substring(1)).fill('blue');
            //  } else if (piece == 'B') {
            //      SVG.get(move.substring(1)).fill('green');
            //  } else if (piece == 'N') {
            //      SVG.get(move.substring(1)).fill('brown');
            //  } else if (piece == 'P') {
            //      SVG.get(move.substring(1)).fill('#478');
            //  } else { // the pawn has no abbreviation
            //      SVG.get(move).fill('#478');
            //  }
            //  // console.log(move);
            // });



var COLUMNS = 'abcdefgh'.split('');

// convert FEN string to position object
// returns false if the FEN string is invalid
function fenToObj(fen) {
    // if (validFen(fen) !== true) {
    //  return false;
    // }

    // cut off any move, castling, etc info from the end
    // we're only interested in position information
    fen = fen.replace(/ .+$/, '');

    var rows = fen.split('/');
    var position = {};

    var currentRow = 8;
    for (var i = 0; i < 8; i++) {
        var row = rows[i].split('');
        var colIndex = 0;

        // loop through each character in the FEN section
        for (var j = 0; j < row.length; j++) {
            // number / empty squares
            if (row[j].search(/[1-8]/) !== -1) {
                var emptySquares = parseInt(row[j], 10);
                colIndex += emptySquares;
            }
            // piece
            else {
                var square = COLUMNS[colIndex] + currentRow;
                position[square] = fenToPieceCode(row[j]);
                colIndex++;
            }
        }

        currentRow--;
    }

    return position;
}

// convert FEN piece code to bP, wK, etc
function fenToPieceCode(piece) {
    // black piece
    if (piece.toLowerCase() === piece) {
        return 'b' + piece.toUpperCase();
    }

    // white piece
    return 'w' + piece.toUpperCase();
}

var pieces = [];
function startPosition(pos) {
    for (var key in pos) {
        if (pos.hasOwnProperty(key)) {
            var p = SVG.get(key).bbox();

            var piece = draw.image('pieces/' + pos[key] + '.svg', 60, 60)
                .move(p.cx - 30, p.cy - 30)
                .attr({ id: pos[key] })
        }
    }
}