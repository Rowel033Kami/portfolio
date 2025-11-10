<?php
include 'conn.php';

// Fetch items
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Inventory Management</h1>
        <nav>
            <a href="add.php">Add Item</a>
        </nav>
    </header>

    <main>
        <h2>Inventory Items</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Item Name</th>
                    <th>Expiry Date</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id']) ?></td>
                            <td><?= htmlspecialchars($row['name']) ?></td>
                            <td><?= htmlspecialchars($row['expiry_date']) ?></td>
                            <td><?= htmlspecialchars($row['stock']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="4">No items found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
</body>
</html>

<?php $conn->close(); ?>
