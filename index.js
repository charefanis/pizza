let carts = document.querySelectorAll('.add-cart');
let products = [
    {
        name: 'Vagetable Salad',
        tag: 'vagetableSalad',
        price: 10,
        inCart: 0
    },
    {
        name: 'Pasta Salad',
        tag: 'pastaSalad',
        price: 10,
        inCart: 0
    },
    {
        name: 'Shopska Salad',
        tag: 'shopskaSalad',
        price: 10,
        inCart: 0
    },
    {
        name: 'Chease Salad',
        tag: 'cheaseSalad',
        price: 10,
        inCart: 0
    }
];

for(let i= 0; i< carts.length; i++){
    carts[i].addEventListener('click', () =>{
        cartNumbers(products[i]);
        totalCost(products[i]);
    })
}


function initializeCart() {
    let productNumbers = localStorage.getItem('cartNumbers');

    const cartNumberElement = document.querySelector('.cart-number');

    if (productNumbers && cartNumberElement) {
        // Set the cart number text and ensure opacity is 1
        cartNumberElement.textContent = productNumbers;
        cartNumberElement.style.opacity = '1'; // Ensure it's fully visible
    }
}

// Update cart numbers on button click
function cartNumbers(product) {
    let productNumbers = localStorage.getItem('cartNumbers');
    productNumbers = parseInt(productNumbers);

    const cartNumberElement = document.querySelector('.cart-number');

    if (productNumbers) {
        localStorage.setItem('cartNumbers', productNumbers + 1);
        cartNumberElement.textContent = productNumbers + 1;
    } else {
        localStorage.setItem('cartNumbers', 1);
        cartNumberElement.textContent = 1;

        // Add animation only when cart changes from 0 to 1
        cartNumberElement.classList.remove('fade-down'); // Remove if already present
        void cartNumberElement.offsetWidth; // Trigger reflow to restart the animation
        cartNumberElement.classList.add('fade-down'); // Add animation class
    }

    setItems(product);


    function setItems(product){
        let cartItems = localStorage.getItem('productsInCart');
        cartItems = JSON.parse(cartItems)

        if(cartItems != null){
            if(cartItems[product.tag] == undefined){
                cartItems = {
                    ...cartItems,
                    [product.tag]: product
                }
            }
            cartItems[product.tag].inCart += 1
        }
        else{
            product.inCart = 1;
            cartItems = {
                [product.tag]: product
            }
        }
        localStorage.setItem('productsInCart', JSON.stringify(cartItems))
    }
}

function totalCost(product){
    console.log(product.price);
    localStorage.setItem("totalCost", product.price);
}

// Run initializeCart on page load
document.addEventListener('DOMContentLoaded', initializeCart);