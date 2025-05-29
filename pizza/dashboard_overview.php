<?php
// Database connection
$pdo = new PDO("mysql:host=localhost;dbname=PizzaHouse", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Total Orders
$stmt1 = $pdo->query("SELECT COUNT(*) as total_orders FROM commande");
$total_orders = $stmt1->fetch()['total_orders'];

// Total Revenue
$stmt2 = $pdo->query("
    SELECT SUM(v.qnt_vnt * a.prix_art) AS total_revenue
    FROM vente v
    JOIN article a ON v.num_art = a.num_art
");
$total_revenue = $stmt2->fetch()['total_revenue'];

// Recent Orders
$stmt3 = $pdo->query("SELECT c.num_cmd, c.date_cmd, cn.nom_cnsm 
                      FROM commande c 
                      JOIN consomateur cn ON c.num_cnsm = cn.num_cnsm 
                      ORDER BY c.date_cmd DESC LIMIT 5");
$recent_orders = $stmt3->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard - PizzaHouse</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .card {
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      border: none;
    }
    .dashboard-title {
      font-weight: bold;
      margin-bottom: 30px;
    }
    .list-group-item {
      background-color: #f8f9fa;
      border: none;
    }
    .list-group-item + .list-group-item {
      border-top: 1px solid #dee2e6;
    }
  </style>
</head>
<body>
  <div class="container mt-5">
    <h2 class="text-center dashboard-title">Dashboard - PizzaHouse</h2>

    <div class="row text-center mb-4">
      <!-- Total Orders -->
      <div class="col-md-4 mb-3">
        <div class="card text-white bg-primary h-100">
          <div class="card-body">
            <h5 class="card-title">Total Orders</h5>
            <p class="card-text fs-2"><?php echo $total_orders; ?></p>
          </div>
        </div>
      </div>

      <!-- Total Revenue -->
      <div class="col-md-4 mb-3">
        <div class="card text-white bg-success h-100">
          <div class="card-body">
            <h5 class="card-title">Total Revenue</h5>
            <p class="card-text fs-2">€<?php echo number_format($total_revenue, 2); ?></p>
          </div>
        </div>
      </div>

      <!-- Recent Activity -->
      <div class="col-md-4 mb-3">
        <div class="card text-white bg-info h-100">
          <div class="card-body">
            <h5 class="card-title">Recent Activity</h5>
            <ul class="list-group list-group-flush mt-3">
              <?php foreach ($recent_orders as $order): ?>
                <li class="list-group-item">
                  <strong>Order #<?php echo $order['num_cmd']; ?></strong> by 
                  <?php echo htmlspecialchars($order['nom_cnsm']); ?> on 
                  <?php echo date('M d, Y', strtotime($order['date_cmd'])); ?>
                </li>
              <?php endforeach; ?>
              <?php if (empty($recent_orders)): ?>
                <li class="list-group-item">No recent orders.</li>
              <?php endif; ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
