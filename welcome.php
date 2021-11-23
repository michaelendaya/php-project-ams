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
          <a class="nav-link link-dark">Tenants</a>
        </li>
        <li>
      </ul>
    </div>
    <!-- PAGE CONTENTS -->
    <div class="container mt-2">
      <div class="card menu-card">
        <div class="card-body welcome">
          <div>
          <i class="far fa-building" style="font-size: 10vh;"></i>
           <h1>Welcome to Appartment Management System</h1>   
        
            <br>
            <h3> Navigate thru the menu on the left side <h3>
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