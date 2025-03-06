<?php 
include_once "adminNavbar.php"; 
require_once "../dbFunctions/studentdb.php";
?>
<!-- Main Content -->
<section class="content w-100">
    <div class="row mt-3 ms-1 me-1">
        <h2 class="mb-4">Valid Customers</h2>

        <div class="col-md-12 border border-2 pt-1 shadow-sm rounded">
            <div class="row text-end">
                <div class="col-md-6 mb-3 mt-2 text-start">
                    <a class="btn btn-success text-center" href="./customerAdd.php"><i class="fa-solid fa-plus"></i> Add Records</a>
                </div>
                <div class="col-md-6 mb-3 mt-2 text-md-end">
                    <div class="d-flex justify-content-md-end align-items-center gap-2">
                        <label for="searchInput" style="font-weight: 500;">Search:</label>
                        <div style="position: relative;">
                            <i class="fas fa-search" style="
                                position: absolute;
                                top: 50%;
                                left: 10px;
                                transform: translateY(-50%);
                                color: #888;
                            "></i>
                            <input type="text" 
                                id="searchInput" 
                                class="form-control" 
                                placeholder="Search by SIC or Name"
                                style="
                                    padding-left: 30px;
                                    border: 1px solid #ccc;
                                    height: 38px;
                                    width: 250px;
                                ">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row ms-1">
                Total No. records: <?php echo totalNoOfSicEmail();?>
            </div>

            <div class="d-flex justify-content-between mt-1">
                <div style="max-height: 450px; overflow-y: auto; width: 100%;" class="mb-2"> 
                    <table class="table table-bordered table-responsive" id="myTable">
                        <thead class="table-light">
                            <tr>
                                <th>Sl No</th>
                                <th>SIC</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <?php
                                $sl = 1;
                                $result = getAllSicEmail();
                                while($std = $result->fetch_assoc()){
                                    ?>
                                    <tr>
                                        <td><?= $sl++?></td>
                                        <td class="sic"><?= $std['sic']?></td>
                                        <td class="email"><?= $std['email']?></td>
                                        <td>
                                            <a  class="btn btn-success btn-sm edit-btn" data-id="<?= $std['seID'] ?>" data-sic="<?= $std['sic']?>" data-email="<?= $std['email']?>" data-bs-toggle="modal" data-bs-target="#editSicEmailModal"><i class="fa-solid fa-edit"></i> Edit</a>
                                            <!-- <a href="delete.php?id=<?php echo $std['seID'] ?>" class="btn btn-danger btn-sm" id="deleteStudent"><i class="fa-solid fa-trash"></i> Delete</a> -->
                                            <a class="btn btn-danger btn-sm delete-btn" data-id="<?= $std['seID'] ?>" data-sic="<?= $std['sic']?>" name="customerValidDeleteBtn">
                                                <i class="fa-solid fa-trash"></i> Delete
                                            </a>
                                        </td>
                                    </tr>
                                    <?php 
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="editSicEmailModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="editStudentSicEmail">
                <div class="modal-body">
                    <div class="row mb-3">
                        <div>
                            <label for="editStudentSic" class="form-label">Student SIC :</label>
                            <input type="text" class="form-control" id="editStudentSic" placeholder="Enter category name" value="">
                        </div>
                        <div>
                            <input type="hidden" id="editSeId" name="editSeId" value="">
                            <label for="editStudetEmail" class="form-label">Student Email :</label>
                            <input type="text" class="form-control" id="editStudetEmail" placeholder="Enter category name" value="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer" class="d-flex justify-content-end">
                    <input type="submit" value="Update" class="btn btn-submit btn-success">
                </div>
            </form>
        </div>
    </div>
</div>
<?php include_once "adminFooter.php"; ?>
<script src="../assets/js/customerValid.js"></script>