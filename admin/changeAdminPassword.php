<?php include_once "adminNavbar.php";?>
<!-- Main Content -->
<section class="content w-100">
    <div class="row mt-3 ms-1 me-1 ">
        <h2 class="mb-1">Change Password</h2>
        <div class="col-md-6 mx-auto border border-3 p-4 shadow-sm rounded">
            <form action="" method="post">
                <div class="mb-3">
                    <label class="form-label">Current Password</label>
                    <input type="password" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">New Password</label>
                    <input type="password" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Confirm New Password</label>
                    <input type="password" class="form-control">
                </div>
                <div class="text-end">
                    <input type="submit" class="btn btn-success" value="Update Password">
                </div>
            </form>
        </div>
    </div>
</section>

<?php include_once "adminFooter.php";?>