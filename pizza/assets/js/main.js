// Scroll to the top when the button is clicked
scrollToTopBtn.addEventListener('click', function () {
  window.scrollTo({ top: 0, behavior: 'smooth' });
});

function toggleDarkMode() {
  var element = document.body;
  element.classList.toggle("dark-mode")
}

document.addEventListener('DOMContentLoaded', function () {
  const buttons = document.querySelectorAll('.add-cart');

  buttons.forEach(button => {
    button.addEventListener('click', function () {
      const productId = this.getAttribute('data-id');

      fetch('add_to_cart.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'product_id=' + encodeURIComponent(productId)
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          alert(data.message);
          console.log('Cart count:', data.cartCount);
          
          const badge = document.getElementById('cart-count');
          if (badge) {
            badge.textContent = data.cartCount;
          }
        } else {
          alert('Erreur : ' + data.message);
        }
      })
      .catch(error => {
        console.error('Fetch error:', error);
        alert('Une erreur est survenue.');
      });
    });
  });
});
