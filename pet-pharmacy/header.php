<?php
include('connection.php');
$current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$current_url = preg_replace('/[^\/]+\.php$/', "", strstr($current_url, '?', true));

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pet Pharmacy</title>
  <link rel="stylesheet" href="./css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="./css/main.css" type="text/css" />
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" type="text/css" />
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
  <div>
    <section class="top-nav">
      <div class="container">
        <div>
          <nav>
            <ul class="clearfix">
              <li><a href="index.php" class="menu" target="_self">Home</a></li>
              <li><a href="about-us.php" class="menu" target="_self">About Us</a></li>
              <li><a href="registerproduct.php" class="menu" target="_self">Product Registry</a></li>
              <?php
              if (isset($_SESSION['username'])) {
              ?>
                <li><a href="dashboard.php" class="menu" target="_self">My Account</a></li>
                <li><a href="logout.php" class="menu" target="_self">Logout</a></li>
              <?php
              } else {
              ?>
                <li><a href="myaccount.php" class="menu" target="_self">My Account</a></li>
              <?php
              }
              ?>
            </ul>
          </nav>
        </div>
      </div>
    </section>