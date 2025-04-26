<?php 
include_once "adminNavbar.php";
require_once "../dbFunctions/studentdb.php";
require_once "../dbFunctions/fooddb.php";
require_once "../dbFunctions/orderHistorydb.php";
?>
<!-- Main Content -->
<section class="content w-100">
    <div class="row mt-3 ms-1 me-1">
        <h2 class="mb-4">Report</h2>
        <!-- order details -->
        <div class="col-12 bg-white border shadow-sm rounded p-3">
            <div class="mb-1">
                <div class="d-flex align-items-center gap-5 flex-wrap">
                    <div>
                        <label class="form-label mb-1">From Date:</label>
                        <input type="date" class="form-control" id="fromDate">
                    </div>
                    <div>
                        <label class="form-label mb-1">To Date:</label>
                        <input type="date" class="form-control" id="toDate">
                    </div>
                </div>
            </div>

            <!-- Generate button -->
            <div class="text-end mb-3">
                <button class="btn btn-primary" id="generateBtn">Generate Bill</button>
            </div>
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
            <h5>Student Bill Report</h5>
            <div class="table-responsive mt-3">
                <table class="table table-bordered table-hover text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>SIC</th>
                            <th>Name</th>
                            <th>Total Amount (₹)</th>
                        </tr>
                    </thead>
                    <tbody id="studentBillTableBody">
                        <!-- AJAX result will be injected here -->
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</section>

<?php include_once "adminFooter.php";?>
<script src="../assets/js/billing.js"></script>

<!-- <script>
    const periodRadio = document.getElementById("periodRadio");
    const periodFields = document.getElementById("periodFields");
    const generateBtn = document.getElementById("generateBtn");

    periodRadio.addEventListener("change", function () {
        if (periodRadio.checked) {
            periodFields.style.display = "block";
            generateBtn.disabled = false;
        }
    });
</script> -->
