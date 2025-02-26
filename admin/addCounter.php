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
                        <button class="btn btn-success mb-3"><i class="fa-solid fa-plus"></i> Add Counter</button>
                        <!-- Modal -->
                    </div>
                </div>
                <!-- Search bar -->
                <!-- <div class="col-md-6">
                    <div class="d-flex justify-content-end mb-2">
                        <div class="d-flex align-items-center gap-1">
                            <input type="text" class="form-control d-inline-block w-auto" id="searchCategoryInput" placeholder="Search Category">
                            <button type="submit" class="btn btn-success search-btn" id="categorySearchBtn">
                                <i class="fas fa-search"></i> Search
                            </button>
                        </div>
                    </div>
                </div> -->
            </div>

            <div class="d-flex justify-content-between">
                <table class="table table-bordered table-responsive" id="myTable">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>User Name</th>
                            <th>Password</th>
                            <!-- <th>Status</th> -->
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $result = getAllCounters();
                            while($counter = $result->fetch_assoc()){
                                ?>
                                <tr>
                                    <td><?= $counter['counterID']?></td>
                                    <td><?= $counter['userName']?></td>
                                    <td><?= $counter['password']?></td>
                                    <!-- <td>
                                        <span 
                                            class="d-inline-block rounded-circle me-2" 
                                            style="height: 10px; width: 10px; background-color: <?= $counter['status'] ? 'rgb(11, 218, 11)' : 'rgb(243, 64, 64)' ?>;">
                                        </span>
                                        <?= $counter['status'] ? 'Active' : 'Block' ?>
                                    </td> -->
                                    <td>
                                        <a href="CounterEdit.php?id=<?php echo $counter['counterID'] ?>" class="btn btn-success btn-sm"><i class="fa-solid fa-edit"></i></a>
                                        <a href="counterBlock.php?id=<?php echo $counter['counterID'] ?>" class="btn btn-danger btn-sm" id="deleteStudent"><i class="fa-solid fa-ban"></i></a>
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

<?php include_once "adminFooter.php"; ?>
