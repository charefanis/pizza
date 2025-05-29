<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Start a session to track user
session_start();

// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "PizzaHouse";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Get form input values
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Input validation
  if (empty($email) || empty($password)) {
    echo "Both email and password are required.";
  } else {
    // Query to check if user exists
    $sql = "SELECT * FROM consomateur WHERE email_cnsm = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      $user = $result->fetch_assoc();

      // Verify password
      if (password_verify($password, $user['password_cnsm'])) {
        // Set session variables
        $_SESSION['user_id'] = $user['num_cnsm'];
        $_SESSION['user_name'] = $user['nom_cnsm'];
        $_SESSION['user_email'] = $user['email_cnsm'];
        $_SESSION['role'] = $user['role'];

        // Redirect based on role (if needed)
        if ($user['role'] === 'admin') {
          header("Location: admin_dashboard.php"); // adjust file as needed
        } else {
          header("Location: client_dashboard.php"); // general user dashboard
        }
        exit();
      }
    } else {
    }

    $stmt->close();
  }
}


// Close the database connection
$conn->close();
?>
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
  <title>Pizza House</title>
  <style>
        body {
            display: grid !important;
            grid-template-rows: auto 1fr auto !important;
            grid-template-columns: 1fr !important;
            grid-template-areas:
                "navbar navbar"
                "main main"
                "footer footer" !important;
            height: 100vh;
            margin: 0;
            padding: 0;
        }
        nav {
            grid-area: navbar !important;
        }

        aside {
            grid-area: sidebar !important;
        }

        footer {
            grid-area: footer !important;
        }
  </style>
</head>

<body>
  <?php
  include_once("nav.php");
  ?>


  <section class="login">
    <div class="container-login container" style="max-width: 400px; margin-top: 50px;">
      <form method="POST" action="login.php">
        <h3 class="text-center mb-4">Login</h3>

        <!-- Email Field -->
        <div class="mb-3">
          <input type="email" class="form-control" id="email" name="email" placeholder="Your E-mail" required>
        </div>

        <!-- Password Field -->
        <div class="mb-3">
          <input type="password" class="form-control" id="password" name="password" placeholder="Your Password"
            required>
        </div>

        <!-- Submit Button -->
        <div class="mb-3">
          <button type="submit" class="btn login-btn"><b>LOGIN</b></button>
        </div>

        <!-- Register Link -->
        <p class="text-center">
          Don't have an account? <a href="register.php" style="color:#20c997;">Register</a>
        </p>
      </form>

      <p id="message"><?php

      if (!isset($_SESSION['user_id']) && isset($_POST["password"])) {
        echo "Incorrect password.";
      }
      ?>
      </p>
    </div>
  </section>


  <button class="toggleDarkMode" id="darkModeButton" onclick="toggleDarkMode()">Dark mode<i
      class="fa-solid fa-moon"></i></button>
  <button class="toggleLightMode" id="lightModeButton" onclick="toggleDarkMode()"><i class="fa-solid fa-sun"></i>Light
    mode</button>

  <?php
  include_once("footer2.php");
  ?>
    <script src="assets/js/main.js?v=<?php echo time();?>"></script>
</body>

</html>