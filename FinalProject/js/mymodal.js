
//**********************************************
// FUNCTIONS FOR CANCEL ORDER MODALS
// /*gotcha2@yahoo.com*/
//**********************************************

// GET MODAL ELEMENT
var modal = document.getElementById('simpleModal');
// GET OPEN MODAL BUTTON
var modalBtn = document.getElementById('modalBtn');
// GET CLOSE MODAL BUTTON
var modalCloseBtn = document.getElementById('closeBtn');


// LISTEN FOR ACTION
modalBtn.addEventListener('click', openModal);
// LISTEN FOR ACTION
modalCloseBtn.addEventListener('click', closeModal);
// LISTEN FOR OUTSIDE CLICK
window.addEventListener('click', clickOutside);

//OPEN MODAL FUNCTION
function openModal(){
  modal.style.display = "block";
}
//CLOSE MODAL FUNCTION
function closeModal(){
  modal.style.display = 'none';
}
//CLOSE MODAL FUNCTION
function clickOutside(e){
  if (e.target == modal) {
    modal.style.display = "none";
  }
}

//**********************************************
// FUNCTIONS FOR PIZZA MODALS ON MENU-ITEMS.HTML
//**********************************************



// GET MODAL ELEMENT
var pizzaModal = document.getElementById('pizzaModal');

// GET OPEN MODAL BUTTONS
var cheesePizza = document.getElementById('cheesepzBTN');
var pepperoniPizza = document.getElementById('pepperonipzBTN');
var supremePizza = document.getElementById('supremepzBTN');
var buffaloPizza = document.getElementById('buffChicpzBTN');
var pacificoPizza = document.getElementById('pacificopzBTN');
var BuildYourOwn = document.getElementById('byoppzBTN');
// GET CLOSE MODAL BUTTON
var pizzaModalClose = document.getElementById('pizzaCloseBtn');

// GET CHEESE CHECKBOXES
var cheddar = document.getElementById('cheddar');
var asiago = document.getElementById('asiago');
var provolone = document.getElementById('provolone');
var feta = document.getElementById('feta');
var mozzerella = document.getElementById('mozzerella');
// GET MEAT CHECKBOXES
var ham = document.getElementById('ham');
var pepperoni = document.getElementById('pepperoni');
var sausage = document.getElementById('sausage');
var anchovies = document.getElementById('anchovies');
var chicken = document.getElementById('chicken');
// GET VEGGIES CHECKBOXES
var bananaPeps = document.getElementById('banana-peppers');
var pineapple = document.getElementById('Pineapple');
var olives = document.getElementById('olives');
var greenPeps = document.getElementById('green-peppers');
var spinach = document.getElementById('spinach');
var mushrooms = document.getElementById('mushrooms');
var redPeps = document.getElementById('redpeppers');
var buffaloSauce = document.getElementById('Buffalo_Sauce');
var jalepenos = document.getElementById('jalepenos');
var onions = document.getElementById('onions');
var addToCartBTN = document.getElementById('addToCart');


// LISTEN FOR ACTION
cheesePizza.addEventListener('click', openChzModal);
pepperoniPizza.addEventListener('click', openPepModal);
supremePizza.addEventListener('click', openSupModal);
buffaloPizza.addEventListener('click', openBufModal);
pacificoPizza.addEventListener('click', openPacModal);
BuildYourOwn.addEventListener('click', openBYOModal);

// LISTEN FOR ACTION

pizzaModalClose.addEventListener('click', closePizzaModal);
// LISTEN FOR OUTSIDE CLICK
window.addEventListener('click', clickOutside);



//OPEN MODAL FUNCTION
function openChzModal(){
 
  document.getElementById('PizzaType').value='Cheese';
  pizzaModal.style.display = "block";
  cheddar.checked=true;
  asiago.checked=false;
  provolone.checked=false;
  feta.checked=false;
  mozzerella.checked=true;

  ham.checked=false;
  pepperoni.checked=false;
  sausage.checked=false;
  anchovies.checked=false;
  chicken.chekced=false;

  bananaPeps.checked=false;
  pineapple.checked=false;
  olives.checked=false;
  greenPeps.checked=false;
  spinach.checked=false;
  mushrooms.checked=false;
  redPeps.checked=false;
  buffaloSauce.checked=false;
  jalepenos.checked=false;
  onions.checked=false;

}

