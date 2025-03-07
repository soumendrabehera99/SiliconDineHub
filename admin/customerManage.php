<?php 
include_once "adminNavbar.php"; 
require_once "../dbFunctions/studentdb.php";
?>
<!-- Main Content -->
<section class="content w-100">
    <div class="row mt-3 ms-1 me-1">
        <h2 class="mb-4">Manage Customer</h2>

        <div class="col-md-12 border border-2 pt-1 shadow-sm rounded">
            <div class="row">
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
                Total No. records: <?php echo totalNoOfStudents();?>
            </div>

            <div class="d-flex justify-content-between mt-1">
                <div style="max-height: 450px; overflow-y: auto; width: 100%;" class="mb-2">
                    <table class="table table-bordered table-responsive text-center" id="myTable">
                        <thead class="table-light">
                            <tr class="align-text-top">
                                <th>Sl No</th>
                                <th>SIC</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>DOB</th>
                                <th>Status
                                <p class="mb-0 fw-light">click on status to update</p>
                                </th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <?php
                                $sl = 1;
                                $result = getAllStudents();
                                while($std = $result->fetch_assoc()){
                                    ?>
                                    <tr>
                                        <td><?= $sl++?></td>
                                        <td class="sic"><?= $std['sic']?></td>
                                        <td class="name"><?= $std['name']?></td>
                                        <td><?= $std['email'] ?></td>
                                        <td><?= date('d M Y', strtotime($std['dob'])) ?></td>
                                        <td>
                                            <a data-id="<?php echo $std['studentID'] ?>" data-sic="<?= $std['sic']?>" data-status="<?= $std['isActive']?>"  data-name="<?= $std['name']?>" class="btn btn-sm statusUpdateBtn <?= $std['isActive'] ? 'btn-success' : 'btn-danger' ?> " data-bs-target="#updateStatusStudentModal" data-bs-toggle="modal"> <?= $std['isActive'] ? '<i class="fa-solid fa-circle-check"></i> Active' : '<i class="fa-solid fa-ban"></i> Block' ?></a>
                                        </td>
                                        <td>
                                            <a data-id="<?php echo $std['studentID'] ?>" data-email="<?= $std['email']?>" data-sic="<?= $std['sic']?>" data-status="<?= $std['isActive']?>"  data-name="<?= $std['name']?>" data-date="<?= $std['dob']?>" class="btn btn-warning btn-sm viewBtn" data-bs-target="#viewStudentModal" data-bs-toggle="modal"><i class="fa-solid fa-eye"></i> View</a>
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
<div class="modal fade" id="updateStatusStudentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update Student Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="updateStudentStatusForm">
                <div class="modal-body">
                    <input type="hidden" id="updateStudentIdInput" name="studentId">
                    <input type="hidden" id="updateStudentStatusInput" name="studentStatus">
                    <p>Are you sure you want to <strong id="updateStudentStatus"></strong> the Student with name <strong id="updateStudentName"></strong> and sic <strong id="updateStudentSic"></strong> ?</p>
                </div>
                <div class="modal-footer d-flex justify-content-end">
                    <input type="submit" value="Update" class="btn btn-submit btn-success">
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="viewStudentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update Student Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="updateStudentStatusForm">
                <div class="modal-body">
                    <input type="hidden" id="viewStudentIdInput" name="studentId">
                    <div>
                        <label for="viewStudentName" class="form-label">Name</label>
                        <input type="text" id="viewStudentName" name="viewStudentName" class="form-control" disabled>
                    </div>
                    <div>
                        <label for="viewStudentEmail" class="form-label">Email</label>
                        <input type="text" id="viewStudentEmail" name="viewStudentEmail" class="form-control" disabled>
                    </div>
                    <div>
                        <label for="viewStudentSic" class="form-label">SIC</label>
                        <input type="text" id="viewStudentSic" name="viewStudentSic" class="form-control" disabled>
                    </div>
                    <div>
                        <label for="viewStudentDob" class="form-label">Date Of Birth</label>
                        <input type="date" id="viewStudentDob" name="viewStudentDob" class="form-control" disabled>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button class="btn btn-warning" id="editBtn"><i class="fa-solid fa-pen-to-square"></i> Edit</button>
                    <input type="submit" value="Update" class="btn btn-submit btn-success" id="updateBtn" disabled>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include_once "adminFooter.php"; ?>
<script src="../assets/js/customerManage.js"></script>
