<?php
    if(!isset($_GET['foodID']) || $_GET['foodID'] =="" ){
        header("location:../admin/manageFood.php");
    }
    $foodID = $_GET['foodID'];
    require_once "../dbFunctions/fooddb.php";
    require_once "../dbFunctions/categorydb.php";
    $food = getFoodByID($foodID);
    if(!$food){
        ?>
        <script>
            toastr.error("Invalid ID");
            window.location.href = "../admin/manageFood.php";
        </script>
    <?php
    }
    $curr_categoryID = $food['foodCategoryID'];
    $curr_categoryName = $food['category'];
    $categories = getAllCategory();
?>
    <?php include_once "adminNavbar.php";?>
<!-- Main Content -->
<div class="content w-100">
    <div class="row">
        <h2 class="mb-1">Edit Food</h2>
            <div class="row justify-content-center">
                <div class="col-md-6 border p-4 shadow-sm rounded">
                    <form action="" method="post" id="updateFood" enctype="multipart/form-data">
                        <div class="row mb-1">
                            <input type="hidden" name="foodId" id="foodId" value="<?php echo $_GET['foodID'];?>">
                            <div>
                                <label for="foodName" class="form-label">Food Name</label>
                                <input type="text" class="form-control" id="foodName" value="<?php echo $food['name']?>" readonly>
                            </div>
                            <div>
                                <label for="categoryName" class="form-label">Category Name</label>
                                <select class="form-select" id="categoryName" name="categoryID" required disabled>
                                    <option value="">--select--</option>
                                    <?php foreach ($categories['categories'] as $row) { ?>
                                        <option value="<?php echo $row['foodCategoryID']; ?>" 
                                            <?php echo ((int)$row['foodCategoryID'] == (int)$food['foodCategoryID']) ? 'selected' : ''; ?>>
                                            <?php echo $row['category']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div>
                                <label for="foodDescription" class="form-label">Description</label>
                                <textarea id="foodDescription" value="Add description about food" class="form-control" readonly><?php echo $food['description'];?></textarea>
                            </div>
                            <div>
                                <label for="foodPrice" class="form-label">price</label>
                                <input type="text" class="form-control" id="foodPrice" value="<?php echo $food['price']; ?>"/>
                            </div>
                            <div>
                                <label for="foodStatus" class="form-label">Status</label>
                                <select class="form-select" id="foodStatus" disabled>
                                    <option selected>--SELECT--</option>
                                    <option value="1" <?php echo $food['isAvailable'] === "1" ? "selected" : "" ?>>Available</option>
                                    <option value="0" <?php echo $food['isAvailable'] === "0" ? "selected" : "" ?>>Not Available</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mt-2 d-flex justify-content-between">
                                <button class="btn btn-warning text-start px-4" id="editFoodBtn">Edit</button>
                                <input type="submit" value="Update" id="updateFoodBtn" class="btn btn-submit btn-success" disabled>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </div>
</div>
<?php include_once "adminFooter.php";?>
<script src="../assets/js/foodUpdate.js"></script>