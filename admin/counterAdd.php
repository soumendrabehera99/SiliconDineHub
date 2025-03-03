<?php 
include_once "adminNavbar.php";
?>
<!-- Main Content -->
<section class="content w-100">
    <div class="row mt-3 ms-1 me-1">
        <h2 class="mb-4">Add Counter</h2>
        <div class="col-md-6 mx-auto border border-3 p-4 shadow-sm rounded">
            
            <form action="" method="post" id="addCounter">
                <div class="mb-3">
                    <label for="name" class="form-label">User Name</label> 
                    <input type="text" class="form-control" id="name" placeholder="Enter user name"> 
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="text" class="form-control" id="password" placeholder="Enter Password">
                </div>
                <div class="mb-3">
                    <label for="cpassword" class="form-label">Confirm Password</label>
                    <input type="text" class="form-control" id="cpassword" placeholder="Enter confirm Password">
                </div>
                <div class="text-end">
                    <button type="submit" value="Add" class="btn btn-success" name="add-student"><i class="fa-solid fa-plus"></i> Add</button>
                </div>
            </form>
        </div>
    </div>

</section>

<?php include_once "adminFooter.php";?>