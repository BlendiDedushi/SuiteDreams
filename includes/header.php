<?php
session_start();

if (isset($_GET['action']) && $_GET['action'] == 'logout') {
  unset($_SESSION['id']);
  unset($_SESSION['username']);
  unset($_SESSION['isloggedin']);

  header('Location: index.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SuiteDreams</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
  <style>
    #map {
      height: 50vh;
      width: 75vh;
    }
  </style>
</head>

<body>
  <header class="background">
    <nav class="navbar navbar-expand-lg">
      <div class="container-fluid">
        <a class="navbar-brand text-light" href="index.php">SuiteDreams</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
          aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav ms-auto">
            <div class="navbar-nav mx-5">
              <a class="nav-link text-light" aria-current="page" href="index.php">Home</a>
              <a class="nav-link text-light" href="estates.php">Estates</a>
            </div>
            <div class="navbar-nav">
              <?php
              if (isset($_SESSION['isloggedin']) && $_SESSION['isloggedin'] == true) {
                echo '<a class="nav-link text-light" href="profile.php">MyProfile</a>';
                echo '<a class="nav-link text-light" href="?action=logout">LogOut</a>';
              } else {
                echo '<a class="nav-link text-light" href="register.php">SignUp</a>';
                echo '<a class="nav-link text-light" href="login.php">LogIn</a>';
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </header>