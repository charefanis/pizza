let carts = document.querySelectorAll('.add-cart');
let products = [
    {
        name: 'Vagetable Salad',
        tag: 'vagetableSalad',
        price: 10,
        description: "Description",
        image: "vegetable-salad.jpg",
        inCart: 0
    },
    {
        name: 'Pasta Salad',
        tag: 'pastaSalad',
        price: 10,
        description: "Description",
        image: "pasta-salad.jpg",
        inCart: 0
    },
    {
        name: 'Shopska Salad',
        tag: 'shopskaSalad',
        price: 10,
        description: "Description",
        image: "shopska-salad.jpg",
        inCart: 0
    },
    {
        name: 'Chease Salad',
        tag: 'cheaseSalad',
        price: 10,
        description: "Description",
        image: "chease-salad.jpg",
        inCart: 0
    }
];



const divSalad = document.querySelector(".div-salad"); // Container where you want to append the products

// Check if divSalad exists before continuing
if (divSalad) {
    // Loop through products and create HTML
    products.forEach(product => {
        const productHTML = `
            <div class="salad">
                <img class="d-item" src="${product.image}" alt="${product.name}">
                <button class="add-cart">Add to Cart</button>
                <div class="text">
                    <div class="price-name">
                        <b><p>${product.name}</p></b>
                        <b><p>${product.price} $</p></b>
                    </div>
                    <b><p>${product.description}</p></b>
                </div>
            </div>
        `;
        divSalad.innerHTML += productHTML; // Append the product HTML
    });
} 








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

const scrollToTopBtn = document.getElementById('scrollToTopBtn');

// Show the button when the user scrolls down 100px from the top
window.onscroll = function() {
  if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
    scrollToTopBtn.style.display = "block";
  } else {
    scrollToTopBtn.style.display = "none";
  }
};

// Scroll to the top when the button is clicked
scrollToTopBtn.addEventListener('click', function() {
  window.scrollTo({ top: 0, behavior: 'smooth' });
});

function toggleDarkMode(){
    var element = document.body;
    element.classList.toggle("dark-mode")
}


function adjustFooter() {
    const footers = document.querySelectorAll("footer"); // Select all footers
    const footerSeparator = document.querySelector(".footer-separator");
    const bodyHeight = document.body.offsetHeight;
    const windowHeight = window.innerHeight;

    // Check if body height is less than window height (short page)
    if (bodyHeight < windowHeight) {
        // Position the second footer (and separator) absolutely at the bottom
        footers[1].style.position = "absolute";
        footers[1].style.bottom = "0";
        footers[1].style.width = "100%";

        // Position the first footer 56px above the second footer
        footers[0].style.position = "absolute";
        footers[0].style.bottom = "56px";
        footers[0].style.width = "100%";
    
        // Position footer separator at the bottom, just above the second footer
        footerSeparator.style.position = "absolute";
        footerSeparator.style.bottom = "56px";
        footerSeparator.style.width = "100%";
    } else {
        // If page content is long enough, position the footers normally
        footers.forEach(footer => {
        footer.style.position = "relative";
        });
        footerSeparator.style.position = "relative";
        }
    }
    
    // Run on load and resize
    window.addEventListener("load", adjustFooter);
    window.addEventListener("resize", adjustFooter);
    
/*
    // Check if the salad-form exists before adding the event listener
const saladForm = document.getElementById('salad-form');
if (saladForm) {
    saladForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent form from refreshing the page
    
        // Get input values
        const name = document.getElementById('salad-name').value;
        const price = parseFloat(document.getElementById('salad-price').value);
        const description = document.getElementById('salad-description').value;
        const imageOption = document.querySelector('input[name="image-option"]:checked').value;
    
        // Decide image source based on the selected option
        let image = '';
        if (imageOption === 'upload') {
            const fileInput = document.getElementById('salad-image-file');
            if (fileInput.files && fileInput.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    image = e.target.result; // Get the image file data URL
                    addNewSalad(name, price, description, image); // Call function to add new salad
                };
                reader.readAsDataURL(fileInput.files[0]); // Read the file
            }
        } else if (imageOption === 'url') {
            image = document.getElementById('salad-image-url').value; // Get the URL
            addNewSalad(name, price, description, image); // Call function to add new salad
        }
    });
}

// Function to add the new salad to the products array and to the page
function addNewSalad(name, price, description, image) {
    // Create new salad object
    const newSalad = {
        name: name,
        tag: name.toLowerCase().replace(/\s+/g, ''),
        price: price,
        description: description,
        image: image,
        inCart: 0
    };

    // Add new salad to the products array
    products.push(newSalad);

    // Append the new salad to the page
    const divSalad = document.querySelector(".div-salad");
    const productHTML = `
            <div class="salad">
                <img class="d-item" src="${newSalad.image}" alt="${newSalad.name}">
                <button class="add-cart">Add to Cart</button>
                <div class="text">
                    <div class="price-name">
                        <b><p>${newSalad.name}</p></b>
                        <b><p>${newSalad.price} $</p></b>
                    </div>
                    <b><p>${newSalad.description}</p></b>
                </div>
            </div>
    `;
    divSalad.innerHTML += productHTML;

    // Clear the form fields
    document.getElementById('salad-form').reset();
}


*/














