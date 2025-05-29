<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$pdo = new PDO("mysql:host=localhost;dbname=pizzahouse", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Fetch user info
$stmtUser = $pdo->prepare("SELECT nom_cnsm, prenom_cnsm, email_cnsm FROM consomateur WHERE num_cnsm = ?");
$stmtUser->execute([$user_id]);
$user = $stmtUser->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "User not found.";
    exit;
}

// Fetch order history for this user
$stmtOrders = $pdo->prepare("
    SELECT num_cmd, date_cmd, statut, total_cmd 
    FROM commande 
    WHERE num_cnsm = ? 
    ORDER BY date_cmd DESC
");
$stmtOrders->execute([$user_id]);
$orders = $stmtOrders->fetchAll(PDO::FETCH_ASSOC);

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
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <title>Client-Dashboard</title>
    <style>
        .logout-form button {
            background-color: #e74c3c;
            /* A vibrant red */
            color: white;
            /* White text for good contrast */
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .logout-form button:hover {
            background-color: #c0392b;
            /* Darker red on hover */
        }
        body {
            display: grid !important;
            grid-template-rows: auto 1fr auto !important;
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
    <div class="container mt-5">
        <h2>Welcome, <?= htmlspecialchars($user['prenom_cnsm']) ?>!</h2>

        <div class="card mb-4">
            <div class="card-header">
                Your Profile
            </div>
            <div class="card-body">
                <p><strong>Name:</strong>
                    <?= htmlspecialchars($user['prenom_cnsm']) . ' ' . htmlspecialchars($user['nom_cnsm']) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($user['email_cnsm']) ?></p>
                <!-- Add edit profile link if needed -->
            </div>
        </div>

        <h3>Your Order History</h3>

        <?php if (count($orders) === 0): ?>
            <p>You have not placed any orders yet.</p>
        <?php else: ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?= htmlspecialchars($order['num_cmd']) ?></td>
                            <td><?= date('d M Y', strtotime($order['date_cmd'])) ?></td>
                            <td><?= htmlspecialchars($order['statut']) ?></td>
                            <td>$<?= number_format($order['total_cmd'], 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
        <form action="logout.php" class="logout-form">
            <button>Logout</button>
        </form>
    </div>
    <?php
    include_once('footer2.php');
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>