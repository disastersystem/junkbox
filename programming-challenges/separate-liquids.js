const chunk = (array, size) => {
  const chunked = []
  for (let i = 0; i < array.length; i += size) {
    chunked.push( array.slice(i, i + size) )
  }
  return chunked
}

function separateLiquids(glass)
{
  if (!glass.length) return []

  const densityOrder = ['O', 'A', 'W', 'H']

  // flatten glass
  const flattened = [].concat(...glass)
    // sort by same letter, using the densityOrder array as a custom order
    .sort(
      (a, b) =>
        (densityOrder.indexOf(a) > densityOrder.indexOf(b)) - 
        (densityOrder.indexOf(a) < densityOrder.indexOf(b))
    )

  // split in chunks by the size of glass[0].length
  return chunk(flattened, glass[0].length)
}

console.log(separateLiquids([['H', 'H', 'W', 'O'],['W','W','O','W'],['H','H','O','O']]))
console.log(separateLiquids([]))
console.log(separateLiquids([['A','A','O','H'],['A', 'H', 'W', 'O'],['W','W','A','W'],['H','H','O','O']]))
