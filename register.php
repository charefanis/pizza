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

    <style>
        .footer2 {
            width: 100%;
            position: absolute;
            bottom: 0;
        }
    </style>
    <title>Pizza House</title>
</head>

<body>
    <?php
    include_once("nav.php");
    ?>

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

            <p class="text-center">
                have an account? <a href="login.php" style="color:#20c997;">Log in</a>
            </p>
        </form>
    </div>
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