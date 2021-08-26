// return n.toLocaleString()
function groupByCommas(n) {
  [...arr] = n.toString()

  return arr
    .reverse()
    // add comma if the index is divisible by 3 
    .map((x, i) => {
    return (i != 0 && i % 3 == 0) ? x + ',' : x
    })
    .reverse()
    .join('')
}

console.log( groupByCommas(1000) )
console.log( groupByCommas(56464677868) )
console.log( groupByCommas(34445566) )
