<?php require_once "../dbFunctions/dashboarddb.php";?>
<?php require_once "../dbFunctions/orderHistorydb.php";?>
<!-- Main Content -->
<section class="content w-100 overflow-x-hidden">
    <div class="row mt-0 g-3">
      <a href="./orderHistory.php" class="col-md-3 col-sm-6 text-decoration-none">
          <div
            class="p-4 rounded-1 text-white position-relative"
            style="background: linear-gradient(to right, #4a0d37, #ff0099)"
          >
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
            <i
              class="fas fa-shopping-cart position-absolute bottom-0 end-0 p-3 opacity-25 display-1 fs-sm-1"
            ></i>
          </div>
      </a>

        <div class="col-md-3 col-sm-6">
          <div
            class="p-4 rounded text-white position-relative"
            style="background: linear-gradient(to right, #0a504a, #38ef7d)"
          >
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
              class="fa-solid fa-indian-rupee-sign position-absolute bottom-0 end-0 p-3 opacity-25 display-1 fs-sm-1"
            ></i>
          </div>
        </div>

      <a href="./customerManage.php" class="col-md-3 col-sm-6 text-decoration-none">
        <div
          class="p-4 rounded text-white position-relative"
          style="background: linear-gradient(to right, #373b44, #4286f4)"
        >
          <div class="row align-items-center">
            <div class="col-12">
              <h3 class="mb-2">Active Customer</h3>
              <div class="fs-1 fw-bold mt-3">
                <?php echo totalActiveCustomer()?>
              </div>
            </div>
          </div>
          <i
            class="fa-solid fa-users position-absolute bottom-0 end-0 p-3 opacity-25 display-1 fs-sm-1"
          ></i>
        </div>
      </a>
      
      <a href="./AdminManageOrders.php" class="col-md-3 col-sm-6 text-decoration-none">
        <div
          class="p-4 rounded text-white position-relative"
          style="background: linear-gradient(to right, #a86008, #ffba56)"
        >
          <div class="row align-items-center">
            <div class="col-12">
              <h3 class="mb-2">Manage Orders</h3>
              <div class="fs-1 fw-bold mt-3">
                <?php echo totalNoPendingOrder()?>
              </div>
            </div>
          </div>
          <i
              class="fa-solid fa-box position-absolute bottom-0 end-0 p-3 opacity-25 display-1 fs-sm-1"
          ></i>
        </div>
      </a>
    </div>
</section>

