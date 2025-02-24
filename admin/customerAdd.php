<?php 
include_once "adminNavbar.php";
?>
<!-- Main Content -->
<section class="content w-100">
    <div class="row mt-3 ms-1 me-1">
        <h2 class="mb-4">Add Customer</h2>
        <div class="col-md-6 mx-auto border border-3 p-4 shadow-sm rounded">
            
            <form action="" method="post" id="addStudent">
                <div class="mb-3">
                    <label for="sic" class="form-label">SIC</label> 
                    <input type="text" class="form-control" id="sic" placeholder="Enter student's SIC"> 
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter registered email">
                </div>
                <div class="text-end">
                    <!-- <input type="submit" value="Add" class="btn btn-success" name="add-student"> -->
                    <button type="submit" value="Add" class="btn btn-success" name="add-student"><i class="fa-solid fa-plus"></i> Add</button>
                </div>
            </form>

            <div class="text-center">OR</div>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="fileUpload" class="form-label">Upload Excel File(Ex. xls, xlsx etc.)</label>
                    <input class="form-control" type="file" id="fileUpload" placeholder="Choose a file Or drag it here">
                </div>
                <div class="text-end">
                    <input type="submit" value="import" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>

</section>

<?php include_once "adminFooter.php";?>