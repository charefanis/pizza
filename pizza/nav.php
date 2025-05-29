<nav class="navbar navbar-expand-lg sticky-top">
  <div class="container">

    <!-- Left: Logo -->
    <a class="navbar-brand" href="index.php">
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
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="menu.php">Menu</a>
        </li>
      </ul>

      <!-- Icons stacked vertically (only on small screens) -->
      <div class="sidebar-icons d-lg-none">
        <a href="login.php" class="nav-icon"><i class="fa-solid fa-user"></i></a>
        <?php
        session_start();
        $cartCount = isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0;
        ?>
        <a href="cart.php" class="btn nav-icon">
         <i class="fa-solid fa-shopping-cart"></i> Cart <span id="cart-count" class="badge bg-danger"><?= $cartCount ?></span>
        </a>

      </div>
    </div>

    <!-- Top-right icons (only on large screens) -->
    <div class="d-flex align-items-center top-icons d-none d-lg-flex">
      <a href="login.php" class="nav-icon"><i class="fa-solid fa-user"></i></a>
      <?php
        $cartCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
        ?>
        <a href="cart.php" class="btn nav-icon">
         <i class="fa-solid fa-shopping-cart" ></i> Cart <span id="cart-count" class="badge bg-danger"><?= $cartCount ?></span>
        </a>
    </div>

  </div>
</nav>