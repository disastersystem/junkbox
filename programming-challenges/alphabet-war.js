function alphabetWar(reinforces, airstrikes)
{
  if (!airstrikes.length) return reinforces[0]

  // this array has the length of a reinforces string (every string will be of the same length)
  // it keeps track of which reinforce string and index that has the char we need the last string
  var counts = new Array(reinforces[0].length).fill(0)

  // convert all the reinforces and airstrikes strings into arrays
  var support = reinforces.map(r => r ? [...r] : [])
  var strikes = airstrikes.map(a => a ? [...a] : [])

  strikes.forEach((strike, i) => {
    strike.forEach((s, j) => {
      if (s == "*") {
        counts[j+1]++

        if (strikes[i][j-2] != "*" && strikes[i][j-1] != "*") {
          counts[j-1]++
        }
        if (strikes[i][j-1] != "*") {
          counts[j]++
        }
      }
    })
  })

  var i = 0, ans = []
  while (i < support[0].length) {
    ans.push( counts[i] >= support.length ? "_" : support[counts[i]][i] )
    ++i
  }

  return ans.join('')
}


console.log(alphabetWar(
    ["g964xxxxxxxx","myjinxin2015","steffenvogel","smile67xxxxx","giacomosorbi","freywarxxxxx","bkaesxxxxxxx","vadimbxxxxxx","zozofouchtra","colbydauphxx"],
    ["* *** ** ***", " ** * * * **", " * *** * ***", " **  * * ** ", "* ** *   ***", "***   ", "**", "*", "*"]
  )
)
console.log(alphabetWar(["abcdefg","hijklmn"], ["*  *   ", "   *   "]))
console.log(alphabetWar(["aaaaa","bbbbb", "ccccc", "ddddd"],  ["*", " *", "   "]))
