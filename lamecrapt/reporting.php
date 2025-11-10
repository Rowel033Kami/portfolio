<?php
include 'conn.php'; // Include the database connection file

// Fetch reporting data
$query = "
    SELECT 
        SUM(orders.total) AS total_sold,
        COUNT(DISTINCT products.name) AS total_items
    FROM 
        orders
    JOIN 
        products ON orders.id = products.id
";

$result = $conn->query($query);

// Check if the query was successful
if ($result === false) {
    echo "Error: " . $mysqli->error;
    exit();
}

$data = $result->fetch_assoc();
$total_sold = $data['total_sold'] ?? 0;
$total_items = $data['total_items'] ?? 0;

$conn->close(); // Close the database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Reporting and Analysis</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 20px;
    background-color: #f5f5f5;
}

header {
    background-color: #00704a;
    color: white;
    padding: 20px;
    text-align: center;
}

nav {
    margin: 15px 0;
}

nav a {
    color: white;
    margin: 0 15px;
    text-decoration: none;
}

h1, h2 {
    margin: 0;
}

.report-section {
    margin: 20px 0;
}

.report {
    display: flex;
    justify-content: space-around;
    margin-top: 20px;
}

.report-item {
    background-color: white;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    width: 30%;
    text-align: center;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.report-item h3 {
    margin-bottom: 10px;
    color: #00704a;
}

.report-item p {
    font-size: 1.5em;
    color: #333;
}

    </style>
</head>
<body>
    <header>
        <h1>Reporting and Analysis</h1>
        <nav>
            <a href="management.php">Inventory</a>
            <a href="order.php">Orders</a>
        </nav>
    </header>
    <main>
        <section class="report-section">
            <h2>Inventory Analysis</h2>
            <div class="report">
                <div class="report-item">
                    <h3>Total Sold Items</h3>
                    <p><?php echo htmlspecialchars($total_sold); ?></p>
                </div>
                <div class="report-item">
                    <h3>Total Unique Items</h3>
                    <p><?php echo htmlspecialchars($total_items); ?></p>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
