<?php
// Database connection
include_once('../conn.php');
// Collect form data
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$date = $_POST['date'];
$time = $_POST['time'];
$guests = $_POST['guests'];
$table_id = $_POST['table_id'];

// Start transaction
$conn->begin_transaction();

try {
    // Insert reservation data
    $stmt = $conn->prepare("INSERT INTO reservations (name, email, phone, date, time, guests, table_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssii", $name, $email, $phone, $date, $time, $guests, $table_id);
    $stmt->execute();

    // Mark table as unavailable
    $stmt = $conn->prepare("UPDATE tables SET is_available = FALSE WHERE id = ?");
    $stmt->bind_param("i", $table_id);
    $stmt->execute();

    // Commit transaction
    $conn->commit();

    echo "<script>window.alert('Reservation successful! We look forward to serving you.');
    window.location.href = 'index.php';
    </script>";

} catch (Exception $e) {
    // Rollback transaction in case of error
    $conn->rollback();
    echo "Error: " . $e->getMessage();
}

// Close the connection
$stmt->close();
$conn->close();
?>
