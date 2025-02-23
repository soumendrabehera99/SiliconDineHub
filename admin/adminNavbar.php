<?php
session_start();
include_once "./check.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Dashboard</title>

  <!-- Bootstrap CSS -->
  <link href="./../assets/bootstrap/bootstrap.min.css" rel="stylesheet" />

  <!-- Fontawesome -->
  <link rel="stylesheet" href="./../assets/fontawesome/css/fontawesome.css">
  <link rel="stylesheet" href="./../assets/fontawesome/css/regular.css">
  <link rel="stylesheet" href="./../assets/fontawesome/css/solid.css">
  <link rel="stylesheet" href="./../assets/fontawesome/css/brands.css">

  <!-- fevicon -->
  <link rel="icon" href="./../assets/images/fevicon_logo.png" type="image/x-icon">

  <!-- Custom Styles -->
  <link href="./../assets/css/AdminCss/style.css" rel="stylesheet" />
  <link href="./../assets/css/AdminCss/foodManage.css" rel="stylesheet" />

  <!--Toastr-->
  <link href="./../assets/toastr/toastr.min.css" rel="stylesheet">

  <link rel="stylesheet" href="./../assets/fontawesome/all.css" />
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand ps-5" href="./index.php">
        <img src="./../assets/images/logo.png" alt="logo" />
      </a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <div class="d-flex justify-content-center align-items-center ms-auto">
          <div class="me-3 position-relative">
            <a href="#" class="text-decoration-none">
              <i class="fa-solid fa-envelope" style="font-size: 1.5rem; color: white"></i>
              <span class="position-absolute me-2 top-0 start-100 translate-middle badge rounded-pill"
                id="notification" style="background-color: rgb(11, 218, 11)">5</span>
            </a>
          </div>
          <div class="me-3 position-relative">
            <a href="#" class="text-decoration-none">
              <i class="fa-solid fa-bell" style="font-size: 1.5rem; color: white"></i>
              <span class="position-absolute me-2 top-0 start-100 translate-middle badge rounded-pill"
                id="notification" style="background-color: rgb(243, 64, 64)">3</span>
            </a>
          </div>
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                <img src="./../assets/images/admin_Profile_image.jpg" alt="profile" class="profile-logo" />
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="./changeAdminPassword.php">Change Password</a></li>
                <li>
                  <hr class="dropdown-divider" />
                </li>
                <li><a class="dropdown-item" href="./adminLogout.php"><i class="fa-solid fa-arrow-right-from-bracket me-2"></i>Logout</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

    <!-- Sidebar -->
    <aside class="sidebar bg-dark">
      <div>
        <a href="./index.php" class="mt-3">
          <div><i class="fas fa-tachometer-alt me-3"></i>Dashboard</div>
        </a>
    
        <div>
          <a href="#customer" class="dropdown-toggle" data-bs-toggle="collapse" aria-expanded="false">
            <div><i class="fa-solid fa-user me-3"></i> Customer</div> <i class="fa-solid fa-chevron-right"></i>
          </a>
          <div class="collapse ms-5" id="customer">
            <a href="./customerAdd.php">Add Customer</a>
            <a href="./customerManage.php">Manage Customer</a>
          </div>
        </div>
    
        <div>
          <a href="#foodCategory" class="dropdown-toggle" data-bs-toggle="collapse" aria-expanded="false">
            <div><i class="fa-solid fa-layer-group me-3"></i>Food Category</div><i class="fa-solid fa-chevron-right"></i>
          </a>
          <div class="collapse ms-5" id="foodCategory">
            <!--Here i deleted the add category-->
            <a href="./manageCategory.php">Manage Category</a>
          </div>
        </div>
      
        <div>
          <a href="#food" class="dropdown-toggle" data-bs-toggle="collapse" aria-expanded="false">
            <div><i class="fa-solid fa-burger me-3"></i> Food</div> <i class="fa-solid fa-chevron-right"></i>
          </a>

          <div class="collapse ms-5" id="food">
            <a href="./addFood.php">Add Food</a>
            <a href="./manageFood.php">Manage Food</a>
          </div>
        </div>
        
        <div>
          <a href="#counter" class="dropdown-toggle" data-bs-toggle="collapse" aria-expanded="false">
            <div><i class="fa-solid fa-utensils me-3"></i> Counter</div> <i class="fa-solid fa-chevron-right"></i>
          </a>

          <div class="collapse ms-5" id="counter"> 
            <a href="./addCounter.php">Add Counter</a>
            <a href="#">Add Counter Category</a>
          </div>
        </div>

        <div>
          <a href="#dashboard" class="">
            <div><i class="fa-solid fa-bell me-3"></i> Reminder</div>
          </a>
        </div>
        <div>
          <a href="#dashboard" class="">
            <div><i class="fas fa-file-invoice me-3"></i> Invoice</div>
          </a>
        </div>
        <div>
          <a href="#dashboard" class="">
            <div><i class="fas fa-chart-line me-3"></i>Report</div>
          </a>
        </div>
        <div>
          <a href="#dashboard" class="">
            <div><i class="fa-solid fa-gear me-3"></i>Setting</div>
          </a>
        </div>
    </div>

    <!-- Sidebar Footer -->
    <div class="sidebar-footer text-start">
      <div class="sidebar-footer-content ms-2">
        <p class="my-0">Logged in as:</p>
        <p class="my-1">Silicon DineHub</p>
      </div>
    </div>
  </aside>