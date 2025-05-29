<?php
session_start();

header('Content-Type: application/json');

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item["num_art"] == $productId)
        {
            $found = true;
            $item["qte"]++;
            break;
        }
    }
    if (!$found) {
        $pdo = new PDO("mysql:host=localhost;dbname=pizzahouse", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select * from article where num_art=" . $_POST['product_id'];
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($results as $row) {
            $row['qte']=1;
            $_SESSION['cart'][] = $row;
        }
        

    }

    echo json_encode([
        'success' => true,
        'cartCount' => count($_SESSION['cart']),
        'message' => 'Product added to cart!'. count($_SESSION['cart']),
    ]);
    exit;
}

echo json_encode(['success' => false, 'message' => 'Invalid request']);
