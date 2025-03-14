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
  <link rel="stylesheet" href="./../assets/fontawesome/all.css">
  
  <!-- fevicon -->
  <link rel="icon" href="./../assets/images/fevicon_logo.png" type="image/x-icon">

  <!-- Custom Styles -->
  <link href="./../assets/css/AdminCss/style.css" rel="stylesheet" />
  <link href="./../assets/css/AdminCss/foodManage.css" rel="stylesheet" />

  <!--Toastr-->
  <link href="./../assets/toastr/toastr.min.css" rel="stylesheet">
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <button class="btn btn-dark" id="sidebarToggler">
        <i class="fa-solid fa-bars"></i>
      </button>
      <a class="navbar-brand ps-3" href="./index.php">
        <img src="./../assets/images/logo.png" alt="logo" />
      </a>
      
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
      </div>
    </div>
  </nav>

  <aside class="sidebar bg-dark text-white d-flex flex-column justify-content-between position-fixed top-0 start-0 min-vh-100">
    <div>
        <div>
            <a href="./index.php" class="mt-3 text-white text-decoration-none d-flex align-items-center justify-content-between">
                <div><i class="fas fa-tachometer-alt me-3"></i>Dashboard</div>
            </a>
        </div>

        <div>
            <a href="#customer" class="dropdown-toggle text-white text-decoration-none d-flex align-items-center justify-content-between" data-bs-toggle="collapse">
                <div><i class="fa-solid fa-user me-3"></i> Customer</div> 
                <i class="fa-solid fa-chevron-right toggle-icon"></i>
            </a>
            <div class="collapse ms-5" id="customer">
                <a href="./customerAdd.php" class="text-white text-decoration-none d-flex align-items-center justify-content-between">Add Customer</a>
                <a href="./customerManage.php" class="text-white text-decoration-none d-flex align-items-center justify-content-between">Manage Customer</a>
                <a href="./customerValid.php" class="text-white text-decoration-none d-flex align-items-center justify-content-between">Valid Customer</a>
            </div>
        </div>

        <div>
            <a href="#foodCategory" class="dropdown-toggle text-white text-decoration-none d-flex align-items-center justify-content-between" data-bs-toggle="collapse">
                <div><i class="fa-solid fa-layer-group me-3"></i>Food Category</div>
                <i class="fa-solid fa-chevron-right toggle-icon"></i>
            </a>
            <div class="collapse ms-5" id="foodCategory">
                <a href="./manageCategory.php" class="text-white text-decoration-none d-flex align-items-center justify-content-between">Manage Category</a>
            </div>
        </div>

        <div>
            <a href="#food" class="dropdown-toggle text-white text-decoration-none d-flex align-items-center justify-content-between" data-bs-toggle="collapse">
                <div><i class="fa-solid fa-burger me-3"></i> Food</div> 
                <i class="fa-solid fa-chevron-right toggle-icon"></i>
            </a>
            <div class="collapse ms-5" id="food">
                <a href="./addFood.php" class="text-white text-decoration-none d-flex align-items-center justify-content-between">Add Food</a>
                <a href="./manageFood.php" class="text-white text-decoration-none d-flex align-items-center justify-content-between">Manage Food</a>
            </div>
        </div>

        <div>
            <a href="#counter" class="dropdown-toggle text-white text-decoration-none d-flex align-items-center justify-content-between" data-bs-toggle="collapse">
                <div><i class="fa-solid fa-utensils me-3"></i> Counter</div> 
                <i class="fa-solid fa-chevron-right toggle-icon"></i>
            </a>
            <div class="collapse ms-5" id="counter">
                <a href="./counterAdd.php" class="text-white text-decoration-none d-flex align-items-center justify-content-between">Add Counter</a>
                <a href="./counterManage.php" class="text-white text-decoration-none d-flex align-items-center justify-content-between">Manage Counter</a>
            </div>
        </div>

        <div>
            <a href="#dashboard" class="text-white text-decoration-none d-flex align-items-center justify-content-between">
                <div><i class="fa-solid fa-bell me-3"></i> Reminder</div>
            </a>
        </div>

        <div>
            <a href="#dashboard" class="text-white text-decoration-none d-flex align-items-center justify-content-between">
                <div><i class="fas fa-file-invoice me-3"></i> Invoice</div>
            </a>
        </div>

        <div>
            <a href="#dashboard" class="text-white text-decoration-none d-flex align-items-center justify-content-between">
                <div><i class="fas fa-chart-line me-3"></i> Report</div>
            </a>
        </div>

        <div>
            <a href="#dashboard" class="text-white text-decoration-none d-flex align-items-center justify-content-between">
                <div><i class="fa-solid fa-gear fa-spin me-3"></i> Setting</div>
            </a>
        </div>

        <div>
            <a href="./changeAdminPassword.php" class="text-white text-decoration-none d-flex align-items-center justify-content-between">
                <div><i class="fas fa-lock me-3"></i> Change Password</div>
            </a>
        </div>
    </div>

    <!-- Sidebar Footer -->
    <div class="sidebar-footer">
        <a href="../logout.php" class="text-decoration-none d-flex align-items-center justify-content-between w-100" style="color: #adb5bd;">
            <h5 class="my-0">Logout</h5>
            <div><i class="fa-solid fa-arrow-right-from-bracket mx-2"></i></div>
        </a>
    </div>
</aside>