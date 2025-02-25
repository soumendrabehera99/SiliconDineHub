<?php include_once "adminNavbar.php";?>
<!-- Main Content -->
<div class="content w-100">
    <div class="row mt-3 ms-1 me-1">
        <h2 class="mb-1">Add Food</h2>
        <div class="border p-4 shadow-sm rounded">
            <form action="" method="post" id="addFood" enctype="multipart/form-data">
                <div class="row mb-2">
                    <div class="col-md-6">
                        <div>
                            <label for="foodName" class="form-label">Food Name</label>
                            <input type="text" class="form-control" id="foodName" placeholder="Enter Food name"/>
                        </div>
                        <div>
                            <label for="categoryName" class="form-label">Category Name</label>
                            <select class="form-select" id="categoryName">
                            </select>
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
                                <option value="1">Available</option>
                                <option value="0">Not Available</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label for="foodImage" class="form-label">Image</label>
                            <input type="file" name="image" class="form-control" accept="image/jpg, image/jpeg,  image/png" id="foodImage">
                        </div>
                        <div class="d-flex justify-content-center align-items-center" id="img-preview-div">
                            <img src="" alt="" class="object-fit-cover" style="width: 280px; height:280px;" id="img-preview">
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="text-end">
                        <input type="submit" value="ADD" class="btn px-4 btn-submit btn-success">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include_once "adminFooter.php";?>
<script src="../assets/js/foodAdd.js"></script>