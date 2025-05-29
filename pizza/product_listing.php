<?php
$pdo = new PDO("mysql:host=localhost;dbname=pizzahouse", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT * FROM article WHERE type_art = 'Pizza'";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="div-salad">
  <?php foreach ($results as $row): ?>
    <div class="salad">
      <img class="d-item" src="<?= $row['url_art'] ?>" alt="<?= htmlspecialchars($row['nom_art']) ?>">
      <button class="add-cart btn btn-sm btn-primary" data-id="<?= $row['num_art'] ?>">Add to Cart</button>
      <div class="text">
        <div class="price-name">
          <b><p><?= $row['nom_art'] ?></p></b>
          <b><p><?= $row['prix_art'] ?> €</p></b>
        </div>
        <b><p><?= $row['dsc_art'] ?></p></b>
      </div>
    </div>
  <?php endforeach; ?>
</div>
