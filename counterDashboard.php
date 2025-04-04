<?php
session_start();
if (!isset($_SESSION['counterID'])) {
    header("Location: counter_login.php");
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
        <div class="col-lg-7 col-md-12">
            <h4 class="mb-3">Incoming Orders</h4>
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Student Name</th>
                                <th>SIC</th>
                                <th>Order Item</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Anil Sahu</td>
                                <td>23mmci37</td>
                                <td>Cheese Burger</td>
                                <td><span class="badge bg-warning status-badge">Pending</span></td>
                                <td>
                                    <button class="btn btn-primary btn-sm">Receive</button>
                                    <button class="btn btn-danger btn-sm">Cancel</button>
                                    <button class="btn btn-success btn-sm">Complete</button>
                                </td>
                            </tr>
                            <!-- More orders can be loaded here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Completed Orders -->
        <div class="col-lg-5 col-md-12 mt-4 mt-lg-0">
            <h4 class="mb-3">Completed Orders</h4>
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-success">
                            <tr>
                                <th>#</th>
                                <th>Student Name</th>
                                <th>Order Item</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Anil Sahu</td>
                                <td>Veggie Wrap</td>
                                <td><span class="badge bg-success status-badge">Completed</span></td>
                            </tr>
                            <!-- More completed orders can be loaded here -->
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
<script>
    $(document).ready(function () {
        // Existing form login logic here...

        // Logout confirmation
        $("#logoutBtn").on("click", function (e) {
            e.preventDefault(); // prevent direct redirect

            Swal.fire({
                title: "Are you sure?",
                text: "You will be logged out!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, logout"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "./logout.php";
                }
            });
        });
    });
</script>
</body>
</html>
