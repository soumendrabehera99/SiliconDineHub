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
        <div class="col-md-6"><!-- Wrapped in col-md-6 for gutter spacing -->
          <div class="p-3 border border-1 rounded-3 bg-white shadow-sm">
              <div class="d-flex justify-content-between align-items-center mb-3"><!-- Flex for inline title and dropdown -->
                  <h5 class="mb-0 fw-bold">Sales Logistic</h5>
                  <div class="mb-3">
                      <select id="daySelector" class="form-select">
                          <option value="6">Last 7 Days</option>
                          <option value="29">Last 30 Days</option>
                          <!-- <option value="59">Last 60 Days</option>
                          <option value="89">Last 90 Days</option> -->
                      </select>
                  </div>
              </div>
              <canvas id="salesChart" width="400" height="200"></canvas>
          </div>
        </div>
        <!-- Today's Best Selling Food -->
        <div class="col-md-3"><!-- Wrapped in col-md-6 for gutter spacing -->
            <div class="p-3 pb-0 border border-1 rounded-3 bg-white shadow-sm">
                <div class="row">
                    <h5 class="col-7 fw-bold">Top Selling Food</h5>
                    <div class="col-5 btn-group mb-3">
                        <select id="daySelectorItems" class="form-select"><!-- Renamed ID to avoid duplication -->
                            <option value="1">Today</option>
                            <option value="6">Last Week</option>
                            <option value="29">Last Month</option>
                        </select>
                    </div>
                </div>
                <ul class="list-unstyled">
                    <!-- Sample list items (unchanged) -->
                    <li class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center">
                            <img src="../assets/images/f2.png" class="rounded-3 me-3 img-fluid" alt="Spaghetti" style="width: 50px; height: 40px;">
                            <div>
                                <div class="fw-semibold">SPAGHETTI</div>
                                <!-- <small>Medium Spicy Spaghetti Italiano</small><br> -->
                            </div>
                        </div>
                        <div class="fw-bold">Rs. 55</div>
                    </li>
                    <li class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center">
                            <img src="../assets/images/f2.png" class="rounded-3 me-3 img-fluid" alt="Spaghetti" style="width: 50px; height: 40px;">
                            <div>
                                <div class="fw-semibold">SPAGHETTI</div>
                                <!-- <small>Medium Spicy Spaghetti Italiano</small><br> -->
                            </div>
                        </div>
                        <div class="fw-bold">Rs. 55</div>
                    </li>
                    <li class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center">
                            <img src="../assets/images/f2.png" class="rounded-3 me-3 img-fluid" alt="Spaghetti" style="width: 50px; height: 40px;">
                            <div>
                                <div class="fw-semibold">SPAGHETTI</div>
                                <!-- <small>Medium Spicy Spaghetti Italiano</small><br> -->
                            </div>
                        </div>
                        <div class="fw-bold">Rs. 55</div>
                    </li>
                    <li class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center">
                            <img src="../assets/images/f2.png" class="rounded-3 me-3 img-fluid" alt="Spaghetti" style="width: 50px; height: 40px;">
                            <div>
                                <div class="fw-semibold">SPAGHETTI</div>
                                <!-- <small>Medium Spicy Spaghetti Italiano</small><br> -->
                            </div>
                        </div>
                        <div class="fw-bold">Rs. 55</div>
                    </li>
                    <li class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center">
                            <img src="../assets/images/f2.png" class="rounded-3 me-3 img-fluid" alt="Spaghetti" style="width: 50px; height: 40px;">
                            <div>
                                <div class="fw-semibold">SPAGHETTI</div>
                                <!-- <small>Medium Spicy Spaghetti Italiano</small><br> -->
                            </div>
                        </div>
                        <div class="fw-bold">Rs. 55</div>
                    </li>
                    <!-- Repeat your other items here -->
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const orderData = [
  { createdAt: '2025-01-15', price: 150.75 }, // Dummy data
  { createdAt: '2025-02-20', price: 125.50 }, // Dummy data
  { createdAt: '2025-03-05', price: 210.90 }, // Dummy data
  { createdAt: '2025-03-18', price: 320.40 }, // Dummy data
  { createdAt: '2025-04-01', price: 180.99 }, // Dummy data
  { createdAt: '2025-04-15', price: 99.80 },  // Dummy data
  { createdAt: '2025-05-10', price: 250.60 }, // Dummy data
  { createdAt: '2025-05-15', price: 200.25 }, // Dummy data
  { createdAt: '2025-05-20', price: 315.40 }, // Dummy data
  { createdAt: '2025-01-01', price: 110.50 }, // Dummy data
  { createdAt: '2025-01-02', price: 175.25 }, // Dummy data
  { createdAt: '2025-01-03', price: 200.75 }, // Dummy data
  { createdAt: '2025-01-04', price: 105.60 }, // Dummy data
  { createdAt: '2025-01-05', price: 260.30 }, // Dummy data
  { createdAt: '2025-01-06', price: 140.90 }, // Dummy data
  { createdAt: '2025-01-07', price: 315.10 }, // Dummy data
  { createdAt: '2025-01-08', price: 222.50 }, // Dummy data
  { createdAt: '2025-01-09', price: 190.40 }, // Dummy data
  { createdAt: '2025-01-10', price: 134.60 }, // Dummy data
  { createdAt: '2025-01-11', price: 225.75 }, // Dummy data
  { createdAt: '2025-01-12', price: 185.90 }, // Dummy data
  { createdAt: '2025-01-13', price: 155.25 }, // Dummy data
  { createdAt: '2025-01-14', price: 280.60 }, // Dummy data
  { createdAt: '2025-02-01', price: 200.10 }, // Dummy data
  { createdAt: '2025-02-02', price: 110.45 }, // Dummy data
  { createdAt: '2025-02-03', price: 195.60 }, // Dummy data
  { createdAt: '2025-02-04', price: 310.35 }, // Dummy data
  { createdAt: '2025-02-05', price: 150.75 }, // Dummy data
  { createdAt: '2025-02-06', price: 180.85 }, // Dummy data
  { createdAt: '2025-02-07', price: 215.25 }, // Dummy data
  { createdAt: '2025-02-08', price: 310.70 }, // Dummy data
  { createdAt: '2025-02-09', price: 175.90 }, // Dummy data
  { createdAt: '2025-02-10', price: 230.15 }, // Dummy data
  { createdAt: '2025-02-11', price: 155.60 }, // Dummy data
  { createdAt: '2025-02-12', price: 190.25 }, // Dummy data
  { createdAt: '2025-02-13', price: 200.85 }, // Dummy data
  { createdAt: '2025-02-14', price: 260.45 }, // Dummy data
  { createdAt: '2025-02-15', price: 185.75 }, // Dummy data
  { createdAt: '2025-02-16', price: 240.90 }, // Dummy data
  { createdAt: '2025-02-17', price: 145.25 }, // Dummy data
  { createdAt: '2025-02-18', price: 210.40 }, // Dummy data
  { createdAt: '2025-02-19', price: 235.10 }, // Dummy data
  { createdAt: '2025-02-20', price: 175.50 }, // Dummy data
  { createdAt: '2025-03-01', price: 190.15 }, // Dummy data
  { createdAt: '2025-03-02', price: 220.75 }, // Dummy data
  { createdAt: '2025-03-03', price: 180.10 }, // Dummy data
  { createdAt: '2025-03-04', price: 275.40 }, // Dummy data
  { createdAt: '2025-03-05', price: 295.25 }, // Dummy data
  { createdAt: '2025-03-06', price: 150.80 }, // Dummy data
  { createdAt: '2025-03-07', price: 205.30 }, // Dummy data
  { createdAt: '2025-03-08', price: 140.60 }, // Dummy data
  { createdAt: '2025-03-09', price: 210.75 }, // Dummy data
  { createdAt: '2025-03-10', price: 275.50 }, // Dummy data
  { createdAt: '2025-03-11', price: 320.80 }, // Dummy data
  { createdAt: '2025-03-12', price: 180.90 }, // Dummy data
  { createdAt: '2025-03-13', price: 135.10 }, // Dummy data
  { createdAt: '2025-03-14', price: 250.45 }, // Dummy data
  { createdAt: '2025-03-15', price: 300.25 }, // Dummy data
  { createdAt: '2025-03-16', price: 220.50 }, // Dummy data
  { createdAt: '2025-03-17', price: 150.60 }, // Dummy data
  { createdAt: '2025-03-18', price: 320.40 }, // Dummy data
  { createdAt: '2025-03-19', price: 275.80 }, // Dummy data
  { createdAt: '2025-03-20', price: 225.70 }, // Dummy data
  { createdAt: '2025-03-21', price: 195.60 }, // Dummy data
  { createdAt: '2025-03-22', price: 180.25 }, // Dummy data
  { createdAt: '2025-03-23', price: 250.55 }, // Dummy data
  { createdAt: '2025-03-24', price: 315.90 }, // Dummy data
  { createdAt: '2025-03-25', price: 275.10 }, // Dummy data
  { createdAt: '2025-03-26', price: 225.30 }, // Dummy data
  { createdAt: '2025-03-27', price: 195.75 }, // Dummy data
  { createdAt: '2025-03-28', price: 205.90 }, // Dummy data
  { createdAt: '2025-03-29', price: 250.40 }, // Dummy data
  { createdAt: '2025-03-30', price: 270.60 }, // Dummy data
  { createdAt: '2025-04-01', price: 180.99 }, // Dummy data
  { createdAt: '2025-04-02', price: 135.60 }, // Dummy data
  { createdAt: '2025-04-03', price: 190.85 }, // Dummy data
  { createdAt: '2025-04-04', price: 200.75 }, // Dummy data
  { createdAt: '2025-04-05', price: 230.10 }, // Dummy data
  { createdAt: '2025-04-06', price: 250.45 }, // Dummy data
  { createdAt: '2025-04-07', price: 185.60 }, // Dummy data
  { createdAt: '2025-04-08', price: 220.75 }, // Dummy data
  { createdAt: '2025-04-09', price: 230.60 }, // Dummy data
  { createdAt: '2025-04-10', price: 250.75 }, // Dummy data
  { createdAt: '2025-04-11', price: 71.51 },
  { createdAt: '2025-04-12', price: 210.45 }, // Dummy data
  { createdAt: '2025-04-13', price: 220.80 }, // Dummy data
  { createdAt: '2025-04-14', price: 180.90 }, // Dummy data
  { createdAt: '2025-04-15', price: 99.80 },  // Dummy data
  { createdAt: '2025-04-16', price: 290.10 }, // Dummy data
  { createdAt: '2025-04-17', price: 210.50 }, // Dummy data
  { createdAt: '2025-04-18', price: 185.60 }, // Dummy data
  { createdAt: '2025-04-19', price: 220.75 }, // Dummy data
  { createdAt: '2025-04-20', price: 180.75 }, // Dummy data
  { createdAt: '2025-05-01', price: 250.25 }, // Dummy data
  { createdAt: '2025-05-02', price: 315.40 }, // Dummy data
  { createdAt: '2025-05-03', price: 280.30 }, // Dummy data
  { createdAt: '2025-05-04', price: 200.25 }, // Dummy data
  { createdAt: '2025-05-05', price: 225.10 }, // Dummy data
  { createdAt: '2025-05-06', price: 315.90 }, // Dummy data
  { createdAt: '2025-05-07', price: 250.55 }, // Dummy data
  { createdAt: '2025-05-08', price: 230.75 }, // Dummy data
  { createdAt: '2025-05-09', price: 185.90 }, // Dummy data
  { createdAt: '2025-05-10', price: 250.60 }, // Dummy data
  { createdAt: '2025-05-11', price: 220.80 }, // Dummy data
  { createdAt: '2025-05-12', price: 245.25 }, // Dummy data
  { createdAt: '2025-05-13', price: 180.15 }, // Dummy data
  { createdAt: '2025-05-14', price: 255.10 }, // Dummy data
  { createdAt: '2025-05-15', price: 200.25 }, // Dummy data
  { createdAt: '2025-05-16', price: 300.10 }, // Dummy data
  { createdAt: '2025-05-17', price: 250.60 }, // Dummy data
  { createdAt: '2025-05-18', price: 220.30 }, // Dummy data
  { createdAt: '2025-05-19', price: 210.45 }, // Dummy data
  { createdAt: '2025-05-20', price: 315.40 }, // Dummy data
];

