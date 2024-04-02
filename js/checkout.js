// alert(user_id)
// Retrieve cart items from LocalStorage or initialize an empty array
// let cart = JSON.parse(localStorage.getItem('cart')) || [];
// let products = [];

document.addEventListener("DOMContentLoaded", function () {
    displayCheckoutMiniCart();

});


// Function to generate product cards



// Function to update the cart in the UI
function displayCheckoutMiniCart() {
 
    // const totalPriceElement = document.getElementById('totalPrice');
    let totalItemCountMiniElement = document.getElementById('totalItemCountMini');
    let totalPrice = 0;
    let totalItemCount = 0;
    let subTotal = 0;

    if(document.getElementById("checkoutMiniCartList")){
        document.getElementById("checkoutMiniCartList").innerHTML =""
        cart.forEach(item => {
        subTotal = (parseInt(item.product_price) * parseInt(item.quantity));

        document.getElementById("checkoutMiniCartList").innerHTML += `
        <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
                <h6 class="my-0">${item.product_name}</h6>
                <small class="text-muted"><p>${item.product_name} - £${item.product_price} x ${item.quantity}</p></small>
            </div>
            <span class="text-muted">£${subTotal}</span>
        </li>

        `;
        totalItemCount += parseInt(item.quantity)
        totalPrice += item.product_price * item.quantity;
        });

        // totalPriceElement.textContent = totalPrice.toFixed(2);
        totalItemCountMiniElement.textContent = totalItemCount;

        document.getElementById("checkoutMiniCartList").innerHTML +=
        ` 

        <li class="list-group-item d-flex justify-content-between bg-light">
        <div class="text-success">
        <h6 class="my-0">Promo code</h6>
        <small>EXAMPLECODE</small>
        </div>
        <span class="text-success">−£0</span>
        </li>
        <li class="list-group-item d-flex justify-content-between">
        <span>Total</span>
        <strong>${totalPrice.toFixed(2)}</strong>
        </li>
        `
    }
}





