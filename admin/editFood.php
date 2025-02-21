<?php
    if(!isset($_GET['foodID'])){
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
                            <div>
                                <label for="foodName" class="form-label">Food Name</label>
                                <input type="text" class="form-control" id="foodName" value="<?php echo $food['name']?>" readonly>
                            </div>
                            <div>
                                <label for="categoryName" class="form-label">Category Name</label>
                                <select class="form-select" id="categoryName" required>
                                    <option value="">--select--</option>
                                    <?php while($row = mysqli_fetch_assoc($categories)){?>
                                        <option value="<?php echo $row['foodCategoryID']?>" <?php echo ($row['foodCategoryID'] == $curr_categoryID) ? 'selected' : '';?>>
                                            <?php echo $row['category']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mt-2">
                                <label for="foodImage" class="form-label">Image</label>
                                <img src="../uploads/<?php echo $food['image']; ?>" width="100%" height="100%" alt="Food_Image">
                                <!-- <input type="file" name="image" class="form-control" accept="image/*" id="foodImage"> -->
                            </div>
                            <div>
                                <label for="foodDescription" class="form-label">Description</label>
                                <textarea id="foodDescription" value="Add description about food" class="form-control my-1"><?php echo $food['description'];?></textarea>
                            </div>
                            <div>
                                <label for="foodPrice" class="form-label">price</label>
                                <input type="text" class="form-control" id="foodPrice" value="<?php $food['price']; ?>"/>
                            </div>
                            <div>
                                <label for="foodStatus" class="form-label">Status</label>
                                <select class="form-select" id="foodStatus">
                                    <option selected>--SELECT--</option>
                                    <option value="<?php $food[isAvailable] === "1" ? print "selected" : "" ?>">Available</option>
                                    <option value="<?php $food[isAvailable] === "0" ? print "selected" : "" ?>">Not Available</option>
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
<?php include_once "adminFooter.php";?>