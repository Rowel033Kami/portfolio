<?php
include_once('conn.php');
session_start();
// Fetch total products
$result = $conn->query("SELECT COUNT(*) AS total FROM products");
$totalProducts = $result->fetch_assoc()['total'];

// Fetch low stock alerts (e.g., stock less than 15)
$result = $conn->query("SELECT COUNT(*) AS low_stock FROM products WHERE stock < 15");
$lowStockAlerts = $result->fetch_assoc()['low_stock'];

// Fetch expiry this month (dummy value for now)
$result = $conn->query("SELECT count(*) FROM products WHERE expiry_date <= CURDATE() OR expiry_date <= DATE_ADD(CURDATE(), INTERVAL 7 DAY)");
$nearlyexpire = $result->fetch_assoc()['count(*)'];


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['del'])) {
    // Validate and sanitize the input
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

    if ($id > 0) {
        // Prepare the delete statement
        $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Item deleted successfully.";
        } else {
            $_SESSION['error'] = "Error deleting item.";
        }

        $stmt->close();
    } else {
        $_SESSION['error'] = "Invalid ID.";
    }

    // Redirect back to the same page to prevent form resubmission
    header("Location: " . $_SERVER['PHP_SELF']); // Redirect to the same page
    exit;
}

// Fetch products from the database
$query = "SELECT * FROM products"; 
$result = $conn->query($query);
$products = $result->fetch_all(MYSQLI_ASSOC);
?>
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Starbucks Inventory Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            overflow-x:hidden;
            width:98%;
        }
        .header {
            background-color: #00704A;
            color: white;
            padding: 20px;
            text-align: center;
            width:100%;
        }
        .container {
            padding: 20px;
            margin: auto;
            width: 100%;
        }
        .metrics {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
        }
        .metric {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            flex: 1;
            margin: 0 10px;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #00704A;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .button {
            background-color: #00704A;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
            text-decoration: none;
            display: inline-block;
        }
    </style>
</head>
<body>

<?php
if (isset($_SESSION['message'])) {
    echo "<script>window.alert('{$_SESSION['message']}')</script>";
    unset($_SESSION['message']);
}

if (isset($_SESSION['error'])) {
    echo "<div class='error'>{$_SESSION['error']}</div>";
    unset($_SESSION['error']);
}
?>

<div class="header">
    <h1>Inventory Dashboard</h1>
</div>

<div class="container">
    <div class="metrics">
        <div class="metric">
            <h2>Total Products</h2>
            <p><?php echo $totalProducts; ?></p>
        </div>
        <div class="metric">
            <h2>Low Stock Alerts</h2>
            <p><?php echo $lowStockAlerts; ?></p>
        </div>
        <div class="metric">
            <h2>Expiry Alerts</h2>
            <p><?php echo $nearlyexpire; ?></p>
        </div>
    </div>

    <h2>Product List</h2>
    <table>
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Category</th>
            <th>Stock Level</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product): ?>
        <tr>
            <td><?php echo htmlspecialchars($product['name']); ?></td>
            <td><?php echo htmlspecialchars($product['category']); ?></td>
            <td><?php echo htmlspecialchars($product['stock']); ?></td>
            <td>
                <form method="post">
                    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                    <button type="submit" class="button" name="del">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

    <a href="add.php" class="button">Add Product</a>
</div>
</body>
</html>
