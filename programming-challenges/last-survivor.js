function lastSurvivor(letters, coords)
{
  const l = letters.split('')
  coords.forEach((c) => l.splice(c, 1))

  return l.join()
}

console.log(lastSurvivor('abc', [1, 1]))


function lastSurvivor(letters, coords)
{
  return coords.reduce((letArr, coord) => {
    letArr.splice(coord, 1)
    return letArr
  }, letters.split(''))[0]
}

console.log(lastSurvivor('abc', [1, 1]))
