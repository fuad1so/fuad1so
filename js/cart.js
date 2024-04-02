// alert(user_id!="")

// Retrieve cart items from LocalStorage or initialize an empty array
let cart = JSON.parse(localStorage.getItem('cart')) || [];
let products = [];

document.addEventListener("DOMContentLoaded", function () {
    // Step 1: Fetch products from the server
    if (document.getElementById('products')) {
        fetch("api.php?action=get_products")
            .then((response) => response.json())
            .then((db_products) => {
                // console.log(products)     
                products = db_products;
                generateProductCards();

            })
            .catch((error) => {
                console.error("Error fetching products:", error);
                console.log("Error");
            });
    }

    // user_id!="" is variable created on footer.php
    if (user_id != "") {
        // check previous cart data in the database. 
        // fetch from db
        fetch("api.php?action=get_previous_cart")
            .then((response) => response.json())
            .then((prev_products) => {
                // console.log(prev_products)
                if (prev_products == "no_cart_in_db") {
                    console.log("No cart data in the db for the current user");
                    //alert("No cart data in the db for the current user");
                } else if (prev_products.length > 0) {
                    cart = JSON.parse(localStorage.getItem('cart'))
                    // console.log("cart from local")
                    // console.log(prev_products)


                    for (let dbItem of prev_products) {
                        // Check if the product is already in cart_array
                        let cartItem = cart.find(item => item.product_id === dbItem.product_id);

                        if (cartItem) {
                            // If product is already in cart_array, increase quantity by 1
                            dbItem.quantity += 1;
                        } else {
                            // If product is not in cart_array, push it as a new item
                            cart.push({
                                product_id: dbItem.product_id,
                                product_image: dbItem.product_image,
                                product_name: dbItem.product_name,
                                product_price: dbItem.product_price,
                                quantity: dbItem.quantity
                            });
                        }
                    }

                    // console.log("cart after push")
                    // console.log(cart)
                    localStorage.setItem("cart", JSON.stringify(cart));
                    cart = JSON.parse(localStorage.getItem('cart'))
                    updateCartInDatabase(cart);
                    // displayCheckoutMiniCart(); // update display on checkout JS
                    updateCart();
                }
                if (cart.length > 0) {
                    updateCartInDatabase(cart);
                }


            })
            .catch((error) => {
                console.error("Error fetching previous products:", error);
                console.log("Error");
            });
        // updateCartInDatabase(cart) ; 
        // displayCheckoutMiniCart(); // update display on checkout JS
        // end fetch

    }

    updateCart();

});

// https://picsum.photos/200/200
// Function to generate product cards
function generateProductCards() {
    const productsElement = document.getElementById('products');

    products.forEach(product => {
        let saleBadge = (product.product_status == "Sale Item"  || product.product_status == "Popular Item"  )? 
        `<div class="badge bg-success position-absolute m-2 end-0">Sale</div>`: ``;

        let starReview = (product.product_status == "Kristin Hannah" )?`
        <div class="d-flex justify-content-center small text-warning mb-2">
        <div class="bi-star-fill"></div>
        <div class="bi-star-fill"></div>
        <div class="bi-star-fill"></div>
        <div class="bi-star-fill"></div>
        <div class="bi-star-fill"></div>
        </div>`:
        
        ` <div class="d-flex justify-content-center small text-warning mb-2">
        <div class="bi-star-fill"></div>
        <div class="bi-star-fill"></div>
        <div class="bi-star-half"></div>
       
        </div>`;

        productsElement.innerHTML += `
        <div class="col-md-3 mb-1 p-2">
            <div class="card shadow">
            <!-- Sale badge-->
                ${saleBadge}
                <img class="card-img-top" src="img/${product.product_image}" alt="${product.product_name}" />
                <div class="card-body p-4">
                    <div class="text-center">
                        <h5 class="fw-bolder">${product.product_name}</h5>
                        <h6 class="fw-bolder text-success">${product.product_status}</h6>
                        ${starReview}
                        <span class="text-muted text-decoration-line-through">
                        £${parseInt(product.product_price)+ ((parseInt(product.product_price)/100)*10)}</span>
                        Price £${product.product_price}
                    </div>
                </div>
                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#" onclick="addToCart(${product.product_id})">Add to cart</a></div>
                </div>
            </div>
        </div>
        `;

    });
}


