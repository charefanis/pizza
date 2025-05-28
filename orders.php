<?php
$pdo = new PDO("mysql:host=localhost;dbname=PizzaHouse", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Mise à jour du statut si formulaire soumis
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['update_status'])) {
    $stmt = $pdo->prepare("UPDATE commande SET statut = ? WHERE num_cmd = ?");
    $stmt->execute([$_POST['statut'], $_POST['num_cmd']]);
}

// Suppression d'une commande
if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM commande WHERE num_cmd = ?");
    $stmt->execute([$_GET['delete']]);
}

// Récupérer toutes les commandes
$cmds = $pdo->query("SELECT commande.*, consomateur.nom_cnsm 
                     FROM commande 
                     JOIN consomateur ON commande.num_cnsm = consomateur.num_cnsm 
                     ORDER BY commande.date_cmd DESC")->fetchAll(PDO::FETCH_ASSOC);
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
    <title>Document</title>
</head>

<body>

<div class="container my-5">
  <h2 class="mb-4 text-center">📦 Orders Management</h2>

  <div class="table-responsive">
    <table class="table table-hover align-middle shadow-sm border">
      <thead class="table-dark">
        <tr>
          <th>Order #</th>
          <th>Customer</th>
          <th>Date</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($cmds as $cmd): ?>
          <tr>
            <td><strong>#<?= $cmd['num_cmd'] ?></strong></td>
            <td><?= htmlspecialchars($cmd['nom_cnsm']) ?></td>
            <td><?= date('d/m/Y H:i', strtotime($cmd['date_cmd'])) ?></td>
            <td>
              <?php
                $status = $cmd['statut'];
                $badgeClass = match($status) {
                  'Pending' => 'bg-warning text-dark',
                  'Preparing' => 'bg-primary',
                  'Delivered' => 'bg-success',
                  default => 'bg-secondary'
                };
              ?>
              <span class="badge <?= $badgeClass ?>"><?= $status ?></span>
            </td>
            <td>
              <div class="d-flex flex-wrap gap-2">
                <!-- Update status form -->
                <form method="POST" class="d-flex align-items-center gap-2">
                  <input type="hidden" name="num_cmd" value="<?= $cmd['num_cmd'] ?>">
                  <select name="statut" class="form-select form-select-sm w-auto">
                    <option value="Pending" <?= $status === 'Pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="Preparing" <?= $status === 'Preparing' ? 'selected' : '' ?>>Preparing</option>
                    <option value="Delivered" <?= $status === 'Delivered' ? 'selected' : '' ?>>Delivered</option>
                  </select>
                  <button type="submit" name="update_status" class="btn btn-outline-success btn-sm">✅</button>
                </form>

                <!-- Delete button -->
                <a href="?delete=<?= $cmd['num_cmd'] ?>" 
                   class="btn btn-outline-danger btn-sm"
                   onclick="return confirm('Are you sure you want to delete this order?')">🗑️</a>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>



</body>

</html>