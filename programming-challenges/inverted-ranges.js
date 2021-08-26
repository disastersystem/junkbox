function invertedRanges(ranges)
{
  // this assumes that your intervals are sorted

  // initialized with an accumulator that contains the entire region and then
  // split that last region as you encounter new ranges
  return ranges.reduce((acc, curr) => {
    const prev = acc.pop()

    const [currStart, currEnd] = curr
    const [prevStart, prevEnd] = prev

    if (currStart > prevStart)
      acc.push([prevStart, currStart - 1])

    if (prevEnd > currEnd)
      acc.push([currEnd + 1, prevEnd])

    return acc
  }, [[0, 100]])
}

function invertedRanges(ranges)
{
  let pos = 0, res = []

  for (let [a, b] of ranges) {
    if (pos < a)
      res.push([pos, a - 1])

    pos = b + 1
  }

  if (pos <= 100)
    res.push([pos, 100])

  return res
}

console.log(invertedRanges([[0, 50], [51, 100]]))
console.log(invertedRanges([[25, 50]]))
console.log(invertedRanges([[0, 25], [51, 75]]))
console.log(invertedRanges([]))
