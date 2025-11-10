<?php 
session_start();
include_once('conn.php');

// Include PHPMailer files and autoload
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

// Function to send OTP email
function sendOtpEmail($to, $otp) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'Jhonhendric2020@gmail.com';
        $mail->Password = 'usyt yizq rfgk ecfq'; // Secure this in production
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->setFrom('Jhonhendric2020@gmail.com', 'Peri-Peri Official OTP');
        $mail->addAddress($to);
        $mail->isHTML(true);
        $mail->Subject = 'Your OTP Verification Code';
        $mail->Body = "Your OTP verification code is: <strong>$otp</strong>";
        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Mailer Error: {$mail->ErrorInfo}");
        return false;
    }
}

// Handle OTP generation on request
if (isset($_POST['sendotp'])) {
    if (isset($_SESSION['emailreg'])) {
        $email = $_SESSION['emailreg'];
        $otp = rand(100000, 999999); // Generate a 6-digit OTP
        $_SESSION['otp'] = $otp;

        if (sendOtpEmail($email, $otp)) {
            $otp_sent = true;
        } else {
            $error = "Failed to send OTP. Please try again.";
        }
    } else {
        $error = "No email address found in session.";
    }
}

// Handle OTP verification
if (isset($_POST['verifybtn'])) {
    $enteredOtp = $_POST['otp'];
    if ($enteredOtp == $_SESSION['otp']) {
        echo "<script>alert('Verification successful!'); window.location = 'register.php';</script>";
        unset($_SESSION['otp']); // Clear OTP from session after successful verification
    } else {
        echo "<script>alert('Invalid OTP, please try again.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Verification</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Styling for form and buttons */
        #sendOtpButton, #verifyButton {
            width: 100%;
            color: #fff;
            border: none;
            padding: 14px 0;
            font-size: 1rem;
            font-weight: 500;
            border-radius: 3px;
            cursor: pointer;
            margin: 25px 0;
            background: #fd1e01;
            transition: 0.2s ease;
            text-align: center;
        }
        #sendOtpButton:hover, #verifyButton:hover {
            background: #a76400;
        }
    </style>
</head>
<body style="display:grid; place-items:center;">
    <div class="form-content">
        <h2 style="color:lime;">ACCOUNT VERIFICATION</h2>

        <?php if (!empty($error)) : ?>
            <p style="color: red;"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <?php if (isset($otp_sent) && $otp_sent): ?>
            <p style="color:white; font-family:cursive;">Otp is sent to <?= htmlspecialchars($_SESSION['emailreg']); ?></p>
        <?php endif; ?>

        <!-- OTP Form -->
        <form method="POST" style="width:100%;">
            <div class="input-field">
                <input type="text" name="otp" required style="color:white;">
                <label style="color:blue;">Enter the code</label>
            </div>
            <button type="submit" name="verifybtn" id="verifyButton">Verify</button>
        </form>

        <!-- Send OTP Button (if OTP not sent yet) -->
        <form method="POST" style="width:100%;">
            <button type="submit" name="sendotp" id="sendOtpButton">Send OTP</button>
        </form>
    </div>
</body>
</html>