const saladForm = document.getElementById('salad-form');

if (saladForm) {
    saladForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent form from refreshing the page
    
        // Get input values
        const name = document.getElementById('salad-name').value;
        const price = parseFloat(document.getElementById('salad-price').value);
        const description = document.getElementById('salad-description').value;
        const imageOption = document.querySelector('input[name="image-option"]:checked').value;
    
        // Decide image source based on the selected option
        let image = '';
        if (imageOption === 'upload') {
            const fileInput = document.getElementById('salad-image-file');
            if (fileInput.files && fileInput.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    image = e.target.result; // Get the image file data URL
                    addNewSalad(name, price, description, image); // Call function to add new salad
                };
                reader.readAsDataURL(fileInput.files[0]); // Read the file
            }
        } else if (imageOption === 'url') {
            image = document.getElementById('salad-image-url').value; // Get the URL
            addNewSalad(name, price, description, image); // Call function to add new salad
        }
    });

    // Listen for changes on the image option radio buttons
    const uploadImageRadio = document.getElementById('upload-image');
    const urlImageRadio = document.getElementById('url-image');
    const fileUploadGroup = document.getElementById('file-upload-group');
    const urlInputGroup = document.getElementById('url-input-group');

    uploadImageRadio.addEventListener('change', toggleImageInput);
    urlImageRadio.addEventListener('change', toggleImageInput);

    function toggleImageInput() {
        if (uploadImageRadio.checked) {
            fileUploadGroup.style.display = 'block';  // Show file input
            urlInputGroup.style.display = 'none';    // Hide URL input
        } else if (urlImageRadio.checked) {
            fileUploadGroup.style.display = 'none';  // Hide file input
            urlInputGroup.style.display = 'block';   // Show URL input
        }
    }

    // Initialize the form with the correct input visibility
    toggleImageInput();  // Run this to ensure the form is correctly initialized
}

// Function to add the new salad to the products array and to the page
function addNewSalad(name, price, description, image) {
    // Create new salad object
    const newSalad = {
        name: name,
        tag: name.toLowerCase().replace(/\s+/g, ''),
        price: price,
        description: description,
        image: image,
        inCart: 0
    };

    // Add new salad to the products array
    products.push(newSalad);

    // Append the new salad to the page
    const divSalad = document.querySelector(".div-salad");
    const productHTML = `
            <div class="salad">
                <img class="d-item" src="${newSalad.image}" alt="${newSalad.name}">
                <button class="add-cart">Add to Cart</button>
                <div class="text">
                    <div class="price-name">
                        <b><p>${newSalad.name}</p></b>
                        <b><p>${newSalad.price} $</p></b>
                    </div>
                    <b><p>${newSalad.description}</p></b>
                </div>
            </div>
    `;
    divSalad.innerHTML += productHTML;

    // Clear the form fields
    document.getElementById('salad-form').reset();
}





































document.getElementById('authForm').addEventListener('submit', function(event) {
    event.preventDefault();  // Empêcher le rechargement de la page

    // Récupération des valeurs des champs
    const name = document.getElementById('fName').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    // Validation simple
    if (!name || !email || !password) {
        document.getElementById('message').innerText = 'Please fill in all the fields.';
        document.getElementById('message').style.color = 'red';
        return;
    }

    // Vérification du format de l'email
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!emailPattern.test(email)) {
        document.getElementById('message').innerText = 'Please enter a valid email.';
        document.getElementById('message').style.color = 'red';
        return;
    }

    // Si tout est ok, on affiche un message de succès (simulé)
    document.getElementById('message').innerText = `Hello ${name}, you are logged in!`;
    document.getElementById('message').style.color = 'green';
    
    // Ici, tu pourrais envoyer les données au backend pour vérifier l'utilisateur dans une base de données, par exemple.
});
