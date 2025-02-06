<?php include_once "adminNavbar.php";?>
<!-- Main Content -->
<div class="content w-100">
    <div class="row">
        <div class="col">
            <span class="text-dark fs-5">Food Category > <span class="text-secondary">Add Category</span></span>
        </div>
    </div>
    <div class="row">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 border p-4 shadow-sm rounded">
                <form action="" method="post">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="categoryName" class="form-label fs-5">Categories Name</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="categoryName" placeholder="Enter category name" value="Nashta"/>
                        </div>
                    </div>
                    <!-- For add Status -->
                    <!-- <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="status" class="form-label">Status</label>
                        </div>
                        <div class="col-md-6">
                            <select class="form-select" id="status">
                              <option selected>--SELECT--</option>
                              <option value="available">Available</option>
                              <option value="not-available">Not Available</option>
                            </select>
                        </div>
                    </div> -->
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