<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/styles.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
  </style>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <title>Pizza House</title>
</head>

<body>
  <?php
  include_once("nav.php");
  ?>

  <div id="carouselExampleCaptions" class="carousel slide mb-4">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
        aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
        aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
        aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active c-item">
        <img src="assets/img/pizza/pizza1.jpg" class="d-block w-100 c-img" alt="pizza">
        <div class="carousel-caption d-none d-md-block">
          <h5>Perfect pizza</h5>
          <p>Experience the taste of a perfect pizza at PizzaHouse, one of the best restaurants!</p>
        </div>
      </div>
      <div class="carousel-item c-item">
        <img src="assets/img/pizza/pizza2.jpg" class="d-block w-100 c-img" alt="pizza">
        <div class="carousel-caption d-none d-md-block">
          <h5>Quality ingredient</h5>
          <p>We use only the best ingredients to make one-of-a-kind pizzas for our customers.</p>
        </div>
      </div>
      <div class="carousel-item c-item">
        <img src="assets/img/pizza/pizza3.jpg" class="d-block w-100 c-img" alt="pizza">
        <div class="carousel-caption d-none d-md-block">
          <a href="#section1"><button class="btn btn-warning mb-3"><b>VIEW OUR MENU</b></button></a>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <section id="section1" class="section1">
    <div>
      <h1 class="c-h1" data-aos="zoom-out">OUR MENU</h1>
      <div class="grid">
        <a href="salad.php">
          <div class="c-items" data-aos="fade-up">
            <img src="assets/img/salade/Salad.jpg" class="img-front" alt="salad">
            <img src="assets/img/salade/Salad2.jpg" alt="salad">
          </div>
        </a>
        <a href="pizza.php">
          <div class="c-items" data-aos="zoom-in">
            <img src="assets/img/pizza/Pizza4.jpg" class="img-front" alt="pizza">
            <img src="assets/img/pizza/Pizza4-2.jpg" alt="pizza">
          </div>
        </a>
        <a href="">
          <div class="c-items" data-aos="fade-down">
            <img src="assets/img/burger/Burger.jpg" class="img-front" alt="burger">
            <img src="assets/img/burger/Burger2.jpg" alt="burger">
          </div>
        </a>
        <a href="">
          <div class="c-items" data-aos="fade-down">
            <img src="assets/img/dessert/Dessert.jpg" class="img-front" alt="dessert">
            <img src="assets/img/dessert/Dessert2.jpg" alt="dessert">
          </div>
        </a>
        <a href="">
          <div class="c-items" data-aos="zoom-in">
            <img src="assets/img/drink/Drink.jpg" class="img-front" alt="drink">
            <img src="assets/img/drink/Drink2.jpg" alt="drink">
          </div>
        </a>
        <a href="">
          <div class="c-items" data-aos="fade-up">
            <img src="assets/img/seafood/Seafood.jpg" class="img-front" alt="seafood">
            <img src="assets/img/seafood/Seafood2.jpg" alt="seafood">
          </div>
        </a>
      </div>
    </div>
  </section>

  <div class="image-container">
    <img src="food.jpg" alt="Background">
    <div class="overlay-text">
      <h1 class="display-4 font-as" data-aos="zoom-out">Best atmosphere</h1>
      <p class="lead" data-aos="zoom-in">PizzaHouse is the place of the best Pizza and high-quality service</p>
      <p data-aos="zoom-in">Ben Smith, Founder</p>
      <button class="btn btn-success" data-aos="zoom-out"><b>VIEW OUR SERVICES</b></button>
    </div>
  </div>

  <div class="container mt-5" style="width:500px;" data-aos="zoom-out">
    <h1 class="text-center mb-4">Contact Form</h1>
    <form>
      <div class="mb-3">
        <input type="text" class="form-control" id="fName" placeholder="Your name">
      </div>
      <div class="mb-3">
        <input type="email" class="form-control" id="email" placeholder="Your E-mail">
      </div>
      <div class="mb-3">
        <select class="form-select" id="dropdown">
          <option selected disabled>Select a service</option>
          <option value="1">Dine-in</option>
          <option value="2">Carry-out</option>
          <option value="3">Event Catering</option>
        </select>
      </div>
      <div class="mb-3">
        <textarea class="form-control" id="message" rows="4" placeholder="Enter your message here"></textarea>
      </div>
      <div class="text-center">
        <button type="submit" class="btn btn-warning"><b>SEND MESSAGE</b></button>
      </div>
    </form>
  </div>

  <button id="scrollToTopBtn" class="scrollToTopBtn"><i class="fa-solid fa-up-long"></i></button>
  <button class="toggleDarkMode" id="darkModeButton" onclick="toggleDarkMode()">Dark mode<i
      class="fa-solid fa-moon"></i></button>
  <button class="toggleLightMode" id="lightModeButton" onclick="toggleDarkMode()"><i class="fa-solid fa-sun"></i>Light
    mode</button>


  <?php
  include_once("footer1.php");
  include_once("footer2.php");
  ?>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init({
      duration: 500
    });
  </script>
    <script src="assets/js/main.js?v=<?php echo time();?>"></script>
</body>

</html>