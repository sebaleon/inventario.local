document.addEventListener("DOMContentLoaded", function(event) {
var price = document.getElementsByClassName("product-vip__price-value");
var p = price[0].innerText;
var splitPrice = p.split('$');
const numberp = parseInt(splitPrice[1].replace(/\./g, '').replace(',', '.'), 10);
priceMostrar = "$" + new Intl.NumberFormat("de-DE").format(numberp * 1.3, 2);
const node = document.createElement("del");
const textnode = document.createTextNode(priceMostrar);
node.appendChild(textnode);
[...price].forEach(cont => {
cont.appendChild(node);
});

var off = document.getElementsByClassName("product-vip__price");
const spa= document.createElement("span");
spa.classList.add('product-vip__off');
const textspa = document.createTextNode("30% OFF");
spa.appendChild(textspa);
[...off].forEach(cont => {
cont.appendChild(spa);
});

//
const fpago= document.querySelector(".product-vip__show-payment-offers-link");
fpago.classList.remove("text--primary");
fpago.className += " button uk-button-danger border-radius uk-button-small";
///// slider ramdom
var ulList = document.getElementsByClassName("uk-slider-items");
for (let j = 0; j < ulList.length; j++) {
  var thisUL = ulList[j];
  for (let i = thisUL.children.length; i >= 0; i--) {
    thisUL.appendChild(thisUL.children[Math.random() * i | 0]);
  }}
////
function getRandomImage(arr) {
  const length = arr.length;
  const randomIndex = Math.floor(length * Math.random())
  return arr[randomIndex]
}
let img=[    {src:'https://d22fxaf9t8d39k.cloudfront.net/ac434dae6d18533b754811ffed245ff8e63bb4cf1c8a1c3961081aea4f53c68031350.jpg',},{src:'https://i.imgur.com/r6GlbT9.jpg',},{src:'https://i.imgur.com/pV3Rct8.jpg',},{src:'https://i.imgur.com/oRutIOk.png',},{src:'https://i.imgur.com/bf1KAWz.jpeg',},{src:'https://i.imgur.com/22wjQDw.jpg',},{src:'https://i.imgur.com/QftH2KH.jpeg',},];
let lis = document.querySelector('.block-grill-images__grid-item--full').getElementsByTagName('img');
[].forEach.call(lis, (element, index) => {
  if (element.className == 'block-grill-images__image') {  
      //ramdom      
      document.querySelector('.block-grill-images__image').src = 
      getRandomImage(img)['src'];}});});


window.addEventListener("load", (event) => {
const button = document.querySelector(".product-vip__show-payment-offers-link");
button.addEventListener("click", (event) => {
//
const items = document.querySelectorAll('.promotions__method-wrapper .promotions__subtitle');
[...items].forEach(item => {
//console.log(item.innerText);
   if (item.innerText == 'Acordamos el medio de pago al finalizar la compra') {
         item.innerText = '- Finalice su compra y póngase en contacto por WhatsApp para enviarle el link de pago de MERCADOPAGO. \n\n ACLARACIÓN \n- Las compras con tarjeta de crédito se realizan a través de MERCADOPAGO.\n - Las promociones en cuotas las estipula MERCADOPAGO y es ajeno a PURCUÁ.\n - Por favor, antes de realizar la compra chequee el límite de su tarjeta y lea las condiciones de MERCADOPAGO.';
   }});
//
const formasPago = document.querySelectorAll('li .border-radius');
[...formasPago].forEach(pago => {
//console.log(pago.innerText);
   if (pago.innerText == 'ACORDAR') {pago.innerText = 'Mercadopago';}
   if (pago.innerText == 'TRANSFERENCIA BANCARIA') {pago.innerText = 'TRANSFERENCIA';}
});
//
const titles = document.querySelectorAll('.promotions__method-wrapper .promotions__title');
[...titles].forEach(title => {
//console.log(title.innerText);
   if (title.innerText == 'Acordar') {
         title.innerText = '';
   }
});
//
const prices = document.querySelectorAll('.promotions__promotion-head .promotions__detail strong');
for (const [key, value] of Object.entries(prices)) {
if(key == 1){
var precio = prices[key].innerText;
var splitPrice = precio.split('$');
var precioNumero = Number(splitPrice[1]);
const number = parseInt(splitPrice[1].replace(/\./g, '').replace(',', '.'), 10);
prices[key].innerText = "$" + new Intl.NumberFormat("de-DE").format(number * 1.3, 2);
} }});});