// Helper function to filter data by days
function getFilteredData(days) {
    const endDate = new Date();
    const startDate = new Date();
    startDate.setDate(endDate.getDate() - days);
    
    return orderData.filter(order => {
        const orderDate = new Date(order.createdAt);
        return orderDate >= startDate && orderDate <= endDate;
    });
}

// Function to render the chart
function renderChart(days) {
    const filteredData = getFilteredData(days);
    
    // Format data for chart
    const dates = filteredData.map(order => {
        const orderDate = new Date(order.createdAt);
        return orderDate.toLocaleDateString(); // Format the date as MM/DD/YYYY
    });
    const sales = filteredData.map(order => parseFloat(order.price));

    const ctx = document.getElementById('salesChart').getContext('2d');
    
    // Clear previous chart if it exists
    if (window.myChart) {
        window.myChart.destroy();
    }
    
    // Create a new chart
    window.myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: dates,
            datasets: [{
                label: 'Sales',
                data: sales,
                borderColor: 'rgba(75, 192, 192, 1)',
                fill: false,
            }]
        },
        options: {
            scales: {
                x: {
                    type: 'category',
                    title: {
                        display: true,
                        text: 'Date'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Sales ($)'
                    }
                }
            }
        }
    });
}

// Function to render the chart
// function renderChart(days) {
//     const filteredData = getFilteredData(days);

