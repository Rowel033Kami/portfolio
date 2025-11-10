<?php
include_once('../conn.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $table_id = $_POST['table_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $guests = $_POST['guests'];
    $date = $_POST['date'];

    // Insert reservation into the database
    $sql = "INSERT INTO reservations (table_id, name, email, phone, guests, date)
            VALUES ('$table_id', '$name', '$email', '$phone', '$guests', '$date')";

    if ($conn->query($sql) === TRUE) {
        // Mark the table as reserved
        $conn->query("UPDATE tables SET is_available = FALSE WHERE id = '$table_id'");
        echo "<script>window.alert('Reservation successful!'); window.location.href = '../index.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
