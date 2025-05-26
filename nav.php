<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">

      <!-- Left: Logo -->
      <a class="navbar-brand" href="index.html">
        <img src="pizzahouse.svg" alt="Logo">
      </a>

      <!-- Hamburger button -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Collapsible menu -->
      <div class="collapse navbar-collapse justify-content-center" id="mainNavbar">
        <ul class="navbar-nav mb-2 mb-lg-0 text-center">
          <li class="nav-item">
            <a class="nav-link" href="index.html">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#about">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#menu">Menu</a>
          </li>
        </ul>

        <!-- Icons stacked vertically (only on small screens) -->
        <div class="sidebar-icons d-lg-none">
          <a href="login.php" class="nav-icon"><i class="fa-solid fa-user"></i></a>
          <a href="cart.php" class="nav-icon position-relative">
            <i class="fa-solid fa-cart-shopping"></i>
            <span class="cart-number">0</span>
          </a>
        </div>
      </div>

      <!-- Top-right icons (only on large screens) -->
      <div class="d-flex align-items-center top-icons d-none d-lg-flex">
        <a href="login.php" class="nav-icon"><i class="fa-solid fa-user"></i></a>
        <a href="cart.php" class="nav-icon position-relative">
          <i class="fa-solid fa-cart-shopping"></i>
          <span class="cart-number">0</span>
        </a>
      </div>

    </div>
  </nav>