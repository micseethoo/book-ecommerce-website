let ifzero = document.querySelector('#cart_price_total').value;

if (ifzero == 0.00) {
    document.querySelector('#checkout_button').style.display = "none";
}