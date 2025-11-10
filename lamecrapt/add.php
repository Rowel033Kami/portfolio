<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $itemName = htmlspecialchars($_POST['item_name']);
    $category = htmlspecialchars($_POST['category']);
    $expiryDate = htmlspecialchars($_POST['expiry_date']);
    $quantity = htmlspecialchars($_POST['quantity']);
    
    // Database connection (replace with your database credentials)
    include_once('conn.php');
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL to insert data
    $sql = "INSERT INTO products (name, category, expiry_date, stock) VALUES ('$itemName', '$category', '$expiryDate', '$quantity')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('New record created successfully');</script>";
    } else {
        echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Submission Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #246142;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #fff;
        }
        .form-container {
            padding: 30px;
            width: 350px;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
        }
        input[type="text"],
        input[type="date"],
        input[type="number"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 2px solid #6a11cb;
            border-radius: 8px;
            transition: border-color 0.3s;
        }
        input[type="text"]:focus,
        input[type="date"]:focus,
        input[type="number"]:focus {
            border-color: #2575fc;
            outline: none;
        }
        input[type="submit"] {
            background-color: gray;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 10px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: lightgreen;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Add Item</h2>
    <form method="POST" action="">
        <input type="text" name="item_name" placeholder="Item Name" required>
        <input type="text" name="category" placeholder="Category" required>
        <input type="date" name="expiry_date" required>
        <input type="number" name="quantity" placeholder="Quantity" required min="1">
        <input type="submit" value="Submit">
    </form><br>
    <a href="management.php" style="color:blue; text-decoration:none;">Go back to Inventory Management</a>
</div>

</body>
</html>
