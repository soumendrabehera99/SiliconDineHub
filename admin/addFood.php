<?php include_once "adminNavbar.php";?>
<!-- Main Content -->
<div class="content w-100">
    <div class="row">
        <div class="col">
            <span class="text-dark fs-5">Food > <span class="text-secondary">Add Food</span></span>
        </div>
    </div>
    <div class="row">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6 border p-4 shadow-sm rounded">
                    <form action="" method="post">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="foodName" class="form-label">Food Name</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="categoryName" placeholder="Enter category name" value="Sandwich"/>
                            </div>
                            <div class="col-md-6">
                                <label for="foodCategory" class="form-label">Category Name</label>
                            </div>
                            <div class="col-md-6 mt-1">
                                <select class="form-select" id="status">
                                    <option selected>--SELECT--</option>
                                    <option value="available">South</option>
                                    <option value="not-available">Chinese</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="foodDescription" class="form-label">Description</label>
                            </div>
                            <div class="col-md-6">
                                <textarea id="foodDescription" value="Add description about food" class="form-control my-1"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="foodPrice" class="form-label">price</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="foodPrice" placeholder="Enter Food Price"/>
                            </div>
                            <div class="col-md-6">
                                <label for="status" class="form-label">Status</label>
                            </div>
                            <div class="col-md-6 mt-1">
                                <select class="form-select" id="status">
                                    <option selected>--SELECT--</option>
                                    <option value="available">Available</option>
                                    <option value="not-available">Not Available</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="submit" value="ADD" class="btn btn-submit btn-success w-50 align-items-center">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once "adminFooter.php";?>