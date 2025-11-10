<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
session_start();
include_once('conn.php');

if (isset($_SESSION['emaillog']) && isset($_SESSION['passwordlog'])) {
    $email = $_SESSION['emaillog'];
    $password = md5($_SESSION['passwordlog']); 

    // Use prepared statements for security
    $stmt = $conn->prepare("SELECT * FROM users WHERE Email = ? AND Password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch user data
        $user = $result->fetch_assoc();
        
        // Set session variables
        $_SESSION['email'] = $user['Email'];
        $_SESSION['user_id'] = $user['id'];

        echo "<script>alert('Login successful!'); window.location.href = 'index.php';</script>";
    } else {
        // User not found, login failed
        echo "<script>alert('Invalid email or password. Please try again.'); window.location.href = 'index.php';</script>";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('Please enter your login details.'); window.location.href = 'login.php';</script>";
}
?>


</body>
</html>