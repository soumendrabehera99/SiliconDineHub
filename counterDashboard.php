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
            height: 600px; /* Adjust the height as needed 650px perfect height*/
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
        <div class="col-lg-7 col-md-12 orders">
            <div class="row d-flex align-items-center">
                <div class="col-12 d-flex justify-content-between align-items-center mb-3">
                    <h3 class="mb-0">Incoming Orders</h3>
                    <div class="position-relative w-50 ms-3">
                        <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                        <input 
                            type="text" 
                            class="form-control ps-5" 
                            id="searchIncoming" 
                            placeholder="Search Incoming Orders..."
                        >
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>SIC</th>
                                <th>Order Item</th>
                                <th>Amount</th>
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
                                <td>₹80</td>
                                <td><span class="badge bg-warning status-badge">Pending</span></td>
                                <td>
                                    <button class="btn btn-primary btn-sm">Receive</button>
                                    <button class="btn btn-danger btn-sm">Cancel</button>
                                    <button class="btn btn-success btn-sm">Complete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Ravi Kumar</td>
                                <td>23mmci19</td>
                                <td>Veg Roll</td>
                                <td>₹60</td>
                                <td><span class="badge bg-warning status-badge">Pending</span></td>
                                <td>
                                    <button class="btn btn-primary btn-sm">Receive</button>
                                    <button class="btn btn-danger btn-sm">Cancel</button>
                                    <button class="btn btn-success btn-sm">Complete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Priya Sharma</td>
                                <td>23mmci21</td>
                                <td>Chowmein</td>
                                <td>₹70</td>
                                <td><span class="badge bg-warning status-badge">Pending</span></td>
                                <td>
                                    <button class="btn btn-primary btn-sm">Receive</button>
                                    <button class="btn btn-danger btn-sm">Cancel</button>
                                    <button class="btn btn-success btn-sm">Complete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Aman Verma</td>
                                <td>23mmci15</td>
                                <td>Pizza Slice</td>
                                <td>₹90</td>
                                <td><span class="badge bg-warning status-badge">Pending</span></td>
                                <td>
                                    <button class="btn btn-primary btn-sm">Receive</button>
                                    <button class="btn btn-danger btn-sm">Cancel</button>
                                    <button class="btn btn-success btn-sm">Complete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Neha Singh</td>
                                <td>23mmci11</td>
                                <td>Cold Coffee</td>
                                <td>₹40</td>
                                <td><span class="badge bg-warning status-badge">Pending</span></td>
                                <td>
                                    <button class="btn btn-primary btn-sm">Receive</button>
                                    <button class="btn btn-danger btn-sm">Cancel</button>
                                    <button class="btn btn-success btn-sm">Complete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Rahul Yadav</td>
                                <td>23mmci30</td>
                                <td>Momos</td>
                                <td>₹50</td>
                                <td><span class="badge bg-warning status-badge">Pending</span></td>
                                <td>
                                    <button class="btn btn-primary btn-sm">Receive</button>
                                    <button class="btn btn-danger btn-sm">Cancel</button>
                                    <button class="btn btn-success btn-sm">Complete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>Simran Kaur</td>
                                <td>23mmci08</td>
                                <td>Chocolate Shake</td>
                                <td>₹65</td>
                                <td><span class="badge bg-warning status-badge">Pending</span></td>
                                <td>
                                    <button class="btn btn-primary btn-sm">Receive</button>
                                    <button class="btn btn-danger btn-sm">Cancel</button>
                                    <button class="btn btn-success btn-sm">Complete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>Vikas Sharma</td>
                                <td>23mmci12</td>
                                <td>French Fries</td>
                                <td>₹45</td>
                                <td><span class="badge bg-warning status-badge">Pending</span></td>
                                <td>
                                    <button class="btn btn-primary btn-sm">Receive</button>
                                    <button class="btn btn-danger btn-sm">Cancel</button>
                                    <button class="btn btn-success btn-sm">Complete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>Kavita Mehra</td>
                                <td>23mmci26</td>
                                <td>Ice Cream</td>
                                <td>₹30</td>
                                <td><span class="badge bg-warning status-badge">Pending</span></td>
                                <td>
                                    <button class="btn btn-primary btn-sm">Receive</button>
                                    <button class="btn btn-danger btn-sm">Cancel</button>
                                    <button class="btn btn-success btn-sm">Complete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td>Manish Roy</td>
                                <td>23mmci09</td>
                                <td>Sandwich</td>
                                <td>₹55</td>
                                <td><span class="badge bg-warning status-badge">Pending</span></td>
                                <td>
                                    <button class="btn btn-primary btn-sm">Receive</button>
                                    <button class="btn btn-danger btn-sm">Cancel</button>
                                    <button class="btn btn-success btn-sm">Complete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Completed Orders -->
        <div class="col-lg-5 col-md-12 orders">
            <div class="row d-flex align-items-center">
                <div class="col-12 d-flex justify-content-between align-items-center mb-3">
                    <h3 class="mb-0">Completed Orders</h3>
                    <div class="position-relative w-50 ms-3">
                        <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                        <input 
                            type="text" 
                            class="form-control ps-5" 
                            id="searchCompleted" 
                            placeholder="Search Completed Orders..."
                        >
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-success">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>SIC</th>
                                <th>Order Item</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Aarti Yadav</td>
                                <td>23mmci32</td>
                                <td>Cold Coffee</td>
                                <td>₹40</td>
                                <td><span class="badge bg-success status-badge">Completed</span></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Sumit Kumar</td>
                                <td>23mmci28</td>
                                <td>Veg Roll</td>
                                <td>₹60</td>
                                <td><span class="badge bg-success status-badge">Completed</span></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Deepika Sharma</td>
                                <td>23mmci14</td>
                                <td>Cheese Burger</td>
                                <td>₹80</td>
                                <td><span class="badge bg-success status-badge">Completed</span></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Aditya Jain</td>
                                <td>23mmci07</td>
                                <td>Pizza Slice</td>
                                <td>₹90</td>
                                <td><span class="badge bg-success status-badge">Completed</span></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Sneha Rani</td>
                                <td>23mmci29</td>
                                <td>Chowmein</td>
                                <td>₹70</td>
                                <td><span class="badge bg-success status-badge">Completed</span></td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Mohit Sinha</td>
                                <td>23mmci17</td>
                                <td>Momos</td>
                                <td>₹50</td>
                                <td><span class="badge bg-success status-badge">Completed</span></td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>Jyoti Singh</td>
                                <td>23mmci20</td>
                                <td>Ice Cream</td>
                                <td>₹30</td>
                                <td><span class="badge bg-success status-badge">Completed</span></td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>Shivam Raj</td>
                                <td>23mmci06</td>
                                <td>French Fries</td>
                                <td>₹45</td>
                                <td><span class="badge bg-success status-badge">Completed</span></td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>Muskan Sharma</td>
                                <td>23mmci27</td>
                                <td>Chocolate Shake</td>
                                <td>₹65</td>
                                <td><span class="badge bg-success status-badge">Completed</span></td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td>Ashutosh Verma</td>
                                <td>23mmci10</td>
                                <td>Sandwich</td>
                                <td>₹55</td>
                                <td><span class="badge bg-success status-badge">Completed</span></td>
                            </tr>
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
    // Incoming Orders Search
    document.getElementById('searchIncoming').addEventListener('keyup', function () {
        let value = this.value.toLowerCase();
        let rows = document.querySelectorAll('.orders:nth-of-type(1) tbody tr');

        rows.forEach(row => {
        let text = row.textContent.toLowerCase();
        row.style.display = text.includes(value) ? '' : 'none';
        });
    });

    // Completed Orders Search
    document.getElementById('searchCompleted').addEventListener('keyup', function () {
        let value = this.value.toLowerCase();
        let rows = document.querySelectorAll('.orders:nth-of-type(2) tbody tr');

        rows.forEach(row => {
        let text = row.textContent.toLowerCase();
        row.style.display = text.includes(value) ? '' : 'none';
        });
    });
</script>
</body>
</html>
