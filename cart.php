<?php include_once "./fragment/navbar.php"; ?>
<section class="container mt-4 mb-5 p-4">
    <div class="row g-5">
        <div class="col-md-6" id="cart"></div>

        <div class="col-md-6 mx-auto">
            <div class="border mt-2 p-3 rounded shadow-sm bg-white">
                <h5 class="text-muted">PRICE DETAILS</h5>
                <hr>
                <div class="d-flex justify-content-between">
                    <p class="mb-1" id="totalItems">Price (8 items)</p>
                    <p class="mb-1" id="totalPrice">₹480</p>
                </div>
                <div class="d-flex justify-content-between">
                    <p class="mb-1">Coupons for you</p>
                    <p class="mb-1 text-success">− ₹0</p>
                </div>
                <div class="d-flex justify-content-between">
                    <p class="mb-1">Parcel Charges</p>
                    <p class="mb-1">
                        <span class="text-decoration-line-through text-secondary">₹40</span>
                        <span class="text-success"> Free</span>
                    </p>
                </div>
                <hr>
                <div class="d-flex justify-content-between fw-bold">
                    <p class="mb-0">Total Amount</p>
                    <p class="mb-0">₹480</p>
                </div>
            </div>
            <div class="text-end mt-3">
                <a class="btn btn-success w-25 p-2 mt-4"><i class="fa fa-shopping-cart"></i> Check Out</a>
            </div>
        </div>  
    </div>
</section>
<?php include_once "./fragment/footer.php";?>
<script src="./assets/js/cart.js"></script>
