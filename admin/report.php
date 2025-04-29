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

            <!-- Generate and Export buttons -->
            <div class="text-end mb-3">
                <button class="btn btn-primary" id="generateBtn">Generate Bill</button>
                <button class="btn btn-success ms-2" id="exportBtn" style="display:none;">Export to Excel</button>
            </div>

            <!-- Search and Total Records -->
            <div class="row align-items-center mb-3">
                <div class="col-md-6 fw-semibold">
                    <!-- Total No. of Records: <?= totalOrder(); ?> -->
                    <h5>Student Bill Report</h5>
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
            <div class="table-responsive mt-3">
                <div class="table-body-wrapper">
                    <table class="table table-bordered table-hover text-center mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>SIC</th>
                                <th>Name</th>
                                <th>Total Amount (₹)</th>
                            </tr>
                        </thead>
                        <tbody id="studentBillTableBody">
                            <!-- Filled dynamically -->
                        </tbody>
                    </table>
                </div>
            </div>


            
            
        </div>
    </div>
</section>
<style>
    .table-body-wrapper {
        overflow-y: auto;
        max-height: 400px;
        width: 100%;
    }

    /* Ensure table fits the full width */
    .table-body-wrapper table {
        width: 100%;
        margin-bottom: 0;
        table-layout: fixed; /* Important: force equal width columns */
    }

    /* Sticky header */
    thead th {
        background-color: #343a40;
        color: #fff;
        position: sticky;
        top: 0;
        z-index: 2;
    }

    .table > :not(caption) > * > * {
        padding: 0.75rem 0.5rem;
        vertical-align: middle;
    }

    .table-responsive {
        overflow-x: auto;
    }
    .table-body-wrapper::-webkit-scrollbar {
        width: 8px;
    }
    .table-body-wrapper::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 4px;
    }
    .table-body-wrapper::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>

<?php include_once "adminFooter.php";?>
<script src="../assets/js/billing.js"></script>

