<?php
require_once "../dbFunctions/dbConnect.php";
require_once "../dbFunctions/categorydb.php";
?>
<?php include_once "adminNavbar.php";?>
<!-- Main Content -->
<div class="content w-100">
    <div class="row mt-3 ms-1 me-1">
        <div class="col-12 border p-4 shadow-sm rounded">
            <div class="d-flex justify-content-between">
                Category
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
                                            <input type="text" class="form-control" id="categoryName" placeholder="Enter category name" value="Nashta"/>
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
            <div class="d-flex justify-content-between mb-2">
                <div>
                Show 
                    <select class="form-select d-inline-block w-auto">
                        <option>10</option>
                        <option>25</option>
                        <option>50</option>
                        <option>100</option>
                    </select>
                    entries
                </div>
                <div>
                    Search: <input type="text" class="form-control d-inline-block w-auto">
                </div>
            </div>
            <table class="table table-bordered table-responsive">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Categories Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Sweet</td>
                        <td>
                            <button aria-label="Search" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editCategory"><i class="fa-solid fa-edit"></i></button>
                            <button aria-label="Search" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteCategory"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!--Edit Category Modal -->
<div class="modal fade" id="editCategory" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="categoryName" class="form-label fs-5">Category Name</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="categoryName" placeholder="Enter category name" value="Nashta"/>
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
<div class="modal fade" id="deleteCategory" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Delete Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <p>Are you sure you want to delete <strong id="deleteCategoryName"></strong>?</p>
                </div>
            </form>
            <div class="modal-footer d-flex justify-content-end">
                <input type="button" value="Cancel" class="btn btn-submit btn-secondary me-auto">
                <input type="submit" value="Delete" class="btn btn-submit btn-danger">
            </div>
        </div>
    </div>
</div>
<?php include_once "adminFooter.php";?>