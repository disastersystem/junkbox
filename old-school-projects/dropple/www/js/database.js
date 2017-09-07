/**
 * Simple database containing categories and
 * number of levels (by counting number of items in the category).
 * The strings in the level arrays correspond to the file name of the
 * images and audio files used.
 */
var allCatgories = {
    animals: {
        1: ['cat', 'cow', 'dog', 'pig'],
        2: ['crab', 'lion', 'rhino', 'snake'],
        3: ['chimpanzee']
    },
    colors: {
        1: ['black', 'blue', 'brown', 'green'],
        2: ['grey', 'orange', 'pink', 'indigo'],
        3: ['red', 'white', 'yellow', 'violet']
    },
    numbers: {
        1: ['zero', 'one', 'two', 'three'],
        2: ['four', 'five', 'six', 'seven'],
        3: ['eight', 'nine', 'ten', 'eleven'],
        4: ['twenty', 'thirty', 'forty', 'fifty']
    }
};

/**
 * Function to validate the existence of each key in the
 * object to get the number of valid keys. As you can't simply use .length
 * We use it to count the number of levels in each category.
 */
function numberOfLevels(the_object) {
    var object_size = 0;
    for (key in the_object) {
        if (the_object.hasOwnProperty(key)) {
            object_size++;
        }
    }
    return object_size;
}