// Function to update the cart in the UI
function updateCart() {
    const cartElement = document.getElementById('cart');
    const totalPriceElement = document.getElementById('totalPrice');
    let totalItemCountElement = document.getElementById('totalItemCount');
    let totalPrice = 0;
    let totalItemCount = 0;
    let subTotal = 0;

    cartElement.innerHTML = '';
    cart.forEach(item => {
        subTotal = (parseInt(item.product_price) * parseInt(item.quantity));

        const listItem = document.createElement('li');
        listItem.className = 'row list-group-item d-flex justify-content-between align-items-center my-1 shadow';
        listItem.innerHTML = `
            <div class="col-md-2 d-flex justify-content-center">
                <img class="img-fluid img-thumbnail" src="img/${item.product_image}" alt="Product Image Placeholder">
            </div>
            <div class="col-md-4 d-flex justify-content-center">
                <p>${item.product_name} - £${item.product_price} x ${item.quantity}</p>
            </div>
          
            <div class="col-md-3 d-flex justify-content-end" >
                <button class="btn btn-primary btn-sm mx-1" onclick="decreaseQuantity(${item.product_id})">-</button>
                <span class="mx-1">${item.quantity}</span>
                <button class="btn btn-primary btn-sm mx-1" onclick="increaseQuantity(${item.product_id})">+</button>
                <button class="btn btn-danger btn-sm ms-2" onclick="removeFromCart(${item.product_id})">Remove</button>
            </div>
            <div class="col-md-3 d-flex justify-content-end">
            <p>Subtotal : £${subTotal.toFixed(2)}</p>
        </div>
        `;
        cartElement.appendChild(listItem);
        totalPrice += item.product_price * item.quantity;
        totalItemCount += parseInt(item.quantity)
    });

    totalPriceElement.textContent = totalPrice.toFixed(2);
    totalItemCountElement.textContent = totalItemCount;
    localStorage.setItem('cart', JSON.stringify(cart));
    if (cart.length == 0) {
        document.getElementById("modalTitle").innerHTML = "Your Shopping Cart is empty! <a href='index.php'>Shop Now !</a>";
        document.getElementById("clearCart").style.display = "none";
        document.getElementById("btnCheckOut").style.display = "none";
    } else {
        document.getElementById("modalTitle").innerHTML = "Your Shopping Cart!";
        document.getElementById("clearCart").style.display = "block";
        document.getElementById("btnCheckOut").style.display = "block";
    }
}

// Function to add a product to the cart
function addToCart(productId) {
    const selectedItem = products.find(product => product.product_id == productId);


    const existingItem = cart.find(item => item.product_id == selectedItem.product_id);
    if (existingItem) {
        existingItem.quantity++;
    } else {
        cart.push({
            ...selectedItem,
            quantity: 1
        });
        // The ellipsis (...) in JavaScript, 
        //often referred to as the spread syntax, 
        //is used to create a shallow copy of an object.
        // A shallow copy, copies the references of the original elements. 
        //In other words, it doesn't create new instances of nested objects or arrays; 
        //instead, it references the same memory addresses as the original elements.
    }

    updateCart();
    updateCartInDatabase(cart);
    if (document.getElementById('totalItemCountMini')) {
        displayCheckoutMiniCart(); // update display on checkout JS
    }

}

// Function to increase quantity
function increaseQuantity(productId) {
    const selectedItem = cart.find(item => item.product_id == productId);
    selectedItem.quantity++;
    updateCart();
    // Step 3: Update cart in the database
    updateCartInDatabase(cart);
    if (document.getElementById('totalItemCountMini')) {
        displayCheckoutMiniCart(); // update display on checkout JS
    }

}

// Function to decrease quantity
function decreaseQuantity(productId) {
    const selectedItem = cart.find(item => item.product_id == productId);
    if (selectedItem.quantity > 1) {
        selectedItem.quantity--;
        updateCart();
        // Step 3: Update cart in the database
        updateCartInDatabase(cart);
        if (document.getElementById('totalItemCountMini')) {
            displayCheckoutMiniCart(); // update display on checkout JS
        }

    }
}

// Function to remove item from the cart
function removeFromCart(productId) {
    alertify.confirm('Confirm Remove', 'Are you sure to remove this item?',
        function () {
            cart = cart.filter(item => item.product_id != productId);
            updateCart();
            updateCartInDatabase(cart);
            if (document.getElementById('totalItemCountMini')) {
                displayCheckoutMiniCart(); // update display on checkout JS
            }

            alertify.success('Item deleted')
        },
        function () {
            alertify.error('Cancel')
        })



}


function clearCart() {

    alertify.confirm('Confirm delete', 'Are you sure to empty the cart?',
        function () {
            cart = [];
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCart()
            updateCartInDatabase(cart);
            // location.reload();
            window.location.replace("index.php");
            // displayCheckoutMiniCart(); // update display on checkout JS
            alertify.success('Cart is cleared')

        },
        function () {
            alertify.error('Cancel')
        });

}


// Function to update cart in the database
function updateCartInDatabase(cart) {
    if (user_id != "") {
        fetch("api.php?action=update_cart", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(cart),
            })
            .then((response) => response.text())
            .then((message) => {
                console.log(message);
            })
            .catch((error) => {
                console.error("Error updating cart in the database:", error);
            });
    } else {
        //alert("Can't INSERT / UPDATE DB, No login")
    }
}


document.getElementById("clearCart").addEventListener("click", clearCart);




