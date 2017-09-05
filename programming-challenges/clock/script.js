/**
	## Description ##
	No more hiding from your alarm clock! You've decided you want your computer 
	to keep you updated on the time so you're never late again. A talking clock 
	takes a 24-hour time and translates it into words.

	## Input Description ##
	An hour (0-23) followed by a colon followed by the minute (0-59).

	## Output Description ##
	The time in words, using 12-hour format followed by am or pm.

	## Sample Input data ##
	00:00
	01:30
	12:05
	14:01
	20:29
	21:00

	## Sample Output data ##
	It's twelve am
	It's one thirty am
	It's twelve oh five pm
	It's two oh one pm
	It's eight twenty nine pm
	It's nine pm

	## Extension challenges (optional) ##
	Use the audio clips found here to give your clock a voice.
*/

const numbers = {
    0: "twelve",
    1: "one",
    2: "two",
    3: "three",
    4: "four",
    5: "five",
    6: "six",
    7: "seven",
    8: "eight",
    9: "nine",
    10: "ten",
    11: "eleven",
    12: "twelve",
    13: "thirteen",
    14: "fourteen",
    15: "fifteen",
    16: "sixteen",
    17: "seventeen",
    18: "eighteen",
    19: "nineteen",
    20: "twenty",
    30: "thirty",
    40: "fourty",
    50: "fifty"
}

function timeToSpeech(time) {
	// split the time provided by the user into hours and minutes while converting the values to integers
	// (this removes any leading zeros as well)
	let [hour, minutes] = time.split(':').map(str => parseInt(str))

	let meridiem = (hour < 12) ? 'am' : 'pm'
	// divide the hour by 12: 13 becomes 1, 14 becomes 2 etc.
	hour = numbers[hour % 12]

	if (minutes == 0) {
		return `It's ${hour} o'clock ${meridiem}`
	}

	if (minutes < 10) {
		return `It's ${hour} oh ${numbers[minutes]} ${meridiem}`
	}

	if (minutes < 20) {
		return `It's ${hour} ${numbers[minutes]} ${meridiem}`
	}

	if (minutes > 20) {
		/* floor the number to the tenth, e.g. 59 to 50, and return it as a word, e.g. fifty */
		let ten = numbers[Math.floor(minutes / 10) * 10]
		/* if the number is already floored, like 50,  simply return an empty string, else */
		/* return the minutes as a word with a hyphen prepended, e.g. -nine */
		let one = (minutes % 10 != 0 ? `-${numbers[minutes % 10]}` : '')
		
		/* e.g. It's eleven fifty-nine am */
		return `It's ${hour} ${ten}${one} ${meridiem}`
	}
    
}

console.log( timeToSpeech("00:15") ) // -> It's twelve fifteen am
console.log( timeToSpeech("01:00") ) // -> It's one o'clock am
console.log( timeToSpeech("01:17") ) // -> It's one seventeen am
console.log( timeToSpeech("13:25") ) // -> It's one twenty-five pm
console.log( timeToSpeech("20:44") ) // -> It's eight fourty-four pm
console.log( timeToSpeech("23:01") ) // -> It's eleven oh one pm
console.log( timeToSpeech("11:59") ) // -> It's eleven fifty-nine am
console.log( timeToSpeech("13:50") ) // -> It's one fifty pm