<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">

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
      <div
        class=".d-flex flex-column flex-shrink-0 p-3 bg-light"
        style="width: 150px; height: 100%"
      >
        <ul class="nav nav-pills flex-column mb-auto">
          <li>
            <a  class="nav-link link-dark">Button</a>
          </li>
          <li>
  
        </ul>
      </div>

    </div>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
      crossorigin="anonymous"
    ></script>
  </body>
  <style>
    body {
      margin: 0;
      padding: 0;
      overflow: hidden;
    }
    .sidebar {
      display: flex;
      flex-wrap: nowrap;
      height: 100vh;
      height: -webkit-fill-available;
      overflow-x: auto;
      overflow-y: hidden;
    }
  
    .nav-link {
      display: inline-block;
      position: relative;
      color: #0087ca;
    }
    .nav-link:after {
      content: "";
      position: absolute;
      width: 120%;
      transform: scaleX(0);
      height: 2px;
      bottom: 0;
      left: 0;
      background-color: #0087ca;
      transform-origin: bottom right;
      transition: transform 0.25s ease-out;
    }
    .nav-link:hover:after {
      transform: scaleX(1);
      transform-origin: bottom left;
    }
    .content {
        background:   linear-gradient(to bottom, rgba(245, 246, 252, 0.52), rgba(19, 34, 117, 0.73)),
    url('https://images7.alphacoders.com/365/thumb-1920-365706.jpg');
    background-size: cover;
      display: flex;
      height: 100vh;
    }
  </style>
</html>
