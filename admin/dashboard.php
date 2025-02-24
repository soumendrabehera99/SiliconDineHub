<?php require_once "../dbFunctions/dashboarddb.php";?>
<!-- Main Content -->
<section class="content w-100">
    <div class="row mt-3">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card l-bg-cherry position-relative">
                <div class="card-statistic-3 p-4">
                    <div class="card-icon card-icon-large text-center position-absolute mt-3 me-2">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                    <div class="text-right position-absolute mt-5" style="margin-left: 10rem;">
                        <p>Dine In- <span><?= totalDineInOrder()?></span></p>
                        <p>Parcel- <span><?= totalParcelOrder()?></span></p>
                    </div>
                    <h5 class="card-title mb-0">Orders</h5><br><br>
                    <h2><?= totalOrder() ?></h2>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card l-bg-blue-dark">
                <div class="card-statistic-3 p-4">
                    <div class="card-icon card-icon-large text-center position-absolute mt-3 me-2">
                        <i class="fa-solid fa-indian-rupee-sign"></i>
                    </div>
                    <h5 class="card-title mb-0">Revenue Today</h5><br><br>
                    <h2>&#8377; <?php echo revenueToday()?></h2>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card l-bg-orange-dark">
                <div class="card-statistic-3 p-4">
                    <div class="card-icon card-icon-large text-center position-absolute mt-3 me-2">
                    <i class="fa-solid fa-users"></i>
                    </div>
                    <h5 class="card-title mb-0">Active Customers</h5><br><br>
                    <h2><?php echo totalActiveCustomer()?></h2>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card l-bg-green-dark">
                <div class="card-statistic-3 p-4">
                    <div class="card-icon card-icon-large text-center position-absolute mt-3 me-2">
                        <i class="fa-solid fa-box"></i>
                    </div>
                    <h5 class="card-title mb-0">Unknown</h5><br><br>
                    <h2>00</h2>
                </div>
            </div>
        </div>
    </div>
</section>

