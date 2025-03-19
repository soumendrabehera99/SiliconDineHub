<?php
include_once "./fragment/navbar.php";
?>
<section class="mt-4 mb-5">
    <div class="container mb-2">
        <!-- Back Button -->
        <div class="mb-3">
            <a href="javascript:history.back()" class="text-dark text-decoration-none fs-4">
                <i class="fas fa-arrow-left me-2"></i> Back
            </a>
        </div>

        <!-- Food Details Card -->
        <div class="row align-items-center shadow-md rounded-4 p-4 bg-white">
            <!-- Food Image -->
            <div class="col-md-5 text-center">
                <div class="card border-0 shadow-sm rounded-4 p-3">
                    <img src="./assets/images/f2.png" class="img-fluid rounded-3">
                </div>
            </div>

            <!-- Food Details -->
            <div class="col-md-7 food-details mt-3 mt-md-0">
                <p class="fw-bold text-start foodName fs-2"></p>
                <p class="fs-4 mt-2 text-success foodPrice"></p>
                
                <!-- Add to Cart Button -->
                <button class="btn btn-success px-4 py-2 my-2 shadow-sm">
                    <i class="fas fa-shopping-cart me-2"></i> ADD TO CART
                </button>

                <!-- Details Section -->
                <p class="fs-4 fw-bold mt-3 text-secondary">Details</p>
                <p class="text-muted fs-5 foodDetails"></p>
            </div>
        </div>
    </div>
</section>
<?php
include_once "./fragment/footer.php";
?>
<script src="./assets/js/foodDetails.js"></script>