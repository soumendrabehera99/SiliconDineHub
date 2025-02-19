<?php include_once "adminNavbar.php";?>
<!-- Main Content -->
<div class="content w-100">
    <div class="row">
        <h2 class="mb-2">Add Food</h2>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 border p-4 shadow-sm rounded">
                    <form action="" method="post" id="addFood">
                        <div class="row mb-3">
                            <div>
                                <label for="foodName" class="form-label">Food Name</label>
                                <input type="text" class="form-control" id="foodName" placeholder="Enter Food name"/>
                                <!-- <label id="nameError" class="error"></label> -->
                            </div>
                            <div>
                                <label for="categoryName" class="form-label">Category Name</label>
                                <select class="form-select" id="categoryName">
                                    <option selected>--SELECT--</option>
                                    <option value="south">South</option>
                                    <option value="chinese">Chinese</option>
                                </select>
                                <!-- <label id="categoryError" class="error"></label> -->
                            </div>
                            <div class="mt-2">
                                <label for="foodImage" class="form-label">Image</label>
                                <input type="file" name="image" class="form-control-file" accept="image/*" id="foodImage">
                                <!-- <label id="imageError" class="error"></label> -->
                            </div>
                            <div>
                                <label for="foodDescription" class="form-label">Description</label>
                                <textarea id="foodDescription" value="Add description about food" class="form-control my-1"></textarea>
                                <!-- <label id="descriptionError" class="error"></label> -->
                            </div>
                            <div>
                                <label for="foodPrice" class="form-label">price</label>
                                <input type="text" class="form-control" id="foodPrice" placeholder="Enter Food Price"/>
                                <!-- <label id="priceError" class="error"></label> -->
                            </div>
                            <div>
                                <label for="foodStatus" class="form-label">Status</label>
                                <select class="form-select" id="foodStatus">
                                    <option selected>--SELECT--</option>
                                    <option value="available">Available</option>
                                    <option value="not-available">Not Available</option>
                                </select>
                                <!-- <label id="statusError" class="error"></label> -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="submit" value="ADD" class="btn btn-submit btn-success w-50 align-items-center">
                            </div>
                        </div>
                        <!-- <div id="formMessage"></div> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once "adminFooter.php";?>