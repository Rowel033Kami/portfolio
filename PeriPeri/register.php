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
$fname = $_SESSION['fnamereg'];
$lname = $_SESSION['lnamereg'];
$mname = $_SESSION['mnamereg'];
$bday = $_SESSION['bdayreg'];
$email = $_SESSION['emailreg'];
$password = md5($_SESSION['passwordreg']);  

$sql = "INSERT INTO users (First_name, Last_name, Middle_name, Birthday, Email, Password	
) VALUES ('$fname', '$lname', '$mname', '$bday', '$email', '$password')";

if ($conn->query($sql) === TRUE) {
    session_unset();
    session_destroy();
    echo "<script>window.alert('Registration successful, Please log in.');
    window.location = 'index.php';</script>";

    
} else {
    session_unset();
    session_destroy();
    echo "<script>window.alert('Error, something went wrong. Try again.');</script>";
    header('Location: index.php');
}

?>
</body>
</html>