<?php include_once "adminNavbar.php";?>
<!-- Main Content -->
<section class="content w-100">
    <div class="row">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 border p-4 shadow-sm rounded">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">SIC</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter student's SIC">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter registered email">
                    </div>
                    <div class="text-end">
                        <input type="submit" value="Add" class="btn btn-primary">
                    </div>
                </form>
                <div class="text-center">OR</div>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="fileUpload" class="form-label">Upload Excel File(Ex. xls, xlsx etc.)</label>
                        <input class="form-control" type="file" id="fileUpload" placeholder="Choose a file Or drag it here">
                    </div>
                    <div class="text-end">
                        <input type="submit" value="import" class="btn btn-primary">
                    </div>
                </form>

            </div>
        </div>
    </div>

    </div>

</section>

<?php include_once "adminFooter.php";?>