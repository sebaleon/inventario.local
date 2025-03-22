//empretienda
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
