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
                    <button type="submit" value="Add" class="btn btn-success" name="add-student"><i class="fa-solid fa-plus"></i> Add</button>
                </div>
            </form>

            <div class="text-center">OR</div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <label for="fileUpload" class="form-label">Upload Excel File(Ex. xls, xlsx etc.)</label>
                        </div>
                        <div>
                            <a class="text-primary text-decoration-none" target="_blank" download href="../assets/excel/name_sic_mapping.xlsx">
                                Download Excel sheet format
                            </a>
                        </div>
                    </div>
                    <input class="form-control" type="file" id="fileUpload" placeholder="Choose a file Or drag it here" accept=".xlsx, .xls">
                </div>
                <div class="text-end">
                    <button type="submit"  class="btn btn-success" name="import-student" id="importStudentBtn"><i class="fa-solid fa-file-import"></i> Import</button>
                </div>
        </div>
    </div>
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="errorModalLabel">Validation Errors</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-danger" id="modalBody"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
</section>

<?php include_once "adminFooter.php";?>
<script src="../assets/js/studentAdd.js"></script>
