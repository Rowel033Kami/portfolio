<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peri-Peri Capas Tarlac</title>
    <!-- Google Fonts Link For Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="script.js" defer></script>
    <style>
        #error {
    color: red;
    display: none;
}
html{
    scroll-behavior:smooth;
}
    </style>
</head>
<body>
<?php 
if (!isset($_SESSION['user_id'])) {
    echo '<script>document.body.classList.toggle("show-popup");</script>';
} 
    echo '<script>hidePopupBtn.addEventListener("click", () => showPopupBtn.click());</script>';

?>

<section id="Firstpage" style="margin-bottom:600px;">
    <header style="backdrop-filter:blur(3px);">
        <nav class="navbar">
            <span class="hamburger-btn material-symbols-rounded">menu</span>
            <a href="#" class="logo">
                <h2>Peri<i class="fas" style="color: red;">&#127798</i>Peri</h2>
            </a>
            <ul class="links">
                <span class="close-btn material-symbols-rounded">close</span>
                <li><a href="#Firstpage">Home</a></li>
                <li><a href="#Aboutpage">About us</a></li>
                <li><a href="#tabless">Tables</a></li>
                <li><a href="#reservation">Reservation</a></li>
                <li><a href="#contactpage">Contact us</a></li>
            </ul>
            <form action="logout.php">
                <button type="submit" style="width:100px;">Logout</button>
            </form>
        </nav>
    </header>
    <div class="blur-bg-overlay" style="overflow-y:scroll;"></div>
    <div class="form-popup" style="overflow-y:scroll;">
        <div class="form-box login">
            <div class="form-details">
                <h2 style="color:white;">Welcome Back</h2>
                <p style="color:white;">Please log in using your personal information to stay connected with us.</p>
            </div>
            <div class="form-content">
                <h2 style="color: rgb(255, 38, 0);">LOGIN</h2>
                <form method = "POST" >
                    <div class="input-field">
                        <input type="email" required name="emaillog">
                        <label>Email</label>
                    </div>
                    <div class="input-field">
                        <input type="password" required name="passwordlog">
                        <label>Password</label>
                    </div>
                    <a href="#" class="forgot-pass-link" style="color:black;">Forgot password?</a>
                    <button type="submit" name="loginbtn">Log In</button>
                </form>
                <div class="bottom-link" style="color:black;">
                    Don't have an account?
                    <a href="#" id="signup-link" style="color:navy;">Sign up</a>
                </div>
            </div>
        </div>
<?php
if(isset($_POST['loginbtn'])){
$_SESSION['emaillog'] = $_POST['emaillog'];
$_SESSION['passwordlog'] = $_POST['passwordlog'];
echo "<script>window.location = 'login.php';</script>";
}


?>
        <div class="form-box signup" >
            <div class="form-content" id="verpage">
                <h2 style="color: rgb(3, 111, 253);">Email Verification</h2>
                <form action="#" method="POST">
                <p>email:</p>
                <h4>testemail@gmail.com</h4>
            <div >
                <div class="namewrapper">
                    <div class="input-field">
                        <input type="text" required>
                        <label>Enter the code</label>
                    </div>
                    <button type="submit" style="width: 20%; background-color: green; margin-top: 20px; height: 100%;">Verify</button>
                </div>
                </form>
                <p>The code is sent to testemail@gmail.com</p>
            </div>
                <button name="send-code"  style="background-color: green;">Send Code</button>
            </div>
        
            <div class="form-content"  id="signform">
                <h2 style="color: rgb(255, 38, 0);" style="color:black;">SIGN UP</h2>
                <form  method="POST" id="codever" onsubmit="return validatePasswords()"> 
               
                    <div class="input-field">
                        <input type="email" required name="emailreg">
                        <label>Enter your email</label>
                    </div>
                    
                   <!-- <div id="codehide" >
                <div class="namewrapper">
                    <div class="input-field">
                        <input type="text" required name="emailreg">
                        <label>Enter the code</label>
                    </div>
                    </div>
                <p>The code is sent to testemail@gmail.com</p>
            </div>
                <button name="send-code" id="sendcode" style="background-color: green;">Send Code</button>
                -->
            <div class="namewrapper">
                    <div class="input-field">
                        <input type="text" required name="fnamereg">
                        <label>First name</label>
                    </div>
                    <div class="input-field">
                        <input type="text" required name="mnamereg">
                        <label >Middle name</label>
                    </div>
            </div>
                    <div class="input-field">
                        <input type="text" required name="lnamereg">
                        <label >Last name</label>
                    </div>
                    <div class="input-field">
                        <input type="date" required  name="bdayreg">
                        <label style="transform: translateY(-120%);
                        color: #00bcd4;
                        font-size: 0.75rem;">Enter your birthday</label>
                    </div>
            <div class="namewrapper">
                    <div class="input-field">
                        <input type="password" required minlength="8" class="pass" id="password" name="passwordreg">
                        <label >Create password</label>
                    </div>
                    <div class="input-field">
                        <input type="password"  minlength="8" required  class="pass" id="confirmPassword">
                        <label>Confirm password</label>
                    </div>
            </div>
            <span id="error" class="error">Passwords do not match!</span>
                    <div class="policy-text">
                        <input type="checkbox" id="policy" required>
                        <label for="policy" style="color:black;">
                            I agree the
                            <a href="#" class="option">Terms & Conditions</a>
                        </label>
                    </div>
                    <button id="verifyaccount" type="submit" name="regbtn">Verify account</button>
                </form>
<?php 
if(isset($_POST['regbtn'])){
$_SESSION['fnamereg'] = $_POST['fnamereg'];
$_SESSION['lnamereg'] = $_POST['lnamereg'];
$_SESSION['mnamereg'] = $_POST['mnamereg'];
$_SESSION['bdayreg'] = $_POST['bdayreg'];
$_SESSION['emailreg'] = $_POST['emailreg'];
$_SESSION['passwordreg'] = $_POST['passwordreg'];
echo "<script>window.location = 'otp.php';</script>";
}




?>
                <script>
    function validatePasswords() {
        // Get the values of the password fields
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirmPassword').value;
        
        // Check if passwords match
        if (password !== confirmPassword) {
            document.getElementById('error').style.display = 'inline';
            return false; // Prevent form submission
        } else {
            document.getElementById('error').style.display = 'none';
            return true; // Allow form submission
        }
    }
</script>
                <div class="bottom-link" style="color:black;">
                    Already have an account? 
                    <a href="#" id="login-link" style="color:navy;">Login</a>
                </div>
            </div>
            <div class="form-details">
                <h2 style="color:white;">Create Account</h2>
                <p style="color:white;">To communicate with us, please sign up using your personal information.</p>
            </div>
        </div>
    </div>

    <?php include_once('home.php');?>
</section>
<section id="Aboutpage">
    <?php
    include_once('aboutus.php');
    ?>

</section>
<section id="tabless">
<?php
    include_once('./tableslist/tabless.php');
    ?>
</section>
<section id="reservation">
    <?php
    include_once('reservation.php');
    ?>
</section>
<section id="contactpage">
     <?php
     include_once('contacts.php');
     ?>
</section>



</body>
</html>



