
const sortVowels = s => {
  if (s === undefined || s === null || s === Number(s)) return ''

  const vowels = 'AEIOUaeiou'.split('')

  return [...s].map(letter =>
    vowels.includes(letter) ? `|${letter}` : `${letter}|`
  ).join('\n')
}

console.log(sortVowels('adjlkjDDF'))
