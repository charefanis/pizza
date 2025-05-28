// Scroll to the top when the button is clicked
scrollToTopBtn.addEventListener('click', function() {
  window.scrollTo({ top: 0, behavior: 'smooth' });
});

function toggleDarkMode(){
    var element = document.body;
    element.classList.toggle("dark-mode")
}