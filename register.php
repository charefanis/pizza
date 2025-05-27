<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
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
        .footer2 {
            width: 100%;
            position: absolute;
            bottom: 0;
        }

        .footer1 {
            position: absolute;
            bottom: 56px;
            width: 100%;
        }

        .footer-separator {
            position: absolute;
            bottom: 56px;
        }

        @media(max-width:767px) {

            .footer1,
            .footer-separator {
                display: none;
            }
        }
    </style>
</head>

<body>
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
                    <a href="login.html" class="nav-icon"><i class="fa-solid fa-user"></i></a>
                    <a href="#" class="nav-icon position-relative">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span class="cart-number">0</span>
                    </a>
                </div>
            </div>

            <!-- Top-right icons (only on large screens) -->
            <div class="d-flex align-items-center top-icons d-none d-lg-flex">
                <a href="login.html" class="nav-icon"><i class="fa-solid fa-user"></i></a>
                <a href="#" class="nav-icon position-relative">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span class="cart-number">0</span>
                </a>
            </div>

        </div>
    </nav>

    <div class="container" style="max-width: 400px; margin-top: 50px;">
        <form id="registerForm" method="POST" action="register.php">
            <h3 class="text-center mb-4">Create an Account</h3>

            <!-- Full Name -->
            <div class="mb-3">
                <input type="text" class="form-control" name="fullname" placeholder="Your Full Name" required>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <input type="email" class="form-control" name="email" placeholder="Your E-mail" required>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <input type="password" class="form-control" name="password" placeholder="Your Password" required>
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
                <input type="password" class="form-control" name="confirm-password" placeholder="Confirm Password"
                    required>
            </div>

            <!-- Submit Button -->
            <div class="mb-3">
                <button type="submit" class="btn register-btn"><b>REGISTER</b></button>
            </div>

            <button id="scrollToTopBtn" class="scrollToTopBtn"><i class="fa-solid fa-up-long"></i></button>
            <button class="toggleDarkMode" id="darkModeButton" onclick="toggleDarkMode()">Dark mode<i
                    class="fa-solid fa-moon"></i></button>
            <button class="toggleLightMode" id="lightModeButton" onclick="toggleDarkMode()"><i
                    class="fa-solid fa-sun"></i>Light
                mode</button>

            <?php
            include_once("footer2.php");
            ?>
            <script src="main.js"></script>
</body>

</html>
<?php
// Establish connection to the database (adjust the credentials as needed)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "PizzaHouse";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form input
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];

    // Validate inputs
    if (empty($fullname) || empty($email) || empty($password) || empty($confirmPassword)) {
        echo "All fields are required.";
    } elseif ($password !== $confirmPassword) {
        echo "Passwords do not match.";
    } else {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Check if the email already exists
        $sql = "SELECT * FROM consomateur WHERE email_cnsm = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "This email is already registered.";
        } else {
            // Insert the new user into the database
            $stmt = $conn->prepare("INSERT INTO consomateur (nom_cnsm, email_cnsm, password_cnsm, role, date_creation) 
                                    VALUES (?, ?, ?, ?, NOW())");
            $role = 'client'; // Default role
            $stmt->bind_param("ssss", $fullname, $email, $hashedPassword, $role);

            if ($stmt->execute()) {
                echo "Registration successful! You can <a href='login.php'>log in</a> now.";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        }
    }
}

$conn->close();
?>