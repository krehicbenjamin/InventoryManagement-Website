var myPet = {
  species: "Dog",
  name: "Bob",
  legs: 4,
  friends: ["Jimmy", "Bed"]
};
function myFunction(myObj) {
  return myObj;
}
console.log(myFunction(myPet));
module.exports = { myPet, myFunction };
