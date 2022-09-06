const inventory = [
  ["mandolin", 225, 460],
  ["classical guitar", 568, 1200],
  ["acoustic guitar", 365, 750],
  ["kazoo", 3.25, 6.8],
  ["djembe", 123, 250],
  ["sitar", 378, 810],
  ["bamboo flute", 15, 48]
];

function getOption(selectObject){
  //set the value of item
  var value = selectObject.value;
  const item = document.getElementById("item");
  item.disabled = false;
  item.value = value;
  item.disabled = true;

// set the value of the price and total
for (let i=0; i < inventory.length; i++) {
  if (value  == inventory[i][0]){
    const price = document.getElementById("retail");
    price.disabled = false;
    price.value = inventory[i][2];
    price.disabled = true;
    const total = document.getElementById("total");
    total.disabled = false;
    total.value = inventory[i][2];
    total.disabled = true;
  }
}
}
// add the % to the input discount value
document.getElementById('discount').onblur = function(){blurfunction()};
document.getElementById('discount').onfocus = function(){focusfunction()};
//add blur function
function blurfunction(){
  if(document.getElementById('discount').value !='') {
    var discountvalue = document.getElementById('discount').value;
    document.getElementById('discount').value = discountvalue + "%";
    var retailPrice = document.getElementById('retail').value;
    document.getElementById('total').value = retailPrice * ( discountvalue * 0.01 );
  }
}
// add focus function
function focusfunction() {
  document.getElementById('discount').value = '';
}

// form validation
function validateForm() {
  var item = document.getElementById('item');
  item.disabled = false;
  var retail = document.getElementById('retail');
  retail.disabled = false;
  var total = document.getElementById('total');
  total.disabled = false;
  var disc = document.getElementById("discount").value;
  if (disc=="") {
    document.getElementById("discount").value = 0;
    return true;
  }
}


