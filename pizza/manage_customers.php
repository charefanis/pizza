<?php
// DB connection
$pdo = new PDO("mysql:host=localhost;dbname=pizzahouse", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Handle block/unblock action
if (isset($_POST['block_id'])) {
    $blockId = $_POST['block_id'];
    $stmt = $pdo->prepare("SELECT role FROM consomateur WHERE num_cnsm = ?");
    $stmt->execute([$blockId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $user['role'] !== 'admin') {
        // Toggle is_blocked
        $stmt = $pdo->prepare("UPDATE consomateur SET is_blocked = NOT is_blocked WHERE num_cnsm = ?");
        $stmt->execute([$blockId]);
    }
    header("Location: manage_customers.php");
    exit;
}

// Fetch all customers
$stmt = $pdo->query("SELECT num_cnsm, nom_cnsm, prenom_cnsm, email_cnsm, role, is_blocked FROM consomateur ORDER BY num_cnsm DESC");
$customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Manage Customers - PizzaHouse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-5">
    <h2>Manage Customers</h2>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>First Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Blocked?</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $customer): ?>
                <tr>
                    <td><?= htmlspecialchars($customer['nom_cnsm']) ?></td>
                    <td><?= htmlspecialchars($customer['prenom_cnsm']) ?></td>
                    <td><?= htmlspecialchars($customer['email_cnsm']) ?></td>
                    <td><?= htmlspecialchars($customer['role']) ?></td>
                    <td><?= $customer['is_blocked'] ? 'Yes' : 'No' ?></td>
                    <td>
                        <!-- Block/Unblock Form -->
                        <?php if ($customer['role'] !== 'admin'): ?>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="block_id" value="<?= $customer['num_cnsm'] ?>">
                                <button type="submit" class="btn btn-sm <?= $customer['is_blocked'] ? 'btn-success' : 'btn-warning' ?>">
                                    <?= $customer['is_blocked'] ? 'Unblock' : 'Block' ?>
                                </button>
                            </form>

                            <!-- Delete Form -->
                            <form action="delete_customer.php" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this customer?');">
                                <input type="hidden" name="id" value="<?= $customer['num_cnsm'] ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        <?php else: ?>
                            <button class="btn btn-secondary btn-sm" disabled>Admin - No Actions</button>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if (empty($customers)): ?>
                <tr><td colspan="6" class="text-center">No customers found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