//     // Format data for chart
//     const dates = filteredData.map(order => {
//         const orderDate = new Date(order.createdAt);
//         return orderDate.toLocaleDateString(); // Format the date as MM/DD/YYYY
//     });

//     const sales = filteredData.map(order => parseFloat(order.price));

//     const ctx = document.getElementById('salesChart').getContext('2d');

//     // Clear previous chart if it exists
//     if (window.myChart) {
//         window.myChart.destroy();
//     }

//     // Create a new Bar Chart (changed from line to bar)
//     window.myChart = new Chart(ctx, {
//         type: 'bar', // <-- Changed this from 'line' to 'bar'
//         data: {
//             labels: dates,
//             datasets: [{
//                 label: 'Sales',
//                 data: sales,
//                 backgroundColor: 'rgba(75, 192, 192, 0.5)', // Bar color
//                 borderColor: 'rgba(75, 192, 192, 1)',
//                 borderWidth: 1
//             }]
//         },
//         options: {
//             scales: {
//                 x: {
//                     title: {
//                         display: true,
//                         text: 'Date'
//                     }
//                 },
//                 y: {
//                     beginAtZero: true,
//                     title: {
//                         display: true,
//                         text: 'Sales ($)'
//                     }
//                 }
//             }
//         }
//     });
// }


// Event listener for the dropdown change
document.getElementById('daySelector').addEventListener('change', function () {
    const selectedDays = parseInt(this.value);
    renderChart(selectedDays);
});

// Initialize chart with default data (Last 7 Days)
renderChart(6);


</script>