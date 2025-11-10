<?php
// Database connection
include_once('../conn.php');

// Get available tables based on the number of guests
$guests = isset($_GET['guests']) ? (int)$_GET['guests'] : 2;
$sql = "SELECT * FROM tables WHERE seats >= ? AND is_available = TRUE";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $guests);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Reservation</title>
    <link rel="stylesheet" href="/a/styles.css">  <!-- Link to CSS file -->
</head>
<body>
    <h1>Make a Reservation</h1>

    <form action="process_reservation.php" method="POST">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="phone">Phone:</label><br>
        <input type="text" id="phone" name="phone" required><br><br>
        
        <label for="date">Date:</label><br>
        <input type="date" id="date" name="date" required><br><br>
        
        <label for="time">Time:</label><br>
        <input type="time" id="time" name="time" required><br><br>

        <label for="guests">Number of Guests:</label><br>
        <input type="number" id="guests" name="guests" value="<?php echo $guests; ?>" required><br><br>

        <h3>Select a Table:</h3>
        <?php while ($row = $result->fetch_assoc()): ?>
            <input type="radio" id="table_<?php echo htmlspecialchars($row['id']); ?>" name="table_id" value="<?php echo htmlspecialchars($row['id']); ?>" required>
            <label for="table_<?php echo htmlspecialchars($row['id']); ?>">Table <?php echo htmlspecialchars($row['table_number']); ?> (Seats: <?php echo htmlspecialchars($row['seats']); ?>)</label><br>
        <?php endwhile; ?>
        <br><br>

        <input type="submit" value="Reserve">
    </form>

    <?php
    // Close the connection
    $stmt->close();
    $conn->close();
    ?>
</body>
</html>
