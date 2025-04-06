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
                    <p class="mb-0" id="taxTotalPrice">₹480</p>
                </div>
            </div>
            <div class="text-end mt-3">
                <a id="checkoutBtn" class="btn btn-warning w-25 p-2 mt-4"><i class="fa fa-shopping-cart"></i> Check Out</a>
            </div>
        </div>  
    </div>
</section>
<div class="modal fade" id="checkoutModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Check-Out Summary</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4">
                <table class="table text-start text-center">
                    <thead class="table-light">
                        <tr>
                            <th>Food Name</th>
                            <th>Unit Price</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody id="checkoutItems">
                    </tbody>
                    <!-- <tfoot>
                        <tr class="fw-bold">
                            <td >Total Price</td>
                            <td id="totalAmount" colspan="3" class="text-end"></td>
                        </tr>
                    </tfoot> -->
                </table>
                <hr>

                <div class="row px-2 fw-bold">
                    <div class="col-6">Total Price</div>
                    <div class="col-3"></div>
                    <div class="col-3 text-end" id="totalAmount">₹800</div>
                </div>


                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Back</button>
                    <button type="button" class="btn btn-success"><i class="fa-solid fa-arrow-right-from-bracket"></i> Place Order</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once "./fragment/footer.php";?>
<script src="./assets/js/cart.js"></script>
