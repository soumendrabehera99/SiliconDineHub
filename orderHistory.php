<?php
include_once "./fragment/navbar.php";
?>
<div class="container">
    <div class="mt-2 p-3"><span class="text-start fs-5 fw-bold">Your Orders</span></div>
    <!-- <div class="input-group p-3">
        <input type="search" name="search" id="search" class="form-control">
        <button type="submit" class="btn btn-outline-secondary search-Btn"><i class="fa-solid fa-magnifying-glass"></i></button>
    </div> -->
    <div class="p-3">
        <div><span class="test-start fs-5 fw-bold">Active Orders</span></div>
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
<script src="./assets/js/orderHistoryStudent.js"></script>
