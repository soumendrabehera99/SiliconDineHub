<?php
include_once "./fragment/navbar.php";
?>
<div class="container">
    <!-- <div class="mt-2 p-3"><span class="text-start fs-5 fw-bold">Your Orders</span></div> -->
    <!-- <div class="input-group p-3">
        <input type="search" name="search" id="search" class="form-control">
        <button type="submit" class="btn btn-outline-secondary search-Btn"><i class="fa-solid fa-magnifying-glass"></i></button>
    </div> -->
    <div class="row p-3">
        <div class="col-6">
            
        </div>
    </div>
    <div class="p-3">
        <div class="row">
            <div class="col-md-8">
                <span class="test-start fs-5 fw-bold">Active Orders</span>
                <!-- Active orders -->
                <div class="mt-2" id="activeOrders">
                    <table class="table table-bordered table-responsive">
                        <thead class="table-warning text-center">
                            <tr>
                                <th>FOOD IMAGE</th>
                                <th>FOOD NAME</th>
                                <th>DATE</th>
                                <th>STATUS</th>
                                <th>PRICE</th>
                            </tr>
                        </thead>
                        <tbody class="text-center"></tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-4 mt-4">
                <div class="card p-3 shadow-sm rounded">
                    <h5 class="fw-bold">Order Statement</h5><br>
    
                    <!-- Main radio selection -->
                    
                    <div class="d-flex align-items-center mb-3">
                        <div class="form-check me-3">
                            <input class="form-check-input" type="radio" name="orderOption" id="orderPeriod" value="period">
                            <label class="form-check-label" for="orderPeriod">Order Period</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="orderOption" id="quickSearch" value="quick">
                            <label class="form-check-label" for="quickSearch">Quick Search</label>
                        </div>
                    </div>
    
                    <!-- Date selection -->
                    <div id="orderPeriodFields" class="mb-3" style="display:none;">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <label>From Date:</label>
                                <input type="date" id="fromDate" class="form-control">
                            </div>
                            <div>
                                <label>To Date:</label>
                                <input type="date" id="toDate" class="form-control">
                            </div>
                        </div>
                    </div>
    
                    <!-- Quick search radio -->
                    <div id="quickSearchFields" class="mb-3" style="display:none;">
                        <div class="d-flex align-items-center">
                            <div class="form-check me-3">
                                <input class="form-check-input" type="radio" name="quickOption" id="lastMonth" value="lastMonth">
                                <label class="form-check-label" for="lastMonth">Last Month</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="quickOption" id="lastWeek" value="lastWeek">
                                <label class="form-check-label" for="lastWeek">Last Week</label>
                            </div>
                        </div>
                    </div>
    
                    <!-- Download button -->
                    <button id="downloadBtn" class="btn btn-primary mt-3" style="display:none;">Download</button>
                </div>
            </div>
        </div>
    </div>
    <div class="p-3">
        <div><span class="test-start fs-5 fw-bold">Previous Orders</span></div>
        <div class="mt-2" id="previousOrder">
            <table class="table table-bordered table-responsive">
                <thead class="table-warning text-center">
                    <tr>
                        <th>FOOD IMAGE</th>
                        <th>FOOD NAME</th>
                        <th>DATE</th>
                        <th>STATUS</th>
                        <th>PRICE</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
<?php
include_once "fragment/footer.php";
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="./assets/js/orderHistoryStudent.js"></script>
