<?php include_once "adminNavbar.php";?>
<!-- Main Content -->
<div class="content w-100">
    <div class="row">
        <h2 class="mb-1">Add Food</h2>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 border p-4 shadow-sm rounded">
                    <form action="" method="post" id="addFood" enctype="multipart/form-data">
                        <div class="row mb-1">
                            <div>
                                <label for="foodName" class="form-label">Food Name</label>
                                <input type="text" class="form-control" id="foodName" placeholder="Enter Food name"/>
                            </div>
                            <div>
                                <label for="categoryName" class="form-label">Category Name</label>
                                <select class="form-select" id="categoryName">
                                </select>
                            </div>
                            <div class="mt-2">
                                <label for="foodImage" class="form-label">Image</label>
                                <input type="file" name="image" class="form-control" accept="image/*" id="foodImage">
                            </div>
                            <div>
                                <label for="foodDescription" class="form-label">Description</label>
                                <textarea id="foodDescription" value="Add description about food" class="form-control my-1"></textarea>
                            </div>
                            <div>
                                <label for="foodPrice" class="form-label">price</label>
                                <input type="text" class="form-control" id="foodPrice" placeholder="Enter Food Price"/>
                            </div>
                            <div>
                                <label for="foodStatus" class="form-label">Status</label>
                                <select class="form-select" id="foodStatus">
                                    <option selected>--SELECT--</option>
                                    <option value="available">Available</option>
                                    <option value="not-available">Not Available</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-end">
                                <input type="submit" value="ADD" class="btn btn-submit btn-success">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once "adminFooter.php";?>