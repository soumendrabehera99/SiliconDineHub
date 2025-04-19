<?php 
include_once "adminNavbar.php"; 
require_once "../dbFunctions/studentdb.php";
require_once "../dbFunctions/fooddb.php";
require_once "../dbFunctions/orderHistorydb.php";
?>

<!-- Main Content -->
<section class="content w-100">
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-12 mb-3 d-flex justify-content-between align-items-center">
                <h2 class="">📋 Order History</h2>
                <!-- <a class="btn btn-success" href="">
                    <i class="fa-solid fa-plus me-1"></i> 
                </a> -->
            </div>

            <div class="col-12 bg-white border shadow-sm rounded p-3">
                <!-- Search and Total Records -->
                <div class="row align-items-center mb-3">
                    <div class="col-md-6 fw-semibold">
                        Total No. of Records: <?= totalOrder(); ?>
                    </div>
                    <div class="col-md-6 d-flex justify-content-md-end align-items-center">
                        <label for="searchInput" class="me-2 fw-medium mb-0">Search:</label>
                        <div class="position-relative" style="width: 250px;">
                            <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-2 text-muted"></i>
                            <input type="text" 
                                   id="searchInput" 
                                   class="form-control ps-4" 
                                   placeholder="Search by OrderID">
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="table-responsive" style="max-height: 450px; overflow-y: auto;">
                    <table class="table table-bordered table-hover text-center align-middle" id="myTable">
                        <thead class="table-dark text-white sticky-top">
                            <tr>
                                <th>#</th>
                                <th>Order ID</th>
                                <th>Name</th>
                                <th>Food</th>
                                <th>Price (₹)</th>
                                <th>Order Date</th>
                                <th>Order Type</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                        <?php
                            $result = getAllOrders();
                            $sl = 1;

                            if (is_object($result)) { 
                                while($order = $result->fetch_assoc()){
                            ?>
                                <tr>
                                    <td><?= $sl++ ?></td>
                                    <td><?= $order['orderID']?></td>
                                    <td><?= getStudentNameByStudentID($order['studentID'])?></td>
                                    <td><?= getFoodNameByFoodId($order['foodID'])?></td>
                                    <td><?= number_format($order['price'], 2)?></td>
                                    <td><?= date('d M Y', strtotime($order['createdAt'])) ?></td>
                                    <td>
                                        <span class="badge bg-<?= strtolower($order['orderType']) === 'dine-in' ? 'success' : 'primary' ?>">
                                            <?= $order['orderType'] ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php
                                            $status = strtolower($order['status']);
                                            $badgeClass = '';

                                            if ($status === 'delivered') {
                                                $badgeClass = 'success';
                                            } elseif ($status === 'cancel') {
                                                $badgeClass = 'danger';
                                            } elseif ($status === 'ready') {
                                                $badgeClass = 'warning';
                                            } else {
                                                $badgeClass = 'secondary';
                                            }
                                        ?>
                                        <span class="badge bg-<?= $badgeClass ?>">
                                            <?= ucfirst($order['status']) ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php 
                                } 
                            } else {
                                echo "<tr><td colspan='9' class='text-center text-danger'>No orders found or error occurred.</td></tr>";
                            }
                            ?>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</section>


<?php include_once "adminFooter.php"; ?>
<script src="../assets/js/orderHistory.js"></script>
