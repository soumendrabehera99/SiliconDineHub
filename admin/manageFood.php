<?php include_once "adminNavbar.php";

<!-- Main Content -->
<section class="content w-100">

    <div class="row mt-3 ms-1 me-1">
        <h2>Manage Food</h2>
        <div class="col-12 border p-4 shadow-sm rounded">
            <div class="col-md-12">
                <div class="d-flex justify-content-end mb-2">
                    <div class="d-flex align-items-center gap-1">
                        <input type="text" class="form-control d-inline-block w-auto" id="searchFoodInput" placeholder="Search Category">
                        <!-- <input type="submit" value="Search" class="btn btn-success search-btn" id="foodSearchBtn"> -->
                        <button type="submit" class="btn btn-success d-flex align-items-center gap-1 search-btn" id="foodSearchBtn">
                            <i class="fas fa-search"></i> Search
                        </button>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-responsive">
                <thead class="table-light">
                    <tr>
                        <th>SL No.</th>
                        <th>Food name</th>
                        <th>Categories Name</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Update Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="foodTableBody"></tbody>
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
                    <input type="hidden" id="deleteFoodId" name="FoodId" value="">
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