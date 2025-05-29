<?php
$pdo = new PDO("mysql:host=localhost;dbname=pizzahouse", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id = $_POST['id'];
$action = $_POST['action'];

if ($action === 'block') {
    $pdo->prepare("UPDATE consomateur SET is_blocked = 1 WHERE num_cnsm = ?")->execute([$id]);
} elseif ($action === 'unblock') {
    $pdo->prepare("UPDATE consomateur SET is_blocked = 0 WHERE num_cnsm = ?")->execute([$id]);
}

header("Location: manage_customers.php");
exit;
