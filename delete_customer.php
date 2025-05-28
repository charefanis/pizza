<?php
$pdo = new PDO("mysql:host=localhost;dbname=pizzahouse", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    if ($id) {
        // Check user role first
        $stmt = $pdo->prepare("SELECT role FROM consomateur WHERE num_cnsm = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $user['role'] === 'admin') {
            // Admin accounts cannot be deleted
            echo "You cannot delete an admin account.";
            exit;
        }

        // Delete if not admin
        $stmt = $pdo->prepare("DELETE FROM consomateur WHERE num_cnsm = ?");
        $stmt->execute([$id]);

        header("Location: manage_customers.php");
        exit;
    }
}
?>
