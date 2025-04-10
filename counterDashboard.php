<?php
session_start();
if (!isset($_SESSION['counterID'])) {
    header("Location: counterLogin.php");
    exit();
}
$counterName = "Non-Veg";
$username = $_SESSION['userName'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Counter Dashboard</title>
    <link rel="stylesheet" href="./assets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/sweetalert/sweetalert2.css" />
    <link rel="stylesheet" href="./assets/fontawesome/all.css" />
    <!-- Fevicon -->
    <link rel="icon" href="./assets/images/fevicon_logo.png" type="image/x-icon">
    <style>
        body {
            background-color: #f8f9fa;
        }
        /* Navbar */
        .navbar {
            background-color: #222;
            padding: 12px 20px;
        }
        .navbar-brand {
            font-size: 20px;
            font-weight: bold;
            color: white !important;
        }
        .nav-info {
            color: #ffffff;
            font-size: 16px;
            margin-right: 15px;
        }
        .logout-btn {
            background-color: #dc3545;
            border: none;
            padding: 6px 12px;
            font-size: 14px;
        }
        .logout-btn:hover {
            background-color: #c82333;
        }
        /* Responsive Navbar */
        @media (max-width: 768px) {
            .navbar {
                /* flex-direction: column; */
                text-align: center;
            }
            .nav-info {
                display: block;
                margin-bottom: 8px;
            }
            .logout-btn {
                width: 100%;
            }
        }
        /* Table Styles */
        .table-responsive {
            overflow-x: hidden;
        }
        .card {
            border-radius: 8px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
            background: white;
            padding: 20px;
            margin-bottom: 20px;
        }
        .status-badge {
            border-radius: 12px;
            padding: 4px 10px;
            font-size: 14px;
        }
        .orders {
            height: 650px; /* Adjust the height as needed 650px perfect height*/
            display: flex;
            flex-direction: column;
        }

        .orders .card {
            flex: 1;
            overflow-y: auto;
        }
        /* Scrollbar Track */
        ::-webkit-scrollbar {
            width: 8px;
        }

        /* Scrollbar Track background */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        /* Scrollbar Thumb (the handle) */
        ::-webkit-scrollbar-thumb {
            background: hsl(228, 39%, 23%);
            border-radius: 6px;
        }

        /* Scrollbar Thumb on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: hsl(228, 39%, 33%);
        }
        .orders .card .table-responsive {
            padding-right: 10px;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar d-flex justify-content-between align-items-center w-100">
    <a class="navbar-brand" href="#">Counter: <?php echo $counterName; ?></a>
    <div>
        <span class="nav-info">Staff: <?php echo $username; ?></span>
        <a class="btn btn-sm logout-btn text-white" id="logoutBtn">Logout</a>
    </div>
</nav>

<!-- Main Content -->
<div class="mt-4 px-4">
    <div class="row">
        <!-- Incoming Orders -->
        <div class="col-lg-6 col-md-12 orders">
            <div class="row d-flex align-items-center">
                <div class="col-12 d-flex justify-content-between align-items-center mb-3">
                    <h3 class="mb-0">Incoming Orders</h3>
                    <div class="position-relative w-50 ms-3">
                        <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                        <input 
                            type="text" 
                            class="form-control ps-5" 
                            id="searchIncoming" 
                            placeholder="Search by Order ID..."
                        >
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-dark sticky-top">
                            <tr>
                                <th>Order ID</th>
                                <th>Name</th>
                                <th>SIC</th>
                                <th>Food</th>
                                <th>Order Type</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- AJAX will populate this -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pending Orders -->
        <div class="col-lg-6 col-md-12 orders">
            <div class="row d-flex align-items-center">
                <div class="col-12 d-flex justify-content-between align-items-center mb-3">
                    <h3 class="mb-0">Pending Orders</h3>
                    <div class="position-relative w-50 ms-3">
                        <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                        <input 
                            type="text" 
                            class="form-control ps-5" 
                            id="searchCompleted" 
                            placeholder="Search by Order ID..."
                        >
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-dark sticky-top">
                            <tr>
                                <th>Order ID</th>
                                <th>Name</th>
                                <th>SIC</th>
                                <th>Food</th>
                                <th>Order Type</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- AJAX will populate this -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="./assets/bootstrap/bootstrap.bundle.min.js"></script>
<script src="./assets/jquery/jquery-3.7.1.min.js"></script>
<script src="./assets/sweetalert/sweetalert2.all.min.js"></script>
<script src="./assets/js/counterDashboard.js"></script>

</body>
</html>
