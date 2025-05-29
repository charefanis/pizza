<?php
$pdo = new PDO("mysql:host=localhost;dbname=pizzahouse", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM commande WHERE num_cnsm = ? ORDER BY date_cmd DESC");
$stmt->execute([$id]);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Order History for Customer #<?= htmlspecialchars($id) ?></h2>
<table class="table">
  <thead>
    <tr>
      <th>Order #</th>
      <th>Date</th>
      <th>Total</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($orders as $order): ?>
    <tr>
      <td><?= $order['num_cmd'] ?></td>
      <td><?= $order['date_cmd'] ?></td>
      <td><?= $order['total_cmd'] ?? 'N/A' ?> $</td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
