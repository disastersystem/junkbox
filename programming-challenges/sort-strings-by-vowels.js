function isVowel (c) {
    return Array.from('aeiouAEIOU').includes(c)
}

function sortStringsByVowels (strings)
{
    var forEach = Array.prototype.forEach
    // String.prototype.forEach = Array.prototype.forEach
    const counts = []

    strings.forEach(string => {
        let largestStreak = 0
        let currentStreak = 0

        forEach.call(string, letter => {
            if (isVowel(letter)) {
                currentStreak += 1
            } else {
                if (currentStreak > largestStreak) largestStreak = currentStreak
                currentStreak = 0
            }
        })

        if (currentStreak > largestStreak) largestStreak = currentStreak

        counts.push({
            amount: largestStreak,
            string: string
        })
    })

    counts.sort((a, b) => (b.amount - a.amount))

    return counts.map(c => c.string)
}

console.log(sortStringsByVowels( ["iiii","eee","aa","oo"] ))
console.log(sortStringsByVowels( ["AIBRH","","YOUNG","GREEEN"] ))
console.log(sortStringsByVowels( ["how about now","a beautiful trio of"] ))
console.log(sortStringsByVowels( ["every","bataux","is","waaaay","loose"] ))
