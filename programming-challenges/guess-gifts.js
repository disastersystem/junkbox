function guessGifts(wishlist, presents)
{
  hasSameFeatures = (wish, present) =>
      present.size == wish.size &&
      present.clatters == wish.clatters &&
      present.weight == wish.weight
    ? true : false

  return wishlist.filter(wish => {
    return presents.some(present => hasSameFeatures(wish, present))
  }).map(x => x.name)
}


var wishlist = [
  {"name":"card game","size":"small","clatters":"no","weight":"light"},
  {"name":"bobble hat","size":"small","clatters":"no","weight":"light"},
  {"name":"socks","size":"small","clatters":"no","weight":"light"}
]

var presents = [
  {"size":"small","clatters":"no","weight":"light"},
  {"size":"small","clatters":"no","weight":"light"}
]

console.log( guessGifts(wishlist, presents) )