function openPepModal(){
  
  document.getElementById('PizzaType').value='Pepperoni';
  pizzaModal.style.display = "block";
  cheddar.checked=true;
  asiago.checked=false;
  provolone.checked=false;
  feta.checked=false;
  mozzerella.checked=true;

  ham.checked=false;
  pepperoni.checked=true;
  sausage.checked=false;
  anchovies.checked=false;
  chicken.chekced=false;

  bananaPeps.checked=false;
  pineapple.checked=false;
  olives.checked=false;
  greenPeps.checked=false;
  spinach.checked=false;
  mushrooms.checked=false;
  redPeps.checked=false;
  buffaloSauce.checked=false;
  jalepenos.checked=false;
  onions.checked=false;
}

function openSupModal(){

 
  document.getElementById('PizzaType').value='Supreme';
  pizzaModal.style.display = "block";
  cheddar.checked=true;
  asiago.checked=false;
  provolone.checked=false;
  feta.checked=false;
  mozzerella.checked=true;

  ham.checked=false;
  pepperoni.checked=true;
  sausage.checked=false;
  anchovies.checked=false;
  chicken.chekced=false;

  bananaPeps.checked=true;
  pineapple.checked=false;
  olives.checked=true;
  greenPeps.checked=true;
  spinach.checked=false;
  mushrooms.checked=true;
  redPeps.checked=true;
  buffaloSauce.checked=false;
  jalepenos.checked=false;
  onions.checked=true;
}

function openBufModal(){

  
  document.getElementById('PizzaType').value='Buffalo-Chicken';
  pizzaModal.style.display = "block";
  cheddar.checked=true;
  asiago.checked=false;
  provolone.checked=true;
  feta.checked=false;
  mozzerella.checked=false;

  ham.checked=false;
  pepperoni.checked=false;
  sausage.checked=false;
  anchovies.checked=false;
  chicken.chekced=true;

  bananaPeps.checked=false;
  pineapple.checked=false;
  olives.checked=false;
  greenPeps.checked=true;
  spinach.checked=false;
  mushrooms.checked=false;
  redPeps.checked=false;
  buffaloSauce.checked=true;
  jalepenos.checked=false;
  onions.checked=true;
}

function openPacModal(){

  document.getElementById('PizzaType').value='Papis-Pacifica';
  pizzaModal.style.display = "block";
  cheddar.checked=true;
  asiago.checked=false;
  provolone.checked=true;
  feta.checked=false;
  mozzerella.checked=false;

  ham.checked=true;
  pepperoni.checked=false;
  sausage.checked=false;
  anchovies.checked=false;
  chicken.chekced=false;

  bananaPeps.checked=false;
  pineapple.checked=true;
  olives.checked=false;
  greenPeps.checked=true;
  spinach.checked=false;
  mushrooms.checked=false;
  redPeps.checked=true;
  buffaloSauce.checked=false;
  jalepenos.checked=false;
  onions.checked=false;
}

function openBYOModal(){

  document.getElementById('PizzaType').value='Build-Your-Own';
  pizzaModal.style.display = "block";
  cheddar.checked=false;
  asiago.checked=false;
  provolone.checked=false;
  feta.checked=false;
  mozzerella.checked=true;

  ham.checked=false;
  pepperoni.checked=false;
  sausage.checked=false;
  anchovies.checked=false;
  chicken.chekced=false;

  bananaPeps.checked=false;
  pineapple.checked=false;
  olives.checked=false;
  greenPeps.checked=false;
  spinach.checked=false;
  mushrooms.checked=false;
  redPeps.checked=false;
  buffaloSauce.checked=false;
  jalepenos.checked=false;
  onions.checked=false;
}


//CLOSE MODAL FUNCTION
function closePizzaModal(){
  pizzaModal.style.display = 'none';
}


var cheeselimit = 2;
$('input.cheeseCheckbox').on('change', function(evt) {
   if($(this).siblings(':checked').length >= cheeselimit) {
       this.checked = false;
   }
});
