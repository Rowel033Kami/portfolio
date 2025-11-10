<?php include_once("conn.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>group6's Starbucks inventory system</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="header">
    
    <div class="title"><img src="https://media.tenor.com/06-71w48AsQAAAAj/starbucks.gif" alt="" class="user-icon"> <div class="headertext"> Starbucks inventory</div></div>
    <div class="user-info">
        <img src="https://media.tenor.com/EF4uD2rZb2oAAAAM/jerkarn.gif" alt="User Icon" class="user-icon">
        <span class="username"><a href="">Login</a></span>
    </div>
</div>


<div class="homepage">
    <div class="color-panel">
        <div class="user-info1">
            <img src="https://media.tenor.com/EF4uD2rZb2oAAAAM/jerkarn.gif" alt="User Icon" class="user-icon1">
            <span class="username1">Login</span>
            <span class="active-indicator">●not active</span>
        </div>
        <div class="color-options">
            <div class="color-option" onclick="change('home')">Home</div>
            <div class="color-option" onclick="change('dashboard')">Dashboard Overview</div>
            <div class="color-option" onclick="change('management')">Inventory Management</div>
            <div class="color-option" onclick="change('order')">Order Management</div>
            <div class="color-option" onclick="change('integration')">Integration Capabilities</div>
            <div class="color-option" onclick="change('promotion')">Promotions and Seasonal Stock</div>
        </div>
    </div>
    <?
    
    
    ?>
    <div class="content"  style="display:block;" >
           <object data="home.php" type="text/html" height ="100%" width="100%" id="board"></object>
    </div>
    <script>
        function change(php){
            document.getElementById('board').data = php + ".php";
        }
    </script>



</div>

<script src="script.js"></script>
</body>
</html>
