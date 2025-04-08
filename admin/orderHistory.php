<?php 
include_once "adminNavbar.php"; 
require_once "../dbFunctions/studentdb.php";
require_once "../dbFunctions/fooddb.php";
require_once "../dbFunctions/orderHistorydb.php";
?>
<!-- Main Content -->
<!-- <section class="content w-100">
    <div class="row mt-3 ms-1 me-1">
        <h2 class="mb-4">Order History</h2>

        <div class="col-md-12 border border-2 pt-1 shadow-sm rounded">
            <div class="row">
                <div class="col-md-6 mb-3 mt-2 text-start">
                    <a class="btn btn-success text-center" href="./customerAdd.php"><i class="fa-solid fa-plus"></i> Add Records</a>
                </div>
                <div class="col-md-6 mb-3 mt-2 text-md-end">
                    <div class="d-flex justify-content-md-end align-items-center gap-2">
                        <label for="searchInput" style="font-weight: 500;">Search:</label>
                        <div style="position: relative;">
                            <i class="fas fa-search" style="
                                position: absolute;
                                top: 50%;
                                left: 10px;
                                transform: translateY(-50%);
                                color: #888;
                            "></i>
                            <input type="text" 
                                id="searchInput" 
                                class="form-control" 
                                placeholder="Search by OrderID or SIC"
                                style="
                                    padding-left: 30px;
                                    border: 1px solid #ccc;
                                    height: 38px;
                                    width: 250px;
                                ">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row ms-1">
                Total No. records: <?php echo totalOrder();?>
            </div>

            <div class="d-flex justify-content-between mt-1">
                <div style="max-height: 450px; overflow-y: auto; width: 100%;" class="mb-2">
                    <table class="table table-bordered table-responsive text-center" id="myTable">
                        <thead class="table-light">
                            <tr class="align-text-top">
                                <th>OrderID</th>
                                <th>Name</th>
                                <th>SIC</th>
                                <th>Food</th>
                                <th>Price</th>
                                <th>Order Type</th>
                                <th>Order Date</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <?php
                                $result = getAllOrders();
                                while($order = $result->fetch_assoc()){
                                    ?>
                                    <tr>
                                        <td><?= $order['orderID']?></td>
                                        <td><?= getStudentNameByStudentID($order['studentID'])?></td>
                                        <td><?= getStudentSicByStudentID($order['studentID'])?></td>
                                        <td><?= getFoodNameByFoodId($order['foodID'])?></td>
                                        <td><?= $order['price']?></td>
                                        <td><?= $order['orderType']?></td>
                                        <td><?= date('d F Y', strtotime($order['createdAt'])) ?></td>
                                    </tr>
                                    <?php 
                                }
                            ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</section> -->

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
                                   placeholder="Search by OrderID or SIC">
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="table-responsive" style="max-height: 450px; overflow-y: auto;">
                    <table class="table table-bordered table-hover text-center align-middle" id="myTable">
                        <thead class="table-dark text-white sticky-top">
                            <tr>
                                <th>Order ID</th>
                                <th>Name</th>
                                <th>SIC</th>
                                <th>Food</th>
                                <th>Price (₹)</th>
                                <th>Order Date</th>
                                <th>Order Type</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <?php
                                $result = getAllOrders();
                                while($order = $result->fetch_assoc()){
                            ?>
                                <tr>
                                    <td><?= $order['orderID']?></td>
                                    <td><?= getStudentNameByStudentID($order['studentID'])?></td>
                                    <td><?= getStudentSicByStudentID($order['studentID'])?></td>
                                    <td><?= getFoodNameByFoodId($order['foodID'])?></td>
                                    <td><?= number_format($order['price'], 2)?></td>
                                    <td><?= date('d M Y', strtotime($order['createdAt'])) ?></td>
                                    <td>
                                        <span class="badge bg-<?= strtolower($order['orderType']) === 'dine-in' ? 'success' : 'primary' ?>">
                                            <?= $order['orderType'] ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</section>


<?php include_once "adminFooter.php"; ?>
<script src="../assets/js/orderHistory.js"></script>
