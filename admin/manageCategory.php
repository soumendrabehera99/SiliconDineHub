<?php
require_once "../dbFunctions/dbConnect.php";
require_once "../dbFunctions/categorydb.php";
?>
<?php include_once "adminNavbar.php";?>
<!-- Main Content -->
<div class="content w-100">
    <div class="row mt-3 ms-1 me-1">
        <h4 class="mb-4">Category</h4>
        <div class="col-12 border p-4 shadow-sm rounded">
            <div class="d-flex justify-content-end">
                <!-- Button trigger modal -->
                <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Add Categories</button>
                <!-- Modal -->
                <div class="modal fade" id="addCategoryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Add category</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="" method="post" id="addCategory">
                                <div class="modal-body">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="categoryName" class="form-label fs-5">Categories Name</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="categoryName" placeholder="Enter category name">
                                        </div>
                                    </div>
                                    <p id="msg" class=""></p>
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" value="ADD" class="btn btn-submit btn-success w-50 align-items-center">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end mb-2">
                <div class="d-flex align-items-center gap-1">
                    <input type="text" class="form-control d-inline-block w-auto" id="searchCategoryInput" placeholder="Search Category">
                    <input type="submit" value="Search" class="btn btn-success search-btn" id="categorySearchBtn">
                </div>
            </div>
            <table class="table table-bordered table-responsive">
                <thead class="table-light">
                    <tr>
                        <th>Sl NO.</th>
                        <th>Categories Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="categoryTableBody"></tbody>
            </table>
            <div class="d-flex justify-content-center align-items-center mt-3">
            <div class="d-flex justify-content-between align-items-center mt-3">
                <span id="pagination-info"></span>
                <nav>
                    <ul class="pagination" id="pagination"></ul>
                </nav>
            </div>
            </div>
        </div>
    </div>
</div>
<!--Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="editCategory">
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="categoryName" class="form-label fs-5">Category Name</label>
                        </div>
                        <div class="col-md-6">
                            <input type="hidden" id="editCategoryId" name="categoryId" value="">
                            <input type="text" class="form-control" id="editCategoryName" placeholder="Enter category name" value="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer" class="d-flex justify-content-end">
                    <input type="button" value="Close" class="btn btn-submit btn-secondary me-auto">
                    <input type="submit" value="Edit" class="btn btn-submit btn-success">
                </div>
            </form>
        </div>
    </div>
</div>
<!--Delete Category modal-->
<div class="modal fade" id="deleteCategoryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Delete Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="deleteCategory">
                <div class="modal-body">
                    <input type="hidden" id="deleteCategoryId" name="categoryId" value="">
                    <p>Are you sure you want to delete <strong id="deleteCategoryName"></strong>?</p>
                </div>
                <div class="modal-footer d-flex justify-content-end">
                    <input type="button" value="Cancel" class="btn btn-submit btn-secondary me-auto">
                    <input type="submit" value="Delete" class="btn btn-submit btn-danger">
                </div>
            </form>
        </div>
    </div>
</div>
<?php include_once "adminFooter.php";?>