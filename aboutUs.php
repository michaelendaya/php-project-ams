<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="stylesheet" href="style/base.css">
    <link rel="stylesheet" href="style/welcome.css">
    <title>Apartment Management System</title>
</head>

<body>
    <nav class="navbar navbar-light bg-dark">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1 text-light"> <i class="far fa-building"></i> Apartment Management System</span>
            <a href="logout.php" class="text-light">Logout</a>
        </div>
    </nav>
    <!-- sidebar -->
    <div class="content">
        <div class=".d-flex flex-column flex-shrink-0 p-3 bg-light side" style="">
            <ul class="nav nav-pills flex-column mb-auto">
                <li>
                    <a class="nav-link link-dark">Utilities</a>
                    <a class="nav-link link-dark" href="tenant.php">Tenants</a>
                    <a class="nav-link link-dark" href="aboutUs.php" style="text-align: center;">About Us</a>
                </li>
                <li>
            </ul>
        </div>
        <!-- PAGE CONTENTS -->
        <div class="container mt-2">
            <div class="card menu-card">
                <div class="card-body " style="padding-left: 40px; padding-right: 40px;">
              
                <i class="far-circle-info"></i>
                <i class="fa-solid fa-circle-info"></i>
                <i class="fas fa-info-circle" style="font-size: 10vh;"></i>
                <h1>About Our Team</h1>   
                <br>
                
                <div style="text-align: left; padding: 100px 40px;">
                <h4 style="text-align:justify;  text-indent: 50px; margin-bottom: 60px;">We are Group 5 from 4IT-G. We develop this website to help apartment owners to manage their tenants' information and utility balances. We are studying BS Information Technology in University of Santo Tomas. </h4>
                <h4 style="margin-bottom: 20px;">Development Team</h4>
                <div style="font-size: 20px;">
                <p>Head Developer: Michael Endaya</p>
                <p>Database Designer: Marwin Falqueza</p>
                <p>Developer: Christian Bryan Portugal</p>
                <p>Developer: Joaquin Antonio Lozano</p>
                </div>
                <h4 style="margin-bottom: 20px; padding-top: 30px;">Contact Us</h4>
                <div style="font-size: 20px;">
                <p>Email: apartment_ms_group5@gmail.com</p>
                <p>Mobile #: 09498092144 </p>
                </div>
                
                </div>
               
                </div>
            </div>
        </div>




    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
<style>

</style>

</html>