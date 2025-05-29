<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $pdo = new PDO("mysql:host=localhost;dbname=pizzahouse","root","");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id = intval($_POST['id']);

    $stmt = $pdo->prepare("DELETE FROM article WHERE num_art = ?");
    $stmt->execute([$id]);

    header("Location: manage_product.php?deleted=1");
    exit;
} else {
    echo "Requête invalide.";
}
