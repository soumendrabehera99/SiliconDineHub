<?php 
include_once "adminNavbar.php";
?>
<!-- Main Content -->
<section class="content w-100">

    <div class="row mt-3 ms-1 me-1">
        <h2>Manage Food</h2>
        <div class="col-12 border p-4 shadow-sm rounded">
            <div class="row mb-2">
                <div class="col-md-6">
                    <a class="btn btn-success text-center" href="./addFood.php"><i class="fa-solid fa-plus"></i> Add Food</a>
                </div>
                <div class="col-md-6 d-flex align-items-center justify-content-end mb-2 gap-1">
                    <input type="text" class="form-control d-inline-block w-auto" id="searchFoodInput" placeholder="Search Category">
                    <button type="submit" class="btn btn-success text-center search-btn" id="foodSearchBtn">
                        <i class="fas fa-search"></i> Search
                    </button>
                    <button type="submit" class="btn btn-success text-center allFoodBtn" id="allFoodBtn">
                        All Foods
                    </button>
                </div>
            </div>
            <table class="table table-bordered table-responsive">
                <thead class="table-light text-center">
                    <tr class="align-text-top">
                        <th>SL No.</th>
                        <th>Image</th>
                        <th>Food name</th>
                        <th>Categories Name</th>
                        <th>Price</th>
                        <th>
                            Status<br>
                            <p class="mb-0 fw-light ">click on status to update</p>
                        </th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="foodTableBody" class="text-center"></tbody>
            </table>
            <div class="d-flex justify-content-center align-items-center mt-3">
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <span id="pagination-info"></span>
                    <nav>
                        <ul class="pagination" id="foodPagination"></ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</sction>

<!--Delete Category modal-->
<div class="modal fade" id="deleteFoodModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Delete Food</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="deleteFood">
                <div class="modal-body">
                    <input type="hidden" id="deleteFoodId" name="FoodId">
                    <input type="hidden" id="foodImageName" name="foodImageName">
                    <p>Are you sure you want to delete <strong id="deleteFoodName"></strong> ?</p>
                </div>
                <div class="modal-footer d-flex justify-content-end">
                    <input type="submit" value="Delete" class="btn btn-submit btn-danger">
                </div>
            </form>
        </div>
    </div>
</div>
<?php include_once "adminFooter.php";?>
<script src="../assets/js/foodManage.js"></script>
