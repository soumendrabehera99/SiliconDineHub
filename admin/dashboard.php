<?php require_once "../dbFunctions/dashboarddb.php";?>
<?php require_once "../dbFunctions/orderHistorydb.php";?>
<!-- Main Content -->
<section class="content w-100 overflow-x-hidden">
    <div class="row mt-0 g-3">
        <a href="./orderHistory.php" class="col-md-3 col-sm-6 text-decoration-none">
            <div class="p-4 rounded-1 text-white position-relative"
                style="background: linear-gradient(to right, #4a0d37, #ff0099)">
                <div class="row align-items-center">
                    <div class="col-6">
                        <h3 class="mb-2">Order</h3>
                        <div class="fs-1 fw-bold mt-3"><?= totalOrderOfToday();?></div>
                    </div>
                    <div class="col-6 text-end">
                        <p class="mb-1">
                            Dine In - <span><?= totalDineInOrder()?></span>
                        </p>
                        <p class="mb-0">
                            Parcel -
                            <?= totalParcelOrder()?>
                        </p>
                    </div>
                </div>
                <i class="fas fa-shopping-cart position-absolute bottom-0 end-0 p-3 opacity-25 display-1 fs-sm-1"></i>
            </div>
        </a>

        <div class="col-md-3 col-sm-6">
            <div class="p-4 rounded text-white position-relative"
                style="background: linear-gradient(to right, #0a504a, #38ef7d)">
                <div class="row align-items-center">
                    <div class="col-12">
                        <h3 class="mb-2">Revenue Today</h3>
                        <div class="fs-1 fw-bold mt-3">
                            &#8377;
                            <?php echo revenueToday()?:0 ?>
                        </div>
                    </div>
                </div>
                <i
                    class="fa-solid fa-indian-rupee-sign position-absolute bottom-0 end-0 p-3 opacity-25 display-1 fs-sm-1"></i>
            </div>
        </div>

        <a href="./customerManage.php" class="col-md-3 col-sm-6 text-decoration-none">
            <div class="p-4 rounded text-white position-relative"
                style="background: linear-gradient(to right, #373b44, #4286f4)">
                <div class="row align-items-center">
                    <div class="col-12">
                        <h3 class="mb-2">Active Customer</h3>
                        <div class="fs-1 fw-bold mt-3">
                            <?php echo totalActiveCustomer()?>
                        </div>
                    </div>
                </div>
                <i class="fa-solid fa-users position-absolute bottom-0 end-0 p-3 opacity-25 display-1 fs-sm-1"></i>
            </div>
        </a>

        <a href="./AdminManageOrders.php" class="col-md-3 col-sm-6 text-decoration-none">
            <div class="p-4 rounded text-white position-relative"
                style="background: linear-gradient(to right, #a86008, #ffba56)">
                <div class="row align-items-center">
                    <div class="col-12">
                        <h3 class="mb-2">Manage Orders</h3>
                        <div class="fs-1 fw-bold mt-3">
                            <?php echo totalNoPendingOrder()?>
                        </div>
                    </div>
                </div>
                <i class="fa-solid fa-box position-absolute bottom-0 end-0 p-3 opacity-25 display-1 fs-sm-1"></i>
            </div>
        </a>

    </div>
    <div class="row g-3 mt-3 mx-0">
        <!-- Sales Logistic -->
        <div class="col-md-6">
            <div class="p-3 border border-1 rounded-3 bg-white shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0 fw-bold">Sales Logistic</h5>
                    <div class="mb-3">
                        <select id="daySelector" class="form-select">
                            <option value="6">Last 7 Days</option>
                            <option value="29">Last 30 Days</option>
                            <option value="59">Last 60 Days</option>
                            <option value="89">Last 90 Days</option>
                        </select>
                    </div>
                </div>

                <!-- Spinner -->
                <div id="loadingSpinner" class="text-center my-3" style="display: none;">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2">Loading data...</p>
                </div>

                <!-- Canvas Chart -->
                <canvas id="salesChart" width="400" height="200"></canvas>

                <!-- No Data Message -->
                <div id="noDataMessage" class="text-center text-danger my-3" style="display: none;">
                    <p>No Data Found for Selected Range.</p>
                </div>
            </div>
        </div>

        <!-- Today's Best Selling Food -->
        <div class="col-md-3">
            <div class="p-3 pb-0 border border-1 rounded-3 bg-white shadow-sm">
                <div class="row">
                    <h5 class="col-6 fw-bold">Top Selling Food</h5>
                    <div class="col-6 btn-group mb-3">
                        <select id="weekSelectorItems" class="form-select">
                            <option value="1">Today</option>
                            <option value="6">Last Week</option>
                            <option value="29">Last Month</option>
                        </select>
                    </div>
                </div>
                <ul class="list-unstyled" id="topSellingList">
                    <li class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center">
                            <img src="../assets/images/f2.png" class="rounded-3 me-3 img-fluid" alt="Spaghetti" style="width: 50px; height: 40px;">
                            <div>
                                <div class="fw-semibold">Burger</div>
                                <!-- <small>Medium Spicy Spaghetti Italiano</small><br> -->
                            </div>
                        </div>
                        <div class="fw-bold">Rs. 55</div>
                    </li>
                    <li class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center">
                            <img src="../assets/images/f2.png" class="rounded-3 me-3 img-fluid" alt="Spaghetti" style="width: 50px; height: 40px;">
                            <div>
                                <div class="fw-semibold">Burger</div>
                                <!-- <small>Medium Spicy Spaghetti Italiano</small><br> -->
                            </div>
                        </div>
                        <div class="fw-bold">Rs. 55</div>
                    </li>
                    <li class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center">
                            <img src="../assets/images/f2.png" class="rounded-3 me-3 img-fluid" alt="Spaghetti" style="width: 50px; height: 40px;">
                            <div>
                                <div class="fw-semibold">Burger</div>
                                <!-- <small>Medium Spicy Spaghetti Italiano</small><br> -->
                            </div>
                        </div>
                        <div class="fw-bold">Rs. 55</div>
                    </li>
                    <li class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center">
                            <img src="../assets/images/f2.png" class="rounded-3 me-3 img-fluid" alt="Spaghetti" style="width: 50px; height: 40px;">
                            <div>
                                <div class="fw-semibold">Burger</div>
                                <!-- <small>Medium Spicy Spaghetti Italiano</small><br> -->
                            </div>
                        </div>
                        <div class="fw-bold">Rs. 55</div>
                    </li>
                    <li class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center">
                            <img src="../assets/images/f2.png" class="rounded-3 me-3 img-fluid" alt="Spaghetti" style="width: 50px; height: 40px;">
                            <div>
                                <div class="fw-semibold">Burger</div>
                                <!-- <small>Medium Spicy Spaghetti Italiano</small><br> -->
                            </div>
                        </div>
                        <div class="fw-bold">Rs. 55</div>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Loyal Customers -->
        <div class="col-md-3"><!-- Wrapped in col-md-3 for gutter spacing -->
            <div class="p-3 pb-0 border border-1 rounded-3 bg-white shadow-sm">
                <h5 class="fw-bold mb-3">Loyal Customers</h5>
                <ul class="list-unstyled">
                    <li class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <div class="fw-semibold">John Doe</div>
                            <small class="text-muted">5 Orders | Member since 2022</small>
                        </div>
                        <span class="badge bg-success">VIP</span>
                    </li>
                    <li class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <div class="fw-semibold">Emily Smith</div>
                            <small class="text-muted">3 Orders | Member since 2023</small>
                        </div>
                        <span class="badge bg-warning text-dark">Gold</span>
                    </li>
                    <li class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <div class="fw-semibold">Michael Brown</div>
                            <small class="text-muted">8 Orders | Member since 2021</small>
                        </div>
                        <span class="badge bg-success">VIP</span>
                    </li>
                    <li class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <div class="fw-semibold">Sophia Lee</div>
                            <small class="text-muted">2 Orders | Member since 2024</small>
                        </div>
                        <span class="badge bg-secondary">New</span>
                    </li>
                    <li class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <div class="fw-semibold">David Wilson</div>
                            <small class="text-muted">6 Orders | Member since 2022</small>
                        </div>
                        <span class="badge bg-warning text-dark">Gold</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</section>

<script src="../assets/jquery/jquery-3.7.1.min.js"></script>
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="../assets/js/dashboardAdmin.js"></script>