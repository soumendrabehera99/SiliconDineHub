<?php
include_once "./fragment/navbar.php";
?>
<section class=" mt-3 mb-5">
    <div class="ms-5">
        <a href="javascript:history.back()" class="text-dark text-decoration-none fs-2">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
    <div class="containe p-5">
        <div class="row">
            <div class="col-md-5 text-center p-5">
                <img src="./assets/images/f2.png" class="img-fluid rounded shadow-sm">
            </div>
            <div class="col-md-7 food-details">
                <h3 class="fw-bold text-start foodName"></h3>
                <p class="fs-5 mt-3 foodPrice"></p>
                <button class="btn btn-outline-success px-4 py-2 my-2">ADD</button>
                <p class="fs-4 fw-bold mt-2">Details</p>
                <p class="text-muted fs-5 foodDetails"></p>
            </div>
        </div>
    </div>
</section>
<?php
include_once "./fragment/footer.php";
?>