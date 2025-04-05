<?php 
include_once "adminNavbar.php"; 
require_once "../dbFunctions/counterdb.php";
?>
<!-- Main Content -->
<section class="content w-100">
    <div class="row mt-3 ms-1 me-1">
        <h2 class="mb-4">Add Counter</h2>
        <div class="col-md-12 border border-2 pt-1 shadow-sm rounded">
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="d-flex justify-content-start">
                        <!-- Button trigger modal -->
                        <button class="btn btn-success mb-3" id="addRecordBtn"><i class="fa-solid fa-plus"></i> Add Counter</button>
                        <!-- Modal -->
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <table class="table table-bordered table-responsive" id="myTable">
                    <thead class="table-light text-center">
                        <tr class="align-text-top">
                            <th>ID</th>
                            <th>User Name</th>
                            <th>Password</th>
                            <th>Status <p class="mb-0 fw-light ">click on status to update</p></th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $result = getAllCounters();
                            while($counter = $result->fetch_assoc()){
                                ?>
                                <tr class="text-center">
                                    <td><?= $counter['counterID']?></td>
                                    <td><?= $counter['userName']?></td>
                                    <td><?= $counter['password']?></td>
                                    <td>
                                        <a href="../dbFunctions/counterToggleStatus.php?id=<?= $counter['counterID'] ?>&status=<?= $counter['status'] ?>"
                                            class="btn btn-sm <?= $counter['status'] ? 'btn-success' : 'btn-danger' ?> toggle-status"
                                            data-id="<?= $counter['counterID'] ?>"
                                            data-status="<?= $counter['status'] ?>">
                                            <?= $counter['status'] ? 'Active' : 'Block' ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="CounterEdit.php?id=<?php echo $counter['counterID'] ?>" class="btn btn-success btn-sm"><i class="fa-solid fa-edit me-1"></i>Edit</a>
                                        <a href="counterBlock.php?id=<?php echo $counter['counterID'] ?>" class="btn btn-danger btn-sm" id="deleteStudent"><i class="fa-solid fa-ban me-1"></i>Delete</a>
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
</section>
<script src="../assets/sweetalert/sweetalert2.all.min.js"></script>
<script src="../assets/jquery/jquery-3.7.1.min.js"></script>
<script src="../assets/js/counterAdd.js"></script>
<script src="../assets/js/counterManage.js"></script>

<?php include_once "adminFooter.php"; ?>
